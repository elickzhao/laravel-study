<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
   public function getBasetest(Request $request){
       $input = $request->input('test');
       echo $input;
   }

    public function getUrl(Request $request){
        //匹配request/*的URL才能继续访问
        if(!$request->is('request/*')){
            abort(404);
        }
        $uri = $request->path();
        $url = $request->url();
        echo $uri;
        echo "<br>";
        echo $url;
    }

    public function getMethod(Request $request){
        //非get请求不能访问
        if(!$request->isMethod('get')){
            abort(404);
        }
        $method = $request->method();
        echo $method;
    }

    public function getInputData(Request $request){
        //获取GET方式传递的name参数，默认为LaravelAcademy

        $name = $request->input('name','LaravelAcademy');
        echo $name;
        echo '<br>';
        //input-data?name=Laravel&test[][name]=Academy
        //这意思还能接收数组
        echo $request->input('test.0.name');

        if($request->has('hello'))
            echo $request->input('hello');

    }

    public function getInputData2(Request $request){
        $allData = $request->all();
        $onlyData = $request->only('name','hello');
        $exceptData = $request->except('hello');

        //request/input-data2?name=Laravel&test[][name]=Academy&hello=World
        var_dump($allData);
        echo "<br>";
        var_dump($onlyData);
        echo "<br>";
        var_dump($exceptData);
    }

    public function getLastRequest(Request $request){
        $request->flash();
        //request/last-request?name=test&passwd=123456
        //这两个方法效果一样
        //return redirect('/request/current-request');
        return redirect('/request/current-request')->withInput();
    }

    public function getCurrentRequest(Request $request){
        $lastRequestData = $request->old();
        echo '<pre>';
        print_r($lastRequestData);
    }

    public function getCookie(Request $request){
        $cookies = $request->cookie();
        dd($cookies);
    }

    public function getAddCookie(Request $request){
        $response = new Response();
        //第一个参数是cookie名，第二个参数是cookie值，第三个参数是有效期（分钟）
        //$response->withCookie(cookie('website','LaravelAcademy.org',1));
        //如果想要cookie长期有效使用如下方法
        //$response->withCookie(cookie()->forever('name', 'value'));
        return redirect('/request/cookie')->withCookie(cookie('website','LaravelAcademy.org',1));
        //return $response;
    }

    public function getFileupload(){
        $posUrl = 'fileupload';
        $csrf_field = csrf_field();
        $html = <<<CREATE
            <form action="$posUrl" method="POST" enctype="multipart/form-data">
            $csrf_field
            <input type="file" name="file"/><br><br>
            <input type="submit" value="提交"/>
            </form>
CREATE;
        return $html;
    }

    public function postFileupload(Request $request){
        //判断请求中是否包含name=file的上传文件
        if(!$request->hasFile('file')){
            exit('上传文件为空!');
        }

        $file = $request->file('file');
        //判断文件上传过程中是否出错
        if(!$file->isValid()){
            exit('文件上传出错');
        }


        $destPath = public_path('images');

        if(!file_exists($destPath)){
            mkdir($destPath,0755,true);
        }

        //文件上传客户端上的名字
        $filename = $file->getClientOriginalName();
        dump($filename);
        if(!$file->move($destPath,$filename)){
            exit('保存文件失败!');
        }
        exit('文件上传成功!');

    }

    public function getFileupload1(){
        $posUrl = 'fileupload1';
        $csrf_field = csrf_field();
        $html = <<<CREATE
            <form action="$posUrl" method="POST" enctype="multipart/form-data">
            $csrf_field
            <input type="file" name="file"/><br><br>
            <input type="submit" value="提交"/>
            </form>
CREATE;
        return $html;
    }

    public function postFileupload1(Request $request){
        if(!$request->hasFile('file')){
            exit('上传文件为空!');
        }
        $file = $request->file('file');
        if(!$file->isValid()){
            exit('文件上传出错!');
        }
        $newFileName = md5(time().rand(0,1000)).'.'.$file->getClientOriginalExtension();
        $savePath = 'test/'.$newFileName;
        //这个是保存在storage里的
//        $bytes = Storage::put($savePath,file_get_contents($file->getRealPath()));
//        if(!Storage::exists($savePath)){
//            exit('保存文件失败!');
//        }
//        header("Content-Type:".Storage::mimeType($savePath));
        //echo Storage::get($savePath);

        $disk = Storage::disk('my');
        $disk->put($savePath,file_get_contents($file->getRealPath()));
        if(!$disk->exists($savePath)){
            exit('保存文件失败!');
        }
        //dump($disk);
        //dump(public_path($savePath));
        $aa = url("app/".$savePath);
        echo "<img src='".$aa."' />";
    }

}
