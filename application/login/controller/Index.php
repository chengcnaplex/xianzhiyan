<?php
namespace app\login\controller;

use think\Controller;
use think\Session;
use think\Request;
use think\Db;

class Index extends Controller
{
    public function login_page()
    {
        //如果根据session判断已经登录,直接跳转到主页
        if (Session::has('username','globle'))
        {
            $this->redirect('/homepage/index/index');
        }
        
        return $this->fetch(); 
    }
    /**
     * @param Request $request
     * @return string 
     * 成功返回success,成功码200
     * 错误返回fail,返回码101验证码不正确，
     *            返回码102用户名密码不正确
     */
    public function signin(Request $request)
    {
        $data = $request->param();
        $code = $data['code'];
        $username = $data['username'];
        $password = $data['password'];

        //TODO 先校验session中的验证码 
        if (!captcha_check($code)) {
           $resultjson = ['result' => 'fail', 'code' => '101'];
           return json($resultjson);
        } 

        //返回的json对象，并不是json字符串，所以在ajax那边就不会进行解析操作
        $result = Db::name('admin')
        ->alias('a')
        ->join('xzy_admin_level_detail d','a.level = d.level_id')
        ->where('username', $username)
        ->where('password', $password)
        ->find();
        
        if ($result)
        {
            //设置session
            Session::set('username',$username,'globle');
            Session::set('level',$result['level'],'globle');
            Session::set('levelname',$result['level_name'],'globle');
            Session::set('adminId',$result['uid'],'globle');
            //返回数据
            $resultjson = ['result' => 'success', 'code' => '200'];
            return json($resultjson);
        }
        else
        {
            $resultjson = ['result' => 'fail', 'code' => '102'];
            return json($resultjson);
        }
    }
    
    public function singOut()
    {
        Session::clear('globle');
        $this->redirect('/');
    }
}
