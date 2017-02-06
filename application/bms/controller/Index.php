<?php
namespace app\bms\controller;

use think\Controller;
use think\Session;

class Index extends Controller
{
    public function index()
    {
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        $level = Session::get('level','globle');
        $levelname = Session::get('levelname','globle');
        $username = Session::get('username','globle');
        $this->assign('level',$level);
        $this->assign('levelname',$levelname);
        $this->assign('username',$username);
        return $this->fetch();
    }
    public function welcome()
    {
        return $this->fetch();
    }
}