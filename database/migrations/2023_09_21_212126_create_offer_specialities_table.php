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
        Schema::create('offer_specialities', function (Blueprint $table) {
            $table->id();
            $table->foreignId("offer_id")->constrained("offers")->cascadeOnDelete();
            $table->foreignId("speciality_id")->constrained("specialities")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_specialities');
    }
};
