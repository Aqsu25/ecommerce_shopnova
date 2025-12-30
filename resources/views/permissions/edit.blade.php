@extends('dashboard.dashboard')


@section('content')
    


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-black-800 leading-tight">
                {{ __('Permission / Edit') }}
            </h2>
            <a href="{{ route('permissions.index') }}"
                class="bg-blue-700  border text-decoration-none my-3 text-sm text-white rounded-md px-3 py-2 hover:bg-blue-600">Back</a>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="" class="text-sm font-medium text-black">Name</label>
                            <div class="my-3">
                                <input type="text" value="{{ old('name',$permission->name) }}" name="name"
                                    class="border-gray-300 text-black shadow-sm w-1/2 rounded-lg">
                                @error('name')
                                    <p class="text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit"
                                class="bg-blue-700 border text-sm text-white rounded-md px-3 py-2 my-3 hover:bg-blue-600">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
