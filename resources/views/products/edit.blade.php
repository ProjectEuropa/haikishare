@extends('layouts.app')

@section('title')
{{config('app.name')}} | {{ $product->name }}編集画面
@endsection

@section('content')


@component('components.header')
@endcomponent

@component('components.sub-head')
  @slot('title')
   商品情報変更
  @endslot
@endcomponent



  <div class="c-product__container">
    <form method="post" action="{{ route('products.update', $product->id )}}" enctype="multipart/form-data" class="js-form">
      @method('PATCH')
      @csrf
      <div id="picture">
        <picture-component pic="data:image/png;base64,{{ $product->pic1 }}"></picture-component>
      </div>
      @error('pic1')
      <span class="c-auth--error">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
      <div class="c-product__item">
        <div class="c-product__info"><div class="c-product__name">商品名</div><div class="c-product__label">必須</div></div>
        <input class="c-product__input-name" type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="例)鮭おにぎり"/>
      </div>
      @error('name')
          <span class="c-auth--error">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
      <div class="c-product__item">
        <div class="c-product__info"><div class="c-product__name">定価</div><div class="c-product__label">必須</div></div>
        <input class="c-product__input--small" type="text" name="price" value="{{ old('price', $product->price) }}"placeholder="例)150"/><span class="c-product__letter-for-yen">円</span>
      </div>
      @error('price')
          <span class="c-auth--error">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
      <div class="c-product__item">
        <div class="c-product__info"><div class="c-product__name">出品価格</div><span class="c-product__label">必須</span></div>
        <input class="c-product__input--small" type="text" name="discount" value="{{ old('discount', $product->discount) }}" placeholder="例)70"/><span class="c-product__letter-for-yen">円</span>
      </div>
      @error('discount')
          <span class="c-auth--error">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <div class="c-product__item">
        <div class="c-product__info">
          <div class="c-product__name">種類</div><div class="c-product__label">必須</div>
        </div>
        <div class="c-product__select-box">
          <select class="c-product__select u-bgc-gray" name="category_id">
            <option value="" hidden>選択してください</option>
            @foreach ($categories as $category)
            @if ( old('category_id', $product->category_id) == $category->id)
            <option value="{{{ $category->id }}}" selected >{{ $category->name }}</option>
            @else
            <option value="{{{ $category->id }}}">{{ $category->name }}</option>
            @endif
            @endforeach
          </select>
        </div>
      </div>
      @error('category_id')
          <span class="c-auth--error">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <div class="c-product__item">
        <div class="c-product__info"><div class="c-product__name">賞味期限</div><div class="c-product__label">必須</div></div>
        <input class="c-product__input-for-expiration" type="text" name="year" value="{{ old('year', $product->year) }}" placeholder="例)2020"/><div class="c-product__letter">年</div>
        <input class="c-product__input-for-expiration-small" type="text" name="month" value="{{ old('month', $product->month) }}" placeholder="例)05"/><div class="c-product__letter">月</div>
        <input class="c-product__input-for-expiration-small" type="text" name="day" value="{{ old('day', $product->day) }}" placeholder="例)01"/><div class="c-product__letter">日</div>
      </div>
      @error('year')
      <span class="c-auth--error">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
      @error('month')
      <span class="c-auth--error">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
      @error('day')
      <span class="c-auth--error">
        <strong>{{ $message }}</strong>
      </span>
      @enderror

      <div class="c-product__item">
        <div class="c-product__info"><div class="c-product__name">賞味期限</div><div class="c-product__label c-product__label--blank">任意</div></div>
        <input class="c-product__input-for-expiration" type="text" name="hour" value="{{ old('hour', $product->hour) }}" placeholder="例)21"/><div class="c-product__letter">時</div>
      </div>
      @error('hour')
          <span class="c-auth--error">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="c-product__btn-box">
      <input class="c-product__btn c-product__create-btn js-input" type="button" value="この内容で商品を再出品する">
    </div>
  </form>

  <form method="post" action="{{ route('products.destroytoggle', $product->id )}}" class="js-alert-form">
    @csrf
    <div class="c-product__btn-box">
      <input class="c-product__btn c-product__warning-btn js-alert-input" type="button"  value="この商品の出品をキャンセル">
    </div>
  </form>

  </div>


@endsection
