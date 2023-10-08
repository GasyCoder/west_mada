<?php

use App\Livewire\Tasks;
use App\Livewire\Hotels;
use App\Livewire\Inclus;
use App\Livewire\Photos;
use App\Livewire\Stocks;
use App\Livewire\Periodes;
use App\Livewire\Dashboard;
use App\Livewire\RoomTypes;
use App\Livewire\Guard\Users;
use App\Livewire\Reservations;
use App\Livewire\CategoryStocks;
use App\Livewire\Guard\RoleIndex;
use App\Livewire\TrashReservation;
use App\Livewire\WestMada\HomeOne;
use App\Livewire\WestMada\Navbars;
use App\Livewire\WestMada\Onglets;
use App\Livewire\WestMada\Sliders;
use App\Livewire\WestMada\Contentes;
use App\Livewire\WestMada\PagesType;
use App\Livewire\WestMada\WestPanel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\WestMada\PageContent;
use App\Livewire\WestMada\ServiceShow;
use App\Livewire\Guard\PermissionIndex;
use App\Livewire\WestMada\Stories;
use App\Livewire\WestMada\PageShowType;
use App\Livewire\WestMada\ServicePages;

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


// Routes pour le frontend
Route::group(['domain' => 'westmada.test'], function () {
    //Redirect to homepage
    Route::get('/', HomeOne::class)->name('homepage');
    
    Route::get('/contente-open-{slug}', PageContent::class)->name('contente');
    Route::get('/page-open-{slug}', PageShowType::class)->name('pagetype');
    Route::get('/nos-service-{slug}', ServiceShow::class)->name('nos-service'); 
        
    // Route::middleware(['auth', 'isClient'])->group(function () {

    //         Route::get('/home', function() {
    //             return ('Client');
    //         });

    //         Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //     });    
});


// Routes pour le frontend pour VatoBe
Route::group(['domain' => 'vatobe.westmada.test'], function () {

    Auth::routes();

    //Redirect to homepage
    Route::get('/', function () {
        return view('livewire.home.vatobe.index');
    });


    Route::middleware(['auth', 'isClient'])->group(function () {

        Route::get('/home', function() {
            return ('Client');
        });

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });
});

// Routes pour le backend
Route::group(['domain' => 'admin.westmada.test'], function () {
    Auth::routes();
    // Redirect to login page
    Route::get('/', function () {
        return redirect('/login');
    }); 

        Route::middleware(['auth', 'isAdmin'])->group(function () {
                Route::get('/dashboard', Dashboard::class)->name('dashboard');

                Route::get('/roles', RoleIndex::class)->name('roles');
                Route::get('/permissions', PermissionIndex::class)->name('permissions');
                Route::get('/users', Users::class)->name('users'); 
                

                Route::get('/hotels', Hotels::class)->name('hotels');
                Route::get('/photos', Photos::class)->name('photos');
                Route::get('/typerooms', RoomTypes::class)->name('typerooms');
                Route::get('/inclus', Inclus::class)->name('inclus');
                Route::get('/tasks', Periodes::class)->name('tasks');
                Route::get('/tasks-{id}', Tasks::class)->name('tasks');
                Route::get('/stocks', Stocks::class)->name('stocks');
                Route::get('/stock_categories', CategoryStocks::class)->name('stock_categories');

                Route::get('/toutes-reservations', Reservations::class);
                Route::get('/corbeille-reservations', TrashReservation::class);

                Route::get('/westmada-panel', WestPanel::class)->name('westmada-panel');
                Route::get('/navbars', Navbars::class)->name('navbars');
                Route::get('/onglets', Onglets::class)->name('onglets');
                Route::get('/pages-content', Contentes::class)->name('pages-content');

                Route::get('/sliders', Sliders::class)->name('sliders');
                Route::get('/pages-type', PagesType::class)->name('pages-type');
                Route::get('/services-page', ServicePages::class)->name('services-page');

                Route::get('/photo-story', Stories::class)->name('photo-story');

        });
});

