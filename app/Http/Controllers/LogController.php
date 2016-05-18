<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        Log::emergency($error);     //紧急状况，比如系统挂掉
//        Log::alert($error);     //需要立即采取行动的问题，比如整站宕掉，数据库异常等，这种状况应该通过短信提醒
//        Log::critical($error);     //严重问题，比如：应用组件无效，意料之外的异常
//        Log::error($error);     //运行时错误，不需要立即处理但需要被记录和监控
//        Log::warning($error);    //警告但不是错误，比如使用了被废弃的API
//        Log::notice($error);     //普通但值得注意的事件
//        Log::info($error);     //感兴趣的事件，比如登录、退出
//        Log::debug($error);     //详细的调试信息

        Log::emergency("系统挂掉了!");
        Log::alert('数据库访问异常!');
        Log::critical('系统出现未知错误!');
        Log::error('指定变量不存在!');
        Log::warning("该方法已经被废弃");
        Log::notice("用户在异地登录");
        Log::info("用户xxx登录成功");
        Log::debug("调试信息");
        echo "查看 storage/logs/laravel.log 最下端  信息已经记录到里面了";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
