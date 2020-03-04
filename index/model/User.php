<?php
namespace app\index\model;

use think\Model;

class User extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'user';



    public function a(){
        return $this->where('id',1)->find();
    }

    public function setData($data){
        $this->data = $data;
    }
    public function call(callable $callback){
        foreach ($this->data as &$v) {
            $callback($v);
            var_dump($v);
        }
        return $this->data;
    }
}