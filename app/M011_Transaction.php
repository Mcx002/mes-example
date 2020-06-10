<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M011_Transaction extends Model
{
    //
    protected $table = 'mes_transaction';
    protected $primaryKey = 'seq';
    protected $guarded = ['id'];
}
