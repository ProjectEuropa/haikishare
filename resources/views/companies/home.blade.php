@extends('layouts.app')

@section('title')
haiki shareマイページ
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
      <a class="p-sub-head-modal__title" href="{{ route('products.create') }}">商品出品</a><i class="fas fa-arrow-circle-right p-sub-head-modal__logo"></i>
    </li>
    <li class="p-sub-head-modal__box">
      <a class="p-sub-head-modal__title" href="{{ route('companies.edit', Auth::guard('company')->user()->id) }}">アカウント情報変更</a><i class="fas fa-arrow-circle-right p-sub-head-modal__logo"></i>
    </li>
    <li class="p-sub-head-modal__box">
      <a class="p-sub-head-modal__title" href="{{ route('company_auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a><i class="fas fa-arrow-circle-right p-sub-head-modal__logo"></i>
    </li>
    <form id="logout-form" action="{{ route('company_auth.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
  </ul>
</div>

<div class="c-mypage-small-container">
  <div class="c-mypage-small-container__title-box">
    <div class="c-mypage-small-container__title">最新の出品商品</div>
  </div>
@foreach( $productList as $product)
  <div class="c-mypage-box">
    <a href="{{ route('products.show', $product->id ) }}">
    <div class="c-mypage-box__body">

        <img src="/storage/{{$product->pic1 }}" class="c-mypage-box__img">

      <div class="c-mypage-box__info pt-20">
        <div class="c-mypage-box__item">{{ $product->name }}</div>
        <div class="c-mypage-box__item"><span class="c-price-red">{{ $product->discount }}円</span><span class="c-price-line">{{ $product->price }}円</span></div>
        <div class="c-mypage-box__item">賞味期限：{{ $product->year }}年{{ $product->month }}月{{ $product->day }}日</div>
        <div class="c-mypage-box__btn-container u-mgr-40">
          @if ( $product->sold_flg == '0' )
          <a href="{{ route('products.edit', $product->id ) }}" class="c-mypage-box__btn c-mypage-box__btn--normal">商品情報の変更</a>
          @else
          <a class="c-mypage-box__btn c-mypage-box__btn--check"><i class="fas fa-check"></i>　販売済</a>
          @endif
        </div>
      </div>
    </div>
  </a>
  </div>
@endforeach
@if($list_flg == true)
  <div class="c-mypage-small-container__btn-box">
    <a class="c-mypage-small-container__btn" href="{{ route('companies.list', Auth::user()->id )}}">
      <span>出品商品の履歴を全て見る　<i class="fas fa-arrow-right c-mypage-small-container__btn-logo"></i></span>
    </a>
  </div>
</div>
@endif

@if($list_flg == true)
<div class="c-mypage-small-container">
  <div class="c-mypage-small-container__title-box">
    <div class="c-mypage-small-container__title">最新の販売商品</div>
  </div>
@endif

  @foreach( $productSell as $product)
  <div class="c-mypage-box">
    <a href="{{ route('products.show', $product->id ) }}">
    <div class="c-mypage-box__body">

        <img src="/storage/{{$product->pic1 }}" class="c-mypage-box__img">

      <div class="c-mypage-box__info pt-20">
        <div class="c-mypage-box__item">{{ $product->name }}</div>
        <div class="c-mypage-box__item"><span class="c-price-red">{{ $product->discount }}円</span><span class="c-price-line">{{ $product->price }}円</span></div>
        <div class="c-mypage-box__item">賞味期限：{{ $product->year }}年{{ $product->month }}月{{ $product->day }}日</div>
        <div class="c-mypage-box__btn-container u-mgr-40">
          <a class="c-mypage-box__btn c-mypage-box__btn--check"><i class="fas fa-check"></i>　販売済</a>
        </div>
      </div>
    </div>
  </a>
  </div>
  @endforeach

  @if($sell_flg == true)
  <div class="c-mypage-small-container__btn-box">
    <a class="c-mypage-small-container__btn" href="{{ route('companies.sell', Auth::user()->id )}}">
      <span>販売商品の履歴を全て見る　<i class="fas fa-arrow-right c-mypage-small-container__btn-logo"></i></span>
    </a>
  </div>
  @endif
</div>

@endsection
