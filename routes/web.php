<?php

use App\Http\Controllers\Dashboard\Notification\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Ads\AdsController;
use App\Http\Controllers\Dashboard\Ads\PlacesController;
use App\Http\Controllers\Dashboard\Ajax\AjaxController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Auth\RoleController;
use App\Http\Controllers\Dashboard\Auth\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Auth\LocaleController;
use App\Http\Controllers\Dashboard\Offer\OfferController;
use App\Http\Controllers\Dashboard\Order\OrderController;
use App\Http\Controllers\Dashboard\Offer\ReasonController;
use App\Http\Controllers\Dashboard\Seller\SellerController;
use App\Http\Controllers\Dashboard\StripePaymentController;
use App\Http\Controllers\Dashboard\Offer\DurationController;
use App\Http\Controllers\Dashboard\Company\CompanyController;
use App\Http\Controllers\Dashboard\Contact\ContactController;
use App\Http\Controllers\Dashboard\Package\PackageController;
use App\Http\Controllers\Dashboard\Locations\CitiesController;
use App\Http\Controllers\Dashboard\Services\SectionController;
use App\Http\Controllers\Dashboard\Services\ServiceController;
use App\Http\Controllers\Dashboard\Settings\SettingController;
use App\Http\Controllers\Dashboard\Categories\SeasonController;
use App\Http\Controllers\Dashboard\Categories\SectorController;
use App\Http\Controllers\Dashboard\Customer\CustomerController;
use App\Http\Controllers\Dashboard\Locations\RegionsController;
use App\Http\Controllers\Dashboard\Categories\ActivityController;
use App\Http\Controllers\Dashboard\Contact\ContactChatController;
use App\Http\Controllers\Dashboard\Locations\CountriesController;
use App\Http\Controllers\Dashboard\Order\CustomerOrderController;
use App\Http\Controllers\Dashboard\Payment\TransactionsController;
use App\Http\Controllers\Dashboard\Categories\CommercialController;
use App\Http\Controllers\Dashboard\Categories\SpecialityController;
use App\Http\Controllers\Dashboard\Categories\SubSectorController;
use App\Http\Controllers\Dashboard\CommercialActivity\CommercialActivityController;
use App\Http\Controllers\Dashboard\Payment\MethodPaymentController;
use App\Http\Controllers\Dashboard\Payment\PaypalController;
use App\Http\Controllers\Dashboard\Settings\CommonController;
use Illuminate\Http\Request;

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



Route::middleware('localizationDashborad')->group(function () {

    Route::get('/login', [AuthController::class, 'index'])->name('page.login');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');

    Route::get('email', function () {
        $code = 1111;
        return view('emails.send-code-reset-password', compact('code'));
    });

    Route::middleware('auth')->group(function () {

        //ajax
        Route::prefix('ajax')->controller(AjaxController::class)->name('ajax.')->group(function () {
            Route::put('delImage/{id}/{image}', [AjaxController::class, 'imageDestroy'])->name('imageDestroy');
            Route::get('city/{id}', [AjaxController::class, 'getCity'])->name('city');
            Route::get('region/{id}', [AjaxController::class, 'getRegion'])->name('region');
            Route::get('seller', [AjaxController::class, 'getSeller'])->name('seller');
            Route::prefix('autocomplete')->name('autocomplete.')->group(function () {
                Route::get('seller', [AjaxController::class, 'autocomplete'])->name('seller');
                Route::get('customer', [AjaxController::class, 'autocompleteCustomer'])->name('customer');
                Route::get('commercial_activity', [AjaxController::class, 'autocompleteCommercialActivity'])->name('commercial_activity');
            });
            Route::post('sendReplie', [AjaxController::class, 'sendReplie'])->name('sendReplie');
            //Category
            Route::get('sub-sector/{id}', [AjaxController::class, 'getSubSector'])->name('subsector');
            Route::get('activity/{id}', [AjaxController::class, 'getActivity'])->name('activity');
            Route::get('by-activity/{id}', [AjaxController::class, 'getByActivity'])->name('byactivity');
            Route::get('speciality/{id}', [AjaxController::class, 'getSpeciality'])->name('speciality');
            Route::get('approved/{id}', [AjaxController::class, 'approved'])->name('approved');
        });
        // authentication
        Route::prefix('auth')->controller(AuthController::class)->name('auth.')->group(function () {
            Route::get('logout', 'logout')->name('logout');
        });
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        //offers
        Route::prefix('offer')->controller(OfferController::class)->name('offer.')->group(function () {
            // Route::resource('',OfferController::class);
            Route::get('', 'index')->name('index');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::Put('update/{id}', 'update')->name('update');
            Route::delete('destroy/{id}', 'destroy')->name('destroy');
            Route::resource('reason', ReasonController::class);
            Route::resource('duration', DurationController::class);
            Route::post('edit/approvedUpdate/{id}', [OfferController::class, 'approvedUpdate'])->name('approved');
            Route::post('edit/rejectedUpdate/{id}', [OfferController::class, 'rejectedUpdate'])->name('rejectedUpdate');
        });
        //location
        Route::prefix('location')->name('location.')->group(function () {
            Route::resource('countries', CountriesController::class);
            Route::resource('cities', CitiesController::class);
            Route::resource('regions', RegionsController::class);
        });
        //category
        Route::prefix('category')->name('category.')->group(function () {
            Route::resource('sector', SectorController::class);
            Route::resource('sub_sector', SubSectorController::class);
            Route::resource('activity', ActivityController::class);
            Route::resource('speciality', SpecialityController::class);
            Route::resource('season', SeasonController::class);
        });
        //services
        Route::prefix('services')->name('services.')->group(function () {
            Route::resource('service', ServiceController::class);
            Route::resource('section', SectionController::class);
        });
        //customer
        Route::resource('customer', CustomerController::class);
        Route::any('customer/updatePassword/{id}', [CustomerController::class, 'updatePassword'])->name('customer.updatePassword');
        //ads
        Route::resource('ads', AdsController::class);
        Route::resource('places', PlacesController::class);
        //Seller
        Route::resource('seller', SellerController::class);
        Route::post('seller-more/{id}', [SellerController::class, 'updateMore'])->name('updateMore');
        Route::get('seller/accept-upgrade/{id}', [SellerController::class, 'approvedUpgrad'])->name('approvedUpgrad');
        Route::any('seller/updatePassword/{id}', [SellerController::class, 'updatePassword'])->name('seller.updatePassword');
        //commercial Activity
        Route::resource('commercialActivity', CommercialActivityController::class);
        Route::post('commercialActivity/approvedUpdate/{id}', [CommercialActivityController::class, 'approvedUpdate'])->name('commercialActivity.approved');
        //Package
        Route::resource('package', PackageController::class);
        //User
        Route::resource('user', UserController::class);
        //role
        Route::resource('role', RoleController::class);
        //settings
        Route::resource('settings', SettingController::class);
        Route::post('settings/privacy_policy', [SettingController::class, 'privacy_policy'])->name('settings.privacy_policy');
        //conatct
        Route::resource('contact', ContactController::class)->only(['index', 'update', 'destroy']);
        Route::post('contact/new', [ContactController::class, 'makeContact'])->name('contact.new');
        Route::get('getMoreContact', [ContactController::class, 'getMoreContact'])->name('new_contact');
        // Route::resource('contactchat', ContactChatController::class);
        Route::post('contact/receive', [ContactController::class, 'receive'])->name('contact.receive');
        Route::post('contact/broadcast', [ContactController::class, 'store'])->name('contact.broadcast');
        Route::get('contact/{id}', [ContactController::class, 'show'])->name('contact.show');
        //Transaction
        Route::prefix('payment')->name('payment.')->group(function () {
            Route::name('transaction.')->group(function () {
                Route::get('transaction', [TransactionsController::class, 'index'])->name('index');
                Route::delete('transaction/delete/{id}', [TransactionsController::class, 'destroy'])->name('destroy');
            });
            Route::resource('methods', MethodPaymentController::class)->except('store');
            Route::post('methods/update', [MethodPaymentController::class, 'store'])->name('update-method');
        });
        //order
        Route::prefix('order')->name('order.')->group(function () {
            Route::resource('offer', OrderController::class)->only(['index', 'destroy']);
            Route::resource('customer', CustomerOrderController::class)->only(['index', 'destroy']);
        });
        //localization
        Route::get('locale/{locale}', [LocaleController::class, 'changeLocale'])->name('localization');
        // listen pusher message notification
        Route::post('dashboard/receive', [DashboardController::class, 'receive'])->name('dashboard.receive');

        //Settings
        Route::post('common_questions', [CommonController::class, 'store'])->name('common_questions');
        //notification
        Route::resource('notification', NotificationController::class);
    });
    // stripe checkout
    Route::controller(StripePaymentController::class)->group(function () {
        Route::get('stripe', 'stripe')->name('stripe');
        Route::post('stripe', 'stripePost')->name('stripe.post');
    });

    Route::controller(PaypalController::class)->group(function () {
        Route::get('payment', 'index');
        Route::post('charge', 'charge');
        Route::get('success', 'success');
        // Route::get('error', 'error');
    });

    // Route::get('test', function () {
    //     return view('emails.send-code-reset-password', ['code' => 1222]);
    // });
});
