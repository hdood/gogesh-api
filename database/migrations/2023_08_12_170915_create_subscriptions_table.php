<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {

            $table->id();

            $table->foreignId("seller_id")->constrained("sellers")->cascadeOnDelete();
            $table->string('name_ar');
            $table->string('name_en');
            $table->integer('max_offers');
            $table->float('offer_addition_cost');
            $table->integer('max_offer_change');
            $table->float('offer_change_cost');
            $table->integer('max_specialties');
            $table->float('notification_cost');
            $table->integer('max_ads_per_notification')->nullable(); // ad
            $table->float('specialty_addition_cost');
            $table->integer('max_free_ads')->nullable(); // free ad
            $table->integer('free_ads_duration')->nullable()->default(1); // free ad
            $table->text('features')->nullable();
            $table->text('features_ar')->nullable();
            $table->integer('duration');
            $table->float('price');
            $table->float('ads_discount')->default(0);
            $table->integer('max_users');
            $table->integer('max_ads_via_sector_banner')->nullable()->default(0);
            $table->integer('ads_via_sectors_banner_duration')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
