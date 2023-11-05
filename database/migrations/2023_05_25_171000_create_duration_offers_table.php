<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duration_offers', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Days', 'Week', 'Month', 'Year']);
            $table->integer('duration');
            $table->float('price');
            $table->enum('status', ['Active', 'Inactive']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('duration_offers');
    }
};
