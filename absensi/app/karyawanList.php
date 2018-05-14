<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class karyawanList extends Model
{
  protected $table = 'data_karyawan';
  public $timestamps = false;

  protected $fillable = [
      'id_manajer', 'id_karyawan',
  ];

  public function manajernya()
  {
    return $this->belongsTo(User::class,'id_manajer');
  }

  public function karyawannya()
  {
    return $this->belongsTo(User::class,'id_karyawan');
  }
}
