<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SidebarPageController;
use App\Http\Controllers\Public\PublicPageController;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale}')->where(['locale' => 'id|en'])->middleware('setlocale')->group(function () {
    Route::get('/', [PublicPageController::class, 'home'])->name('public.home');
    Route::get('events', [PublicPageController::class, 'events'])->name('public.events.index');
    Route::get('events/{slug}', [PublicPageController::class, 'showEvent'])->name('public.events.show');
    Route::post('events/{slug}/register', [PublicPageController::class, 'registerEvent'])->name('public.events.register');
    Route::get('speakers', [PublicPageController::class, 'speakers'])->name('public.speakers.index');
    Route::get('about', [PublicPageController::class, 'about'])->name('public.about');
    Route::get('profile', [PublicPageController::class, 'profile'])->name('public.profile');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.submit');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        Route::middleware('auth')->group(function () {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::resource('events', EventController::class)->except(['show']);

            // Halaman Profil & Foto NAS
            Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
            Route::post('profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
            Route::get('profile/avatar', [ProfileController::class, 'showAvatar'])->name('profile.avatar.show');

            Route::get('categories', [SidebarPageController::class, 'categories'])->name('categories.index');
            Route::get('categories/create', [SidebarPageController::class, 'createCategory'])->name('categories.create');
            Route::post('categories', [SidebarPageController::class, 'storeCategory'])->name('categories.store');
            Route::get('categories/{category}/edit', [SidebarPageController::class, 'editCategory'])->name('categories.edit');
            Route::put('categories/{category}', [SidebarPageController::class, 'updateCategory'])->name('categories.update');
            Route::delete('categories/{category}', [SidebarPageController::class, 'destroyCategory'])->name('categories.destroy');

            Route::get('speakers', [SidebarPageController::class, 'speakers'])->name('speakers.index');
            Route::get('speakers/create', [SidebarPageController::class, 'createSpeaker'])->name('speakers.create');
            Route::post('speakers', [SidebarPageController::class, 'storeSpeaker'])->name('speakers.store');
            Route::get('speakers/{speaker}/edit', [SidebarPageController::class, 'editSpeaker'])->name('speakers.edit');
            Route::put('speakers/{speaker}', [SidebarPageController::class, 'updateSpeaker'])->name('speakers.update');
            Route::delete('speakers/{speaker}', [SidebarPageController::class, 'destroySpeaker'])->name('speakers.destroy');

            Route::get('venues', [SidebarPageController::class, 'venues'])->name('venues.index');
            Route::get('venues/create', [SidebarPageController::class, 'createVenue'])->name('venues.create');
            Route::post('venues', [SidebarPageController::class, 'storeVenue'])->name('venues.store');
            Route::get('venues/{venue}/edit', [SidebarPageController::class, 'editVenue'])->name('venues.edit');
            Route::put('venues/{venue}', [SidebarPageController::class, 'updateVenue'])->name('venues.update');
            Route::delete('venues/{venue}', [SidebarPageController::class, 'destroyVenue'])->name('venues.destroy');

            Route::get('participants', [SidebarPageController::class, 'participants'])->name('participants.index');
            Route::get('participants/create', [SidebarPageController::class, 'createParticipant'])->name('participants.create');
            Route::post('participants', [SidebarPageController::class, 'storeParticipant'])->name('participants.store');
            Route::get('participants/{participant}/edit', [SidebarPageController::class, 'editParticipant'])->name('participants.edit');
            Route::put('participants/{participant}', [SidebarPageController::class, 'updateParticipant'])->name('participants.update');
            Route::delete('participants/{participant}', [SidebarPageController::class, 'destroyParticipant'])->name('participants.destroy');

            Route::get('documents', [SidebarPageController::class, 'documents'])->name('documents.index');
            Route::get('documents/create', [SidebarPageController::class, 'createDocument'])->name('documents.create');
            Route::post('documents', [SidebarPageController::class, 'storeDocument'])->name('documents.store');
            Route::get('documents/{document}/edit', [SidebarPageController::class, 'editDocument'])->name('documents.edit');
            Route::put('documents/{document}', [SidebarPageController::class, 'updateDocument'])->name('documents.update');
            Route::delete('documents/{document}', [SidebarPageController::class, 'destroyDocument'])->name('documents.destroy');

            Route::get('users', [SidebarPageController::class, 'users'])->name('users.index');
            Route::get('users/create', [SidebarPageController::class, 'createUser'])->name('users.create');
            Route::post('users', [SidebarPageController::class, 'storeUser'])->name('users.store');
            Route::get('users/{user}/edit', [SidebarPageController::class, 'editUser'])->name('users.edit');
            Route::put('users/{user}', [SidebarPageController::class, 'updateUser'])->name('users.update');
            Route::delete('users/{user}', [SidebarPageController::class, 'destroyUser'])->name('users.destroy');

            // Import & Export Data
            Route::get('import', [SidebarPageController::class, 'import'])->name('import.index');
            Route::post('import', [ImportController::class, 'processImport'])->name('import.process');
            Route::get('export', [SidebarPageController::class, 'export'])->name('export.index');
            Route::get('export/download', [ImportController::class, 'export'])->name('export.download');

            Route::get('settings', [SidebarPageController::class, 'settings'])->name('settings.index');
            Route::post('settings', [SidebarPageController::class, 'updateSettings'])->name('settings.update');
        });
    });
});

Route::get('/', fn () => redirect('/id'));