<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Authenticatable
{
    protected $fillable = ['nidn', 'nip', 'nuptk', 'nama', 'foto', 'email'];

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