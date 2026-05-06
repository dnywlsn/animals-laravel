@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')
<div class="dashboard-page">
    <div class="page-header glass-card">
        <div class="header-text">
            <h1>{{ __('Dashboard') }}</h1>
            <p>{{ __('Real-time overview of shelter activity and community impact.') }}</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary btn-sm">⚡ {{ __('Export Report') }}</button>
        </div>
    </div>

    <div class="stats-grid">
        <div class="glass-card stat-item">
            <div class="stat-icon">🐾</div>
            <div class="stat-content">
                <span class="stat-label">{{ __('Total Animals') }}</span>
                <span class="stat-value">{{ $stats['total'] }}</span>
                <span class="stat-trend positive">↑ 12% {{ __('this month') }}</span>
            </div>
        </div>
        <div class="glass-card stat-item">
            <div class="stat-icon" style="color: #2ecc71;">✅</div>
            <div class="stat-content">
                <span class="stat-label">{{ __('Available') }}</span>
                <span class="stat-value">{{ $stats['available'] }}</span>
                <span class="stat-trend">{{ __('Ready for home') }}</span>
            </div>
        </div>
        <div class="glass-card stat-item">
            <div class="stat-icon" style="color: #f1c40f;">⏳</div>
            <div class="stat-content">
                <span class="stat-label">{{ __('Pending') }}</span>
                <span class="stat-value">{{ $stats['pending'] }}</span>
                <span class="stat-trend">{{ __('In interview') }}</span>
            </div>
        </div>
        <div class="glass-card stat-item">
            <div class="stat-icon" style="color: #e74c3c;">🏠</div>
            <div class="stat-content">
                <span class="stat-label">{{ __('Adopted') }}</span>
                <span class="stat-value">{{ $stats['adopted'] }}</span>
                <span class="stat-trend positive">↑ 8 {{ __('new families') }}</span>
            </div>
        </div>
    </div>

    <div class="charts-grid">
        <div class="glass-card chart-item">
            <div class="chart-header">
                <h3>{{ __('Shelter Growth & Trends') }}</h3>
                <span class="chart-period">{{ __('Last 6 Months') }}</span>
            </div>
            <div class="chart-wrapper">
                <canvas id="mainChart"></canvas>
            </div>
        </div>
        <div class="glass-card chart-item">
            <h3>{{ __('Community Interaction') }}</h3>
            <div class="activity-list">
                <div class="activity-item">
                    <div class="act-icon">💬</div>
                    <div class="act-text">
                        <strong>{{ __('New Inquiry') }}</strong>
                        <p>{{ __('Someone is interested in Barbos') }}</p>
                        <span>2 {{ __('hours ago') }}</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="act-icon">🎉</div>
                    <div class="act-text">
                        <strong>{{ __('Success!') }}</strong>
                        <p>{{ __('Murka has been adopted') }}</p>
                        <span>5 {{ __('hours ago') }}</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="act-icon">👤</div>
                    <div class="act-text">
                        <strong>{{ __('New Volunteer') }}</strong>
                        <p>{{ __('Arman joined the team') }}</p>
                        <span>1 {{ __('day ago') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-grid">
        <div class="glass-card info-item">
            <h3>{{ __('Species Distribution') }}</h3>
            <div class="chart-wrapper-small">
                <canvas id="speciesChart"></canvas>
            </div>
        </div>
        <div class="glass-card info-item">
            <h3>{{ __('Quick Notes') }}</h3>
            <ul class="notes-list">
                <li>📌 {{ __('Check vaccination for new puppy') }}</li>
                <li>📌 {{ __('Update social media with adoption stories') }}</li>
                <li>📌 {{ __('Restock animal food by Friday') }}</li>
                <li>📌 {{ __('Interview 3 potential adopters') }}</li>
            </ul>
        </div>
    </div>
</div>

<script>
    const colors = ['#3498db', '#2ecc71', '#f1c40f', '#e74c3c', '#9b59b6'];

    new Chart(document.getElementById('mainChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: "{{ __('Rescues') }}",
                data: [12, 19, 15, 25, 22, 30],
                borderColor: '#3498db',
                backgroundColor: 'rgba(52, 152, 219, 0.1)',
                fill: true,
                tension: 0.4
            }, {
                label: "{{ __('Adoptions') }}",
                data: [8, 12, 10, 18, 15, 22],
                borderColor: '#2ecc71',
                backgroundColor: 'transparent',
                borderDash: [5, 5],
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'top', labels: { color: '#888', usePointStyle: true } } },
            scales: {
                y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#888' } },
                x: { grid: { display: false }, ticks: { color: '#888' } }
            }
        }
    });

    new Chart(document.getElementById('speciesChart'), {
        type: 'doughnut',
        data: {
            labels: ["{{ __('Dogs') }}", "{{ __('Cats') }}", "{{ __('Others') }}"],
            datasets: [{
                data: [{{ $speciesData['Dogs'] }}, {{ $speciesData['Cats'] }}, {{ $speciesData['Others'] }}],
                backgroundColor: colors,
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'right', labels: { color: '#888', font: { size: 12 } } } }
        }
    });
</script>

<style>
    .dashboard-page { padding-top: 1rem; }
    .page-header { 
        margin-bottom: 2rem; 
        padding: 1.5rem 2rem !important; 
        display: flex; 
        justify-content: space-between; 
        align-items: center;
        background: linear-gradient(135deg, var(--card), var(--bg));
    }
    .header-text h1 { font-size: 2.2rem; font-weight: 800; letter-spacing: -1.5px; margin-bottom: 0.2rem; }
    .header-text p { color: var(--secondary); font-size: 0.95rem; }

    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
    .stat-item { padding: 1.2rem !important; display: flex; align-items: center; gap: 1.2rem; transition: 0.3s; }
    .stat-icon { font-size: 2rem; }
    .stat-label { display: block; color: var(--secondary); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
    .stat-value { font-size: 1.6rem; font-weight: 800; display: block; margin: 0.1rem 0; }
    .stat-trend { font-size: 0.75rem; color: var(--secondary); font-weight: 500; }
    .stat-trend.positive { color: #2ecc71; }

    .charts-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
    .chart-item { padding: 1.5rem !important; }
    .chart-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
    .chart-period { font-size: 0.75rem; color: var(--secondary); background: var(--bg); padding: 0.2rem 0.6rem; border-radius: 20px; }
    .chart-item h3 { font-size: 1.1rem; font-weight: 700; color: var(--primary); }
    .chart-wrapper { height: 280px; position: relative; }

    .activity-list { display: flex; flex-direction: column; gap: 1rem; }
    .activity-item { display: flex; gap: 0.8rem; align-items: flex-start; }
    .act-icon { width: 35px; height: 35px; background: var(--bg); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; }
    .act-text strong { display: block; font-size: 0.85rem; margin-bottom: 0.1rem; }
    .act-text p { font-size: 0.8rem; color: var(--secondary); }
    .act-text span { font-size: 0.7rem; color: var(--secondary); opacity: 0.6; }

    .bottom-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
    .info-item { padding: 1.5rem !important; }
    .info-item h3 { margin-bottom: 1rem; font-size: 1rem; }
    .chart-wrapper-small { height: 160px; }
    .notes-list { list-style: none; display: flex; flex-direction: column; gap: 0.8rem; }
    .notes-list li { font-size: 0.85rem; color: var(--secondary); border-bottom: 1px solid var(--border); padding-bottom: 0.4rem; }

    .btn-sm { padding: 0.5rem 1rem; font-size: 0.8rem; }

    @media (max-width: 1000px) { .charts-grid, .bottom-grid { grid-template-columns: 1fr; } }
</style>
@endsection