<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegistrationController;
use App\Http\Controllers\Api\Auth\SocialiteController;
use App\Http\Controllers\Api\Company\CommercialActivityController;
use App\Http\Controllers\Api\Auth\UpdatePasswordController;
use App\Http\Controllers\Api\Auth\AccountController;
use App\Http\Controllers\Api\Ads\AdsController;
use App\Http\Controllers\Api\Auth\CompletedRegisterController;
use App\Http\Controllers\Api\Contact\ContactSellerController;
use App\Http\Controllers\Api\Notification\NotificationController;
use App\Http\Controllers\Api\Offer\OfferController;
use App\Http\Controllers\Api\Seller\SellerController;
use App\Http\Controllers\Api\Stripe\StripePaymentController;

Route::post('notification', [NotificationController::class, 'index']);

Route::prefix('auth')->group(function () {
    Route::post('seller/login', [AuthController::class, 'sellerLogin'])->name('sellerLogin');
    Route::post('seller/register', [RegistrationController::class, 'sellerRegister']);
    Route::post('seller/callback', [SocialiteController::class, 'sellerHandleProviderCallback']);
    Route::post('seller/forgot-password', [AuthController::class, 'forgotPasswordSeller'])->name('forgot-password-seller');
    Route::post('password/seller/reset', [AuthController::class, 'sellerResetPassword'])->name('password.seller.reset');
});
Route::get('seller/details/{id}', [AccountController::class, 'getAccountSellerById'])->name('sellerById');

// Auth middleware
Route::middleware("auth:sanctum")->group(function () {
    Route::get('seller/notification', [NotificationController::class, 'getToSeller']);
    Route::get('seller/users', [SellerController::class, 'users']);
    Route::get('seller/delete-users/{id}', [SellerController::class, 'deleteUser']);
    Route::post('auth/seller/upgrade', [SellerController::class, 'upgradeAccount'])->name('seller.upgrda');

    // update email
    Route::post('seller/update-email', [SellerController::class, 'updateEmail']);
    // delete account
    Route::post('seller/delete/account', [AccountController::class, 'deleteSeller']);
    // information Subscription
    Route::get('seller/subscription/information', [CommercialActivityController::class, 'informationSubscripe']);
    // Information Subscription
    // update password
    Route::post('auth/seller/updatePassword', [UpdatePasswordController::class, 'sellerPassword']);
    // Completed Account
    Route::post('auth/seller/complete-profile', [CompletedRegisterController::class, 'completedSeller']);

    Route::get('seller/auth/editAccount', [SellerController::class, 'edit']);
    Route::post('seller/auth/update', [SellerController::class, 'update']);
    Route::post('seller/auth/updateAvatar', [SellerController::class, 'updateAvatar']);
    //Contacts
    Route::prefix('seller')->name('seller.')->group(function () {
        Route::post("/makeContact", [ContactSellerController::class, "makeContact"])->name("makeContact");
        Route::post("/sendMessage", [ContactSellerController::class, "store"])->name("sendMessage");
        Route::get("/messages", [ContactSellerController::class, "index"])->name("messages");
        Route::get("/messages/{id}", [ContactSellerController::class, "show"])->name("messages.show");
        Route::get("/messages-count", [ContactSellerController::class, "countContactUnread"])->name("messages.count");
    });
    /// Account
    Route::get('seller/account', [AccountController::class, 'getAccountSeller'])->name('accountSeller');
    Route::get('seller/editAccount', [AccountController::class, 'editAccountSeller'])->name('editAccountSeller');

    ///Ads
    Route::apiResource("ads", AdsController::class)->except('store');

    Route::get('seller/ads/{id}', [AdsController::class, 'edit'])->name('ads.edit');
    // Route::put('seller/update-ads', [AdsController::class, 'update'])->name('ads.update');
    Route::post('ads', [AdsController::class, 'store'])->middleware([
        "check.max_ads_per_notification",
        "check.max_free_ads"
    ]);

    //Offer
    Route::get("seller/offers", [OfferController::class, "getOwnedOffers"])->name("seller.offers");
    Route::get("seller/offerUpteted/{id}", [OfferController::class, "offerUpteted"])->name("seller.offerUpteted");
    Route::get("seller/offers/{id}", [OfferController::class, "getOwnedOfferDetails"])->name("seller.offers.details");
    Route::get("offers/edit/{id}", [OfferController::class, "edit"])->name("offers.edit");
    Route::post('offers', [OfferController::class, 'store'])->name('offer.create')->middleware('check.max_offers_for_create');
    Route::put('offers/{id}', [OfferController::class, 'update'])->name('offer.update')->middleware('check.max_offer_change_for_update');
    Route::delete('offers/{id}', [OfferController::class, 'destroy'])->name('offer.destroy');


    /// commercial-activity
    Route::apiResource("commercial-activity", CommercialActivityController::class);
    Route::post('commercial-activity-update', [CommercialActivityController::class, 'updateCommercialActivity']);
    Route::get('commercial-activity-show', [CommercialActivityController::class, 'showDetailsCommercial']);
    Route::post('commercialActivity/workDays/update', [CommercialActivityController::class, 'updateWorkDays']);
    Route::get('commercialActivity/workDays/show', [CommercialActivityController::class, 'showWorkDays']);
    Route::post('commercialActivity/socialAccount/update', [CommercialActivityController::class, 'updateSocialAccount']);
    Route::get('commercialActivity/socialAccount/show', [CommercialActivityController::class, 'showSocialAccount']);
    /// commercial-activity

    // stripe checkout
    Route::controller(StripePaymentController::class)->group(function () {
        Route::post('stripe', 'stripe')->name('stripe');
    });
});
