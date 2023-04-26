@extends('layouts/header')

@section("css")
<link rel="stylesheet" href="{{ asset('css/login_register.css') }}" >
@endsection

@section('body')
<div class="login">
  <div class="login_header">
    <div class="login_title">Registration</div>
  </div>
  <form method="post" action="{{ route('register') }}">
  @csrf
    <!-- Username -->
    @if ($errors->has('name'))
      <div class="login_error">ERROR:{{$errors->first('name')}}</div>
    @endif
    <div class="login_item">
      <img src="{{ asset('/img/icon_human.png') }}" class="login_icon">
      <input type="text" name="name" class="login_input" placeholder="Username">
    </div>
    <!-- Email -->
    @if ($errors->has('email'))
      <div class="login_error">ERROR:{{$errors->first('email')}}</div>
    @endif
    <div class="login_item">
      <img src="{{ asset('/img/icon_mail.png') }}" class="login_icon">
      <input type="text" name="email" class="login_input" placeholder="Email">
    </div>
    <!-- Password -->
    @if ($errors->has('password'))
      <div class="login_error">ERROR:{{$errors->first('password')}}</div>
    @endif
    <div class="login_item">
      <img src="{{ asset('/img/icon_key.png') }}" class="login_icon">
      <input type="password" name="password" class="login_input" placeholder="Password">
    </div>
    <input type="submit" value="登録" class="login_submit">
  </form>
</div>

@endsection