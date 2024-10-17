<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JeuxController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login_test', [AuthController::class, 'showLoginTestForm'])->name('login_test');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {
    Route::resource('utilisateurs', UtilisateurController::class);
    Route::get('/jeux', [HomeController::class, 'jeux'])->name('jeux');
    Route::get('/blackjack', [JeuxController::class, 'blackjack'])->name('blackjack');
    Route::get('/shifumi', [JeuxController::class, 'shifumi'])->name('shifumi');
    Route::get('/pile_ou_face', [JeuxController::class, 'pileOuFace'])->name('pile_ou_face');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/shifumi', [JeuxController::class, 'showShifumiForm'])->name('shifumi');
    Route::post('/shifumi', [JeuxController::class, 'playShifumi']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/blackjack', [JeuxController::class, 'showBlackjackForm'])->name('blackjack');
    Route::post('/blackjack', [JeuxController::class, 'playBlackjack']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pile_ou_face', [JeuxController::class, 'showPileOuFaceForm'])->name('pile_ou_face');
    Route::post('/pile_ou_face', [JeuxController::class, 'playPileOuFace']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pile_ou_face', [JeuxController::class, 'showPileOuFaceForm'])->name('pile_ou_face');
    Route::post('/pile_ou_face', [JeuxController::class, 'playPileOuFace']);
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UtilisateurController::class, 'showProfil'])->name('profile');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/classement', [UtilisateurController::class, 'showClassement'])->name('classement');
});

Route::middleware(['auth'])->group(function () {
    Route::get('edit', [UtilisateurController::class, 'showEdit'])->name('edit');
    Route::post('edit/update', [UtilisateurController::class, 'update'])->name('edit.update');
});
