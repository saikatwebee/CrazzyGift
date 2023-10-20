<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h3><?= $name; ?>Your order has been confirmed</h3>

                <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <tr>
                                <th>Order ID</th>
                                <td>{{$order_data->order_id}}</td>
                            </tr>
                             <tr>
                                  <th>Amount</th>
                                <td>{{$order_data->amount}}</td>
                             </tr>
                              <tr>
                                   <th>Transaction ID</th>
                                <td>{{$order_data->transaction_id}}</td>
                              </tr>
                             

                        </table>
                    </div>
                    
            </div>
        </div>
    </div>
    
    
</body>
</html>
