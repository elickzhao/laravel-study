<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function comments(){
        //完整写法
        //$this->morphMany('App\Models\Comment',$item,$item_type,$item_id,$id);
        //最后一个参数是posts/videos表的主键。
        return $this->morphMany('App\Models\Comment','item');
    }

    public function tags(){
        return $this->morphToMany('App\Models\Tag','taggable');
    }
}
