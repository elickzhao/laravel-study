<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\ServiceProvider;
use DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //视图间共享数据
        view()->share('sitename','Laravel学院-- 我是共享数据');

        //视图Composer
        view()->composer('hello',function($view) {
            $view->with('user', array('name' => 'test', 'avatar' => public_path('images/touxiang.jpg')));
        });

        //多个视图
        view()->composer(['hello','home'],function($view) {
            $view->with('user', array('name' => 'test', 'avatar' => public_path('images/touxiang.jpg')));
        });
        //所有视图
        view()->composer('*',function($view) {
            $view->with('user', array('name' => 'test', 'avatar' => public_path('images/touxiang.jpg')));
        });
        //和composer功能相同 因为实例化后立即消失 也许可以减少内存消耗吧
        view()->creator('profile', 'App\Http\ViewCreators\ProfileCreator');

        /*
         * 这个东西怎么理解呢
         * share() 不可变共享数据 比如 网站名 网站地址之类的
         * composer()  可变共享数据 比如用户名和头像 还有就是快速变化的信息 比如网站在线人数
         *              这个每个页面加载都得请求  所以直接放到这里共享出来
         */


//        DB::listen(function($sql,$bindings,$time){
//            echo 'SQL语句执行: '.$sql.',参数: '.json_encode($bindings).',耗时: '.$time.'ms';
//        });


        Post::saving(function($post){
            echo 'saving event is fired<br>';
            //看来同样道理 必须是可见的参数
            //必须在fillable里
            if($post->user_id == 1)
                return false;
        });

        Post::creating(function($post){
            echo 'creating event is fired<br>';
            //看来同样道理 必须是可见的参数
            //必须在fillable里
            if($post->name == 'test content')
                return false;
        });

        Post::created(function($post){
            echo 'created event is fired<br>';
        });

        Post::saved(function($post){
            echo 'saved event is fired<br>';
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
