@extends('layouts.master')

@section('title', $title)

@section('content')



    <!-- Your page-specific content goes here -->

    <section class="carousal container mb-4" style="margin-top: 3vh;">
            <div class="slider-container">
                <div class="owl-slide">

                    @foreach($banners as $banner)
                    <div class="slick-item">
                        <img src="{{ asset('/').'banners/'.$banner->image }}" alt="Slide" class="banners-pic" onclick="redirectBanner(event)" data-id="{{$banner->target}}">
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
        </section> --}}

        <section class="carousal container mb-4" style="margin-top: 3vh;">
            <div class="slideTitle">
                <h3>Featured Collection</h3>
            </div>
        <div class="wrapper">
           
                <div class="owl-slide1">

                    @foreach($res1 as $row1)
                  
                    <div class="card-body">
                        <div class="image-container">
                            <img src="{{($row1['product_image']) ? asset('/products').'/'.$row1['product_image'] : asset('/products/dummyProduct.jpg') }}" class="slick-img" onclick="window.location.href='{{url('/productDetails').'/'.$row1['slug']}}';">
                            <button type="button" class="btn btn-sm quick-view" onclick="window.location.href='{{url('/productDetails').'/'.$row1['slug']}}';">Quick View</button>
                        </div>

                        <div class="slide-caption" onclick="window.location.href='{{url('/productDetails').'/'.$row1['slug']}}';">
                            <h2>{{$row1['title']}}</h2>
                            <p><i class="fa-solid fa-indian-rupee-sign"></i> {{$row1['price']}}</p>
                        </div>
                    

                    
                  </div>
                  @endforeach

                </div>
                  
                </div>

         
          </div>
        </section>

        <section class="container mb-4">
            <div class="slideTitle">
                <h3>Occasions</h3>
            </div>
            <div class="row">

                <div class="col-lg-6" id="col-12">

                    <div class="imgOccasion mb-4" data-id="/ocassion-birthday" onclick="staticRedirect(event)">
                        <img src="{{ asset('images/oc1.png') }}" alt="Occasions" data-id="/ocassion-birthday" onclick="staticRedirect(event)">
                        <div class="btnImgOccasion" data-id="/ocassion-birthday" onclick="staticRedirect(event)">Birthdays</div>
                    </div>

                    <div class="imgOccasion" data-id="/product-3d-crystal" onclick="staticRedirect(event)">
                        <img src="{{ asset('images/oc2.png') }}" alt="Occasions" data-id="/product-3d-crystal" onclick="staticRedirect(event)">
                        <div class="btnImgOccasion" data-id="/product-3d-crystal" onclick="staticRedirect(event)">3D Photo Crystals</div>
                    </div>

                </div>

                <div class="col-lg-6" id="col-12">

                    <div class="imgOccasion mb-4" data-id="/ocassion-anniversary" onclick="staticRedirect(event)">
                        <img src="{{ asset('images/oc3.png') }}" alt="Occasions" data-id="/ocassion-anniversary" onclick="staticRedirect(event)">
                        <div class="btnImgOccasion" data-id="/ocassion-anniversary" onclick="staticRedirect(event)">Anniversary</div>
                    </div>

                    <div class="imgOccasion mb-4 circular" data-id="/product-photo-frames" onclick="staticRedirect(event)">
                        <img src="{{ asset('images/oc4.png') }}" alt="Occasions" data-id="/product-photo-frames" onclick="staticRedirect(event)">
                        <div class="btnImgOccasion" data-id="/product-photo-frames" onclick="staticRedirect(event)">Photo Frames</div>
                    </div>

                    <div class="imgOccasion circular" data-id="/product-wooden-engraved" onclick="staticRedirect(event)">
                        <img src="{{ asset('images/oc5.png') }}" alt="Occasions" data-id="/product-wooden-engraved" onclick="staticRedirect(event)">
                        <div class="btnImgOccasion" data-id="/product-wooden-engraved" onclick="staticRedirect(event)">Wooden Engraved</div>
                    </div>

                </div>
            </div>
        </section>

        {{-- <section class="carousal container">
            <div class="slideTitle">
                <h3>Best Selling</h3>
            </div>
            <div class="slider-container">
                <div class="slider-wrapper row">
                    @foreach($res2 as $row2)

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
                <h3>Best Selling</h3>
            </div>
        <div class="wrapper">
           
                <div class="owl-slide2">

                    @foreach($res2 as $row2)
                  
                    <div class="card-body">
                        <div class="image-container">
                            <img src="{{($row2['product_image']) ? asset('/products').'/'.$row2['product_image'] : asset('/products/dummyProduct.jpg') }}" class="slick-img" onclick="window.location.href='{{url('/productDetails').'/'.$row1['slug']}}';">
                            <button type="button" class="btn btn-sm quick-view" onclick="window.location.href='{{url('/productDetails').'/'.$row2['slug']}}';">Quick View</button>
                        </div>

                        <div class="slide-caption" onclick="window.location.href='{{url('/productDetails').'/'.$row1['slug']}}';">
                            <h2>{{$row2['title']}}</h2>
                            <p><i class="fa-solid fa-indian-rupee-sign"></i> {{$row2['price']}}</p>
                        </div>
                    

                    
                  </div>
                  @endforeach

                </div>
                  
                </div>

         
          </div>
        </section>



        <section class="carousal container mb-4" style="margin-top: 3vh;">
            <div class="slideTitle">
                <h3>Testimonials</h3>
            </div>
           
                <div class="row owl-slide3">
                    <div class="slider-slide3 col-lg-4">
                        <div class="testimonial-card">
                            <div class="testimonial-user-icon">
                                <img src="{{ asset('images/icons/user1.png') }}" alt="">
                            </div>
                            <div class="testimonial-header">
                                <img src="{{ asset('images/icons/quote.png') }}" alt="Person 1">
                                <div class="testimonial-name">
                                    <h3>Ashmita Bose</h3>
                                    <p>India</p>
                                </div>
                            </div>
                            <div class="testimonial-description">
                                <p  >Super happy after availing service from crazygift team. Be it speed or end product, all exceeded my expectations. Thanks you.</p>
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
                                    <h3>SureshKumar Maruthiah</h3>
                                    <p>India</p>
                                </div>
                            </div>
                            <div class="testimonial-description">
                                <p  >Excellent work .. Gifts are amazing. . I ordered for my wife’s birthday. She likes it.. Fast delivery.. i git in second day.. Excellent work keep it .. Thanks❤</p>
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
                                    <h3>Nirav Prajapati</h3>
                                    <p>India</p>
                                </div>
                            </div>
                            <div class="testimonial-description">
                                <p  >Wonderful experience with them. They delivered my order on time and quality as promised. I do recommend buying gifts from CrazzyGift.</p>
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
                    <div class="slider-slide3 col-lg-4">
                        <div class="testimonial-card">
                            <div class="testimonial-user-icon">
                                <img src="{{ asset('images/icons/user3.png') }}" alt="">
                            </div>
                            <div class="testimonial-header">
                                <img src="{{ asset('images/icons/quote.png') }}" alt="Person 1">
                                <div class="testimonial-name">
                                    <h3>Avijit Shastri</h3>
                                    <p>India</p>
                                </div>
                            </div>
                            <div class="testimonial-description">
                                <p>A unique gift, which was delivered in time. Very proactive team - they immediately reached out for design finalisation and shipped the product the same day. Highly recommended .</p>
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
                    <div class="slider-slide3 col-lg-4">
                        <div class="testimonial-card">
                            <div class="testimonial-user-icon">
                                <img src="{{ asset('images/icons/user3.png') }}" alt="">
                            </div>
                            <div class="testimonial-header">
                                <img src="{{ asset('images/icons/quote.png') }}" alt="Person 1">
                                <div class="testimonial-name">
                                    <h3>Haresh Parekh</h3>
                                    <p>India</p>
                                </div>
                            </div>
                            <div class="testimonial-description">
                                <p  >I order 3D crystal cube. Was very good. I think is a very good memory and worth to have it. They shipped item in USA also. Delivery was quick.</p>
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
                
            
        </section>


        <script>
            
            function staticRedirect(event){
                var static_uid = event.target.getAttribute('data-id');
                console.log(static_uid);

                var staticRedirect = "{{url('/')}}"+static_uid;

                window.location.href=staticRedirect;
            }

           function redirectBanner(event){
                console.log(event.target.getAttribute('data-id'));
                window.location.href=event.target.getAttribute('data-id');
            }

        </script>

@endsection
