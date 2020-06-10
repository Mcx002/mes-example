<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M002_Line extends Model
{
    //
    protected $table = 'mes_m_line';
    protected $primaryKey = 'line_id';
    protected $guarded = ['line_id'];
}
