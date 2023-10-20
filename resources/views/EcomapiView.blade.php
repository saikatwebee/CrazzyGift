@include('common/header')

<div class="container-fluid">

    <div class="tab-custom mt-3">
        <ul class="d-flex justify-content-around p-2 align-items-center custom-tabul">

            <li>AWB API</li>
            <li>Serviceable Pincode API</li>
            <li>Manifest API</li>
        </ul>
    </div>



    <div class="card apiCheck mt-5">
        <div class="card-header">
            <h5 class="text-center font-weight-bold">Serviceable Pincode</h5>
        </div>

        <div class="card-body">
            <form class="serviceable-pincode" action="{{url('/serviceAjax')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="">Origin Pincode</label>
                    <input type="text" class="form-control" id="origin_pincode" name="origin_pincode" required>
                </div>

                <div class="form-group">
                    <label for="">Destination Pincode</label>
                    <input type="text" class="form-control" id="destination_pincode" name="destination_pincode" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" id="first-btn">Call API <span><i class="fa fa-arrow-right" aria-hidden="true"></i></span></button>
                </div>
            </form>
        </div>

    </div>
</div>

@include('common/footer')


<script>
    // $(document).on("click", "#first-btn", () => {

    //     let formData = $("#serviceable-pincode").serializeArray();

    //     $.ajax({
    //         type: 'post',
    //         url: '{{url("/serviceAjax")}}',
    //         dataType: 'json',
    //         data: formData,
    //         succes: function(response) {
    //             console.log(response);
    //         }
    //     });
    // });

    $(document).ready(function() {

        $('.serviceable-pincode').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            var formAction = $(this).attr('action');

            $.ajax({
                type: 'POST',
                url: formAction,
                data: formData,
                success: function(data) {
                    console.log(data);
                }
            });
        });
    });
</script>