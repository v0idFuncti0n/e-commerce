<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\View;

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

// for test purposes
Route::get('/test', function () {
    $to_name = 'Anas';
    $to_email = 'lakchouchanas@gmail.com';
    $data = array('name' => 'Anas', 'body' => 'A test mail');
    Mail::send('welcome', $data, function ($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
            ->subject('Laravel Test Mail');
        $message->from(env('MAIL_USERNAME'), 'Test Mail');
    });
    return '';
});


Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['is_authenticated', 'role:admin'], 'prefix' => 'admin'], function () {

    Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');

    // categories routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
    Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');

    // default template routes
    Route::group(['prefix' => 'basic-ui'], function () {
        Route::get('accordions', function () {
            return view('admin-dashboard.pages.basic-ui.accordions');
        });
        Route::get('buttons', function () {
            return view('admin-dashboard.pages.basic-ui.buttons');
        });
        Route::get('badges', function () {
            return view('admin-dashboard.pages.basic-ui.badges');
        });
        Route::get('breadcrumbs', function () {
            return view('admin-dashboard.pages.basic-ui.breadcrumbs');
        });
        Route::get('dropdowns', function () {
            return view('admin-dashboard.pages.basic-ui.dropdowns');
        });
        Route::get('modals', function () {
            return view('admin-dashboard.pages.basic-ui.modals');
        });
        Route::get('progress-bar', function () {
            return view('admin-dashboard.pages.basic-ui.progress-bar');
        });
        Route::get('pagination', function () {
            return view('admin-dashboard.pages.basic-ui.pagination');
        });
        Route::get('tabs', function () {
            return view('admin-dashboard.pages.basic-ui.tabs');
        });
        Route::get('typography', function () {
            return view('admin-dashboard.pages.basic-ui.typography');
        });
        Route::get('tooltips', function () {
            return view('admin-dashboard.pages.basic-ui.tooltips');
        });
    });

    Route::group(['prefix' => 'advanced-ui'], function () {
        Route::get('dragula', function () {
            return view('admin-dashboard.pages.advanced-ui.dragula');
        });
        Route::get('clipboard', function () {
            return view('admin-dashboard.pages.advanced-ui.clipboard');
        });
        Route::get('context-menu', function () {
            return view('admin-dashboard.pages.advanced-ui.context-menu');
        });
        Route::get('popups', function () {
            return view('admin-dashboard.pages.advanced-ui.popups');
        });
        Route::get('sliders', function () {
            return view('admin-dashboard.pages.advanced-ui.sliders');
        });
        Route::get('carousel', function () {
            return view('admin-dashboard.pages.advanced-ui.carousel');
        });
        Route::get('loaders', function () {
            return view('admin-dashboard.pages.advanced-ui.loaders');
        });
        Route::get('tree-view', function () {
            return view('admin-dashboard.pages.advanced-ui.tree-view');
        });
    });

    Route::group(['prefix' => 'forms'], function () {
        Route::get('basic-elements', function () {
            return view('admin-dashboard.pages.forms.basic-elements');
        });
        Route::get('advanced-elements', function () {
            return view('admin-dashboard.pages.forms.advanced-elements');
        });
        Route::get('dropify', function () {
            return view('admin-dashboard.pages.forms.dropify');
        });
        Route::get('form-validation', function () {
            return view('admin-dashboard.pages.forms.form-validation');
        });
        Route::get('step-wizard', function () {
            return view('admin-dashboard.pages.forms.step-wizard');
        });
        Route::get('wizard', function () {
            return view('admin-dashboard.pages.forms.wizard');
        });
    });

    Route::group(['prefix' => 'editors'], function () {
        Route::get('text-editor', function () {
            return view('admin-dashboard.pages.editors.text-editor');
        });
        Route::get('code-editor', function () {
            return view('admin-dashboard.pages.editors.code-editor');
        });
    });

    Route::group(['prefix' => 'charts'], function () {
        Route::get('chartjs', function () {
            return view('admin-dashboard.pages.charts.chartjs');
        });
        Route::get('morris', function () {
            return view('admin-dashboard.pages.charts.morris');
        });
        Route::get('flot', function () {
            return view('admin-dashboard.pages.charts.flot');
        });
        Route::get('google-charts', function () {
            return view('admin-dashboard.pages.charts.google-charts');
        });
        Route::get('sparklinejs', function () {
            return view('admin-dashboard.pages.charts.sparklinejs');
        });
        Route::get('c3-charts', function () {
            return view('admin-dashboard.pages.charts.c3-charts');
        });
        Route::get('chartist', function () {
            return view('admin-dashboard.pages.charts.chartist');
        });
        Route::get('justgage', function () {
            return view('admin-dashboard.pages.charts.justgage');
        });
    });

    Route::group(['prefix' => 'tables'], function () {
        Route::get('basic-table', function () {
            return view('admin-dashboard.pages.tables.basic-table');
        });
        Route::get('data-table', function () {
            return view('admin-dashboard.pages.tables.data-table');
        });
        Route::get('js-grid', function () {
            return view('admin-dashboard.pages.tables.js-grid');
        });
        Route::get('sortable-table', function () {
            return view('admin-dashboard.pages.tables.sortable-table');
        });
    });

    Route::get('notifications', function () {
        return view('admin-dashboard.pages.notifications.index');
    });

    Route::group(['prefix' => 'icons'], function () {
        Route::get('material', function () {
            return view('admin-dashboard.pages.icons.material');
        });
        Route::get('flag-icons', function () {
            return view('admin-dashboard.pages.icons.flag-icons');
        });
        Route::get('font-awesome', function () {
            return view('admin-dashboard.pages.icons.font-awesome');
        });
        Route::get('simple-line-icons', function () {
            return view('admin-dashboard.pages.icons.simple-line-icons');
        });
        Route::get('themify', function () {
            return view('admin-dashboard.pages.icons.themify');
        });
    });

    Route::group(['prefix' => 'maps'], function () {
        Route::get('vector-map', function () {
            return view('admin-dashboard.pages.maps.vector-map');
        });
        Route::get('mapael', function () {
            return view('admin-dashboard.pages.maps.mapael');
        });
        Route::get('google-maps', function () {
            return view('admin-dashboard.pages.maps.google-maps');
        });
    });

    Route::group(['prefix' => 'user-pages'], function () {
        Route::get('login', function () {
            return view('admin-dashboard.pages.user-pages.login');
        });
        Route::get('login-2', function () {
            return view('admin-dashboard.pages.user-pages.login-2');
        });
        Route::get('multi-step-login', function () {
            return view('admin-dashboard.pages.user-pages.multi-step-login');
        });
        Route::get('register', function () {
            return view('admin-dashboard.pages.user-pages.register');
        });
        Route::get('register-2', function () {
            return view('admin-dashboard.pages.user-pages.register-2');
        });
        Route::get('lock-screen', function () {
            return view('admin-dashboard.pages.user-pages.lock-screen');
        });
    });

    Route::group(['prefix' => 'error-pages'], function () {
        Route::get('error-404', function () {
            return view('admin-dashboard.pages.error-pages.error-404');
        });
        Route::get('error-500', function () {
            return view('admin-dashboard.pages.error-pages.error-500');
        });
    });

    Route::group(['prefix' => 'general-pages'], function () {
        Route::get('blank-page', function () {
            return view('admin-dashboard.pages.general-pages.blank-page');
        });
        Route::get('landing-page', function () {
            return view('admin-dashboard.pages.general-pages.landing-page');
        });
        Route::get('profile', function () {
            return view('admin-dashboard.pages.general-pages.profile');
        });
        Route::get('email-templates', function () {
            return view('admin-dashboard.pages.general-pages.email-templates');
        });
        Route::get('faq', function () {
            return view('admin-dashboard.pages.general-pages.faq');
        });
        Route::get('faq-2', function () {
            return view('admin-dashboard.pages.general-pages.faq-2');
        });
        Route::get('news-grid', function () {
            return view('admin-dashboard.pages.general-pages.news-grid');
        });
        Route::get('timeline', function () {
            return view('admin-dashboard.pages.general-pages.timeline');
        });
        Route::get('search-results', function () {
            return view('admin-dashboard.pages.general-pages.search-results');
        });
        Route::get('portfolio', function () {
            return view('admin-dashboard.pages.general-pages.portfolio');
        });
        Route::get('user-listing', function () {
            return view('admin-dashboard.pages.general-pages.user-listing');
        });
    });

    Route::group(['prefix' => 'ecommerce'], function () {
        Route::get('invoice', function () {
            return view('admin-dashboard.pages.ecommerce.invoice');
        });
        Route::get('invoice-2', function () {
            return view('admin-dashboard.pages.ecommerce.invoice-2');
        });
        Route::get('pricing', function () {
            return view('admin-dashboard.pages.ecommerce.pricing');
        });
        Route::get('product-catalogue', function () {
            return view('admin-dashboard.pages.ecommerce.product-catalogue');
        });
        Route::get('project-list', function () {
            return view('admin-dashboard.pages.ecommerce.project-list');
        });
        Route::get('orders', function () {
            return view('admin-dashboard.pages.ecommerce.orders');
        });
    });

});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// For Clear cache
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// 404 for undefined routes
/*Route::any('/{page?}', function () {
    return View::make('pages.error-pages.error-404');
})->where('page', '.*');*/



