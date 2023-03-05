<?php

namespace app\calendar\controller;

use think\Db;
use think\facade\App;

class Liapi extends Adminapi {

    public $connectInfo;

    protected function database(){
        $d= $this->connectInfo;
        return [
            // 数据库类型
            'type'        => 'mysql',
            // 数据库连接DSN配置
            'dsn'         => '',
            // 服务器地址
            'hostname'    => $d['database_host'],
            // 数据库名
            'database'    => $d['database_name'],
            // 数据库用户名
            'username'    => $d['database_username'],
            // 数据库密码
            'password'    => $d['database_password'],
            // 数据库连接端口
            'hostport'    => $d['database_port'],
            // 数据库连接参数
            'params'      => [],
            // 数据库编码默认采用utf8
            'charset'     => 'utf8',
            // 数据库表前缀
            'prefix'      => '',
        ];
    }

    public function startTransfer() {
        // dump(input("post."));
        $this->connectInfo= input("post.");
        $count=[];
        try {
            foreach ($this->connectInfo['part'] as $key => $value) {
                if ($key == "main_data") {
                    $res['main_data'] = $this->main_data();
                    $count['main_data']=$res;
                } else if ($key == "event_subject") {
                    $res['event_subject'] = $this->event_subject();
                } else if ($key == "event_style") {
                    $res['event_style'] = $this->event_style();
                } else if ($key == "system_config") {
                    // $res['system_config'] = $this->system_config();
                }
            }
        // Db::connect($this->database())->table('user')->find();
        } catch (\Throwable $th) {
            $this->apiReturnError(0, $th->getMessage());
        }
       

        $this->apiReturnSuccess(json_encode($res));
    }

    protected function main_data(){
        // 用户
        $datas=Db::name("user")->select();
        $newData=[];
        foreach ($datas as $key => $value) {
            $newData[]=[
                'id' => $value['id'],
                "created_at"=> $value['create_time'],
                "updated_at"=> date('Y-m-d H:i:s'),
                "username"=> $value['username'],
                "mail" => $value['username'],
                "password"=> md5(md5($value['password'])),
                "name"=> $value['name'],
                "role" => $value['auth_id'],
                "status"=>$value['status'],
            ];
        }
        Db::connect($this->database())->query('truncate table user;');
        $userRes = Db::connect($this->database())->table('user')->insertAll($newData);

        // 项目
        $datas = Db::name("obj_list")->select();
        $newData = [];
        foreach ($datas as $key => $value) {
            $newData[] = [
                'id'=>$value['id'],
                "created_at" => $value['create_time'],
                "updated_at" => date('Y-m-d H:i:s'),
                "title" => $value['name'],
                "password" => $value['pwd'],
                "user_id" => $value['u_id'],
                "description" => $value['note'],
                "sort" => $value['sort'],
            ];
        }
        Db::connect($this->database())->query('truncate table item;');
        $itemRes = Db::connect($this->database())->table('item')->insertAll($newData);

        // 事件
        $datas = Db::name("note_list")->select();
        $newData = [];
        foreach ($datas as $key => $value) {
            $uid=Db::name('obj_list')->where('id', $value['obj_id'])->value('u_id');
            $newData[] = [
                'id'=>$value['id'],
                "created_at" => $value['create_time'],
                "updated_at" => date('Y-m-d H:i:s'),
                "title" => $value['title'],
                "content" => $value['content'],
                "user_id" => $uid,
                "item_id" => $value['obj_id'],
                "class_name" => $value['class_name']?("php-". $value['class_name']):"",
                "start_time" => $value['start_time'],
                "end_time" => $value['end_time'],
            ];
        }
        Db::connect($this->database())->query('truncate table event;');
        $eventRes = Db::connect($this->database())->table('event')->insertAll($newData);

        return ["user"=> $userRes,"item"=> $itemRes,"event"=> $eventRes];
    }

    protected function event_style() {
        $datas = Db::name("style_list")->select();
        $newData = [];
        foreach ($datas as $key => $value) {
            $newData[] = [
                'id'=>$value['id'],
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                "sort" => $value['sort'],
                "title" => $value['name_cn'],
                "class_name" => "php-".$value['name'],
                "text_color" => $value['text_color'],
                "background_color" => $value['background_color'],
                "border_color" => $value['border_color'],
            ];
        }
        Db::connect($this->database())->query('truncate table style;');
        $res = Db::connect($this->database())->table('style')->insertAll($newData);
        return $res;
    }
    
    protected function event_subject() {
        $datas = Db::name("obj_subject")->select();
        $newData = [];
        foreach ($datas as $key => $value) {
            $newData[] = [
                'id' => $value['id'],
                "created_at" => $value['create_time'],
                "updated_at" => date('Y-m-d H:i:s'),
                "item_id" => $value['obj_id'],
                "title" => $value['title'],
            ];
        }
        Db::connect($this->database())->query('truncate table subject;');
        $res = Db::connect($this->database())->table('subject')->insertAll($newData);
        return $res;
    }

    // protected function system_config() {
    //     $datas = Db::name("obj_subject")->where('config','like', 'sys_mail_%')->select();
    //     $newData = [];
    //     foreach ($datas as $key => $value) {
    //         $newData[] = [
    //             'id' => $value['id'],
    //             "created_at" => $value['create_time'],
    //             "updated_at" => date('Y-m-d H:i:s'),
    //             "item_id" => $value['obj_id'],
    //             "title" => $value['title'],
    //         ];
    //     }
    //     Db::connect($this->database())->query('truncate table subject;');
    //     $res = Db::connect($this->database())->table('subject')->insertAll($newData);
    //     return $res;
    // }
}
