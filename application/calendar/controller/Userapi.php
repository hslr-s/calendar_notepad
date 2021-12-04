<?php
namespace app\calendar\controller;
use think\Db;
use think\facade\App;
use app\calendar\lib\UserLib;
class Userapi extends Tkcommon
{
 


    // 获取当前登录用户信息
    public function getUserInfo(){
        $userInfo=Db::name('user')->where('id',$this->userId)->field('username,name,status,auth_id,create_time')->find();
        return $this->apiReturnSuccess($userInfo);
    }

    // 修改个人信息
    public function updateUserInfo(){
        $data['id']=$this->userId;
        $data['username'] = input('post.username/s');
        $data['name'] = input('post.name/s');
        $res = UserLib::editUser($data);
        if ($res['err']) {
            return $this->apiReturnError(0, $res['err']);
        } else {
            $this->apiReturnSuccess(0);
        }
    }

    // 修改密码
    public function updatePassword() {
        $data['id']=$this->userId;
        $old= input('post.old_password/s');
        $data['password'] = input('post.password/s');
        $userInfo=UserLib::getInfo($data['id']);
        if($userInfo['password']!= md5($old)){
            return $this->apiReturnError(0, '旧密码不正确');
        }
        if($userInfo){
            $res = UserLib::editUser($data);
            if ($res['err']) {
                return $this->apiReturnError(0, $res['err']);
            } else {
                $this->apiReturnSuccess(0);
            }
        }else{
            return $this->apiReturnError(0, '用户不存在吧');
        }
       
    }


}
