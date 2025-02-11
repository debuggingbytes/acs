<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SitemapGenerator;
use App\Http\Controllers\UserController;
use App\Livewire\AddInventory;
use App\Livewire\AddPartsInventory;
use App\Livewire\AddEquipmentInventory;
use App\Livewire\Dashboard\AdminIndex;
use App\Livewire\Dashboard\ModifyInventory;
use App\Livewire\Profile\UserProfile;
use App\Livewire\Bbcode;
use App\Livewire\Quotes\CreateQuote;
use App\Livewire\Quotes\ViewQuote;
use App\Livewire\ShowInventory;
use App\Livewire\System\Maintenance\ManageMaintenance;
use App\Livewire\Quotes\ShowQuotes;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\System\Quote;
use Illuminate\Support\Facades\Storage;

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


// Home Route
Route::view('/', 'home')->name('home');


// All routes based around inventory

Route::prefix('inventory')->group(function () {
    Route::get('/', [InventoryController::class, 'showInventory'])->name('inventory');
    Route::get('/category/{slug}', [InventoryController::class, 'showCategory'])->name('category');
    Route::get('/cranes', [InventoryController::class, 'showCranes'])->name('cranes');
    Route::get('/crane/{id}/{slug}/', [InventoryController::class, 'showCrane'])->where('id', '[0-9]+')->name('crane');
    Route::get('/parts', [InventoryController::class, 'showParts'])->name('parts');
    Route::get('/parts/{id}/{slug}/', [InventoryController::class, 'showPart'])->where('id', '[0-9]+')->name('part');
    Route::get('/equipment', [InventoryController::class, 'showEquipments'])->name('equipments');
    Route::get('/equipment/{id}/{slug}/', [InventoryController::class, 'showEquipment'])->where('id', '[0-9]+')->name('equipment');

});

// Contact route
Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

// Financing Route
Route::get('/finance', function () {
    return view('finance');
})->name('finance');

// DASHBOARD  -  Middleware to be updated to include user / admin variances
Route::middleware(['auth:sanctum', 'account.auth'])->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', AdminIndex::class)->name('admin.dashboard');
        Route::get('/bbcode', Bbcode::class)->name('bbcode');
        Route::get('/profile', UserProfile::class)->name('profile.user');
        // Inventory Management
        Route::get('/inventory/add/crane', AddInventory::class)->name('add.crane.inventory');
        Route::get('/inventory/add/part', AddPartsInventory::class)->name('add.part.inventory');
        Route::get('/inventory/add/equipment', AddEquipmentInventory::class)->name('add.equipment.inventory');
        Route::get('/inventory/show', ShowInventory::class)->name('show.inventory');
        Route::get('/inventory/{id}/edit', ModifyInventory::class)->name('edit.inventory');
        // website management
        Route::get('/maintenance/manage', ManageMaintenance::class)->name('dashboard.website.manage');
        Route::get('/maintenance/database')->name('dashboard.website.database');
        Route::get('/maintenance/users')->name('dashboard.website.users');
        Route::get('/maintenance/settings')->name('dashboard.website.settings');
        // Business Tools
        // Quote Management
        Route::get('/quotes', ShowQuotes::class)->name('quotes.home');
        Route::get('/quotes/{id}/view/', ViewQuote::class)->name('quote.view');
        Route::get('/quotes/create/{id}/', CreateQuote::class)->name('quote.create');
        // Bills of Sale
        Route::get('/billing')->name('billing.home');



    });

});

Route::get('/sitemap.xml', [SitemapGenerator::class, 'index']);
Route::get('/login', function () {
    return view('account.login');
})->name('login');

Route::post('/login', [UserController::class, 'loginUser'])->name('login.user');
Route::post('/logout', [UserController::class, 'logoutUser'])->name('logout.user');


Route::get('/download-quote/{quote}', function (Quote $quote) {
    if (! $quote->pdf_path) {
        abort(404, 'PDF not found.');
    }

    $path = Storage::disk('public')->path($quote->pdf_path);

    if (! file_exists($path)) {
        abort(404, 'PDF file not found on disk.');
    }

    $response = new StreamedResponse(function () use ($path) {
        readfile($path);
    }, 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="'.basename($path).'"',
    ]);

    return $response;
})->name('download.quote');

