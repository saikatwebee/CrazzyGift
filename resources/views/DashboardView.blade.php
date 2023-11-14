@extends('layouts.master')

@section('title', $title)

@section('content')


    <style>
        .container {
            /* opacity: 0;
            transform: scale(0.8);
            transition: opacity 1s ease-in-out, transform 1s ease-in-out; */

            /* opacity: 0;
                transform: translateY(20px);
                transition: opacity 1s ease-in-out, transform 1s ease-in-out; */

                /* opacity: 0;
    transform: scale(0.8);
    transition: opacity 1s ease-in-out, transform 1s ease-in-out; */

     /* opacity: 0;
    transform: rotate(45deg); 
    transition: opacity 1s ease-in-out, transform 1s ease-in-out;  */


    opacity: 0;
    transform: scale(0.5); /* Initial scaling factor */
    transition: opacity 1s ease-in-out, transform 1s ease-in-out;
        }
    </style>



    <section class="carousal container mb-4" style="margin-top: 3vh;">
        <div class="slider-container">
            <div class="owl-slide">

                @foreach ($banners as $banner)
                    <div class="slick-item">
                        <img src="{{ asset('/') . 'banners/' . $banner->image }}" alt="Slide" class="banners-pic lazyload"
                            onclick="redirectBanner(event)" data-id="{{ $banner->target }}">
                    </div>
                @endforeach


            </div>

        </div>
    </section>



    {{-- <section class="carousal container">
            <div class="slideTitle">
                <h3>Featured Collection</h3>
            </div>
            <div class="slider-container">
                <div class="slider-wrapper row">


                    @foreach ($res1 as $row1)
                    <div class="slider-slide2 col-lg-3">
                        <div class="slide-image">
                            <img src="{{($row1['product_image']) ? asset('/products').'/'.$row1['product_image'] : asset('/products/dummyProduct.jpg') }}" alt="Slide 1">
                            <a href="{{ url('') . '/productDetails/'.$row1['id']}}" class="overlayBestSelling4">
                                <button>Quick View</button>
                            </a>
                        </div>
                        <div class="slide-caption">
                            <h2>{{$row1['title']}}</h2>
                            <p><i class="fa-solid fa-indian-rupee-sign"></i> {{$row1['price']}}</p>
                        </div>
                    </div>
                    @endforeach
                    

                </div>

                <div class="slider-controls1">
                    <button class="slider-control1 back1" onclick="prevSlide1()">
                        <i class="fa-solid fa-arrow-left"></i></button>
                    <button class="slider-control1 next1" onclick="nextSlide1()">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </section> --}}

    <section class="carousal container mb-4" style="margin-top: 3vh;">
        <div class="slideTitle">
            <h3>Featured Collection</h3><i class="fa-solid fa-circle-chevron-down ml-2"></i>
        </div>
        <div class="wrapper">

            <div class="owl-slide1">

                @foreach ($res1 as $row1)
                    <div class="card-body">
                        <div class="image-container">
                            <img src="{{ $row1['product_image'] ? asset('/products') . '/' . $row1['product_image'] : asset('/products/dummyProduct.jpg') }}"
                                class="slick-img lazyload"
                                onclick="window.location.href='{{ url('/productDetails') . '/' . $row1['slug'] }}';">
                            <button type="button" class="btn btn-sm quick-view"
                                onclick="window.location.href='{{ url('/productDetails') . '/' . $row1['slug'] }}';">Quick
                                View</button>
                        </div>

                        <div class="slide-caption"
                            onclick="window.location.href='{{ url('/productDetails') . '/' . $row1['slug'] }}';">
                            <h2>{{ $row1['title'] }}</h2>

                            {{-- <p><i class="fa-solid fa-indian-rupee-sign"></i> {{$row1['price']}}</p> --}}
                            <div class="price-box">
                                <p class="actual-price"><i class="fa-solid fa-indian-rupee-sign"></i>
                                    {{ $row1['actual_price'] }}</p>
                                <p class="selling-price"><i class="fa-solid fa-indian-rupee-sign"></i> {{ $row1['price'] }}
                                </p>

                            </div>
                        </div>



                    </div>
                @endforeach

            </div>

        </div>


        </div>
    </section>

    <section class="container mb-4">
        <div class="slideTitle">
            <h3>Occasions</h3><i class="fa-solid fa-circle-chevron-down ml-2"></i>
        </div>
        <div class="row">

            <div class="col-lg-6" id="col-12">

                @foreach ($occasionimages_large as $occasionimage_large)
                    <div class="imgOccasion mb-4" data-id="{{ $occasionimage_large->target }}"
                        onclick="staticRedirect(event)">
                        {{-- <img src="{{ asset('images/oc1.png') }}" alt="Occasions" data-id="{{$occasionimage->target}}" onclick="staticRedirect(event)"> --}}
                        <img src="{{ asset('/occasions/' . $occasionimage_large->image) }}" alt="Occasions"
                            data-id="{{ $occasionimage_large->target }}" onclick="staticRedirect(event)" class="lazyload">

                        <div class="btnImgOccasion" data-id="{{ $occasionimage_large->target }}"
                            onclick="staticRedirect(event)">{{ $occasionimage_large->button }}</div>
                    </div>

                    {{-- <div class="imgOccasion" data-id="/product-3d-crystal" onclick="staticRedirect(event)">
                        <img src="{{ asset('images/oc2.png') }}" alt="Occasions" data-id="/product-3d-crystal" onclick="staticRedirect(event)">
                        <div class="btnImgOccasion" data-id="/product-3d-crystal" onclick="staticRedirect(event)">3D Photo Crystals</div>
                    </div> --}}
                @endforeach

            </div>

            <div class="col-lg-6" id="col-12">

                @foreach ($occasionimages_small as $occasionimage_small)
                    <div class="imgOccasion mb-4" data-id="{{ $occasionimage_small->target }}"
                        onclick="staticRedirect(event)">
                        {{-- <img src="{{ asset('images/oc3.png') }}" alt="Occasions" data-id="/ocassion-anniversary" onclick="staticRedirect(event)"> --}}
                        <img src="{{ asset('/occasions/' . $occasionimage_small->image) }}" alt="Occasions"
                            data-id="{{ $occasionimage_small->target }}" onclick="staticRedirect(event)" class="lazyload">
                        <div class="btnImgOccasion" data-id="{{ $occasionimage_small->target }}"
                            onclick="staticRedirect(event)">{{ $occasionimage_small->button }}</div>
                    </div>

                    {{-- <div class="imgOccasion mb-4 circular" data-id="/product-photo-frames" onclick="staticRedirect(event)">
                        <img src="{{ asset('images/oc4.png') }}" alt="Occasions" data-id="/product-photo-frames" onclick="staticRedirect(event)">
                        <div class="btnImgOccasion" data-id="/product-photo-frames" onclick="staticRedirect(event)">Photo Frames</div>
                    </div>

                    <div class="imgOccasion circular" data-id="/product-wooden-engraved" onclick="staticRedirect(event)">
                        <img src="{{ asset('images/oc5.png') }}" alt="Occasions" data-id="/product-wooden-engraved" onclick="staticRedirect(event)">
                        <div class="btnImgOccasion" data-id="/product-wooden-engraved" onclick="staticRedirect(event)">Wooden Engraved</div>
                    </div> --}}
                @endforeach

            </div>
        </div>
    </section>

    {{-- <section class="carousal container">
            <div class="slideTitle">
                <h3>Best Selling</h3>
            </div>
            <div class="slider-container">
                <div class="slider-wrapper row">
                    @foreach ($res2 as $row2)

                        <div class="owl-slide col-lg-3">
                            <div class="slide-image">
                                <img src="{{($row2['product_image']) ? asset('/products').'/'.$row2['product_image'] : asset('/products/dummyProduct.jpg') }}" alt="Slide 1">
                                <a href="{{ url('') . '/productDetails/'.$row2['id']}}" class="overlayBestSelling4">
                                    <button>Quick View</button>
                                </a>
                            </div>
                            <div class="slide-caption">
                                <h2>{{$row2['title']}}</h2>
                                <p><i class="fa-solid fa-indian-rupee-sign"></i> {{$row2['price']}}</p>
                            </div>
                        </div>

                    @endforeach

                </div>
                
            </div>
        </section> --}}

    <section class="carousal container mb-4" style="margin-top: 3vh;">
        <div class="slideTitle">
            <h3>Best Selling</h3><i class="fa-solid fa-circle-chevron-down ml-2"></i>
        </div>
        <div class="wrapper">

            <div class="owl-slide2">

                @foreach ($res2 as $row2)
                    <div class="card-body">
                        <div class="image-container">
                            <img src="{{ $row2['product_image'] ? asset('/products') . '/' . $row2['product_image'] : asset('/products/dummyProduct.jpg') }}"
                                class="slick-img lazyload"
                                onclick="window.location.href='{{ url('/productDetails') . '/' . $row1['slug'] }}';">
                            <button type="button" class="btn btn-sm quick-view"
                                onclick="window.location.href='{{ url('/productDetails') . '/' . $row2['slug'] }}';">Quick
                                View</button>
                        </div>

                        <div class="slide-caption"
                            onclick="window.location.href='{{ url('/productDetails') . '/' . $row1['slug'] }}';">
                            <h2>{{ $row2['title'] }}</h2>
                            {{-- <p><i class="fa-solid fa-indian-rupee-sign"></i> {{$row2['price']}}</p> --}}
                            <div class="price-box">
                                <p class="selling-price"><i class="fa-solid fa-indian-rupee-sign"></i> {{ $row1['price'] }}
                                </p>
                                <p class="actual-price"><i class="fa-solid fa-indian-rupee-sign"></i>
                                    {{ $row1['actual_price'] }}</p>
                            </div>
                        </div>



                    </div>
                @endforeach

            </div>

        </div>


        </div>
    </section>



    <section class="carousal container mb-4" style="margin-top: 3vh;">
        <div class="slideTitle">
            <h3>Testimonials</h3><i class="fa-solid fa-circle-chevron-down ml-2"></i>
        </div>

        <div class="row owl-slide3">

            @foreach ($testimonials as $testimonial)
                <div class="slider-slide3 col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-user-icon">
                            <img src="{{ asset('testimonials/' . $testimonial->image) }}" alt="" class="lazyload">

                        </div>

                        <div class="testimonial-header">
                            <img src="{{ asset('images/icons/quote.png') }}" alt="Person 1" class="lazyload">

                            <div class="testimonial-name mt-3">
                                <h3>{{ $testimonial->name }}</h3>
                                <p>{{ $testimonial->designation }}</p>

                            </div>
                            <img src="{{ asset('images/icons/quote.png') }}" alt="Person 1" class="lazyload">
                        </div>
                        <div class="testimonial-description">
                            {!! $testimonial->description !!}
                        </div>
                        {{-- <div class="testimonial-stars">
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                            </div> --}}
                    </div>
                </div>
            @endforeach

        </div>


    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const containers = document.querySelectorAll('.container');

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.2  
            });

            containers.forEach(container => {
                observer.observe(container);
            });
        });
    </script>


    <script>
        window.onload = function() {
            function setEqualHeight() {
                var cards = document.getElementsByClassName('testimonial-card');
                var maxHeight = 0;

                // Reset the height for all cards to 'auto' before recalculating
                for (var i = 0; i < cards.length; i++) {
                    cards[i].style.height = 'auto';
                }

                // Find the maximum height among all cards
                for (var i = 0; i < cards.length; i++) {
                    maxHeight = Math.max(maxHeight, cards[i].clientHeight);
                }

                // Set the height of all cards to the maximum height
                for (var i = 0; i < cards.length; i++) {
                    cards[i].style.height = maxHeight + 'px';
                }
            }

            // Call the function when the page loads and when the window is resized (if needed)
            setEqualHeight();
            window.addEventListener('resize', setEqualHeight);
        };
    </script>



    <script>
        function staticRedirect(event) {
            var static_uid = event.target.getAttribute('data-id');
            console.log(static_uid);

            // var staticRedirect = "{{ url('/') }}"+static_uid;

            window.location.href = static_uid;
        }

        function redirectBanner(event) {
            console.log(event.target.getAttribute('data-id'));
            window.location.href = event.target.getAttribute('data-id');
        }
    </script>

@endsection
