<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegistrationController;
use App\Http\Controllers\Api\Auth\SocialiteController;
use App\Http\Controllers\Api\Ads\AdFavoriteController;
use App\Http\Controllers\Api\Auth\UpdatePasswordController;
use App\Http\Controllers\Api\Contact\ContactCustomerController;
use App\Http\Controllers\Api\Auth\AccountController;
use App\Http\Controllers\Api\Offer\OfferFavoriteController;
use App\Http\Controllers\Api\Ads\AdsController;
use App\Http\Controllers\Api\Ads\PlacesAdsController;
use App\Http\Controllers\Api\Auth\CompletedRegisterController;
use App\Http\Controllers\Api\Customer\CustomerController;
use App\Http\Controllers\Api\Notification\NotificationController;
use App\Http\Controllers\Api\Offer\OfferController;



Route::prefix('auth')->group(function () {
    Route::post('customer/login', [AuthController::class, 'customerLogin'])->name('customerLogin');
    Route::post('customer/register', [RegistrationController::class, 'customerRegister']);
    Route::post('customer/callback', [SocialiteController::class, 'customerHandleProviderCallback']);
    Route::post('customer/forgot-password', [AuthController::class, 'forgotPasswordCustomer'])->name('forgot-password-customer');
    Route::post('password/customer/reset', [AuthController::class, 'customerResetPassword'])->name('password.customer.reset');
});



///Ads
Route::get("customer/ads", [AdsController::class, "indexCustomer"]);
Route::get("customer/ads/{id}", [AdsController::class, "showCustomer"]);
Route::get("ads/home-banner", [AdsController::class, "getHomeBannerAds"]);
Route::get("ads/home-flash", [AdsController::class, "getHomeFlashAd"]);
Route::get("ads/sectors-banner", [AdsController::class, "getSectorsBannerAds"]);
Route::get("ads/sector-banner", [AdsController::class, "getSectorBannerAds"]);
Route::get("ads/sector-flash", [AdsController::class, "getSectorFlashAd"]);
Route::get("ads/search-banner", [AdsController::class, "getSearchBannerAds"]);
Route::get('placesAds', [PlacesAdsController::class, 'index']);
/// Offers
Route::get("customer/offers", [OfferController::class, "index"]);
Route::get("customer/offers-season", [OfferController::class, "offersSeason"]);
Route::get("customer/offers-mostRequest", [OfferController::class, "offersMostRequest"]);
Route::get("customer/offers/{id}", [OfferController::class, "show"]);
/// Offers

Route::middleware("auth:sanctum")->group(function () {
    Route::get('customer/notification', [NotificationController::class, 'getToCustomer']);

    // update email
    Route::post('customer/update-email', [CustomerController::class, 'updateEmail']);
    // delete account
    Route::post('customer/delete/account', [AccountController::class, 'deleteCustomer']);
    // update password
    Route::post('auth/customer/updatePassword', [UpdatePasswordController::class, 'customerPassword']);
    // Completed Account
    Route::post('auth/customer/complete-profile', [CompletedRegisterController::class, 'completedCustomer']);
    //Contacts
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::post("/makeContact", [ContactCustomerController::class, "makeContact"])->name("makeContact");
        Route::post("/makeContactWithSeller", [ContactCustomerController::class, "makeContactWithSeller"])->name("makeContactWithSeller");
        Route::post("/makeContactWithAdsSeller", [ContactCustomerController::class, "makeContactWithAdsSeller"])->name("makeContactWithAdsSeller");
        Route::post("/sendMessage", [ContactCustomerController::class, "store"])->name("sendMessage");
        Route::get("/messages", [ContactCustomerController::class, "index"])->name("messages");
        Route::get("/messages/{id}", [ContactCustomerController::class, "show"])->name("messages.show");
        Route::post("/messages/completed/{id}", [ContactCustomerController::class, "completedContact"])->name("messages.completedContact");
        Route::get("/messages-count", [ContactCustomerController::class, "countContactUnread"])->name("messages.count");
    });
    /// Account
    Route::get('customer/account', [AccountController::class, 'getAccountCustomer'])->name('accountCustomer');
    Route::post('customer/editAccount', [AccountController::class, 'editAccountCustomer'])->name('editAccountCustomer');

    /// offer favorites
    Route::apiResource("favorites/offer", OfferFavoriteController::class);
    /// offer favorites

    /// ads favorites
    Route::apiResource("favorites/ad", AdFavoriteController::class);
    /// ads favorites
});
