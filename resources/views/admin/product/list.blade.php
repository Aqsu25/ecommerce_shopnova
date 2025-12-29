@extends('dashboard.dashboard')

{{-- Section --}}
@section('content')
    <x-message></x-message>

    <div class="w-50 ms-auto">
        <form action="{{ route('admin.search') }}" method="Post">
            @csrf
            <div class="flex items-center gap-3">
                <input type="search" name="search" placeholder="What are you searching for..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                       focus:outline-none focus:ring-2 focus:ring-blue-500">

                <button type="submit"
                    class="px-6 py-2 bg-blue-500 text-white font-semibold 
                       rounded-lg hover:bg-blue-600 transition duration-200">
                    Search
                </button>
            </div>
        </form>
    </div>


    <div class="overflow-x-auto mt-5 flex justify-center items-center">
        <table class="min-w-full bg-white table-auto">
            <thead class="bg-gray-800 whitespace-nowrap">
                <tr>
                    <th class="p-4 text-left text-sm font-medium text-white">
                        Name
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-white">
                        Image
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-white">
                        Price
                    </th>

                    <th class="p-4 text-left text-sm font-medium text-white">
                        Quantity
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-white">
                        Category
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-white">
                        Sub-Category
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-white">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="whitespace-nowrap">
                @foreach ($products as $product)
                    <tr class="even:bg-blue-50">
                        <td class="p-4 text-[15px] text-slate-900 font-medium">
                            {{ $product->name }}
                        </td>
                        <td class="p-4 text-[15px] text-slate-600 font-medium">
                            <img src="{{ asset('uploads/products/' . $product->image) }}" class="w-10 h-10"
                                alt="Product Image">
                        </td>
                        <td class="p-4 text-[15px] text-slate-600 font-medium">
                            {{ $product->price }}
                        </td>
                        <td class="p-4 text-[15px] text-slate-600 font-medium">
                            {{ $product->stock_quantity }}
                        </td>
                        <td class="p-4 text-[15px] text-slate-600 font-medium">
                            {{ $product->category->name }}
                        </td>
                        <td class="p-4 text-[15px] text-slate-600 font-medium">
                            {{ $product->sub_category->name }}
                        </td>

                        <td class="p-4">
                            <div class="flex items-center">
                                <button class="mr-3 cursor-pointer" title="Edit">
                                    <a href="{{ route('products.edit', $product->id) }}">
                                        <i class="fas fa-edit text-blue-700"></i>
                                    </a>
                                </button>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fa-solid fa-xmark text-red-500"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <p class="my-3">
        {{ $products->links() }}
    </p>
@endsection
