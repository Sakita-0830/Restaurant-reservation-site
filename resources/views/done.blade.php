@extends('layouts/header')

@section("css")
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}" >
@endsection

@section('body')
<div class="thanks">
  <div class="thanks_text">ご予約ありがとうございます</div>
  <a href="/" class="thanks_index">戻る</a>

</div>


@endsection