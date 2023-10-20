@extends('layouts.master')

@section('title', $title)

@section('content')



    <!-- Your page-specific content goes here -->

    <section class="carousal container my-5">
            <div class="slider-container">
                <div class="slider-wrapper">

                    @foreach($banners as $banner)
                    <div class="slider-slide">
                        <img src="{{ asset('/').'banners/'.$banner->image }}" alt="Slide">
                    </div>

                    @endforeach
                    
                    
                </div>
                <div class="slider-controls">
                    <button class="slider-control back" onclick="prevSlide()">
                        <i class="fa-solid fa-arrow-left"></i></button>
                    <button class="slider-control next" onclick="nextSlide()">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </section>

         

        <section class="carousal container">
            <div class="slideTitle">
                <h3>Featured Collection</h3>
            </div>
            <div class="slider-container">
                <div class="slider-wrapper row">


                    @foreach($res1 as $row1)
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
        </section>

        <section class="container mb-5">
            <div class="slideTitle">
                <h3>Occasions</h3>
            </div>
            <div class="row">

                <div class="col-lg-6" id="col-12">

                    <div class="imgOccasion mb-4" data-id="/occasions/birthday" onclick="staticRedirect(event)">
                        <img src="{{ asset('images/oc1.png') }}" alt="Occasions" data-id="/occasions/birthday" onclick="staticRedirect(event)">
                        <div class="btnImgOccasion" data-id="/occasions/birthday" onclick="staticRedirect(event)">Birthdays</div>
                    </div>

                    <div class="imgOccasion" data-id="/products/3d-crystal" onclick="staticRedirect(event)">
                        <img src="{{ asset('images/oc2.png') }}" alt="Occasions" data-id="/products/3d-crystal" onclick="staticRedirect(event)">
                        <div class="btnImgOccasion" data-id="/products/3d-crystal" onclick="staticRedirect(event)">3D Photo Crystals</div>
                    </div>

                </div>

                <div class="col-lg-6" id="col-12">

                    <div class="imgOccasion mb-4" data-id="/occasions/anniversary" onclick="staticRedirect(event)">
                        <img src="{{ asset('images/oc3.png') }}" alt="Occasions" data-id="/occasions/anniversary" onclick="staticRedirect(event)">
                        <div class="btnImgOccasion" data-id="/occasions/anniversary" onclick="staticRedirect(event)">Anniversary</div>
                    </div>

                    <div class="imgOccasion mb-4 circular" data-id="/products/photo-frames" onclick="staticRedirect(event)">
                        <img src="{{ asset('images/oc4.png') }}" alt="Occasions" data-id="/products/photo-frames" onclick="staticRedirect(event)">
                        <div class="btnImgOccasion" data-id="/products/photo-frames" onclick="staticRedirect(event)">Photo Frames</div>
                    </div>

                    <div class="imgOccasion circular" data-id="/products/wooden-engraved" onclick="staticRedirect(event)">
                        <img src="{{ asset('images/oc5.png') }}" alt="Occasions" data-id="/products/wooden-engraved" onclick="staticRedirect(event)">
                        <div class="btnImgOccasion" data-id="/products/wooden-engraved" onclick="staticRedirect(event)">Wooden Engraved</div>
                    </div>

                </div>
            </div>
        </section>

        <section class="carousal container">
            <div class="slideTitle">
                <h3>Best Selling</h3>
            </div>
            <div class="slider-container">
                <div class="slider-wrapper row">
                    @foreach($res2 as $row2)
                    <div class="slider-slide2 col-lg-3">
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
                <div class="slider-controls2">
                    <button class="slider-control2 back2" onclick="prevSlide2()">
                        <i class="fa-solid fa-arrow-left"></i></button>
                    <button class="slider-control2 next2" onclick="nextSlide2()">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </section>



        <section class="carousal container mb-5">
            <div class="slideTitle">
                <h3>Testimonials</h3>
            </div>
            <div class="slider-container">
                <div class="row marGin">
                    <div class="slider-slide3 col-lg-4">
                        <div class="testimonial-card">
                            <div class="testimonial-user-icon">
                                <img src="{{ asset('images/icons/user1.png') }}" alt="">
                            </div>
                            <div class="testimonial-header">
                                <img src="{{ asset('images/icons/quote.png') }}" alt="Person 1">
                                <div class="testimonial-name">
                                    <h3>Shiva G</h3>
                                    <p>India</p>
                                </div>
                            </div>
                            <div class="testimonial-description">
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minus voluptas aliquid
                                    minima tempore quos numquam error fuga veniam autem nam.</p>
                            </div>
                            <div class="testimonial-stars">
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                            </div>
                        </div>
                    </div>
                    <div class="slider-slide3 col-lg-4">
                        <div class="testimonial-card">
                            <div class="testimonial-user-icon">
                                <img src="{{ asset('images/icons/user2.png') }}" alt="">
                            </div>
                            <div class="testimonial-header">
                                <img src="{{ asset('images/icons/quote.png') }}" alt="Person 1">
                                <div class="testimonial-name">
                                    <h3>Lady Gaga</h3>
                                    <p>Brazil</p>
                                </div>
                            </div>
                            <div class="testimonial-description">
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minus voluptas aliquid
                                    minima tempore quos numquam error fuga veniam autem nam.</p>
                            </div>
                            <div class="testimonial-stars">
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="slider-slide3 col-lg-4">
                        <div class="testimonial-card">
                            <div class="testimonial-user-icon">
                                <img src="{{ asset('images/icons/user3.png') }}" alt="">
                            </div>
                            <div class="testimonial-header">
                                <img src="{{ asset('images/icons/quote.png') }}" alt="Person 1">
                                <div class="testimonial-name">
                                    <h3>Alexy</h3>
                                    <p>Georgia</p>
                                </div>
                            </div>
                            <div class="testimonial-description">
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minus voluptas aliquid
                                    minima tempore quos numquam error fuga veniam autem nam.</p>
                            </div>
                            <div class="testimonial-stars">
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-controls3">
                    <button class="slider-control3 back3" onclick="prevSlide3()">
                        <i class="fa-solid fa-arrow-left"></i></button>
                    <button class="slider-control3 next3" onclick="nextSlide3()">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </section>


        <script>
            
            function staticRedirect(event){
                var static_uid = event.target.getAttribute('data-id');
                console.log(static_uid);

                var staticRedirect = "{{url('/')}}"+static_uid;

                window.location.href=staticRedirect;
            }

        </script>

@endsection
