@extends('dashboard.dashboard')


@section('content')
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-black-800 leading-tight">
                {{ __('Role / Create') }}
            </h2>
            <a href="{{ route('roles.index') }}"
                class="bg-slate-700  border text-decoration-none text-sm text-white rounded-md px-3 py-2 hover:bg-slate-600">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="" class="text-sm font-medium text-black">Name</label>
                            <div class="my-3">
                                <input type="text" value="{{ old('name') }}" name="name"
                                    class="border-gray-300 text-black shadow-sm w-1/2 rounded-lg">
                                @error('name')
                                    <p class="text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="my-5 grid grid-cols-4 gap-2">
                            @foreach ($permissions as $permission)
                                <div class="flex items-center px-2">
                                    <input id="permission-{{ $permission->id }}" type="checkbox" class="rounded "
                                        value="{{ $permission->name }}" name="permission[]">
                                    <label for="permission-{{ $permission->id }}"
                                        class="text-sm font-medium text-black px-2">{{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach 
                            @error('permissions')
                                <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                            class="bg-slate-700 border text-sm text-white rounded-md px-3 py-2 my-3 hover:bg-slate-600">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
