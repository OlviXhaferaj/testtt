@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Company Form - Laravel 9 CRUD</title>
 

</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                    <div class="container mt-2">
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left mb-2">
                                    <h2>Add User</h2>
                                </div>
                            </div>
                        </div>
                        @if(session('status'))
                        <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="pb-3">
                            @csrf
                            @foreach($errors->all() as $error)
                                {{ $error  }}
                            @endforeach

                            <!-- creating users -->
                            @foreach($errors->all() as $error)
                                {{ $error  }}
                            @endforeach
                            <div class="d-flex gap-3">
                            <div class="d-flex flex-column">
                                <div class="row mb-3 ">
                                    <label for="name" class="col-form-label" >{{ __('First Name:*') }}</label>
                                    <div class="col-md-6 w-100">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-form-label">{{ __('Email Address:*') }}</label>
                                    <div class="col-md-6 w-100">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            
                            
                            
                                <div class="row mb-3">
                                    <label for="gender" class="col-form-label">{{ __('Gender:*') }}</label>
                                    <div class="col-md-6 w-100">
                                        <select id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender" selected="female">
                                            <option value="female">Female</option>
                                            <option value="male">Male</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="datepicker" class="col-form-label">{{ __('Birthdate:*') }}</label>
                                    <div class="col-md-6 w-100">
                                        <p><input type="text" id="datepicker" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}"  autocomplete="date_of_birth"></p>

                                        @error('date_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="city" class="col-form-label">{{ __('City:*') }}</label>
                                    <div class="col-md-6 w-100">
                                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city">
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-0 mt-4">
                                <div class="d-flex gap-1">

                                    <div class="col-md-6 ">
                                        <button type="submit" class="btn btn-primary ml-3">Submit</button>

                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-dark" href="{{ route('users.index') }}" enctype="multipart/form-data">
                                            Back</a>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-column">
                                <div class="row mb-3">
                                    <label for="lastName" class="col-form-label">{{ __('Last Name:*') }}</label>
                                    <div class="col-md-6 w-100">
                                        <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName">
                                        @error('lastName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="password" class="col-form-label">{{ __('Password:*') }}</label>
                                    <div class="col-md-6 w-100">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <div class="row mb-3">
                                    <label for="nikName" class="col-form-label">{{ __('Nik Name:') }}</label>
                                    <div class="col-md-6 w-100">
                                        <input id="nikName" type="text" class="form-control @error('nikName') is-invalid @enderror w-100" name="nikName" value="{{old('nikName')}}" autocomplete="nikName">
                                        @error('nikName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-form-label">{{ __('Confirm Password:*') }}</label>
                                    <div class="col-md-6 w-100">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- creating users -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
    $(document).ready( function() {
        $( "#datepicker" ).datepicker({
            dateFormat:"yy-mm-dd"
        });
    } );
    </script>
</body>

</html>
@endsection