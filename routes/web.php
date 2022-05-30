<?php

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/news', [App\Http\Controllers\AuthorizedController::class, 'news'])->name('news');
Route::get('/docs', [App\Http\Controllers\AuthorizedController::class, 'docs'])->name('docs');
Route::get('/docs/category/{category}', [App\Http\Controllers\AuthorizedController::class, 'docs_cat'])->name('docs_cat');

Route::get('/docs/article/{article}', [App\Http\Controllers\AuthorizedController::class, 'article_detail'])->name('article_detail');
Route::post('/docs/article/{article}', [App\Http\Controllers\AuthorizedController::class, 'post_comment'])->name('post_comment');

Route::get('/docs/EditArticle/{article}', [App\Http\Controllers\AuthorizedController::class, 'editarticle'])->name('editarticle');
Route::post('/docs/EditArticle/{article}', [App\Http\Controllers\AuthorizedController::class, 'post_edited_article'])->name('post_edited_article');

Route::get('/docs/DeleteArticle/{article}', [App\Http\Controllers\AuthorizedController::class, 'deletearticle'])->name('deletearticle');

Route::post('/docs', [App\Http\Controllers\AuthorizedController::class, 'docs_search'])->name('docs_search');

Route::get('/docs/NewArticle', [App\Http\Controllers\AuthorizedController::class, 'newarticle'])->name('NewArticle');
Route::post('/docs/NewArticle', [App\Http\Controllers\AuthorizedController::class, 'post_newarticle'])->name('post_NewArticle');

Route::post('/news', [App\Http\Controllers\AuthorizedController::class, 'post_news_desc'])->name('post_news_desc');