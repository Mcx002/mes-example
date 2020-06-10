<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data Work Order
                </div>
                <div class="card-body">
                    <div class="loading" v-show="loading"><div class="loading-wrap"><i class="fa fa-spinner spinner-loading mr-1"></i> Loading</div></div>
                    <div class="form-group">
                        <div id="addprocessmodal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ editstat?'Edit':'Create' }} Work Order</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <form class="form-material" @submit.prevent="actDataProcess">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="work-order-id" class="control-label">Work Order ID:</label>
                                                        <input required type="text" class="form-control" :readonly="editstat" :class="[workOrderIdFailure?'is-invalid':'']" @change="checkIdProcess" id="work-order-id" v-model="form.id">
                                                        <span class="invalid-feedback" role="alert" v-show="workOrderIdFailure">
                                                            <strong>Process ID has been used</strong>
                                                        </span>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="work-order-date" class="control-label">Work Order Date:</label>
                                                            <input required type="date" class="form-control" @change="dateTimeJoin" id="work-order-date" v-model="wo_date">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="work-order-time" class="control-label">Time:</label>
                                                            <input required type="time" class="form-control" id="work-order-time" @change="dateTimeJoin" v-model="wo_time">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="work-order-qty" class="control-label">Work Order QTY:</label>
                                                        <input required type="number" class="form-control" id="work-order-qty" v-model="form.qty">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="serial-no-min" class="control-label">Serial No Min:</label>
                                                        <input required type="text" class="form-control" id="serial-no-min" v-model="form.serial_no_min">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="serial-no-max" class="control-label">Serial No Max:</label>
                                                        <input required type="text" class="form-control" id="serial-no-max" v-model="form.serial_no_max">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="assy-id" class="control-label">Assembly ID:</label>
                                                        <select required class="form-control" id="assy-id" v-model="form.assy_id">
                                                            <option v-for="item in assemblies" :value="item.assy_id">{{item.assy_id}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sales-order-id" class="control-label">Sales Order ID:</label>
                                                        <input required type="text" class="form-control" id="sales-order-id" v-model="form.sales_order_id">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="process-id" class="control-label">Process ID:</label>
                                                        <select required class="form-control" id="process-id" v-model="form.process_id">
                                                            <option v-for="item in processes" :value="item.process_id">{{item.process_id}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bom-id" class="control-label">BOM ID:</label>
                                                        <input required type="text" class="form-control" id="bom-id" v-model="form.bom_id">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bom-rev" class="control-label">BOM Rev:</label>
                                                        <input required type="text" class="form-control" id="bom-rev" v-model="form.bom_rev">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                            <button type="submit" :class="[editstat?'btn-danger':'btn-primary']" class="btn waves-effect waves-light" :disabled="workOrderIdFailure">{{ editstat?'Save Changes':'Create' }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <span data-toggle="modal" data-target="#addprocessmodal" class="btn btn-success" @click="form.id = nextid;editstat=false"><i class="fa fa-plus"></i> Add Work Order</span>
                    </div>
                    <table class="table hover-table">
                        <thead>
                            <th>No.</th>
                            <th>Work Order ID</th>
                            <th>Work Order Date</th>
                            <th>Work Order QTY</th>
                            <!--<th>Serial No Min</th>
                            <th>Serial No Max</th>-->
                            <th>Assembly ID</th>
                            <!--<th>Sales Order ID</th>-->
                            <th>Process ID</th>
                            <!--<th>BOM ID</th>
                            <th>BOM REV</th>-->
                            <th></th>
                        </thead>
                        <tbody>
                            <tr v-for="(item,i) in workorders" :style="[item.work_order_id==highlighted_id?{backgroundColor:'#edf7ff'}:{}]">
                                <td>{{ i+1 }}</td>
                                <td>{{ item.work_order_id }}</td>
                                <td>{{ item.work_order_date }}</td>
                                <td>{{ item.work_order_qty }}</td>
                                <!--<td>{{item.serial_no_min}}</td>
                                <td>{{item.serial_no_max}}</td>-->
                                <td>{{item.assy_id}}</td>
                                <!--<td>{{item.sales_order_id}}</td>-->
                                <td>{{item.process_id}}</td>
                                <!--<td>{{item.bom_id}}</td>
                                <td>{{item.bom_rev}}</td>-->
                                <td class="text-align-center"><a @click.prevent="editButtonClick(item)" data-toggle="modal" data-target="#addprocessmodal" class="btn btn-primary" style="color:white"><i class="fa fa-pencil"></i> Edit</a></td>
                            </tr>
                            <tr v-show="workorders.length==0">
                                <td colspan="7"><center>No data uploaded yet</center></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
let form = {
    id:'',
    date:'',
    qty:null,
    serial_no_min:'',
    serial_no_max:'',
    assy_id:'',
    sales_order_id:'',
    process_id:'',
    bom_id:'',
    bom_rev:''
}
export default{
    data(){
        return{
            loading:false,
            processes:[],
            assemblies:[],
            workorders:[],
            form:{        
                id:'',
                date:'',
                qty:null,
                serial_no_min:'',
                serial_no_max:'',
                assy_id:'',
                sales_order_id:'',
                process_id:'',
                bom_id:'',
                bom_rev:''
            },
            wo_date:'',
            wo_time:'',
            highlighted_id:null,
            nextid:'',
            editstat:false,
            workOrderIdFailure:false
        }
    },
    mounted(){
        this.getDataAssy()
        this.getDataProcess()
        this.getDataWorkOrder()
    },
    methods:{
        getDataProcess(){
            axios.get('/processes')
                .then(response=>{
                    this.processes = response.data
                })
        },
        getDataAssy(){
            axios.get('/assemblies')
                .then(response=>{
                    this.assemblies = response.data
                })

        },
        getDataWorkOrder(){
            this.loading = true
            axios.get('/workorders')
                .then(response=>{
                    this.workorders = response.data
                    this.loading = false
                    this.nextProcessId()
                })
        },
        nextProcessId(){
            if(this.workorders.length!=0){
                var lastprocessid = this.workorders[this.workorders.length-1].work_order_id
                var regexId = lastprocessid.match(/[a-z]+|[^a-z]+/gi)
                if(isNaN(regexId[regexId.length-1])){
                    this.form.id=''
                }else{
                    var lengthlastid = regexId[regexId.length-1].length
                    var string = parseInt(regexId[regexId.length-1]) + 1
                    string = ""+string
                    while(string.length<lengthlastid){
                        string = "0" + string
                    }
                    regexId[regexId.length-1] = ""+string
                    this.nextid=regexId.join('')
                }
            }else{
                this.nextid='WO0001'
            }
        },
        actDataProcess(){
            if(this.editstat){
                this.editDataWorkOrder()
            }else{
                this.addDataWorkOrder()
            }
            $('#addprocessmodal').modal("hide")
        },
        checkIdProcess(){
            console.log('asd');
            var count = 0;
            this.workorders.forEach(item=>{
                if(item.work_order_id==this.form.id){
                    count += 1
                }
            })
            if(count>0){
                this.workOrderIdFailure = true
            }else{
                this.workOrderIdFailure = false
            }
        },
        addDataWorkOrder(){
            axios.post('/addworkorder',this.form)
                .then(response=>{
                    this.form = form
                    this.highlighted_id = response.data.id
                    swal("Success","Data has been added","success");
                    this.getDataWorkOrder()
                }).catch(error=>{
                    console.log(error)
                    swal("Failed","Failed to add a data","error");
                })
        },
        editButtonClick(item){
            this.editstat = true,
            this.form.id=item.work_order_id,
            this.form.date=item.work_order_date,
            this.form.qty=item.work_order_qty,
            this.form.serial_no_min=item.serial_no_min,
            this.form.serial_no_max=item.serial_no_max,
            this.form.assy_id=item.assy_id,
            this.form.sales_order_id=item.sales_order_id,
            this.form.process_id=item.process_id,
            this.form.bom_id=item.bom_id,
            this.form.bom_rev=item.bom_rev
        },
        editDataWorkOrder(){
            axios.post('/editworkorder',this.form)
                .then(response=>{
                    this.highlighted_id = this.form.id
                    this.form = form
                    swal("Success","Data has been updated","success");
                    this.getDataWorkOrder()
                }).catch(error=>{
                    console.log(error)
                    swal("Failed","Failed to update the data","error");
                })
        },
        dateTimeJoin(){
            this.form.date = this.wo_date+" "+this.wo_time+":00"
        }
    }
}

</script>