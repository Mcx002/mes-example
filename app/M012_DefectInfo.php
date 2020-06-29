<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M012_DefectInfo extends Model
{
    //
    protected $table = 'mes_defect_info';
    protected $primaryKey = 'defect_id';
    protected $guarded = ['defect_id'];
}
