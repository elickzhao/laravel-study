<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylorotwell@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader  注册自动加载器
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
| composer 为我们的应用程序提供了一个方便的、自动生成的类装载程序
| 我们只需要利用他! 我们只需简单的插入这个脚本,就不用担心以后加载我们的类了
| 这感觉太棒了.
|
*/
require __DIR__.'/../bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights  打开灯
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
| 我们需要照亮php的开发,所以让我们打开灯
| 让框架启动并随时待命,一旦应用程序加载完毕,我们就可以使用它发送响应给浏览器
| 满足用户想得到的页面.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application   运行应用程序
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
| 一旦我们得到应用程序,我们就可以通过内核处理传入的请求.
| 并且发送相关响应到客户浏览器,让他们享受我们为他们准备的创意和精彩的应用。
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
