<div class="l-header">

  <!-- スマホのみ表示ここから-->
  <div class="l-header__sp-left-box u-sp-display">
    <a href="{{ route('route') }}">
      <i class="fas fa-user l-header__user-logo"></i>
    </a>
  </div>
  <!-- スマホのみ表示ここまで-->

  <a href="{{ url('/')}}" class="l-header__center-box"><img style="width: 100%;"src="{{ asset('img/logo.png')}}"></a>


  <ul class="l-header__right-box">
    <!-- スマホのみ非表示ここから-->
    <li class="u-sp-no-display"><a href="{{ route('route') }}"><i class="fas fa-user l-header__user-logo"></i></a>
    </li>
    <!-- スマホのみ非表示ここまで-->

    <li>
      <a href="{{ route('products.index' )}}"><i class="fas fa-search l-header__search-logo"></i></a>
    </li>
  </ul>

</div>
