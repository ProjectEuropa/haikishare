@extends('layouts.app')

@section('title')
haiki share{{ $product->name}}
@endsection

@section('content')

@component('components.header')
@endcomponent

<main class="c-prodcut-detail__container">

  <img src="/storage/{{$product->pic1 }}" class="c-product-detail__img">
  <div class="c-product-detail__name">{{ $product->name}}</div>
  <div class="c-product-detail__body">
    <div class="c-product-detail__item">
      <span>価格</span><span class="c-product-detail__discount">{{ $product->discount}}</span><span class="c-product-detail__discount-letter">円</span><span>(税込み)</span><span class="c-product-detail__price-gray">{{ $product->price }}円</span>
      <span class="c-product-detail__category">{{ $category }}</span>
    </div>

    @if ($product->sold_flg == '1')
    <div class="c-product-detail__status c-product-detail__status--check">在庫<i class="fas fa-times"></i></div>
    @elseif ($product->sold_flg == '0')
    <div class="c-product-detail__status c-product-detail__status--normal">在庫<i class="far fa-circle"></i></div>
    @endif



    <div class="c-product-detail__expiration"><span>賞味期限</span><span>{{ $product->year}}年{{ $product->month }}月{{ $product->day }}日</span></div>
    <div class="c-product-detail__item c-product-detail__address"><span>{{ $prefecture }}</span><span>{{ $company->name }}{{ $company->store }}</span></div>
    @if ( $login_flg == 1 && $product->sold_flg == '0')
      <a class="c-product-detail__btn c-product-detail__btn--warning"><i class="fas fa-times"></i>　オーナーは購入できません</a>
    @elseif ($login_flg == 2 && $product->sold_flg == '0')
      <a class="c-product-detail__btn c-product-detail__btn--hover-normal" href="{{ route('orders.create', $product->id )}}">購入する</a>
    @endif
  </div>
</main>

@endsection
