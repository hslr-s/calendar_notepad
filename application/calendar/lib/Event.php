<?php

namespace app\calendar\lib;

use think\Db;
use think\Controller;

class Event  {

    
   

    // 添加事件
    public static function addGetId($data, $obj_id){
        $insertData['title'] = $data['title'];
        $insertData['color'] = isset($data['color']) ? $data['color'] : '';
        $insertData['class_name'] = isset($data['class_name']) ? $data['class_name'] : '';
        $insertData['content'] = $data['content'];
        $insertData['start_time'] = $data['start_time'];
        $insertData['end_time'] = $data['end_time'];
        $insertData['create_time'] = date('Y-m-d H:i:s');
        $insertData['obj_id'] = $obj_id;
        $event_id = Db::name('note_list')->insertGetId($insertData);
        Db::name('obj_list')->where('id', $obj_id)->update(['update_time' => date('Y-m-d H:i:s')]);
        return $event_id;
    }
}
