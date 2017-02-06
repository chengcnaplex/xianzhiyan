<?php
namespace app\homepage\controller;

use think\Controller;
use think\Session;
use think\Request;
use app\homepage\model\BlackListModel;

class Index extends Controller
{
    public function index()
    {
        //TODO  如果还没登录 调到登录页面
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }

        $username = Session::get('username','globle');
        $level = Session::get('level','globle');
        
        $this->assign('username',$username);
        $this->assign('level',$level);
        return $this-> fetch();
    }
    
    public function search(Request $request){
        $param = $request->param();
        $info = $param['info'];
        
        $blackListModel = new BlackListModel();
        $result = BlackListModel::readBlackListByInfo($info);
        if ($result)
        {
            return json($result);
        }
    }
}
