@extends('layouts/header')

@section("css")
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}" >
@endsection

@section('body')
<div class="mypage">
  <!-- 予約情報 -->
  <div class="reserve">
    <div class="reserve_title">予約状況</div>
    @for($i = 0; $i < count($reserve); $i++)
      <!-- 予約カード -->
      <div class="reserve_card">
        <div class="reserve_card_header">
          <img src="{{ asset('/img/icon_clock.svg') }}" class="reserve_card_icon">
          <div class="reserve_card_title">予約{{$i+1}}</div>
          <form action="/reserve/delete" method="post">
          @csrf
            <input type="text" name="id" value={{$reserve[$i]['id']}} class="hidden">
            <input type="submit" value="X" class="reserve_card_delete">
          </form>
        </div>
        <div class="reserve_card_info">
          <!-- 店名 -->
          <div class="reserve_card_content">
            <div class="reserve_card_label">Shop</div>
            <div class="reserve_card_item">{{$reserve[$i]['shops_name']}}</div>
          </div>
          <!-- 日にち -->
          <div class="reserve_card_content">
            <div class="reserve_card_label">Date</div>
            <div class="reserve_card_item">{{$reserve[$i]['date']}}</div>
          </div>
          <!-- 時間 -->
          <div class="reserve_card_content">
            <div class="reserve_card_label">Time</div>
            <div class="reserve_card_item">{{$reserve[$i]['time']}}</div>
          </div>
          <!-- 人数 -->
          <div class="reserve_card_content">
            <div class="reserve_card_label">Number</div>
            <div class="reserve_card_item">{{$reserve[$i]['num_of_people']}}人</div>
          </div>
        </div>
      </div>
    @endfor
  </div>

  <!-- お気に入り情報 -->
  <div class="favorite">
    <div class="mypage_username">{{Auth::user()->name}} さん</div>
    <div class="favorite_title">お気に入り店舗</div>
    <div class="favorite_card_content">
      <!-- お気に入りカード -->
      @for($i = 0; $i < count($favorite); $i++)
        <div class="favorite_card">
          <img src={{$favorite[$i]['img_url']}} class="favorite_card_img">
          <div class="favorite_card_title">{{$favorite[$i]['shops_name']}}</div>
          <div class="favorite_card_tag">#{{$favorite[$i]['area_name']}} #{{$favorite[$i]['genre_name']}}</div>
          <div class="favorite_card_flex">
            <form action="/detail" class="favorite_card_form">
            @csrf
              <input type="text" value={{$favorite[$i]['shops_id']}} class="hidden">
              <input type="submit" value="詳しくみる" class="favorite_card_submit">
            </form>
            @auth
              <form action="/favorite/delete"  method="post" class="favorite_card_form">
              @csrf
              <input type="text" name="id" value={{$favorite[$i]['id']}} class="hidden">
                <input type="image" src="{{ asset('/img/icon_heart_red.png') }}" class="favorite_card_favorite_icon">
                </form>
            @endauth
          </div>
        </div>
      @endfor
    </div>
  </div>
</div>

@endsection