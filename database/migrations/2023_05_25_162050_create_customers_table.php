<?php

use App\Enum\EnumGeneral;
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
        Schema::create('customers', function (Blueprint $table) {

            $table->id();
            $table->string("firstname");
            $table->string("lastname");
            $table->string("email");
            $table->string("phone")->nullable();
            $table->integer('completed')->default(0);
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->foreignId("country_id")->nullable()->constrained("countries")->cascadeOnUpdate();
            $table->foreignId("city_id")->nullable()->constrained("cities")->cascadeOnUpdate();
            $table->foreignId("region_id")->nullable()->constrained("regions")->cascadeOnUpdate();
            $table->string("country")->nullable();
            $table->string("city")->nullable();
            $table->string("region")->nullable();
            $table->enum('status', [EnumGeneral::ACTIVE, EnumGeneral::INACTIVE])->default(EnumGeneral::ACTIVE);
            $table->string('image')->nullable();
            $table->text('fcm_token')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
