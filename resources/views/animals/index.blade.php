@extends('layouts.app')

@section('title', __('Animals'))

@section('content')
<div class="animals-page">
    <div class="page-header glass-card">
        <div class="header-text">
            <h1>{{ __('Our Friends') }}</h1>
            <p>{{ __('Explore and manage the animals in our shelter.') }}</p>
        </div>
        @if(auth()->user()->role !== 'guest')
            <a href="{{ route('animals.create') }}" class="btn btn-primary btn-sm">
                <span class="plus">+</span> {{ __('Add New Friend') }}
            </a>
        @endif
    </div>

    <div class="glass-card filter-card">
        <form action="{{ route('animals.index') }}" method="GET" class="filter-grid">
            <div class="filter-group">
                <label>{{ __('Search') }}</label>
                <input type="text" name="search" class="form-control" placeholder="{{ __('Search by name...') }}" value="{{ request('search') }}">
            </div>
            
            <div class="filter-group">
                <label>{{ __('Species') }}</label>
                <select name="species" class="form-control">
                    <option value="">{{ __('All Species') }}</option>
                    @foreach($speciesList as $species)
                        <option value="{{ $species }}" {{ request('species') == $species ? 'selected' : '' }}>
                            {{ __($species) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label>{{ __('Status') }}</label>
                <select name="status" class="form-control">
                    <option value="">{{ __('All Statuses') }}</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>{{ __('Available') }}</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                    <option value="adopted" {{ request('status') == 'adopted' ? 'selected' : '' }}>{{ __('Adopted') }}</option>
                </select>
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn btn-accent">{{ __('Apply') }}</button>
                <a href="{{ route('animals.index') }}" class="btn btn-outline">{{ __('Reset') }}</a>
            </div>
        </form>
    </div>

    <div class="animals-grid">
        @forelse($animals as $animal)
            <div class="animal-card-v2">
                <div class="card-image">
                    @if($animal->image_path)
                        <img src="{{ asset('storage/' . $animal->image_path) }}" alt="{{ $animal->name }}">
                    @else
                        <div class="placeholder-img">🐾</div>
                    @endif
                    <div class="status-tag tag-{{ $animal->status }}">{{ __($animal->status) }}</div>
                    
                    <div class="image-overlay-tags">
                        <span class="mini-tag">🛡️ {{ __('Vaccinated') }}</span>
                        <span class="mini-tag">💖 {{ __('Friendly') }}</span>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="card-title-row">
                        <h3>{{ $animal->name }}</h3>
                        <span class="type-pill">{{ __($animal->species) }}</span>
                    </div>
                    
                    <div class="meta-info">
                        <span>📅 {{ $animal->created_at->format('d.m.Y') }}</span>
                        <span>⚖️ {{ rand(2, 25) }} кг</span>
                    </div>

                    <p class="age-label">{{ $animal->age }} {{ __('years old') }}</p>
                    <p class="card-desc">{{ Str::limit($animal->description, 120) }}</p>
                    
                    <div class="card-footer">
                        @if($animal->status === 'available')
                            <form action="{{ route('animals.inquire', $animal) }}" method="POST" style="width: 100%; margin-bottom: 1rem;">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">
                                    <span>📩</span> {{ __('Inquire About Adoption') }}
                                </button>
                            </form>
                        @endif

                        @if(auth()->user()->role !== 'guest')
                            <div class="admin-btns">
                                <a href="{{ route('animals.edit', $animal) }}" class="btn-action edit" title="{{ __('Edit') }}">
                                    <span>✏️</span> {{ __('Edit') }}
                                </a>
                                <form action="{{ route('animals.destroy', $animal) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action delete" title="{{ __('Delete') }}">
                                        <span>🗑️</span> {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="glass-card empty-state" style="grid-column: 1/-1; text-align: center; padding: 4rem;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
                <h3>{{ __('No friends found matching your criteria.') }}</h3>
                <p style="color: var(--secondary); margin-top: 0.5rem;">{{ __('Try adjusting your filters or search terms.') }}</p>
                <a href="{{ route('animals.index') }}" class="btn btn-primary" style="margin-top: 2rem;">{{ __('View All Animals') }}</a>
            </div>
        @endforelse
    </div>
</div>

<style>
    .animals-page { padding-top: 1rem; }
    .page-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 2rem;
        padding: 1.2rem 2rem !important;
        background: linear-gradient(135deg, var(--card), var(--bg));
    }
    .header-text h1 { font-size: 2.2rem; font-weight: 800; letter-spacing: -1.5px; line-height: 1; }
    .header-text p { color: var(--secondary); font-size: 0.95rem; margin-top: 0.2rem; }
    
    .filter-card { padding: 1.2rem; margin-bottom: 2rem; background: var(--card); border: 1px solid var(--border); }
    .filter-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr auto; gap: 1rem; align-items: flex-end; }
    .filter-group label { display: block; margin-bottom: 0.5rem; font-size: 0.7rem; font-weight: 800; color: var(--secondary); text-transform: uppercase; letter-spacing: 1.5px; }
    .filter-actions { display: flex; gap: 0.6rem; }
    .btn-accent { background: var(--primary); color: var(--bg); font-weight: 800; padding: 0.7rem 1.5rem; border-radius: 10px; border: none; cursor: pointer; transition: 0.3s; }
    .btn-accent:hover { opacity: 0.9; transform: translateY(-2px); }

    .animals-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
    
    .animal-card-v2 { 
        background: var(--card); border-radius: 20px; overflow: hidden; 
        transition: all 0.3s ease;
        border: 1px solid var(--border);
        display: flex;
        flex-direction: column;
    }
    .animal-card-v2:hover { transform: translateY(-5px); border-color: var(--accent); }
    
    .card-image { height: 200px; position: relative; overflow: hidden; }
    .card-image img { width: 100%; height: 100%; object-fit: cover; }
    
    .image-overlay-tags { position: absolute; bottom: 0.8rem; left: 0.8rem; display: flex; gap: 0.4rem; }
    .mini-tag { background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); color: white; padding: 0.2rem 0.5rem; border-radius: 6px; font-size: 0.65rem; font-weight: 600; }

    .status-tag { position: absolute; top: 1rem; right: 1rem; padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.65rem; font-weight: 800; text-transform: uppercase; z-index: 5; }
    .tag-available { background: rgba(46, 204, 113, 0.9); color: white; }
    .tag-pending { background: rgba(241, 196, 15, 0.9); color: black; }
    .tag-adopted { background: rgba(231, 76, 60, 0.9); color: white; }

    .card-body { padding: 1.2rem; display: flex; flex-direction: column; flex-grow: 1; }
    .card-title-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem; }
    .card-title-row h3 { font-size: 1.4rem; font-weight: 800; letter-spacing: -0.5px; }
    .type-pill { background: var(--accent-soft); color: var(--accent); padding: 0.3rem 0.8rem; border-radius: 8px; font-size: 0.75rem; font-weight: 700; }
    
    .meta-info { display: flex; gap: 0.8rem; margin-bottom: 0.8rem; color: var(--secondary); font-size: 0.75rem; font-weight: 500; }

    .age-label { color: var(--accent); font-size: 0.9rem; margin-bottom: 0.8rem; font-weight: 700; }
    .card-desc { color: var(--secondary); margin-bottom: 1.5rem; line-height: 1.5; font-size: 0.85rem; min-height: 4.5em; }
    
    .card-footer { margin-top: auto; }
    .admin-btns { display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem; }
    .admin-btns form { display: contents; } /* Make the form transparent to the grid */
    
    .btn-action { 
        width: 100%;
        height: 42px; display: flex; align-items: center; justify-content: center; 
        gap: 0.5rem; border-radius: 10px; font-size: 0.85rem; font-weight: 700; text-decoration: none;
        border: 1px solid var(--border); background: var(--bg); transition: 0.3s;
        cursor: pointer; color: var(--primary);
    }
    .btn-action span { font-size: 1rem; }
    .btn-action:hover { background: var(--accent); color: white; border-color: var(--accent); }
    .btn-action.delete:hover { background: #ff4757; color: white; border-color: #ff4757; }
    .btn-action.edit { color: #f1c40f; }
    .btn-action.delete { color: #e74c3c; }
    
    .btn-sm { padding: 0.5rem 1rem; font-size: 0.8rem; }
    .plus { font-size: 1.2rem; margin-right: 0.3rem; }
    .w-100 { width: 100%; }

    @media (max-width: 1000px) { .filter-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 650px) { .filter-grid { grid-template-columns: 1fr; } .page-header { flex-direction: column; align-items: flex-start; gap: 1rem; } .header-text h1 { font-size: 1.8rem; } }
</style>
@endsection
