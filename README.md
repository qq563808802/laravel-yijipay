# 易极付laravel



## 概述

易极付支付所有业务支撑

## 运行环境
- PHP 5.5+
- cURL extension

提示：

- Ubuntu下可以使用apt-get包管理器安装php的cURL扩展 `sudo apt-get install php5-curl`

## 安装方法

1. 如果您通过composer管理您的项目依赖，可以在你的项目根目录运行：

        $composer require yijipay/laravel-yijipay

   或者在你的`composer.json`中声明对yijipay/laravel-yijipay for PHP的依赖：

        "require": {
            "yijipay/laravel-yijipay": "~1.0"
        }

   然后通过`composer install`安装依赖。composer安装完成后，在您的PHP代码中引入依赖即可：

        require_once __DIR__ . '/vendor/autoload.php';


3. 下载SDK源码，在您的代码中引入SDK目录下的`autoload.php`文件：

        require_once '/path/to/yijipay/autoload.php';
## 配置

### Laravel应用
1. 注册 `ServiceProvider`:
```php
   Yijipay\Yijipay\YijipayServiceProvider::class,
```

2. 创建配置和迁移文件
```shell
php artisan vendor:publish
```

3. 可以选择修改根目录下的`config/yijipay.php`中对应的修改设置

4. 执行迁移命令,生成数据表
```shell
php artisan migrate
```

5.添加门面到`config/app.php`中的`aliases`部分:
```php
'Yijipay' => Yijipay\Yijipay\Facades\Yijipay::class,
```

### Lumen应用

1. 在`bootstrap/app.php`的 `82` 行左右:
```php
$app->register(Yijipay\Yijipay\YijipayServiceProvider::class,);
```

```
## 快速使用

### 创建支付
    app('yijipay')->pay->add($post)
###查询支付
     app('yijipay')->pay->query($orderNo)

###转账
     app('yijipay')->transfer->add($params);