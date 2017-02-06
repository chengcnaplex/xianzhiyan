<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // 分隔符用斜杠 / 不能用反斜杠\
    '' => 'login/index/login_page',
    'login/loginpage' => 'login/index/login_page',
    'login/signin' => 'login/index/signin',
    'login/signout' => 'login/index/signin',
    
    'homepage/index/index' => 'homepage/index/index',
    'homepage/index/search' => 'homepage/index/search',
    
    'bms/index/index' => 'bms/index/index',
    
    'bms/black/index' => 'bms/black/index',
    'bms/black/addpage' => 'bms/black/addpage',
    'bms/black/addblacker' => 'bms/black/addblacker',
    'bms/black/delblacker' => 'bms/black/delblacker',
    'bms/black/delblackers' => 'bms/black/delblackers',
    'bms/black/editpage' => 'bms/black/editpage',
    'bms/black/editblacker' => 'bms/black/editblacker',
    'bms/black/validateEditPomission' => 'bms/black/validateEditPomission',
    
    'bms/badbehavior/index' => 'bms/badBehavior/index',
    
    //路径            =>  模块 控制器(大小写敏感) 方法(大小写不敏感)
    'bms/badtype/index' => 'bms/badType/index',
    'bms/badtype/addpage' => 'bms/badType/addPage',
    'bms/badtype/addbadtype' => 'bms/badType/addBadType',
    'bms/badtype/editpage' => 'bms/badType/editpage',
    'bms/badtype/editbadtype' => 'bms/badType/editBadType',
    'bms/badtype/delbadtype' => 'bms/badType/delBadType',
    
    'bms/admin/index' => 'bms/admin/index',
    'bms/admin/addpage' => 'bms/admin/addPage',
    'bms/admin/addAdmin' => 'bms/admin/addAdmin',
    'bms/admin/delAdmin' => 'bms/admin/delAdmin',
    'bms/admin/editpage' => 'bms/admin/editPage',
    'bms/admin/editadmin' => 'bms/admin/editAdmin',
];
