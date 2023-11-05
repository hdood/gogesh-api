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
        Schema::create('offer_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("offer_id")->nullable()->constrained("offers")->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('bold')->default(0);
            $table->foreignId("duration_id")->nullable()->constrained("duration_offers")->cascadeOnUpdate()->cascadeOnDelete();
            $table->float('total')->default(0);
            $table->integer('payment')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_transactions');
    }
};
