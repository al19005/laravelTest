<?php

use App\Http\Controllers\ChannelsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return redirect('/tweets');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ログイン状態
Route::group(['middleware' => 'auth'], function() {

    // ユーザ関連
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);

    // フォロー/フォロー解除を追加
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');

    // ツイート関連
    Route::resource('tweets', 'TweetsController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);

    Route::resource('comments', 'CommentsController', ['only' => ['store']]);

    Route::resource('favorites', 'FavoritesController', ['only' => ['store', 'destroy']]);

    Route::resource('channels', 'ChannelsController', ['only' => ['store', 'create']]);

    Route::resource('joins', 'JoinsController', ['only' => ['store', 'destroy']]);

    Route::get('search', 'SearchController@index');

});
