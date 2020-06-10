<template>
    <form-component :data="data"></form-component>
</template>
<script>
export default{
    data(){
        return{
            data:{
                title:'WIP',
                geturl:'/wips',
                addurl:'/addwip',
                editurl:'/editwip',
                table_primary:'id',
                created_by:{
                    bool:false
                },
                updated_by:{
                    bool:false
                },
                table:[
                    {
                        title:'WO Number',
                        id:'wo_number',
                    },
                    {
                        title:'C OP',
                        id:'c_op'
                    },
                    {
                        title:'qty',
                        id:'qty'
                    }
                ],
                form:[
                    {
                        title:'ID',
                        id:'id',
                        type:'none',
                        selection:[]
                    },
                    {
                        title:'WO Number',
                        id:'wo_number',
                        type:'select',
                        selection:this.getWO()
                    },
                    {
                        title:'C Op',
                        id:'c_op',
                        type:'text',
                        selection:[]
                    },
                    {
                        title:'QTY',
                        id:'qty',
                        type:'text',
                        selection:[]
                    }
                ]
            }
        }
    },
    methods:{
        getWO(){
            axios.get('/prodplans')
                .then(response=>{
                    return response.data
                })
        }
    }
}
</script>