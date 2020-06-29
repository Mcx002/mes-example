<template>
    
    <div class="card-body" style="overflow-x:scroll">
        <div class="loading" v-show="loading"><div class="loading-wrap"><i class="fa fa-spinner spinner-loading mr-1"></i> Loading</div></div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-success w-100 waves-effect waves-light" type="button" @click="getData">Show</button>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-success w-100 waves-effect waves-light" type="button" @click="search.assystart='';search.assyend='';search.operation='';search.prod_line='';search.part_no='';search.model='';search.style='';search.size=''">Reset</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="control-label" for="assystart">Assy date : </label>
                <input type="date" class="form-control" id="assystart" v-model="search.assystart" @change="onAssyStartChange" />
            </div>
            <div class="col-md-3">
                <label class="control-label" for="assyend">~ </label>
                <input type="date" class="form-control" id="assyend" v-model="search.assyend" :min="minend" :disabled="search.assystart==''"  />
            </div>
            <div class="col-md-2 form-group">
                <label for="part_no">Part No</label>
                <select class="form-control" id="part_no" v-model="search.part_no">
                    <option v-for="item in parts">{{item.part_no}}</option>
                </select>
            </div>
            <div class="col-md-2 form-group">
                <label for="operation">Operation</label>
                <select class="form-control" id="operation" v-model="search.operation" @change="onOperationSelected">
                    <option v-for="item in ops">{{item.op_id}}</option>
                </select>
            </div>
            <div class="col-md-2 form-group">
                <label for="prod_line">Production Line</label>
                <select class="form-control" id="prod_line" v-model="search.prod_line" :disabled="search.operation==''||linefilter.length==0">
                    <option v-for="item in linefilter">{{item.line_code}}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="model">Model</label>
                <select class="form-control" id="model" @change="onModelSelected" v-model="search.model">
                    <option v-for="item in models">{{item.model}}</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="style">Style</label>
                <select class="form-control" :disabled="search.model==''" id="style" v-model="search.style">
                    <option v-for="item in styles">{{item.style}}</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="size">Size</label>
                <select class="form-control" id="size" v-model="search.size">
                    <option v-for="item in sizes">{{item.size_id}}</option>
                </select>
            </div>
        </div>
        <div v-if="showdata">
            <table class="table hover-table">
                <thead>
                    <th>No.</th>
                    <th v-for="item in data.table">{{ item.title }}</th>
                </thead>
                <tbody>
                    <tr v-for="(item,i) in table.data" :style="[item[data.table_primary]==highlighted_id?{backgroundColor:'#edf7ff'}:{}]">
                        <td>{{ table.from+i }}</td>
                        <td v-for="td in data.table">{{ checktype(item,td) }}</td>
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
    data(){
        return{
            data:{
                title:'Transaction Info',
                geturl:'/transactions',
                table_primary:'seq',
                table:[
                    {
                        title:'Transaction Date',
                        id:'txn_date',
                        type: 'date'
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
                        title:'Operation',
                        id:'operation'
                    },
                    {
                        title:'Quantity',
                        id:'txn_qty'
                    },
                    {
                        title:'Line',
                        id:'prod_line'
                    },
                    {
                        title:'Created By',
                        id:'create_by'
                    }
                ]
            },
            search:{
                assystart:'',
                assyend:'',
                operation:'',
                prod_line:'',
                part_no:'',
                model:'',
                style:'',
                size:''
            },
            table:{
                data:[]
            },
            form:{},
            datamodels:[],
            models:[],
            styles:[],
            sizes:[],
            parts:[],
            lines:[],
            linefilter:[],
            routings:[],
            ops:[],
            minend:'',
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
    mounted(){
        this.getDataOp()
        this.getDataPart()
        this.getDataLine()
        this.getDataRouting()
        this.getDataModel()
        this.getDataSize()
    },
    methods:{
        getData(page){
            if(typeof page === 'undefined'){
                page = 1
            }
            if(this.search.assyend==''){
                var dateend = new Date(this.search.assystart)
                dateend.setDate(dateend.getDate+1)
                this.search.assyend = this.formatDate(dateend)
            }
            this.loading = true
            axios.post(this.data.geturl+'?page='+page,this.search)
                .then(response=>{
                    this.table = response.data
                    this.loading = false
                    this.showdata = true
                })
        },
        getDataOp(){
            axios.get('/ops')
                .then(response=>{
                    this.ops = response.data
                    // this.models = _.chain(response.data).groupBy('model').map((v,i)=>{
                    //     return {
                    //         model:i
                    //     }
                    // }).value()
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
            // this.getData()
            this.styles = []
            this.datamodels.forEach((item,i)=>{
                if(item.model==this.search.model){
                    this.styles.push({'style':''+item.style})
                }
            })
        },
        formatDateTime(val){
            var month = (val.getMonth()+1)+""
            var date = val.getDate()+""
            var hour = val.getHours()+""
            var minute = val.getMinutes()+""
            var second = val.getSeconds()+""
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
        formatDate(val){
            var month = (val.getMonth()+1)+""
            var date = val.getDate()+""
            var hour = val.getHours()+""
            var minute = val.getMinutes()+""
            var second = val.getSeconds()+""
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
            return val.getFullYear()+"-"+month+"-"+date
        },
        checktype(item,td){
            if(td.hasOwnProperty('type')){
                if(td.type=="date"){
                    var date = new Date(item[td.id])
                    // console.log(item[td.id])
                    var result = this.formatDate(date)
                    return result
                }else{
                    return 'lol'
                }
            }else{
                return item[td.id]
            }   
        },
        onOperationSelected(){
            var result = this.lines.filter(item=>item.op_id===this.search.operation)
            console.log(result)
            this.linefilter = result
        },
        onAssyStartChange(){
            var dateend = new Date(this.search.assystart)
            dateend.setDate(dateend.getDate()+1)
            this.minend = this.formatDate(dateend)
            console.log(this.minend)
        }

    }
}
</script>