<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    //这个好像是使用Carbon来管理
    protected $dates = ['deleted_at'];

    //设置日期时间格式
    //public $dateFormat = 'U';
    protected $fillable = ['title','name'];

    //搜索域
    public function scopePopular($query){
        return $query->where('id','>',9);
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments(){
        //完整写法
        //$this->morphMany('App\Models\Comment',$item,$item_type,$item_id,$id);
        //最后一个参数是posts/videos表的主键。
        return $this->morphMany('App\Models\Comment','item');
    }

    public function tags(){
        //其中第一个参数是关联模型类名，第二个参数是关联关系名称，完整的参数列表如下：
        //$this->morphToMany('App\Models\Tag','taggable','taggable','taggable_id','tag_id',false);
        return $this->morphToMany('App\Models\Tag','taggable');
    }
}
