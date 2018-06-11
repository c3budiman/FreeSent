<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class berita extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';

    public function authornya()
    {
      return $this->belongsTo(User::class,'author');
    }
}
