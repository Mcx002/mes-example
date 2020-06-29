<template>
<a class="nav-lock waves-effect waves-dark ml-auto hidden-md-down" href="javascript:void(0)" @click="toggle"><i class="mdi mdi-toggle-switch" :class="[!collapse?'mdi-toggle-switch-off':'']"></i></a>
</template>
<script>
export default{
    data(){
        return{
            collapse:false,
            datacollapse:'N'
        }
    },
    mounted(){
        this.getoption()
    },
    methods:{
        getoption(){
            axios.get('/option/get')
                .then(({data})=>{
                    this.datacollapse = data.collapse
                    if(data.collapse=='Y'){
                        $(".nav-lock").click()
                        this.collapse = true
                    }else{
                        this.collapse = false
                    }
                })
        },
        toggle(){
            if(this.datacollapse=='Y'){
                this.datacollapse = 'N'
            }else{
                this.datacollapse = 'Y'
            }
            axios.get('/option/setcollapse/'+this.datacollapse)
                .then(({data})=>{
                    console.log('success')
                })
        }
    }
}
</script>