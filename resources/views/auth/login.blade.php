<!-- resources/views/auth/login.blade.php -->
@extends('layouts.master')

@section('title', 'Login')

@section('sidebar')
@overwrite

@section('header')
@overwrite

@section('content')
<div class="company-logo">
    <h3>Inventory & Billing</h3>
</div>
<form method="POST" action="/auth/login">
    {!! csrf_field() !!}
    <div class="lc-block toggled hidden" id="l-login">
        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
            <div class="fg-line">
                <input type="text" class="form-control" placeholder="Username" name="login_name" value="{{ old('login_name') }}" required>
            </div>
        </div>

        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
            <div class="fg-line">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="checkbox">
            <label>
                <input type="checkbox" value="" name="remember">
                <i class="input-helper"></i>
                Remember Me
            </label>
        </div>

        <button class="btn btn-login btn-danger btn-float" type="submit"><i class="zmdi zmdi-arrow-forward"></i></button>
    </div>
</form>
@endsection