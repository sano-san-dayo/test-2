@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-form">
    <div class="register-form__inner">
        <h2 class="register-form__heading">商品登録</h2>
        <form action="/products/register" method="post" enctype="multipart/form-data">
            @csrf
            <div class="register-form__name">
                <div class="register-form__label">
                    商品名
                    <span class="register-form__required">必須</span>
                </div>
                <div class="register-form__input">
                    <input name="name" type="text" placeholder="商品名を入力">
                </div>
            </div>
            <p class="error-message">
                @error('name')
                    {{ $message }}
                @enderror
            </p>
            <div class="register-form__price">
                <div class="register-form__label">
                    値段
                    <span class="register-form__required">必須</span>
                </div>
                <div class="register-form__input">
                    <input name="price" type="text" placeholder="値段を入力">
                </div>
            </div>
            <p class="error-message">
                @error('price')
                    {{ $message }}
                @enderror
            </p>
            <div class="register-form__image" >
                <div class="register-form__label">
                    商品画像
                    <span class="register-form__required">必須</span>
                </div>
                <div class="register-form__select-image">
                    <input type="file" name="image">
                </div>
            </div>
             <p class="error-message">
                @error('image')
                    {{ $message }}
                @enderror
            </p>
           <div class="register-form__season">
                <div class="register-form__label">
                    季節
                    <span class="register-form__required">必須</span>
                    <span class="register-form__supplement">複数選択可能</span>
                </div>
                <div class="season-container">
                    @foreach($seasons as $season)
                        <div class="season-option">
                            <input class="season-checkbox" type="checkbox" name="seasons[]" value="{{ $season->id }}" id="season{{ $season->id }}">
                            <label for="season{{ $season->id }}" class="season-label"></label>
                            <span class="season-name">{{ $season->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <p class="error-message">
                @error('seasons')
                    {{ $message }}
                @enderror
            </p>
            <div class="register-form_description">
                <div class="register-form__label">
                    商品説明
                    <span class="register-form__required">必須</span>
                </div>
                <textarea class="register-form__textarea" name="description"></textarea>
            </div>
            <p class="error-message">
                @error('description')
                    {{ $message }}
                @enderror
            </p>
            <div class="register-form__button-innser">
                <button class="register-form__back-button" type="button" onclick="location.href='/products'">戻る</button>
                <button class="register-form__register-button" type="submit" name="register">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection