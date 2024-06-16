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
        Schema::create('disposisi', function (Blueprint $table) {
            $table->id();
            $table->string('penerima');
            $table->date('batas_waktu');
            $table->text('content');
            $table->text('note')->nullable();
            $table->foreignId('status_dokument')->constrained('status-dokument', 'id')->cascadeOnDelete();
            $table->foreignId('dokument_id')->constrained('dokument')->cascadeOnDelete();
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
        Schema::dropIfExists('dispositions');
    }
};
