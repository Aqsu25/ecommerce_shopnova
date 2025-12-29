@extends('dashboard.dashboard')

@section('content')
<div class="overflow-x-auto mt-6 px-4">
    <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">

        <!-- TABLE HEADER -->
        <thead class="bg-gray-800 text-white text-left">
            <tr>
                <th class="p-4 text-sm font-medium">Customer Name</th>
                <th class="p-4 text-sm font-medium">Address</th>
                <th class="p-4 text-sm font-medium">Phone</th>
                <th class="p-4 text-sm font-medium">Product</th>
                <th class="p-4 text-sm font-medium">Image</th>
                <th class="p-4 text-sm font-medium">Status</th>
                <th class="p-4 text-sm font-medium">PDF</th>
            </tr>
        </thead>

        <!-- TABLE BODY -->
        <tbody class="text-gray-700">
            @foreach ($orders as $order)
                @php
                    $itemsCount = $order->order_items->count();
                @endphp

                @foreach ($order->order_items as $index => $item)
                    <tr class="even:bg-blue-50 hover:bg-blue-100 transition">

                        <!-- CUSTOMER NAME -->
                        @if($index === 0)
                            <td class="p-4 font-medium text-gray-900 text-capitalize" rowspan="{{ $itemsCount }}">
                                {{ $order->user->name }}
                            </td>
                            <td class="p-4 text-gray-700 max-w-xs break-words" rowspan="{{ $itemsCount }}">
                                {{ $order->address }}
                            </td>
                            <td class="p-4 text-gray-700" rowspan="{{ $itemsCount }}">
                                {{ $order->phone_number }}
                            </td>
                        @endif

                        <!-- PRODUCT NAME -->
                        <td class="p-4 font-semibold text-gray-800">
                            {{ $item->product->name }}
                        </td>

                        <!-- PRODUCT IMAGE -->
                        <td class="p-4">
                            <img src="{{ asset('uploads/products/' . $item->product->image) }}"
                                 class="w-12 h-12 rounded border object-cover"
                                 alt="Product Image">
                        </td>

                        <!-- STATUS (ONLY FIRST ROW PER ORDER) -->
                        @if($index === 0)
                            <td class="p-4 align-top text-center" rowspan="{{ $itemsCount }}">
                                <form action="{{ route('order.status', $order->id) }}" method="POST" class="flex flex-col gap-2 items-center">
                                    @csrf
                                    <select name="status" class="form-control text-sm">
                                        <option selected>{{ $order->order_Status->first()->status ?? 'Pending' }}</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary mt-1" onclick="return confirm('Are you sure?')">
                                        Update
                                    </button>
                                </form>
                            </td>

                            <!-- PDF DOWNLOAD (ONLY FIRST ROW PER ORDER) -->
                            <td class="p-4 align-top text-center" rowspan="{{ $itemsCount }}">
                                <a href="{{ route('download.pdf', $order->id) }}" class="btn btn-sm btn-danger">
                                    Download
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
        </tbody>

    </table>
</div>

<!-- PAGINATION -->
<div class="mt-4 px-4">
    {{ $orders->links() }}
</div>
@endsection
