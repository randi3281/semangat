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
        Schema::create('anfiniti_session', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('login_id');
            $table->foreign('login_id')->references('id')->on('anfiniti_login')->onDelete('cascade');
            $table->string('sesi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anfiniti_session');
    }
};
