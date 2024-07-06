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
        Schema::create('plan_condiciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('condiciones_id'); 
            $table->foreign('condiciones_id')->references('id')->on('condiciones')->onDelete('cascade');
            $table->unsignedBigInteger('planes_id'); 
            $table->foreign('planes_id')->references('id')->on('planes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_condiciones');
    }
};
