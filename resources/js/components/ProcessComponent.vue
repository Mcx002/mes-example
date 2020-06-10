<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data Process
                </div>
                <div class="card-body">
                    <div class="loading" v-show="loading"><div class="loading-wrap"><i class="fa fa-spinner spinner-loading mr-1"></i> Loading</div></div>
                    <div class="form-group">
                        <div id="addprocessmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ editstat?'Edit':'Create' }} Process</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <form class="form-material" @submit.prevent="actDataProcess">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="process-id" class="control-label">Process ID:</label>
                                                <input required type="text" class="form-control" :readonly="editstat" :class="[processIdFailure?'is-invalid':'']" @change="checkIdProcess" id="process-id" v-model="form.id">
                                                <span class="invalid-feedback" role="alert" v-show="processIdFailure">
                                                    <strong>Process ID has been used</strong>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label for="process-desc" class="control-label">Process Description:</label>
                                                <textarea required class="form-control" id="process-desc" v-model="form.desc"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="starting-step-id" class="control-label">Starting Step ID:</label>
                                                <input required type="text" class="form-control" id="starting-step-id" v-model="form.starting_step_id">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                            <button type="submit" :class="[editstat?'btn-danger':'btn-primary']" class="btn waves-effect waves-light" :disabled="processIdFailure">{{ editstat?'Save Changes':'Create' }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <span data-toggle="modal" data-target="#addprocessmodal" class="btn btn-success" @click="form.id = nextid;editstat=false"><i class="fa fa-plus"></i> Add Process</span>
                    </div>
                    <table class="table hover-table">
                        <thead>
                            <th>No.</th>
                            <th>Process ID</th>
                            <th>Process Description</th>
                            <th>Starting Step ID</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr v-for="(item,i) in processes" :style="[item.process_id==highlighted_id?{backgroundColor:'#edf7ff'}:{}]">
                                <td>{{ i+1 }}</td>
                                <td>{{ item.process_id }}</td>
                                <td>{{ item.process_desc }}</td>
                                <td>{{ item.starting_step_id }}</td>
                                <td class="text-align-center"><a @click.prevent="editButtonClick(item)" data-toggle="modal" data-target="#addprocessmodal" class="btn btn-primary" style="color:white"><i class="fa fa-pencil"></i> Edit</a></td>
                            </tr>
                            <tr v-show="processes.length==0">
                                <td colspan="5"><center>No data uploaded yet</center></td>
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
    desc:'',
    starting_step_id:''
}
export default{
    data(){
        return{
            loading:false,
            processes:[],
            form:{        
                id:'',
                desc:'',
                starting_step_id:''
            },
            highlighted_id:null,
            nextid:'',
            editstat:false,
            processIdFailure:false
        }
    },
    mounted(){
        this.getDataProcess()
    },
    methods:{
        getDataProcess(){
            this.loading = true
            axios.get('/processes')
                .then(response=>{
                    this.processes = response.data
                    this.loading = false
                    this.nextProcessId()
                })
        },
        nextProcessId(){
            if(this.processes.length!=0){
                var lastprocessid = this.processes[this.processes.length-1].process_id
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
                this.nextid='PR0001'
            }
        },
        actDataProcess(){
            if(this.editstat){
                this.editDataProcess()
            }else{
                this.addDataProcess()
            }
            $('#addprocessmodal').modal("hide")
        },
        checkIdProcess(){
            console.log('asd');
            var count = 0;
            this.processes.forEach(item=>{
                if(item.process_id==this.form.id){
                    count += 1
                }
            })
            if(count>0){
                this.processIdFailure = true
            }else{
                this.processIdFailure = false
            }
        },
        addDataProcess(){
            axios.post('/addprocess',this.form)
                .then(response=>{
                    this.form = form
                    this.highlighted_id = response.data.id
                    swal("Success","Data has been added","success");
                    this.getDataProcess()
                }).catch(error=>{
                    console.log(error)
                    swal("Failed","Failed to add the data","error");
                })
        },
        editButtonClick(item){
            this.editstat = true,
            this.form.id = item.process_id
            this.form.desc = item.process_desc
            this.form.starting_step_id = item.starting_step_id
        },
        editDataProcess(){
            axios.post('/editprocess',this.form)
                .then(response=>{
                    this.highlighted_id = this.form.id
                    this.form = form
                    swal("Success","Data has been updated","success");
                    this.getDataProcess()
                }).catch(error=>{
                    console.log(error)
                    swal("Failed","Failed to update the data","error");
                })
        }
    }
}

</script>