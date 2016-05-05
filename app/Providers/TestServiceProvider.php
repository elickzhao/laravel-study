<?php

namespace App\Providers;

use App\Services\TestService;
use App\Facades\Test;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //使用singleton绑定单例
        //这是绑定的一个类的实例
        $this->app->singleton('test',function(){
           //return new TestService();
           return new Test();
        });
//这个是错的
//        $this->app->bind('Test',function(){
//            return new Test();
//        });

        //使用bind绑定实例到接口以便依赖注入
//        $this->app->bind('App\Contracts\TestContract',function(){
//           return new TestService();
//        });

        //这两种方法都可以
        //这段代码告诉容器当一个类需要TestContract的实现时将会注入TestService
        //例如: public function  __construct(TestContract $test)
        //这是绑定接口
         $this->app->bind('App\Contracts\TestContract','App\Services\TestService');
    }
}
