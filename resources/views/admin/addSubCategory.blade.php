@extends('dashboard.dashboard')


{{-- Section --}}
@section('content')
    <x-message></x-message>
    <div class="container-fluid text-black">
        <form action="{{ route('subcategory.store') }}" method="POST">
            @csrf
            <div class="w-full text-black md:w-full px-3 mb-6 md:mb-3 mt-3">
                <label for="parent_id" class="text-black fs-5">Parent Category:</label>
                <select class="form-control py-2 text-black border-gray-300  shadow-sm w-1/2 rounded-lg" name="category_id">
                    <option selected value="">Select Option</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-full px-3 mb-6 md:mb-3 mt-5">
                <label for="name" class="text-black fs-5">Sub-Category
                    :</label>
                <input type="text" name="name" placeholder="Enter Category Name"
                    class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-4 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold mt-2 py-2 px-4 rounded">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection
