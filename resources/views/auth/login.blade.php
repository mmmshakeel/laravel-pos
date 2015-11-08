<!-- resources/views/auth/login.blade.php -->

@extends('layouts.master')

@section('title', 'Login')

<!-- @section('header_title', 'Login')

@section('bannerbar')
@overwrite

@section('sidebar')
@overwrite -->

@section('content')
<div class="center-login">
    <div class="center-login-title">
        <h4>Inventory & Billing System</h4>
    </div>
    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}
        <div class="demo-card-wide mdl-card mdl-shadow--4dp">
            <header class="mdl-layout__header">
                <div class="mdl-layout__header-row">
                    <span class="mdl-layout-title">Sign In</span>
                </div>
            </header>
            <div class="mdl-card__supporting-text">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="username" name="username" value="{{ old('login_name') }}" required>
                    <label class="mdl-textfield__label" for="username">Username...</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="password" id="password" name="password" required>
                    <label class="mdl-textfield__label" for="password">Password...</label>
                </div>
            </div>
            <div class="mdl-card__supporting-text">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--8-col">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="remember">
                            <input type="checkbox" id="remember" name="remember" class="mdl-checkbox__input">
                            <span class="mdl-checkbox__label">Remember Me</span>
                        </label>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col">
                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection