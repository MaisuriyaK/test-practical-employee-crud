@extends('layout.master2')
@section('content')

<!DOCTYPE html>

<html>

<head>

    <title>Emloyee CRUD</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

</head>

<body>

    

<div class="container mt-2">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <h1>Employee CRUD</h1>
            <div class="pull-right mb-2 mb-2">
                <a class="btn btn-primary" style="float:right" href="{{ route('employee.create') }}"> Create Employee</a>
            </div>
        </div>
    </div>
<hr>
    
    @if(session('success'))

    <div class="alert alert-success">

        <p>{{ session('success') }}</p>

    </div>
    @endif

    <table class="table table-bordered data-table mt-3">

        <thead>

            <tr>

                <th>Image</th>

                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Hobby</th>
                <th width="100px">Action</th>

            </tr>

        </thead>records

        <tbody>

        </tbody>

    </table>

</div>

   

</body>

   

<script type="text/javascript">

  $(function () {

    

    var table = $('.data-table').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('employee.index') }}",

        columns: [

            {data: 'photo', name: 'photo'},

            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'email', name: 'email'},
            {data: 'gender', name: 'gender'},
            {data: 'mobile', name: 'mobile'},
            {data: 'address', name: 'address'},
            {data: 'hobby', name: 'hobby'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]

    });

    

  });

  $(document).ready(function() {
    $(document).on('click', '.deleteEmployee', function(e) {

                var id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "employee/" + id,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                    Swal.fire(
                                        'Deleted!',
                                        response.message,
                                        'success'
                                    );
                                    $('.data-table').DataTable().ajax.reload();
                            }
                        });

                    }
                })
            });
        });


</script>

</html>


@stop
