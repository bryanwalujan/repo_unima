<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paten extends Model
{
    protected $fillable = ['dosen_id', 'judul_paten', 'jenis_paten', 'expired', 'link'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}