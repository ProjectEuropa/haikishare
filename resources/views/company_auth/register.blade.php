@extends('layouts.app')

@section('title')
haiki shareオーナー登録
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

  <form method="POST" action="{{ route('company_auth.register') }}">
    @csrf

        <div class="c-auth__item"><span class="c-auth__warning">必須</span><input type="text" class="c-auth__input c-register__input" name="name"placeholder="コンビニ名" value="{{ old('name') }}" autocomplete="name" autofocus></div>
      @error('name')
          <span class="c-auth--error u-pl-100">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <div class="c-auth__item u-mgt-20"><span class="c-auth__warning">必須</span><input type="text" class="c-auth__input c-register__input" name="store"placeholder="支店" value="{{ old('store') }}" autocomplete="store" autofocus></div>
      @error('store')
      <span class="c-auth--error u-pl-100">
        <strong>{{ $message }}</strong>
      </span>
      @enderror

      <div class="c-auth__item u-mgt-20"><span class="c-auth__warning">必須</span>
        <div class="c-auth__select-box">
          <select name="prefecture">
          	<option value="" hidden>都道府県</option>
            @foreach ($prefectures as $prefecture)
          	<option value="{{{ $prefecture->id }}}">{{{ $prefecture->name }}}</option>
            @endforeach
          </select>
        </div>
      </div>
      @error('prefecture')
      <span class="c-auth--error u-pl-100">
        <strong>{{ $message }}</strong>
      </span>
      @enderror

        <div class="c-auth__item u-mgt-20"><span class="c-auth__warning">必須</span><input type="text" class="c-auth__input c-register__input" name="zip"placeholder="郵便番号（７桁の半角数字で入力してください）" value="{{ old('zip') }}" autocomplete="zip" autofocus></div>
      @error('zip')
          <span class="c-auth--error u-pl-100">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

        <div class="c-auth__item u-mgt-20"><span class="c-auth__warning">必須</span><input type="text" class="c-auth__input c-register__input" name="address"placeholder="住所" value="{{ old('address') }}" autocomplete="address" autofocus></div>
      @error('address')
          <span class="c-auth--error u-pl-100">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

        <div class="c-auth__item u-mgt-20"><span class="c-auth__warning">必須</span><input type="email" class="c-auth__input c-register__input" name="email"placeholder="メールアドレス" value="{{ old('email') }}" autocomplete="email" autofocus></div>
      @error('email')
          <span class="c-auth--error u-pl-100">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

        <div class="c-auth__item u-mgt-20"><span class="c-auth__warning">必須</span><input class="c-auth__input c-register__input" placeholder="パスワード（英数８文字以上）" name="password" autocomplete="current-password"></div>
      @error('password')
          <span class="c-auth--error u-pl-100">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

        <div class="c-auth__item u-mgt-20"><span class="c-auth__warning">必須</span><input class="c-auth__input c-register__input" placeholder="パスワード（確認用）" name="password_confirmation" autocomplete="current-password"></div>
        <a class="c-auth__ask u-mgt-30" href="{{ route('company_auth.login') }}">アカウントをお持ちですか？</a>


      <input class="c-auth__btn" type="submit" name="submit" value="登録">

  </form>

</div>

@endsection
