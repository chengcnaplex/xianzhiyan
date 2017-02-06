<?php
namespace app\bms\controller;
use think\Controller;
use think\Request;
use app\bms\model\AdminModel;
use app\bms\model\AdminLevelModel;
use think\Session;

class Admin extends Controller
{
    public function index(Request $request)
    {
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        $param = $request->param();
        $page = isset($param['page']) ? $param['page'] : 1;
        $username = isset($param['username']) ? $param['username'] : "";
        //查询返回集合
        $query = AdminModel::where("uid", "<>", 0);
        if (isset($param['username']) && $param['username'] != "") {
            $query->where('username', "=", $param['username']);
        }
        $list = $query->paginate(10);
        
        if ($list->count() == 0 && $page >= 1){
            //重新查询返回集合
            $page = $page - 1;
            $this->redirect("/bms/admin/index?page=$page&username=$username");
        } 
        
        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->assign('username',$username);
        return $this->fetch();
    }
    
    public function addPage(Request $request){
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        $levelInfo = AdminLevelModel::all();
        $this->assign('levelInfo',$levelInfo);
        return $this->fetch();
    }
    
    public function addAdmin(Request $request){
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        //获取ajax请求参数集合
        $param = $request->param();
        //解析请求参数添加到对应的数组中
        $blacker['username'] = $param['username'];
        $blacker['password'] = $param['password'];
        $blacker['level'] = $param['level'];
        //添加到数据库
        $result = AdminModel::create($blacker);
        //根据插入数据判断是否添加成功并且返回json
        if ($result){
            $resultjson = ['result' => 'success', 'code' => '200'];
            return json($resultjson);
        }else{
            $resultjson = ['result' => 'fail', 'code' => '102'];
            return json($resultjson);
        }
    }
    
    public function delAdmin(Request $request){
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        //获取ajax请求参数集合
        $param = $request->param();
        $uid = $param['uid'];
        if (isset($uid)){
            $admin = AdminModel::get($uid);
            if ($admin) {
                $admin->delete();
                $resultjson = ['result' => 'success', 'code' => '200'];
                return json($resultjson);
            } else {
                $resultjson = ['result' => 'fail', 'code' => '102'];
                return json($resultjson);
            }
        }
    }
            
    public function editPage(Request $request){
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        //获取ajax请求参数集合
        $param = $request->param();
        $uid = $param['uid'];
        if (isset($param['uid'])){
        
            $admin = AdminModel::get($uid);
            if ($admin) {
                $this->assign('uid', $uid);
                $this->assign('admin', $admin);
            }
        }
        $levelInfo = AdminLevelModel::all();
        $this->assign('levelInfo',$levelInfo);
        return $this->fetch();
    }
    
    public function editAdmin(Request $request){
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        //获取ajax请求参数集合
        $param = $request->param();
        $admin = AdminModel::get($param['uid']);
        //解析请求参数添加到对应的数组中
        $admin['username'] = $param['username'];
        $admin['password'] = $param['password'];
        $admin['level'] = $param['level'];
        //修改
        if ($admin->save()){
            $resultjson = ['result' => 'success', 'code' => '200'];
            return json($resultjson);
        }else {
            $resultjson = ['result' => 'fail', 'code' => '102'];
            return json($resultjson);
        }
    }
}
