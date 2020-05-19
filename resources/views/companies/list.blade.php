@extends('layouts.app')

@section('title')
haiki share出品商品一覧
@endsection

@section('content')


@component('components.header')
@endcomponent

@component('components.sub-head')
  @slot('title')
   出品商品リスト
  @endslot
@endcomponent

<div class="c-owner-product-list__container">
    <div class="c-owner-product-list__head-info">出品した{{ $productCount }}件のうち {{ $productList->firstItem() }}-{{ $productList->lastItem() }}件</title>
  </div>

  @foreach( $productList as $product )
  <div class="c-owner-product-list__box">
    <a href="{{ route('products.show', $product->id ) }}">

    <img src="/storage/{{$product->pic1 }}" class="c-owner-product-list__img">

    <div class="c-owner-product-list__body">
      <div class="c-owner-product-list__name">{{ $product->name }}</div>
      <div class="c-owner-product-list__item"><span>割引価格</span><span class="c-owner-product-list__discount">{{ $product->discount }}</span><span class="c-owner-product-list__discount-letter">円</span><span>(税込み)</span><span class="c-owner-product-list__price-gray">{{ $product->price }}円</span>
      </div>
      <div class="c-owner-product-list__expiration">賞味期限：{{ $product->year }}年{{ $product->month }}月{{ $product->day }}日</div>
      <div class="c-owner-product-list__date">出品日：{{ $product->date }}</div>
    </div>
    <div class="c-owner-product-list__btn-container" style="height: 150px; width: 350px; float: left;">

      @if ( $product->sold_flg == '0' )
      <a class="c-owner-product-list__btn c-owner-product-list__btn--normal"  href="{{ route('products.edit', $product->id ) }}">商品情報変更</a>
      @else
      <div class="c-owner-product-list__btn c-owner-product-list__btn--check"><i class="fas fa-check"></i>　販売済</div>
      @endif




    </div>
  </a>
  </div>
  @endforeach
</div>
<div>
  {{ $productList->links('pagination::default') }}
</div>

@endsection
