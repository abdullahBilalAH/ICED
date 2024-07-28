<!-- resources/views/orders/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Orders</h1>
    <div class="mb-3">
        <a href="{{ route('orders.index', ['sort_direction' => 'asc']) }}" class="btn btn-primary">Sort by Subtotal Ascending</a>
        <a href="{{ route('orders.index', ['sort_direction' => 'desc']) }}" class="btn btn-primary">Sort by Subtotal Descending</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Subtotal</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                @php
                    $orderData = $order->order;
                    $subTotal = $orderData['subTotal'] ?? 0;
                    $discountPercent = $orderData['discountCodes']['percent'] ?? 0;
                    $total = $subTotal - ($subTotal * ($discountPercent / 100));
                @endphp
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ number_format($subTotal, 2) }}</td>
                    <td>{{ number_format($total, 2) }}</td>
                    <td><a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">Show</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
