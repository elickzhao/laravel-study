<?php

/*
|--------------------------------------------------------------------------
| Create The Application    创建应用程序
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
| 我们要做的第一件事就是创建一个新的laravel应用实例
| 作为“胶水” 用于laravel的所有组件，并且他是为系统结合各种零件的IOC容器。
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces     绑定重要接口
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
| 接下来,我们需要绑定一些重要接口到容器,好在我们需要时使用他.
| 核心服务是从web和CLI传入到应用程序的请求
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application    返回应用程序
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
| 这个脚本返回了应用程序实例.
| 实例是调用脚本的，所以我们可以从实际运行中应用程序和发送响应,分离实例的构建。
| 大概意思从调用不同脚本可以创建不同实例吧
*/

return $app;
