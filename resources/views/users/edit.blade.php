@extends('layouts.app')

@section('title')
{{config('app.name')}} | ユーザーアカウント情報編集
@endsection

@section('content')

@component('components.header')
@endcomponent

@component('components.sub-head')
  @slot('title')
   ユーザーアカウント情報編集
  @endslot
@endcomponent




<form method="post" action="{{ route('users.update', Auth::user()->id )}}">
@csrf
  <main class="c-profile__container">
        <div class="c-profile__item"><div class="c-profile__label">名前</div><input class="c-profile__input" type="text" name="name" value="{{ old('name', $user->name) }}"/></div>
        @error('name')
            <span class="c-auth--error u-pl-180-sp-40">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="c-profile__item"><div class="c-profile__label">メールアドレス</div><input class="c-profile__input" type="text" name="email" value="{{ old('email', $user->email) }}"/></div>
        @error('email')
            <span class="c-auth--error u-pl-180-sp-40">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
  </main>

  <div class="c-profile__create-btn-box">
      <input class="c-profile__create-btn" type="submit" value="変更内容を保存">
      <i class="fas fa-arrow-right c-profile__logo"></i>
  </div>


</form>

@endsection
