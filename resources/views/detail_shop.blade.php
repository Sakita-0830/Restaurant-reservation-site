@extends('layouts/header')

@section("css")
<link rel="stylesheet" href="{{ asset('css/detail_shop.css') }}" >
@endsection

@section('body')
<div class="detail">
  <!-- 店舗詳細 -->
  <div class="shop">
    <a href="/" class="shop_return"><</a>
    <div class="shop_title">{{$shop->name}}</div>
    <img src={{$shop->img_url}} class="shop_img">
    <div class="shop_tag">#{{$shop->area_name}} #{{$shop->genre_name}}</div>
    <div class="shop_overview">{{$shop->overview}}</div>
  </div>

  <!-- 予約入力 -->
  <div class="reserve">
    <div class="reserve_title">予約</div>
    <form action="/select" method="get">
    @csrf 
      <input type="text" name="shop_id" value={{$shop->id}} class="hidden">
      <!-- 日にち入力 -->
      <input type="date" name="date" class="reserve_date" onchange="submit(this.form)" @if(isset($request->date)) value={{$request->date}} @endif>
      <!-- 時間入力 -->
      <select name="time" class="reserve_time" onchange="submit(this.form)">
        @for($h = 17; $h <= 21; $h++)
          @for($m = 0; $m <= 3; $m+=3)
            <option value="{{$h}}:{{$m}}0" @if(isset($request->time) && $request->time == $h.":".$m."0") selected @endif>{{$h}}:{{$m}}0</option>
          @endfor
        @endfor
      </select>
      <!-- 人数入力 -->
      <select name="num_of_people" class="reserve_num" onchange="submit(this.form)">
        @for($i = 1; $i <= 50; $i++)
          <option value="{{$i}}" @if(isset($request->num_of_people) && $request->num_of_people == $i) selected @endif>{{$i}}人</option>
        @endfor
      </select>
    </form>

    <!-- 予約情報入力確認 -->
    <form action="/reserve/add" method="post">
      @csrf
      <div class="reserve_check">
        <input type="text" name="user_id" class="hidden" @auth value={{Auth::user()->id}} @endauth>
        <input type="text" name="shop_id" value={{$shop->id}} class="hidden">
        <!-- 店舗名 -->
        <div class="reserve_check_content">
          <div class="reserve_check_label">Shop</div>
          <div class="reserve_check_item">{{$shop->name}}</div>
        </div>
        <!-- 日にち -->
        <div class="reserve_check_content">
          <div class="reserve_check_label">Date</div>
          <div class="reserve_check_item">@if(isset($request->date)) {{$request->date}} @endif
          </div>
          <input type="text" name="date" class="hidden" @if(isset($request->date)) value={{$request->date}} @endif>
        </div>
        <!-- 時間 -->
        <div class="reserve_check_content">
          <div class="reserve_check_label">Time</div>
          <div class="reserve_check_item">@if(isset($request->time)) {{$request->time}} @endif</div>
          <input type="text" name="time" class="hidden" @if(isset($request->time)) value={{$request->time}} @endif>
        </div>
        <!-- 人数 -->
        <div class="reserve_check_content">
          <div class="reserve_check_label">Number</div>
          <div class="reserve_check_item">@if(isset($request->num_of_people)) {{$request->num_of_people}}@endif 人</div>
          <input type="text" name="num_of_people" class="hidden" @if(isset($request->num_of_people)) value={{$request->num_of_people}} @endif>
        </div>
      </div>
      <!-- ERROR表記 -->
      @if (count($errors) > 0)
        <div class="reserve_error">
            @foreach ($errors->all() as $error)
              <div class="reserve_error_item">ERROR : {{$error}}</div>
            @endforeach
        </div>
      @endif
      <input type="submit" value="予約する" class="reserve_check_submit">
    </form>
  </div>
</div>

@endsection