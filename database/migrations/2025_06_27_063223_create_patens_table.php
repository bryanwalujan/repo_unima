<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->constrained()->onDelete('cascade');
            $table->string('judul_paten');
            $table->string('jenis_paten');
            $table->date('expired')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patens');
    }
};