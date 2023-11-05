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
        Schema::create('messages_supports', function (Blueprint $table) {
            $table->id();
            $table->foreignId("support_id")->constrained("supports")->cascadeOnDelete();
            $table->integer("sender_id");
            $table->string('type');
            $table->text('message')->nullable();
            $table->string('attachment')->nullable();
            $table->enum('status', ['Read', 'Unread'])->default('Unread');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages_supports');
    }
};
