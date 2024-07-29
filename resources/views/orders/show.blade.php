@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order Details</h1>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <th>User</th>
            <td><pre>{{ json_encode($order->user, JSON_PRETTY_PRINT) }}</pre></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><pre>{{ json_encode($order->address, JSON_PRETTY_PRINT) }}</pre></td>
        </tr>
        <tr>
            <th>Cart</th>
            <td><pre>{{ json_encode($order->cart, JSON_PRETTY_PRINT) }}</pre></td>
        </tr>
        <tr>
            <th>Subtotal</th>
            <td>{{ number_format($order->order['subTotal'], 2) }}</td>
        </tr>
        <tr>
            <th>Discount</th>
            <td>{{ $order->order['discountCodes']['percent'] }}%</td>
        </tr>
        <tr>
            <th>Code</th>
            <td>{{ $order->order['discountCodes']['code'] }}</td>
        </tr>
        <tr>
            <th>Total</th>
            @php
                $subTotal = $order->order['subTotal'] ?? 0;
                $discountPercent = $order->order['discountCodes']['percent'] ?? 0;
                $total = $subTotal - ($subTotal * ($discountPercent / 100));
            @endphp
            <td>{{ number_format($total, 2) }}</td>
        </tr>
        <tr>
            <th>Items</th>
            <td>
                <ul>
                    @foreach ($items as $item)
                    @php
                        $photos = json_decode($item->photos);
                        $firstPhoto = $photos[0] ?? null;
                    @endphp
                        <li>
                            <div>
                                Item ID: {{ $item->id }}, Name: {{ $item->name }}, Price: ${{ number_format($item->price, 2) }}
                            </div>
                            @if($firstPhoto)
                                <img src="{{ asset('storage/' . $firstPhoto) }}" alt="" style="width: 150px; height: 150px;">
                            @endif
                        </li>
                    @endforeach
                </ul>
            </td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $order->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $order->updated_at }}</td>
        </tr>
    </table>
    <div class="mt-3">
        <form action="{{ route('genrate.orders', $order->id) }}" method="POST" target="_blank">
            @csrf
            <button type="submit" class="btn btn-success">Generate PDF</button>
        </form>
        <a href="{{ route('orders.index') }}" class="btn btn-primary">Back to Orders</a>
    </div>
</div>
@endsection
