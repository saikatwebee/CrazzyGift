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
        width: 20%;
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

        .sec-title h2 {
            position: relative;
            display: block;
            font-size: 28px;
            line-height: 1.28em;
            color: #222222;
            font-weight: 600;
            padding-bottom: 18px;
        }

        .sec-title h2:before {
            position: absolute;
            content: '';
            left: 96px;
            bottom: 0px;
            width: 37%;
            height: 3px;
            background-color: #d1d2d6;
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

        .sec-title h2 {
            position: relative;
            display: block;
            font-size: 28px;
            line-height: 1.28em;
            color: #222222;
            font-weight: 600;
            padding-bottom: 18px;
        }

        .sec-title h2:before {
            position: absolute;
            content: '';
            left: 96px;
            bottom: 0px;
            width: 37%;
            height: 3px;
            background-color: #d1d2d6;
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
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
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
                            <div class="text">We would like to introduce ourselves as a team of enthusiasts who understand
                                the emotion of gifting. We specialise in personalising your gifts and memories that brings a
                                smile day after day.

                                We offer you a wide range of personalised products and some exclusive non-personalised
                                products to suit any occasion and age group. Our team of dedicated & expert designers is
                                here to help you create that perfect design to express your emotions perfectly.</div>
                            <div class="text">
                                All personalised products will be shipped in 1 business day after the design is approved by
                                you. For non-personalised products, it will be shipped the same business day if the payment
                                is completed by 3pm.

                                So please go ahead and choose what you prefer and let us know the occasion and send us the
                                photograph and leave the rest to us.
                            </div>
                            <div class="text">
                                In case you are not able to decide on the right product, or have any other queries, please
                                discuss with us on the number below and we will be more than happy to listen to you.

                                +91 88611 91998 (11am to 9pm)
                            </div>



                            <div class="btn-box">
                                <button type="button" class="btn btn-primary">Contact Us</button>
                            </div>
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
