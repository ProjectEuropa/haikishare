@extends('layouts.app')

@section('title')
{{config('app.name')}} | オーナーマイページ
@endsection

@section('content')


@component('components.header')
@endcomponent


@component('components.sub-head')
  @slot('title')
   オーナーマイページ
  @endslot
@endcomponent

<div class="p-sub-head-modal__container">
  <ul class="p-sub-head-modal__bar ">
    <li class="p-sub-head-modal__box">
      <a class="p-sub-head-modal__title" href="{{ route('products.create') }}">商品出品</a><i class="fas fa-arrow-circle-right p-sub-head-modal__logo u-sp-no-display"></i>
    </li>
    <li class="p-sub-head-modal__box">
      <a class="p-sub-head-modal__title" href="{{ route('companies.edit', Auth::guard('company')->user()->id) }}">アカウント情報変更</a><i class="fas fa-arrow-circle-right p-sub-head-modal__logo u-sp-no-display"></i>
    </li>
    <li class="p-sub-head-modal__box">
      <a class="p-sub-head-modal__title" href="{{ route('company_auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a><i class="fas fa-arrow-circle-right p-sub-head-modal__logo u-sp-no-display"></i>
    </li>
    <form id="logout-form" action="{{ route('company_auth.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
  </ul>
</div>

<div class="c-mypage-container">
  <div class="c-mypage-container__title-box">
    <div class="c-mypage-container__title">最新の出品商品</div>
  </div>
@foreach( $productList as $product)
  <div class="c-mypage-box">
    <a href="{{ route('products.show', $product->id ) }}">
    <!-- <img src="/storage/{{$product->pic1 }}" class="c-mypage-box__img"> -->
    <img src="data:image/png;base64,{{$product->pic1 }}" class="c-mypage-box__img">

    <div class="c-mypage-box__info">
      <div class="c-mypage-box__item">{{ $product->name }}</div>
      <div class="c-mypage-box__item"><span class="c-mypage__price-red">{{ $product->discount }}円</span><span class="c-mypage__price-line">{{ $product->price }}円</span></div>
      <div class="c-mypage-box__item-for-date">
        出品日：{{ $product->createDay }}
      </div>
      <div class="c-mypage-box__item-for-date">
        賞味期限：{{ $product->year }}年{{ $product->month }}月{{ $product->day }}日
        @if( $product->hour )
        {{ $product->hour}}時
        @endif
      </div>
      <div class="c-mypage-box__btn-container">
        @if ( $product->sold_flg == '0' )
        <a href="{{ route('products.edit', $product->id ) }}" class="c-mypage-box__btn c-mypage-box__btn--normal c-mypage-box__company-btn c-mypage-box__company-sp-size-btn">商品情報の変更</a>
        @else
        <a class="c-mypage-box__btn c-mypage-box__btn--check c-mypage-box__company-btn c-mypage-box__company-sp-size-btn"><i class="fas fa-check u-pr-10-sp-5"></i>販売済</a>
        @endif
      </div>
    </div>
  </a>
  </div>
@endforeach
  <div class="c-mypage-small-container__btn-box">
    <a class="c-mypage-small-container__btn" href="{{ route('companies.list', Auth::user()->id )}}">
      <span>出品商品の履歴を全て見る　<i class="fas fa-arrow-right c-mypage-small-container__btn-logo"></i></span>
    </a>
  </div>
</div>

<div class="c-mypage-container">
  <div class="c-mypage-container__title-box">
    <div class="c-mypage-container__title">最新の販売商品</div>
  </div>

<div class="u-sp-no-display">
  @foreach( $productSell as $product)
  <div class="c-mypage-box">
    <a href="{{ route('products.show', $product->product_id ) }}">

      <!-- <img src="/storage/{{$product->pic1 }}" class="c-mypage-box__img"> -->
      <img src="data:image/png;base64,{{$product->pic1 }}" class="c-mypage-box__img">

    <div class="c-mypage-box__info">
      <div class="c-mypage-box__item">{{ $product->product_name }}</div>
      <div class="c-mypage-box__item"><span class="c-mypage__price-red">{{ $product->discount }}円</span><span class="c-mypage__price-line">{{ $product->price }}円</span></div>
      <div class="c-mypage-box__item">販売日：{{ $product->date }}</div>
      <div class="c-mypage-box__btn-container">
        <a class="c-mypage-box__btn c-mypage-box__btn--check c-mypage-box__company-btn c-mypage-box__company-sp-size-btn"><i class="fas fa-check u-pr-10-sp-5"></i>販売済</a>
      </div>
    </div>
  </a>
  </div>
  @endforeach
</div>

<div class="u-sp-display">
  @foreach( $productSell as $product)
      <a href="{{ route('products.show', $product->product_id ) }}" class="c-mypage-box">

      <!-- <img src="/storage/{{$product->pic1 }}" class="c-mypage-box__img"> -->
      <img src="data:image/png;base64,{{$product->pic1 }}" class="c-mypage-box__img">

      <div class="c-mypage-box__info--text">
        {{ $product->date }}に販売しました
      </div>
    </a>
  @endforeach
</div>

  <div class="c-mypage-small-container__btn-box">
    <a class="c-mypage-small-container__btn" href="{{ route('companies.sell', Auth::user()->id )}}">
      <span>販売商品の履歴を全て見る　<i class="fas fa-arrow-right c-mypage-small-container__btn-logo"></i></span>
    </a>
  </div>
</div>

@endsection
