<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* localhost アクセス時に商品一覧へリダイレクト */
Route::redirect('/', '/products');

/* 商品一覧 */
Route::get('/products', [ProductController::class, 'index']);
/* 商品検索 */
Route::get('/products/search', [ProductController::class, 'search']);
/* 商品登録画面 */
Route::get('/products/register', [ProductController::class, 'register']);
/* 商品登録処理 */
Route::post('/products/register', [ProductController::class, 'store']);
/* 商品詳細画面 */
Route::get('/products/{id}', [ProductController::class, 'detail']);
/* 商品更新処理 */
Route::post('/products/{id}/update', [ProductController::class, 'update']);
/* 商品削除処理 */
Route::post('/products/{id}/delete', [ProductController::class, 'destroy']);

