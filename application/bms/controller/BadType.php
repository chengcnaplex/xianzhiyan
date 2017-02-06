<?php
namespace app\bms\controller;

use think\Controller;
use think\Request;
use app\bms\model\BadTypeInfo;
use think\Session;

class BadType extends Controller
{
    public function index(Request $request)
    {
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        $param = $request->param();
        $list = BadTypeInfo::paginate(10);
        $this->assign('list', $list);
        return $this->fetch();
    }
    
    public function addPage(Request $request){
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        return $this->fetch();
    }
    
    public function addBadType(Request $request){
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        //获取ajax请求参数集合
        $param = $request->param();
        //解析请求参数添加到对应的数组中
        $badType['bad_type_detail'] = $param['bad_type_detail'];
        //添加到数据库
        $result = BadTypeInfo::create($badType);
        //根据插入数据判断是否添加成功并且返回json
        if ($result){
            $resultjson = ['result' => 'success', 'code' => '200'];
            return json($resultjson);
        }else{
            $resultjson = ['result' => 'fail', 'code' => '102'];
            return json($resultjson);
        }
    }
    
    public function editPage(Request $request){
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        //获取ajax请求参数集合
        $param = $request->param();
        $bad_type_id = $param['bad_type_id'];
        if (isset($param['bad_type_id'])){
            $badTypeInfo = BadTypeInfo::get($bad_type_id);
            if ($badTypeInfo) {
                $this->assign('badTypeInfo', $badTypeInfo);
            }
        }
        $this->assign("badTypeInfo",$badTypeInfo);
        return $this->fetch();
    }
    
    
    public function editBadType(Request $request){
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        
        //获取ajax请求参数集合
        $param = $request->param();
        $badTypeInfo = BadTypeInfo::get($param['bad_type_id']);
        $badTypeInfo['bad_type_id'] = $param['bad_type_id'];
        $badTypeInfo['bad_type_detail'] = $param['bad_type_detail'];
        //解析请求参数添加到对应的数组中
        //修改
        if ($badTypeInfo->save()){
            $resultjson = ['result' => 'success', 'code' => '200'];
            return json($resultjson);
        }else {
            $resultjson = ['result' => 'fail', 'code' => '102'];
            return json($resultjson);
        }
    }
    
    public function delBadType(Request $request){
        if (!Session::has('username','globle'))
        {
            $this->redirect('/');
        }
        //获取ajax请求参数集合
        $param = $request->param();
        $bad_type_id = $param['bad_type_id'];
        if (isset($bad_type_id)){
            $badType = BadTypeInfo::get($bad_type_id);
            if ($badType) {
                $badType->delete();
                $resultjson = ['result' => 'success', 'code' => '200'];
                return json($resultjson);
            } else {
                $resultjson = ['result' => 'fail', 'code' => '102'];
                return json($resultjson);
            }
        }
    }
}
