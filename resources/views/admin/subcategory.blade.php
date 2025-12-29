@extends('dashboard.dashboard')

@section('content')
    <x-message></x-message>
    <h1 class="text-center text-black">Sub-Categories</h1>
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default text-black">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-black bg-neutral-secondary-medium border-b border-t border-default-medium">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Category ID
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Parent-Category
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Sub-Category
                    </th>

                    <th scope="col" class="text-center px-6 py-3 font-medium">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm text-black bg-neutral-secondary-medium border-b border-t border-default-medium">
                @foreach ($subcategories as $subcategorie)
                    <tr class="bg-neutral-primary-soft border-b border-default">
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            {{ $subcategorie->id }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            @if ($subcategorie->category()->count() > 0)
                                {{ $subcategorie->category->name }}
                            @endif
                        </th>
                        <td class="px-6 py-4">
                            {{ $subcategorie->name }}
                        </td>
                        <td class="px-6 py-4 text-center flex justify-center items-center gap-3">
                            <a href="{{ route('subcategory.edit', $subcategorie->id) }}">
                                <i class="fas fa-edit text-blue-700"></i>
                            </a>
                            <form action="{{ route('subcategory.destroy', $subcategorie->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <i class="fa-solid fa-xmark text-red-500"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
