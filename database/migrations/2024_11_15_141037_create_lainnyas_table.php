<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lainnyas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('telaahan_staff_id')->constrained('telaahan_staff')->cascadeOnDelete();
            $table->text('deskripsi');
            $table->unsignedBigInteger('harga')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lainnyas');
    }
};
