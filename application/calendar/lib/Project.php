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
}
