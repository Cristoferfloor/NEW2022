<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PortafolioController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/',[PortafolioController::class,'datosPortafolio']);
Auth::routes();
Route::get('auth/google', [GoogleAuthController::class,'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class,'callbackGoogle']);
Route::get('portafolio',[PortafolioController::class,'index'])->name('portafolio')->middleware('auth');

Route::get('portafolio/create',[PortafolioController::class,'create'])->name('create')->middleware('auth');

Route::post('portafolio',[PortafolioController::class,'store'])->name('store')->middleware('auth');

Route::get('portafolio/{id}',[PortafolioController::class,'show'])->name('show')->middleware('auth');

Route::get('portafolio/edit/{id}',[PortafolioController::class,'edit'])->name('edit')->middleware('auth');

Route::put('portafolio/{portafolio}',[PortafolioController::class,'update'])->name('update')->middleware('auth');

Route::delete('portafolio/{portafolio}',[PortafolioController::class,'destroy'])->name('destroy')->middleware('auth');

Route::get('/productos',[ProductController::class,'index'])->name('productos');
Route::resource('producto',ProductController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');

Route::post('/send', [App\Http\Controllers\ContactController::class, 'store'])->name('send');

Route::get('/mostrar/{id}', [App\Http\Controllers\ContactController::class, 'mostrar'])->name('mostrar');

Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markAsRead');

Route::get('/auth/github/redirect', function () {
    return Socialite::driver('github')->redirect();
});
 
Route::get('/auth/github/callback', function () {
    $githubUser = Socialite::driver('github')->user();
    
    // crear usuario
    $user = User::firstOrCreate(
        [
            'provider_id' => $githubUser->getId(),
        ],
        [
            'email' => $githubUser->getEmail(),
            'name' => $githubUser->getName(),
        ]
    );
    // login del usuario
    auth()->login($user, true);
    // redireccionamiento al dashboard
    return redirect('home');
});
