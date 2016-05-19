@extends('layout.main')

@section('content')
    <h1> laravel 教程</h1>

    <div class="panel panel-body">
        <table class="table table-striped">
            <tr class="success">
                <th>教程名</th>
                <th>地址</th>
            </tr>
            <tr>
                <td>HTTP路由实例教程（一）—— 基本使用及路由参数</td>
                <td><a href="router1">连接router1</a></td>
            </tr>
            <tr>
                <td>HTTP路由实例教程（二）—— 路由命名和路由分组</td>
                <td><a href="router2">连接router2</a></td>
                </tr>
            <tr>
                <td>HTTP路由实例教程（三）—— CSRF攻击原理及其防护</td>
                <td><a href="router3">连接router3</a></td>
                </tr>
            <tr>
                <td>中间件实例教程 —— 中间件的创建使用及中间件参数定义</td>
                <td><a href="{{ route('mi::') }}">连接middleware</a></td>
            </tr>
            <tr>
                <td>HTTP控制器实例教程 —— 创建RESTFul风格控制器实现文章增删改查</td>
                <td><a href="{{ route('res::r') }}">连接RESTFul</a></td>
            </tr>
            <tr>
                <td>HTTP 请求实例教程 —— 获取请求数据、Cookie及文件上传处理</td>
                <td><a href="{{url('request') }}">连接request</a></td>
            </tr>
            <tr>
                <td>HTTP响应实例教程 —— 基本使用、生成Cookie、返回视图、JSON/JSONP、文件下载及重定向</td>
                <td><a href="{{ route('resp::r') }}">连接response</a></td>
            </tr>
            <tr>
                <td>Laravel 视图实例教程 —— 在视图间共享数据及视图Composer</td>
                <td><a href="{{ url('testViewHello') }}">连接Composer</a></td>
            </tr>
            <tr>
                <td>Laravel 服务容器实例教程 —— 深入理解控制反转（IoC）和依赖注入（DI）</td>
                <td><a href="localhost/IoC/Superman.php">连接IoC</a></td>
            </tr>
            <tr>
                <td>Laravel 服务提供者实例教程 —— 创建 Service Provider 测试实例）</td>
                <td><a href="{{ action('TestController@index') }}">连接Test</a></td>
            </tr>
            <tr>
                <td>Laravel 门面实例教程 —— 创建自定义 Facades 类 （和服务同一个地址　稍加改动控制器）</td>
                <td><a href="{{ action('TestController@index') }}">连接Test</a></td>
            </tr>
            <tr>
                <td>Laravel 数据库实例教程 —— 使用DB门面操作数据库</td>
                <td><a href="{{ action('DBController@index') }}">连接DB</a></td>
            </tr>
            <tr>
                <td>Laravel 数据库实例教程 —— 使用查询构建器对数据库进行增删改查</td>
                <td><a href="{{ action('DBGController@getIndex') }}">连接DBG</a></td>
            </tr>
            <tr>
                <td>Laravel 数据库实例教程 —— 使用查询构建器实现对数据库的高级查询</td>
                <td><a href="{{ action('HDBGController@getIndex') }}">连接HDBG</a></td>
            </tr>
            <tr>
                <td>Eloquent ORM 实例教程 —— ORM概述、模型定义及基本查询</td>
                <td><a href="{{ action('ERelationshipController@getIndex') }}">连接Eloquent</a></td>
            </tr>
            <tr>
                <td>Eloquent ORM 实例教程 —— 关联关系及其在模型中的定义（一）</td>
                <td><a href="{{ action('ERelationshipController@getIndex') }}">连接Eloquent关系</a></td>
            </tr>
            <tr>
                <td>Laravel 实例教程 —— 如何在Laravel 5.1中进行自定义包开发</td>
                <td><a href="{{ url('contact') }}">连接开发包</a></td>
            </tr>
            <tr>
                <td>Laravel 5.1用户认证（二） —— 使用Laravel内置组件快速实现密码重置</td>
                <td><a href="{{ url('password/email') }}">连接开发包</a></td>
            </tr>
            <tr>
                <td>Laravel 5.1 中创建自定义 Artisan 控制台命令实例教程</td>
                <td><a href="{{ url('testArtisan') }}">elick:command</a></td>
            </tr>
            <tr>
                <td>Flarum 清新论坛测试</td>
                <td><a href="http://localhost/flarum/">论坛连接</a></td>
            </tr>
            <tr>
                <td>Stripe 支付方式测试</td>
                <td><a href="http://localhost/stripe/public/service">支付方式测试</a></td>
            </tr>
            <tr>
                <td>OmniPay 银联支付方式测试</td>
                <td><a href="http://localhost/omnipay/public/unionpay/pay">银联支付方式测试</a></td>
            </tr>
            <tr>
                <td>OmniPay 微信支付方式测试--这个未完成 没有可以支付的公众号</td>
                <td><a href="#">微信支付方式测试</a></td>
            </tr>
            <tr>
                <td>Laravel 缓存实例教程（一） —— 基于Memcached缓存驱动的配置</td>
                <td><a href="http://localhost:8080/post">这个是在homestead下 所以要开启它</a></td>
            </tr>
            <tr>
                <td>PyroCMS 用laravel 5.1开发的类似drupal的cms</td>
                <td><a href="http://pyrocms.cc/">网站首页</a></td>
            </tr>
            <tr>
                <td>Laravel 5.1 中的异常处理器和HTTP异常处理实例教程</td>
                <td><a href="{{ route('exce::e') }}">异常处理</a></td>
            </tr>
            <tr>
                <td>基于 Laravel 集成的 Monolog 库对日志进行配置和记录</td>
                <td><a href="{{ url('log') }}">日志演示</a></td>
            </tr>
            <tr>
                <td>Laravel 5.1 定义事件、事件监听器以及触发事件实例教程</td>
                <td><a href="http://localhost:8080/post">这个是在homestead下 所以要开启它</a></td>
            </tr>
        </table>
    </div>
@endsection