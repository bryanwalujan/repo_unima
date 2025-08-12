<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    protected $fillable = ['dosen_id', 'judul_penelitian', 'keywords', 'skema', 'posisi', 'sumber_dana', 'status', 'tahun', 'link_luaran'];

    protected $casts = [
        'keywords' => 'array', // Cast kolom keywords ke array
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}