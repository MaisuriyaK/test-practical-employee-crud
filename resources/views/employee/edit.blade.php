@extends('layout.master')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Employye Form </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Edit Employee</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('employee.index') }}"> Back</a>
                </div>
            </div>
        </div>
        
        <form method="POST" action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data" id="employeeForm">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Employee First Name:</strong>
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="{{ $employee->first_name }}">
                        @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Employee Last Name:</strong>
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="{{ $employee->last_name }}">
                        @error('last_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Employee Email:</strong>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Employee Email" value="{{ $employee->email }}">
                        @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Employee Mobile:</strong>
                        <select name="country_code" id="country">
                            <option value="+91" {{$employee->country_code=="+91" ? 'selected' : ""}}>+91</option>
                            <option value="+93" {{$employee->country_code=="+93" ? 'selected' : ""}}>+93</option>
                            <option value="+83" {{$employee->country_code=="+83" ? 'selected' : ""}}>+83</option>
                        </select>
                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Employee Mobile" value="{{ $employee->mobile }}">
                        @error('mobile')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Employee Address:</strong>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Employee Address" value="{{ $employee->address }}">
                        @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Employee Gender:</strong>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="gender" name="gender" id="exampleRadios1" value="male" {{$employee->gender=="male"?"checked":""}}>
                            <label class="form-check-label" for="exampleRadios1">
                              Male
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" id="gender" type="radio" name="gender" id="exampleRadios2" value="female" {{$employee->gender=="female"?"checked":""}}>
                            <label class="form-check-label" for="exampleRadios2">
                              Female
                            </label>
                          </div>
                          @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Employee Photo:</strong>
                        <input type="file" name="images" class="form-control" id="images" >
                        @error('images')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Hobby:</strong>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hobby" name="hobby[]" value="dancing" id="flexCheckDefault" 
                            {{ in_array('dancing',explode(',', $employee->hobby)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault">
                              Dancing
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hobby" name="hobby[]" value="singing" id="flexCheckChecked" 
                            {{ in_array('singing',explode(',', $employee->hobby)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckChecked">
                              Singing
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hobby" name="hobby[]" value="cooking" id="flexCheckChecked" {{ in_array('cooking', explode(',', $employee->hobby)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckChecked">
                              Cooking
                            </label>
                          </div>
                        
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary ml-3 submitForm">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@stop
