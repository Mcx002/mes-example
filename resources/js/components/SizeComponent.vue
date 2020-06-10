<template>
    <form-component :data="data" :refresh="refresh"></form-component>
</template>
<script>
export default{
    data(){
        return{
            data:{
                title:'Size',
                geturl:'/sizes',
                addurl:'/addsize',
                editurl:'/editsize',
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
                        title:'Size ID',
                        id:'size_id'
                    },
                    {
                        title:'Description',
                        id:'desc'
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
                        title:'Size ID',
                        id:'size_id',
                        type:'text'
                    },
                    {
                        title:'Description',
                        id:'desc',
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