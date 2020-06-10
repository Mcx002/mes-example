<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Converter
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Input</label>
                            <input type="text" class="form-control" v-model="input" @change="convert" />
                        </div>
                        <div class="form-group">
                            <label for="">Result</label>
                            <textarea type="text" class="form-control" rows="10" v-model="result"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Converter 2
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Input</label>
                            <textarea type="text" class="form-control" v-model="input2" @change="convert2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Result</label>
                            <textarea type="text" class="form-control" v-model="result2"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Converter 3
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Input</label>
                            <textarea type="text" class="form-control" v-model="input3" @change="convert3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Result</label>
                            <textarea type="text" class="form-control" v-model="result3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Converter 4
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Input</label>
                            <textarea type="text" class="form-control" v-model="input4" @change="convert4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Result</label>
                            <textarea type="text" class="form-control" v-model="result4"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Converter Condition Or (5)
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Input</label>
                            <textarea type="text" class="form-control" v-model="input5" @change="convert5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Result</label>
                            <textarea type="text" class="form-control" v-model="result5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return{
            input:'',
            result:'',
            input2:'',
            result2:'',
            input3:'',
            result3:'',
            input4:'',
            result4:'',
            input5:'',
            result5:''
        }
    },
    methods:{
        convert(){
            var split = this.input.split(' ')
            this.result = ""
            split.forEach(item=>{
                this.result += "'"+item+"'=>$request->,\n"
            })
        },
        convert2(){
            this.result2 = this.input2.split(':').join('=>')
        },
        convert3(){
            var split = this.input3.split(' ')
            this.result3 =""
            
            split.forEach(item=>{
                this.result3 += "'"+item+"',"
            })
        },
        convert4(){
            var split = this.input4.split(' ').join('').split(',\n')
            console.log(split)
            this.result4 = ""
            for(var i=0;i<split.length;i++){
                var splitsecond = split[i].split(':')
                splitsecond[0] = 'this.form.'+splitsecond[0]
                splitsecond[0] = splitsecond[0].slice(' ')
                split[i] = splitsecond.join('=')                
            }
            var result = split.join(',\n')
            this.result4 = result

        },
        convert5(){
            var split = this.input5.split(' ').join('').split(',\n')
            console.log(split)
            this.result5 = ""
            for(var i=0;i<split.length;i++){
                var splitsecond = split[i].split(':')
                splitsecond[0] = 'this.form.'+splitsecond[0]
                splitsecond[0] = splitsecond[0].slice(' ')
                split[i] = splitsecond.join('==')                
            }
            var result = split.join('||')
            this.result5 = result

        }
    }
}

</script>