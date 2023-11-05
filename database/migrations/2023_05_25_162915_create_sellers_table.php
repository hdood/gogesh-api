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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string("firstname");
            $table->string("lastname");
            $table->string("email");
            $table->string("phone")->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->integer("active")->default(true);
            $table->foreignId("country_id")->nullable()->constrained("countries")->cascadeOnUpdate();
            $table->foreignId("city_id")->nullable()->constrained("cities")->cascadeOnUpdate();
            $table->foreignId("region_id")->nullable()->constrained("regions")->cascadeOnUpdate();
            $table->string("country")->nullable();
            $table->string("city")->nullable();
            $table->string("region")->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Pending', 'Rejected', 'Updated'])->default("Pending");
            $table->enum('type', ['Company', 'Personal'])->default("Personal");
            $table->string('image')->nullable();
            $table->string('fcm_token')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('reason')->nullable();
            $table->string('reason_update')->nullable();
            //
            $table->string('commercial_activity_name')->nullable();
            $table->foreignId("activity_id")->nullable()->constrained("activities")->cascadeOnUpdate();
            $table->foreignId("sub_sector_id")->nullable()->constrained("sub_sectors")->cascadeOnUpdate();
            $table->foreignId("sector_id")->nullable()->constrained("sectors")->cascadeOnUpdate();

            $table->string('commercial_activity_description')->nullable();
            $table->string('commercial_activity_phone')->nullable();
            $table->string('address')->nullable();
            $table->string('civil_card')->nullable();
            $table->string('commercial_license')->nullable();
            $table->string('signature_approval')->nullable();
            $table->integer('upgraded')->default(false);
            $table->enum('upgraded_status', ['Approved', 'Rejected', 'Pending', 'Not_Paid'])->nullable();
            $table->string('logo')->nullable();
            $table->integer('delivery')->nullable();
            $table->float('delivery_price')->nullable();
            $table->json("social_accounts")->nullable();
            $table->json("work_days")->nullable();
            $table->integer("actived")->default(0);
            $table->integer('verification')->default(0);
            $table->integer('completed')->default(0);
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
        Schema::dropIfExists('sellers');
    }
};
