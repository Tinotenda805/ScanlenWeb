@extends('admin.app')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/analytics.css')}}">
@endpush


@section('content')
    <div class="analytics-dashboard">
        <!-- Header -->
        <div class="dashboard-header">
            <div>
                <h1 class="dashboard-title"><i class="fa-solid fa-chart-column"></i> Analytics Dashboard</h1>
                <p class="dashboard-subtitle">Track your website performance and visitor behavior</p>
            </div>
            
            <!-- Date Range Selector -->
            <div class="date-range-selector">
                <select class="form-select" id="dateRange" onchange="window.location.href='?range='+this.value">
                    <option value="1" {{ $dateRange == '1' ? 'selected' : '' }}>Last 24 Hours</option>
                    <option value="7" {{ $dateRange == '7' ? 'selected' : '' }}>Last 7 Days</option>
                    <option value="30" {{ $dateRange == '30' ? 'selected' : '' }}>Last 30 Days</option>
                    <option value="90" {{ $dateRange == '90' ? 'selected' : '' }}>Last 90 Days</option>
                </select>
                <button class="btn btn-export" onclick="exportData()">
                    <i class="fa fa-download"></i> Export
                </button>
            </div>
        </div>

        <!-- Overview Stats -->
        <div class="stats-grid">
            <div class="stat-card visitors">
                <div class="stat-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ number_format($stats['total_visitors']) }}</h3>
                    <p>Total Visitors</p>
                    <span class="stat-change {{ $stats['visitors_change'] >= 0 ? 'positive' : 'negative' }}">
                        <i class="fa-solid fa-arrow-{{ $stats['visitors_change'] >= 0 ? 'up' : 'down' }}"></i>
                        {{ abs($stats['visitors_change']) }}% vs previous period
                    </span>
                </div>
            </div>

            <div class="stat-card pageviews">
                <div class="stat-icon">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ number_format($stats['total_page_views']) }}</h3>
                    <p>Page Views</p>
                    <span class="stat-info">{{ $stats['avg_pages_per_session'] }} pages/session</span>
                </div>
            </div>

            <div class="stat-card duration">
                <div class="stat-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ gmdate('i:s', $stats['avg_session_duration']) }}</h3>
                    <p>Avg Session Duration</p>
                    <span class="stat-info">minutes:seconds</span>
                </div>
            </div>

            <div class="stat-card bounce">
                <div class="stat-icon">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['bounce_rate'] }}%</h3>
                    <p>Bounce Rate</p>
                    <span class="stat-info">Single page visits</span>
                </div>
            </div>
        </div>

        <!-- Traffic Chart -->
        <div class="chart-container">
            <div class="chart-header">
                <h2>Traffic Overview</h2>
                <div class="chart-legend">
                    <span class="legend-item visitors"><i class="fa-solid fa-circle-dot"></i> Visitors</span>
                    <span class="legend-item views"><i class="fa-solid fa-circle-dot"></i> Page Views</span>
                </div>
            </div>
            <canvas id="trafficChart"></canvas>
        </div>

        <div class="row g-4">
            <!-- Top Pages -->
            <div class="col-lg-8">
                <div class="data-table-card">
                    <h2>Top Pages</h2>
                    <div class="table-responsive">
                        <table class="analytics-table">
                            <thead>
                                <tr>
                                    <th>Page</th>
                                    <th>Views</th>
                                    <th>Unique Visitors</th>
                                    <th>Avg Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topPages as $page)
                                <tr>
                                    <td>
                                        <div class="page-info">
                                            <strong>{{ $page->page_title ?? 'Untitled' }}</strong>
                                            <small>{{ Str::limit($page->url, 50) }}</small>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary">{{ number_format($page->views) }}</span></td>
                                    <td>{{ number_format($page->unique_visitors) }}</td>
                                    <td>{{ gmdate('i:s', $page->avg_time ?? 0) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Device & Browser Stats -->
            <div class="col-lg-4">
                <div class="data-card">
                    <h2>Device Breakdown</h2>
                    <div class="breakdown-list">
                        @foreach($deviceBreakdown as $device)
                        <div class="breakdown-item">
                            <div class="breakdown-label">
                                <i class="fa-solid fa-{{ $device->device_type == 'mobile' ? 'mobile-screen' : ($device->device_type == 'tablet' ? 'tablet' : 'laptop') }}"></i>
                                {{ ucfirst($device->device_type) }}
                            </div>
                            <div class="breakdown-value">{{ $device->count }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="data-card mt-4">
                    <h2>Top Browsers</h2>
                    <div class="breakdown-list">
                        @foreach($browserBreakdown as $browser)
                        <div class="breakdown-item">
                            <div class="breakdown-label">{{ $browser->browser }}</div>
                            <div class="breakdown-value">{{ $browser->count }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Popular Content -->
        <div class="row g-4 mt-4">
            <div class="col-lg-4">
                <div class="data-card">
                    <h2>🔥 Popular Lawyers</h2>
                    <div class="popular-list">
                        @forelse($popularLawyers as $lawyer)
                        <div class="popular-item">
                            <span class="popular-title">{{ $lawyer->content_title }}</span>
                            <span class="popular-count">{{ number_format($lawyer->total_views) }} views</span>
                        </div>
                        @empty
                        <p class="text-muted">No data available</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="data-card">
                    <h2>⚖️ Popular Practice Areas</h2>
                    <div class="popular-list">
                        @forelse($popularExpertise as $expertise)
                        <div class="popular-item">
                            <span class="popular-title">{{ $expertise->content_title }}</span>
                            <span class="popular-count">{{ number_format($expertise->total_views) }} views</span>
                        </div>
                        @empty
                        <p class="text-muted">No data available</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="data-card">
                    <h2>📰 Popular Articles</h2>
                    <div class="popular-list">
                        @forelse($popularArticles as $article)
                        <div class="popular-item">
                            <span class="popular-title">{{ Str::limit($article->content_title, 25) }}</span>
                            <span class="popular-count">{{ number_format($article->total_views) }} views</span>
                        </div>
                        @empty
                        <p class="text-muted">No data available</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Visitors -->
        <div class="data-table-card mt-4">
            <h2>Recent Visitors</h2>
            <div class="table-responsive">
                <table class="analytics-table">
                    <thead>
                        <tr>
                            <th>Visitor</th>
                            <th>Location</th>
                            <th>Device</th>
                            <th>Pages Viewed</th>
                            <th>Duration</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentVisitors as $visitor)
                        <tr>
                            <td>
                                <div class="visitor-info">
                                    <i class="fa-solid fa-circle-user"></i>
                                    <span>{{ $visitor->ip_address }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="location">
                                    @if($visitor->country)
                                        <i class="fa-solid fa-map-pin"></i> {{ $visitor->country }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </td>
                            <td>
                                <span class="device-badge">
                                    <i class="fa-solid fa-{{ $visitor->device_type == 'mobile' ? 'mobile-screen' : 'laptop' }}"></i>
                                    {{ ucfirst($visitor->device_type) }}
                                </span>
                            </td>
                            <td>{{ $visitor->total_pages_viewed }}</td>
                            <td>{{ gmdate('i:s', $visitor->total_time_spent) }}</td>
                            <td>{{ $visitor->started_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Traffic Chart with Law Firm Colors
        const ctx = document.getElementById('trafficChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($trafficData['labels']),
                datasets: [
                    {
                        label: 'Visitors',
                        data: @json($trafficData['visitors']),
                        borderColor: '#861043',
                        backgroundColor: 'rgba(134, 16, 67, 0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 3,
                    },
                    {
                        label: 'Page Views',
                        data: @json($trafficData['views']),
                        borderColor: '#a8154f',
                        backgroundColor: 'rgba(168, 21, 79, 0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 3,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        backgroundColor: '#861043',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#d7d5d0',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: true,
                        boxWidth: 8,
                        boxHeight: 8,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false,
                        },
                        ticks: {
                            color: '#4a4a4a',
                            font: {
                                weight: 500,
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            color: '#4a4a4a',
                            font: {
                                weight: 500,
                            }
                        }
                    }
                }
            }
        });

        function exportData() {
            window.location.href = '/admin/analytics/export?range={{ $dateRange }}';
        }
    </script>
@endsection

{{-- @push('scripts')
    <script src="{{asset('js/analytics-tracker.js')}}"></script>
@endpush --}}