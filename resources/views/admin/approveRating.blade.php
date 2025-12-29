@extends('admin.adminmaindesign')

{{-- Section --}}
@section('Product_Rating')
    <x-message></x-message>

    {{-- <div class="w-50 ms-auto">
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
    </div> --}}


    <div class="overflow-x-auto mt-5 flex justify-center items-center">
        <table class="min-w-full bg-white table-auto">
            <thead class="bg-gray-800 whitespace-nowrap">
                <tr>
                    <th class="p-4 text-left text-sm font-medium text-white">
                        #Id
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-white">
                        Product_Name
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-white">
                        Rating
                    </th>

                    <th class="p-4 text-left text-sm font-medium text-white">
                        Comment
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-white">
                        Rated by
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-white">
                        Status
                    </th>

                </tr>
            </thead>

            <tbody class="whitespace-nowrap">
                @if ($product_ratings->isNotEmpty())
                    @foreach ($product_ratings as $ratings)
                        <tr class="even:bg-blue-50">
                            <td class="p-4 text-[15px] text-slate-900 font-medium">
                                {{ $ratings->id }}
                            </td>
                            <td class="p-4 text-[15px] text-slate-600 font-medium">
                                {{ $ratings->product_name }}
                            </td>
                            <td class="p-4 text-[15px] text-slate-600 font-medium">
                                {{ $ratings->rating }}
                            </td>
                            <td class="p-4 text-[15px] text-slate-600 font-medium">
                                {{ $ratings->comment }}
                            </td>
                            <td class="p-4 text-[15px] text-slate-600 font-medium">
                                {{ $ratings->user->name }}
                            </td>

                            <td class="p-4">
                                @if ($ratings->status == 1)
                                    <a href="{{ route('status.change', $ratings->id) }}"
                                        onclick="return confirm('Are You Sure You Want To Change The Status?')">
                                        <i class="fa-solid fa-check"></i>
                                    </a>
                                @else
                                    <a href="{{ route('status.change', $ratings->id) }}"
                                        onclick="return confirm('Are You Sure You Want To Change The Status?')">
                                        <i class="fa-solid fa-xmark text-danger"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <p class="my-3">
        {{ $product_ratings->links() }}
    </p>
@endsection
