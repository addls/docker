<?php
return [
    //插件类型
    'type' => 'device',
    //插件名
    'name' => '监控插件',
    //插件描述
    'description' => 'System device',
    //版本号
    'version' => '1.0.0',
    //作者
    'author' => '',
    //邮箱
    'email' => '',
    //图表组件
    'widgets' => [
        //唯一标识: Camera:live
        'live' => [
            //图表名
            'name' => '监控',
            //图表描述
            'description' => '摄像头监控',
            //处理类
            'class' => App\Extensions\Camera\Actions\Live::class,
            //缩略图
            'thumbnail' => '/icon.png',
            'template' => 'live',
            //数据字段名
            'fields' => [
                "rtmp" => [
                    'name' => '推流地址',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_ADDRESS,
                ],
            ],
        ]
    ]
];
