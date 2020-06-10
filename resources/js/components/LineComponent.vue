<template>
    <form-component :data="data" :refresh="refresh"></form-component>
</template>
<script>
export default{
    data(){
        return{
            data:{
                title:'Line',
                geturl:'/lines',
                addurl:'/addline',
                editurl:'/editline',
                table_primary:'line_id',
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
                        title:'OP ID',
                        id:'op_id'
                    },
                    {
                        title:'Line Code',
                        id:'line_code'
                    },
                    {
                        title:'Line Desc',
                        id:'line_desc'
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
                        title:'Line ID',
                        id:'line_id',
                        type:'none'
                    },
                    {
                        title:'OP ID',
                        id:'op_id',
                        type:'select',
                        selection:[]
                    },
                    {
                        title:'Line Code',
                        id:'line_code',
                        type:'text'
                    },
                    {
                        title:'Line Desc',
                        id:'line_desc',
                        type:'text'
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
                    this.data.form[1].selection = []
                    response.data.forEach((item,i)=>{
                        this.data.form[1].selection.push({'id':item.op_id,'title':item.op_desc})
                    })
                })
            // console.log(this.data.form)
        }
    }
}
</script>