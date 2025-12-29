@extends('dashboard.dashboard')

@section('content')
    <x-message></x-message>
    <h1 class="text-center text-black my-2">Parent-Category</h1>
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default text-black my-2">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-black my-2 bg-neutral-secondary-medium border-b border-t border-default-medium">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Category ID
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Category
                    </th>
                    <th scope="col" class="text-center px-6 py-3 font-medium">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm text-black my-2 bg-neutral-secondary-medium border-b border-t border-default-medium">
                @foreach ($categories as $category)
                    <tr class="bg-neutral-primary-soft border-b border-default">
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            {{ $category->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $category->name }}
                        </td>
                        <td class="px-6 py-4 text-center flex justify-center items-center gap-3">
                            <a href="{{ route('admin.edit', $category->id) }}">
                                <i class="fas fa-edit text-blue-700"></i>

                            </a>
                            <form action="{{ route('admin.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <i class="fa-solid fa-trash-can text-red-500"></i>

                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
