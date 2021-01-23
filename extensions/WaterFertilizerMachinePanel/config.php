<?php
return [
    //插件类型
    'type' => 'device',
    //插件名
    'name' => '水肥控制板卡',
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
        'normal' => [
            //图表名
            'name' => '水肥',
            //图表描述
            'description' => '水肥面板',
            //处理类
            'class' => \App\Extensions\EnvironmentPanel\Actions\Normal::class,
            //缩略图
            'thumbnail' => '/icon.png',
            'template' => 'EnvironmentPanel:environment',
            //数据字段名
            'fields' => [
                "liquid_level1" => [
                    'name' => '液位1',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_LIQUID,
                    'symbol' => 'cm'
                ],
                "liquid_level2" => [
                    'name' => '液位2',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_LIQUID,
                    'symbol' => 'cm'
                ],
                "liquid_level3" => [
                    'name' => '液位3',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_LIQUID,
                    'symbol' => 'cm'
                ],
                "liquid_level4" => [
                    'name' => '液位4',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_LIQUID,
                    'symbol' => 'cm'
                ],
                "liquid_level5" => [
                    'name' => '液位5',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_LIQUID,
                    'symbol' => 'cm'
                ],
                "water_pressure" => [
                    'name' => '水压',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_CHART,
                    'symbol' => 'Pa'
                ],
                "dissolved_oxygen" => [
                    'name' => '溶解氧',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_CHART,
                    'symbol' => ''
                ],
                "ph" => [
                    'name' => 'PH传感器',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_CHART,
                    'symbol' => ''
                ],
                "ec" => [
                    'name' => 'EC电传导',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_CHART,
                    'symbol' => ''
                ],
                "peristaltic_pump1" => [
                    'name' => '蠕动泵1',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SCROLL,
                    'symbol' => ''
                ],
                "peristaltic_pump2" => [
                    'name' => '蠕动泵2',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SCROLL,
                    'symbol' => ''
                ],
                "peristaltic_pump3" => [
                    'name' => '蠕动泵3',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SCROLL,
                    'symbol' => ''
                ],
                "peristaltic_pump4" => [
                    'name' => '蠕动泵4',
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SCROLL,
                    'symbol' => ''
                ],
                "solenoid_valve1" => [
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH,
                    'name' => '电磁阀1'
                ],
                "solenoid_valve2" => [
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH,
                    'name' => '电磁阀2'
                ],
                "solenoid_valve3" => [
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH,
                    'name' => '电磁阀3'
                ],
                "solenoid_valve4" => [
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH,
                    'name' => '电磁阀4'
                ],
                "solenoid_valve5" => [
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH,
                    'name' => '电磁阀5'
                ],
                "solenoid_valve6" => [
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH,
                    'name' => '电磁阀6'
                ],
                "metering_pump1" => [
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH,
                    'name' => '计量泵1'
                ],
                "metering_pump2" => [
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH,
                    'name' => '计量泵2'
                ],
                "metering_pump3" => [
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH,
                    'name' => '计量泵3'
                ],
                "metering_pump4" => [
                    'type' => \App\Extensions\BaseClass::FIELD_TYPE_SWITCH,
                    'name' => '计量泵4'
                ],
                "auto_switch" => [
                    'type' => 'auto_switch',
                    'name' => '自动开关'
                ],
                "lora_restart" => [
                    'type' => 'lora_restart',
                    'name' => '水肥LORA模板复位'
                ],
            ],
        ]
    ]
];
