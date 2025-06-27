<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    protected $fillable = ['dosen_id', 'skema', 'posisi', 'judul_penelitian', 'sumber_dana', 'status', 'tahun', 'link_luaran'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}