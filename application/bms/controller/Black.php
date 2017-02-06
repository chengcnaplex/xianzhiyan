<?php
namespace app\bms\controller;

use think\Controller;
use think\Request;
use app\bms\model\BlackListModel;
use app\bms\model\BadBehaviorInfo;
use app\bms\model\BadTypeInfo;
use think\Session;

class Black extends Controller
{

    public function index(Request $request)
    {
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        $level = Session::get('level','globle');
        
        
        $param = $request->param();
        
        $page = isset($param['page']) ? $param['page'] : 1;
        $beginTime = isset($param['beginTime']) ? $param['beginTime'] : "";
        $endTime = isset($param['endTime']) ? $param['endTime'] : "";
        $acountInfo = isset($param['acountInfo']) ? $param['acountInfo'] : "";

        $query = BlackListModel::where("uid", "<>", 0);
        if (isset($param['beginTime']) && $param['beginTime'] != "") {
            $query->whereTime('create_time', ">=", $param['beginTime']);
        }
        if (isset($param['endTime']) && $param['endTime'] != "") {
            $query->whereTime('create_time', "<", $param['endTime']);
        }
        if (isset($param['acountInfo']) && $param['acountInfo'] != "") {
            $query->where('zhifubao_id', "=", $param['acountInfo'])
            ->whereOr('taobao_id', "=", $param['acountInfo']);
        }
        
        $list = $query->paginate(10);
        
        if ($list->count() == 0 && $page >= 1){
            //重新查询返回集合
            $page = $page - 1;
            $this->redirect("/bms/black/index?page=$page&beginTime=$beginTime&endTime=$endTime&acountInfo=$acountInfo");
        }
        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->assign('level',$level);
        $this->assign('beginTime', $beginTime);
        $this->assign('endTime', $endTime);
        $this->assign('acountInfo', $acountInfo);
        return $this->fetch();
    }
    
    public function addPage(Request $request){
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        $badBehaviorInfo = BadBehaviorInfo::all();
        $badTypeInfo = BadTypeInfo::all();
        $this->assign("badBehaviorInfo",$badBehaviorInfo);
        $this->assign("badTypeInfo",$badTypeInfo);
        return $this->fetch();
    }

    public function addBlacker(Request $request){
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        //session中取出admin_id
        $admin_id = Session::get('adminId','globle');
        //获取ajax请求参数集合
        $param = $request->param();
        //解析请求参数添加到对应的数组中
        $blacker['zhifubao_id'] = $param['zhifubao_id'];
        $blacker['taobao_id'] = $param['taobao_id'];
        $blacker['phone_num'] = $param['phone_num'];
        $blacker['addr'] = $param['addr'];
        $blacker['bad_behavior_id'] = $param['bad_behavior_id'];
        $blacker['bad_type_id'] = $param['bad_type_id'];
        $blacker['admin_id'] = $admin_id;
        //添加到数据库
        $result = BlackListModel::create($blacker);
        //根据插入数据判断是否添加成功并且返回json
        if ($result){
            $resultjson = ['result' => 'success', 'code' => '200'];
            return json($resultjson);
        }else{
            $resultjson = ['result' => 'fail', 'code' => '102'];
            return json($resultjson);
        }
    }
    
    public function delBlacker(Request $request){
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        //获取ajax请求参数集合
        $param = $request->param();
        $id = $param['id'];
        if (isset($id)){
            $user = BlackListModel::get($id);
            if ($user) {
                $user->delete();
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
            
            $blacker = BlackListModel::get($uid);
            if ($blacker) {
                $this->assign('uid', $uid);
                $this->assign('blacker', $blacker);
            }
        } 
        $badBehaviorInfo = BadBehaviorInfo::all();
        $badTypeInfo = BadTypeInfo::all();
        
        $this->assign("badBehaviorInfo",$badBehaviorInfo);
        $this->assign("badTypeInfo",$badTypeInfo);
        return $this->fetch();
    }

    public function validateEditPomission(Request $request){
        $admin_id = Session::get('adminId','globle');
        $param = $request->param();
        $blacker = BlackListModel::get($param['uid']);
        
        if ($admin_id !=3 && $admin_id != $blacker['admin_id']){
            $resultjson = ['result' => 'fail', 'code' => '102'];
            return json($resultjson);
        }else {
            $resultjson = ['result' => 'success', 'code' => '200'];
            return json($resultjson);
        }
    }
    
    public function editBlacker(Request $request){
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        $level = Session::get('level','globle');
        //session中取出admin_id
        $admin_id = Session::get('adminId','globle');
        
        //获取ajax请求参数集合
        $param = $request->param();
        $blacker = BlackListModel::get($param['uid']);
        
        //解析请求参数添加到对应的数组中
        $blacker['uid'] = $param['uid'];
        $blacker['zhifubao_id'] = $param['zhifubao_id'];
        $blacker['taobao_id'] = $param['taobao_id'];
        $blacker['phone_num'] = $param['phone_num'];
        $blacker['addr'] = $param['addr'];
        $blacker['bad_behavior_id'] = $param['bad_behavior_id'];
        $blacker['bad_type_id'] = $param['bad_type_id'];
        //修改
        if ($blacker->save()){
            $resultjson = ['result' => 'success', 'code' => '200'];
            return json($resultjson);
        }else {
            $resultjson = ['result' => 'fail', 'code' => '102'];
            return json($resultjson);
        }
        
    }
    
    public function delBlackers(Request $request){
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        //获取ajax请求参数集合
        $param = $request->param();
        $id = $param['ids'];
        if (isset($id)){
            if (BlackListModel::destroy($id)) {
                $resultjson = ['result' => 'success', 'code' => '200'];
                return json($resultjson);
            } else {
                $resultjson = ['result' => 'fail', 'code' => '102'];
                return json($resultjson);
            }
        }
    }
}

