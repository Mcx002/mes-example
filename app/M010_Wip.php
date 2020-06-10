<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M010_Wip extends Model
{
    //
    protected $table = 'mes_m_wip';
    protected $primaryKey = 'seq';
    protected $guarded = ['id'];
}
