<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Cache::get('posts',[]);
        if(!$posts)
            exit('Nothing');

        $html = '<ul>';
        foreach($posts as $k => $post){
            $html .= "<li><a herf=''".action('PostController@show',$k).">".$post['content']."</li>";
        }
        $html .= "</ul>";
        return $html;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postUrl = action('PostController@store');
        $csrf_field = csrf_field();

        $html = <<<CREATE
            <form action="$postUrl" method="POST">
            $csrf_field
            <input type="text" name="title"><br><br>
            <textarea name='content' cols='50' rows='5'></textarea><br><br>
            <input type="submit" value="提交">
            </form>
CREATE;
        return $html;
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
        $title = $request->title;
        $content = $request->input('content');
        $post = ['title'=>trim($title),'content'=>trim($content)];

        //清除缓存
//        Cache::forget('posts');
//        Cache::forget('post_id');


        //Cache门面的get方法用于从缓存中获取缓存项，如果缓存项不存在，返回null。
        //如果需要的话你可以传递第二个参数到get方法指定缓存项不存在时返回的自定义默认值：
        $posts = Cache::get('posts',[]);
        if(!Cache::get('post_id')){
            //add方法只会在缓存项不存在的情况下添加缓存项到缓存，如果缓存项被添加到缓存返回true，否则，返回false：
           // Cache::add('key', 'value', $minutes);
            Cache::add('post_id',1,60);
            //put效果是一样的 只是add更保险一点 免得缓存中有东西
            //Cache::put('post_id',1,60);
        }else{
            //增加缓存
            Cache::increment('post_id',1);
        }
        //*********上面可以简单写成这样**********
//        if(!Cache::add('post_id',1,60)){
//            Cache::increment('post_id',1);
//        }


//        dd(Cache::get('post_id'));
//        dd(Cache::get('posts'));
        //Cache::get('post_id') 永远保存着当期$posts的key
        $posts[Cache::get('post_id')] = $post;

        //存储缓存项到缓存 第三个参数为时间 60分钟
        Cache::put('posts',$posts,60);
        //dump(Cache::get('posts'));
        //sleep(10);
        return redirect()->action('PostController@show',['post'=>Cache::get('post_id')]);

        //解说: 这相当于一个二维数组
        //posts 存着数组 $posts
        //$posts 存着post_id 指向的 $post具体value
        //按这里的解说来看 post_id是个缓存项 不知道可不可以用put来存
        //这种缓存不能像数组一样操作 所以只能一级一级的保存
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
        $posts = Cache::get('posts',[]);
        if(!$posts || !$posts[$id])
            exit('Nothing Found!');
        $post = $posts[$id];

        $editUrl = action('PostController@edit',['post'=>$id]);
        //看来这个括号{}还不是没用的 当有数组的时候就有用了 要不就会报错了
        $html = <<<DETAIL
            <h3>{$post['title']}</h3>
            <p>{$post['content']}</p>
            <p>
                <a href="{$editUrl}">编辑</a>
        </p>
DETAIL;
        return $html;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $posts = Cache::get('posts');

        if(!$posts || !$posts[$id])
            exit('Nothing Found!');
        $post = $posts[$id];

        $postUrl = action('PostController@update',['post'=>$id]);
        $csrf_feild = csrf_field();
        $html = <<<UPDATE
            <form action="{$postUrl}" method="POST">
                    $csrf_feild
                    <input type="hidden" name="_method" value="PUT"/>
                    <input type="text" name="title" value="{$post['title']}"/><br/><br/>
                    <textarea name="content" cols="50" rows="5">{$post['content']}</textarea>
                    <br/><br/>
                    <input type="submit" value="提交"/>
            </form>
UPDATE;
    return $html;
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
        $posts = Cache::get('posts',[]);
        if(!$posts || !$posts[$id]){
            exit('Nothing Found!');
        }

        $posts[$id]['title'] = trim($request->title);
        //看来有的特殊关键词就得用input来获得
        $posts[$id]['content'] = trim($request->input('content'));

        Cache::put('posts',$posts,60);

        return redirect()->action('PostController@show',$id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Cache::get('posts',[]);
        if(!$posts || !$posts[$id])
            exit('Nothing Deleted！');
        unset($posts['$id']);
        //减一位存储位
        Cache::decrement('post_id',1);
        return redirect()->action('PostController@index');
    }
}
