<template>
    <form-component :data="data" :refresh="refresh"></form-component>
</template>
<script>
export default{
    data(){
        return{
            data:{
                title:'Operation',
                geturl:'/ops',
                addurl:'/addop',
                editurl:'/editop',
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
                        title:'OP ID',
                        id:'op_id'
                    },
                    {
                        title:'OP Desc',
                        id:'op_desc'
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
                        title:'OP ID',
                        id:'op_id',
                        type:'text'
                    },
                    {
                        title:'OP Desc',
                        id:'op_desc',
                        type:'text'
                    }
                ]
            }
        }
    },
    methods:{
        refresh(){

        }
    }
}
</script>