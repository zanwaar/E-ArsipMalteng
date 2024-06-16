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
    public function up(): void
    {
        Schema::create('dokument', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_dokument')->unique()->comment('Nomor dokument');
            $table->string('nomor_agenda');
            $table->string('pengirim')->nullable();
            $table->string('penerima')->nullable();
            $table->string('bidang')->nullable();
            $table->date('tgl_dokument')->nullable();
            $table->date('tgl_diterima')->nullable();
            $table->text('description')->nullable();
            $table->text('note')->nullable();
            $table->string('type')->default('incoming')->comment('dokument Masuk (incoming)/dokument Keluar (outgoing)');
            $table->string('klasifikasi_kode');
            $table->foreign('klasifikasi_kode')->references('code')->on('klasifikasi');
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
