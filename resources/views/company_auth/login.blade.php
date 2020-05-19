@extends('layouts.app')

@section('title')
haiki shareオーナーログイン
@endsection

@section('content')

@component('components.header')
@endcomponent

@component('components.sub-head')
  @slot('title')
   ログイン
  @endslot
@endcomponent

<div class="c-auth__container c-login__container">

  <form method="POST" action="{{ route('company_auth.login') }}">
    @csrf

      <label>
        <input type="email" class="c-auth__input c-login__input" name="email"placeholder="メールアドレス" value="{{ old('email') }}" autocomplete="email" autofocus>
      </label>

      @error('email')
          <span class="c-auth--error">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <label class="c-auth__item">
        <input class="c-auth__input c-login__input" type="password" placeholder="パスワード" name="password" value="{{ old('password') }}" autocomplete="current-password">
      </label>
      @error('password')
      <span class="c-auth--error">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
      <a class="c-auth__ask u-mgt-30" href="{{ route('company_auth.register') }}">ユーザー登録はこちら</a>
      <a class="c-auth__ask" href="{{ route('company_auth.password.request') }}"><i class="fas fa-lock u-pr-10"></i>パスワードを忘れた方はこちら</a>

      <input class="c-auth__btn" type="submit" name="submit" value="ログイン">

  </form>

</div>

@endsection
