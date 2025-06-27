<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = ['nidn', 'nip', 'nuptk', 'nama'];

    public function penelitians()
    {
        return $this->hasMany(Penelitian::class);
    }

    public function pengabdians()
    {
        return $this->hasMany(Pengabdian::class);
    }

    public function hakis()
    {
        return $this->hasMany(Haki::class);
    }

    public function patens()
    {
        return $this->hasMany(Paten::class);
    }
}