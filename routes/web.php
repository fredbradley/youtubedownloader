<?php

use App\Http\Controllers\DownloadController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('form');
})->name('form');
Route::post('show', [DownloadController::class, 'show'])->name('show');
Route::get('download', [DownloadController::class, 'download'])->name('download');
Route::view('terms', 'terms')->name('terms');

Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('google')->user();

    $user = User::updateOrCreate([
        'email' => $user->getEmail(),
    ], [
        'name' => $user->getName(),
        'password' => bcrypt('password'),
    ]);

    Auth::login($user);
    activity()
        ->causedBy($user)
        ->performedOn($user)
        ->log('User logged in using Google');

    return redirect()->route('form');

});
