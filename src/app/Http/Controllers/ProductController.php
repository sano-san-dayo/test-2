<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {
        $query = Product::query();

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        $sort = $request->get('sort');
        if ($sort === 'descend') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'ascend') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6);

        return view('products', compact('products', 'sort'));
    }

    public function register() {
        $seasons = Season::all();

        return view('register', compact('seasons'));
    }

    public function store(Request $request) {
        if ($request->has('back')) {
            return redirect('/')->withInput();
        }

        $data = $request->only(['name', 'price', 'image', 'description']);
        $data['image'] = 'hoge.png';
        $product = Product::create($data);
        $product->seasons()->sync($request->input('seasons'));

        $products = Product::with('seasons')->paginate(6);
        $sort = '';

        return view('products', compact('products', 'sort'));
    }

    /* 商品変更・削除画面 */
    public function detail($id)
    {
        $seasons = Season::all();
        $product = Product::with('seasons')->findOrFail($id);

        return view('products.detail', compact('product', 'seasons'));
    }

    /* 商品情報更新 */
    public function update(Request $request, $id) {
        dd($id);
        $product = Product::findOrFail($id);
        if ($request->hasFile('image')) {
            $request->file('image')->store('images', 'public');
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        $product->seasons()->sync($request->seasons ?? []);

        $products = Product::with('seasons')->paginate(6);
        $sort = '';

        return view('products', compact('products', 'sort'));
    }

    /* 商品削除 */
    public function destroy($id) {
        dd($id);
        Product::destroy($id);

        return redirect()->route('product.index');
    }
}
