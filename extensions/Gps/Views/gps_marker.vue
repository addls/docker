<template>
    <div class="amap-page-container">
        <div class="amap-wrapper">
            <el-amap class="amap-box" :vid="'amap-vue'" :center="center">
                <el-amap-marker v-for="(marker, index) in markers" :position="marker.position" :vid="index"></el-amap-marker>
            </el-amap>
        </div>
        <div class="mt-2 map-con">
            <div class="map-con-top bg-white rounded px-5 py-3 ">
                <div class="map-con-top-title">
                    <span class="mr-8 font-size-15">
                        <span class="svg-icon svg-icon-md svg-icon-primary">
                          <!--begin::Svg Icon-->
                          <inline-svg
                                  src="media/svg/icons/Map/Marker1.svg"
                          ></inline-svg>
                            <!--end::Svg Icon-->
                        </span>
                        {{real.city}}
                    </span>
                    <span class="mr-8 font-size-15">
                        <span class="svg-icon svg-icon-md svg-icon-primary">
                          <!--begin::Svg Icon-->
                          <inline-svg
                                  src="media/svg/icons/Weather/Temperature-half.svg"
                          ></inline-svg>
                            <!--end::Svg Icon-->
                        </span>
                        {{real.temperature}}℃
                    </span>
                    <span class="mr-8 font-size-15">
                        <span class="svg-icon svg-icon-md svg-icon-primary">
                          <!--begin::Svg Icon-->
                          <inline-svg
                                  src="media/svg/icons/Weather/Temperature-full.svg"
                          ></inline-svg>
                            <!--end::Svg Icon-->
                        </span>
                        {{real.humidity}}%rh
                    </span>
                    <span class="float-right pointer isopen" @click="isOpen">{{isopen}}</span>
                </div>
                <div id="weather-box" class="map-con-top-con weather-box mt-5">
                    <div class="weather-item" v-for="v in casts">
                        <div class="mb-3">{{v.date}}</div>
                        <div class="mb-3">
                            <span class="svg-icon svg-icon-md svg-icon-primary">
                                <inline-svg
                                        v-if="v.dayweather == '雨' || v.dayweather == '阵雨' || v.dayweather == '雷阵雨并伴有冰雹' || v.dayweather == '小于' || v.dayweather == '中雨' || v.dayweather == '大雨' || v.dayweather == '暴雨' || v.dayweather == '大暴雨' || v.dayweather == '特大暴雨' || v.dayweather == '强阵雨' || v.dayweather == '强雷阵雨' || v.dayweather == '极端降雨' || v.dayweather == '毛毛雨/细雨' || v.dayweather == '小雨-中雨' || v.dayweather == '中雨-大雨' || v.dayweather == '大雨-暴雨' || v.dayweather == '暴雨-大暴雨' || v.dayweather == '大暴雨-特大暴雨'"
                                        src="media/svg/icons/Weather/Rain1.svg"
                                ></inline-svg>
                                <inline-svg v-else-if="v.dayweather == '晴'"
                                            src="media/svg/icons/Weather/Sun.svg"
                                ></inline-svg>
                                <inline-svg v-else-if="v.dayweather == '雷阵雨'"
                                            src="media/svg/icons/Weather/Thunder.svg"
                                ></inline-svg>
                                <inline-svg
                                        v-else-if="v.dayweather == '雪' || v.dayweather == '阵雪' || v.dayweather == '小雪' || v.dayweather == '中雪' || v.dayweather == '大雪' || v.dayweather == '暴雪' || v.dayweather == '小雪-中雪' || v.dayweather == '中雪-大雪' || v.dayweather == '大雪转暴雪'"
                                        src="media/svg/icons/Weather/Snow1.svg"
                                ></inline-svg>
                                <inline-svg v-else-if="v.dayweather == '晴间多云'"
                                            src="media/svg/icons/Weather/Cloud-sun.svg"
                                ></inline-svg>
                                <inline-svg
                                        v-else-if="v.dayweather == '有风' || v.dayweather == '平静' || v.dayweather == '微风' || v.dayweather == '和风' || v.dayweather == '清风' || v.dayweather == '强风/劲风' || v.dayweather == '大风' || v.dayweather == '烈风'"
                                        src="media/svg/icons/Weather/Cloud-wind.svg"
                                ></inline-svg>
                                <inline-svg v-else-if="v.dayweather == '多云'"
                                            src="media/svg/icons/Weather/Cloudy.svg"
                                ></inline-svg>
                                <inline-svg v-else-if="v.dayweather == '雾' || v.dayweather == '浓雾' || v.dayweather == '强浓雾' || v.dayweather == '轻雾' || v.dayweather == '大雾' || v.dayweather == '特强浓雾'"
                                            src="media/svg/icons/Weather/Fog.svg"
                                ></inline-svg>
                                <inline-svg v-else="v.dayweather == '多云' || v.dayweather == '阴' || v.dayweather == '少云'"
                                            src="media/svg/icons/Weather/Cloud1.svg"
                                ></inline-svg>
                            </span>
                        </div>
                        <div class="mb-3">{{v.dayweather}}</div>
                        <div class="mb-3">{{v.daytemp}}℃</div>
                        <div class="mb-3 font-size-xs color-999">{{v.nighttemp}}℃</div>
                    </div>
                </div>
            </div>
            <div class="map-con-middle mt-2 bg-white rounded px-5 py-3" v-show="isShow">
                <div class="map-con-middle-title">
                    <span class="map-con-middle-titles">{{ $t("COMMON.TEXT20") }}</span>
                    <span class="float-right equipmentid">{{number}}</span>
                </div>
                <div class="map-con-middle-content row width-100">
                    <div class="col-4 text-center">
                        <div class=" mb-2">{{real.gz}} lux</div>
                        <div class="font-size-xs color-999">{{ $t("COMMON.TEXT21") }}</div>
                    </div>
                    <div class="col-4 col-sm-4 text-center">
                        <div class=" mb-2">{{real.cot}} PPM</div>
                        <div class="font-size-xs color-999">{{ $t("COMMON.TEXT22") }}</div>
                    </div>
                    <div class="col-4 col-sm-4 text-center">
                        <div class=" mb-2">{{real.windpower}}</div>
                        <div class="font-size-xs color-999">{{ $t("COMMON.TEXT23") }}</div>
                    </div>
                    <div class="col-4 col-sm-4 text-center">
                        <div class=" mb-2">{{real.temperature}} ℃</div>
                        <div class="font-size-xs color-999">{{ $t("COMMON.TEXT24") }}</div>
                    </div>
                    <div class="col-4 col-sm-4 text-center">
                        <div class=" mb-2">{{real.humidity}}% rh</div>
                        <div class="font-size-xs color-999">{{ $t("COMMON.TEXT25") }}</div>
                    </div>
                    <div class="col-4 col-sm-4 text-center">
                        <div class=" mb-2">{{real.pm}}</div>
                        <div class="font-size-xs color-999">PM2.5</div>
                    </div>
                </div>
            </div>
            <div class="map-con-bottom mt-2 bg-white rounded px-5 py-3" v-show="isShow">
                <div class="map-con-middle-title">
                    <span class="map-con-middle-titles">{{ $t("COMMON.TEXT26") }}</span>
                    <span class="svg-icon svg-icon-md svg-icon-primary float-right pointer ml-2 addsoilbtn" @click="addSoilData">
                      <!--begin::Svg Icon-->
                      <inline-svg
                              src="media/svg/icons/Code/Plus.svg"
                      ></inline-svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="float-right equipmentid">{{number}}</span>
                </div>
                <div class="map-con-middle-content row width-100">
                    <div class="col-4 text-center">
                        <div class=" mb-2">{{soilobj.nitrogen}} %</div>
                        <div class="font-size-xs color-999">{{ $t("COMMON.TEXT27") }}</div>
                    </div>
                    <div class="col-4 text-center">
                        <div class=" mb-2">{{soilobj.temperature}} ℃</div>
                        <div class="font-size-xs color-999">{{ $t("COMMON.TEXT28") }}</div>
                    </div>
                    <div class="col-4 text-center">
                        <div class=" mb-2">{{soilobj.humidity}} %</div>
                        <div class="font-size-xs color-999">{{ $t("COMMON.TEXT29") }}</div>
                    </div>
                </div>
                <div class="position-relative">
                    {{ $t("COMMON.TEXT31") }}：<input type="text" v-model="frequency" class="xs-input no-input" />
                    <button @click="setFrequency" class="float-right pointer">{{ $t("COMMON.TEXT30") }}</button>
                </div>
            </div>
        </div>

        <!--添加土壤数据模态框-->
        <v-dialog v-model="dialog" max-width="500px" append-to-body="true">
            <v-form
                    ref="form"
                    v-model="valid"
                    lazy-validation
                    @submit.stop.prevent="onSubmit"
            >
                <v-card class="card">
                    <v-card-title>
                        <h5 class="headline text-white">{{ $t("COMMON.TEXT32") }}</h5>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-text-field
                                        label="Id"
                                        v-show="false"
                                ></v-text-field>
                                <v-col cols="4" class="v-middle-80">
                                    {{ $t("COMMON.TEXT27") }}：
                                </v-col>
                                <v-col cols="8">
                                    <v-text-field
                                            v-model="nitrogen"
                                            label="nitrogen"
                                            type="number"
                                            min="0"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="4" class="v-middle-80">
                                    {{ $t("COMMON.TEXT28") }}：
                                </v-col>
                                <v-col cols="8">
                                    <v-text-field
                                            v-model="temperature"
                                            label="temperature"
                                            type="number"
                                            min="0"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="4" class="v-middle-80">
                                    {{ $t("COMMON.TEXT29") }}：
                                </v-col>
                                <v-col cols="8">
                                    <v-text-field
                                            v-model="humidity"
                                            label="humidity"
                                            type="number"
                                            min="0"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="close">{{ $t("COMMON.CANCEL") }}</v-btn>
                        <v-btn color="blue darken-1" text @click="onSubmit">{{ $t("COMMON.SAVE") }}</v-btn>
                    </v-card-actions>
                </v-card>
            </v-form>
        </v-dialog>

        <!--设置频率数据模态框-->
        <v-dialog v-model="fdialog" max-width="500px" append-to-body="true">
            <v-form
                    ref="form"
                    v-model="valid"
                    lazy-validation
                    @submit.stop.prevent="onFrequencySubmit"
            >
                <v-card class="card">
                    <v-card-title>
                        <h5 class="headline text-white">{{ $t("COMMON.TEXT33") }}</h5>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-text-field
                                        label="Id"
                                        v-show="false"
                                ></v-text-field>
                                <div class="text-title">{{ $t("COMMON.TEXT31") }}：</div>
                                <v-col cols="12" class="col-px-0" >
                                    <v-text-field
                                            v-model="frequency"
                                            label="frequency"
                                            type="number"
                                            min="0"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn class="canclebtn" text @click="frequencyClose">{{ $t("COMMON.CANCEL") }}</v-btn>
                        <v-btn class="confbtn" text @click="onFrequencySubmit">{{ $t("COMMON.SAVE") }}</v-btn>
                    </v-card-actions>
                </v-card>
            </v-form>
        </v-dialog>
    </div>
</template>
<style scoped>
    .map-con-top-title,.map-con-middle-title{position: relative;}
    .amap-wrapper {
        width: 100%;
        height: 200px;
    }

    .amap-page-container .bg-white {
        background: #fff !important;
    }

    .font-size-15 {
        font-size: 15px;
        font-weight: bolder;
        color: #4a4747
    }

    .weather-box {
        display: flex;
    }

    .weather-item {
        flex: 1;
        text-align: center;
    }

    .map-con-middle-titles {
        font-size: 16px;
        color: #1da1f2;
        padding-left: 8px;
        border-left: 2px solid #1da1f2;
    }

    .equipmentid {
        height: 25px;
        line-height: 25px;
    }

    .color-999 {
        color: #999;
    }

    .font-16 {
        font-size: 16px;
    }

    .pointer:hover {
        color: #1da1f2;
    }

    .row {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }
    @media(max-width: 768px){
        .xs-input{max-width: 30px;}
        .font-size-15{font-size: unset !important;}
        .isopen{position: absolute;right: 0;}
        .addsoilbtn{margin-left: 8px !important;}
    }

</style>
<script>
    import {LOGIN, LOGOUT} from "@/core/services/store/auth.module";
    import AUTH from "@/core/services/store/auth.module";
    import ApiService from "@/core/services/api.service";

    export default {
        name: 'XGpsMarker',
        props: {
            loading: {
                type: Boolean,
                default: true,
            },
            apiData: {
                type: Object
            },
            title: {
                type: String,
                default: '',
            }
        },
        data() {
            const self = this;
            return {
                fdialog:false,
                isShow: true,
                isopen: '收起',
                markers: [],
                real: {},
                casts: [],
                soilobj: {},
                dialog: false,
                valid: true,
                nitrogen: '',
                temperature: '',
                humidity: '',
                number: '001',
                frequency: 1,
                center:[116.397128, 39.916527],
            }
        },
        components: {},
        computed: {},
        watch: {
            apiData: {
                immediate: true,
                handler(val, oldVal) {
                    var _this = this;
                    if (!_this.loading) {
                        _this.initChart();
                        _this.getWeather();
                    }
                },
            }
        },
        methods: {
            /**
             * init chart
             */
            initChart() {
                if (this.apiData) {
                    console.log('Coordinate soil data');
                    console.log(this.apiData);
                    var positionarr = this.apiData.coordinate;
                    if (positionarr.length) {
                        for (var i = 0; i < positionarr.length; i++) {
                            positionarr[i].position = [Number(positionarr[i]['longitude']), Number(positionarr[i]['latitude'])];
                        }
                        this.markers = positionarr;
                        console.log(positionarr[0]['position']);
                        this.center = positionarr[0]['position'];
                    }

                    //土壤数据
                    this.soilobj = {
                        nitrogen: this.apiData.soil.nitrogen,
                        temperature: this.apiData.soil.temperature,
                        humidity: this.apiData.soil.humidity,
                    };
                    this.number = this.apiData.number;
                    if (this.apiData.temperature) {
                        this.real.temperature = this.apiData.temperature;
                    }
                    this.isShow = (this.apiData.assets_total > 1) ? false : true;
                    this.frequency = this.apiData.frequency;
                }
            },
            isOpen() {
                if (this.isopen == '收起') {
                    this.isopen = '展开';
                    var weatherbox = document.getElementById('weather-box').style.display = 'none';
                } else {
                    this.isopen = '收起';
                    var weatherbox = document.getElementById('weather-box').style.display = 'flex';
                }
            },

            getWeather() {
                var logt = this.center[0]+','+this.center[1];
                ApiService.get(AUTH.local_url + "/amap/index?"+ "logt="+logt)
                    .then(({data}) => {
                        console.log('Weather data');
                        console.log(data);
                        if (data.status == 1) {
                            this.real = data.real;
                            this.casts = data.forecasts[0].casts;
                        } else if (data.status == 0) {
                            this.$store
                                .dispatch(LOGOUT)
                                .then(() => this.$router.push({name: "login"}));
                        } else {

                        }
                    });
            },

            addSoilData() {
                this.dialog = true;
            },

            onSubmit() {
                this.dialog = false;

                //Push message data to the server and store it in kv
                this.$emit('send', {
                    soil_nitrogen: this.nitrogen,
                    soil_temperature: this.temperature,
                    soil_humidity: this.humidity,
                });

                //clear
                this.nitrogen = '';
                this.temperature = '';
                this.humidity = '';

            },

            setFrequency(){
                this.fdialog=true;
                this.$emit('send', {
                    frequency: this.frequency,
                });
            },

            close() {
                this.dialog = false;
            },
            frequencyClose() {
                this.fdialog = false;
            },

            onFrequencySubmit() {
                this.fdialog = false;
            }
        },
        async mounted() {
        }
    };
</script>
