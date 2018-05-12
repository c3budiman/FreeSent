<?php

namespace App\Transformers;

use App\karyawanList;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract {
  //ini fungsi transformer gunanya biar seragamin respon, jadi klo ganti variabel atau kolom di db, response kagak diganti
  //jadi frontend designer bisa bernapas lega.... karena klo backend ngeganti kolom di db, data kagak ke ganti di frontend
  public function transform(karyawanList $lk) {
    return [
      'id'                  =>  $lk->id,
      'id_karyawan'         =>  $lk->id_karyawan,
      'id_manajer'          =>  $lk->id_manajer
    ];
  }
}
