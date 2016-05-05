<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts(){
        return $this->morphedByMany('App\Models\Post','taggable');
    }

    public function videos(){
        //其中第一个参数是关联对象类名，第二个参数是关联关系名称，同理完整参数列表如下：
        //$this->morphedByMany('App\Models\Video','taggable','taggable','tag_id','taggable_id');
        return $this->morphedByMany('App\Models\Video','taggable');
    }
}
