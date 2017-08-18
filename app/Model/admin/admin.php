<?php

namespace App\Model\admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admin extends Authenticatable
{
    use Notifiable;

    public function stores(){
        return $this->hasMany('App\Store', 'admin_id', 'id');
    }
}
