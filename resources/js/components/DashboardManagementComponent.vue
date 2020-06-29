<template>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Production</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="datestart">From</label>
                            <input type="date" id="datestart" class="form-control" v-model="datestart" @change="getDataQty2" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dateend">To</label>
                            <input type="date" id="dateend" class="form-control" v-model="dateend" :min="datestart" :disabled="datestart==''" @change="getDataQty2" />
                        </div>
                    </div>
                </div>
                <div class="card-body bg-light">
                    <div class="row text-center">
                        <div class="col-lg-4 border-right">
                            <div id="sparkline9" class="m-b-10"></div>
                            <h6>Production Quantity</h6> <b>{{ p_qty }}</b></div>
                        <div class="col-lg-4">
                            <div id="sparkline10" class="m-b-10"></div>
                            <h6>Defect Quantity</h6> <b>{{ d_qty }}</b></div>
                        <div class="col-lg-4 border-right">
                            <div id="sparkline8" class="m-b-10"></div>
                            <h6>FTT</h6> <b>{{ persentage_qty.toFixed(2) }}%</b></div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myChart" style="width:100%;height:350px"></canvas>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-lg-5">
            <div class="row" v-if="box.length>0">
                <!-- Column -->
                <div class="col-lg-6">
                    <div class="card bg-success text-white text-center">
                        <div class="card-body">
                            <small>{{ box[0].part_desc }} ({{ box[0].part_no }})</small>
                            <h3>{{ box[0].qty }}</h3>
                            <div id="sparkline11" class="m-t-10"></div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-6">
                    <div class="card bg-info text-white text-center">
                        <div class="card-body">
                            <small>{{ box[1].part_desc }} ({{ box[1].part_no }})</small>
                            <h3>{{ box[1].qty }}</h3>
                            <div id="sparkline12" class="m-t-10"></div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-6">
                    <div class="card bg-primary text-white text-center">
                        <div class="card-body">
                            <small>{{ box[2].part_desc }} ({{ box[2].part_no }})</small>
                            <h3>{{ box[2].qty }}</h3>
                            <div id="sparkline13" class="m-t-10"></div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-6">
                    <div class="card bg-danger text-white text-center">
                        <div class="card-body">
                            <small>{{ box[3].part_desc }} ({{ box[3].part_no }})</small>
                            <h3>{{ box[3].qty }}</h3>
                            <div id="sparkline14" class="m-t-10"></div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-0">TOP 5 DEFECT</h5>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Part No</th>
                                            <th>Defect Desc</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item,i) in top5defect">
                                            <td>{{ i+1 }}</td>
                                            <td>{{ item.part_no }}</td>
                                            <td>{{ item.defect_desc }}</td>
                                            <td>
                                                <span class="text-semibold" :class="[i+1==1?'text-danger':i==top5defect.length-1?'text-info':i+1>1?'text-warning':'']">{{ item.defect_qty }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
</template>

<script>
export default{
    data(){
        return{
            loading:false,
            date:'',
            p_qty:0,
            d_qty:0,
            totalqtyorder:0,
            persentage_qty:0,
            datestart:'',
            dateend:'',
            top5defect:[],
            box:[
                {
                    part_desc: "",
                    part_no: "",
                    qty: 0
                },
                {
                    part_desc: "",
                    part_no: "",
                    qty: 0
                },
                {
                    part_desc: "",
                    part_no: "",
                    qty: 0
                },
                {
                    part_desc: "",
                    part_no: "",
                    qty: 0
                }
            ]
        }
    },
    mounted(){
        this.getDataFullQty()
        this.getDataQty2()
        this.getDataByPartNo()
        this.getDatatop5defect()
    },
    methods:{
        getDataFullQty(){
            axios.get('/getDataFullQty')
                .then(({data})=>{
                    this.p_qty = data.p_qty
                    this.d_qty = data.d_qty
                    this.persentage_qty = (data.p_qty - data.d_qty) / data.p_qty * 100
                    this.totalqtyorder = data.o_qty
                })
        },
        getDataQty(){
            // console.log(this.datestart)
            axios.post('/getDataQty',{
                datestart:this.datestart,
                dateend:this.dateend,
            })
                .then(({data})=>{
                    var array = []
                    data.item.map((item,i)=>{
                        var itemdate = new Date(item.date)
                        var defect = 0
                        data.defect.forEach((dfv,dfi)=>{
                            if(this.formatDate(itemdate)==dfv.defect_date){
                            // console.log(this.formatDate(itemdate)+' '+dfv.defect_date)
                                defect = dfv.qty
                            }else{
                            console.log(this.formatDate(itemdate)+' '+dfv.defect_date)
                                var defectdate = new Date(dfv.defect_date)
                                if(!array.some(ar=>ar.periode==this.formatDate(defectdate))){
                                    array.push({
                                        periode:this.formatDate(defectdate),
                                        processed:0,
                                        defect:dfv.qty
                                    })
                                }
                            }
                        })
                        if(!array.some(ar=>ar.periode==this.formatDate(itemdate))){
                            array.push({
                                periode:this.formatDate(itemdate),
                                processed:item.p_qty,
                                defect:defect
                            })
                        }else{
                            var arindex = array.findIndex(ar=>ar.periode==this.formatDate(itemdate))
                            array.splice(arindex,1,{
                                periode:this.formatDate(itemdate),
                                processed:item.p_qty,
                                defect:defect
                            })
                        }
                    })
                    var result = [];
                    array.reduce(function(res, value) {
                    if (!res[value.periode]) {
                        res[value.periode] = { periode: value.periode, processed: 0,defect:0 }
                        result.push(res[value.periode])
                    }
                    res[value.periode].processed += value.processed
                    res[value.periode].defect += value.defect
                    return res
                    }, {})
                    // console.log(array)
                    this.setMorrisArea(result)
                    // this.p_qty = data[0].p_qty
                    // this.d_qty = data[0].d_qty
                    // this.persentage_qty = (data[0].p_qty + data[0].d_qty) / data[0].o_qty * 100
                })
        },
        getDataQty2(){
            axios.post('/getDataQty',{
                datestart:this.datestart,
                dateend:this.dateend,
            })
                .then(({data})=>{
                    var processed = data.map((item,i)=>{
                        return parseInt(item.qty)
                    })
                    var assy_line = data.map((item,i)=>{
                        return item.assy_line
                    })
                    console.log(processed)
                    this.setMorrisBar(processed,assy_line)
                })
        },
        setMorrisArea(item){
            
            var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            Morris.Area({
                element: 'morris-area-chart2',
                data: item
                , xkey: 'periode'
                , ykeys: ['processed', 'defect']
                , labels: ['Processed', 'Defect'],
                xLabelFormat:function(val){
                    var month = (val.getMonth()+1)+"";
                    var date = val.getDate()+"";
                    if(month.length==1){
                        month = "0"+month
                    }
                    if(date.length==1){
                        date = "0"+date
                    }
                    return val.getFullYear()+"-"+month+"-"+date
                }
                , pointSize: 0
                , fillOpacity: 0  
                , pointStrokeColors: ['#36bea6', '#f62d51', '#009efb']
                , behaveLikeLine: true
                , gridLineColor: '#f6f6f6'
                , lineWidth:2
                , hideHover: 'auto'
                , lineColors: ['#36bea6', '#f62d51', '#009efb']
                , resize: true
            });
        },
        setMorrisBar(processed,assy_line){
            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: assy_line,
                    datasets: [{
                        label: '# of Votes',
                        data: processed,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    title:{
                        display:true,
                        text:'Production by assembling line'
                    }
                }
            });
        },
        formatDate(val){
            var month = (val.getMonth()+1)+"";
            var date = val.getDate()+"";
            if(month.length==1){
                month = "0"+month
            }
            if(date.length==1){
                date = "0"+date
            }
            return val.getFullYear()+"-"+month+"-"+date
        },
        getDataByPartNo(){
            axios.get('/getDataByPartNo')
                .then(({data})=>{
                    console.log(data)
                    this.box = data
                })
        },
        getDatatop5defect(){
            axios.get('/top5defect')
                .then(({data})=>{
                    this.top5defect = data
                })
        }
    }
}

</script>