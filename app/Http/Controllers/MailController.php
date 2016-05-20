<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{
    //
    public function send(){
        $name = 'elick';
        //有模版的邮件  第一个参数就是模版,第二个参数是模版变量赋值
//        $flag = Mail::send('emails.test',['name'=>$name],function($message){
//            $to = 'xwiwi@qq.com';
//            $message ->to($to)->subject('测试邮件');    //subject是标题
//        });

        //简单内容邮件不需要模版　用　raw() f方法发送
//        $flag = Mail::raw('我是邮件内容,就不用模板了!',function($message){
//            $to = 'xwiwi@qq.com';
//            $message ->to($to)->subject('我是邮件标题');    //subject是标题
//            $attachment = storage_path('app/test/7c76288c37a2841c2621b1b120b11283.jpg');
//            //附件
//            $message->attach($attachment,['as'=>'头像.jpg']);
//        });


        //带图片的邮件
        $imagePath = storage_path('app/test/7c76288c37a2841c2621b1b120b11283.jpg');
        //<img src="{{$message->embed($imagePath)}}"> 模版里用$message->embed() 添加图片地址
        $image = Storage::get('test/7c76288c37a2841c2621b1b120b11283.jpg');
        $flag = Mail::send('emails.test',['name'=>$name,'imagePath'=>$imagePath,'image'=>$image],function($message){
            $to = 'xwiwi@qq.com';
            $message ->to($to)->subject('测试邮件');    //subject是标题
            $attachment = storage_path('app/test/7c76288c37a2841c2621b1b120b11283.jpg');
            //附件
            $message->attach($attachment,['as'=>'头像.jpg']);
        });

        if($flag){
            echo "ok";
        }else{
            echo "not ok";
        }
    }
}
