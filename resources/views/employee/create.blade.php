@extends('layout.master')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Employee Form </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Add Employee</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('employee.index') }}"> Back</a>
                </div>
            </div>
        </div>
        
        <form  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Employee First Name:</strong>
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name">
                        
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Employee Last Name:</strong>
                        <input type="email" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Employee Email:</strong>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Employee Email">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong>Employee Mobile:</strong>
                    <div class="form-group" >
                        <select name="country_code" id="country">
                            <option value="+91">+91</option>
                            <option value="+93">+93</option>
                            <option value="+83">+83</option>
                        </select>
                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Employee Mobile">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Employee Address:</strong>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Employee Address">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Employee Gender:</strong>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="gender" name="gender" id="exampleRadios1" value="male" checked>
                            <label class="form-check-label" for="exampleRadios1">
                              Male
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" id="gender" type="radio" name="gender" id="exampleRadios2" value="female">
                            <label class="form-check-label" for="exampleRadios2">
                              Female
                            </label>
                          </div>
                          
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Employee Photo:</strong>
                        <input type="file" name="photo" class="form-control" id="images" >
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Hobby:</strong>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hobby" name="hobby[]" value="dancing" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Dancing
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hobby" name="hobby[]" value="singing" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                              Singing
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hobby" name="hobby[]" value="cooking" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                              Cooking
                            </label>
                          </div>
                        
                    </div>
                </div>
                
                <button type="button" class="btn btn-primary ml-3 submitForm">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
       
        $(document).on('click', '.submitForm', function(e) {
            $('.text-danger').remove();
            let formData=new FormData();
            formData.append('images', $('#images')[0].files[0]);
            formData.append('first_name', $('#first_name').val());
            formData.append('last_name', $('#last_name').val());
            formData.append('email', $('#email').val());
            formData.append('mobile', $('#mobile').val());
            formData.append('address', $('#address').val());
            formData.append('gender', $('#gender').val());

            $('input[name="hobby[]"]:checked').each(function() {
                formData.append('hobby[]', $(this).val());
            });

            $.ajax({
                type: "POST",
                url: "{{ route('employee.store') }}",
                dataType: "json",
                data: formData,
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                success: function(response){

                    Swal.fire({
                        title: "Success!",
                        text: "Employee created successfully!",
                        icon: "success"
                    }).then(function() {
                        window.location.href = "{{ route('employee.index') }}";
                    });

                },
                error: function(response){
                    $.each(response.responseJSON.errors, function(key, value) {
                            $(document).find('input[name=' +key+ ']').after('<span class="text-danger">' + value + '</span>');

                            $(document).find('select[name=' +key+ ']').after('<span class="text-danger">' + value + '</span>');
                            $(document).find('input[id=' +key+ ']').after('<span class="text-danger">' + value + '</span>');
                    })
                }
            });

        })
    });
</script>

@stop
