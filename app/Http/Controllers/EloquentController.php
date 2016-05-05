<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EloquentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $posts = Post::all();
        dump($posts);

        //这种写法会慢很多
        $posts = Post::where('id','<',3)->orderBy('id','desc')->take(1)->get();
        dump($posts);

        Post::chunk(2,function($posts){
            foreach($posts as $post){
                echo $post->name.'<br>';
            }
        });

    }

    public function getSingle(){
        $post = Post::where('id',1)->first();
        dump($post);

        $count = Post::where('id','>',0)->count();
        echo $count;
        echo "<br>";
        $user_id = Post::where('user_id',1)->max('id');
        echo $user_id;
    }

    public function getSave(){
        $post = new Post();
        $post->title = 'test 4';
        $post->name = '啦啦啦';
        $post->user_id = '1';
        if($post->save()){
            echo '文章添加成功';
        }else{
            echo '文章添加失败';
        }
    }

    public function getCreate(){
        //为什么关create叫批量赋值 那是因为 save必须取出一个实例 然后每个属性赋值
        //然后就得必须重新取出一个实例 要不然还是这个实例 一直改变的都是这一条数据
        $input = [
            'title'=>'test 5',
            'name'=>'test content',
            'user_id'=>2
        ];

        $post = Post::create($input);
        dump($post);

        $input = [
            'title'=>'test 5',
            'name'=>'test content',
            //'user_id'=>2   //数组内必须都是$fillable里的值 也就是都可以插入的 要不就会新建
        ];

        $post = Post::firstOrCreate($input);
        dump($post);

        $input = [
            'title'=>'test 6',
            'name'=>'test name',
            'user_id'=>2
        ];

        $post = Post::create($input);
        $post->user_id=1;
        $post->save();
        dump($post);

    /*
        批量赋值的英文名称是Mass Assignment，所谓的批量赋值是指当我们将一个数组发送到模型类用于创建新的模型实例的时候（通常是表单请求数据），我们可以简单通过如下方式实现：
        $post = Post::create(Input::all());
        而不是像使用save方法那样一个一个的设置属性值，如果模型属性很多的话，使用save简直是噩梦有木有。
        但事物总是相对的，使用批量赋值是很方便，但同时也带来了安全隐患，很多时候模型类的某些属性值不是我们所期望通过批量赋值修改的，
        比如用户模型有个user_type属性，如果用户通过请求数据将其类型修改为管理员类型，这显然是不允许的，
        正是基于这一考虑，Eloquent模型类为我们提供了$fillable属性和$guarded属性，我们可以将其分别看作“白名单”和“黑名单”，
        定义在$fillable中的属性可以通过批量赋值进行赋值，而定义在$guarded中的属性在批量赋值时会被过滤掉。
        那么如果我们确实想要修改定义在$guarded中的属性怎么办？答案是使用save方法。
    */
    }

    public function getUpdate(){
        $input = [
            'title'=>'test 7 title',
            'name'=>'test name 7',
            'cat_id'=>1,
            'views'=>200,
            'user_id'=>2
        ];

        //同样用到批量赋值 所以也受到保护限制
        $post = Post::find(20);
        if($post->update($input)){
            echo '更新文章成功！';
            dd($post);
            //user_id并没有更新
        }else{
            echo "更新文章失败";
        }
    }

    public function getDelete(){
        $post = Post::find(6);
        //如果没有那个字段根本无法删除 所以else判断是错的 因为不会进入哪里 直接提示报错了
//        if($post->delete()){
//            echo '删除文章成功!';
//        }else{
//            echo '删除文章失败!';
//        }
        //删除失败返回 0
        $deleted = Post::destroy(5);
        echo $deleted;
        $deleted = Post::destroy([9,19]);
        dump($deleted);

        $deleted = Post::where('id',6)->delete();
        dd($deleted);

    }

    public function getSoftDelete(){
        //这个看来真不行 手动添加deleted_at到数据库是不行的
        //必须用工具生成
        //为啥我的软删除是把更新时间去掉 并没有添加delete_at
        //知道原因了 model里写了这句 public $dateFormat = 'U';  因为格式不对所以不显示吧
        //把这句去掉就能看到了
        $post = Post::find(20);
        $post->delete();
        if($post->trashed()){

            echo "软删除成功!";
        }else{
            echo "软删除失败!";
        }


        $posts = Post::onlyTrashed()->get();
        //dump($posts);

        //单个恢复
        $post = Post::withTrashed()->find(20);
        $post->restore();
        //批量
        $posts = Post::withTrashed()->where('id','>',1)->restore();
        dump($posts);
        //全部
        Post::withTrashed()->restore();

        $post = Post::find(1);
        $post->delete();
        dump($post->trashed());

        //恢复关联查询模型
        //报错了 说没有history这个方法
//        $post = Post::find(1);
//        $post->history()->restore();
//        dump($post);

        $post = Post::find(23);
        $post->delete();

        //没有返回值 应该也可以直接删除 不仅仅是软删除后的数据
        $r = Post::onlyTrashed()->find(23)->forceDelete();
        dump($r);

        $posts = Post::all();
        dump($posts);

    }

    public function getScope(){
        //说白了就是把常用方法写在model里
        //只不过需要歌前缀scope
        $posts = Post::popular()->orderBy('id','desc')->get()->toArray();
        dump($posts);
    }

    public function getEvent(){
        //z主要内容在AppServiceProvider里面 注册model动作过程
        $data = array(
            'title'=>'test model event',
            'name'=>'test content',
            'user_id'=>1,
        );
        $post = Post::create($data);
        if(!$post->exists){
            echo '添加文章失败！';exit();
        }
        echo '&lt;'.$post->title.'&gt;保存成功！';
    }

}
