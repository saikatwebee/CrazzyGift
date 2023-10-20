@extends('layouts.master')

@section('title', $title)

@section('content')
    @php
    // echo "<pre>";
    //     var_dump($data);
    @endphp

<section class="loginRegister container">
    <div class="card">
        <div class="card-header">

            <div class="payment_heading">
                    @if($data->status=="captured")
            <h3 class="card-title" style="color: #4caf50 !important;">
                <i class="fa-solid fa-circle-check"></i> Order placed successfully 
            </h3>
            @else
            <h3 class="card-title" style="color: #fb483a !important;">
                <i class="fa-solid fa-xmark"></i> Payment Failure
            </h3>
            @endif
             <div class="timer">
                        You will be redirected within <span id="countdown">10</span> seconds
             </div>
            </div>

            

        </div>
        <div class="card-body">

           

            <table class="table table-responsive table-bordered table-hover stripped">
                <tr>
                    <th>Order Id</th>
                    <td>{{$order['order_id']}}</td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>{{$data->amount/100}}</td>
                </tr>
                <tr>
                    <th>Transaction Id</th>
                    <td>{{$data->id}}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{$order_date}}</td>
                </tr>
                <tr>
                    <th>Time</th>
                    <td>{{$order_time}}</td>
                </tr>
                {{-- <tr>
                    <th></th>
                    <td></td>
                </tr> --}}
                <tr>
                    <th>Status</th>
                    @if($data->status=="captured")
                    <td>Order placed</td>
                    @else
                    <td>Payment Failure</td>
                    @endif
                </tr>
            </table>
        </div>
    </div>
</section>
<script>
   



   // Function to start the countdown timer
function startTimer(duration, display) {
    let timer = duration, minutes, seconds;
    const intervalId = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = seconds;

        if (--timer < 1) {
            // Redirect to the order page when the timer reaches 0
            var paymentStatus ="{{$data->status}}" ;
        clearInterval(intervalId);

    
   if(paymentStatus=="captured"){
            window.location.href="{{url('/myorder')}}";
    }
   else{
    
        window.location.href="{{url('/shippingInformation')}}";
    }


           
        }
    }, 1000);
}

// Start the timer when the page loads
document.addEventListener("DOMContentLoaded", function () {
    const countdownDisplay = document.getElementById("countdown");
    const countdownDuration = 10; // 10 seconds

    startTimer(countdownDuration, countdownDisplay);
});







</script>

@endsection