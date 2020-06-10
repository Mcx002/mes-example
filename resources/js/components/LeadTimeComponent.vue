<template>
    <form-component :data="data" :refresh="getDataLeadTime"></form-component>
</template>
<script>
export default{
    data(){
        return{
            data:{
                title:'Lead Time',
                geturl:'/leadtimes',
                addurl:'/addleadtime',
                editurl:'/editleadtime',
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
                        title:'Component ID',
                        id:'component_id'
                    },
                    {
                        title:'Lead Time',
                        id:'lead_time'
                    },
                    {
                        title:'Process Time',
                        id:'process_time'
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
                        title:'Component ID',
                        id:'component_id',
                        type:'select',
                        selection:[]
                    },
                    {
                        title:'Lead Time',
                        id:'lead_time',
                        type:'number',
                    },
                    {
                        title:'Process Time',
                        id:'process_time',
                        type:'number',
                    }
                ]
            },
            parent:[]
        }
    },
    mounted(){
        this.getDataLeadTime()
    },
    methods:{
        getDataLeadTime(){
            // console.log('restart')
            axios.get('/leadtimes')
                .then(response=>{
                    this.parent = []
                    response.data.forEach(item=>{
                        this.parent.push({'id':item.component_id,'title':'123456-100-05M-'+item.part_no})
                    })
                    this.getDataRoutingPartNo()
                })
        },
        getDataRoutingPartNo(){
            axios.get('/routingpartno')
                .then(response=>{
                    this.data.form[1].selection = []
                    response.data.forEach(item=>{
                        var count = 0
                        this.parent.forEach(parent=>{
                            if('123456-100-05M-'+item.part_no==parent.id){
                                count = count+1
                            }
                            // console.log('123456-100-05M-'+item.part_no+' | '+parent.id)
                        })
                        // console.log(count)
                        if(count==0){
                            this.data.form[1].selection.push({'id':'123456-100-05M-'+item.part_no,'title':'123456-100-05M-'+item.part_no})
                        }
                    })
                    if(this.data.form[1].selection==0){
                        this.data.form[1].type="selectnull"
                    }
                })
                // console.log(this.data.form)
        }
    }
}
</script>