@extends('layouts.app') @section('content')
    <div class="d-flex justify-content-between">
        <h1 class="page-title">Orders</h1><a href="{{ route('orders.create') }}" class="btn btn-primary">+ Create Order</a>
    </div>
    <div class="card mt-3">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>ORDER #</th>
                        <th>CUSTOMER</th>
                        <th>DATE</th>
                        <th>TOTAL</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>${{ number_format($order->total, 2) }}</td>
                            <td><span class="status status-completed">{{ ucfirst($order->status) }}</span></td>
                            <td><a class="btn btn-sm btn-soft" href="{{ route('orders.show', $order) }}">View</a></td>
                    </tr>@empty<tr>
                            <td colspan="6" class="text-center p-4 text-muted">No orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
