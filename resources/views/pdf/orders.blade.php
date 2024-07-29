<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>
    <div>
        <h3>Order Details</h3>
        <table border="1" cellspacing="0" cellpadding="10">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $order->id }}</td>
                </tr>
                <tr>
                    <th>User</th>
                    <td>
                        <table border="1" cellspacing="0" cellpadding="5">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $order->user['id'] ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $order->user['name'] ?? 'N/A' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>
                        <table border="1" cellspacing="0" cellpadding="5">
                            <tbody>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $order->address['country'] ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Street Address</th>
                                    <td>{{ $order->address['streetAddress'] ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Apartment</th>
                                    <td>{{ $order->address['apartment'] ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $order->address['city'] ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td>{{ $order->address['state'] ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Postcode</th>
                                    <td>{{ $order->address['postcode'] ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $order->address['phone'] ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $order->address['email'] ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Order Notes</th>
                                    <td>{{ $order->address['orderNotes'] ?? 'N/A' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th>Cart</th>
                    <td>
                        <table border="1" cellspacing="0" cellpadding="5">
                            <tbody>
                                @if(is_array($order->cart) || is_object($order->cart))
                                    @foreach ($order->cart as $itemId => $item)
                                        <tr>
                                            <th>Item ID</th>
                                            <td>{{ $itemId }}</td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $item['name'] ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Quantity</th>
                                            <td>{{ $item['quantity'] ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td>${{ number_format($item['price'] ?? 0, 2) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2">N/A</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </td>
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
                                <li>
                                    <div>
                                        Item ID: {{ $item->id }}, Name: {{ $item->name }}, Price: ${{ number_format($item->price, 2) }}
                                    </div>
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
            </tbody>
        </table>
    </div>
    <h1>COST: ${{ number_format($total, 2) }}</h1>

</body>
</html>
