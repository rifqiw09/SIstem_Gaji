<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $fillable = [
        'nama',
        'nip',
        'alamat',
        'no_telepon',
        'tanggal_masuk',
        'jabatan_id',
        'status'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function gaji()
    {
        return $this->hasMany(Gaji::class);
    }
}
