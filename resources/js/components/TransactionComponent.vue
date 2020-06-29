<template>
    <div class="card-body" style="overflow-x:scroll">
        <div class="loading" v-show="loading"><div class="loading-wrap"><i class="fa fa-spinner spinner-loading mr-1"></i> Loading</div></div>
        <div class="">
            <div id="modalComponent" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ editstat?'Edit':'Create' }} {{ data.title }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form class="form-material" @submit.prevent="actData">
                            <div class="modal-body">
                                <div class="loading" v-show="loadingform"><div class="loading-wrap"><i class="fa fa-spinner spinner-loading mr-1"></i> Loading</div></div>
                                <!--<div class="form-group">
                                    <label for="part-no" class="control-label">Part No:</label>
                                    <select required class="form-control" id="part-no" v-model="form.part_no">
                                        <option v-for="item in parts" :value="item.part_no">{{item.part_no}}</option>
                                    </select>
                                </div>-->
                                <div class="form-group" v-for="item in data.form" v-show="item.type!='none'">
                                    <label :for="item.id" class="control-label">{{ item.title }}:</label>
                                    <input :type="item.type" class="form-control" v-if="item.type=='text'||item.type=='dateTime'||item.type=='number'" :id="item.id" :name="item.id" v-model="form[item.id]">
                                    <select required class="form-control" :id="item.id" :name="item.id" v-model="form[item.id]" v-else-if="item.type=='select'">
                                        <option v-for="select in item.selection" :value="select.id">{{select.title}}</option>
                                    </select>
                                    <input disabled type="text" class="form-control is-invalid" v-else-if="item.type=='selectnull'" :id="item.id" value="All Data Routing were registered - Please insert the new one">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" :class="[editstat?'btn-danger':'btn-primary']" class="btn waves-effect waves-light">{{ editstat?'Save Changes':'Create' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div id="childPartComponent" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" v-if="!parentstat">
                        <div class="modal-header">
                            <h4 class="modal-title">{{loadingchildform?'':'Proses Child'}} Component</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form class="form-material" @submit.prevent="actDataChild">
                            <div class="modal-body">
                                <div class="loading" v-show="loadingchildform||fistloadchildform"><div class="loading-wrap"><i class="fa fa-spinner spinner-loading mr-1"></i> Loading</div></div>
                                <!--<div class="form-group">
                                    <label for="part-no" class="control-label">Part No:</label>
                                    <select required class="form-control" id="part-no" v-model="form.part_no">
                                        <option v-for="item in parts" :value="item.part_no">{{item.part_no}}</option>
                                    </select>
                                </div>-->
                                
                                <div class="row" v-for="(form,f) in childFormData" v-show="!fistloadchildform">
                                    <div class="col" v-for="(item,i) in form" v-show="item.type!='none'">
                                        <div class="form-group" v-show="!(item.type=='select'&&item.selection.length==0)">
                                            <label :for="item.id+f" class="control-label">{{ item.title }}:</label>
                                            <input :type="item.type" :disabled="item.hasOwnProperty('disabled')" :max="item.hasOwnProperty('max')?item.max:''" :value="item.hasOwnProperty('value')?item.value:''" class="form-control" v-if="item.type=='text'||item.type=='dateTime'||item.type=='number'" :id="item.id+f" :name="item.id+f" v-model="childFormDataForSend[f][item.id]">
                                            <select :required="(!(item.type=='select'&&item.selection.length==0)&&childFormDataForSend[f][form[i+1].id]!='')||((item.id=='get_process'&&item.selection.length!=0)&&childFormDataForSend[f][form[i+2].id]!='')" class="form-control" :id="item.id+f" :name="item.id+f" v-model="childFormDataForSend[f][item.id]" v-else-if="item.type=='select'" @change="item.hasOwnProperty('onchange')&&item.onchange?onGetProcessChange($event,f):'';">
                                                <option v-for="select in item.selection" :value="select.id">{{select.id}}</option>
                                            </select>
                                            <input disabled type="text" class="form-control is-invalid" v-else-if="item.type=='selectnull'" :id="item.id" value="All Data Routing were registered - Please insert the new one">
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="form-group" v-for="item in childFormData.form" v-show="item.type!='none'">
                                    <label :for="item.id" class="control-label">{{ item.title }}:</label>
                                    <input :type="item.type" class="form-control" v-if="item.type=='text'||item.type=='dateTime'||item.type=='number'" :id="item.id" :name="item.id" v-model="form[item.id]">
                                    <select required class="form-control" :id="item.id" :name="item.id" v-model="form[item.id]" v-else-if="item.type=='select'">
                                        <option v-for="select in item.selection" :value="select.id">{{select.title}}</option>
                                    </select>
                                    <input disabled type="text" class="form-control is-invalid" v-else-if="item.type=='selectnull'" :id="item.id" value="All Data Routing were registered - Please insert the new one">
                                </div>-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn waves-effect waves-light btn-primary">Execute</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-content" v-else>
                        <div class="modal-header">
                            <h4 class="modal-title">{{loadingchildform?'':'Proses Parent'}} Component</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        
                        <form class="form-material" @submit.prevent="actDataChild">
                            <div class="modal-body">
                                <div class="loading" v-show="loadingchildform||fistloadchildform"><div class="loading-wrap"><i class="fa fa-spinner spinner-loading mr-1"></i> Loading</div></div>
                                <!--<div class="form-group">
                                    <label for="part-no" class="control-label">Part No:</label>
                                    <select required class="form-control" id="part-no" v-model="form.part_no">
                                        <option v-for="item in parts" :value="item.part_no">{{item.part_no}}</option>
                                    </select>
                                </div>-->
                                
                                <div class="row" v-for="(form,f) in childFormData" v-show="!fistloadchildform">
                                    <div class="col" v-for="(item,i) in form" v-show="item.type!='none'">
                                        <div class="form-group" v-show="!(item.type=='select'&&item.selection.length==0)">
                                            <label :for="item.id+f" class="control-label">{{ item.title }}:</label>
                                            <input :type="item.type" :disabled="item.hasOwnProperty('disabled')" :max="item.hasOwnProperty('max')?item.max:''" :value="item.hasOwnProperty('value')?item.value:''" class="form-control" v-if="item.type=='text'||item.type=='dateTime'||item.type=='number'" :id="item.id+f" :name="item.id+f" v-model="childFormDataForSend[f][item.id]">
                                            <select :required="(!(item.type=='select'&&item.selection.length==0)&&childFormDataForSend[f][form[i+1].id]!='')||((item.id=='get_process'&&item.selection.length!=0)&&childFormDataForSend[f][form[i+2].id]!='')" class="form-control" :id="item.id+f" :name="item.id+f" v-model="childFormDataForSend[f][item.id]" v-else-if="item.type=='select'" @change="item.hasOwnProperty('onchange')&&item.onchange?onGetProcessChange($event,f):'';">
                                                <option v-for="select in item.selection" :value="select.id">{{select.id}}</option>
                                            </select>
                                            <input disabled type="text" class="form-control is-invalid" v-else-if="item.type=='selectnull'" :id="item.id" value="All Data Routing were registered - Please insert the new one">
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="form-group" v-for="item in childFormData.form" v-show="item.type!='none'">
                                    <label :for="item.id" class="control-label">{{ item.title }}:</label>
                                    <input :type="item.type" class="form-control" v-if="item.type=='text'||item.type=='dateTime'||item.type=='number'" :id="item.id" :name="item.id" v-model="form[item.id]">
                                    <select required class="form-control" :id="item.id" :name="item.id" v-model="form[item.id]" v-else-if="item.type=='select'">
                                        <option v-for="select in item.selection" :value="select.id">{{select.title}}</option>
                                    </select>
                                    <input disabled type="text" class="form-control is-invalid" v-else-if="item.type=='selectnull'" :id="item.id" value="All Data Routing were registered - Please insert the new one">
                                </div>-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn waves-effect waves-light btn-primary">Execute</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-success w-100 waves-effect waves-light" type="button" @click="getData">Show</button>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-success w-100 waves-effect waves-light" type="button" @click="search.model='';search.style='';search.part_no='';search.assy_date=''">Reset</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="model">Model</label>
                    <select class="form-control" id="model" @change="onModelSelected" v-model="search.model">
                        <option v-for="item in models">{{item.model}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="style">Style</label>
                    <select class="form-control" :disabled="search.model==''" id="style" v-model="search.style">
                        <option v-for="item in styles">{{item.style}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="part">Part No</label>
                    <select class="form-control" id="part" v-model="search.part_no">
                        <option v-for="item in parts">{{item.part_no}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="assy_date">Assy Date</label>
                    <input type="date" id="assy_date" v-model="search.assy_date" class="form-control" />
                </div>
            </div>
        </div>
        <div v-if="showdata">
            <table class="table hover-table">
                <thead>
                    <th>No.</th>
                    <th v-for="item in data.table">{{ item.title }}</th>
                    <th></th>
                </thead>
                <tbody>
                    <tr v-for="(item,i) in table.data" :style="[item[data.table_primary]==highlighted_id?{backgroundColor:'#edf7ff'}:{}]">
                        <td>{{ table.from+i }}</td>
                        <td v-for="td in data.table">{{ checktype(item,td) }}</td>
                        <td class="text-align-center"><a @click.prevent="editButtonClick(item)" class="btn btn-sm btn-primary" style="color:white"><i class="fa fa-pencil"></i> Select</a></td>
                    </tr>
                    <tr v-show="table.data.length==0">
                        <td :colspan="data.table.length+2"><center>No data uploaded yet</center></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card text-muted text-center mt-5 mb-3" v-else>
            Please click button show
        </div>
        <v-paginator :data="table" @pagination-change-page="getData"></v-paginator>
    </div>
</template>
<script>
export default{
    props:{
            refresh:{
                type:Function
            }
    },
    data(){
        return{
            data:{
                title:'Complete Transaction',
                geturl:'/wostat',
                table_primary:'seq',
                table:[
                    {
                        title:'Order No',
                        id:'order_no'
                    },
                    {
                        title:'Work Order',
                        id:'wo_no'
                    },
                    {
                        title:'Model',
                        id:'model'
                    },
                    {
                        title:'Style',
                        id:'c_style'
                    },
                    {
                        title:'Size',
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
                        title:'O Qty',
                        id:'o_qty'
                    },
                    {
                        title:'P Qty',
                        id:'p_qty'
                    },
                    {
                        title:'D Qty',
                        id:'d_qty'
                    }
                ]
            },
            search:{
                model:'',
                style:'',
                part_no:'',
                assy_date:''
            },
            table:{
                data:[]
            },
            form:{},
            datamodels:[],
            models:[],
            styles:[],
            parts:[],
            lines:[],
            routings:[],
            childFormData:[],
            childFormDataForSend:[],
            prodlineselection:[],
            loading:false,
            hold_highlighted_id:null,
            highlighted_id:null,
            editstat:false,
            loadingform:false,
            parentstat:false,
            loadingchildform:false,
            fistloadchildform:false,
            showdata:false,
        }
    },
    computed:{
        userId:()=>{
            return document.head.querySelector("meta[name='user-id']").content
        }
    },
    mounted(){
        // this.getData()
        this.getDataModel()
        this.getDataPart()
        this.getDataLine()
        this.getDataRouting()
        // this.formDeclaration()
    },
    methods:{
        formDeclaration(){
            this.data.form.forEach(item=>{
                this.form[item.id] = ''
            })
            if(this.data.hasOwnProperty('created_by')&&!this.editstat){
                this.form[this.data.created_by.field] = this.userId
            }
        },
        getData(page){
            if(typeof page === 'undefined'){
                page = 1
            }
            this.loading = true
            axios.post(this.data.geturl+'?page='+page,this.search)
                .then(response=>{
                    this.table = response.data
                    this.loading = false
                    this.showdata = true
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
        getDataPart(){
            axios.get('/parts')
                .then(response=>{
                    this.parts = response.data
                })
        },
        getDataLine(){
            axios.get('/lines')
                .then(response=>{
                    this.lines = response.data
                    this.prodlineselection = _.chain(response.data).groupBy('op_id').map((map,a)=>{
                        var prodlineselection = []
                        map.forEach((mapeach,aeach)=>{
                            prodlineselection.push(mapeach.line_code)
                        })
                        return {
                            id:a,
                            selection:prodlineselection
                        }
                    }).value()
                    // console.log(this.prodlineselection)
                })
        },
        getDataRouting(){
            axios.get('/routings')
                .then(response=>{
                    this.routings = response.data
                })
        },
        change(item){
            console.log(this.childFormDataForSend)
        },
        onModelSelected(){
            // this.getData()
            this.styles = []
            this.datamodels.forEach((item,i)=>{
                if(item.model==this.search.model){
                    this.styles.push({'style':''+item.style})
                }
            })
        },
        actData(){
            if(this.editstat){
                this.editData()
            }else{
                this.addData()
            }
        },
        actDataChild(){
            var checkwipqty = 0
            this.childFormDataForSend.forEach(item=>{
                if(item.wip_qty!=0){
                    checkwipqty++
                }
            })
            if(checkwipqty>0){
                this.loadingchildform = true
                axios.post('/processchild',{data:this.childFormDataForSend})
                    .then(response=>{
                        this.highlighted_id = this.hold_highlighted_id
                        swal("Success","Data has been processed","success");
                        this.loadingchildform = false
                        this.getData()
                        $("#childPartComponent").modal("hide")
                        // console.log(response.data)
                    }).catch(error=>{
                        console.log(error)
                        this.loadingchildform = false
                        swal("Failed","Failed to process the data","error");
                    })
            }else{
                swal("Warning","No data for execute","warning")
            }
        },
        addData(){
            this.loadingform = true
            console.log(this.form)
            axios.post(this.data.addurl,this.form)
                .then(response=>{
                    this.formDeclaration()
                    this.refresh()
                    this.highlighted_id = response.data.id
                    swal("Success","Data has been added","success");
                    this.getData()
                    this.loadingform = false
                    $('#modalComponent').modal("hide")
                }).catch(error=>{
                    console.log(error)
                    this.loadingform = false
                    swal("Failed","Failed to add the data","error");
                })
        },
        editButtonClick(item){
            this.hold_highlighted_id = item.seq
            this.fistloadchildform = true
                    // console.log(item)
            $("#childPartComponent").modal("show")
            axios.get('/getBOM/'+item.c_style+'-'+item.c_size+'-'+item.part_no)
                .then(response=>{
                    if(response.data.length==0){
                        this.parentstat = false
                        this.childGetRoutingPart(item,{type:'child',qty:item.o_qty})
                    }else{
                        axios.post('/getbaseqtyparent',{
                            bom:item.c_style+'-'+item.c_size+'-'+item.part_no,
                            wo_no:item.wo_no,
                            order_no:item.order_no
                        })
                            .then(({data})=>{
                                // console.log(data)
                                // this.fistloadchildform = false
                                this.parentstat = true
                                this.childGetRoutingPart(item,{type:'parent',qty:data[0].qty})
                            })
                    }
                })
            // console.log(item.part_no)
            // $("#modalComponent").modal("show")
            // this.addClickButton()
            // this.editstat = true
            // if(this.data.hasOwnProperty('updated_by')&&this.editstat){
            //     this.form[this.data.updated_by.field] = this.userId
            // }
            // this.data.form.forEach(data=>{
            //     this.form[data.id] = item[data.id]
            // })
            // if(this.data.hasOwnProperty('created_by')){
            //     this.form[this.data.created_by.field] = item[this.data.created_by.field]

            // }
        },
        childGetRoutingPart(wo,qty){
            var array = []
            _.chain(this.routings).groupBy('part_no').map((item,i)=>{
                item.forEach((data,index)=>{
                    if(data.part_no==wo.part_no){
                        array.push(data)
                    }
                })
            }).value()
            this.childForm(wo,qty,array)
        },
        childForm(wo,qty,item){
            var form = []
            this.childFormData = []
            this.childFormDataForSend = []
            var processcountwip = 0
            item.forEach((val,i)=>{
                var selection = []
                this.prodlineselection.forEach((pls,a)=>{
                    if(val.c_op==pls.id){
                        pls.selection.forEach((plsselect=>{
                            selection.push({'id':plsselect})
                        }))
                    }
                })
                form.push({'wo_no':wo.wo_no,'part_no':wo.part_no,'location':val.c_op,'prodlineselection':selection})
                this.childFormData.push([
                    {
                        title:val.c_op+" Max Process",
                        id:'o_qty',
                        type:'text',
                        disabled:true,
                        value:0
                    },
                    {
                        title:'Get Process From Line:',
                        id:'get_process',
                        type:'select',
                        selection:[],
                        onchange:true
                    },
                    {
                        title:'Prod Line',
                        id:'prod_line',
                        type:'select',
                        selection:selection
                    },
                    {
                        title:'Transaction Quantity',
                        id:'wip_qty',
                        type:'number',
                        max:0
                    }
                ])
                this.childFormDataForSend.push(
                    {
                        seq:wo.seq,
                        wo_no:wo.wo_no,
                        part_no:wo.part_no,
                        location:val.c_op,
                        create_by:this.userId,
                        o_qty:0,
                        get_process:'',
                        prod_line:'',
                        wip_qty:'',
                    }
                )
                console.log(wo)
                axios.post('/countWip',{
                    wo_no:wo.wo_no,
                    bom_parent:wo.c_style+'-'+wo.c_size+'-'+wo.part_no,
                    order_no:wo.order_no,
                    type:qty.type
                }).then(({data})=>{
                    
                    var sumqtygroupby = [];
                    data.reduce(function(res, value) {
                    if (!res[value.c_op]) {
                        res[value.c_op] = {c_op: value.c_op, operation_id: value.operation_id, prod_line: value.prod_line, qty: 0,d_qty:0};
                        sumqtygroupby.push(res[value.c_op])
                    }
                    res[value.c_op].qty += value.qty;
                    res[value.c_op].d_qty += value.d_qty;
                    return res;
                    }, {});
                    console.log(sumqtygroupby)
                    if(qty.type=='parent'){
                        if(data.length>0){
                            var sumnotzero = 0
                            this.childFormDataForSend.forEach((cfv,cfi)=>{
                                sumnotzero = 0
                                sumqtygroupby.forEach((dtv,dti)=>{
                                    // console.log(cfv.location+" "+dtv.c_op)
                                    if(dti!==0){
                                        sumnotzero += dtv.qty
                                    }
                                    if(cfi==0){
                                        // console.log(sumqtygroupby.hasOwnProperty([1]))
                                        this.childFormDataForSend[0].o_qty = data[0].qty
                                        this.childFormData[0][3].max = data[0].qty
                                    }else{
                                        if(cfi-1!==-1){
                                            if(this.childFormDataForSend[cfi-1].location == dtv.c_op){
                                                this.childFormDataForSend[cfi].o_qty = dtv.qty
                                                this.childFormData[cfi][3].max = dtv.qty
                                            }
                                        }
                                    }
                                })
                                // if(data.hasOwnProperty([cfi])){
                                //     if(cfv.location == data[cfi].c_op){
                                //         // if(cfi-1===-1){
                                //         //     this.childFormDataForSend[cfi].o_qty = data[cfi].qty
                                //         //     this.childFormData[cfi][3].max = data[cfi].qty
                                //         // }else{
                                //             this.childFormDataForSend[cfi].o_qty = data[cfi].qty
                                //             this.childFormData[cfi][3].max = data[cfi].qty
                                //         // }
                                //     }else{
                                //         this.childFormDataForSend[0].o_qty = data[cfi].qty
                                //         this.childFormData[0][3].max = data[cfi].qty

                                //     }
                                // }
                            })
                            this.childFormDataForSend[0].o_qty -= sumnotzero 
                            this.childFormData[0][3].max -= sumnotzero
                        }else{
                            
                            console.log(qty)
                            this.childFormDataForSend[0].o_qty = qty.qty
                            this.childFormData[0][3].max = qty.qty
                        }
                    }else{
                        if(data.length>0){
                            this.childFormDataForSend.forEach((cfv,cfi)=>{
                                sumqtygroupby.forEach((dtv,dti)=>{
                                    console.log(cfv.location+" "+dtv.c_op)
                                    if(cfi==0){
                                        this.childFormDataForSend[0].o_qty = data[0].qty
                                        this.childFormData[0][3].max = data[0].qty
                                    }else{
                                        if(cfi-1!==-1){
                                            if(this.childFormDataForSend[cfi-1].location == dtv.c_op){
                                                this.childFormDataForSend[cfi].o_qty = dtv.qty
                                                this.childFormData[cfi][3].max = dtv.qty
                                            }
                                        }
                                    }
                                })
                                // if(data.hasOwnProperty([cfi])){
                                //     if(cfv.location == data[cfi].c_op){
                                //         // if(cfi-1===-1){
                                //         //     this.childFormDataForSend[cfi].o_qty = data[cfi].qty
                                //         //     this.childFormData[cfi][3].max = data[cfi].qty
                                //         // }else{
                                //             this.childFormDataForSend[cfi].o_qty = data[cfi].qty
                                //             this.childFormData[cfi][3].max = data[cfi].qty
                                //         // }
                                //     }else{
                                //         this.childFormDataForSend[0].o_qty = data[cfi].qty
                                //         this.childFormData[0][3].max = data[cfi].qty

                                //     }
                                // }
                            })
                        }else{
                            
                            console.log(qty)
                            this.childFormDataForSend[0].o_qty = qty.qty
                            this.childFormData[0][3].max = qty.qty
                        }
                    }
                    // console.log(data)
                    
                    processcountwip = processcountwip+ 1;
                    if(processcountwip==item.length){
                        this.fistloadchildform = false
                    }
                    
                })
            })
            this.childFormData.forEach((item,i)=>{
                if(i-1!==-1){
                    if(this.childFormData[i-1][2].selection.length>0){
                        this.childFormData[i][1].selection = this.childFormData[i-1][2].selection
                        // console.log(true)
                    }else{
                        // console.log(false)
                    }
                }
            })
        },
        onGetProcessChange(event,f){
            this.loadingchildform = true
            axios.post('/getprocesschange',{
                wo_no:this.childFormDataForSend[0].wo_no,
                prod_line:event.target.value
            })
                .then(({data})=>{
                    if(data.length>0){
                        this.childFormDataForSend[f].o_qty = data[0].qty
                        this.childFormData[f][3].max = data[0].qty
                    }else{
                        this.childFormDataForSend[f].o_qty = 0
                        this.childFormData[f][3].max = 0
                    }
                    
                    this.loadingchildform = false
                })
            // console.log(item.target[item.target.selectedIndex].value)
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
                    this.refresh()
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
        formatDateTime(val){
            var month = (val.getMonth()+1)+""
            var date = val.getDate()+""
            var hour = val.getHours()
            var minute = val.getMinutes()
            var second = val.getSeconds()
            if(month.length==1){
                month = "0"+month
            }
            if(date.length==1){
                date = "0"+date
            }
            if(hour.length==1){
                hour = "0"+hour
            }
            if(minute.length==1){
                minute = "0"+minute
            }
            if(second.length==1){
                second = "0"+second
            }
            return val.getFullYear()+"-"+month+"-"+date+" "+hour+":"+minute+":"+second
        },
        checktype(item,td){
            if(td.hasOwnProperty('type')){
                if(td.type=="date"){
                    var date = new Date(item[td.id])
                    // console.log(item[td.id])
                    var result = this.formatDateTime(date)
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