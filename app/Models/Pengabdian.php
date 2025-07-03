<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengabdian extends Model
{
    protected $fillable = ['dosen_id', 'skema', 'posisi', 'judul_pengabdian', 'sumber_dana', 'status', 'tahun', 'link_luaran'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}