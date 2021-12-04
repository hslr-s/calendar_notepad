<?php

namespace app\calendar\lib;

use think\Db;
use think\Controller;

class Project  {

    
    // 获取详情
    public static function getInfo($proId) {
        $info = Db::name('obj_list')->where('id', $proId)->find();
        return $info;
    }

    // 添加项目
    public static function addGetId($name,$user_id){
        $insertData['name'] = $name;
        $insertData['create_time'] = date('Y-m-d H:i:s');
        $insertData['update_time'] = $insertData['create_time'];
        $insertData['u_id'] = $user_id;

        $id = Db::name('obj_list')->insertGetId($insertData);
        return $id;
    }
}
