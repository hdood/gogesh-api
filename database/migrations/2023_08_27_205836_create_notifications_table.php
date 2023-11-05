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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_ar')->nullable();
            $table->string('content');
            $table->string('content_ar');
            $table->foreignId("offer_id")->nullable()->constrained("offers")->cascadeOnDelete();
            $table->foreignId("ads_id")->nullable()->constrained("ads")->cascadeOnDelete();
            $table->enum('type', ['success', 'danger', 'warning', 'payment', 'public']);
            $table->enum('to', ['seller', 'customer', 'all'])->nullable();
            $table->integer("receive_id")->nullable();
            $table->string("type_receive")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
