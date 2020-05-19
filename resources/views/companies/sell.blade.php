@extends('layouts.app')

@section('title')
haiki share販売商品一覧
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
  <div class="c-owner-product-sell__head-info">販売した{{ $productCount }}件のうち {{ $productList->firstItem() }}-{{ $productList->lastItem() }}件</div>

@foreach( $productList as $product )
<div class="c-owner-product-sell__box">
  <div class="c-owner-product-sell__sell-date">販売日　{{ $product->date }}</div>
  <div class="c-owner-product-sell__img-box">
  	<img src="/storage/{{$product->pic1 }}" class="c-owner-product-sell__img" />
  	<div class="c-owner-product-sell__img-mask">
  		<div class="c-owner-product-sell__img-word">{{ $product->name }}</div>
  		<div class="c-owner-product-sell__img-word">{{ $product->discount }}円</div>
      <a class="c-owner-product-sell__btn" href="{{ route('products.show', $product->id ) }}">詳細を見る　<i class="fas fa-arrow-right c-owner-product-sell__btn-logo"></i></a>
  	</div>
  </div>
</div>
@endforeach

</div>
<div>
  {{ $productList->links('pagination::default') }}
</div>

@endsection
