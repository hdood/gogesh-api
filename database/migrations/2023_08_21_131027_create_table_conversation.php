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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->integer("receive_id");
            $table->integer("sender_id");
            $table->string("type_receive");
            $table->string("type_sender");
            $table->foreignId("offer_id")->nullable()->constrained("offers")->cascadeOnDelete();
            $table->foreignId("ads_id")->nullable()->constrained("ads")->cascadeOnDelete();
            $table->string('last_message')->nullable();
            $table->boolean('complete')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
