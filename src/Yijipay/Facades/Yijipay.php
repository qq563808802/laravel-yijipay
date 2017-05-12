<?php

/*
 * This file is part of Commidity
 *
 * (c) Wangzd <wangzhoudong@foxmail.com>
 *
 */

namespace Yijipay\Yijipay\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the Commodity facade class.
 *
 * @author Wangzd <wangzhoudong@foxmail.com>
 */
class Yijipay extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    /**
     * 默认为 Server
     *
     * @return string
     */
    static public function getFacadeAccessor()
    {
        return "yijipay";
    }

    /**
     *
     * @param string $name
     * @param array  $args
     *
     * @return mixed
     */
    static public function __callStatic($name, $args)
    {
        $app = static::getFacadeRoot();

        if (method_exists($app, $name)) {
            return call_user_func_array([$app, $name], $args);
        }

        return $app->$name;
    }
}
