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
                <h3>{{ $heading }}</h3>
            </div>
            <div class="sortOption d-flex">
                <select id="sort-select" class="sort-select">
                    <option value="{{ url('occasions/valentines-day') }}">Sort by</option>
                    <option value="{{ url('occasions/valentines-day?query=price_high_to_low') }}"
                        {{ $query == 'price_high_to_low' ? 'selected' : '' }}> High to Low</option>
                    <option value="{{ url('occasions/valentines-day?query=price_low_to_high') }}"
                        {{ $query == 'price_low_to_high' ? 'selected' : '' }}>Price Low to High</option>
                    <option value="{{ url('occasions/valentines-day?query=latest_product') }}"
                        {{ $query == 'latest_product' ? 'selected' : '' }}>Latest Collection</option>
                </select>

                {{-- <div class="filterBtn mx-3">
                    <img src="{{ asset('images/icons/filter.png') }}" alt="filter">

                </div> --}}
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

        @if(count($products)>0)
        <div class="row my-3">

            @foreach ($products as $product)
                <div class="col-lg-3 my-3">
                    <div class="products" onclick="window.location.href='{{url('/productDetails').'/'.$product->slug}}';">
                        <div class="slide-image" onclick="window.location.href='{{url('/productDetails').'/'.$product->slug}}';">
                            <img src="{{($product->product_image) ? asset('/products').'/'.$product->product_image : asset('/products/dummyProduct.jpg') }}" alt="Slide 1" class="slide"
                            onclick="window.location.href='{{url('/productDetails').'/'.$product->slug}}';">
                            {{-- <a href="{{ url('') . '/productDetails/' . $product->slug}}" class="overlay2">
                                <button>Quick View</button>
                            </a> --}}
                            <button type="button" class="btn btn-sm quick-view" onclick="window.location.href='{{url('/productDetails').'/'.$product->slug}}';">Quick View</button>
                        </div>
                        <div class="slide-caption">
                            <h2>{{ $product->title }}</h2>
                            <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $product->price }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- {{ $products->links() }}  --}}

            @if ($totalRecords > $recordsPerPage)
                <div class="pagination ">
                    @if ($currentPage > 1)
                        <a href="{{ $query != '' ? route('product-valentines', ['page' => $currentPage - 1, 'query' => $query]) : route('product-valentines', ['page' => $currentPage - 1]) }}"
                            class="btn btn-info btn-sm text-white "><i class="fa-solid fa-arrow-left"
                                style="color: #ffffff;"></i> Previous</a>
                    @endif

                    @for ($page = 1; $page <= ceil($totalRecords / $recordsPerPage); $page++)
                        <a href="{{ $query != '' ? route('product-valentines', ['page' => $page, 'query' => $query]) : route('product-valentines', ['page' => $page]) }}"
                            class="{{ $page == $currentPage ? 'active' : '' }}">{{ $page }}</a>
                    @endfor

                    @if ($currentPage < ceil($totalRecords / $recordsPerPage))
                        <a href="{{ $query != '' ? route('product-valentines', ['page' => $currentPage + 1, 'query' => $query]) : route('product-valentines', ['page' => $currentPage + 1]) }}"
                            class="btn btn-info btn-sm text-white ">Next <i class="fa-solid fa-arrow-right"
                                style="color: #ffffff;"></i></a>
                    @endif
                </div>
            @endif

        </div>
        @else
        <div class=" p-3 my-3"  style="display: block;font-weight: 700;background: #f3f5f8; border-radius: 10px;">
            <p class="text-center">No Products Available</p>
        </div>
        @endif
        <script>
            // function redirectToCart(event) {
            //     redirectUrl = event.target.getAttribute('data-id');
            //     console.log(redirectUrl);
            //     window.location.href = redirectUrl;
            // }

            var selectElement = document.getElementById("sort-select");

            selectElement.addEventListener("change", function() {
                // Get the selected option's value
                var selectedValue = selectElement.value;
                window.location.href = selectedValue;
            });
        </script>

    </section>


@endsection
