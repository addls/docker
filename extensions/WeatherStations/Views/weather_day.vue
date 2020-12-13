<template>
    <div class="chartmap height-90">
<!--        <div class="right_title">24小时天气概况</div>-->
        <div class="chartbox height-90">
            <echarts
                    v-loading="loading"
                    id="chart"
                    ref="chart"
                    class="chart height-100 chart_dashboard"
                    @click="handleChartClick"
                    @init="chartInit"
                    :auto-resize="true"
                    :options="options">
            </echarts>
        </div>
    </div>
</template>
<style scoped src="@/assets/css/style.css"></style>
<script>
    import {LOGIN, LOGOUT} from "@/core/services/store/auth.module";
    import AUTH from "@/core/services/store/auth.module";
    import ApiService from "@/core/services/api.service";
    export default {
        name: 'XWeatherDay',
        props: {
            loading: {
                type: Boolean,
                default: true,
            },
            legend: {
                type: Boolean,
                default: true,
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
                chart:null,
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
                    legend: {
                        show: true,
                        top: 10,
                        textStyle:{
                            color:'#fff'
                        }
                        // data: [],
                    },
                    tooltip : {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'cross',
                            label: {
                                backgroundColor: '#6a7985'
                            }
                        }
                    },
                    grid: {
                        top: '15%',
                        right: '2%',
                        left: '5%',
                        bottom: '10%'
                    },
                    xAxis: [
                        {
                            type: 'category',
                            boundaryGap: false,
                            axisLabel: {
                                color: '#485079'
                            },
                            axisLine: {
                                show: true,
                                lineStyle: {
                                    color: '#0f2486'
                                }
                            },
                            axisTick: {
                                show: true,
                            },
                            splitLine: {
                                show: false,
                                lineStyle: {
                                    color: '#0f2486'
                                }
                            },
                            data: []
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value',
                            name: '温度/℃',
                            nameTextStyle: {
                                color: '#525e82'
                            },
                            /*min: -40,
                            max: 45,*/
                            axisLabel: {
                                formatter: '{value}',
                                textStyle: {
                                    color: '#485079'
                                }
                            },
                            axisLine: {
                                show: true,
                            },
                            axisTick: {
                                show: false,
                            },
                            splitLine: {
                                show: false,
                            }
                        }
                    ],
                    series: [
                        {
                            name: '温度',
                            type: 'line',
                            smooth: true,
                            stack: 'PM2.5',
                            symbol: 'emptyCircle',
                            symbolSize: 6,
                            itemStyle: {
                                normal: {
                                    color: {
                                        type: 'linear',
                                        x: 0,
                                        y: 0,
                                        x2: 1,
                                        y2: 0,
                                        colorStops: [{
                                            offset: 0, color: '#7956EC', // 0%
                                        }, {
                                            offset: 1, color: '#3CECCF', // 100%
                                        }],
                                    },
                                    lineStyle: {
                                        width: 7
                                    },
                                    areaStyle: {
                                        normal: {
                                            opacity: 0.3,
                                        },
                                    },
                                }
                            },
                            markPoint: {
                                itemStyle: {
                                    normal: {
                                        color: '#fff'
                                    }
                                }
                            },
                            data: [],
                        }
                    ],
                    animationDuration: 1000,
                },
            };
        },
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
        methods:{
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
                console.log('空气质量');
                console.log(this.fields);
                for (let field in this.fields) {
                    console.log(field);
                    // console.log(JSON.parse(JSON.stringify(this.apiData[field].values)))
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
            weatherday(){
                ApiService.post(AUTH.local_url + "/amap/weather")
                    .then(({data}) => {
                        /*console.log('24小时');
                        console.log(data);*/
                        if (data.code == 200) {
                            if(data.data.length>0){
                                this.options.animationDelay = 3000;
                                var xaarr = [],searr = [];
                                for(var i = 0;i<data.data.length;i++){
                                    xaarr.push(data.data[i]['time']);
                                    searr.push(Number(data.data[i]['temperature']));
                                }
                                this.options.xAxis[0]['data']=xaarr;
                                this.options.series[0]['data'] = searr;
                            }
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
            // this.emitInit();
            this.weatherday();
            setInterval(this.weatherday,5000);
        },
    }
</script>