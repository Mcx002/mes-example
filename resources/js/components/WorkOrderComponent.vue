<template>
    <div class="card-body" style="overflow-x:scroll">
        <div class="loading" v-show="loading"><div class="loading-wrap"><i class="fa fa-spinner spinner-loading mr-1"></i> Loading</div></div>
        <div class="form-group" v-if="addenable">
            <div id="modalComponent" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ editstat?'Edit':'Create' }} {{ data.title }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form class="form-material" @submit.prevent="actData">
                            <div class="modal-body">
                                <div class="loading" v-show="loadingform"><div class="loading-wrap"><i class="fa fa-spinner spinner-loading mr-1"></i> Loading</div></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order_no" class="control-label">Order Number</label>
                                            <input type="text" class="form-control" id="order_no" v-model="form.order_no" />
                                        </div>
                                        <div class="form-group">
                                            <label for="part-no" class="control-label">BOM Component:</label>
                                            <select required class="form-control" id="part-no" v-model="bomselected" @change="getDataFormBom">
                                                <option v-for="item in bom_parent" :value="item.id">{{ item.id }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="assy_date" class="control-label">Assy Date:</label>
                                            <input required type="date" class="form-control" @input="change" id="assy_date" v-model="form.assy_date" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="wo_type" class="control-label">Wo Types:</label>
                                            <select required class="form-control" id="wo_type" v-model="form.wo_type">
                                                <option value="M">Main</option>
                                                <option value="D">Defect</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="assy_line" class="control-label">Assy Line:</label>
                                            <select required class="form-control" id="assy_line" v-model="form.assy_line">
                                                <option v-for="item in lines" :value="item.line_code">{{item.line_desc}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="o_qty" class="control-label">Order Quantity:</label>
                                            <input type="number" class="form-control" @input="change" id="o_qty" v-model="form.o_qty" />
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="form-group" v-for="item in data.form" v-show="item.type!='none'">
                                    <label :for="item.id" class="control-label">{{ item.title }}:</label>
                                    <input :required="item.type!='none'" :type="item.type" class="form-control" :id="item.id" :name="item.id" v-model="form[item.id]">
                                </div>-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" :class="[editstat?'btn-danger':'btn-primary']" class="btn waves-effect waves-light">{{ editstat?'Save Changes':'Create' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <span data-toggle="modal" data-target="#modalComponent" class="btn btn-success" @click="addClickButton"><i class="fa fa-plus"></i> Add {{ data.title }}</span>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <label class="control-label" for="assystart">Assy date : </label>
                <input type="date" class="form-control" id="assystart" v-model="assystart" />
            </div>
            <div class="col-md-3">
                <label class="control-label" for="assyend">~ </label>
                <input type="date" class="form-control" id="assyend" v-model="assyend" :min="assystart" :disabled="assystart==''"  />
            </div>
            <div class="col-md-3">
                <label class="control-label" for="cbbpart_no">Part No : </label>
                <select id="cbbpart_no" v-model="partselected" class="form-control" >
                    <option value="">All</option>
                    <option v-for="item in parts" :value="item.part_no">{{ item.part_no }}</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Action</label>
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-success waves-effect waves-light w-100" @click="assyrange">Show</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn waves-effect waves-light btn-success w-100" @click="partselected='';assystart='';assyend=''">Reset</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive mb-3" v-if="showdata">
            <table id="table23" class="display mb-0 nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th v-for="item in data.table">{{ item.title }}</th>
                    </tr>
                </thead>
                <tfoot v-show="table.length>7">
                    <tr>
                        <th>No.</th>
                        <th v-for="item in data.table">{{ item.title }}</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr v-for="(item,i) in datapage.data" :style="[item[data.table_primary]==highlighted_id?{backgroundColor:'#edf7ff'}:{}]">
                        <td>{{ datapage.from+i }}</td>
                        <td v-for="td in data.table">{{ checktype(item,td) }}</td>
                    </tr>
                    <tr v-show="datapage.data.length==0">
                        <td :colspan="data.table.length+1"><center>No data uploaded yet</center></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card text-muted text-center mt-5 mb-3" v-else>Please click button show</div>
        <v-paginator :data="datapage" @pagination-change-page="getDataPagging"></v-paginator>
    </div>
</template>
<script>
export default{
    data(){
        return{
            data:{ 
                title:'Work Order',
                geturl:'/workorders',
                addurl:'/addworkorder',
                editurl:'/editworkorder',
                table_primary:'seq',
                created_by:{
                    bool:false
                },
                updated_by:{
                    bool:false
                },
                table:[
                    {
                        title:'Order No',
                        id:'order_no'
                    },
                    {
                        title:'WO Number',
                        id:'wo_no'
                    },
                    {
                        title:'Date Create',
                        id:'d_create'
                    },
                    {
                        title:'Date Start',
                        id:'d_start'
                    },
                    {
                        title:'Date End',
                        id:'d_end'
                    },
                    {
                        title:'Model',
                        id:'model'
                    },
                    {
                        title:'C Style',
                        id:'c_style'
                    },
                    {
                        title:'C Size',
                        id:'c_size'
                    },
                    {
                        title:'Part No',
                        id:'part_no'
                    },
                    {
                        title:'Assy Date',
                        id:'assy_date'
                    },
                    {
                        title:'Order No',
                        id:'order_no'
                    },
                    {
                        title:'WO Type',
                        id:'wo_type'
                    },
                    {
                        title:'Assy Line',
                        id:'assy_line'
                    },
                    {
                        title:'Start OP',
                        id:'s_op'
                    },
                    {
                        title:'End OP',
                        id:'e_op'
                    },
                    {
                        title:'O QTY',
                        id:'o_qty'
                    },
                    {
                        title:'P QTY',
                        id:'p_qty'
                    },
                    {
                        title:'D QTY',
                        id:'d_qty'
                    },
                    {
                        title:'Created By',
                        id:'create_by'
                    },
                    {
                        title:'Release Date',
                        id:'release_date'
                    },
                    {
                        title:'Status',
                        id:'status'
                    }
                ],
            },
            datapage:{
                data:[]
            },
            datawo:[],
            table:[],
            dataassyrange:[],
            bom:[],
            form:{
                order_no:'',
                model:'',
                c_style:'',
                c_size:'',
                assy_date:'',
                prod_line:'',
                wo_type:'',
                assy_line:'',
                o_qty:'50',
                p_qty:'0',
                d_qty:'0',
                status:'R',
                remarks:'',
            },
            bom_components:[],
            bom_childs:[],
            bomselected:'',
            lines:[],
            boms:[],
            bom_parent:[],
            forms:[],
            routings:[],
            leadtimes:[],
            datamodels:[],
            models:[],
            styles:[],
            sizes:[],
            loading:false,
            highlighted_id:null,
            editstat:false,
            loadingform:false,
            showdata:false,
            assystart:'',
            assyend:'',
            pt000:'',
            pt100:'',
            pt500:'',
            pt800:'',
            parts:[],
            partselected:'',
            addenable:false,
        }
    },
    computed:{
        userId:()=>{
            return document.head.querySelector("meta[name='user-id']").content
        },
        baseUrl:()=>{
            return document.head.querySelector('meta[name="api-base-url"]').content
        }
    },
    created(){
        

    },
    mounted(){
        this.getDataLeadTime()
        this.getDataRouting()
        this.getData()
        this.getDataLine()
        this.getDataModel()
        this.getDataSize()
        this.getDataBOM()
        this.getPartNo()
        this.getDataUser()
        // this.getDataPagging()
    }, 
    methods:{
        formDeclaration(){
            this.form.order_no=''
            this.form.model=''
            this.form.c_style=''
            this.form.c_size=''
            this.form.assy_date=''
            this.form.prod_line=''
            this.form.wo_type=''
            this.form.assy_line=''
            this.form.o_qty='50'
            this.form.p_qty='0'
            this.form.d_qty='0'
            this.form.status='R'
            this.form.remarks=''
        },
        getDataUser(){
            console.log(this.userId)
            axios.get('/user/'+this.userId)
                .then(({data})=>{
                    console.log(data)

                    if(data.level=='1'||data.level=='4'){
                        this.addenable=true
                    }else{
                        this.addenable=false
                    }
                })
        },
        getPartNo(){
            axios.get('/parts')
                .then(({data})=>{
                    this.parts = data
                })
        },
        getDataRouting(){
            axios.get('/routings')
                .then(response=>{
                    this.routings = response.data
                })
        },
        getDataLine(){
            axios.get('/lines')
                .then(response=>{
                    this.lines = response.data
                }).catch(response=>{
                    // this.getDataLine()
                })
        },
        getDataLeadTime(){
            axios.get('/leadtimes')
                .then(response=>{
                    this.leadtimes = response.data
                })
        },
        getData(){
            this.loading = true
            axios.get(this.data.geturl)
                .then(response=>{
                    this.table = response.data
                    this.datawo = response.data
                    this.loading = false
                })
        },
        getDataPagging(page,startDate='null',endDate='null',part_no='null'){
            this.loading = true
            if (typeof page === 'undefined') {
                page = 1
            }
            axios.get("/datawo/"+startDate+"/"+endDate+"/"+part_no+"?page="+page)
                .then(({data})=>{
                    this.datapage = data
                    this.loading = false
                })
        },
        getDataBOM(){
            axios.get('/boms')
                .then(({data})=>{
                    this.boms = data
                    this.bom_parent = _.chain(data).groupBy('bom_parent').map((item,i)=>{
                        return {
                            id:i
                        }
                    }).value().filter(item=>item.id!=='null')
                })
        },
        getDataFormBom(){
            var splitbom = this.bomselected.split('-')
            this.form.c_size = splitbom[2]
            this.form.c_style = splitbom[0]+'-'+splitbom[1]
            this.form.model = this.datamodels.find(item=>item.style===this.form.c_style).model
            axios.get('/getBOM/'+this.bomselected)
                .then(response=>{
                    this.bom = response.data
                    this.bom_components = []
                    this.bom_components.push({'id':this.bomselected})
                    response.data.forEach(item=>{
                        this.bom_components.push({'id':item.bom_parent})
                        this.bom_childs.push({'id':item.bom_parent})
                    })
                    this.bom_childs.forEach(item=>{
                        this.getDataFormBomChild(item.id)
                    })
                })
        },
        getDataFormBomChild(val){
            axios.get('/getBOM/'+val)
                .then(response=>{
                    response.data.forEach(item=>{
                        this.bom_components.push({'id':item.bom_parent})
                    })
                    this.leadtimes.forEach((item,i)=>{
                        if(this.bom_components.length>0){
                            this.bom_components.forEach((bitem,b)=>{
                                if(bitem.id==item.component_id){
                                    this.bom_components[b]['lead_time'] = item.lead_time
                                    this.bom_components[b]['process_time'] = item.process_time
                                }
                            })
                        }
                    })
                    this.bom_components.sort((a, b) => (a.id > b.id) ? 1 : -1 )
                    this.nextWONO()
                })
        },
        getDataSize(){
            axios.get('/sizes')
                .then(response=>{
                    this.sizes = response.data
                })
        },
        getDataModel(){
            axios.get('/models')
                .then(response=>{
                    this.datamodels = response.data
                    this.models = _.chain(response.data).groupBy('model').map((v,i)=>{
                        return {
                            model:i
                        }
                    }).value()
                })
        },
        onModelSelected(){
            this.styles = []
            this.datamodels.forEach((item,i)=>{
                if(item.model==this.form.model){
                    this.styles.push({'style':''+item.style})
                }
            })
        },
        nextWONO(){
            var lastassyid = 'WONK200528101000'
            var seq = 0
            if(this.table.length>0){
                seq = this.table[this.table.length-1].seq
            }
            this.bom_components.forEach((item,i)=>{
                var regexId = lastassyid.match(/[a-z]+|[^a-z]+/gi)
                if(isNaN(regexId[regexId.length-1])){
                    lastassyid = ''
                }else{
                    var lengthlastid = regexId[regexId.length-1].length
                    var string = parseInt(regexId[regexId.length-1]) + 1
                    
                    string = ""+string
                    while(string.length<lengthlastid){
                        string = "0" + string
                    }
                    regexId[regexId.length-1] = ""+string
                    lastassyid =regexId.join('')
                }
                seq = seq + 1
                this.bom_components[i]['seq'] = seq
                this.bom_components[i]['wo_no'] = lastassyid
            })
        },
        change(){
            console.log(this.form)
        },
        actData(){
            // console.log(this.form)
            if(this.editstat){
                this.editData()
            }else{
                this.addData()
            }
        },
        formatDateTime(val){
            var month = (val.getMonth()+1)+"";
            var date = val.getDate()+"";
            if(month.length==1){
                month = "0"+month
            }
            if(date.length==1){
                date = "0"+date
            }
            return val.getFullYear()+"-"+month+"-"+date+" 00:00:00"
        },
        addData(){
            this.bom_components.forEach((item,i)=>{
                var basic = new Date(this.form.assy_date)
                var d_start = new Date();
                var d_end = new Date();
                d_start.setDate(basic.getDate()-item.lead_time)
                d_end.setDate(basic.getDate()-item.lead_time+(item.process_time-1))
                var bomslice = item.id.split('-')
                var op = []
                this.routings.forEach((item,i)=>{
                    if(item.part_no==bomslice[bomslice.length-1]){
                        op.push(item.c_op)
                    }
                })
                this.loadingform = true
                var postform = []
                
                postform['seq']=item.seq
                // postform['wo_no']='WO'+item.order_no+item.seq
                postform['d_start']=this.formatDateTime(d_start)
                postform['d_end']=this.formatDateTime(d_end)
                postform['part_no']=bomslice[bomslice.length-1]
                postform['s_op']=op[0]
                postform['e_op']=op[op.length-1]
                postform['create_by']=this.userId
                postform['c_style'] = bomslice[0]+'-'+bomslice[1]
                postform['model'] = this.datamodels.find(item=>item.style===bomslice[0]+'-'+bomslice[1]).model
                postform['c_size'] = bomslice[2]

                this.forms.push(postform)

            })
            console.log(this.forms)
            this.forms.forEach((item,i)=>{
                
                item['order_no'] = this.form.order_no
                item['assy_date'] = this.form.assy_date
                item['prod_line'] = this.form.prod_line
                item['wo_type'] = this.form.wo_type
                item['assy_line'] = this.form.assy_line
                item['o_qty'] = this.form.o_qty
                item['p_qty'] = this.form.p_qty
                item['d_qty'] = this.form.d_qty
                item['status'] = this.form.status
                item['remarks'] = this.form.remarks
                item['wo_no'] = 'WO'+this.form.order_no+item.seq
                console.log(item)
                axios.post(this.data.addurl,{...item})
                    .then(response=>{
                        if(this.forms.length-1 == i){
                            this.formDeclaration()
                            this.highlighted_id = response.data.id
                            swal("Success","Data has been added","success");
                            this.getData()
                            this.loadingform = false
                            $('#modalComponent').modal("hide")
                        }
                    }).catch(error=>{
                        console.log(error)
                        if(this.bom_components.length-1 == i){
                            this.loadingform = false
                            swal("Failed","Failed to add the data","error");
                        }
                    })
            })
        },
        editButtonClick(item){
            this.addClickButton()
            this.editstat = true
            if(this.data.updated_by.bool&&this.editstat){
                this.form[this.data.updated_by.field] = this.userId
            }
            this.data.form.forEach(data=>{
                this.form[data.id] = item[data.id]
            })
            this.form[this.data.created_by.field] = item[this.data.created_by.field]
        },
        addClickButton(){
            this.editstat = false
            this.formDeclaration()
        },
        editData(){
            this.loadingform = true
            axios.post(this.data.editurl,this.form)
                .then(response=>{
                    this.highlighted_id = this.form.id
                    this.formDeclaration()
                    swal("Success","Data has been updated","success");
                    this.getData()
                    this.loadingform = false
                    $('#modalComponent').modal("hide")
                }).catch(error=>{
                    console.log(error)
                    this.loadingform = false
                    swal("Failed","Failed to update the data","error");
                })
        },
        checktype(item,td){
            if(td.hasOwnProperty('type')){
                if(td.type=="date"){
                    var date = new Date(item[td.id])
                    var result = date.toLocaleDateString()
                    return result
                }else{
                    return 'lol'
                }
            }else{
                return item[td.id]
            }   
        },
        assyrange(){
            var startDate = ''
            var endDate = ''
            var part_no = ''
            if(this.assystart==''){
                startDate = 'null'
                endDate = 'null'
            }else{
                var startDate = this.assystart
                if(this.assyend==''){
                    var endDate = this.assystart
                }else{
                    var endDate = this.assyend
                }
            }
            if(this.partselected==''){
                part_no = 'null'
            }else{
                part_no = this.partselected
            }
            this.getDataPagging('1',startDate,endDate,part_no)
            this.showdata = true
            // var result = this.datawo.filter(a=>{
            //     var date = new Date(a.assy_date)
            //     if(this.assystart!=''&&this.partselected==''){
            //         return date >= startDate && date <= endDate 
            //     }else if(this.assystart==''&&this.partselected!=''){
            //         return a.part_no == this.partselected
            //     }else if(this.assystart!=''&&this.partselected!=''){
            //         return date >= startDate && date <= endDate && a.part_no == this.partselected
            //     }else{
            //         return this.datawo.indexOf(a) != -1
            //     }
            // })
            // this.table = result
            // this.dataassyrange = result
        },
        ptchange(){
            console.log(this.partselected)
        }
    }
}

</script>