@extends('layouts.app')

@section('title')
haiki share | 販売商品一覧
@endsection

@section('content')


@component('components.header')
@endcomponent

@component('components.sub-head')
  @slot('title')
   販売商品リスト
  @endslot
@endcomponent



<div class="c-owner-product-sell__container">
  <div class="c-owner-product-sell__head-info">
    @if ($productList->total() == 0)
    販売した商品はありません
    @else
    販売した{{ $productList->total()}}件のうち {{ $productList->firstItem() }}-{{ $productList->lastItem() }}件
    @endif
  </div>
  <!-- スマホのみ非表示ここから-->
  <div class="u-sp-no-display">
  @foreach( $productList as $product )
  <div class="c-owner-product-sell__box">
    <div class="c-owner-product-sell__sell-date">販売日　{{ $product->date }}</div>
    <div class="c-owner-product-sell__img-box">
      <!-- <img src="/storage/{{$product->pic1 }}" class="c-owner-product-sell__img"> -->
      <img src="data:image/png;base64,{{$product->pic1 }}" class="c-owner-product-sell__img">
        <div class="c-owner-product-sell__img-mask">
    		<div class="c-owner-product-sell__img-word">{{ $product->product_name }}</div>
    		<div class="c-owner-product-sell__img-word">{{ $product->discount }}円</div>
        <a class="c-owner-product-sell__btn" href="{{ route('products.show', $product->product_id ) }}">詳細を見る　<i class="fas fa-arrow-right c-owner-product-sell__btn-logo"></i></a>
    	</div>
    </div>
  </div>
  @endforeach
  </div>
  <!-- スマホのみ非表示ここまで-->

  <!-- スマホのみ表示ここから-->
  <div class="u-sp-display">
    @foreach( $productList as $product)
        <a href="{{ route('products.show', $product->product_id ) }}" class="c-mypage-box">

        <!-- <img src="/storage/{{$product->pic1 }}" class="c-mypage-box__img"> -->
        <img src="data:image/png;base64,{{$product->pic1 }}" class="c-mypage-box__img">
        <div class="c-mypage-box__info--text">
          {{ $product->date }}に販売しました
        </div>
      </a>
    @endforeach
  </div>
  <!-- スマホのみ表示ここまで-->

</div>
<div>
  {{ $productList->links('pagination::default') }}
</div>

@endsection
