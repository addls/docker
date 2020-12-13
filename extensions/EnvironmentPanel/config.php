<?php
return [
    //插件类型
    'type' => \App\Extensions\BaseClass::WIDGET_TYPE_PANEL,
    //插件名
    'name' => '环境控制板卡',
    //插件描述
    'description' => 'System panel',
    //版本号
    'version' => '1.0.0',
    //作者
    'author' => '',
    //邮箱
    'email' => '',
    //图表组件
    'widgets' => [
        //唯一标识: environmentpanel:normal
        'normal' => [
            //图表名
            'name' => '环境',
            //图表描述
            'description' => '环境面板',
            //处理类
            'class' => \App\Extensions\EnvironmentPanel\Actions\Normal::class,
            //缩略图
            'thumbnail' => '/icon.png',
            'template' => 'environment',
            //数据字段名
            'fields' => [
                "temp" => [
                    'name' => '温度',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_CHART,
                    'symbol' => '℃'
                ],
                "hum" => [
                    'name' => '湿度',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_CHART,
                    'symbol' => '%'
                ],
                "lux" => [
                    'name' => '光照度',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_CHART,
                ],
                "c02" => [
                    'name' => '二氧化碳',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_CHART,
                ],
                "sw_m" => [
                    'name' => '主控制状态',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_STATUS,
                ],
                "sw_sb" => [
                    'name' => '水泵控制状态',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_STATUS,
                ],
                "sw_zyw1" => [
                    'name' => '遮阳网1控制状态',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_STATUS,
                ],
                "sw_zyw2" => [
                    'name' => '遮阳网2控制状态',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_STATUS,
                ],
                "sw_zyw3" => [
                    'name' => '遮阳网3控制状态',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_STATUS,
                ],
                "sw_zyw4" => [
                    'name' => '遮阳网4控制状态',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_STATUS,
                ],
                "sw_zyw5" => [
                    'name' => '遮阳网5控制状态',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_STATUS,
                ],
                "sw_fsl1" => [
                    'name' => '风水帘1控制状态',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_STATUS,
                ],
                "sw_fsl2" => [
                    'name' => '风水帘2控制状态',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_STATUS,
                ],
                "sw_fsl3" => [
                    'name' => '风水帘3控制状态',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_STATUS,
                ],
                "sw_fsl4" => [
                    'name' => '风水帘4控制状态',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_STATUS,
                ],
                "sw_fsl5" => [
                    'name' => '风水帘5控制状态',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_STATUS,
                ],
                "sw_fsl6" => [
                    'name' => '风水帘6控制状态',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_STATUS,
                ],
                "sw_fsl7" => [
                    'name' => '风水帘7控制状态',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_STATUS,
                ],
                "jcq_sb" => [
                    'name' => '水泵',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_zyw1p" => [
                    'name' => '遮阳网1(正转)',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_zyw2p" => [
                    'name' => '遮阳网2(正转)',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_zyw3p" => [
                    'name' => '遮阳网3(正转)',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_zyw4p" => [
                    'name' => '遮阳网4(正转)',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_zyw5p" => [
                    'name' => '遮阳网5(正转)',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_zyw1n" => [
                    'name' => '遮阳网1(反转)',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_zyw2n" => [
                    'name' => '遮阳网2(反转)',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_zyw3n" => [
                    'name' => '遮阳网3(反转)',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_zyw4n" => [
                    'name' => '遮阳网4(反转)',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_zyw5n" => [
                    'name' => '遮阳网5(反转)',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_fsl1" => [
                    'name' => '风水帘1',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_fsl2" => [
                    'name' => '风水帘2',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_fsl3" => [
                    'name' => '风水帘3',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_fsl4" => [
                    'name' => '风水帘4',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_fsl5" => [
                    'name' => '风水帘5',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_fsl6" => [
                    'name' => '风水帘6',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ],
                "jcq_fsl7" => [
                    'name' => '风水帘7',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH
                ]
            ],
        ]
    ]
];
