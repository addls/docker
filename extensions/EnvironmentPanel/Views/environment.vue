<template>
    <div class="environmentbox v-application v-application--is-ltr text-white font-15">
        <div class="en_top">
            <div class="en_title">
                <div class="inlne-block page-subtitle">{{title}}</div>
            </div>
            <div class="en_list row">
                <div class="col-md-2 col-sm-3 text-center" v-for="field in chartFields" @click="changeChart(field.key)">
                    <div class="bg-primary px-0 py-6 rounded mb-5 cursor-pointer">
                        <h6 class="font-weight-100">{{field.name}}</h6>
                        <div class="font-weight-bolder font-17">{{field.value}} {{field.symbol}}</div>
                    </div>
                </div>
            </div>
        </div>
        <echarts
                v-loading="loading"
                element-loading-text="Loading..."
                :theme="theme"
                ref="chart"
                class="chart"
                @init="chartInit"
                :auto-resize="true"
                :options="options">
        </echarts>
        <div class="en_bottom">
            <div class="en_bottom_title position-relative">
                <div class="inlne-block page-subtitle">{{ $t("COMMON.TEXT12") }}</div>
                <div class="switch-2">
                    <span class="text-white mr-2">{{ $t("COMMON.TEXT13") }}</span>
                    <div class="inlne-block switch-1">
                        <v-switch
                                v-model="auto_switch"
                                color="success"
                                @change="autoSwitch"
                        ></v-switch>
                    </div>
                    <span class="text-white">{{ $t("COMMON.TEXT14") }}</span>
                </div>
            </div>
            <div class="en_bottom_list row">
                <div class="col-md-2 col-sm-3 text-center" v-for="field in switchFields">
                    <div class="bg-primary px-0 py-4 rounded mb-5">
                        <h6>{{field.name}}</h6>
                        <div class="text-center inlne-block">
                            <v-switch
                                    v-model="field.value"
                                    color="success"
                                    inset
                                    @change="switchChange($event, field.key)"
                            ></v-switch>
                        </div>
                    </div>
                </div>
            </div>
            <v-row v-for="field in scrollFields">
                <v-col cols="1">
                    {{field.name}}
                </v-col>
                <v-col cols="4">
                    <v-slider
                            v-model="field.value"
                            :thumb-size="24"
                            thumb-label="always"
                            @change="switchScroll($event, field.key)"
                    ></v-slider>
                </v-col>
                <v-col cols="1">
                    <v-text-field
                            v-model="field.value"
                            class="sliderinput"
                            @focus="forceScroll"
                            @blur="blurScroll"
                            @change="switchScroll($event, field.key)"
                    ></v-text-field>
                </v-col>
            </v-row>
        </div>
    </div>
</template>
<style scoped>
    .font-weight-100 {
        font-weight: 100;
    }

    .inlne-block {
        display: inline-block;
    }

    .v-application {
        display: block;
    }

    .switch-1 {
        position: relative;
        top: 3px;
    }

    .switch-2 {
        position: absolute;
        bottom: 0;
        right: 0;
    }

    .page-subtitle {
        font-size: 15px;
        line-height: 1.5;
        text-transform: uppercase;
        margin-bottom: 20px;
        margin-top: 15px;
        font-weight: bolder;
        padding-bottom: 10px;
        position: relative;
    }

    .page-subtitle:after {
        content: '';
        width: 15px;
        height: 3px;
        border-radius: 2px;
        background: #5B92FF;
        position: absolute;
        bottom: 0;
        left: 0;
    }

    .font-15 {
        font-size: 15px;
    }

    .chart {
        min-height: 300px;
    }

    .font-17 {
        font-size: 17px !important;
    }

    .sliderinput {
        position: relative;
        bottom: 20px
    }
</style>
<style>
    .v-input--switch .v-input--selection-controls__input {
        margin-right: -5px !important;
    }

    .v-input--switch__thumb.success--text {
        color: #fff !important;
    }

    .v-input--switch__track.success--text {
        background: #1fc96e !important;
        opacity: 1 !important;
    }
</style>
<script>
    export default {
        name: 'XEnvironment',
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
                auto_switch: false,
                chart: null,
                chartTitle: '',
                options: {
                    title: {
                        show: true,
                        text: this.chartTitle,
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
                        textStyle: {
                            color: '#fff'
                        }
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
                        axisLabel: {
                            textStyle: {
                                color: '#a8c5ff'
                            }
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#333333',
                                width: 1,
                                type: 'solid',
                            },
                        },

                    },
                    yAxis: {
                        type: 'value',
                        boundaryGap: [0, '100%'],
                        splitLine: {
                            show: false,
                        },
                        axisLabel: {
                            textStyle: {
                                color: '#a8c5ff'
                            }
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#333333',
                                width: 1,
                            }
                        },

                    },
                    series: [{
                        name: 'Series',
                        type: 'line',
                        showSymbol: false,
                        hoverAnimation: false,
                        data: []
                    }]
                },
                chartFields: null,
                currentField: null,
                switchFields: null,
                scrollFields: null,
                lockSwitch: false,
                lockScroll: false,
                timer: null,
                timer1: null,
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
            restartLockSwitch() {
                clearTimeout(this.timer);  //clear timer
                this.lockSwitch = true;
                this.timer = setTimeout(() => { //deny execute
                    this.lockSwitch = false;
                }, 15000); //lock switch 15 seconds
            },
            restartLockScroll() {
                clearTimeout(this.timer1);  //clear timer
                this.lockScroll = true;
                this.timer1 = setTimeout(() => { //deny execute
                    this.lockScroll = false;
                }, 15000); //lock switch 15 seconds
            },

            forceScroll() {
                console.log('forceScroll');
                this.lockScroll = true;
            },

            blurScroll() {
                console.log('blurScroll');
                this.restartLockScroll();
            },

            switchChange(val, field) {
                this.restartLockSwitch();
                var data = {"switch": {}};
                data.switch[field] = val ? 1 : 0;
                this.$emit('send', data);
            },

            autoSwitch() {
                this.restartLockSwitch();
                var data = {
                    "switch": {
                        "auto_switch": this.auto_switch ? 1 : 0
                    }
                };
                this.$emit('send', data);
            },

            switchScroll(val, field) {
                console.log('switchScroll');
                this.restartLockScroll();
                var data = {"switch": {}};
                data.switch[field] = val;
                this.$emit('send', data);
            },

            changeChart(field) {
                this.currentField = field;
                this.chartTitle = this.fields[field].name;
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
                let tempSwitchFields = [];
                let tempChartFields = [];
                let tempScrollFields = [];
                try {
                    for (let field in this.fields) {
                        if (this.fields[field].type != undefined) {
                            switch (this.fields[field].type) {
                                case 1: //FIELD_TYPE_CHART
                                case 3: //FIELD_TYPE_SCROLL
                                    if (!this.currentField) {
                                        this.currentField = field;
                                    }
                                    tempChartFields.push({
                                        'key': field,
                                        'name': this.fields[field].name != undefined ? this.fields[field].name : this.fields[field],
                                        'symbol': this.fields[field].symbol != undefined ? this.fields[field].symbol : '',
                                        'value': this.apiData[field].values.length > 0 ? this.apiData[field].values[this.apiData[field].values.length - 1].value[1] : '' //latest one data
                                    });
                                    break;
                                case 2: //switch
                                    tempSwitchFields.push({
                                        'key': field,
                                        'name': this.fields[field].name,
                                        'value': this.apiData[field] != 'offline' ? (this.apiData[field] == 1 ? true : false) : false //latest one data
                                    });
                                    break;
                                default:
                                    break;
                            }
                            if (this.fields[field].type == 3) {
                                tempScrollFields.push({
                                    'key': field,
                                    'name': this.fields[field].name != undefined ? this.fields[field].name : this.fields[field],
                                    'value': this.apiData[field].values.length > 0 ? this.apiData[field].values[this.apiData[field].values.length - 1].value[1] : '' //latest one data
                                });
                            }
                        }
                    }
                } catch (e) {
                    console.log('x-environment error:');
                    console.log(e.message);
                }
                //set fields
                if (!this.lockSwitch) {
                    this.switchFields = tempSwitchFields;
                    this.auto_switch = (this.apiData['auto_switch'] == 1 ? true : false);
                }
                if (!this.lockScroll) {
                    this.scrollFields = tempScrollFields;
                }
                this.chartFields = tempChartFields;

                //data
                this.chart.setOption({
                    series: [{
                        name: this.apiData[this.currentField].name,
                        data: this.apiData[this.currentField].values,
                        itemStyle: {
                            normal: {
                                lineStyle: {
                                    color: '#5B92FF'
                                }
                            }
                        },
                    }]
                });
            }
        },

        async mounted() {
            this.emitInit();
        }
    };
</script>
