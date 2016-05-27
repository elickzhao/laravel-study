<?php

namespace Illuminate\Contracts\Http;

interface Kernel
{
    /**
     * Bootstrap the application for HTTP requests.
     * 启动关于HTTP请求的应用程序
     *
     * @return void
     */
    public function bootstrap();

    /**
     * Handle an incoming HTTP request.
     * 处理一个HTTP请求
     *
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request);

    /**
     * Perform any final actions for the request lifecycle.
     * 为请求生命周期执行最后的动作
     *
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return void
     */
    public function terminate($request, $response);

    /**
     * Get the Laravel application instance.
     * 得到一个Laravael应用程序实例
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function getApplication();
}
