@extends('layouts.master')

@section('title', $page->title)

@section('content')

<section class="loginRegister container">

    <div class="breadcrumb">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$page->title}}</li>
            </ol>
        </div>
    </div>

    <div class="container">
        <div class="row my-3">
            {!!$page->content !!}
        </div>
    </div>
   

</section>


@endsection