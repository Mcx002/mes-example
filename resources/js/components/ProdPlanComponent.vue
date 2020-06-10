<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data Production Plan
                </div>
                <div class="card-body">
                    <div class="loading" v-show="loading"><div class="loading-wrap"><i class="fa fa-spinner spinner-loading mr-1"></i> Loading</div></div>
                    <div class="form-group">
                        <div id="addprodplanmodal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-custom">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ editstat?'Edit':'Create' }} Production Plan</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <form class="form-material" @submit.prevent="actDataProdPlan">
                                        <div class="modal-body">
                                            <div class="loading" v-show="loadingform"><div class="loading-wrap"><i class="fa fa-spinner spinner-loading mr-1"></i> Loading</div></div>
                                            
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="work-order-id" class="control-label">Work Order Number:</label>
                                                        <input required type="text" class="form-control" :readonly="editstat" :class="[ProdPlanIdFailure?'is-invalid':'']" @change="checkWorkOrderNumber" id="work-order-id" v-model="form.wo_number">
                                                        <span class="invalid-feedback" role="alert" v-show="ProdPlanIdFailure">
                                                            <strong>Work Order Number has been used</strong>
                                                        </span>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="d_create_date" class="control-label">Date Create:</label>
                                                            <input required type="date" class="form-control" @change="d_create" id="d_create_date" v-model="datecontrol.d_create_date">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="d_create_time" class="control-label">Time:</label>
                                                            <input required type="time" class="form-control" id="d_create_time" @change="d_create" v-model="datecontrol.d_create_time">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="d_start_date" class="control-label">Date Start:</label>
                                                            <input required type="date" :min="datecontrol.d_min_start_date" class="form-control" @change="d_start" id="d_start_date" v-model="datecontrol.d_start_date">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="d_start_time" class="control-label">Time:</label>
                                                            <input required type="time" class="form-control" id="d_start_time" @change="d_start" v-model="datecontrol.d_start_time">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="d_end_date" class="control-label">Date End:</label>
                                                            <input required type="date" :min="datecontrol.d_min_end_date" class="form-control" @change="d_end" id="d_end_date" v-model="datecontrol.d_end_date">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="d_end_time" class="control-label">Time:</label>
                                                            <input required type="time" class="form-control" id="d_end_time" @change="d_end" v-model="datecontrol.d_end_time">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="c-style" class="control-label">C Style:</label>
                                                        <input required type="text" class="form-control" id="c-style" v-model="form.c_style">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="assy-date" class="control-label">Assy Date:</label>
                                                            <input required type="date" class="form-control" @change="assy_datetime" id="assy-date" v-model="datecontrol.assy_date">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="assy-time" class="control-label">Time:</label>
                                                            <input required type="time" class="form-control" id="assy-time" @change="assy_datetime" v-model="datecontrol.assy_time">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="prod-line" class="control-label">Prod Line:</label>
                                                        <input required type="text" class="form-control" id="prod-line" v-model="form.prod_line">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="assy-line" class="control-label">Assy Line:</label>
                                                        <input required type="text" class="form-control" id="assy-line" v-model="form.assy_line">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="o-qty" class="control-label">O QTY:</label>
                                                        <input required type="text" class="form-control" id="o-qty" v-model="form.o_qty">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="e-qty" class="control-label">E QTY:</label>
                                                        <input required type="text" class="form-control" id="e-qty" v-model="form.e_qty">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="d-qty" class="control-label">D QTY:</label>
                                                        <input required type="text" class="form-control" id="d-qty" v-model="form.d_qty">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="line" class="control-label">Line:</label>
                                                        <input required type="text" class="form-control" id="line" v-model="form.line">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status" class="control-label">Status:</label>
                                                        <select require v-model="form.status" class="form-control" id="status">
                                                            <option value="R">Run</option>
                                                            <option value="C-END">Close-END</option>
                                                            <option value="C-FORCE">Close-FORCE</option>
                                                            <option value="P">Process</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                            <button type="submit" :class="[editstat?'btn-danger':'btn-primary']" class="btn waves-effect waves-light" :disabled="ProdPlanIdFailure">{{ editstat?'Save Changes':'Create' }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <span data-toggle="modal" data-target="#addprodplanmodal" class="btn btn-success" @click="addButtonClick"><i class="fa fa-plus"></i> Add Production Plan</span>
                    </div>
                    <table class="table hover-table">
                        <thead>
                            <th>No.</th>
                            <th>WO Number</th>
                            <th>Create</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Created By</th>
                            <th>Released By</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr v-for="(item,i) in prodplans" :style="[item.wo_number==highlighted_id?{backgroundColor:'#edf7ff'}:{}]">
                                <td>{{ i+1 }}</td>
                                <td>{{ item.wo_number }}</td>
                                <td>{{ item.d_create }}</td>
                                <td>{{ item.d_start }}</td>
                                <td>{{ item.d_end }}</td>
                                <td>{{ item.created_by }}</td>
                                <td>{{ item.released_by }}</td>
                                <td class="text-align-center"><a @click.prevent="editButtonClick(item)" data-toggle="modal" data-target="#addprodplanmodal" class="btn btn-primary" style="color:white"><i class="fa fa-pencil"></i> Edit</a></td>
                            </tr>
                            <tr v-show="prodplans.length==0">
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
export default{
    data(){
        return{
            loading:false,
            assemblies:[],
            prodplans:[],
            form:{        
                wo_number:'WO0001',
                d_create:'2020-05-05 12:00',
                d_start:'2020-05-06 12:00',
                d_end:'2020-05-07 12:00',
                c_style:'ads',
                assy_date:'2020-05-07 12:00',
                prod_line:'asd',
                assy_line:'asd',
                o_qty:'das',
                e_qty:'sad',
                d_qty:'sad',
                line:'dsa',
                created_by:'',
                released_by:'',
                status:'R'
            },
            highlighted_id:null,
            nextid:'',
            editstat:false,
            ProdPlanIdFailure:false,
            loadingform:false,
            datecontrol:{
                d_create_date:'',
                d_create_time:'',
                d_min_start_date:'',
                d_start_date:'',
                d_start_time:'',
                d_min_end_date:'',
                d_end_date:'',
                d_end_time:'',
                assy_date:'',
                assy_time:''
            }
        }
    },
    computed:{
        userId:()=>{
            return document.head.querySelector("meta[name='user-id']").content
        }
    },
    mounted(){
        this.getDataProdPlan()
        this.getDataAssy()
    },
    methods:{
        getDataAssy(){
            axios.get('/assemblies')
                .then(response=>{
                    this.assemblies = response.data
                })
        },
        getDataProdPlan(){
            this.loading = true
            axios.get('/prodplans')
                .then(response=>{
                    this.prodplans = response.data
                    this.loading = false
                    this.nextWorkOrderNumber()
                })

        },
        nextWorkOrderNumber(){
            if(this.prodplans.length!=0){
                var lastassyid = this.prodplans[this.prodplans.length-1].wo_number
                var regexId = lastassyid.match(/[a-z]+|[^a-z]+/gi)
                if(isNaN(regexId[regexId.length-1])){
                    this.form.wo_number=''
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
        actDataProdPlan(){
            if(this.editstat){
                this.editDataProdPlan()
            }else{
                this.addDataProdPlan()
            }
        },
        checkWorkOrderNumber(){
            var count = 0;
            this.prodplans.forEach(item=>{
                if(item.wo_number==this.form.wo_number){
                    count += 1
                }
            })
            if(count>0){
                this.ProdPlanIdFailure = true
            }else{
                this.ProdPlanIdFailure = false
            }
        },
        addDataProdPlan(){
            this.loadingform = true
            this.form.created_by = this.userId
            axios.post('/addprodplan',this.form)
                .then(response=>{
                    this.highlighted_id = response.data.id
                    swal("Success","Data has been added","success");
                    this.getDataProdPlan()
                    $('#addprodplanmodal').modal("hide")
                    this.loadingform = false
                }).catch(error=>{
                    console.log(error)
                    swal("Failed","Failed to add the data","error");
                    this.loadingform = false
                })
        },
        editButtonClick(item){
            this.editstat = true
            this.datecontrol.d_create_date = item.d_create.split(' ')[0]
            this.datecontrol.d_create_time = item.d_create.split(' ')[1].substring(0,5)
            this.d_create()
            this.datecontrol.d_start_date = item.d_start.split(' ')[0]
            this.datecontrol.d_start_time = item.d_start.split(' ')[1].substring(0,5)
            this.d_start()
            this.datecontrol.d_end_date = item.d_end.split(' ')[0]
            this.datecontrol.d_end_time = item.d_end.split(' ')[1].substring(0,5)
            this.d_end()
            this.datecontrol.assy_date = item.assy_date.split(' ')[0]
            this.datecontrol.assy_time = item.assy_date.split(' ')[1].substring(0,5)
            this.assy_datetime()
            this.form.wo_number=item.wo_number
            this.form.d_create=item.d_create
            this.form.d_start=item.d_start
            this.form.d_end=item.d_end
            this.form.c_style=item.c_style
            this.form.assy_date=item.assy_date
            this.form.prod_line=item.prod_line
            this.form.assy_line=item.assy_line
            this.form.o_qty=item.o_qty
            this.form.e_qty=item.e_qty
            this.form.d_qty=item.d_qty
            this.form.line=item.line
            this.form.created_by=item.created_by
            this.form.released_by=item.released_by
            this.form.status=item.status
        },
        editDataProdPlan(){
            this.loadingform = true
            axios.post('/editprodplan',this.form)
                .then(response=>{
                    this.highlighted_id = this.form.wo_number
                    swal("Success","Data has been updated","success");
                    this.getDataProdPlan()
                    this.loadingform = false
                    $('#addprodplanmodal').modal("hide")
                }).catch(error=>{
                    console.log(error)
                    swal("Failed","Failed to update the data","error");
                    this.loadingform = false
                })
        },
        d_create(){
            this.form.d_create = this.datecontrol.d_create_date+" "+this.datecontrol.d_create_time+":00"
            if(this.datecontrol.d_start_date!=""){
                var x = Date.parse(this.datecontrol.d_start_date);
                if(this.datecontrol.d_create_date!=""){
                    var y = Date.parse(this.datecontrol.d_create_date)
                    if(x<y){
                        this.form.d_start = ""
                        this.datecontrol.d_start_date = ""
                    }
                }
            }
            if(this.datecontrol.d_end_date!=""){
                var x = Date.parse(this.datecontrol.d_end_date);
                if(this.datecontrol.d_create_date!=""){
                    var y = Date.parse(this.datecontrol.d_create_date)
                    if(x<y){
                        this.form.d_end = ""
                        this.datecontrol.d_end_date = ""
                    }
                }
            }
            if(this.datecontrol.d_create_date!=""){
                var x = new Date(this.datecontrol.d_create_date)
                var result = new Date()
                result.setDate(x.getDate()+1)
                var year = result.getFullYear()+""
                var month = parseInt(result.getMonth()+1)+""
                var date = result.getDate()+""
                if(month.length==1){
                    month = "0"+month
                }
                if(date.length==1){
                    date = "0"+date
                }
                this.datecontrol.d_min_start_date = year+"-"+month+"-"+date
            }   
        },
        d_start(){
            this.form.d_start = this.datecontrol.d_start_date+" "+this.datecontrol.d_start_time+":00"
            if(this.datecontrol.d_end_date!=""){
                var x = Date.parse(this.datecontrol.d_end_date);
                if(this.datecontrol.d_start_date!=""){
                    var y = Date.parse(this.datecontrol.d_start_date)
                    if(x<y){
                        this.form.d_end = ""
                        this.datecontrol.d_end_date = ""
                    }
                }
            }
            if(this.datecontrol.d_start_date!=""){
                var x = new Date(this.datecontrol.d_start_date)
                var result = new Date()
                result.setDate(x.getDate()+1)
                var year = result.getFullYear()+""
                var month = parseInt(result.getMonth()+1)+""
                var date = result.getDate()+""
                if(month.length==1){
                    month = "0"+month
                }
                if(date.length==1){
                    date = "0"+date
                }
                this.datecontrol.d_min_end_date = year+"-"+month+"-"+date
            } 
        },
        d_end(){
            this.form.d_end = this.datecontrol.d_end_date+" "+this.datecontrol.d_end_time+":00"
        },
        assy_datetime(){
            this.form.assy_date = this.datecontrol.assy_date+" "+this.datecontrol.assy_time+":00"
        },
        addButtonClick(){
            this.resetforms()
            this.form.wo_number = this.nextid
            this.editstat=false
        },
        resetforms(){
            this.form.wo_number=''
            this.form.d_create=''
            this.form.d_start=''
            this.form.d_end=''
            this.form.c_style=''
            this.form.assy_date=''
            this.form.prod_line=''
            this.form.assy_line=''
            this.form.o_qty=''
            this.form.e_qty=''
            this.form.d_qty=''
            this.form.line=''
            this.form.created_by=''
            this.form.released_by=''
            this.form.status=''
            this.datecontrol.d_create_date=''
            this.datecontrol.d_create_time=''
            this.datecontrol.d_min_start_date=''
            this.datecontrol.d_start_date=''
            this.datecontrol.d_start_time=''
            this.datecontrol.d_min_end_date=''
            this.datecontrol.d_end_date=''
            this.datecontrol.d_end_time=''
            this.datecontrol.assy_date=''
            this.datecontrol.assy_time=''
        }
    }
}

</script>