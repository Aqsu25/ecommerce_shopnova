<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background: #f3f4f6;
            padding: 30px;
        }

        .invoice-box {
            max-width: 750px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
            color: #111827;
        }

        .sub-title {
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 25px;
        }

        .info-table,
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 8px;
            font-size: 14px;
        }

        .info-table td:first-child {
            font-weight: bold;
            width: 30%;
            color: #374151;
        }

        .product-table th,
        .product-table td {
            border: 1px solid #e5e7eb;
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }

        .product-table th {
            background: #f9fafb;
            font-weight: bold;
        }

        .product-img {
            width: 60px;
            border-radius: 6px;
        }

        .status {
            padding: 6px 14px;
            border-radius: 20px;
            color: #fff;
            font-size: 13px;
            display: inline-block;
        }

        .pending {
            background: #f59e0b;
        }

        .delivered {
            background: #16a34a;
        }

        .total-box {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
        }
    </style>
</head>

<body>

    <div class="invoice-box">
        <h2>Order Invoice</h2>
        <div class="sub-title">Order ID: #{{ $data->id }}</div>

        <!-- CUSTOMER INFO -->
        <table class="info-table">
            <tr>
                <td>Name</td>
                <td>{{ $data->user->name }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $data->address }}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>{{ $data->phone_number }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <span
                        class="status {{ ($data->order_Status->first()->status ?? 'pending') == 'delivered' ? 'delivered' : 'pending' }}">
                        {{ ucfirst($data->order_Status->first()->status ?? 'pending') }}
                    </span>
                </td>
            </tr>
        </table>

        <!-- PRODUCT LIST -->
        <table class="product-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->order_items as $item)
                    <tr>
                        <td>
                            <img src="{{ public_path('uploads/products/' . $item->product->image) }}" class="product-img">
                        </td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->product->price }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- TOTAL -->
        <div class="total-box">
            Total Amount: Rs {{ number_format($data->total_price) }}
        </div>

        <div class="footer">
            Thank you for shopping with us ❤️ <br>
            Generated on {{ date('d M Y') }}
        </div>
    </div>

</body>

</html>
