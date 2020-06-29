<template>
    <form-component :data="data" :refresh="refresh"></form-component>
</template>
<script>
export default{
    data(){
        return{
            data:{
                title:'Routing',
                geturl:'/routings',
                addurl:'/addrouting',
                editurl:'/editrouting',
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
                        title:'Part No',
                        id:'part_no'
                    },
                    {
                        title:'C OP',
                        id:'c_op'
                    },
                    {
                        title:'Operation ID',
                        id:'operation_id'
                    },
                    {
                        title:'Next Operation ID',
                        id:'next_operation_id'
                    },
                    {
                        title:'Created By',
                        id:'create_by',
                    },
                    {
                        title:'Updated By',
                        id:'update_by',
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
                        title:'Part No',
                        id:'part_no',
                        type:'number'
                    },
                    {
                        title:'C Op',
                        id:'c_op',
                        type:'select',
                        selection:[]
                    },
                    {
                        title:'Operation ID',
                        id:'operation_id',
                        type:'text'
                    },
                    {
                        title:'Next Operation ID',
                        id:'next_operation_id',
                        type:'select',
                        required:false,
                        selection:[]
                    }
                ]
            }
        }
    },
    mounted(){
        this.getDataOP()
    },
    methods:{
        refresh(){

        },
        getDataOP(){
            axios.get('/ops')
                .then(response=>{
                    this.data.form[3].selection = []
                    response.data.forEach((item,i)=>{
                        this.data.form[2].selection.push({'id':item.op_id,'title':item.op_desc})
                        this.data.form[4].selection.push({'id':item.op_id,'title':item.op_desc})
                    })
                })
            // console.log(this.data.form)
        }
    }
}
</script>