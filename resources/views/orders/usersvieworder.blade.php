<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full bg-white table-auto">
                        <thead class="bg-gray-800 whitespace-nowrap">
                            <tr>
                                <th class="p-4 text-left text-sm font-medium text-white">
                                    Name
                                </th>
                                <th class="p-4 text-left text-sm font-medium text-white">
                                    Address
                                </th>
                                <th class="p-4 text-left text-sm font-medium text-white">
                                    Product-Title
                                </th>
                                <th class="p-4 text-left text-sm font-medium text-white">
                                    Image
                                </th>
                                <th class="p-4 text-left text-sm font-medium text-white">
                                    Quantity
                                </th>
                                <th class="p-4 text-left text-sm font-medium text-white">
                                    Status
                                </th>

                            </tr>
                        </thead>

                        <tbody class="whitespace-nowrap">
                            @if ($orders->count() > 0)
                                @foreach ($orders as $order)
                                    @foreach ($order->order_items as $item)
                                        <tr class="even:bg-blue-50">
                                            <td class="p-4 text-[15px] text-slate-900 font-medium">
                                                {{ $order->user->name }}
                                            </td>
                                            <td class="p-4 text-[15px] text-slate-600 font-medium text-wrap">
                                                {{ $order->address }}
                                            </td>

                                            <td class="p-4 text-[15px] text-slate-600 font-medium ">
                                                <p>{{ $item->product->name }}
                                                </p>
                                            </td>

                                            <td class="p-4 text-[15px] text-slate-600 font-medium">
                                                <img src="{{ asset('uploads/products/' . $item->product->image) }}"
                                                    class="w-20 h-50 mb-1" alt="Product Image">
                                            </td>
                                            <td class="p-4 text-[15px] text-slate-600 font-medium ">
                                                <p>
                                                    {{ $item->quantity }}
                                                </p>
                                            </td>
                                            <td class="p-4 text-[15px] text-slate-600 font-medium">
                                                {{ $order->order_Status->first()->status ?? 'pending' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                <td class="p-4 text-[15px] text-slate-600 font-medium text-end">
                                    <a href="{{ route('users.pdf', $order->id) }}"
                                        class="btn btn-danger text-end w-100">Download
                                        PDF</a>
                                </td>
                            @else
                                <td colspan="6" class="my-3 text-danger text-center">Do not order anything now.</td>

                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
