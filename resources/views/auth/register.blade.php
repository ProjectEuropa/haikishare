@extends('layouts.app')

@section('title')
haiki shareユーザー登録
@endsection

@section('content')
@component('components.header')
@endcomponent

@component('components.sub-head')
  @slot('title')
   ユーザー登録
  @endslot
@endcomponent


<div class="c-auth__container c-register__container">

  <form method="POST" action="{{ route('register') }}">
    @csrf

        <div class="c-auth__item"><span class="c-auth__warning">必須</span><input type="name" class="c-auth__input c-register__input" name="name"placeholder="名前" value="{{ old('name') }}" autocomplete="name" autofocus></div>
      @error('name')
          <span class="c-auth--error u-pl-100-sp-50">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

        <div class="c-auth__item u-mgt-30-sp-10"><span class="c-auth__warning">必須</span><input type="email" class="c-auth__input c-register__input" name="email"placeholder="メールアドレス" value="{{ old('email') }}" autocomplete="email" autofocus></div>
      @error('email')
          <span class="c-auth--error u-pl-100-sp-50">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

        <div class="c-auth__item u-mgt-30-sp-10"><span class="c-auth__warning">必須</span><input class="c-auth__input c-register__input" placeholder="パスワード（英数８文字以上）" type="password" name="password" autocomplete="current-password"></div>
      @error('password')
          <span class="c-auth--error u-pl-100-sp-50">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

        <div class="c-auth__item u-mgt-30-sp-10"><span class="c-auth__warning">必須</span><input class="c-auth__input c-register__input" placeholder="パスワード（確認用）" type="password" name="password_confirmation" autocomplete="current-password"></div>

        <a class="c-auth__ask u-mgt-30-sp-10" href="{{ route('login') }}"><i class="fas fa-lock u-pr-10-sp-5"></i>ログインする</a>

      <input class="c-auth__btn" type="submit" name="submit" value="登録">

  </form>

</div>

@endsection
