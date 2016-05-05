<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Country;
use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use App\models\UserAccount;
use App\Models\Video;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ERelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $account = User::find(1)->account->toArray();
        dump($account);

        $user = UserAccount::find(1)->user->toArray();
        dump($user);
    /*
      实际上在底层无论是hasOne方法还是belongsTo方法都可以接收额外参数，
      比如如果user_accounts中关联users的外键是$foreign_key，该外键对应users表中的列是$local_key，
      那么我们可以这样调用hasOne方法：

      $this->hasOne('App\Models\UserAccount',$foreign_key,$local_key);
      调用belongsTo方法也是一样：

      $this->belongsTo('App\User',$foreign_key,$local_key);
      此外，belongsTo还接收一个额外参数$relation，用于指定关联关系名称，
      其默认值为调用belongsTo的方法名，这里是user。
     * */

    }

    public function getHasMany(){
        $posts= User::find(1)->posts->toArray();
        dump($posts);

        $posts= User::find(1)->posts()->where('id','>',2)->get()->toArray();
        dump($posts);

        $user = Post::find(2)->user->toArray();
        dump($user);
    }

    public function getBelongMany(){
        //注意我们定义中间表的时候没有在结尾加s并且命名规则是按照字母表顺序，
        //将role放在前面，user放在后面，并且用_分隔
        //所以RoleUser这个model必须指定表名 要不会出错的 protected $table = 'role_user';
        //至于字段就没有说道了
        $user = User::find(1);
        $roles = $user->roles;
        echo 'User: '.$user->name.' 所拥有的角色：<br>';
        foreach($roles as $role){
            echo $role->name.'<br>';
        }

        echo '<br><br>';
        $users = Role::find(10)->users;
        echo 'Role: '.$role->name.' 下面的用户：<br>';
        foreach ($users as $user) {
            echo $user->name.'<br>';
        }

        echo '<br><br>';

        //此外我们还可以通过动态属性pivot获取中间表字段：
        $roles = User::find(1)->roles;
        foreach ($roles as $role) {
            echo $role->pivot->role_id.'----'.$role->pivot->user_id.'<br>';
        }

    }

    //远层一对多 通过中间关系表找到远层数据 例如:
    //国家->人员->文章
    public function getManyThrough(){
        $country = Country::find(7);
        $posts = $country->posts;

        echo 'Country: '.$country->name.' 有以下文章:<br>';
        foreach($posts as $post){
            echo $post->id.'.  &lt;&lt;'.$post->name.'&gt;&gt;<br>';
        }

    }

    public function getMorphMany(){
        $comments = Video::find(5)->comments->toArray();
        dump($comments);


        $comment = Comment::find(4);
        $item = $comment->item->toArray();
        dd($item);
    }

    public function getMorphToMany(){
        $tags = Post::find(20)->tags->toArray();
        dump($tags);

        $posts = Tag::find(7)->posts->toArray();
        dump($posts);

    }

 }
