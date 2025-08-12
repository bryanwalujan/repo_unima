<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class FixDosenColumnsForEncryption extends Migration
{
    public function up()
    {
        // Backup data sebelum perubahan
        DB::statement('CREATE TABLE dosens_backup AS SELECT * FROM dosens');

        // Ubah kolom menjadi TEXT dan nullable untuk menghindari error
        Schema::table('dosens', function (Blueprint $table) {
            $table->text('nidn')->nullable()->change();
            $table->text('nip')->nullable()->change();
            $table->text('nuptk')->nullable()->change();
            $table->text('nama')->nullable()->change();
            $table->text('email')->nullable()->change();
        });

        // Enkripsi ulang data yang ada
        $dosens = DB::table('dosens')->get();
        foreach ($dosens as $dosen) {
            DB::table('dosens')->where('id', $dosen->id)->update([
                'nidn' => $dosen->nidn ? Crypt::encryptString($dosen->nidn) : null,
                'nip' => $dosen->nip ? Crypt::encryptString($dosen->nip) : null,
                'nuptk' => $dosen->nuptk ? Crypt::encryptString($dosen->nuptk) : null,
                'nama' => $dosen->nama ? Crypt::encryptString($dosen->nama) : null,
                'email' => $dosen->email ? Crypt::encryptString($dosen->email) : null,
            ]);
        }
    }

    public function down()
    {
        // Pulihkan dari backup
        Schema::dropIfExists('dosens');
        Schema::rename('dosens_backup', 'dosens');
    }
}