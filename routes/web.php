<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestTsukuruController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('auth.login');
});

//アカウント新規作成表示
Route::get('/register', [TestTsukuruController::class, 'register'])->name('register');

//生徒用 インデックス表示
Route::get('/index_student', [TestTsukuruController::class, 'index_student'])->name('index_student');

//生徒用 テスト受験画面表示
Route::post('/exam', [TestTsukuruController::class, 'exam'])->name('exam');

//生徒用 テスト結果画面表示
Route::post('/exam_result', [TestTsukuruController::class, 'exam_result'])->name('exam_result');

//教師用 インデックス表示
Route::get('/index_teacher', [TestTsukuruController::class, 'index_teacher'])->name('index_teacher');

//教師用 テスト編集画面表示
Route::get('/test_edit', [TestTsukuruController::class, 'test_edit'])->name('test_edit');
Route::post('/test_edit', [TestTsukuruController::class, 'test_edit'])->name('test_edit');

//教師用 テスト問題検索画面
Route::get('/test_search', [TestTsukuruController::class, 'test_search'])->name('test_search');
Route::post('/test_search', [TestTsukuruController::class, 'test_search'])->name('test_search');

//教師用 テスト編集画面確認
Route::post('/test_confirm', [TestTsukuruController::class, 'test_confirm'])->name('test_confirm');

//教師用 テスト作成完了
Route::post('/index_teacher', [TestTsukuruController::class, 'test_create'])->name('test_create');

//教師用 テスト結果一覧画面表示
Route::get('/test_result', [TestTsukuruController::class, 'test_result'])->name('test_result');

//教師用 生徒一覧画面表示
Route::get('/student_list', [TestTsukuruController::class, 'student_list'])->name('student_list');

//教師用 生徒詳細画面表示
Route::post('/student_detail', [TestTsukuruController::class, 'student_detail'])->name('student_detail');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
