<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M001_WorkOrder extends Model
{
    //
    protected $table = 'mes_m_prod_plan';
    protected $primaryKey = 'seq';
    protected $fillable = ['seq','order_no','wo_no','d_create','d_start','d_end','model','c_style','c_size','part_no','assy_date','prod_line','wo_type','assy_line','s_op','e_op','o_qty','p_qty','d_qty','create_by','release_date','status','remarks'];
    public $timestamps = false;
}
