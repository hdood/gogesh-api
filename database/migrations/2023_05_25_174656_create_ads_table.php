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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId("seller_id")->nullable()->constrained("sellers")->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('duration');
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->enum('place', ['Home_Baner', 'Home_Flash', 'Sectors_Baner', 'Ads_Screen', 'Search_Baner', 'Sector_Flash', 'Sector_Baner', 'Notification']);
            $table->foreignId("sector_id")->nullable()->constrained("sectors")->cascadeOnUpdate();
            $table->text('description');
            $table->string('images');
            $table->string('url')->nullable();
            $table->float('price');
            $table->float('total')->nullable();
            $table->enum('status', ['Approved', 'Rejected', 'Pending', 'Updated', 'Not_Paid'])->default('Pending');
            $table->text('reason_id')->nullable();
            $table->string('poster')->nullable();
            $table->string('poster_type')->nullable();

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
        Schema::dropIfExists('ads');
    }
};
