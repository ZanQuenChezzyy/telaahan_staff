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
        Schema::create('telaahan_staff', function (Blueprint $table) {
            $table->id();

            $table->foreignId('jenis_permintaan_id')->constrained('jenis_permintaans')->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();

            $table->string('kepada', 100);
            $table->string('dari', 100);
            $table->date('tanggal');
            $table->string('nomor', 30);
            $table->string('perihal', 100);
            $table->text('persoalan');
            $table->text('peranggapan');
            $table->text('fakta');
            $table->text('analisa');
            $table->text('kesimpulan');
            $table->text('saran');
            $table->string('wadir', 45);
            $table->string('nama_wadir', 45);
            $table->string('nip_wadir', 45);
            $table->string('nama_kabid', 45);
            $table->string('nip_kabid', 45);
            $table->unsignedTinyInteger('status');
            $table->unsignedBigInteger('total_satuan_harga')->nullable()->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telaahan_staff');
    }
};
