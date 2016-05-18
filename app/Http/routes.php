<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //dump(realpath(__DIR__.'/../Console'));
    return view('home');
});

//R路由一练习
Route::group(['prefix' => 'router1','as'=>'ro::'],function(){
    Route::get('/',['as'=>'root',function(){
        return "router 测试页";
    }]);
    Route::get('/hello',['as'=>'he',function(){
        echo "aa";
        return "Hello Laravel[GET]!";
    }]);

    Route::get('testPost',function(){
        $csrf_token = csrf_token();
        $route = route('ro::he');
        //知道怎么回事了 命名后必须接::分割字命名 如果没有就加载第一个子域名
        //dd($route);  //怪了这里是hello 却不是根域名router1;
        $form = <<<FORM
            <form action="{$route}" method="POST">
                <input type="hidden" name="_token" value="{$csrf_token}">
                <input type="submit" value="Test">
            </form>
FORM;
        return $form;
    });

    Route::post('hello',function(){
        return "Hello Laravel[POST]!";
    });

    // 会覆盖上面路由
    Route::match(['get','post'],'hello1',function(){
       return "Hello Laravel!";
    });

    //匹配所有请求 会覆盖上面路由的
    Route::any('/hello2',function(){
        return "Hello Laravel!";
    });

    Route::get('/hello/{name}/by/{user}',function($name,$user){
       return "Hello {$name} by {$user}!";
    });

    Route::get('hello/{name?}',function($name = "Laravel 5.1"){
        return "Hello {$name}!";
    });

    //全局匹配放在 app/providers/routeserviceprovider boot()里
    Route::get('hello/{name?}',function($name = 'Laravel'){
        return "Hello {$name}!";
    })->where('name','[A-Za-z]+');


});

//路由二联系
Route::group(['prefix' => 'router2','as'=>'ro2::'],function(){
   Route::get('/',function(){
       return "路由练习2";
   });

   Route::get('hello/laravelcademy',['as'=>'academy',function(){
       return "Hello LaravelAcademy!";
   }]);

   Route::get('testNamedRoute',function(){
       //return route('ro2::academy');
       return redirect()->route('ro2::academy');
   });

    //路由分组 不用写了 因为现在这个就是演示

    Route::group(['middleware'=>'test'],function(){
        Route::get('write',function(){
            //使用中间件
            return "你已经成年了!!";
        });
    });

    Route::get('age',['as'=>'refuse',function(){
        return "未成年禁止入内!";
    }]);

    /**
     * 命名空间 也就是说 控制器不用写那么长的前缀了
     * 比如Article 如果放到controller\Article下 每次写控制器都得加上Article才可以
     * 有了命名空间就不需要这样了
     */
    Route::group(['namespace'=>'LaravelAcademy'],function(){
        // 控制器在 "App\Http\Controllers\LaravelAcademy" 命名空间下

        Route::group(['namespace' => 'DOCS'], function()
        {
            // 控制器在 "App\Http\Controllers\LaravelAcademy\DOCS" 命名空间下
        });
    });

    //路由前缀就不演示了 因为前面都是

});

//路由联系三
Route::group(['prefix'=>'router3','as'=>'ro3::'],function(){
   Route::get('/',function(){
       //擦原来这么写也可以
       return ('路由联系三');
   });

    Route::get('testCsrf',function(){
        $csrf_field = csrf_field();
        $route = route('ro3::');
        //这个花括号可以不写
        $html = <<<GET
            <form method="POST" action="$route"/>

                <input type="submit" value="Test" />
            </form>
GET;
        return $html;
    });

    Route::post('testCsrf',['as'=>'csrf',function(){
        return 'Success!';
    }]);



});

//中间件教程
Route::group(['prefix'=>'middleware','as'=>'mi::'],function(){
    Route::get('/',function(){
        return '中间件教程!';
    });

    //有别名就不会默认跳到这里了 route('mi::')
    Route::get('tt',['as'=>'t',function(){
        return "tt";
    }]);

    //male是传给 中间件的参数值 用于比对前台提交上来的值是否一直 并不是参数名
    Route::group(['middleware'=>'mi:male'],function(){
        Route::get('write',function(){
           //中间件
            return "欢迎你 body!!!!";
        });
    });

    Route::get('age',['as'=>'re',function(){
        return "18岁以上男子才能访问！";
    }]);

    //可终止中间件并没有实例

});

//RESTFul风格控制器
Route::group(['prefix'=>'restful','as'=>'res::'],function(){
   Route::get('/',['as'=>'r',function(){
       return "RESTFul控制器实例";
   }]);

    //这个选项不知道有啥用 貌似这种路由没法定义名称  名称是单一动作  Get可以定名称
    //我们可以通过route('post.index')生成对应路由URL  看来只能这么定义了
    Route::resource('post','PostController',['as'=>'po']);

});

//这个可以生成  但是放在路由组里就不行了 route(post.index) 说没找到
//Route::resource('pp','PpController');

//HTTP 请求实例教程
Route::controller('request', 'RequestController');
//Route::group(['prefix'=>'request','as'=>'re::'],function(){
//    Route::get('/',['as'=>'r',function(){
//        return 'HTTP 请求实例教程 ';
//    }]);
//    Route::controller('request', 'RequestController');
//});

//HTTP 响应实例
Route::group(['prefix'=>'response','as'=>'resp::'],function(){
    Route::get('/',['as'=>'r',function(){
        return "HTTP 响应实例---";
    }]);

    Route::get('testResponse',function(){
        $content = 'Hello LaravelAcademy!';
//        $status = 200;
        $status = 500;
        $value = 'text/html;charset=utf-8';
        //两个方法是一样的
        //return (new \Illuminate\Http\Response($content,$status))->header('Content-Type',$value);
        return response($content,$status)->headers('Content-Type',$value);
    });

    Route::get('testResponseCookie',function(){
        $content = 'Hello elick ';
        $status = 200;
        $value = 'text/html;charset=utf-8';
        //return response($content,$status)->header('Content-Type',$value)->withCookie('site','i love elick');
        //设置cookie有效期为30分钟，作用路径为应用根目录，作用域名为laravel.app
        return response($content,$status)
                        ->header('Content-Type',$value)
                        ->withCookie('site','i love elick',30,'/','myapp.com');

    });

    Route::get('testRseponseView',function(){
        $value = 'text/html;charset=utf-8';
        return response()->view('hello',['message'=>'hello elick'])->header('Content-Type',$value);
        //简化的写就是 也就是我们平常用的方法
        //return view('hello',['message'=>'hello elick'])
    });

    Route::get('testResponseJson',function(){
        //json响应
        return response()->json(['name'=>'elick','password'=>'123456']);
        //jsonp响应  其实也可以用jsonp() 第一个参数为callback 第二个参数为数据
        return response()->json(['name'=>'elick','password'=>'123456'])
                        ->setCallback(request()->input('callbacke'));
    });

    Route::get('testResponseDownload',function(){
//        echo "realpath()和不使用realpath()的区别";
//        echo '<br>';
//        echo realpath(public_path('images/touxiang.jpg'));
//        echo '<br>';
//        echo public_path('images/touxiang.jpg');

        //上面不能输出要不然 就会放进图片里 使图标下载失败
        return response()->download(public_path('images/touxiang.jpg'),'1.jpg');
//        return response()->download(
//            realpath(base_path('public/images')).'/touxiang.jpg',
//            'Laravel学院.jpg'
//        );
    });

    Route::get('dashboard',function(){
        return redirect('/');
    });

    Route::get('dashboardgo',function(){
        return back()->withInput();
    });

    Route::get('testResponseRedirect',function(){
        //传递参数
        return redirect()->route('resp::r',2016);
        return redirect()->action('PostController@index');

//       //使用with方法可以携带一次性session数据到重定向请求页面（一次性session数据即使用后立即销毁的session数据项）：
        // 更新用户属性...
        return redirect('dashboard')->with('status', 'Profile updated!');
    });


});

//视图实例
Route::get('testViewHello',function(){
    //AppServiceProvider boot() 加载 view()->share('sitename','Laravel学院'); 这个数据 整个网站模版都能看到
    return view('hello',['message'=>'在视图间共享数据']);

    //AppServiceProvider.php 有更多内容
});

//服务提供者实例
Route::resource('test','TestController');

//使用DB门面操作数据库
Route::resource('db','DBController');

//使用查询构建器对数据库进行增删改查
Route::controller('dbg','DBGController');

//构建器高级用法
Route::controller('hdbg','HDBGController');

//Eloquent 实例
Route::controller('eloquent','EloquentController');

//Eloquent Relationships ORM关系
Route::controller('relation','ERelationshipController');

// 发送密码重置链接路由
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// 密码重置路由
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('testArtisan',function(){
    $exitcode = Artisan::call('elick:command',['name'=>'xwiwi','--mark'=>'?']);
});

//异常测试
Route::group(['prefix'=>'exception','as'=>'exce::'],function(){
    Route::get('/',['as'=>'e',function(){
        return "异常实例---";
    }]);

    Route::get('modelException',function(){
        $user = \App\User::findOrFail(100);
        dd($user);
    });

    Route::get('error',function(){
        $num = 1/0;
    });

    Route::get('http',function(){
        //abort(404);
        abort(403,'对不起,你无权访问该页面');
    });
});