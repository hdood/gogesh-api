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
        Schema::create('seller_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId("seller_id")->constrained("sellers")->cascadeOnDelete();
            $table->foreignId("section_id")->constrained("sections")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_sections');
    }
};
