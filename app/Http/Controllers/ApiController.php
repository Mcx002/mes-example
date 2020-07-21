<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\MesUser;
use App\M001_WorkOrder;
use App\M002_Line;
use App\M003_LeadTime;
use App\M004_Routing;
use App\M005_Bom;
use App\M006_Op;
use App\M007_Part;
use App\M008_Model;
use App\M009_Size;
use App\M012_DefectInfo;
use Carbon\Carbon;

class ApiController extends Controller
{
    public function workorders(){
        $data = M001_WorkOrder::all();
        return response()->json($data);
    }
    public function addworkorder(Request $request){
        $now = date('Y-m-d H:i:s');
        $workorder = M001_WorkOrder::create([
            'seq'=>$request->seq,
            'order_no'=>$request->order_no,
            'wo_no'=>$request->wo_no,
            'd_create'=>$now,
            'd_start'=>$request->d_start,
            'd_end'=>$request->d_end,
            'model'=>$request->model,
            'c_style'=>$request->c_style,
            'c_size'=>$request->c_size,
            'part_no'=>$request->part_no,
            'assy_date'=>$request->assy_date,
            'prod_line'=>$request->prod_line,
            'wo_type'=>$request->wo_type,
            'assy_line'=>$request->assy_line,
            's_op'=>$request->s_op,
            'e_op'=>$request->e_op,
            'o_qty'=>$request->o_qty,
            'p_qty'=>$request->p_qty,
            'd_qty'=>$request->d_qty,
            'create_by'=>$request->create_by,
            'release_date'=>$now,
            'status'=>$request->status,
            'remarks'=>$request->remarks,
        ]);
        return response()->json(['id'=>$workorder->seq]);
    }
    // public function editworkorder(Request $request){
    //     $workorder = WorkOrder::where('work_order_id',$request->id)->update([
    //         'work_order_date'=>$request->date,
    //         'work_order_qty'=>$request->qty,
    //         'serial_no_min'=>$request->serial_no_min,
    //         'serial_no_max'=>$request->serial_no_max,
    //         'assy_id'=>$request->assy_id,
    //         'sales_order_id'=>$request->sales_order_id,
    //         'process_id'=>$request->process_id,
    //         'bom_id'=>$request->bom_id,
    //         'bom_rev'=>$request->bom_rev
    //     ]);
    //     return response('success',200);
    // }
    public function getCountOfBOM(){
        $data = DB::select("select distinct bom_parent from mes_m_bom where CONCAT(bom_parent,'XZ') != 'XZ'");
        return response()->json($data);
    }
    public function getBOM(Request $request){
        $data = DB::select("select bom_components as 'bom_parent' from mes_m_bom where bom_parent = '".$request->bom_parent."'");
        return response()->json($data);
    }
    public function boms(){
        $data = M005_Bom::all();
        return response()->json($data);
    }
    public function addbom(Request $request){
        $bom = M005_Bom::create([
            'bom_components'=>$request->bom_components,
            'bom_parent'=>$request->bom_parent,
            'create_by'=>$request->user_id,
        ]);
        return response()->json(['id'=>$bom->bom_components]);
    }
    public function editbom(Request $request){
        M005_Bom::find($request->id)->update([
            'bom_components'=>$request->bom_components,
            'bom_parent'=>$request->bom_parent,
            'update_by'=>$request->user_id
        ]);
        return response('success',200);
    }
    public function lines(){
        $data = M002_Line::all();
        return response()->json($data);
    }
    public function addline(Request $request){
        $line = M002_Line::create([
            'op_id'=>$request->op_id,
            'line_code'=>$request->line_code,
            'line_desc'=>$request->line_desc,
            'create_by'=>$request->create_by
        ]);
        return response()->json(['id'=>$line->line_id]);
    }
    public function editline(Request $request){
        M002_Line::find($request->line_id)->update([
            'op_id'=>$request->op_id,
            'line_code'=>$request->line_code,
            'line_desc'=>$request->line_desc,
            'update_by'=>$request->update_by
        ]);
        return response('success',200);
    }
    public function leadtimes(){
        $data = M003_LeadTime::all();
        return response()->json($data);
    }
    public function addleadtime(Request $request){
        $leadtime = M003_LeadTime::create([
            'component_id'=>$request->component_id,
            'lead_time'=>$request->lead_time,
            'process_time'=>$request->process_time,
            'create_by'=>$request->create_by,
        ]);
        return response()->json(['id'=>$leadtime->id]);
    }
    public function editleadtime(Request $request){
        $leadtime = M003_LeadTime::find($request->id)->update([
            'lead_time'=>$request->lead_time,
            'process_time'=>$request->process_time,
            'update_by'=>$request->update_by,
        ]);
        return response('success',200);
    }
    public function routings(){
        $data = M004_Routing::orderBy('part_no','ASC')->orderBy('operation_id','ASC')->get();
        return response()->json($data);
    }
    public function addrouting(Request $request){
        $routing = M004_Routing::create([
            'part_no'=>$request->part_no,
            'c_op'=>$request->c_op,
            'operation_id'=>$request->operation_id,
            'next_operation_id'=>$request->next_operation_id,
            'create_by'=>$request->create_by
        ]);
        return response()->json(['id'=>$routing->id]);
    }
    public function editrouting(Request $request){
        M004_Routing::find($request->id)->update([
            'part_no'=>$request->part_no,
            'c_op'=>$request->c_op,
            'operation_id'=>$request->operation_id,
            'next_operation_id'=>$request->next_operation_id,
            'update_by'=>$request->update_by
        ]);
        return response('success',200);
    }
    public function routingpartno(){
        $data = DB::select('select part_no from mes_m_routing group by part_no');
        return response()->json($data);
    }

    public function ops(){
        $data = M006_Op::all();
        return response()->json($data);
    }
    public function addop(Request $request){
        $op = M006_Op::create([
            'op_id'=>$request->op_id,
            'op_desc'=>$request->op_desc,
            'create_by'=>$request->create_by,
        ]);
        return response()->json(['id'=>$op->id]);
    }
    public function editop(Request $request){
        M006_Op::find($request->id)->update([
            'op_id'=>$request->op_id,
            'op_desc'=>$request->op_desc,
            'update_by'=>$request->update_by,
        ]);
        return response('success',200);
    }

    public function parts(){
        $data = M007_Part::all();
        return response()->json($data);
    }
    public function addpart(Request $request){
        $part = M007_Part::create([
            'part_no'=>$request->part_no,
            'part_desc'=>$request->part_desc,
            'create_by'=>$request->create_by,
        ]);
        return response()->json(['id'=>$part->id]);
    }
    public function editpart(Request $request){
        M007_Part::find($request->id)->update([
            'part_no'=>$request->part_no,
            'part_desc'=>$request->part_desc,
            'update_by'=>$request->update_by,
        ]);
        return response('success',200);
    }

    public function models(){
        $data = M008_Model::all();
        return response()->json($data);
    }
    public function addmodel(Request $request){
        $model = M008_Model::create([
            'model'=>$request->model,
            'style'=>$request->style,
            'create_by'=>$request->create_by,
        ]);
        return response()->json(['id'=>$model->id]);
    }
    public function editmodel(Request $request){
        M008_Model::find($request->id)->update([
            'model'=>$request->model,
            'style'=>$request->style,
            'update_by'=>$request->update_by,
        ]);
        return response('success',200);
    }

    public function sizes(){
        $data = M009_Size::all();
        return response()->json($data);
    }
    public function addsize(Request $request){
        $size = M009_Size::create([
            'size_id'=>$request->size_id,
            'desc'=>$request->desc,
            'create_by'=>$request->create_by,
        ]);
        return response()->json(['id'=>$size->id]);
    }
    public function editsize(Request $request){
        M009_Size::find($request->id)->update([
            'size_id'=>$request->size_id,
            'desc'=>$request->desc,
            'update_by'=>$request->update_by,
        ]);
        return response('success',200);
    }

    public function wostat(Request $request){
        $model = '';
        $style = '';
        $part = '';
        $assy_date = '';
        $data = DB::table('mes_m_prod_plan')->where('status','R')->where('o_qty','>',DB::raw('p_qty+d_qty'));
        if(isset($request->model)){
            if($request->model!=''){
                $model = " and model='".$request->model."'";
                $data = $data->where('model',$request->model);
            }
        }
        if(isset($request->style)){
            if($request->style!=''){
                $style = " and c_style='".$request->style."'";
                $data = $data->where('c_style',$request->style);
            }
        }
        if(isset($request->part_no)){
            if($request->part_no!=''){
                $part = " and part_no='".$request->part_no."'";
                $data = $data->where('part_no',$request->part_no);
            }
        }
        if(isset($request->assy_date)){
            if($request->assy_date!=''){
                $assy_date = " and assy_date='".$request->assy_date."'";
                $data = $data->where('assy_date',$request->assy_date);
            }
        }
        $data = $data->paginate(15);
        return response()->json($data);
    }
    public function processchild(Request $request){
        $valueinsertwip = '';
        $valueinserttransaction = '';
        // $data = json_decode($request);
        // dd($data);
        $form = $request->data;
        $wo = M001_WorkOrder::find($form[0]['seq']);
        // dd($wo);
        DB::transaction(function() use ($form,$wo){
            for($i=0;$i<count($form);$i++){
                // echo $form[$i]['wo_no'];
                // dd($form);
                if($form[$i]['wip_qty']!=null||$form[$i]['wip_qty']>0){
                    $qty = 0;
                    if($form[$i]['prod_line']==null){
                        $prodline = '';
                    }else{
                        $prodline = " and prod_line='".$form[$i]['prod_line']."'";
                    }
                    $data = DB::select("select * from mes_m_wip where wo_no='".$form[$i]['wo_no']."' and location='".$form[$i]['location']."'$prodline");
                    // dd($data);
                    if(count($data)>0){
                        $qty = DB::raw('wip_qty +'.$form[$i]['wip_qty']);
                    }else{
                        $qty = $form[$i]['wip_qty'];
                    }
                    
                    DB::table('mes_m_wip')->updateOrInsert([
                        'wo_no'=>$form[$i]['wo_no'],
                        'part_no'=>$form[$i]['part_no'],
                        'location'=>$form[$i]['location'],
                        'prod_line'=>$form[$i]['prod_line'],
                    ],[
                        'wip_qty'=>$qty
                    ]);
                    DB::table('mes_transaction')->insert([
                        'txn_date'=>Carbon::now(),
                        'wo_no'=>$form[$i]['wo_no'],
                        'operation'=>$form[$i]['location'],
                        'txn_qty'=>$form[$i]['wip_qty'],
                        'prod_line'=>$form[$i]['prod_line'],
                        'create_by'=>$form[$i]['create_by']
                    ]);
                    if($form[$i]['location']==$wo->e_op){
                        $wo->update([
                            'p_qty'=>DB::raw('p_qty + '.$form[$i]['wip_qty'])
                        ]);
                    }
                    if($i-1!==-1){
                        if($form[$i]['get_process']!=''){
                            DB::table('mes_m_wip')
                                ->where('wo_no',$form[$i-1]['wo_no'])
                                ->where('part_no',$form[$i-1]['part_no'])
                                ->where('location',$form[$i-1]['location'])
                                ->where('prod_line',$form[$i]['get_process'])
                                ->update([
                                    'wip_qty'=>DB::raw('wip_qty - '.$form[$i]['wip_qty'])
                                ]);
                        }else{
                            DB::table('mes_m_wip')
                                ->where('wo_no',$form[$i-1]['wo_no'])
                                ->where('part_no',$form[$i-1]['part_no'])
                                ->where('location',$form[$i-1]['location'])
                                ->update([
                                    'wip_qty'=>DB::raw('wip_qty - '.$form[$i]['wip_qty'])
                                ]);
                        }
                    }
                }
                // $valueinsertwip .= "('".$form[$i]['wo_no']."','".$form[$i]['part_no']."','".$form[$i]['location']."','".$form[$i]['prod_line']."','".$form[$i]['wip_qty']."')";
                // $valueinserttransaction .= "(NOW(),'".$form[$i]['wo_no']."','".$form[$i]['location']."','".$form[$i]['wip_qty']."','".$form[$i]['prod_line']."','".$form[$i]['create_by']."')";
                // if($i!=count($form)-1){
                //     $valueinsertwip .= ',';
                //     $valueinserttransaction .= ',';
                // }
            }
        // $sql = "START TRANSACTION;\ninsert into mes_m_wip (wo_no,part_no,location,prod_line,wip_qty) values ".$valueinsertwip.";\n";
        // $sql .= "insert into mes_transaction (txn_date,wo_no,operation,txn_qty,prod_line,create_by) values ".$valueinserttransaction.";\n";
        // $sql .= "COMMIT TRANSACTION;";

        },3);
        return response('success',200);
    }
    public function processdefectchild(Request $request){
        $valueinsertwip = '';
        $valueinserttransaction = '';
        // $data = json_decode($request);
        // dd($data);
        $defectdate = $request->defectdate;    
        $form = $request->data;
        $wo = M001_WorkOrder::find($form[0]['seq']);
        // dd($wo);
        DB::transaction(function() use ($form,$wo,$defectdate){
            for($i=0;$i<count($form);$i++){
                // echo $form[$i]['wo_no'];
                // dd($form);
                if($form[$i]['wip_qty']!=null||$form[$i]['wip_qty']>0){
                    $data = DB::select("select * from mes_m_wip where wo_no='WONK200528101003' and location='CPC' and prod_line='CPC01'");
                    
                    DB::table('mes_defect')->insert([
                        'wo_no'=>$form[$i]['wo_no'],
                        'prod_line'=>$form[$i]['prod_line'],
                        'operation'=>$form[$i]['location'],
                        'input_date'=>Carbon::now(),
                        'defect_date'=>$defectdate,
                        'defect_id'=>$form[$i]['defect_info_id'],
                        'defect_qty'=>$form[$i]['wip_qty'],
                        'create_by'=>$form[$i]['create_by']
                    ]);
                    // DB::table('mes_transaction')->insert([
                    //     'txn_date'=>Carbon::now(),
                    //     'wo_no'=>$form[$i]['wo_no'],
                    //     'operation'=>$form[$i]['location'],
                    //     'txn_qty'=>$form[$i]['wip_qty'],
                    //     'prod_line'=>$form[$i]['prod_line'],
                    //     'create_by'=>$form[$i]['create_by']
                    // ]);
                    // if($form[$i]['location']==$wo->e_op){
                    $wo->update([
                        'd_qty'=>DB::raw('d_qty + '.$form[$i]['wip_qty'])
                    ]);
                    // }
                    if($i-1!==-1){
                        if($form[$i]['get_process']!=''){
                            DB::table('mes_m_wip')
                                ->where('wo_no',$form[$i-1]['wo_no'])
                                ->where('part_no',$form[$i-1]['part_no'])
                                ->where('location',$form[$i-1]['location'])
                                ->where('prod_line',$form[$i]['get_process'])
                                ->update([
                                    'wip_qty'=>DB::raw('wip_qty - '.$form[$i]['wip_qty'])
                                ]);
                        }else{
                            DB::table('mes_m_wip')
                                ->where('wo_no',$form[$i-1]['wo_no'])
                                ->where('part_no',$form[$i-1]['part_no'])
                                ->where('location',$form[$i-1]['location'])
                                ->update([
                                    'wip_qty'=>DB::raw('wip_qty - '.$form[$i]['wip_qty'])
                                ]);
                        }
                    }
                }
                // $valueinsertwip .= "('".$form[$i]['wo_no']."','".$form[$i]['part_no']."','".$form[$i]['location']."','".$form[$i]['prod_line']."','".$form[$i]['wip_qty']."')";
                // $valueinserttransaction .= "(NOW(),'".$form[$i]['wo_no']."','".$form[$i]['location']."','".$form[$i]['wip_qty']."','".$form[$i]['prod_line']."','".$form[$i]['create_by']."')";
                // if($i!=count($form)-1){
                //     $valueinsertwip .= ',';
                //     $valueinserttransaction .= ',';
                // }
            }
        // $sql = "START TRANSACTION;\ninsert into mes_m_wip (wo_no,part_no,location,prod_line,wip_qty) values ".$valueinsertwip.";\n";
        // $sql .= "insert into mes_transaction (txn_date,wo_no,operation,txn_qty,prod_line,create_by) values ".$valueinserttransaction.";\n";
        // $sql .= "COMMIT TRANSACTION;";

        },3);
        return response('success',200);
    }
    public function countWip(Request $request){
        // $data = DB::select("select wo_no,operation,sum(txn_qty) as qty from mes_transaction where wo_no='".$request->wo_no."' group by operation");
        // $data = DB::select("select mt.wo_no,mt.operation,sum(txn_qty)as qty,(select ifnull(sum(defect_qty),0) from mes_defect where wo_no=mt.wo_no and operation=mt.operation) as defect_qty from mes_transaction mt where mt.wo_no='".$request->wo_no."' group by operation ");
        if($request->type=="child"){
            $data = DB::select("SELECT 'NOT YET' AS c_op, '0' AS operation_id,''AS prod_line,PP.o_qty - sum(IFNULL(MW.WIP_QTY,0)) - d_qty AS qty FROM mes_m_prod_plan PP LEFT JOIN  mes_m_wip MW on PP.wo_no = MW.wo_no AND PP.part_no = MW.part_no WHERE PP.wo_no ='".$request->wo_no."' UNION ALL SELECT MR.C_OP as c_op,MR.OPERATION_ID as operation_id,MW.PROD_LINE as prod_line, SUM(MW.WIP_QTY) as qty  from mes_m_prod_plan PP, mes_m_routing MR, mes_m_wip MW WHERE PP.wo_no= MW.wo_no and MW.part_no = MR.part_no AND MW.part_no = PP.part_no and PP.wo_no ='".$request->wo_no."' AND MR.c_op = MW.location GROUP BY MR.C_OP,MR.OPERATION_ID,MW.PROD_LINE ORDER BY OPERATION_ID,PROD_LINE;");

        }else{
            $data = DB::select("SELECT 'SET QTY' AS c_op, '0' AS operation_id,''AS prod_line,MIN(IFNULL(MW.WIP_QTY,0)) AS qty FROM mes_m_bom MB , mes_m_prod_plan PP LEFT JOIN mes_m_wip MW ON MW.location = PP.e_op AND MW.wo_no = PP.wo_no AND PP.part_no = MW.part_no WHERE CONCAT(PP.c_style,'-',PP.c_size,'-',PP.part_no) = MB.bom_components AND MB.bom_parent = '".$request->bom_parent."' AND PP.order_no ='".$request->order_no."' UNION ALL SELECT MR.c_op,MR.operation_id,MW.prod_line, SUM(MW.WIP_QTY) as qty  FROM mes_m_prod_plan PP, mes_m_routing MR, mes_m_wip MW WHERE PP.wo_no= MW.wo_no AND MW.part_no = MR.part_no AND MW.part_no = PP.part_no AND PP.wo_no ='".$request->wo_no."' AND MR.c_op = MW.location GROUP BY MR.C_OP,MR.OPERATION_ID,MW.PROD_LINE ORDER BY OPERATION_ID,PROD_LINE;");
        }
        // $data = DB::select("SELECT PP.wo_no,PP.part_no,MR.c_op,MR.operation_id,MW.prod_line, SUM(MW.WIP_QTY) as qty  from mes_m_prod_plan PP, mes_m_routing MR, mes_m_wip MW WHERE PP.wo_no= MW.wo_no and MW.part_no = MR.part_no AND MW.part_no = PP.part_no and MW.prod_line = '".$request->prod_line."' and PP.wo_no ='".$request->wo_no."' AND MR.c_op = MW.location GROUP BY MR.C_OP,MR.OPERATION_ID,MW.PROD_LINE ORDER BY OPERATION_ID,PROD_LINE;");
        // $data = DB::select("SELECT PP.wo_no,PP.part_no,'NOT YET' AS C_OP, '0' AS OPERATION_ID,''AS PROD_LINE,PP.o_qty - sum(IFNULL(MW.WIP_QTY,0)) - d_qty AS QTY FROM mes_m_prod_plan PP LEFT JOIN  mes_m_wip MW on PP.wo_no = MW.wo_no AND PP.part_no = MW.part_no WHERE PP.wo_no ='".$request->wo_no."' UNION ALL SELECT PP.wo_no,PP.part_no,MR.C_OP,MR.OPERATION_ID,MW.PROD_LINE, SUM(MW.WIP_QTY)  from mes_m_prod_plan PP, mes_m_routing MR, mes_m_wip MW WHERE PP.wo_no= MW.wo_no and MW.part_no = MR.part_no AND MW.part_no = PP.part_no and PP.wo_no ='".$request->wo_no."' AND MR.c_op = MW.location GROUP BY MR.C_OP,MR.OPERATION_ID,MW.PROD_LINE ORDER BY OPERATION_ID,PROD_LINE;");
        // dd($data);
        return response()->json($data);

    }
    public function getprocesschange(Request $request){
        $data = DB::select("SELECT PP.wo_no,PP.part_no,MR.c_op,MR.operation_id,MW.prod_line, SUM(MW.WIP_QTY) as qty  from mes_m_prod_plan PP, mes_m_routing MR, mes_m_wip MW WHERE PP.wo_no= MW.wo_no and MW.part_no = MR.part_no AND MW.part_no = PP.part_no and MW.prod_line = '".$request->prod_line."' and PP.wo_no ='".$request->wo_no."' AND MR.c_op = MW.location GROUP BY MR.C_OP,MR.OPERATION_ID,MW.PROD_LINE ORDER BY OPERATION_ID,PROD_LINE;");
        return response()->json($data);
    }
    public function getbaseqtyparent(Request $request){
        $data = DB::select("SELECT 'c_op' AS c_op, '0' AS operation_id,''AS prod_line,MIN(IFNULL(MW.WIP_QTY,0)) AS qty FROM mes_m_bom MB , mes_m_prod_plan PP LEFT JOIN mes_m_wip MW ON MW.location = PP.e_op AND MW.wo_no = PP.wo_no AND PP.part_no = MW.part_no WHERE CONCAT(PP.c_style,'-',PP.c_size,'-',PP.part_no) = MB.bom_components AND MB.bom_parent = '".$request->bom."' AND PP.order_no ='".$request->order_no."' UNION ALL SELECT MR.C_OP,MR.OPERATION_ID,MW.PROD_LINE, SUM(MW.WIP_QTY)  FROM mes_m_prod_plan PP, mes_m_routing MR, mes_m_wip MW WHERE PP.wo_no= MW.wo_no AND MW.part_no = MR.part_no AND MW.part_no = PP.part_no AND PP.wo_no ='".$request->wo_no."' AND MR.c_op = MW.location GROUP BY MR.C_OP,MR.OPERATION_ID,MW.PROD_LINE ORDER BY OPERATION_ID,PROD_LINE;");
        return response()->json($data);
    }
    public function getdefectinfo(Request $request){
        $data = DB::select("select * from mes_defect_info where part_no='".$request->part_no."'");
        return response()->json($data);
    }
    public function defectinfo(Request $request){
        $data = DB::select("select * from mes_defect_info");
        return response()->json($data);
    }
    public function getDataFullQty(){
        $data = DB::select("select sum(ifnull((select sum(txn_qty) from mes_transaction where wo_no=pp.wo_no and operation=pp.e_op),0)) as p_qty, ifnull((select sum(defect_qty) from mes_defect),0) as d_qty, sum(pp.o_qty) as o_qty from mes_m_prod_plan pp where pp.part_no='000'");
        return response()->json($data[0]);
    }
    public function getDataQty(Request $request){
        // $data = DB::select("select sum(p_qty) as p_qty, sum(d_qty) as d_qty from mes_m_prod_plan");
        if($request->datestart!=''&&$request->dateend!=''){
            if($request->datestart==$request->dateend){
                $todayDate = " and txn_date like '".$request->datestart."%'";
                $todayDate2 = " and defect_date like '".$request->datestart."%'";
            }else{
                $todayDate = " and txn_date between '".$request->datestart."' and '".$request->dateend."'";
                $todayDate2 = " and defect_date between '".$request->datestart."' and '".$request->dateend."'";
            }
        }else{
            if($request->datestart==''&&$request->dateend==''){
                $todayDate = "";
                $todayDate2 = "";
            }else{
                $date='';
                if($request->dateend!=''){
                    $date = $request->dateend;
                }
                if($request->datestart!=''){
                    $date = $request->datestart;
                }
                $todayDate = " and txn_date like '".$date."%'";
                $todayDate2 = " and defect_date like '".$date."%'";
            }
        }
        $data=DB::select("select ifnull(sum(mt.txn_qty),0) as qty, ml.line_code as assy_line from mes_m_line ml left join mes_m_prod_plan pp on pp.assy_line = ml.line_code left join mes_transaction mt on mt.wo_no = pp.wo_no and mt.operation = pp.e_op$todayDate where op_id = 'ASY' and pp.part_no = '000' group by ml.line_code");
        // $data = DB::select("select mt.txn_date as date,pp.o_qty,mt.txn_qty as p_qty from mes_transaction mt left join mes_m_prod_plan pp on pp.wo_no = mt.wo_no where pp.part_no = '000' and mt.operation = pp.e_op$todayDate");
        $data2 = DB::select("select defect_date,sum(defect_qty) as qty from mes_defect md group by defect_date$todayDate2");
        // dd($todayDate);
        return response()->json($data);
    }
    public function getDataByPartNo(){
        $data = DB::select("select (select sum(mtt.txn_qty) from mes_m_prod_plan mpp left join mes_transaction mtt on mtt.wo_no = mpp.wo_no and mtt.operation = mpp.e_op where mpp.part_no=mp.part_no) as qty, mp.part_no,mp.part_desc from mes_m_part mp where (mp.part_no = '000' or mp.part_no = '100' or mp.part_no = '500' or mp.part_no = '800')");
        return response()->json($data);
    }
    public function datawo($assystart,$assyend,$part_no){
        if($assystart=='null'&&$assyend=='null'&&$part_no=='null'){
            $data = M001_WorkOrder::paginate(15);
        }else{
            if($part_no!='null'){
                if($assystart!='null'&&$assyend!='null'){
                    $from = date($assystart);
                    $to = date($assyend);
                    $data = M001_WorkOrder::where('part_no',$part_no)->whereBetween('assy_date',[$from,$to])->paginate(15);
                    // echo json_encode($data);
                }else{
                    $data = M001_WorkOrder::where('part_no',$part_no)->paginate(15);
                }
            }else{
                $from = date($assystart);
                $to = date($assyend);
                $data = M001_WorkOrder::whereBetween('assy_date',[$from,$to])->paginate(15);
            }
        }
        return response()->json($data);
    }
    public function top5defect(){
        $data = DB::select("select md.*,pp.part_no,mdi.defect_desc from mes_defect md left join mes_m_prod_plan pp on pp.wo_no = md.wo_no join mes_defect_info mdi on mdi.defect_id = md.defect_id order by defect_qty desc limit 5");
        return response()->json($data);
    }
    public function transactions(Request $request){
        $assystart = '';
        $assyend = '';
        $operation = '';
        $prod_line = '';
        $data = DB::table('mes_transaction')->join('mes_m_prod_plan','mes_transaction.wo_no','=','mes_m_prod_plan.wo_no')
                ->select('mes_transaction.seq','mes_transaction.txn_date','mes_transaction.wo_no','mes_transaction.operation',DB::raw("sum(txn_qty) as txn_qty"),'mes_transaction.prod_line','mes_transaction.create_by','mes_m_prod_plan.part_no','mes_m_prod_plan.model','mes_m_prod_plan.c_style','mes_m_prod_plan.c_size')
                ->groupBy('mes_transaction.txn_date','mes_transaction.wo_no','mes_transaction.operation','mes_transaction.prod_line');
        if(isset($request->assystart)){
            if($request->assystart!=''){
                $from = date($request->assystart);
                $to = date($request->assyend);
                $data = $data->whereBetween('txn_date',[$from,$to]);
            }
        }
        if(isset($request->operation)){
            if($request->operation!=''){
                $data = $data->where('operation',$request->operation);
            }
        }
        if(isset($request->prod_line)){
            if($request->prod_line!=''){
                $data = $data->where('prod_line',$request->prod_line);
            }
        }
        if(isset($request->part_no)){
            if($request->part_no!=''){
                $data = $data->where('part_no',$request->part_no);
            }
        }
        if(isset($request->model)){
            if($request->model!=''){
                $data = $data->where('model',$request->model);
            }
        }
        if(isset($request->style)){
            if($request->style!=''){
                $data = $data->where('c_style',$request->style);
            }
        }
        if(isset($request->size)){
            if($request->size!=''){
                $data = $data->where('c_size',$request->size);
            }
        }
        $data = $data->orderBy('mes_transaction.seq','ASC')->paginate(15);
        return response()->json($data);
    }
    public function defects(Request $request){
        $assystart = '';
        $assyend = '';
        $operation = '';
        $prod_line = '';
        $data = DB::table('mes_defect')
                ->join('mes_m_prod_plan','mes_defect.wo_no','=','mes_m_prod_plan.wo_no')
                ->leftjoin('mes_defect_info','mes_defect.defect_id','=','mes_defect_info.defect_id')
                ->select('mes_defect.seq','mes_defect.defect_date','mes_defect.wo_no','mes_defect.operation',DB::raw("sum(defect_qty) as defect_qty"),'mes_defect.prod_line','mes_defect.create_by','mes_m_prod_plan.part_no','mes_m_prod_plan.model','mes_m_prod_plan.c_style','mes_m_prod_plan.c_size','mes_defect_info.defect_desc')
                ->groupBy('mes_defect.defect_date','mes_defect.wo_no','mes_defect.operation','mes_defect.prod_line');
        if(isset($request->assystart)){
            if($request->assystart!=''){
                $from = date($request->assystart);
                $to = date($request->assyend);
                $data = $data->whereBetween('defect_date',[$from,$to]);
            }
        }
        if(isset($request->operation)){
            if($request->operation!=''){
                $data = $data->where('operation',$request->operation);
            }
        }
        if(isset($request->prod_line)){
            if($request->prod_line!=''){
                $data = $data->where('prod_line',$request->prod_line);
            }
        }
        if(isset($request->part_no)){
            if($request->part_no!=''){
                $data = $data->where('part_no',$request->part_no);
            }
        }
        if(isset($request->model)){
            if($request->model!=''){
                $data = $data->where('model',$request->model);
            }
        }
        if(isset($request->style)){
            if($request->style!=''){
                $data = $data->where('c_style',$request->style);
            }
        }
        if(isset($request->size)){
            if($request->size!=''){
                $data = $data->where('c_size',$request->size);
            }
        }
        $data = $data->orderBy('mes_defect.seq','ASC')->paginate(15);
        return response()->json($data);
    }
    public function wipinfo(Request $request){
        $data = DB::table('mes_m_wip')
                ->join('mes_m_prod_plan','mes_m_wip.wo_no','=','mes_m_prod_plan.wo_no')
                ->select('mes_m_wip.*','mes_m_prod_plan.model','mes_m_prod_plan.c_style','mes_m_prod_plan.c_size')->where("wip_qty",'>','0');
        if(isset($request->operation)){
            if($request->operation!=''){
                $data = $data->where('location',$request->operation);
            }
        }
        if(isset($request->prod_line)){
            if($request->prod_line!=''){
                $data = $data->where('mes_m_wip.prod_line',$request->prod_line);
            }
        }
        if(isset($request->part_no)){
            if($request->part_no!=''){
                $data = $data->where('mes_m_wip.part_no',$request->part_no);
            }
        }
        if(isset($request->model)){
            if($request->model!=''){
                $data = $data->where('model',$request->model);
            }
        }
        if(isset($request->style)){
            if($request->style!=''){
                $data = $data->where('c_style',$request->style);
            }
        }
        if(isset($request->size)){
            if($request->size!=''){
                $data = $data->where('c_size',$request->size);
            }
        }
        $data = $data->orderBy('mes_m_wip.seq','ASC')->paginate(15);
        return response()->json($data);
    }
    public function wipinfo2(Request $request){
        $data = DB::table('mes_m_wip')
                ->join('mes_m_prod_plan','mes_m_wip.wo_no','=','mes_m_prod_plan.wo_no')
                ->leftjoin('mes_m_bom','mes_m_bom.bom_components','=',DB::raw('CONCAT(mes_m_prod_plan.c_style,"-",mes_m_prod_plan.c_size,"-",mes_m_prod_plan.part_no)'))
                ->select('mes_m_wip.*','mes_m_prod_plan.e_op','mes_m_prod_plan.order_no','mes_m_prod_plan.model','mes_m_prod_plan.c_style','mes_m_prod_plan.c_size')
                ->whereRaw('mes_m_wip.location = mes_m_prod_plan.e_op')
                ->groupBy('mes_m_prod_plan.order_no')
                ->groupBy('mes_m_wip.location')
                ->where('wip_qty','>','0');
        if(isset($request->part_no)){
            if($request->part_no!=''){
                $data = $data->where('mes_m_bom.bom_parent','like','%'.$request->part_no);
            }
        }
        if(isset($request->model)){
            if($request->model!=''){
                $data = $data->where('model',$request->model);
            }
        }
        if(isset($request->style)){
            if($request->style!=''){
                $data = $data->where('c_style',$request->style);
            }
        }
        if(isset($request->size)){
            if($request->size!=''){
                $data = $data->where('c_size',$request->size);
            }
        }
        $data = $data->orderBy('mes_m_wip.seq','ASC')->paginate(15);
        return response()->json($data);
    }
    public function getDataUser($id){
        $data = MesUser::where('emp_id',$id)->first();
        return response()->json($data);
    }
    public function defectinfos(){
        $data = M012_DefectInfo::all();
        return response()->json($data);
    }
    public function adddefectinfo(Request $request){
        $defect = M012_DefectInfo::create([
            'part_no'=>$request->part_no,
            'c_op'=>$request->c_op,
            'defect_desc'=>$request->defect_desc,
            'create_by'=>$request->create_by,
        ]);
        return response()->json(['id'=>$defect->defect_id]);
    }
    public function editdefectinfo(Request $request){
        M012_DefectInfo::find($request->defect_id)->update([
            'part_no'=>$request->part_no,
            'c_op'=>$request->c_op,
            'defect_desc'=>$request->defect_desc,
            'update_by'=>$request->update_by,
        ]);
        return response('success',200);
    }

}
