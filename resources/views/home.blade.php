@extends('header_footer')
@section('index')

        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Latest Products
                </h2>
            </div>
            <div class="row justify-content-center gap-4">
                @foreach ($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="box  ">
                            <a href="{{ route('product.detail',$product->id) }}">
                                <div class="img-box">
                                    <img src="{{ asset('uploads/products/' . $product->image) }}" alt="Product-Image"
                                        class="w-20 h-20">
                                </div>
                                <div class="detail-box">
                                    <h6 class="">
                                        {{ $product->name }}
                                    </h6>
                                    <h6>
                                        Price
                                        <span>
                                            {{ $product->price }}
                                        </span>
                                    </h6>
                                </div>
                                <div class="new">
                                    <span>
                                        New
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="btn-box">
                <a href="{{route('viewallproducts')}}">
                    View All Products
                </a>
            </div>
        </div>

@endsection