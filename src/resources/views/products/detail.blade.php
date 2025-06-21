@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection


@section('content')
<div class="detail">
    <form class="detail-form" action="{{ route('products.update', $product->id) }}" method="post" emctype="multipart/form-data">
        @csrf
        <div class="detail-form__inner">
            <div dlass="detail-form__image">
                <img class="product-image" src="{{ asset('storage/fruits-img/'. $product->image) }}" alt="{{ $product->name}}">

                <div class="register-form__select-image">
                    <input type="file" name="image" value="{{ $product->image }}">
                </div>
            </div>
            <div class="detail-form__information">
                <div class="product__name">
                    <label class="product__name-label">商品名</label>
                    <input class="product__input-name" type="text" name="name" value="{{ $product->name }}">
                </div>
                <div clkass="product__price">
                    <label class="product__price-label" for="">値段</label>
                    <input class="product__input-price" type="text" name="price" value="{{ $product->price}}">
                </div>
                <div class="product_season">
                    <label class="product__season-label">季節</label>
                    <div class="detail-form__inner-season">
                        @foreach ($seasons as $season)
                            <div class="detail-form__select-season">
                                <label class="season-option">
                                    <input class="register-form__select-inline" type="checkbox" name="seasons[]" value="{{ $season->id }}"
                                        {{ $product->seasons->contains($season->id) ? 'checked' : '' }}>
                                    {{ $season->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
        </div>
        <div class="detail-form__description">
            <label class="detail-form__description-label">商品説明</label>
            <textarea class="detail-form__input-description" name="description" cols="20" rows="5">{{ $product->description }}</textarea>
        </div>
        
        <div class="detail-form__button">
            <button class="detail-form__button-back" onclick="history.back()">戻る</button>
            <button class="detail-form__button-register" name="update" type="submit">変更を保存</button>
            <form class="detail-form__delete" action="{{ route('products.destroy', $product->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="detail-form__trash">🗑</button>
            </form>
        </div>
    </form>
</div>
@endsection
