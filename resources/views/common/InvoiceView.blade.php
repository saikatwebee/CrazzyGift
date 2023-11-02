<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

</head>

<style>
    body {
        margin: 0;
        font-family: Roboto, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: .8125rem;
        font-weight: 400;
        line-height: 1.5385;
        color: #333;
        text-align: left;
        background-color: #eee
    }

    .table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    }

    .table .table-bordered {
        border-top: 1px solid #CED4DA;
    }

    .mt-50 {
        margin-top: 50px
    }

    .mb-50 {
        margin-bottom: 50px
    }

    .card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: .1875rem
    }

    .card-img-actions {
        position: relative
    }

    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
        text-align: center
    }

    .card-title {
        margin-top: 10px;
        font-size: 17px
    }

    .invoice-color {
        color: red !important
    }

    .card-header {
        padding: .9375rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(0, 0, 0, .02);
        border-bottom: 1px solid rgba(0, 0, 0, .125)
    }

    a {
        text-decoration: none !important
    }

    .btn-light {
        color: #333;
        background-color: #fafafa;
        border-color: #ddd
    }

    .header-elements-inline {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap
    }

    @media (min-width: 768px) {
        .wmin-md-400 {
            min-width: 400px !important
        }
    }

    .btn-primary {
        color: #fff;
        background-color: #2196f3
    }

    .btn-labeled>b {
        position: absolute;
        top: -1px;
        background-color: blue;
        display: block;
        line-height: 1;
        padding: .62503rem
    }
</style>

<body>

    @php 
       
        $userName = $invoice['userDetails']->name;
        $email = $invoice['userDetails']->email;
        $phone = $invoice['userDetails']->phone;

        $billing_address = $invoice['billing_address'];
        $billing_address_components = explode(',', $billing_address);

        $shipping_address = $invoice['shipping_address'];
        $shipping_address_components = explode(',', $shipping_address);

        $products = $invoice['products'];

        //var_dump($products);
        
    
    @endphp

    <div class="container d-flex justify-content-center mt-50 mb-50">
        <div class="row">
            <div class="col-md-12 text-right mb-3">
                <button class="btn btn-primary" id="download">Download Invoice</button>
            </div>
            <div class="col-md-12">
                <div class="card" id="invoice">
                    <div class="card-header">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-4 pull-left">
                                    <img src="{{asset('/images/logo.png')}}" alt="logo" style="width: 110px;height:auto;">  
                                    <ul class="list list-unstyled mb-0 text-left mt-2">
                                        <li>No 19, Annapoorneshwari Industrial Estate </li>
                                        <li>Near Metro Pillar 152 and Konanakunte Cross Metro Station</li>
                                        <li>Kanakapura Rd</li>
                                        <li>Bengaluru, Karnataka 560062</li>

                                    </ul>
                                </div>
                            </div>
                               
                            <div class="col-sm-6">
                                <div class="mb-4 ">
                                    <div class="text-sm-right">
                                        <h4 class="invoice-color mb-2 mt-md-2">{{$invoice['invoice_no']}}</h4>
                                        <ul class="list list-unstyled mb-0">
                                            <li>Date: <span class="font-weight-semibold">{{date("F j, Y")}}</span></li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                               
                        </div>
                            
                    </div>
                    <div class="card-body">
                      
                        <div class="d-md-flex flex-md-wrap">
                            <div class="mb-4 mb-md-2 text-left"> 
                                <ul class="list list-unstyled mb-0">
                                    <li>
                                        <h5 class="my-2">Customer Details:</h5>
                                    </li>
                                    <li><span class="font-weight-semibold">{{$userName}}</span></li>
                                    <li>{{$email}}</li>
                                    <li>{{$phone}}</li>
                                    
                                </ul>
                            </div>
                            <div class="mb-2 ml-auto"> 
                                <div class="d-flex flex-wrap wmin-md-400">
                                    <ul class="list list-unstyled mb-0 text-left">
                                        <li>
                                            <h5 class="my-2">Billing Address</h5>
                                        </li>

                                        @foreach($billing_address_components as $billing_component)
                                                <li>{{$billing_component}}</li>
                                        @endforeach

                                    </ul>
                                    <ul class="list list-unstyled text-right mb-0 ml-auto">
                                        <li>
                                            <h5 class="font-weight-semibold my-2">Shipping Address</h5>
                                        </li>

                                        @foreach($shipping_address_components as $shipping_component)
                                            <li>{{$shipping_component}}</li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
<hr>
                    <div class="table-responsive p-2">
                        <table class="table table-lg table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    
                                    <th class="text-center">Item</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($products as $product)
                                    <tr>
                                        <td class="text-center"><img src="{{asset('/products').'/'.$product->product_image}}" alt="product image" style="width:75px;height:auto;border-radius:4px;"></td>
                                        <td class="text-center">{{$product->title}}</td>
                                        <td class="text-center">{{$product->quantity}}</td>
                                        <td class="text-center">{{$product->price}}</td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <div class="d-md-flex flex-md-wrap">
                            <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                                {{-- <h5 class="text-left">Total :</h5> --}}
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <th class="text-left">Subtotal:</th>
                                                <td class="text-right">{{$invoice['subtotal']}}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">CGST: <span class="font-weight-normal">({{$invoice['cgst']}}%)</span>
                                                </th>
                                                <td class="text-right">{{($invoice['subtotal']*$invoice['cgst'])/100}}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">SGST: <span class="font-weight-normal">({{$invoice['sgst']}}%)</span>
                                                </th>
                                                <td class="text-right">{{($invoice['subtotal']*$invoice['sgst'])/100}}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Total:</th>
                                                <td class="text-right text-primary">
                                                    <h5 class="font-weight-semibold">{{ceil($invoice['amount_captured'])}}</h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="text-align: center;"> <span class="text-muted">Copyright © 2023 CrazzyGift</span> </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    window.onload = function() {
        document.getElementById("download")
            .addEventListener("click", () => {
                const invoice = this.document.getElementById("invoice");
                console.log(invoice);
                console.log(window);
                var opt = {
                    margin: 1,
                    filename: 'myfile.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'letter',
                        orientation: 'portrait'
                    }
                };
                html2pdf().from(invoice).set(opt).save();
            })
    }
</script>

</html>
