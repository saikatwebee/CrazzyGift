@extends('layouts.master')

@section('title', $title)

<style>
    .sec-title {
        position: relative;
        z-index: 1;
        margin-bottom: 60px;
    }

    .sec-title .title {
        position: relative;
        display: block;
        font-size: 18px;
        line-height: 24px;
        color: #004a8c;
        font-weight: 500;
        margin-bottom: 15px;
    }

    .sec-title h2 {
        position: relative;
        display: block;
        font-size: 1.75rem;
        line-height: 1.28em;
        color: #222222;
        font-weight: 600;
        padding-bottom: 18px;
    }

    .sec-title h2:before {
        position: absolute;
    content: '';
    left: 8px;
    bottom: 0px;
    width: 35%;
    height: 3px;
    background-color: #d1d2d6;

    }


    .sec-title .text {
        position: relative;
        font-size: 16px;
        line-height: 26px;
        color: #555555;
        font-weight: 400;
        margin-top: 35px;
    }

    .sec-title.light h2 {
        color: #ffffff;
    }

    .sec-title.text-center h2:before {
        left: 50%;
        margin-left: -25px;
    }

    .list-style-one {
        position: relative;
    }

    .list-style-one li {
        position: relative;
        font-size: 16px;
        line-height: 26px;
        color: #222222;
        font-weight: 400;
        padding-left: 35px;
        margin-bottom: 12px;
    }

    .list-style-one li:before {
        content: "\f058";
        position: absolute;
        left: 0;
        top: 0px;
        display: block;
        font-size: 18px;
        padding: 0px;
        color: #ff2222;
        font-weight: 600;
        -moz-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        line-height: 1.6;
        font-family: "Font Awesome 5 Free";
    }

    .list-style-one li a:hover {
        color: #44bce2;
    }

    .btn-style-one {
        position: relative;
        display: inline-block;
        font-size: 17px;
        line-height: 30px;
        color: #ffffff;
        padding: 10px 30px;
        font-weight: 600;
        overflow: hidden;
        letter-spacing: 0.02em;
        background-color: #004a8c;
    }

    .btn-style-one:hover {
        background-color: #0794c9;
        color: #ffffff;
    }

    .about-section {
        position: relative;
        padding: 95px 0 0px;
    }

    .about-section .sec-title {
        margin-bottom: 45px;
    }

    .about-section .content-column {
        position: relative;
        margin-bottom: 50px;
    }

    .about-section .content-column .inner-column {
        position: relative;
        padding-left: 15px;
    }

    .about-section .text {
        margin-bottom: 20px;
        font-size: 16px;
        line-height: 26px;
        color: #848484;
        font-weight: 400;
    }

    .about-section .list-style-one {
        margin-bottom: 45px;
    }

    .about-section .btn-box {
        position: relative;
    }

    .about-section .btn-box a {
        padding: 15px 50px;
    }

    .about-section .image-column {
        position: relative;
    }

    .about-section .image-column .text-layer {
        position: absolute;
        right: -110px;
        top: 50%;
        font-size: 325px;
        line-height: 1em;
        color: #ffffff;
        margin-top: -175px;
        font-weight: 500;
    }

    .about-section .image-column .inner-column {
        position: relative;
        padding-left: 80px;
        padding-bottom: 0px;
    }

    .about-section .image-column .inner-column .author-desc {
        position: absolute;
        bottom: 16vh;
        z-index: 1;
        background: rgba(0, 0, 0, 0.5);
        padding: 10px 15px;
        left: 96px;
        width: calc(100% - 202px);
        border-radius: 50px;
    }

    .about-section .image-column .inner-column .author-desc h2 {
        font-size: 21px;
        letter-spacing: 1px;
        text-align: center;
        color: #fff;
        margin: 0;
    }

    .about-section .image-column .inner-column .author-desc span {
        font-size: 16px;
        letter-spacing: 6px;
        text-align: center;
        color: #fff;
        display: block;
        font-weight: 400;
    }

    .about-section .image-column .inner-column:before {
        content: '';
        position: absolute;
        width: calc(50% + 80px);
        height: calc(100% + 160px);
        top: -80px;
        left: -3px;
        background: transparent;
        z-index: 0;
        border: 44px solid #004a8c;
        border-radius: 20px;
    }

    .about-section .image-column .image-1 {
        position: relative;
    }

    .about-section .image-column .image-2 {
        position: absolute;
        left: 0;
        bottom: 0;
    }

    .about-section .image-column .image-2 img,
    .about-section .image-column .image-1 img {
        box-shadow: 0 30px 50px rgba(8, 13, 62, .15);
        border-radius: 20px;
    }

    .about-section .image-column .video-link {
        position: absolute;
        left: 70px;
        top: 170px;
    }

    .about-section .image-column .video-link .link {
        position: relative;
        display: block;
        font-size: 22px;
        color: #191e34;
        font-weight: 400;
        text-align: center;
        height: 100px;
        width: 100px;
        line-height: 100px;
        background-color: #ffffff;
        border-radius: 50%;
        box-shadow: 0 30px 50px rgba(8, 13, 62, .15);
        -webkit-transition: all 300ms ease;
        -moz-transition: all 300ms ease;
        -ms-transition: all 300ms ease;
        -o-transition: all 300ms ease;
        transition: all 300ms ease;
    }

    .about-section .image-column .video-link .link:hover {
        background-color: #191e34;
        color: #fff;
    }


    @media screen and (max-width: 480px) {
        .about-section .image-column {
            display: none;
        }

        .sec-title h2:before {
            position: absolute;
            content: '';
            left: 65px;
            bottom: 0px;
            width: 60%;
            height: 3px;
            background-color: #d1d2d6;
        }

        .sec-title h2 {
            position: relative;
            display: block;
            font-size: 28px;
            line-height: 1.28em;
            color: #222222;
            font-weight: 600;
            padding-bottom: 18px;
        }



        .about-section {
            position: relative;
            padding: 2px 0 0px;
        }

        .sec-title {
            text-align: center;
        }
    }

    @media(max-width:768px) {
        .about-section .image-column {
            display: none;
        }

        .sec-title h2:before {
            position: absolute;
            content: '';
            left: 65px;
            bottom: 0px;
            width: 60%;
            height: 3px;
            background-color: #d1d2d6;
        }

        .sec-title h2 {
            position: relative;
            display: block;
            font-size: 28px;
            line-height: 1.28em;
            color: #222222;
            font-weight: 600;
            padding-bottom: 18px;
        }

        .about-section {
            position: relative;
            padding: 2px 0 0px;
        }

        .sec-title {
            text-align: center;
        }
    }
</style>

@section('content')
    <section class="loginRegister container">
        <div class="breadcrumb">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Corporate Gifts</li>
                </ol>
            </div>
        </div>

        <section class="about-section">
            <div class="container">
                <div class="row">
                    <div class="content-column col-lg-6 col-md-12 col-sm-12 order-2">
                        <div class="inner-column">
                            <div class="sec-title">
                                {{-- <span class="title">About US</span> --}}
                                <h2>{{ $heading }}</h2>
                            </div>
                            <div class="text"><b>Welcome to CrazzyGift – Your Top Choice for Corporate Gifts</b>
                                <br>
                                At CrazzyGift, we understand the importance of making a lasting impression in the corporate
                                world. Our extensive range of high-quality and customizable gifts is curated specifically
                                for businesses looking to leave a remarkable mark through thoughtful and personalized tokens
                                of appreciation.
                            </div>

                            <div class="text">

                                <b>Why Choose CrazzyGift for Your Corporate Gifting Needs?</b>
                                <br>
                                Quality in Every Gift: Our selection boasts top-tier products sourced from reputable
                                manufacturers, ensuring each item meets the highest standards of quality.

                                Customization and Personalization: We offer a range of customization options, allowing you
                                to imprint your brand, logo, or a personalized message on your chosen gifts. Make a lasting
                                impact that's uniquely yours.

                                Discounts for Bulk Orders: For businesses seeking gifts in bulk or on a regular basis, we
                                offer incredibly attractive discounts. Get in touch with us to discuss your requirements and
                                benefit from our cost-effective solutions.

                                Prompt and Reliable Service: We value your time. Our streamlined processes ensure efficient
                                order processing and timely delivery, so you can meet your corporate deadlines hassle-free.

                                Wide Selection: Our catalog spans a diverse array of items, from timeless classics to
                                innovative and trendsetting products. Find the perfect gift to match your brand identity or
                                occasion.


                            </div>

                            <div class="text">
                                For inquiries, bulk orders, or to discuss your specific requirements, please get in touch
                                with us:
                                <br>
                                <b>Email: Director@crazzygift.com</b>
                                <b>Phone: +91 95350 06187</b>
                                <br>
                                Let CrazzyGift be your partner in making a lasting impression through exceptional corporate
                                gifting. Explore our collection today!
                            </div>



                            {{-- <div class="btn-box">
                                <button type="button" class="btn btn-primary">Contact Us</button>
                            </div> --}}
                        </div>
                    </div>

                    <!-- Image Column -->
                    <div class="image-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column wow fadeInLeft">
                            <div class="author-desc">
                                <h2>CrazzyGift</h2>
                                <span>Surprise Inside</span>
                            </div>
                            <figure class="image-1"><a href="#" class="lightbox-image" data-fancybox="images"><img
                                        title="Rahul Kumar Yadav" src="{{ asset('images/aboutUs6.png') }}"
                                        alt=""></a></figure>

                        </div>
                    </div>

                </div>

            </div>
        </section>


    </section>
@endsection
