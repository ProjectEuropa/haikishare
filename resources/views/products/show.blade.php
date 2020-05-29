@extends('layouts.app')

@section('title')
haiki share{{ $product->name}}
@endsection

@section('content')

@component('components.header')
@endcomponent

<main class="c-prodcut-detail__container">

  <!-- <img src="/storage/{{$product->pic1 }}" class="c-product-detail__img"> -->
  <img src="data:image/png;base64,{{$product->pic1 }}" class="c-product-detail__img">
  <div class="c-product-detail__name">{{ $product->name}}</div>
  <div class="c-product-detail__body">
    <div class="c-product-detail__item">
      <span>価格</span><span class="c-product-detail__discount">{{ $product->discount}}</span><span class="c-product-detail__discount-letter">円</span><span>(税込み)</span><span class="c-product-detail__price-gray">{{ $product->price }}円</span>
      <div class="c-product-detail__category">{{ $category }}</div>
    </div>

    @if ($login_flg == 2 && $product->sold_flg === 1)
    <div class="c-product-detail__status c-product-detail__status--check">購入済</div>
    @elseif ($product->sold_flg === 1)
    <div class="c-product-detail__status c-product-detail__status--check">在庫<i class="fas fa-times"></i></div>
    @elseif ($product->sold_flg === 0)
    <div class="c-product-detail__status c-product-detail__status--normal">在庫<i class="far fa-circle"></i></div>
    @endif



    <div class="c-product-detail__expiration">
      <span>賞味期限</span>
      <span>
        {{ $product->year}}年{{ $product->month }}月{{ $product->day }}日
        @if( $product->hour )
        {{ $product->hour}}時
        @endif
      </span>
    </div>
    <div class="c-product-detail__item c-product-detail__address"><span>{{ $prefecture }}</span><span>{{ $company->name }}{{ $company->store }}</span></div>


      @if (($login_flg === 1 && $product->sold_flg === 1) || ($login_flg === 3 && $product->sold_flg === 1) || ($login_flg === 5 && $product->sold_flg === 1))
      <!--　ユーザーが既に購入された商品を見る場合と、オーナーが自分が出品していないかつ未販売の商品を見る場合、未ログインユーザーが販売済の商品を見る場合 -->
      <a class="c-product-detail__btn c-product-detail__btn--warning"><i class="fas fa-times"></i>　購入できません</a>

    @elseif ($login_flg === 1 && $product->sold_flg === 0)
    <!--　ユーザーが未販売の商品を見る場合 -->
      <form method="post" action="{{ route('orders.create', $product->id )}}" class="js-form">
        @csrf
        <input class="c-product-detail__btn c-product-detail__btn--hover-normal js-input" type="button" value="購入する">
      </form>

      @elseif ($login_flg == 2 && $product->sold_flg === 1)
      <!--　ユーザーが自分が購入した商品を見る場合 -->
      <form method="post" action="{{ route('orders.destroy', $product->id )}}" class="js-form">
        @csrf
        <input class="c-product-detail__btn c-product-detail__btn--hover-warning js-input" type="button" value="購入をキャンセルする">
      </form>

      @elseif ( $login_flg == 3 && $product->sold_flg == '0')
      <!--　オーナーが自分が出品していない、かつ未販売の商品を見る時 -->
      <a class="c-product-detail__btn c-product-detail__btn--warning"><i class="fas fa-times"></i>　オーナーは購入できません</a>

      @elseif ($login_flg === 4)
      <!--　オーナーが自分が出品した商品を見る時 -->
      @elseif ($login_flg == 5 && $product->sold_flg == '0')
      <!--　未ログインユーザーが未販売の商品を見る時 -->
      <form method="get" action="{{ route('login')}}" class="js-form">
        @csrf
        <input class="c-product-detail__btn c-product-detail__btn--hover-normal js-input" type="button" value="ログインして購入する">
      </form>


    @endif


  </div>
</main>

@endsection
