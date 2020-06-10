<template>
    <form-component :data="data" :refresh="refresh"></form-component>
</template>

<script>
export default{
    data(){
        return{
            data:{
                title:'Part',
                geturl:'/parts',
                addurl:'/addpart',
                editurl:'/editpart',
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
                        title:'Part Desc',
                        id:'part_desc'
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
                        id:'created_at'
                    },
                    {
                        title:'Updated At',
                        id:'updated_at'
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
                        title:'Part Desc',
                        id:'part_desc',
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