<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data {{ data.title }}
                </div>
                <div class="card-body" style="overflow-x:scroll">
                    <div class="loading" v-show="loading"><div class="loading-wrap"><i class="fa fa-spinner spinner-loading mr-1"></i> Loading</div></div>
                    <div class="form-group">
                        <div id="modalComponent" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-custom">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ editstat?'Edit':'Create' }} {{ data.title }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <form class="form-material" @submit.prevent="actData">
                                        <div class="modal-body">
                                            <div class="loading" v-show="loadingform"><div class="loading-wrap"><i class="fa fa-spinner spinner-loading mr-1"></i> Loading</div></div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="order_no" class="control-label">Order Number</label>
                                                        <input type="text" class="form-control" id="order_no" v-model="form.order_no" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="part-no" class="control-label">Part No:</label>
                                                        <select required class="form-control" id="part-no" v-model="part_no" @input="getDataFormBom">
                                                            <option value="000">000 - Finished shoes</option>
                                                            <option value="100">100 - Upper</option>
                                                            <option value="500">500 - Bottom</option>
                                                            <option value="800">800 - Insole</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="assy_date" class="control-label">Assy Date:</label>
                                                        <input required type="date" class="form-control" @input="change" id="assy_date" v-model="form.assy_date" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
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
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="model" class="control-label">Model:</label>
                                                        <select required class="form-control" id="model" @change="onModelSelected" v-model="form.model">
                                                            <option v-for="item in models">{{item.model}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="c_style" class="control-label">C Style:</label>
                                                        <select required class="form-control" id="c_style" :disabled="form.model==''" v-model="form.c_style">
                                                            <option v-for="item in styles">{{item.style}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="c_size" class="control-label">C Size:</label>
                                                        <select required class="form-control" id="c_size" v-model="form.c_size">
                                                            <option v-for="item in sizes" :value="item.size_id">{{ item.desc }}</option>
                                                        </select>
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
                    
                  <div class="table-responsive m-t-40">
                        <table id="table23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th v-for="item in data.table">{{ item.title }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot v-show="table.length>7">
                                <tr>
                                    <th>No.</th>
                                    <th v-for="item in data.table">{{ item.title }}</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(item,i) in table" :style="[item[data.table_primary]==highlighted_id?{backgroundColor:'#edf7ff'}:{}]">
                                    <td>{{ i+1 }}</td>
                                    <td v-for="td in data.table">{{ checktype(item,td) }}</td>
                                    <td class="text-align-center"><a @click.prevent="editButtonClick(item)" data-toggle="modal" data-target="#modalComponent" class="btn btn-primary" style="color:white"><i class="fa fa-pencil"></i> Edit</a></td>
                                </tr>
                                <tr v-show="table.length==0">
                                    <td :colspan="data.table.length+2"><center>No data uploaded yet</center></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
            table:[],
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
            part_no:'',
            lines:[],
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
        }
    },
    computed:{
        userId:()=>{
            return document.head.querySelector("meta[name='user-id']").content
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
                    this.getDataLine()
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
                    this.loading = false
                })
        },
        getDataFormBom(val){
            var value = val.target.options[val.target.selectedIndex].value
            axios.get('/getBOM/123456-100-05M-'+value)
                .then(response=>{
                    this.bom = response.data
                    this.bom_components = []
                    this.bom_components.push({'id':'123456-100-05M-'+value})
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

                this.forms.push(postform)

            })
            console.log(this.forms)
            this.forms.forEach((item,i)=>{
                
                item['order_no'] = this.form.order_no
                item['model'] = this.form.model
                item['c_style'] = this.form.c_style
                item['c_size'] = this.form.c_size
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
        }
    }
}

</script>