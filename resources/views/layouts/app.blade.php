<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="description" content="コンビニで廃棄されるはずの商品を安く購入できるサービスです。スマホ一つでいつでもどこでもコンビニ商品をより安く購入できます。">
    <meta name="keywords" content="廃棄、シェア、コンビニ、商品、食料品、もったいない、割引、低価格">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@500;600;700;900&display=swap" rel="stylesheet">
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body>
    <div id="app">
      <!-- フラッシュメッセージ -->
      @if (session('flash_message'))
        <div class="c-flash-message js-flash-message">
          <i class="fas fa-check">　</i>{{ session('flash_message') }}
        </div>
      @endif
      <div>
        @if (session('status'))
        <div class="c-flash-message--status js-flash-message" >
          {{ session('status') }}
        </div>
        @endif
      </div>


      <!-- メインコンテンツ -->
        <main>
            @yield('content')
        </main>
        <div class="l-footer">Copyright @ haikishare. All Rights Reserved.</div>
    </div>
</body>

</html>
