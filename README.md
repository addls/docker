### 产品介绍

- 面向快速实施的物联网方案开发与共享平台，以简单、快速、美观、通用为特点。
- 技术研发人员可以快速构建应用，并将业务打包分发给世界各地的用户以获取收入。
- 对业务人员而言，ThingsPanel不用写代码，一整套方案开箱即用。业务交付时间是传统的物联网方案的30%以下。成本也大幅度降低。
- 可广泛应用于交通、医疗、消费、家居、消防、安防、工业、农业等各个领域。

### 产品截图
![可视化界面截图](https://raw.githubusercontent.com/universe-hsh/assets/master/images/demo.png "Thingspanel-Dashboard.png")

### 功能结构图

![功能结构图](https://raw.githubusercontent.com/universe-hsh/assets/master/images/structure.png "structure.png")

## 目录说明

```
├── conf (配置文件目录)
│   ├── core (系统配置)
│   ├── vue (前端配置)
├── data
│   └── rabbitmq (rabbitmq数据目录)
│   └── timescaledb (timescaledb数据库)
│   ├── core (运行日志)
├── logs
│   ├── core (运行日志)
│   └── nginx (nginx log文件目录)
│   └── supervisor (log文件目录)
└── entensions (插件目录)
└── .env (docker配置)
```

## 如何使用？

进入到项目根目录直接执行以下命令即可启动

生产模式: `docker-compose up -d`

开发模式: `docker-compose --env-file .env.dev up`

## 如何进入容器

第一种方法: 

```bash
# 查看所有容器
docker ps -a
# 进入容器
docker exec -it thingspanel-xxx bash
```

## 前台访问
`http://127.0.0.1`

默认登录账号：admin@protonmail.com 密码：admin@protonmail.com

## 数据推送
MQTT Port: 1883\
TCP Port: 9505

示例格式：
```json
{
    "token":"设备编号", //设备唯一标识符, 从业务后台生成
    "ts":1451649600512, //可选，单位毫秒
    "values":{
        "temperature": "30", //温度
        "humidity": "85" //湿度
        ... 更多参数
    }
}
```
