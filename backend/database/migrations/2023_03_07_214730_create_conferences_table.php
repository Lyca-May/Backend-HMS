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
        Schema::create('conference', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname');
            $table->string('address');
            $table->string('phoneno');
            $table->date('date_of_appoint');
            $table->string('session');
            $table->string('no_of_participantss');
            $table->string('name_of_institution');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conference');
    }
};
