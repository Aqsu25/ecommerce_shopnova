@extends('dashboard.dashboard')

{{-- Section --}}
@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="w-full md:w-full px-3 mb-6 md:mb-3 mt-5">
                <label for="name" class="text-black fs-5">Edit-Category
                    :</label>
                <input type="text" name="name" placeholder="Enter Category Name"
                    value="{{ old('name', $category->name) }}"
                    class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-4 px-4 my-3 leading-tight focus:outline-none focus:bg-white">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold my-2 py-2 px-4 rounded">
                    Submit</button>
            </div>
        </form>
    </div>
@endsection
