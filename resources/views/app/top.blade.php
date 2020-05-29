<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>haiki share</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@500;600;700;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="c-top__background">
    <div id="app">

        <main>

@component('components.header')
@endcomponent




<main class="c-top__container">
  <div class="c-top__ask">
    <img src="{{ asset('img/top-ask.png')}}" class="u-pr-20-sp-10 c-top__ask-img" >
    <span class="c-top__color1">haikishare</span>ってどんなサービス？
  </div>

  <div class="c-top__answer">
    <img src="{{ asset('img/top-answer.png')}}" class="u-pr-20-sp-10 c-top__answer-img">
    廃棄されるコンビニ商品を<span class="c-top__title-small-underline">低価格</span>で購入できるサービスです。
  </div>

  <ul class="c-top__img-box">
    <li><img src="{{ asset('img/food-img1.png')}}" class="c-top__food-img"></li>
    <li><img src="{{ asset('img/food-img2.png')}}" class="c-top__food-img"></li>
    <li><img src="{{ asset('img/food-img3.png')}}" class="c-top__food-img"></li>
    <li><img src="{{ asset('img/food-img4.png')}}" class="c-top__food-img"></li>
    <li><img src="{{ asset('img/food-img5.png')}}" class="c-top__food-img"></li>
    <img src="{{ asset('img/hukidashi.png')}}" class="c-top__hukidashi-foods-img">
    <span class="c-top__hukidashi-foods-word">品数豊富！</span>
  </ul>

  <div class="c-top__desc">使い方は簡単!</div>
  <section class="c-top__card-container" id="user">

    <div class="c-top__user-card">
      <div class="c-top__user-card-title"><span class="c-top__color2">STEP1</span>探す</div>
      <div class="c-top__card-img-box">
        <img class="c-top__card-img" src="{{ asset('img/user-search.png')}}">
      </div>
    </div>

    <div class="c-top__user-card">
      <div class="c-top__user-card-title"><span class="c-top__color2">STEP2</span>予約</div>
      <div class="c-top__card-img-box">
        <img class="c-top__card-img" src="{{ asset('img/user-reserve.png')}}">
      </div>
      <img src="{{ asset('img/hukidashi.png')}}" class="c-top__hukidashi-box-img">
      <span class="c-top__hukidashi-box-word">最短１分！</span>
    </div>

    <div class="c-top__user-card">
      <div class="c-top__user-card-title"><span class="c-top__color2">STEP3</span>購入</div>
      <div class="c-top__card-img-box">
        <img class="c-top__card-img" src="{{ asset('img/user-shop.png')}}">
      </div>
    </div>

  </section>
  <a class="c-top__btn" href="{{ route('register')}}">今すぐユーザー登録へ進む</a>

  <div class="c-top__desc">オーナー登録も簡単!</div>
  <section class="c-top__card-container" id="owner">

    <div class="c-top__owner-card">
      <div class="c-top__owner-card-title">STEP1</div>
      <div class="c-top__owner-card-subtitle">商品登録</div>
      <div class="c-top__card-img-box">
        <img class="c-top__card-img" src="{{ asset('img/owner-memo.png')}}">
      </div>
      <img src="{{ asset('img/hukidashi.png')}}" class="c-top__hukidashi-box-img">
      <span class="c-top__hukidashi-box-word">最短１分！</span>
    </div>

    <div class="c-top__owner-card">
      <div class="c-top__owner-card-title">STEP2</div>
      <div class="c-top__owner-card-subtitle">予約確認</div>
      <div class="c-top__card-img-box">
        <img class="c-top__card-img" src="{{ asset('img/owner-email.png')}}">
      </div>
    </div>

    <div class="c-top__owner-card">
      <div class="c-top__owner-card-title">STEP3</div>
      <div class="c-top__owner-card-subtitle">店舗販売</div>
      <div class="c-top__card-img-box">
        <img class="c-top__card-img" src="{{ asset('img/owner-shop.png')}}">
      </div>
    </div>

  </section>
  <a class="c-top__btn" href="{{ route('company_auth.register')}}">今すぐオーナー登録へ進む</a>
</main>
@component('components.footer')
@endcomponent
</main>
</div>
</body>
</html>
