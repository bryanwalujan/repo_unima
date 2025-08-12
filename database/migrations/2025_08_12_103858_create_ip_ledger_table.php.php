<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpLedgerTable extends Migration
{
    public function up()
    {
        Schema::create('ip_ledger', function (Blueprint $table) {
            $table->id();
            $table->string('model_type'); // Haki atau Paten
            $table->unsignedBigInteger('model_id'); // ID dari Haki/Paten
            $table->string('hash', 64); // Hash SHA-256
            $table->text('data'); // Data asli yang di-hash (terenkripsi)
            $table->unsignedBigInteger('dosen_id'); // Dosen terkait
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ip_ledger');
    }
}