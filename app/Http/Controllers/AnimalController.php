<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdoptionInquiry;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $query = Animal::query();

        if ($request->filled('species')) {
            $query->where('species', $request->species);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('species', 'LIKE', "%{$search}%");
            });
        }

        $animals = $query->latest()->get();
        $speciesList = Animal::distinct()->pluck('species')->filter();
        
        return view('animals.index', compact('animals', 'speciesList'));
    }

    public function create()
    {
        return view('animals.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'species' => 'required',
            'age' => 'required|integer',
            'status' => 'required|in:available,pending,adopted',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('animals', 'public');
        }

        Animal::create($data);
        return redirect()->route('animals.index')->with('success', 'Success!');
    }

    public function edit(Animal $animal)
    {
        return view('animals.edit', compact('animal'));
    }

    public function update(Request $request, Animal $animal)
    {
        $data = $request->validate([
            'name' => 'required',
            'species' => 'required',
            'age' => 'required|integer',
            'status' => 'required|in:available,pending,adopted',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            if ($animal->image_path) {
                Storage::disk('public')->delete($animal->image_path);
            }
            $data['image_path'] = $request->file('image')->store('animals', 'public');
        }

        $animal->update($data);
        return redirect()->route('animals.index')->with('success', 'Updated!');
    }

    public function destroy(Animal $animal)
    {
        if ($animal->image_path) {
            Storage::disk('public')->delete($animal->image_path);
        }
        $animal->delete();
        return redirect()->route('animals.index');
    }

    public function inquire(Animal $animal)
    {
        $user = auth()->user();
        Mail::to('aizhan.sagatova@narxoz.kz')->send(new AdoptionInquiry($animal, $user));
        return back()->with('success', 'Sent!');
    }
}
