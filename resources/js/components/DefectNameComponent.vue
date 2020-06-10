<template>
    <form-component :data="data"></form-component>
</template>
<script>
export default{
    data(){
        return{
            data:{
                title:'Defect Name',
                geturl:'/defectnames',
                addurl:'/adddefectname',
                editurl:'/editdefectname',
                table_primary:'id',
                created_by:{
                    bool:true,
                    field:'inserted_by'
                },
                updated_by:{
                    bool:true,
                    field:'updated_by'
                },
                table:[
                    {
                        title:'Defect Date',
                        id:'defect_date',
                    },
                    {
                        title:'D Code',
                        id:'d_code'
                    },
                    {
                        title:'D Qty',
                        id:'d_qty'
                    },
                    {
                        title:'Inserted By',
                        id:'inserted_by'
                    },
                    {
                        title:'Updated By',
                        id:'updated_by'
                    },
                    {
                        title:'Input date',
                        id:'created_at',
                        type:'date'
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
                        title:'Defect Date',
                        id:'defect_date',
                        type:'date',
                        selection:[]
                    },
                    {
                        title:'D Code',
                        id:'d_code',
                        type:'text',
                        selection:[]
                    },
                    {
                        title:'D Qty',
                        id:'d_qty',
                        type:'text',
                        selection:[]
                    }
                ]
            }
        }
    }
}
</script>