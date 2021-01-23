<?php
return [
    //插件类型
    'type' => 'device',
    //插件名
    'name' => '开关',
    //插件描述
    'description' => 'Switch button',
    //版本号
    'version' => '1.0.0',
    //作者
    'author' => '',
    //邮箱
    'email' => '',
    //图表组件
    'widgets' => [
        //唯一标识: switch:button
        'button' => [
            //图表名
            'name' => '开关',
            //图表描述
            'description' => '开关',
            //处理类
            'class' => \App\Extensions\SwitchButton\Actions\Button::class,
            //缩略图
            'thumbnail' => '/switch.png',
            'template' => 'x_switch', // prefix with "x_" is system template
            //数据字段名
            'fields' => [
                "enable" => '开关'
            ],
        ]
    ]
];
