<?php
return [
    //插件类型
    'type' => 'app',
    //插件名
    'name' => 'GPS传感器',
    //插件描述
    'description' => 'GPS sensor',
    //版本号
    'version' => '1.0.0',
    //作者
    'author' => '',
    //邮箱
    'email' => '',
    //图表组件
    'widgets' => [
        //唯一标识: gps:marker
        'marker' => [
            //图表名
            'name' => '标记点',
            //图表描述
            'description' => '标记点',
            //处理类
            'class' => \App\Extensions\Gps\Actions\Marker::class,
            //缩略图
            'thumbnail' => '/gps.png',
            'template' => 'gps_marker',
            //数据字段名
            'fields' => [
                "temperature" => '温度',
                "longitude" => '经度',
                "latitude" => '纬度'
            ],
        ],
        //唯一标识: gps:track
        'track' => [
            //图表名
            'name' => '轨迹',
            //图表描述
            'description' => '轨迹',
            //处理类
            'class' => \App\Extensions\Gps\Actions\Track::class,
            //缩略图
            'thumbnail' => '/gps.png',
            'template' => 'gps_track'
        ],
    ]
];
