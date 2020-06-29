<template>
    <div class="card-body" style="overflow-x:scroll">
        <div class="loading" v-show="loading"><div class="loading-wrap"><i class="fa fa-spinner spinner-loading mr-1"></i> Loading</div></div>
        <div class="form-group">
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
                                    <input :type="item.type" class="form-control" :readonly="item.hasOwnProperty('readonly')?item.readonly:false" v-if="item.type=='text'||item.type=='dateTime'||item.type=='number'" :id="item.id" :name="item.id" v-model="form[item.id]">
                                    <select :required="item.hasOwnProperty('required')?item.required:'true'" class="form-control" :id="item.id" :name="item.id" v-model="form[item.id]" v-else-if="item.type=='select'">
                                        <option v-for="select in item.selection" :value="select.id">{{select.title}}</option>
                                    </select>
                                    <input disabled type="text" class="form-control is-invalid" v-else-if="item.type=='selectnull'" :id="item.id" :value="'All Data '+item.title+' were registered - Please insert the new one'">
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
            <span data-toggle="modal" data-target="#modalComponent" class="btn btn-success" @click="addClickButton"><i class="fa fa-plus"></i> Add {{ data.title }}</span>
        </div>
        
        <table class="table hover-table">
            <thead>
                <th>No.</th>
                <th v-for="item in data.table">{{ item.title }}</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="(item,i) in table" :style="[item[data.table_primary]==highlighted_id?{backgroundColor:'#edf7ff'}:{}]">
                    <td>{{ i+1 }}</td>
                    <td v-for="td in data.table">{{ checktype(item,td) }}</td>
                    <td class="text-align-center"><a @click.prevent="editButtonClick(item)" data-toggle="modal" data-target="#modalComponent" class="btn btn-sm btn-primary" style="color:white"><i class="fa fa-pencil"></i> Edit</a></td>
                </tr>
                <tr v-show="table.length==0">
                    <td :colspan="data.table.length+2"><center>No data uploaded yet</center></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default{
    data(){
        return{
            data:{
                title:'Lead Time',
                geturl:'/leadtimes',
                addurl:'/addleadtime',
                editurl:'/editleadtime',
                table_primary:'id',
                created_by:{
                    bool:true,
                    field:'create_by'
                },
                updated_by:{
                    bool:true,
                    field:'update_by'
                },
                table:[
                    {
                        title:'Component ID',
                        id:'component_id'
                    },
                    {
                        title:'Lead Time',
                        id:'lead_time'
                    },
                    {
                        title:'Process Time',
                        id:'process_time'
                    },
                    {
                        title:'Created By',
                        id:'create_by'
                    },
                    {
                        title:'Updated By',
                        id:'update_by'
                    },
                    {
                        title:'Created At',
                        id:'created_at',
                        type:'date'
                    },
                    {
                        title:'Updated At',
                        id:'updated_at',
                        type:'date'
                    }
                ],
                form:[
                    {
                        title:'ID',
                        id:'id',
                        type:'none'
                    },
                    {
                        title:'Component ID',
                        id:'component_id',
                        type:'select',
                        selection:[]
                    },
                    {
                        title:'Lead Time',
                        id:'lead_time',
                        type:'number',
                    },
                    {
                        title:'Process Time',
                        id:'process_time',
                        type:'number',
                    }
                ]
            },
            parent:[],   
            table:[],
            form:{},
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
    mounted(){
        this.getDataLeadTime()
        this.getData()
        this.formDeclaration()
    },
    methods:{
        getDataLeadTime(){
            // console.log('restart')
            axios.get('/leadtimes')
                .then(response=>{
                    this.parent = []
                    response.data.forEach(item=>{
                        this.parent.push({'id':item.component_id,'title':item.component_id})
                    })
                    this.getDataRoutingPartNo()
                })
        },
        getDataRoutingPartNo(){
            axios.get('/boms')
                .then(response=>{
                    this.data.form[1].selection = []
                    response.data.forEach(item=>{
                        var count = 0
                        this.parent.forEach(parent=>{
                            if(item.bom_components==parent.id){
                                count = count+1
                            }
                            // console.log('123456-100-05M-'+item.part_no+' | '+parent.id)
                        })
                        // console.log(count)
                        if(count==0){
                            this.data.form[1].selection.push({'id':item.bom_components,'title':item.bom_components})
                        }
                    })
                    if(this.data.form[1].selection==0){
                        this.data.form[1].type="selectnull"
                    }
                })
                // console.log(this.data.form)
        },
        refresh(){

        },
        
        formDeclaration(){
            this.data.form.forEach(item=>{
                this.form[item.id] = ''
            })
            if(this.data.hasOwnProperty('created_by')&&!this.editstat){
                this.form[this.data.created_by.field] = this.userId
            }
        },
        getData(){
            this.loading = true
            axios.get(this.data.geturl)
                .then(response=>{
                    this.table = response.data
                    this.loading = false
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
            this.addClickButton()
            this.editstat = true
            this.data.form[1].type =  'text'
            this.data.form[1].readonly = true
            if(this.data.hasOwnProperty('updated_by')&&this.editstat){
                this.form[this.data.updated_by.field] = this.userId
            }
            this.data.form.forEach(data=>{
                this.form[data.id] = item[data.id]
            })
            if(this.data.hasOwnProperty('created_by')){
                this.form[this.data.created_by.field] = item[this.data.created_by.field]
            }
        },
        addClickButton(){
            this.editstat = false
            this.data.form[1].type =  'select'
            this.data.form[1].readonly = true
            this.formDeclaration()
        },
        editData(){
            this.loadingform = true
            axios.post(this.data.editurl,this.form)
                .then(response=>{
                    this.highlighted_id = this.form[this.data.table_primary]
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