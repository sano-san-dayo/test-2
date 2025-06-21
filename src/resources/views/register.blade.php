@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-form">
    <h2 class="register-form__heading">商品登録</h2>
    <div class="register-form__inner">
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
            <div class="register-form__price">
                <div class="register-form__label">
                    値段
                    <span class="register-form__required">必須</span>
                </div>
                <div class="register-form__input">
                    <input name="price" type="text" placeholder="値段を入力">
                </div>
            </div>
            <div class="register-form__image" >
                <div class="register-form__label">
                    商品画像
                    <span class="register-form__required">必須</span>
                </div>
                <div class="register-form__select-image">
                    <input type="file" name="image">
                </div>
            </div>
            <div class="register-form__season">
                <div class="register-form__label">
                    季節
                    <span class="register-form__required">必須</span>
                    <span class="register-form__supplement">複数選択可能</span>
                </div>
                <div class="register-form__inner-season">
                    @foreach ($seasons as $season)
                    <div class="register-form__select-season">
                        <label class="season-option">
                            <input class="register-form__select-inline" type="checkbox" name="seasons[]" value="{{ $season->id }}">
                            {{ $season->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="register-form_detail">
                <div class="register-form__label">
                    商品説明
                    <span class="register-form__required">必須</span>
                </div>
                <textarea class="register-form__textarea" name="description" cols="30" rows="10"></textarea>
            </div>
            <div class="register-form__button-innser">
                <button class="register-form__back-button" type="submit" name="back">戻る</button>
                <button class="register-form__register-button" type="submit" name="register">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection