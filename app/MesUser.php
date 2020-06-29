<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MesUser extends Model
{
    //
    protected $table = 'mes_user';
    protected $primary_key = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;
}
