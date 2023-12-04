@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')

    <div class="main-panel">

        <!-- variable content for each page -->

        <div class="content-wrapper">


            <div class="text-left mb-5 ">
                <h3 class="card-title font-weight-bolder">{{ $title }}</h3>
            </div>

            <div class="row">

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add {{ $heading }}</h4>

                            <hr>

                            <form action="{{ url('admin/addGstDetails') }}" method="post" id="addgstForm">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-sm-12">
                                        <input type="text" name="cgst" id="cgst" required
                                            placeholder="Enter CGST here" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-4 col-sm-12">
                                        <input type="text" name="sgst" id="sgst" required
                                            placeholder="Enter SGST here" class="form-control">
                                    </div>

                                    <div class="form-group col-lg-4 col-sm-12">
                                        <input type="text" name="igst" id="igst" required
                                            placeholder="Enter IGST here" class="form-control">
                                    </div>

                                    {{-- <div class="form-group col-lg-3 col-sm-12">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div> --}}
                                </div>
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-warning" id="Gstreset" onclick="resetGSTForm()">Reset</button>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">CGST/SGST</h4>

                            <hr>

                            <div class="table-responsive">

                                <table class="table table-striped" id="gstTable">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>ID</th>
                                            <th>CGST (IN %)</th>
                                            <th>SGST (IN %)</th>
                                            <th>IGST (IN %)</th>
                                            <th>Status</th>
                                            <th>Created_at</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                        </div>


                    </div>
                </div>


            </div>


        </div>


        @include('common.common')


        {{-- gst edit modal --}}


        <div class="modal fade" id="EditGstModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit GST Details</h5>

                        <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                    </div>
                    <div class="modal-body">
                        <form id="edit_gst_form" method="post" action="{{ url('admin/updateGst') }}">
                            <input type="hidden" id="gid" name="gid">
                            <div class="form-group">
                                <label for="edit_cgst">CGST</label>
                                <input type="text" name="cgst" id="edit_cgst" required placeholder="Enter CGST"
                                    class="form-control">
                            </div>

                            <div class="form-group" style="margin-top:33px;">
                                <label for="edit_sgst">SGST</label>
                                <input type="text" name="sgst" id="edit_sgst" class="form-control">
                            </div>

                            <div class="form-group" style="margin-top:33px;">
                                <label for="edit_igst">IGST</label>
                                <input type="text" name="igst" id="edit_igst" class="form-control">
                            </div>


                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary" id="editGstBtn">Save
                                    changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>


                    </div>


                </div>
            </div>
        </div>


    </div>

    <script>
       

       

        document.addEventListener("DOMContentLoaded", function() {
            var addgstForm = document.getElementById('addgstForm');

            addgstForm.onsubmit = function(event) {

                event.preventDefault();

                let formElement = event.target;
                const formData = new FormData(formElement);
                let formAction = formElement.getAttribute('action');

                const csrfToken = getCsrfToken();

                fetch(formAction, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then((response) => response.json())
                    .then(data => {

                        console.log(data);
                        if (data.errors) {
                            var error = data.errors;
                            for (const fieldName in error) {
                                if (error.hasOwnProperty(fieldName)) {
                                    const errorMessages = error[fieldName];
                                    errorMessages.forEach(errorMessage => {
                                        toastr.error(errorMessage);
                                    });
                                }
                            }
                        }

                        if (data.code == 200) {
                            toastr.success(data.msg, 'Success', {
                                onHidden: function() {
                                    //window.location.reload();
                                    $('#gstTable').DataTable().destroy();
                                    getGstDataTable();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });

        document.addEventListener("DOMContentLoaded", function() {
            var edit_gst_form = document.getElementById('edit_gst_form');

            edit_gst_form.onsubmit = function(event) {

                event.preventDefault();

                let formElement = event.target;
                const formData = new FormData(formElement);
                let formAction = formElement.getAttribute('action');

                const csrfToken = getCsrfToken();

                fetch(formAction, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then((response) => response.json())
                    .then(data => {

                        console.log(data);

                        if (data.errors) {
                            var error = data.errors;
                            for (const fieldName in error) {
                                if (error.hasOwnProperty(fieldName)) {
                                    const errorMessages = error[fieldName];
                                    errorMessages.forEach(errorMessage => {
                                        toastr.error(errorMessage);
                                    });
                                }
                            }
                        }

                        if (data.code == 200) {
                            toastr.success(data.msg, 'Success', {
                                onHidden: function() {
                                    $("#EditGstModal").modal('hide');
                                    $('#gstTable').DataTable().destroy();
                                    getGstDataTable();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });
    </script>


@endsection
