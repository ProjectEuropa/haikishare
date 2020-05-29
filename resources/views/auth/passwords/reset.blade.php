@extends('layouts.app')

@section('title')
haiki share パスワード変更
@endsection

@section('content')

@component('components.header')
@endcomponent

@component('components.sub-head')
  @slot('title')
   パスワード変更
  @endslot
@endcomponent




<form method="post" action="{{ route('password.update') }}">
@csrf
<input type="hidden" name="token" value="{{ $token }}">

  <main class="c-profile__container">
        <div class="c-profile__item">
          <div class="c-profile__label">メールアドレス</div>
          <input class="c-profile__input" type="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus/>
        </div>
        @error('email')
            <span class="c-auth--error u-pl-180-sp-40">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="c-profile__item">
          <div class="c-profile__label">新しいパスワード</div>
          <input class="c-profile__input" type="password" name="password" autocomplete="new-password" autofocus/>
        </div>
        @error('password')
        <span class="c-auth--error u-pl-180-sp-40">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div class="c-profile__item">
          <div class="c-profile__label">再入力</div>
          <input class="c-profile__input" type="password" name="password_confirmation"  autocomplete="new-password" autofocus/>
        </div>
  </main>

  <div class="c-profile__create-btn-box">
      <input class="c-profile__create-btn" type="submit" value="パスワード変更">
      <i class="fas fa-arrow-right c-profile__logo"></i>
  </div>


</form>

@endsection
