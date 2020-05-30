@extends('layouts.app')

@section('title')
{{config('app.name')}} | ユーザーログイン
@endsection

@section('content')

@component('components.header')
@endcomponent

@component('components.sub-head')
  @slot('title')
   ユーザーログイン
  @endslot
@endcomponent

<div class="c-auth__container c-login__container">

  <form method="POST" action="{{ route('login') }}">
    @csrf

      <label >
        <input type="email" class="c-auth__input c-login__input" name="email"placeholder="メールアドレス" value="{{ old('email') }}" autocomplete="email" autofocus>
      </label>

      @error('email')
          <span class="c-auth--error">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <label>
        <input class="c-auth__input c-login__input" type="password" placeholder="パスワード" name="password" value="{{ old('password') }}" autocomplete="current-password">
      </label>

      @error('password')
          <span class="c-auth--error">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <a class="c-auth__ask u-mgt-30-sp-10" href="{{ route('register') }}"><i class="fas fa-user-plus u-pr-10-sp-5"></i>ユーザー登録はこちら</a>
      <a class="c-auth__ask" href="{{ route('password.request')}}"><i class="far fa-question-circle u-pr-10-sp-5"></i>パスワードを忘れた方はこちら</a>
      <input class="c-auth__btn" type="submit" name="submit" value="ログイン">
  </form>

</div>


@endsection
