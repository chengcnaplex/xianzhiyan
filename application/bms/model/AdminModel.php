<?php
namespace app\bms\model;

use think\Model;
class AdminModel extends Model{

    protected $table = 'xzy_admin';

    // 定义关联方法
    public function levelInfo()
    {
         //hasOne('关联模型名','关联外键','主键','别名定义','join类型')
        return $this->hasOne('AdminLevelModel','level_id','level');
    }
}
