<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengabdians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->constrained()->onDelete('cascade');
            $table->string('skema');
            $table->string('posisi');
            $table->string('judul_pengabdian');
            $table->string('sumber_dana');
            $table->string('status');
            $table->year('tahun');
            $table->string('link_luaran')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengabdians');
    }
};