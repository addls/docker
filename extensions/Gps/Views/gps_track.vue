<template>
    <div class="amap-page-container">
        <el-amap vid="amap" :zoom="zoom" :center="center" class="amap-demo">
            <el-amap-polyline :editable="polyline.editable" :path="polyline.path" :events="polyline.events"></el-amap-polyline>
            <el-amap-marker v-for="(marker, index) in markers" :position="marker.position" :icon="marker.icon" :vid="index"></el-amap-marker>
        </el-amap>
    </div>
</template>
<style scoped>
    .amap-demo {
        height: 500px;
    }
</style>
<script>
    export default {
        name: 'XGpsTrack',
        props: {
            loading: {
                type: Boolean,
                default: true,
            },
            apiData: {
                type: Array,
                default() {
                    return [];
                },
            },
            title: {
                type: String,
                default: '',
            }
        },
        data() {
            return {
                map: "",
                marker: [],
                zoom: 17,
                center: [116.478935, 39.997761],
                polyline: {
                    path: [],
                    events: {
                        click(e) {
                            alert('click polyline');
                        },
                        end: (e) => {
                            let newPath = e.target.getPath().map(point => [point.lng, point.lat]);
                            console.log(newPath);
                        }
                    },
                    editable: false
                },
                markers:[
                    {
                        position:[116.478935, 39.997761],
                        icon:'media/logos/strat.png'
                    },
                    {
                        position:[116.478935, 39.987761],
                        icon:'media/logos/end.png'
                    }
                ],
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
            }
        },
        methods: {
            /**
             * init chart
             */
            initChart() {
                console.log('Trajectory data');
                console.log(this.apiData);
                if (this.apiData.length > 0) {
                    //set path
                    var datass = this.apiData;
                    var dataarr = [];
                    for(var t=0;t<datass.length;t++) {
                        dataarr.push([Number(datass[t][0]), Number(datass[t][1])]);
                    }
                    this.polyline.path = JSON.parse(JSON.stringify(dataarr));
                    //set center
                    // if(this.apiData[0] !== undefined){
                    //     this.center = this.apiData[0];
                    // }

                    // Icon positioning assignment for the start and end points
                    this.center = JSON.parse(JSON.stringify(dataarr[0]));
                    this.markers[0]['position'] = JSON.parse(JSON.stringify(dataarr[0]));
                    var len = Number(JSON.parse(JSON.stringify(dataarr)).length - 1);
                    this.markers[1]['position'] = JSON.parse(JSON.stringify(dataarr[len]));
                } else {
                    this.polyline.path = [[116.478935, 39.997761]];
                }
            }

        },
        async mounted() {
        }
    };
</script>
