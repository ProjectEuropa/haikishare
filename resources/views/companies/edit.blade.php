@extends('layouts.app')

@section('title')
haiki shareアカウント情報編集
@endsection

@section('content')


@component('components.header')
@endcomponent

@component('components.sub-head')
  @slot('title')
   アカウント情報編集
  @endslot
@endcomponent



<form method="post" action="{{ route('companies.update', $company->id )}}" class="c-profile__container">
@csrf
  <div class="c-profile__main-container">
        <div class="c-profile__item"><div class="c-profile__warning">コンビニ名</div><input class="c-profile__input" type="text" name="name" value="{{ old('name', $company->name) }}"/></div>
        @error('name')
            <span class="c-auth--error u-pl-180">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="c-profile__item"><div class="c-profile__warning">支店</div><input class="c-profile__input" type="text" name="store" value="{{ old('store', $company->store) }}"/></div>
        @error('store')
            <span class="c-auth--error u-pl-180">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div class="c-profile__item">
          <div class="c-profile__warning">都道府県</div>
          <div class="c-profile__select-box">
            <select name="prefecture_id">
            	<option value="" hidden>都道府県</option>
              @foreach ($prefectures as $prefecture)
              @if ( old('prefecture_id', $company->prefecture_id) == $prefecture->id)
              <option value="{{{ $prefecture->id }}}" selected >{{{ $prefecture->name }}}</option>
              @else
              <option value="{{{ $prefecture->id }}}" >{{{ $prefecture->name }}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
        @error('prefecture_id')
            <span class="c-auth--error u-pl-180">
                <strong>{{ $message }}</strong>
            </span>
        @enderror


        <div class="c-profile__item"><div class="c-profile__warning">住所</div><input class="c-profile__input" type="text" name="address" value="{{ old('address', $company->address) }}"/></div>
        @error('address')
            <span class="c-auth--error u-pl-180">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="c-profile__item"><div class="c-profile__warning">郵便番号</div><input class="c-profile__input" type="text" name="zip" value="{{ old('zip', $company->zip) }}"/></div>
        @error('zip')
            <span class="c-auth--error u-pl-180">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="c-profile__item"><div class="c-profile__warning">メールアドレス</div><input class="c-profile__input" type="text" name="email" value="{{ old('email', $company->email) }}"/></div>
        @error('email')
            <span class="c-auth--error u-pl-180">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
  </div>

  <div class="c-profile__create-btn-box">
      <input class="c-profile__create-btn" type="submit" value="変更内容を保存">
      <i class="fas fa-arrow-right c-profile__logo"></i>
  </div>


</form>

@endsection
