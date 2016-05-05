<?php namespace Jai\Contact;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class ContactServiceProvider extends ServiceProvider
{
    protected $defer = false;
    public function boot()
    {
        //注册模版地址
        $this->loadViewsFrom(realpath(__DIR__.'/../views'), 'contact');
        //注册包路由
        $this->setupRoutes($this->app->router);
        // this for conig
        $this->publishes([
            __DIR__.'/config/contact.php' => config_path('contact.php'),
        ]);
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        //设置路由命名空间
        $router->group(['namespace' => 'Jai\Contact\Http\Controllers'], function($router)
        {
            require __DIR__.'/Http/routes.php';
        });
    }

    public function register()
    {
        $this->registerContact();
        config([
            'config/contact.php',
        ]);
    }
    private function registerContact()
    {
        $this->app->bind('contact',function($app){
            //这个绑定毫无意义 也许可能是没有用到
            //return new Contact($app);
            return new elick($app);
        });
    }
}