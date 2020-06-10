<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MesUser extends Model
{
    //
    protected $table = 'mes_user';
    protected $primary_key = 'emp_id';
    protected $fillable = ['emp_id','name','password','level'];
    public $timestamps = false;
}
