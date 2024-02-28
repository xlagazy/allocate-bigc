<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AlloCateController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ConditionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
    return redirect('/upload');
});

Route::get('/upload', [AlloCateController::class, 'upload']);

Route::post('/import', [AlloCateController::class, 'import']);

Route::get('/download/{fileName}', [AlloCateController::class, 'download']);

//Route login and logout
Route::post('/login', [Controller::class, 'login']);

Route::get('/logout', [Controller::class, 'logout']);

//Route article controller
Route::get('/article', [ArticleController::class, 'article']);

Route::get('/article/search', [ArticleController::class, 'searchArticle']);

Route::post('/article/update', [ArticleController::class, 'update']);

//Route condition controller
Route::get('/condition', [ConditionController::class, 'condition']);

Route::get('/condition/search', [ConditionController::class, 'searchCondition']);

Route::post('/condition/update', [ConditionController::class, 'update']);

