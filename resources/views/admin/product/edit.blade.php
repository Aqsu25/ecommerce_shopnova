@extends('dashboard.dashboard')

{{-- Section --}}
@section('content')
    <div class="container-fluid text-black">
        <form class="w-full max-w-lg" action="{{ route('products.update', $product->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class=" md:w-full px-3 mt-5">

                <div class="w-full md:w-full px-3 ">
                    <label for="name" class="text-black fs-5">Name
                        :</label>
                    <input type="text" name="name" placeholder="Enter Category Name"
                        value="{{ old('name', $product->name) }}"
                        class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-black">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="w-full md:w-full px-3 my-3 ">
                    @if ($product->image)
                        <label for="image" class="text-gray fs-5">Current Image
                            :</label>
                        <img src="{{ asset('uploads/products/' . $product->image) }}" alt="Product Image"
                            class="w-10 h-20 mx-auto">
                    @endif
                    <label for="image" class="text-black fs-5">Image
                        :</label>
                    <input name="image"
                        class="form-control cursor-pointer bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full shadow-xs placeholder:text-body"
                        aria-describedby="file_input_help" id="file_input" type="file" name="image">

                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="flex mt-2 px-3">
                <div class="w-full md:w-full px-3 ">
                    <label for="category_id" class="text-black fs-5">Category
                        :</label>
                    <select name="category_id" class="form-control text-black border-gray-300  shadow-sm w-2/2 rounded-lg"
                        id="category">
                        <option selected value="">Select Option</option>
                        @if ($categories->isNotEmpty())
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('category')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full md:w-full px-3 ">
                    <label for="sub_category_id" class="text-black fs-5">SubCategory
                        :</label>
                    <select id="sub_category_id" name="sub_category_id"
                        class="form-control text-black border-gray-300  shadow-sm w-2/2 rounded-lg">
                        <option selected value="">Select Option</option>
                    </select>
                    @error('sub_category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="flex mt-4 px-3
                ">
                <div class="w-full md:w-full px-3 ">
                    <label for="price" class="text-black fs-5">Price
                        :</label>
                    <input type="text" name="price" value="{{ old('price', $product->price) }}"
                        class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-black">
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full md:w-full px-3">
                    <label for="stock_quantity" class="text-black fs-5"> Quantity
                        :</label>
                    <input type="number" name="stock_quantity"
                        value="{{ old('stock_quantity', $product->stock_quantity) }}"
                        class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-black">
                    @error(' stock_quantity')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="w-full md:w-full px-3">
                <label for="description" class="text-black px-3 fs-5"> Description
                    :</label>
                <textarea type="text" name="description" placeholder="Enter  Description" id="" cols="30"
                    rows="10" value="{{ old('description', $product->description) }}"
                    class="form-control m-0 appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-black">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full md:w-full px-3 mb-6 md:mb-3 mt-2">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded py-3 px-4 mb-3 w-full  rounded">
                    Submit
                </button>
            </div>
    </div>
    </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            var category_id = $("#category").val();
            var sub_category_id = "{{ old('sub_category_id', $product->sub_category_id) }}";

            function loadSubCategories(category_id, selected_id = null) {
                if (category_id) {
                    $("#sub_category_id").html('<option>Loading SubCategory...</option>');
                    $.ajax({
                        url: '/products-subcategory/' + category_id,
                        type: 'get',
                        dataType: 'json',
                        success: function(data) {
                            $("#sub_category_id").html('<option value="">Select SubCategory</option>');
                            $.each(data, function(key, subcategory) {
                                var selected = selected_id == subcategory.id ? 'selected' : '';
                                $("#sub_category_id").append('<option value="' + subcategory
                                    .id +
                                    '">' +
                                    subcategory.name + '</option>');
                            });
                        }

                    })
                } else {
                    $("#sub_category_id").html('<option value="">Select SubCategory</option>');

                }
            }
            loadSubCategories(category_id, sub_category_id);

            $("#category").change(function() {
                var category_id = $(this).val();
                loadSubCategories(category_id);

            });

        });
    </script>
@endsection
