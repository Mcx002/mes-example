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
                                <div class="form-group">
                                    <label for="model" class="control-label">Model:</label>
                                    <select required id="model" name="model" @change="onmodelchange" v-model="modelselected" class="form-control">
                                        <option v-for="item in model" :value="item.model">{{ item.model }}</option>
                                    </select>
                                </div>
                                <div class="form-group" :title="modelselected==''?'Disabled':''">
                                    <label for="style" class="control-label">Style:</label>
                                    <select required :disabled="modelselected==''" @change="onselectchange" id="style" name="style" v-model="styleselected" class="form-control">
                                        <option v-for="item in style" :value="item.style">{{ item.style }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="size" class="control-label">Size:</label>
                                    <select required id="size" @change="onselectchange" name="size" v-model="sizeselected" class="form-control">
                                        <option v-for="item in size" :value="item.size_id">{{ item.size_id }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="part_no" class="control-label">Part No:</label>
                                    <select required id="part_no" @change="onselectchange" name="part_no" v-model="part_noselected" class="form-control">
                                        <option v-for="item in part_no" :value="item.part_no">{{ item.part_no }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bom_parent" class="control-label">Bom Parent:</label>
                                    <select :disabled="bomnotfull" id="bom_parent" name="bom_parent" v-model="form.bom_parent" class="form-control">
                                        <option value="">No Parent</option>
                                        <option v-for="item in bom_parent" :value="item.bom_components">{{ item.bom_components }}</option>
                                    </select>
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
            <span data-toggle="modal" data-target="#modalComponent" class="btn btn-success" @click="addButtonClick"><i class="fa fa-plus"></i> Add {{ data.title }}</span>
        </div>
        
        <table class="table hover-table">
            <thead>
                <th>No.</th>
                <th>BOM Component</th>
                <th>BOM Parent</th>
                <th>Created By</th>
                <th>Updated By</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th class="text-center">Action</th>
            </thead>
            <tbody>
                <tr v-for="(item,i) in table" :style="[item.id==highlighted_id?{backgroundColor:'#edf7ff'}:{}]">
                    <td>{{ i+1 }}</td>
                    <td>{{ item.bom_components }}</td>
                    <td>{{ item.bom_parent }}</td>
                    <td>{{ item.create_by }}</td>
                    <td>{{ item.update_by }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>{{ item.updated_at }}</td>
                    <td class="text-align-center text-center"><a @click.prevent="editButtonClick(item)" data-toggle="modal" data-target="#modalComponent" class="btn btn-sm btn-primary" style="color:white"><i class="fa fa-pencil"></i> Edit</a></td>
                </tr>
                <tr v-show="table.length==0">
                    <td colspan="8"><center>No data uploaded yet</center></td>
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
                title:'BOM',
                table:[],
            },
            table:[],
            bom_parent:[],
            modelfulldata:[],
            model:[],
            modelselected:'',
            styleselected:'',
            sizeselected:'',
            part_noselected:'',
            style:[],
            size:[],
            part_no:[],
            loading:false,
            editstat:false,
            loadingform:false,
            highlighted_id:null,
            bomnotfull:true,
            form:{
                id:'',
                bom_components:'',
                bom_parent:'',
                user_id:'',
            }
        }
    },
    computed:{
        userId:()=>{
            return document.head.querySelector("meta[name='user-id']").content
        }
    },
    mounted(){
        this.getDataBOM()
        this.getDataPartNo()
        this.getDataSize()
        this.getDataStyle()
        this.form.user_id = this.userId
    },
    methods:{
        refresh(){
            this.form.id=''
            this.form.bom_components=''
            this.form.bom_parent=''
        },
        getDataBOM(){
            axios.get('/boms')
                .then(({data})=>{
                    this.table = data
                })
        },
        getDataStyle(){
            axios.get("/models")
                .then(({data})=>{
                    this.modelfulldata = data
                    this.model = _.chain(data).groupBy('model').map((item,i)=>{
                        return {
                            model:i
                        }
                    }).value()
                    console.log(this.model)
                })
        },
        getDataSize(){
            axios.get("/sizes")
                .then(({data})=>{
                    this.size = data
                })
        },
        getDataPartNo(){  
            axios.get("/parts")
                .then(({data})=>{
                    this.part_no = data
                })
        },
        addButtonClick(){
            this.refresh()
            this.editstat = false
            
        },
        editButtonClick(item){
            this.editstat = true
            this.form.bom_components = item.bom_components
            this.form.bom_parent = item.bom_parent
            this.form.id = item.id
            var dataform = item.bom_components.split("-")
            console.log(dataform)
            this.modelselected = this.modelfulldata.find(item=>item.style===dataform[0]+"-"+dataform[1]).model
            this.onmodelchange()
            this.styleselected = dataform[0]+"-"+dataform[1]
            this.sizeselected = dataform[2]
            this.part_noselected = dataform[3]
            this.onselectchange()
        },
        actData(){
            // console.log(this.form)
            if(this.editstat){
                this.editData()
            }else{
                this.addData()
            }
        },
        editData(){
            this.loadingform = true
            axios.post('/editbom',this.form)
                .then(response=>{
                    this.highlighted_id = this.form.id
                    this.refresh()
                    swal("Success","Data has been updated","success");
                    this.getDataBOM()
                    this.loadingform = false
                    $('#modalComponent').modal("hide")
                }).catch(error=>{
                    console.log(error)
                    this.loadingform = false
                    swal("Failed","Failed to update the data","error");
                })
        },
        addData(){
            this.loadingform = true
            axios.post('/addbom',this.form)
                .then(response=>{
                    this.refresh()
                    this.highlighted_id = response.data.id
                    swal("Success","Data has been added","success");
                    this.getDataBOM()
                    this.loadingform = false
                    $('#modalComponent').modal("hide")
                }).catch(error=>{
                    console.log(error)
                    this.loadingform = false
                    swal("Failed","Failed to add the data","error");
                })
        },
        onmodelchange(){
            this.styleselected = ''
            this.bomnotfull = true
            // this.onselectchange()
            this.style = this.modelfulldata.filter(item=>item.model===this.modelselected)
        },
        onselectchange(){
            this.form.bom_components = this.styleselected+"-"+this.sizeselected+"-"+this.part_noselected
            this.bomnotfull = (this.styleselected==''||this.sizeselected==''||this.part_noselected=='')
            if(!this.bomnotfull){
                this.bom_parent = this.table.filter(item=>item.bom_components.indexOf(this.styleselected+'-'+this.sizeselected+'-')>-1&&item.bom_components!=this.styleselected+'-'+this.sizeselected+'-'+this.part_noselected)
            }
        }
    }
}
</script>