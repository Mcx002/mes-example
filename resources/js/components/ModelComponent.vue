<template>
    <form-component :data="data" :refresh="refresh"></form-component>
</template>
<script>
export default{
    data(){
        return{
            data:{
                title:'Model',
                geturl:'/models',
                addurl:'/addmodel',
                editurl:'/editmodel',
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
                        title:'Model',
                        id:'model'
                    },
                    {
                        title:'Style',
                        id:'style'
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
                        title:'Model',
                        id:'model',
                        type:'text'
                    },
                    {
                        title:'Style',
                        id:'style',
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