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
        Schema::create('update_sellers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("seller_id")->constrained("sellers")->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('commercial_number')->nullable();
            $table->foreignId("sector_id")->nullable()->constrained("sectors")->cascadeOnUpdate();
            $table->foreignId("specialization_id")->nullable()->constrained("specialities")->cascadeOnUpdate();
            $table->foreignId("activity_id")->nullable()->constrained("activities")->cascadeOnUpdate();
            $table->json("social_accounts")->nullable();
            $table->json("work_days")->nullable();
            $table->json("seasons")->nullable();
            $table->enum("type", ['Company', 'Personal'])->nullable();
            $table->string('address')->nullable();
            $table->string('commercial_register')->nullable();
            $table->string('commercial_signature')->nullable();
            $table->string('logo')->nullable();
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('update_commercial_activities');
    }
};
