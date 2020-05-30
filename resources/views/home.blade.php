@extends('layouts.app')

@section('title')
haiki shareマイページ
@endsection

@section('content')

@component('components.header')
@endcomponent

@component('components.sub-head')
  @slot('title')
   マイページ
  @endslot
@endcomponent

<section class="p-sub-head-modal__container">
  <ul class="p-sub-head-modal__bar ">
    <li class="p-sub-head-modal__box">
      <a class="p-sub-head-modal__title" href="{{ route('users.edit', Auth::user()->id) }}">アカウント情報変更</a><i class="fas fa-arrow-circle-right p-sub-head-modal__logo"></i>
    </li>
    <li class="p-sub-head-modal__box">
      <a class="p-sub-head-modal__title" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a><i class="fas fa-arrow-circle-right p-sub-head-modal__logo"></i>
    </li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
  </ul>
</section>

<main class="c-mypage-container">

  <div class="c-mypage-container__title-box">
    <div class="c-mypage-container__title">注文履歴</div>
  </div>
  <div class="c-mypage__head-info">
    @if ($productList->total() == 0)
    購入した商品はありません
    @else
    購入商品{{ $productList->total() }}件のうち {{ $productList->firstItem() }}-{{ $productList->lastItem() }}件
    @endif
  </div>



  @foreach( $productList as $product)
  <div class="c-mypage-box">
    <a href="{{ route('products.show', $product->id ) }}">

    <!-- <img src="/storage/{{$product->pic1 }}" class="c-mypage-box__img"> -->
    <img src="data:image/png;base64,{{$product->pic1 }}" class="c-mypage-box__img">

    <div class="c-mypage-box__info">
      <div class="c-mypage-box__item">{{ $product->name }}</div>
      <div class="c-mypage-box__item"><span class="c-price-red">{{ $product->discount }}円</span><span class="c-price-line">{{ $product->price }}円</span></div>
      <div class="c-mypage-box__item-for-date">購入日：{{ $product->date }}</div>
      <div class="c-mypage-box__item-for-date">
        賞味期限：{{ $product->year }}年{{ $product->month }}月{{ $product->day }}日
        @if( $product->hour )
        {{ $product->hour}}時
        @endif
      </div>
      <div class="c-mypage-box__btn-container">

        <a class="c-mypage-box__btn c-mypage-box__btn--check c-mypage-box__user-sp-size-btn"><i class="fas fa-check u-pr-10-sp-5"></i>購入済</a>
        <div>
          <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false" data-url="http://homestead.test/products" data-hashtags="コンビニ廃棄"
          data-text="{{$product->company}}で{{$product->name}}を{{$product->discountRate}}％割引の{{$product->discount}}円で買いました！">Tweet</a>
        </div>
      </div>
    </div>
  </a>
  </div>
  @endforeach


</main>
<div>
  {{ $productList->links('pagination::default') }}
</div>

@endsection
