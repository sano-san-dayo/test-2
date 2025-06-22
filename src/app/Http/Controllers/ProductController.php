<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /* 商品一覧画面 */
    public function index() {
        /* データ取得 */
        $products = Product::paginate(6);
        $sort = '';

        return view('products.products', compact('products', 'sort'));
    }

    /* 商品検索 */
    public function search(Request $request) {
        $query = Product::query();

        /* キーワード検索 */
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        /* 値段によるソート */
        $sort = $request->get('sort');
        if ($sort === 'descend') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'ascend') {
            $query->orderBy('price', 'asc');
        }

        /* データ取得 */
        $products = $query->paginate(6);

        return view('products.products', compact('products', 'sort'));
    }

    /* 商品情報登録画面 */
    public function register() {
        $seasons = Season::all();

        return view('products.register', compact('seasons'));
    }

    /* 商品情報登録 */
    public function store(ProductRequest $request) {
        if ($request->has('back')) {
            /* 戻る ボタン押下時 */
            // return redirect('/');
            return redirect('/')->withInput();
        } elseif ($request->has('register')) {
            /* 登録 ボタン押下時 */
            /* 商品情報 DB登録 */
            $data = $request->only(['name', 'price', 'description']);
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $data['image'] = $fileName;
            $product = Product::create($data);
            $product->seasons()->sync($request->input('seasons'));

            /* 商品画像ファイルアップロード */
            Storage::disk('public')->putFileAs('fruits-img', $file, $fileName);

            return redirect('/');
        }

        $seasons = Season::all();
        return view('products.register', compact('seasons'));
}

    /* 商品変更・削除画面 */
    public function detail($id)
    {
        $seasons = Season::all();
        $product = Product::with('seasons')->findOrFail($id);

        return view('products.detail', compact('product', 'seasons'));
    }

    /* 商品情報更新 */
    public function update(ProductRequest $request, $id) {
    // public function update(ProductRequest $request, Product $product) {
        /* 対象商品の情報取得 */
        $product = Product::findOrFail($id);

        /* ファイルが指定されていればファイルをアップロードし、ファイル名を更新 */
        if ($request->hasFile('image')) {
            /* 商品画像ファイルアップロード */
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            Storage::disk('public')->putFileAs('fruits-img', $file, $fileName);
        } else {
            $fileName = $product->image;
        }

        /* 商品情報テーブル更新 */
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $fileName,
            'description' => $request->description,
        ]);

        /* 中間テーブル更新 */
        // $product->seasons()->sync($request->seasons ?? []);
        $product->seasons()->sync($request->input('seasons', []));

        return redirect('/');
    }

    /* 商品削除 */
    public function destroy($id) {
        /* 削除処理 */
        Product::destroy($id);

        return redirect('/');
    }
}
