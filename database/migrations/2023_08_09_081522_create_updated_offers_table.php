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
        Schema::create('updated_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("offer_id")->constrained("offers")->cascadeOnUpdate();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('condition')->nullable();
            $table->float('price')->nullable();
            $table->float('discount')->nullable();
            $table->float('total')->nullable();
            $table->boolean('bold')->nullable();

            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();

            $table->enum('status', ['Approved', 'Rejected', 'Pending'])->nullable();

            $table->string('video')->nullable();
            $table->string('images')->nullable();

            $table->string("reason")->nullable();
            $table->integer('rejected')->default(0);

            $table->foreignId("reason_id")->nullable()->constrained("reason_offers")->cascadeOnUpdate();
            $table->foreignId("duration_id")->nullable()->constrained("duration_offers")->cascadeOnUpdate();

            $table->foreignId("season_id")->nullable()->constrained("seasons")->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('updated_offers');
    }
};
