@extends('layouts.master')

@section('title', $title)

@section('content')
    <!-- Your page-specific content goes here -->


    <section class="loginRegister container">

        <div class="breadcrumb">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $heading }}</li>
                </ol>
            </div>
        </div>
        <h3>{{ $heading }}</h3>
        <div class="row my-4">
            <div class="col-lg-12">
                <P>All personalised products will be shipped within 1 working day of design approval. You need to email us
                    the content for personalising as soon as you place the order. </P>

                <p> While we endeavour to deliver all products to any part of the country within 10 working days of design
                    approval, there maybe some exceptional cases where due to forces beyond our control we may not be able
                    to deliver. These causes may include natural disasters, bundh, strikes, government imposed lockdowns or
                    movement restrictions or any other kind of restrictions that hamper smooth courier operations, in such a
                    case the committed delivery times will not be applicable. For all other cases of Cancellations &
                    Refunds, please refer to out "Cancellation and Refund Policy" page. </p>
                </P>
                <p>
                    While we use world class packaging to ensure safe transit of items with our courier partners, there
                    maybe exceptional cases of product damage upon receipt of product. In such a case we offer either a like
                    to like replacement or a Full Refund as may be desired.</P>
            </div>
        </div>

    </section>

@endsection
