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
    <div class="c-owner-product-list__head-info">
      @if ($productList->total() == 0)
      出品した商品はありません
      @else
      出品した{{ $productCount }}件のうち {{ $productList->firstItem() }}-{{ $productList->lastItem() }}件
      @endif
    </div>

  <!-- スマホのみ非表示ここから-->
  <div class="u-sp-no-display">
    @foreach( $productList as $product )
    <div class="c-owner-product-list__box">
      <a href="{{ route('products.show', $product->id ) }}">
        <!-- <img src="/storage/{{$product->pic1 }}" class="c-owner-product-list__img"> -->
        <img src="data:image/png;base64,{{$product->pic1 }}" class="c-owner-product-list__img">

        <div class="c-owner-product-list__body">
          <div class="c-owner-product-list__name">{{ $product->name }}</div>
          <div class="c-owner-product-list__item"><span>割引価格</span><span class="c-owner-product-list__discount">{{ $product->discount }}</span><span class="c-owner-product-list__discount-letter">円</span><span>(税込み)</span><span class="c-owner-product-list__price-gray">{{ $product->price }}円</span>
          </div>
          <div class="c-owner-product-list__expiration">
            賞味期限：{{ $product->year }}年{{ $product->month }}月{{ $product->day }}日
            @if( $product->hour )
            {{ $product->hour}}時
            @endif
          </div>
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
  <!-- スマホのみ非表示ここまで-->

  <!-- スマホのみ表示ここから-->
  <div class="u-sp-display">
    @foreach( $productList as $product )
    <div class="c-mypage-box">
      <a href="{{ route('products.show', $product->id ) }}">

        <!-- <img src="/storage/{{$product->pic1 }}" class="c-mypage-box__img"> -->
        <img src="data:image/png;base64,{{$product->pic1 }}" class="c-mypage-box__img">

      <div class="c-mypage-box__info">
        <div class="c-mypage-box__item">{{ $product->name }}</div>
        <div class="c-mypage-box__item"><span class="c-price-red">{{ $product->discount }}円</span><span class="c-price-line">{{ $product->price }}円</span></div>
        <div class="c-mypage-box__item">
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
  </div>
  <!-- スマホのみ表示ここまで-->
</div>


<div>
  {{ $productList->links('pagination::default') }}
</div>

@endsection
