<template>
    <form-component :data="data" :refresh="getDataBom"></form-component>
</template>
<script>
export default{
    data(){
        return{
            data:{
                title:'Bom',
                geturl:'/boms',
                addurl:'/addbom',
                editurl:'/editbom',
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
                        title:'Bom Component',
                        id:'bom_components'
                    },
                    {
                        title:'Bom Parent',
                        id:'bom_parent'
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
                        title:'Bom Component',
                        id:'bom_components',
                        type:'select',
                        selection:[]
                    },
                    {
                        title:'Bom Parent',
                        id:'bom_parent',
                        type:'select',
                        selection:[]
                    }
                ]
            }
        }
    },
    mounted(){
        this.getDataBom()
    },
    methods:{
        getDataBom(){
            axios.get('/boms')
                .then(response=>{
                    this.data.form[2].selection = []
                    response.data.forEach(item=>{
                        this.data.form[2].selection.push({'id':item.bom_components,'title':item.bom_components})
                    })
                    this.getDataRoutingPartNo()
                })
        },
        getDataRoutingPartNo(){
            axios.get('/leadtimes')
                .then(response=>{
                    this.data.form[1].selection = []
                    response.data.forEach(item=>{
                        var count = 0
                        this.data.form[2].selection.forEach(parent=>{
                            if(item.component_id==parent.id){
                                count = count+1
                            }
                            // console.log('123456-100-05M-'+item.part_no+' | '+parent.id)
                        })
                        // console.log(count)
                        if(count==0){
                            this.data.form[1].selection.push({'id':item.component_id,'title':item.bom_components})
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