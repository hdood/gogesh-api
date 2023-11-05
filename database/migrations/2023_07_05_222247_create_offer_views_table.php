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
        Schema::create('offer_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId("customer_id")->nullable()->constrained("customers")->cascadeOnDelete();
            $table->foreignId("offer_id")->constrained()->cascadeOnDelete();
            $table->string("gust_id")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_views');
    }
};
