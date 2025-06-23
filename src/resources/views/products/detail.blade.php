@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection


@section('content')
<div class="detail">
    <div class="breadcrumb">
        <a href="">商品一覧</a> ＞ {{ $product->name }}
    </div>
    <form action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
        @csrf
        <div class="detail-form" >
            <div dlass="detail-form__image">
                <img class="product-image" src="{{ asset('storage/fruits-img/'. $product->image) }}" alt="{{ $product->name}}">
                <input class="register-form__select-image" type="file" name="image" value="{{ old('image', $product->image) }}">
                <p class="error-message">
                    @error('image')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="detail-form__information">
                <div class="product__name">
                    <label class="product__name-label">商品名</label>
                    <input class="product__input-name" type="text" name="name" value="{{ old('name', $product->name) }}">
                    <p class="error-message">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
                <div clkass="product__price">
                    <label class="product__price-label" for="">値段</label>
                    <input class="product__input-price" type="text" name="price" value="{{ old('price', $product->price) }}">
                    <p class="error-message">
                        @error('price')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="product_season">
                    <label class="product__season-label">季節</label>
                    <div class="season-container">
                        @foreach($seasons as $season)
                            <div class="season-option">
                                <input class="season-checkbox" type="checkbox" name="seasons[]" value="{{ $season->id }}"
                                    id="season{{ $season->id }}"
                                    {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label for="season{{ $season->id }}" class="season-label"></label>
                                <span class="season-name">{{ $season->name }}</span>
                            </div>
                        @endforeach
                    </div>
                    <p class="error-message">
                        @error('season')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
            </div>
        </div>
        <div class="detail-form__description2">
            <label class="detail-form__description-label">商品説明</label>
            <textarea class="detail-form__input-description" name="description" cols="20" rows="5">{{ old('description', $product->description) }}</textarea>
        </div>
        <p class="error-message">
            @error('description')
                {{ $message }}
            @enderror
        </p>
        <div class="detail-form__button">
            <button class="detail-form__back-button" type="button" onclick="location.href='/products'">戻る</button>
            <button class="detail-form__register-button" type="submit">変更を保存</button>
        </div>
    </form>
    <form class="detail-form__delete" action="/products/{{ $product->id }}/delete" method="post">
        @csrf
        <button class="detail-form__trash" type="submit">
            <!-- 🗑 -->
            <img class="trash-icon" src="{{ asset('images/trashCan.png') }}" alt="削除">
        </button>
    </form>
</div>
@endsection
