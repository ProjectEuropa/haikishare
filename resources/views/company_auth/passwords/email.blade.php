@extends('layouts.app')

@section('title')
haiki share | オーナーパスワードリセット
@endsection

@section('content')

@component('components.header')
@endcomponent

@component('components.sub-head')
  @slot('title')
   オーナーパスワードリセット
  @endslot
@endcomponent




<form method="post" action="{{ route('company_auth.password.email') }}">
@csrf

  <main class="c-profile__container">
        <div class="c-profile__item">
          <div class="c-profile__label">メールアドレス</div>
          <input class="c-profile__input" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
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
