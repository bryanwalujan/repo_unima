<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Haki extends Model
{
    protected $fillable = ['dosen_id', 'judul_haki', 'expired', 'link'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}