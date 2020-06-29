<template>
    <form-component :data="data" :refresh="refresh"></form-component>
</template>
<script>
export default{
    data(){
        return{
            data:{
                title:'Defect',
                geturl:'/defectinfos',
                addurl:'/adddefectinfo',
                editurl:'/editdefectinfo',
                table_primary:'defect_id',
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
                        title:'Operation',
                        id:'c_op'
                    },
                    {
                        title:'Defect Desc',
                        id:'defect_desc'
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
                        id:'defect_id',
                        type:'none'
                    },
                    {
                        title:'Part No',
                        id:'part_no',
                        type:'select',
                        selection:[]
                    },
                    {
                        title:'Operation',
                        id:'c_op',
                        type:'select',
                        selection:[]
                    },
                    {
                        title:'Defect Desc',
                        id:'defect_desc',
                        type:'text'
                    },
                ]
            }
        }
    },
    mounted(){
        this.getpart()
        this.getoperation()
    },
    methods:{
        refresh(){

        },
        getpart(){
            axios.get('/parts')
                .then(({data})=>{
                    this.data.form[1].selection = data.map(item=>{
                        return {
                            id:item.part_no,
                            title:item.part_no
                        }
                    })
                })
        },
        getoperation(){
            axios.get('/ops')
                .then(({data})=>{
                    this.data.form[2].selection = data.map(item=>{
                        return {
                            id:item.op_id,
                            title:item.op_desc
                        }
                    })
                })
        }
    }
}
</script>