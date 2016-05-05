<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //如果需要也可以在Comment模型中定义相对的关联关系获取其所属节点：
//    public function item(){
//        //如果$item部分不等于item可以自定义传入参数到morphTo：
//        //$this->morphTo($item,$item_type,$item_id);
//        return $this->morphTo();
//    }

    public function item(){
        return $this->morphTo();
    }
}
