<?php
    
    use App\Http\Controllers\BlogController;
    use App\Http\Controllers\FavoriteController;
    use App\Http\Controllers\HomeControler;
    use App\Http\Controllers\LanguageController;
    use App\Http\Controllers\ProductController;
    use App\Livewire\Settings\Appearance;
    use App\Livewire\Settings\Password;
    use App\Livewire\Settings\Profile;
    use Illuminate\Support\Facades\Route;
    
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    
    Route::view('/', '/home')
      ->middleware(['auth', 'verified'])
      ->name('dashboard');
    
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::redirect('settings', 'settings/profile');
        Route::get('settings/profile', Profile::class)->name('settings.profile');
        Route::get('settings/password', Password::class)->name('settings.password');
        Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    });
    
    require __DIR__.'/auth.php';
    
    
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::get('/', [HomeControler::class, 'home'])->name('home');
    
    Route::get('/buyit/{product}', [ProductController::class, 'buyit'])->name('product.buyit');
    Route::resource('products', ProductController::class);
    Route::resource('blog', BlogController::class);
    Route::get('/lang/{lang}', [LanguageController::class, 'switch'])->name('lang');
    
    
    Route::post('/favorites/toggle/{id}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavoriteController::class, 'getFavorites'])->name('favorites');
    Route::post('/favorites', [FavoriteController::class, 'eliminarCookieFav'])->name('favorites.eliminar');
