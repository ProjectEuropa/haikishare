<div class="l-header">
  <div class="l-header__left-box">
    <a href="{{ url('/')}}" class="l-header__title"><img style="height: 100%;"src="{{ asset('img/logo.png')}}"></a>
  </div>
  <ul class="l-header__right-box">
    @php

    @endphp
    <li><a
          @if(!Auth::guard('company')->check())
            href="{{ route('home') }}"
          @elseif(Auth::guard('company')->check())
            href="{{ route('companies.home') }}"
          @endif
        >
          <i class="fas fa-user l-header__user-logo"></i></a></li>
    <li><a href="{{ route('products.index' )}}"><i class="fas fa-search l-header__search-logo"></i></a></li>
  </ul>
</div>
