<?php
namespace app\calendar\controller;
use think\Db;

class Adminapi extends Tkcommon
{
    
    // 用户列表
    public function getUserList(){
        $username=input('post.username');
        $where=[];
        if($username)$where[]=['username','=',$username];
        
        $findRes=Db::name('user')->where($where)->select();
        $count = Db::name('user')->where($where)->count();
       
        $this->apiReturnSuccess(['count'=> $count,'data'=> $findRes]);
    }

    // 修改用户信息（仅支持修改状态）
    public function updateUserInfo() {
        $userId = input('post.user_id');
        $auth_id = input('post.auth_id');
        $status = input('post.status');
        $where[] = ['id', '=', $userId];
        $where[] = ['auth_id', '=', $auth_id];
        Db::name('user')->where($where)->update(['status'=> $status? $status:0]);
        $this->apiReturnSuccess(0);
    }

    // 删除用户
    public function delete() {
        $userId = input('post.user_id');
        if ($userId == 1) {
            $this->apiReturnError(0,'第一个用户不可删除');
        }
        $where[] = ['id', '=', $userId];
        Db::name('user')->where($where)->delete();
        $this->apiReturnSuccess(0);
    }

   
}
