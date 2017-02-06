<?php
namespace app\bms\model;

use think\Model;
class BlackListModel extends Model{

    protected $table = 'xzy_blacklist';

    // 定义关联方法
    public function badBehaviorInfo()
    {
         //hasOne('关联模型名','关联外键','主键','别名定义','join类型')
        return $this->hasOne('BadBehaviorInfo','bad_behavior_id','bad_behavior_id');
    }
    // 定义关联方法
    public function badTypeInfo()
    {
        //hasOne('关联模型名','关联外键','主键','别名定义','join类型')
        return $this->hasOne('BadTypeInfo','bad_type_id','bad_type_id');
    }
    // 定义关联方法
    public function adminInfo()
    {
        //hasOne('关联模型名','关联外键','主键','别名定义','join类型')
        return $this->hasOne('AdminModel','uid','admin_id');
    }
}

