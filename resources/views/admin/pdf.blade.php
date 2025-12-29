<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <title>Order Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .invoice-box {
            max-width: 700px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            padding: 10px;
            vertical-align: middle;
        }

        table tr td:first-child {
            font-weight: bold;
            width: 35%;
            color: #555;
        }

        .product-img {
            width: 120px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        .status {
            padding: 6px 14px;
            border-radius: 20px;
            color: #fff;
            font-size: 14px;
            display: inline-block;
        }

        .pending {
            background: #f0ad4e;
        }

        .delivered {
            background: #5cb85c;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 13px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <h2>Order Summary</h2>

        <table>
            @foreach ($data->order_items as $item)
                <tr>
                    <td>Customer Name</td>
                    <td>{{ $data->user->name }}</td>
                </tr>

                <tr>
                    <td>Address</td>
                    <td>{{ $data->address }}</td>
                </tr>

                <tr>
                    <td>Phone Number</td>
                    <td>{{ $data->phone_number }}</td>
                </tr>

                <tr>
                    <td>Product Title</td>
                    <td>{{ $item->product->name }}</td>
                </tr>

                <tr>
                    <td>Product Image</td>
                    <td>
                        <img src="{{ public_path('uploads/products/' . $item->product->image) }}" class="product-img"
                            alt="Product">
                    </td>
                </tr>

                <tr>
                    <td>Product Price</td>
                    <td>Rs {{ $item->product->price }}</td>
                </tr>

                <tr>
                    <td>Order Status</td>
                    <td>
                        <span
                            class="status {{ ($data->order_Status->first()->status ?? 'pending') == 'delivered' ? 'delivered' : 'pending' }}">
                            {{ ucfirst($data->order_Status->first()->status ?? 'pending') }}
                        </span>
                    </td>
                </tr>
                <br>
                <hr>
            @endforeach
        </table>
        <h6>Total Price:
            <span class="text-danger fw-bond">
                {{ $data->total_price }}
            </span>
        </h6>

        <div class="footer">
            Generated on {{ date('d M Y') }}
        </div>
    </div>

</body>

</html>









</body>

</html>
