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

                <p>
                    PLEASE READ THIS DOCUMENT CAREFULLY! IT CONTAINS VERY IMPORTANT INFORMATION ABOUT YOUR RIGHTS AND
                    OBLIGATIONS, AS WELL AS LIMITATIONS AND EXCLUSIONS THAT MAY APPLY TO YOU.
                </p>

                <p>
                    This Agreement contains the terms and conditions that apply to your purchase from <a
                        href="http://www.crazzygift.com">www.crazzygift.com</a>. By placing an order on www.crazzygift.com,
                    Customer acknowledges reading, understanding, and agreeing to be bound by these terms and conditions
                    ("Terms and Conditions of Sale") without limitation or qualification. These Terms and Conditions of Sale
                    are subject to change without notice or obligation at any time, at the sole discretion of
                    www.crazzygift.com.
                </p>

                <p>
                    <strong>Other Documents</strong><br>
                    These Terms and Conditions of Sale may NOT be altered, supplemented, or amended by the use of any other
                    document(s). Any attempt to alter, supplement, or amend this document to enter an order for product(s)
                    which is subject to additional or altered terms and conditions will be null and void unless otherwise
                    agreed to in a written agreement signed by both Customer and www.crazzygift.com.
                </p>

                <p>
                    <strong>Inspection of Goods Upon Receipt</strong><br>
                    We are committed to exceeding standards in the packaging of all products to eliminate damage in transit
                    whenever possible. Regardless of how well a product is packed, damage does occur occasionally. When
                    damage does occur, it is often frustrating, time-consuming, and expensive. Our policy is designed to
                    minimize these problems for you. Please follow the below guidelines when you receive your order.
                </p>

                <p>
                    <strong>Upon Delivery</strong><br>
                    <em>Carton Inspection</em> – If damage is visible or you notice any sign of possible damage (i.e.
                    crushed corners, dented/torn cartons, etc.), notify the delivery man and ask to document it.
                </p>

                <p>
                    <em>Immediately after delivery, open all cartons and inspect for concealed damage.</em>
                </p>

                <p>
                    <strong>Upon Noting of Concealed Damage</strong><br>
                    Report all damages to <a href="mailto:admin@crazzygift.com">admin@crazzygift.com</a>. Be sure to include
                    the following:
                </p>

                <ul>
                    <li>Order Number</li>
                    <li>Name of Purchaser</li>
                    <li>Date of Delivery</li>
                    <li>Item(s) Damaged</li>
                    <li>Description of Damage</li>
                    <li>Contact Email and Telephone Number</li>
                </ul>

                <p>
                    No claim will be allowed after 15 days of receipt of the product,<br>
                    www.crazzygift.com will notify you as soon as possible regarding the damage claims
                </p>

                <p>
                    <strong>*Preview option is not available for products which do not have the provision for online
                        customization.</strong>
                </p>

                <p>
                    <strong>*The stock images used on <a href="http://www.crazzygift.com">www.crazzygift.com</a> website are
                        for demonstration purposes only and are NOT part of the theme package and will not be printed on any
                        of our products. All images are subject to the copyright of their respective owners. For product
                        customization, it is mandatory for buyers to email their own images. These personalized products may
                        be used on this website for demo purposes to indicate the results of personalization and will not
                        attract any royalty payment as they are for demo purposes only.</strong>
                </p>
            </div>
        </div>

    </section>

@endsection
