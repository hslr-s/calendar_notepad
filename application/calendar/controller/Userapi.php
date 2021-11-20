<?php
namespace app\calendar\controller;
use think\Db;
use think\facade\App;
class Userapi extends Tkcommon
{
 


    // 获取当前登录用户信息
    public function getUserInfo(){
        $userInfo=Db::name('user')->where('id',$this->userId)->field('username,name,status,auth_id,create_time')->find();
        return $this->apiReturnSuccess($userInfo);
    }


}
