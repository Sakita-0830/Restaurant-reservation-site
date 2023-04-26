<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rese</title>
  <link rel="stylesheet" href="{{ asset('css/header.css') }}" >
  @yield('css')

</head>
<body>
  <header>
    <!-- menu -->
    <div id="menu">
      <div class="menu_button" onclick="document.getElementById('menu').style.display = 'none'; document.getElementById('not_menu').style.display = 'block';">
        <div class="menu_button_line"></div>
      </div>
      <!-- メニュー項目 -->
      <div class="menu_content">
        <a href="/" class="menu_item">Home</a>
        <!-- ログイン時 -->
        @if(Auth::check())
          <form method="post" action="{{ route('logout') }}">
          @csrf
            <input type="submit" value="Logout" class="menu_submit">
          </form>
          <a href="/mypage" class="menu_item">Mypage</a>
        @else
        <!-- 未ログイン時 -->
          <a href="/register" class="menu_item">Registration</a>
          <a href="/login" class="menu_item">Login</a>
        @endif
        
      </div>
    </div>

    <div id="not_menu">
      <!-- ヘッダー -->
      <div class="header">
        <div class="header_content">
          <div class="header_button" onclick="document.getElementById('menu').style.display = 'block'; document.getElementById('not_menu').style.display = 'none';">
            <div class="header_button_line"></div>
          </div>
          <div class="header_title">Rese</div>
        </div>

        @yield('header')

      </div>
      

      <!-- body -->
      @yield('body')
    </div>
  </header>
</body>
</html>