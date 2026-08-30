@extends('layouts.app') @section('content')
    <h1 class="page-title">
        Dashboard</h1>
    <div class="breadcrumb-lite">Home <span>/</span> Dashboard</div>
    <div class="row g-3 mt-1">
        @foreach ([['Furniture', $stats['furnitures'], 'lamp', 'icon-green'], ['Categories', $stats['categories'], 'grid', 'icon-purple'], ['Customers', $stats['customers'], 'people', 'icon-blue'], ['Orders', $stats['orders'], 'bag-check', 'icon-red']] as $c)
            <div class="col-6 col-xl">
                <div class="card stat-card">
                    <div class="d-flex justify-content-between">
                        


                        <div class="stat-icon {{ $c[3] }}"><i class="bi bi-{{ $c[2] }}"></i></div>
                    </div><small class="trend">+12 this month</small>
                </div>
            </div>
        @endforeach
        <div class="col-12 col-xl">
            <div class="card stat-card sales-card">
                <div class="stat-label">Total Sales</div>
                <div class="stat-value">${{ number_format($stats['sales'], 2) }}</div><small>This month</small>
            </div>
        </div>
    </div>
    <div class="row g-3 mt-1">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header-clean"><b>Monthly Sales Overview</b></div>
                <div class="card-body-clean"><canvas id="salesChart"></canvas></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header-clean"><b>Low Stock Alert</b></div>
                <div class="card-body-clean">
                    @forelse($lowStockItems as $item)
                        <div class="d-flex justify-content-between order-row py-3">
                            <div><b>{{ $item->name }}</b><small class="d-block text-muted">SKU:
                                    {{ $item->furniture_code }}</small></div><span
                                class="status status-low">{{ $item->quantity }} left</span>
                    </div>@empty<p class="text-muted">All stock levels are healthy.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header-clean"><b>Recent Orders</b></div>
        <div class="table-responsive p-2">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>ORDER</th>
                        <th>CUSTOMER</th>
                        <th>DATE</th>
                        <th>TOTAL</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $o)
                        <tr>
                            <td class="text-primary">#{{ $o->order_number }}</td>
                            <td>{{ $o->customer->name }}</td>
                            <td>{{ $o->created_at->format('d M Y') }}</td>
                            <td>${{ number_format($o->total, 2) }}</td>
                            <td><span class="status status-completed">{{ ucfirst($o->status) }}</span></td>
                    </tr>@empty<tr>
                            <td colspan="5" class="text-center text-muted">No orders recorded.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endsection @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('salesChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    data: @json($monthlySales),
                    borderColor: '#246bfd',
                    backgroundColor: '#246bfd18',
                    fill: true,
                    tension: .4
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        })
    </script>
@endpush
