<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DaysController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\City\CityController;
use App\Http\Controllers\Api\Offer\OfferController;
use App\Http\Controllers\Api\Auth\AccountController;
use App\Http\Controllers\Api\PrivacyPolicyController;
use App\Http\Controllers\Api\Region\RegionController;
use App\Http\Controllers\Api\Season\SeasonController;
use App\Http\Controllers\Api\Sector\SectorController;
use App\Http\Controllers\Api\Activity\ActivityController;
use App\Http\Controllers\Api\Ads\AdsController;
use App\Http\Controllers\Api\Ads\PlacesAdsController;
use App\Http\Controllers\Api\Auth\RegistrationController;
use App\Http\Controllers\Api\Country\CountriesController;
use App\Http\Controllers\Api\Duration\DurationController;
use App\Http\Controllers\Api\Email\VerificationController;
use App\Http\Controllers\Api\Services\ServiceController;
use App\Http\Controllers\Api\Specialization\SpecializationController;
use App\Http\Controllers\Api\Package\PackageController;
use App\Http\Controllers\Api\Settings\CommonController;
use App\Http\Controllers\Api\SubSector\SubSectorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "Api" middleware group. Make something great!
|
*/


Route::prefix('v1')->group(function () {

    Route::middleware('localization')->group(function () {

        ///  without-auth
        Route::get("countries", [CountriesController::class, "index"],);
        Route::get("countries/{id}", [CountriesController::class, "show"],);

        Route::get("countries/{id}/cities", [CityController::class, "getCitiesByCountryId"],);

        Route::get("cities", [CityController::class, "index"],);
        Route::get("cities/{id}", [CityController::class, "show"],);

        Route::get("cities/{id}/regions", [RegionController::class, "getRegionsByCityId"],);

        Route::get("regions", [RegionController::class, "index"],);
        Route::get("regions/{id}", [RegionController::class, "show"],);

        Route::get('sectors', [SectorController::class, "index"])->name("sectors.index");
        Route::get('sectors/{id}', [SectorController::class, "show"])->name("sectors.show");
        
        Route::get('sectors/{id}/activities', [ActivityController::class, "getBySector"])->name("getBySector");

        Route::get('sub-sectors', [SubSectorController::class, "index"])->name("subSectors.index");
        Route::get('sub-sectors/{id}', [SubSectorController::class, "show"])->name("subSectors.show");

        Route::get('activities', [ActivityController::class, "index"])->name("activities.index");
        Route::get('activities/{id}', [ActivityController::class, "show"])->name("activities.show");

        Route::get('specializations', [SpecializationController::class, "index"])->name("specializations.index");
        Route::get('specializations/{id}', [SpecializationController::class, "show"])->name("specializations.show");

        Route::get("seasons", [SeasonController::class, "index"])->name("seasons");
        Route::get("seasons/{id}", [SeasonController::class, "show"])->name("seasons.show");

        Route::get("services", [ServiceController::class, "index"])->name("services");
        Route::get("services/{id}", [ServiceController::class, "show"])->name("services.show");
        Route::get("sections", [ServiceController::class, "sections"])->name("sections.index");

        //Packages
        Route::get('packages', [PackageController::class, 'index']);
        Route::prefix('auth')->group(function () {
            Route::post('userCommercial/login', [AuthController::class, 'userCommecialLogin'])->name('userCommecialLogin');
            Route::post('password/check', [AuthController::class, 'checkCode'])->name('check-code');
            Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        });
        /// Validate-email
        Route::prefix('email')->group(function () {
            Route::post('verify', [VerificationController::class, 'verifyEmail'])->name('verification.verify.customer');
            Route::post('resend', [VerificationController::class, 'resendVerificationCode'])->name('verification.resend');
        });
        /// Validate-email
        // common-questions
        Route::get('common-questions', [CommonController::class, 'index'])->name('commonQuestions');
        // common-questions
        Route::middleware("auth:sanctum")->group(function () {
            // logout
            Route::post('/logout', [AuthController::class, 'logout']);
            /// durations
            Route::get("durations", [DurationController::class, "index"])->name("durations");
            /// durations
            /// Days
            Route::get("days", [DaysController::class, "index"]);
            /// Days
            // User Commmercial
            Route::post('auth/userCommercial/register', [RegistrationController::class, 'userCommercialRegister'])->middleware('check.max_users');
            Route::get('userCommercial/profile', [AccountController::class, 'userCommercialProfile']);
            /// Offers
            ///// ---------- check subscription duration -------------------///


            ///// ---------- check subscription duration -------------------///
            // Route::post("offers", OfferController::class)->except(['index', "show"]);
            Route::get("offers/requested", [OfferController::class, "requestedOffers"])->name("offers.requested");
            Route::post("offers/{id}/request", [OfferController::class, "requestOffer"])->name("request.offer");
            ///////// Offers

            /// Reports
            Route::post("report", [ReportController::class, "store"])->name("report");
            /// Reports
        });
        Route::post("vedio", [ReportController::class, "vedio"])->name("vedio");

        //// Privacy policy
        Route::get("privacy-policy", [PrivacyPolicyController::class, "index"])->name("privacy.policy");
        //// Privacy policy
        // Customers
        require('customer.php');
        // Sellers
        require('seller.php');
    });
});
