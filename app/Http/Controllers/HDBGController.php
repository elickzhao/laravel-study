<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HDBGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        echo 'HDBG';
    }

    public function getJoin(){
        $users = DB::table('users')->join('posts','users.id','=','posts.user_id')->get();
        //字段重合将会使用第二张表的 比如name 这里显示的就是posts那个表的
        dump($users);
    }

    public function getLeftJoin(){
        $users = DB::table('users')->leftJoin('posts','users.id','=','posts.user_id')->get();
        //显示所有users 同样相同名会被posts替换 即使没有对应的
        dump($users);
    }

    public function getClause(){
        $users = DB::table('users')->join('posts',function($join){
            $join->on('users.id','=','posts.user_id')
                ->where('posts.id','>',2);
        })->get();
        dd($users);
    }

    public function getUnion(){
        $users = DB::table('users')->where('id','<',3);
        $users = DB::table('users')->where('id','>',2)->union($users)->get();
        dd($users);
    }

    public function getWhere(){
        //三个参数如果是 = 那么中间那个可以省略
        $users = DB::table('users')->where('name','=','elick')->get();
        dump($users);

        //需要注意的是查询构建器支持方法链，这意味着如果有多个查询条件且这个多个条件是AND连接，
        //可以在get之前使用多个where方法。如果多个条件使用OR连接，可以使用orWhere方法：
        $user = DB::table('users')->where('name','elick')->orWhere('name','lar1')->get();
        dump($user);
    }

    public function getOrder(){
        $users = DB::table('users')->orderBy('id','desc')->get();
        dd($users);
    }

    public function getGroup(){
        $posts = DB::table('posts')->select('name',DB::raw('COUNT(id) as num'))->groupBy('user_id')->get();
        dump($posts);

        //注意：having中的条件字段必须出现在select查询字段中，否则会报错。
        $posts = DB::table('posts')->select('id','name',DB::raw('COUNT(id) as num'))->groupBy('user_id')->having('id','>',0)->get();
        //这个是 两个分好组后 再进行判断having  比如这个id>0  目前结果是 id 1和4 如果变成id>1的话 1那个数组就没了
        dump($posts);
    }

    public function getPage(){
        $posts = DB::table('posts')->skip(0)->take(2)->get();
        dd($posts);
    }

}