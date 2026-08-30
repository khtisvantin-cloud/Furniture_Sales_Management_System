@extends('layouts.app') @section('content')
    <div class="card">
        <div class="card-body-clean">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="page-title">FURNITURE</h1>
                    <p>Sales Management</p>
                </div>
                <div class="text-end">
                    <h3>INVOICE</h3><b>#{{ $order->order_number }}</b>
                </div>
            </div>
            <hr>
            <p><b>Bill to:</b> {{ $order->customer->name }}<br>{{ $order->customer->address }}</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $i)
                        <tr>
                            <td>{{ $i->furniture->name }}</td>
                            <td>${{ number_format($i->price, 2) }}</td>
                            <td>{{ $i->quantity }}</td>
                            <td>${{ number_format($i->line_total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h4 class="text-end">Total: ${{ number_format($order->total, 2) }}</h4><button onclick="print()"
                class="btn btn-primary no-print">Print Invoice</button>
        </div>
    </div>
@endsection
