<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DBGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        //
        $users = DB::table('users');
        dump($users);
    }

    public function getInsert(){
       $r= DB::table('users')->insert([
            ['name'=>"lar1",'email'=>"x@tom.com1",'password'=>'123'],
            ['name'=>"lar2",'email'=>"x@tom.com2",'password'=>'123'],
            ['name'=>"lar3",'email'=>"x@tom.com3",'password'=>'123'],
        ]);
        //这里返回的是一个布尔值
        dump($r);

        //这个返回插入时的id
        $id = DB::table('users')->insertGetId(
            ['name'=>'elick','email'=>'xwiwi@tom.com','password'=>'123']
        );
        dump($id);
    }

    public function getUpdate(){
        $affected = DB::table('users')->where('name','elick')->update(['password'=>'456']);
        dump($affected);
    }

    public function getDelete(){
        $deleted = DB::table('users')->where('id','>',3)->delete();
        dump($deleted);

        //清空表  这个没有返回  返回值是个null
        $r = DB::table('users')->truncate();
        dump($r);
    }

    //这个路由地址是get-all 不是下划线
    public function getGetAll(){
        $users = DB::table('users')->get();
        dump($users);
    }

    public function getGetFirst(){
        //如果没有where那就是第一个ID的数据
        $user = DB::table('users')->where('name','elick')->first();
        dump($user);
    }

    public function getGroup(){
        $r = DB::table('users')->chunk(2,function($users){
            foreach($users as $user){
                //查询退出条件 当搜到某个值就退出不再查询了
//                 if($user->name=='lar3')
//                      return false;
                echo $user->name.'<br>';
            }
            dump($users);
        });
        //返回一个布尔值
        dump($r);
    }

    public function getRaw(){
        //原生  可以更灵活的做一些操作
        $users = DB::table('users')->select(DB::raw('name,email'))->where('id','<',3)->get();
        dump($users);

        $users = DB::table('users')->select(['name','email'])->where('id','>',3)->get();
        dump($users);
    }

}
