<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Dosen extends Authenticatable
{
    protected $fillable = ['nidn', 'nip', 'nuptk', 'nama', 'email', 'foto'];

    // Mutator untuk mengenkripsi data sensitif sebelum disimpan
    public function setNidnAttribute($value)
    {
        $this->attributes['nidn'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setNipAttribute($value)
    {
        $this->attributes['nip'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setNuptkAttribute($value)
    {
        $this->attributes['nuptk'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = $value ? Crypt::encryptString($value) : null;
    }

    // Accessor untuk mendekripsi data saat diambil
    public function getNidnAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    public function getNipAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    public function getNuptkAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    public function getNamaAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    public function getEmailAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

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