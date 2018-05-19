<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class daftarPresensi extends Model
{
    protected $table = 'daftar_presensis';
    protected $primaryKey = 'id_tabel';

    public function manajer()
    {
      return $this->belongsTo(User::class,'id_manajer');
    }

    public function karyawan()
    {
      return $this->belongsTo(User::class,'id_karyawan');
    }
}
