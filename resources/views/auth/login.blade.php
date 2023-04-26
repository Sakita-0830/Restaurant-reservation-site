@extends('layouts/header')

@section("css")
<link rel="stylesheet" href="{{ asset('css/login_register.css') }}" >
@endsection

@section('body')
<div class="login">
  <div class="login_header">
    <div class="login_title">Login</div>
  </div>
  <form method="post" action="{{ route('login') }}">
  @csrf
    <!-- Email -->
    @if ($errors->has('email'))
      <div class="login_error">{{$errors->first('email')}}</div>
    @endif
    <div class="login_item">
      <img src="{{ asset('/img/icon_mail.png') }}" class="login_icon">
      <input type="text" name="email" class="login_input" placeholder="Email">
    </div>
    <!-- Password -->
    @if ($errors->has('password'))
      <div class="login_error">{{$errors->first('password')}}</div>
    @endif
    <div class="login_item">
      <img src="{{ asset('/img/icon_key.png') }}" class="login_icon">
      <input type="text" name="password" class="login_input" placeholder="Password">
    </div>
    <input type="submit" value="登録" class="login_submit">
  </form>
</div>

@endsection