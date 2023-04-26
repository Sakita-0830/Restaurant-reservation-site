@extends('layouts/header')

@section("css")
<link rel="stylesheet" href="{{ asset('css/index_shop.css') }}" >
@endsection

@section('header')
<div>
  <form action="/" class="search">
    @csrf
    <!-- エリア検索 -->
    <select name="area" class="search_area" onchange="submit(this.form)">
      <option value="" @if(empty($request->area)) selected @endif>All area</option>
      @foreach($areas as $areas)
        <option value={{$areas['id']}} @if($request->area == $areas['id']) selected @endif>{{$areas['name']}}</option>
      @endforeach
    </select>
    <!-- ジャンル検索 -->
    <select name="genre" class="search_genre" onchange="submit(this.form)">
      <option value="" @if(empty($request->genre)) selected @endif>All genre</option>
      @foreach($genres as $genre)
        <option value={{$genre['id']}} @if($request->genre == $genre['id']) selected @endif>{{$genre['name']}}</option>
      @endforeach
    </select>
    <!-- キーワード検索 -->
    <span class="magnifying_glass"></span>
    <input type="text" name="word" placeholder="Search..." class="search_word" onchange="submit(this.form)" @if($request->word != null) value={{$request->word}} @endif>
  </form>
</div>

@endsection

@section('body')
<div class="shop">
  @foreach($shops as $shops)
    <div class="shop_card">
      <img src={{$shops['img_url']}} class="shop_card_img">
      <div class="shop_card_title">{{$shops['name']}}</div>
      <div class="shop_card_tag">#{{$shops['area_name']}} #{{$shops['genre_name']}}</div>
      <div class="shop_card_flex">
        <form action="/detail" class="shop_card_form">
        @csrf
          <input type="text" name="shop_id" value={{$shops['id']}} class="hidden">
          <input type="submit" value="詳しくみる" class="shop_card_submit">
        </form>
        @auth
          @if(isset($shops['favorite']))
            <form action="/favorite/delete"  method="post" class="shop_card_form">
            @csrf
            <input type="text" name="id" value={{$shops['favorite']}} class="hidden">
              <input type="image" src="{{ asset('/img/icon_heart_red.png') }}" class="shop_card_favorite_icon">
            </form>
          @else
            <form action="/favorite/add" method="post" class="shop_card_form">
            @csrf
              <input type="text" name="users_id" value={{Auth::user()->id}} class="hidden">
              <input type="text" name="shops_id" value={{$shops['id']}} class="hidden">
              <input type="image" src="{{ asset('/img/icon_heart_gray.png') }}" class="shop_card_favorite_icon">
            </form>
          @endif
        @endauth
      </div>
    </div>
    @endforeach
</div>

@endsection

