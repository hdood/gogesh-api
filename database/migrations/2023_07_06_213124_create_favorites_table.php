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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->string("model");
            $table->foreignId("ad_id")->nullable()->constrained("ads")->cascadeOnDelete();
            $table->foreignId("offer_id")->nullable()->constrained("offers")->cascadeOnDelete();
            $table->foreignId("customer_id")->nullable()->constrained("customers")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
