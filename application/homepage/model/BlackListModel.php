<?php
namespace app\homepage\model;

use think\Model;

class BlackListModel extends Model{

    protected $table = 'xzy_blacklist';
    // 根据nickname读取用户数据
    public static function readBlackListByInfo($info)
    {
        $blackListUsers = BlackListModel::all(function($query) use($info){
            $query
            ->alias('a')
            ->join('xzy_badbehavior_info b','a.bad_behavior_id = b.bad_behavior_id')
            ->join('xzy_badtype_info t','a.bad_type_id = t.bad_type_id')
            ->join('xzy_admin m','a.admin_id = m.uid')
            ->where('zhifubao_id',"=",$info)
            ->whereOr('taobao_id',"=",$info);
        });
        return  $blackListUsers;
    }
}
