<?php

namespace App;

use App\karyawanList;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'password', 'avatar', 'roles_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function manajer()
    {
      return $this->hasMany(karyawanList::class);
    }

    public function role()
    {
      return $this->belongsTo(Role::class,'roles_id');
    }

    public function punyaRule($namaRule, $namaRule2)
    {
      if($this->role->namaRule == $namaRule || $this->role->namaRule == $namaRule2) {
        return true;
      }
      return false;
    }
}
