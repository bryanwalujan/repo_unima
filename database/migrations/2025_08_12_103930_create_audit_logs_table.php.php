<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditLogsTable extends Migration
{
    public function up()
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('model_type'); // Model yang diubah (Dosen, Haki, dll.)
            $table->unsignedBigInteger('model_id'); // ID record
            $table->string('action'); // create, update, delete
            $table->text('changes')->nullable(); // Perubahan dalam JSON
            $table->unsignedBigInteger('user_id')->nullable(); // User yang melakukan aksi
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_logs');
    }
}