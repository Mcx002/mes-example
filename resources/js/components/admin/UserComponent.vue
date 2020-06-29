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
                                                <label for="emp_id" class="control-label">Employee ID:</label>
                                                <input type="text" class="form-control" id="emp_id" name="emp_id" v-model="form.emp_id">
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="control-label">Name:</label>
                                                <input type="text" class="form-control" id="name" name="name" v-model="form.name">
                                            </div>
                                            <div class="form-group" v-if="editstat">
                                                <label for="password" class="control-label">Password:</label>
                                                <input type="text" class="form-control" id="password" name="password" v-model="form.password">
                                            </div>
                                            <div class="form-group">
                                                <label for="level" class="control-label">Level:</label>
                                                <select id="level" name="level" v-model="form.level" class="form-control">
                                                    <option value="1">Management</option>
                                                    <option value="2">Quality Control</option>
                                                    <option value="3">Production</option>
                                                    <option value="4">Admin</option>
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
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Password</th>
                            <th>Level</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="(item,i) in table" :style="[item.id==highlighted_id?{backgroundColor:'#edf7ff'}:{}]">
                                <td>{{ i+1 }}</td>
                                <td>{{ item.emp_id }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.password }}</td>
                                <td>{{ item.level=='1'?'Management':item.level=='2'?'Quality Control':item.level=='3'?'Production':'Admin' }}</td>
                                <td class="text-align-center text-center"><a @click.prevent="editButtonClick(item)" data-toggle="modal" data-target="#modalComponent" class="btn btn-sm btn-primary" style="color:white"><i class="fa fa-pencil"></i> Edit</a><a @click.prevent="deleteUser(item)" class="btn btn-sm btn-danger ml-2" style="color:white"><i class="fa fa-trash"></i> Delete</a></td>
                            </tr>
                            <tr v-show="table.length==0">
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
export default{
    data(){
        return{
            data:{
                title:'User',
                table:[],
            },
            table:[],
            loading:false,
            editstat:false,
            loadingform:false,
            highlighted_id:null,
            form:{
                id:'',
                emp_id:'',
                name:'',
                password:'',
                level:''
            }
        }
    },
    mounted(){
        this.getDataUser()
    },
    methods:{
        refresh(){
            this.form.id=''
            this.form.emp_id=''
            this.form.name=''
            this.form.password='0000000'
            this.form.level=''
        },
        getDataUser(){
            axios.get('/admin/users')
                .then(({data})=>{
                    this.table = data
                })
        },
        addButtonClick(){
            this.refresh()
            this.editstat = false
        },
        editButtonClick(item){
            this.editstat = true
            this.form.id=item.id
            this.form.emp_id=item.emp_id
            this.form.name=item.name
            this.form.password=item.password
            this.form.level=item.level
        },
        deleteUser(item){
            this.loading = true
            axios.get('/admin/deleteuser/'+item.id)
                .then(({data})=>{
                    this.loading = false
                    swal("Success","Data has been deleted","success");
                }).catch(error=>{
                    this.loading = false
                    swal("Failed","Failed to delete the data","error");
                })
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
            axios.post('/admin/edituser',this.form)
                .then(response=>{
                    this.highlighted_id = this.form.id
                    this.refresh()
                    swal("Success","Data has been updated","success");
                    this.getDataUser()
                    this.loadingform = false
                    $('#modalComponent').modal("hide")
                }).catch(error=>{
                    console.log(error)
                    this.loadingform = false
                    swal("Failed","Failed to update the data","error");
                })
        },
        addData(){
            let bcform = {}
            bcform['key'] = "EMP"+this.table[this.table.length-1].id;
            bcform['empid'] = this.form.emp_id;
            bcform['nama'] = this.form.name;
            bcform['level'] = this.form.level;
            axios.post('http://localhost:5000/api/addcar/',bcform)
                .then(({data})=>{
                    console.log('success')
                })
                .catch(error=>{
                    console.log("Error: "+error)
                })
            this.loadingform = true
            axios.post('/admin/adduser',this.form)
                .then(response=>{
                    this.refresh()
                    this.highlighted_id = response.data.id
                    swal("Success","Data has been added","success");
                    this.getDataUser()
                    this.loadingform = false
                    $('#modalComponent').modal("hide")
                }).catch(error=>{
                    console.log(error)
                    this.loadingform = false
                    swal("Failed","Failed to add the data","error");
                })
            
        },
    }
}
</script>