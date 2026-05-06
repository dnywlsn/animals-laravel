<?php

namespace App\Http\Controllers;

use App\Models\Animal;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Animal::count(),
            'available' => Animal::where('status', 'available')->count(),
            'pending' => Animal::where('status', 'pending')->count(),
            'adopted' => Animal::where('status', 'adopted')->count(),
        ];

        $monthlyData = [10, 15, 8, 12, 20, 25]; 
        $speciesData = [
            'Dogs' => Animal::where('species', 'Dog')->count(),
            'Cats' => Animal::where('species', 'Cat')->count(),
            'Others' => Animal::where('species', '!=', 'Dog')->where('species', '!=', 'Cat')->count(),
        ];

        return view('dashboard', compact('stats', 'monthlyData', 'speciesData'));
    }
}
