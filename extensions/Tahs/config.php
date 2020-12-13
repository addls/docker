<?php
return [
    //插件类型
    'type' => 'device',
    //插件名
    'name' => '温湿度传感器',
    //插件描述
    'description' => '温湿度传感器 Temperature and humidity sensor',
    //版本号
    'version' => '1.0.0',
    //作者
    'author' => '',
    //邮箱
    'email' => '',
    //图表组件
    'widgets' => [
        //唯一标识: tahs:current_temperature
        'current_temperature' => [
            //图表名
            'name' => '温度',
            //图表描述
            'description' => '温度',
            //处理类
            'class' => \App\Extensions\Tahs\Actions\CurrentTemperature::class,
            //缩略图
            'thumbnail' => '/temperature.png',
            'template' => 'x_time',
            //数据字段名
            'fields' => [
                "temperature" => '温度'
            ],
        ],
        //唯一标识: tahs:humidity
        'humidity' => [
            //图表名
            'name' => '湿度',
            //图表描述
            'description' => '湿度',
            //处理类
            'class' => \App\Extensions\Tahs\Actions\Humidity::class,
            //缩略图
            'thumbnail' => '/temperature.png',
            'template' => 'x_time',
            //数据字段名
            'fields' => [
                "humidity" => '湿度'
            ],
        ],
        //唯一标识: tahs:illuminance
        'illuminance' => [
            //图表名
            'name' => '光照度',
            //图表描述
            'description' => '光照度',
            //处理类
            'class' => \App\Extensions\Tahs\Actions\Illuminance::class,
            //缩略图
            'thumbnail' => '/temperature.png',
            'template' => 'x_time',
            //数据字段名
            'fields' => [
                "Illuminance" => '光照度'
            ],
        ],
        //唯一标识: tahs:ec
        'ec' => [
            //图表名
            'name' => '电传导',
            //图表描述
            'description' => '电传导',
            //处理类
            'class' => \App\Extensions\Tahs\Actions\Ec::class,
            //缩略图
            'thumbnail' => '/temperature.png',
            'template' => 'x_time',
            //数据字段名
            'fields' => [
                "ec" => '电传导'
            ],
        ],
        //唯一标识: tahs:ph
        'ph' => [
            //图表名
            'name' => 'ph传感器',
            //图表描述
            'description' => 'ph传感器',
            //处理类
            'class' => \App\Extensions\Tahs\Actions\Ph::class,
            //缩略图
            'thumbnail' => '/temperature.png',
            'template' => 'x_time',
            //数据字段名
            'fields' => [
                "ph" => 'ph传感器'
            ],
        ],
        //唯一标识: tahs:liquid_level
        'liquid_level' => [
            //图表名
            'name' => '液位',
            //图表描述
            'description' => '液位',
            //处理类
            'class' => \App\Extensions\Tahs\Actions\LiquidLevel::class,
            //缩略图
            'thumbnail' => '/temperature.png',
            'template' => 'x_time',
            //数据字段名
            'fields' => [
                "liquid_level" => '液位'
            ],
        ],
        //唯一标识: tahs:liquid_level_two
        'liquid_level_two' => [
            //图表名
            'name' => '液位2',
            //图表描述
            'description' => '液位2',
            //处理类
            'class' => \App\Extensions\Tahs\Actions\LiquidLevelTwo::class,
            //缩略图
            'thumbnail' => '/temperature.png',
            'template' => 'x_time',
            //数据字段名
            'fields' => [
                "liquid_level_two" => '液位2'
            ],
        ],
        //唯一标识: tahs:liquid_level_three
        'liquid_level_three' => [
            //图表名
            'name' => '液位3',
            //图表描述
            'description' => '液位3',
            //处理类
            'class' => \App\Extensions\Tahs\Actions\LiquidLevelThree::class,
            //缩略图
            'thumbnail' => '/temperature.png',
            'template' => 'x_time',
            //数据字段名
            'fields' => [
                "liquid_level_three" => '液位3'
            ],
        ],
        //唯一标识: tahs:liquid_level_four
        'liquid_level_four' => [
            //图表名
            'name' => '液位4',
            //图表描述
            'description' => '液位4',
            //处理类
            'class' => \App\Extensions\Tahs\Actions\LiquidLevelFour::class,
            //缩略图
            'thumbnail' => '/temperature.png',
            'template' => 'x_time',
            //数据字段名
            'fields' => [
                "liquid_level_four" => '液位4'
            ],
        ],
        //唯一标识: tahs:liquid_level_five
        'liquid_level_five' => [
            //图表名
            'name' => '液位5',
            //图表描述
            'description' => '液位5',
            //处理类
            'class' => \App\Extensions\Tahs\Actions\LiquidLevelFive::class,
            //缩略图
            'thumbnail' => '/temperature.png',
            'template' => 'x_time',
            //数据字段名
            'fields' => [
                "liquid_level_five" => '液位5'
            ],
        ],
        //唯一标识: tahs:water_pressure
        'water_pressure' => [
            //图表名
            'name' => '水压',
            //图表描述
            'description' => '水压',
            //处理类
            'class' => \App\Extensions\Tahs\Actions\WaterPressure::class,
            //缩略图
            'thumbnail' => '/temperature.png',
            'template' => 'x_time',
            //数据字段名
            'fields' => [
                "water_pressure" => '水压'
            ],
        ],
        //唯一标识: tahs:dissolved_oxygen
        'dissolved_oxygen' => [
            //图表名
            'name' => '溶解氧',
            //图表描述
            'description' => '溶解氧',
            //处理类
            'class' => \App\Extensions\Tahs\Actions\DissolvedOxygen::class,
            //缩略图
            'thumbnail' => '/temperature.png',
            'template' => 'x_time',
            //数据字段名
            'fields' => [
                "dissolved_oxygen" => '溶解氧'
            ],
        ],
    ]
];
