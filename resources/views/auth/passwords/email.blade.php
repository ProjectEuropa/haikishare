@extends('layouts.app')

@section('title')
haiki share | パスワードリセット
@endsection

@section('content')

@component('components.header')
@endcomponent

@component('components.sub-head')
  @slot('title')
   パスワードリセット
  @endslot
@endcomponent




<form method="post" action="{{ route('password.email') }}">
@csrf
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
  </main>

    <div class="c-profile__create-btn-box">
        <input class="c-profile__create-btn" type="submit" value="パスワード変更">
        <i class="fas fa-arrow-right c-profile__logo"></i>
    </div>


</form>

@endsection
