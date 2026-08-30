@extends('layouts.app') @section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h1 class="page-title">Order {{ $order->order_number }}</h1>
            <div class="breadcrumb-lite">Customer: {{ $order->customer->name }}</div>
        </div><a class="btn btn-soft" href="{{ route('orders.invoice', $order) }}"><i class="bi bi-printer"></i> Invoice</a>
    </div>
    <div class="card mt-3">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>ITEM</th>
                        <th>PRICE</th>
                        <th>QTY</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->furniture->name }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->line_total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-end p-3"><b>Total: ${{ number_format($order->total, 2) }}</b></div>
    </div>
@endsection
