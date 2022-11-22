@extends('layout')
@section('title', 'Forgot Password')

@section('content')


<div style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @if (session('status'))
                <div class="" style="padding-top: 20px;">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <div class="text-center text-success">{{ session('status') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <h3 class="text-center" style="padding-bottom: 20px;">Forgot Password</h3>
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}" required 
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : ''  }}">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" value="Send Password Reset Link" class="btn btn-primary btn-block">
                </div>
            </form>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection