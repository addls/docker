<template>
    <div class="height-90">
<!--        <div class="right_title">最近7天天气概况</div>-->
        <div class="weatherbox height-80">
            <div class="weatherlist" v-for="(w,i) in weatherinfo" >
<!--                <div class="weatheritem height-100" :class="i==0?'weather_ative':'' || actnum==i?'weather_ative':''">-->
                <div class="weatheritem height-100" :class="actnum==i?'weather_ative':''">
                    <div class="weather-position">
                        <div class="days font-14">{{w.daytime}}</div>
                        <div>
                            <img :src="w.day_weather_pic" alt="" class="dayicon">
                        </div>
                        <div class="tem_day_num font-18">{{w.day_air_temperature}}~{{w.night_air_temperature}}℃</div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</template>
<style scoped src="@/assets/css/style.css"></style>
<script>
    import {LOGIN, LOGOUT} from "@/core/services/store/auth.module";
    import AUTH from "@/core/services/store/auth.module";
    import ApiService from "@/core/services/api.service";
    export default {
        name: 'XWeatherWeek',
        props: {
            loading: {
                type: Boolean,
                default: true,
            },
            legend: {
                type: Boolean,
                default: true,
            },
            apiData: {
                type: Object
            },
            title: {
                type: String,
                default: '',
            },
            fields: {
                type: Object,
            },
            colorStart: {
                type: String,
                default: '#7956EC',
            },
            colorEnd: {
                type: String,
                default: '#3CECCF',
            },
        },
        data() {
            return {
                chart: null,
                options: {
                    title: {
                        show: false,
                        text: this.title,
                        textStyle: {
                            align: 'center',
                            verticalAlign: 'middle',
                        },
                        top: 10,
                        left: '10',
                    },
                    tooltip: {
                        trigger: 'axis',
                        formatter: function (params) {
                            params = params[0];
                            return params.name;
                        },
                        axisPointer: {
                            animation: false
                        }
                    },
                    xAxis: {
                        type: 'time',
                        splitLine: {
                            show: false
                        },
                        axisLabel:{
                            textStyle: {
                                color: '#a8c5ff'
                            }
                        },
                        axisLine:{
                            lineStyle:{
                                color:'#333333',
                                width:1,//这里是为了突出显示加上的
                            }
                        }
                    },
                    yAxis: {
                        type: 'value',
                        boundaryGap: [0, '100%'],
                        splitLine: {
                            show: false
                        },
                        axisLabel:{
                            textStyle: {
                                color: '#a8c5ff'
                            }
                        },
                        axisLine:{
                            lineStyle:{
                                color:'#333333',
                                width:1,//这里是为了突出显示加上的
                            }
                        }
                    },
                    series: [{
                        name: '时序图',
                        type: 'line',
                        showSymbol: false,
                        hoverAnimation: false,
                        data: []
                    }]
                },
                weatherinfo:[],
                actnum:0,
            };
        },
        computed: {},
        watch: {
            apiData: {
                immediate: true,
                handler(val, oldVal) {
                    var _this = this;
                    if (!_this.loading) {
                        _this.initChart();
                    }
                },
            },
            colorStart() {
                this.initChart();
            },
            colorEnd() {
                this.initChart();
            },
            legend(val, oldVal) {
                this.chart.setOption({
                    legend: {
                        show: val,
                    },
                });
            },
        },
        methods: {
            handleChartClick(param) {
                console.log(param);
            },

            /**
             * echarts instance init event
             * @param {object} chart echartsInstance
             */
            chartInit(chart) {
                this.chart = chart;
                // must resize chart in nextTick
                this.$nextTick(() => {
                    this.resizeChart();
                });
            },

            /**
             * emit chart component init event
             */
            emitInit() {
                if (this.$refs.chart) {
                    this.chart = this.$refs.chart.chart;
                    this.$emit('init', {
                        chart: this.chart,
                        chartData: this.apiData,
                    });
                }
            },

            /**
             * resize chart
             */
            resizeChart() {
                /* eslint-disable no-unused-expressions */
                this.chart && this.chart.resize();
            },

            /**
             * init chart
             */
            initChart() {
                /*console.log('7天天气概况');
                console.log(this.fields);*/
                for (let field in this.fields) {
                    /*console.log(field);
                    console.log(JSON.parse(JSON.stringify(this.apiData[field].values)))*/
                    this.chart.setOption({
                        series: [{
                            data: JSON.parse(JSON.stringify(this.apiData[field].values)),
                            itemStyle : {
                                normal : {
                                    lineStyle:{
                                        color:'#1FC96E'
                                    }
                                }
                            },
                        }]
                    });
                }
            },
            weatherweek(){
                ApiService.post(AUTH.local_url + "/amap/show")
                    .then(({data}) => {
                        /*console.log('7天天气概况');
                        console.log(data);*/
                        if (data.code == 200) {
                            this.weatherinfo = data.data.future;
                        } else if (data.code == 0) {
                            this.$store
                                .dispatch(LOGOUT)
                                .then(() => this.$router.push({name: "login"}));
                        } else {

                        }
                    });
            },
        },

        async mounted() {
            var _this = this;
            // this.emitInit();
            this.weatherweek();

            setInterval(function(){
                if(_this.actnum == 0){
                    _this.actnum = _this.actnum+1;
                }else if(_this.actnum == 1){
                    _this.actnum = _this.actnum+1;
                }else if(_this.actnum == 2){
                    _this.actnum = _this.actnum+1;
                }else if(_this.actnum == 3){
                    _this.actnum = _this.actnum+1;
                }else if(_this.actnum == 4){
                    _this.actnum = _this.actnum+1;
                }else if(_this.actnum == 5){
                    _this.actnum = _this.actnum+1;
                }else if(_this.actnum == 6){
                    _this.actnum = 0;
                }
            },5000);
        }
    };
</script>