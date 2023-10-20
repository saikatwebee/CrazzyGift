@extends('layouts.master')

@section('title', $title)

@section('content')
    <!-- Your page-specific content goes here -->
    <section class="loginRegister container">
        <div class="breadcrumb">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </div>
        </div>

        <div class="ProductInfo">
            <div class="titleProducts">
                <h3>{{$heading}}</h3>
            </div>
            <div class="sortOption d-flex">
                <select id="sort-select" class="sort-select">
                    <option value="sort by">Sort by</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                </select>

                <div class="filterBtn mx-3">
                    <img src="{{ asset('images/icons/filter.png') }}" alt="filter">

                </div>
            </div>
            <div class="popup-overlay">
                <div class="popup-container">
                    <button class="closeBtn"><i class="fa-solid fa-xmark"></i></button>
                    <div class="popup-content">
                        <h2>Filter By</h2>
                        <p>Price</p>
                        <p>Product</p>
                        <p>Date</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="row my-3">

            @foreach ($products as $product)
                <div class="col-lg-3 my-3">
                    <div>
                        <div class="slide-image" data-id="{{ url('') . '/productDetails/' . $product->id }}" onclick="redirectToCart(event)">
                            <img src="{{($product->product_image) ? asset('/products').'/'.$product->product_image : asset('/products/dummyProduct.jpg') }}" alt="Slide 1" class="slide" data-id="{{ url('') . '/productDetails/' . $product->id }}" onclick="redirectToCart(event)">
                            <a href="{{ url('') . '/productDetails/' . $product->id }}" class="overlay2">
                                <button>Quick View</button>
                            </a>
                        </div>
                        <div class="slide-caption">
                            <h2>{{ $product->title }}</h2>
                            <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $product->price }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
           
                {{ $products->links() }} 
            
        </div>
       
        <script>
            function redirectToCart(event){
                redirectUrl = event.target.getAttribute('data-id');
                console.log(redirectUrl);
                window.location.href=redirectUrl;
            }
        </script>
    </section>
   

@endsection
