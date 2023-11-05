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
        Schema::create('places_ads', function (Blueprint $table) {
            $table->id();
            $table->enum('place', ['Home_Baner', 'Home_Flash', 'Sectors_Baner', 'Ads_Screen', 'Search_Baner', 'Sector_Flash', 'Sector_Baner', 'Notification']);
            $table->float('price');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places_ads');
    }
};
