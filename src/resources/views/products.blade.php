@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
<div class="products">
    <form class="products__heading" action="/products/register" method="get">
        <label class="title__label">商品一覧</label>
        <button class="add-product__button">+ 商品を追加</button>
    </form>
    <div class="products__innder">
        <div class="sidebar">
            <form class="search-form" acton="/products/search" method="get">
                @csrf
                <input class="search-form__keyword-input" type="text" name="keyword" placeholder="商品名で検索">
                <button class="search-form__button" type="submit">検索</button>
            </form>
            <form class="sort-form" action="/" method="get">
                <label class="search-form__label">価格順で表示</label>
                <select class="search-form__select" name="sort" onchange="this.form.submit()">
                    <option disabled selected>価格で並べ替え</option>
                    <option value="descend" {{ $sort === 'descend' ? 'selected' : '' }}>高い順に表示</option>
                    <option value="ascend" {{  $sort === 'ascend}' ? 'ascend' : '' }}>安い順に表示</option>
                </select>
            </form>
            @if ($sort)
                <div class="sort-tag">
                    {{ $sort == 'descend' ? '高い順に表示' : '安い順に表示'}}
                    <form class="tag-form" action="/" method="get">
                        <button class="tag-form__button" type="submit">×</button>
                    </form>
                </div>
            @endif
        </div>
        <div class="contents">
            <div class="product-grid">
                @foreach ($products as $product)
                <div class="product-card">
                    <a href="{{ route('products.detail', $product->id) }}">
                        <img class="product-image" src="{{ asset('storage/fruits-img/'. $product->image) }}" alt="{{ $product->name }}">
                    </a>
                    <div class="product-info">
                        <span class="product-name">{{ $product->name }}</span>
                        <span class="product-price">{{ $product->price }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection