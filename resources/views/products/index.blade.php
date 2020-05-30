@extends('layouts.app')

@section('title')
{{config('app.name')}} | 商品一覧
@endsection

@section('content')


@component('components.header')
@endcomponent

<form class="c-search-tab" method="get" action="{{ route('products.search')}}">
@csrf
  <div class="c-search-tab__main-container">

        <div class="c-search-tab__item">
          <div class="c-search-tab__label">都道府県</div>
          <div class="c-search-tab__select-box">
            <select name="prefecture_id" class="u-bgc-gray">
            	<option value="" hidden>-未選択-</option>
              @foreach ($prefectures as $prefecture)
            	<option value="{{{ $prefecture->id }}}">{{{ $prefecture->name }}}</option>
              @endforeach
            </select>
          </div>
        </div>
        @error('prefecture_id')
        <span class="c-auth--error">
          <strong>{{ $message }}</strong>
        </span>
        @enderror

        <div class="c-search-tab__item">
          <div class="c-search-tab__label">カテゴリー</div>
          <div class="c-search-tab__select-box c-search-tab__select--bigger">
            <select name="category_id" class="u-bgc-gray">
              <option value="" hidden>-未選択-</option>
              @foreach ($categories as $category)
              <option value="{{{ $category->id }}}">{{{ $category->name }}}</option>
              @endforeach
            </select>
          </div>
        </div>
        @error('category_id')
        <span class="c-auth--error">
          <strong>{{ $message }}</strong>
        </span>
        @enderror


        <div class="c-search-tab__item-for-price">
          <div class="c-search-tab__label-for-price">値段</div>
          <input class="c-search-tab__input-for-price" type="text" name="price_bottom"/>
          <span class="c-search-tab__simbol-for-price">円　-　</span>
          <input class="c-search-tab__input-for-price" type="text" name="price_top"/>
          <span class="c-search-tab__simbol-for-price"->円</span>
      </div>
      @error('price-top')
      <span class="c-auth--error">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
      @error('price-bottom')
      <span class="c-auth--error">
        <strong>{{ $message }}</strong>
      </span>
      @enderror


      <div class="c-search-tab__item-for-checkbox">
        <div class="c-search-tab__label-for-checkbox">賞味期限切れ</div>
        <div class="c-search-tab__checkbox">
            <input id="expiration" value="1" name="expiration" type="checkbox" class="checkbox"checked><label for="expiration">表示</label>
        </div>

        <div class="c-search-tab__label-for-checkbox">在庫なし</div>
        <div class="c-search-tab__checkbox">
          <input id="sold" value="1" name="sold" type="checkbox" class="checkbox"><label for="sold">表示</label>
        </div>
      </div>



      <div class="c-search-tab__create-btn-box">
        <input class="c-search-tab__create-btn" type="submit" value="この条件で検索">
        <i class="fas fa-arrow-right c-search-tab__logo"></i>
      </div>
  </div>
</form>

<div class="c-product-list__container">

  <div class="c-product-list__head-info">
    検索結果{{ $productList->total() }}件のうち
    {{ $productList->firstItem() }}
    @if ($productList->total() === 0)
    0
    @else
    -
    @endif
    {{ $productList->lastItem() }}件<br />
    @if ($searchConditions)
    <div class="c-product-list__head-info-conditions">
      検索条件
      @foreach ( $searchConditions as $list)
      <span> > {{$list}}</span>
      @endforeach
    </div>
    @endif
  </div>

  @foreach( $productList as $product )
  <a href="{{ route('products.show', $product->product_id )}}" class="c-product-list__box">

    <!-- <img src="/storage/{{$product->pic1 }}" class="c-product-list__img"> -->
    <img src="data:image/png;base64,{{$product->pic1 }}" class="c-product-list__img">
    <div class="c-product-list__body">
      <div class="c-procut-list__item"><i class="fas fa-yen-sign"></i><span class="c-product-list__discount">{{ $product->discount }}</span><span class="c-product-list__price">{{ $product->price }}</span></div>
      <div class="c-procut-list__item c-product-list__name">{{ $product->product_name }}</div>
      <div class="c-procut-list__item c-procut-list__store">{{ $product->company_name }}</div>
      <div class="c-procut-list__item c-procut-list__address">{{ $product->prefecture_name }}{{ $product->store }}</div>
    </div>
    @if ($product->sold_flg == 0)
    <div class="c-product-list__status c-product-list__status--normal"><i class="far fa-circle"></i></div>
    @elseif ($product->sold_flg == 1)
    <div class="c-product-list__status c-product-list__status--check"><i class="fas fa-times"></i></div>
    @endif

  </a>
  @endforeach

</div>
<div>
  {{$productList->appends(request()->input())->links('pagination::default')}}

</div>
</div>

</div>
</main>

@endsection
