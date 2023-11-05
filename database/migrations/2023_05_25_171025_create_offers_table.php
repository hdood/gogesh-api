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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description');
            $table->text('condition');
            $table->float('price');
            $table->float('discount')->default(0);
            $table->float('total')->nullable();
            $table->boolean('bold')->nullable();
            $table->enum('status', ['Approved', 'Rejected', 'Pending', 'Updated','Not_Paid','Draft'])->default('Pending');

            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();

            $table->foreignId("reason_id")->nullable()->constrained("reason_offers")->cascadeOnUpdate();

            $table->foreignId("duration_id")->nullable()->constrained("duration_offers")->cascadeOnUpdate();

            $table->foreignId("season_id")->constrained("seasons")->cascadeOnUpdate();

            $table->foreignId("seller_id")->constrained("sellers")->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('images')->nullable();
            $table->string('video')->nullable();

            $table->integer("updated_id")->nullable();
            $table->timestamp('approved_at')->nullable();

            $table->string('old_status')->nullable();
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
        Schema::dropIfExists('offers');
    }
};
