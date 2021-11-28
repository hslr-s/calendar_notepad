<?php
namespace app\calendar\controller;
use think\Db;

use app\calendar\lib\Email;
use app\calendar\lib\Config;
use app\calendar\lib\Verification;
use app\calendar\lib\UserLib;
class Adminapi extends Tkcommon
{

    public function initialize(){
        $this->loginStatusCheck();
        $userInfo=Db::name('user')->where('id',$this->userId)->find();
        if($userInfo['auth_id']!=1){
            $this->apiReturnError(0, '你不是管理员没有权限进行此操作');
        }
    }

    // 创建用户
    public function editUser() {
        $data['id'] = input('post.user_id');
        
        $data['username'] = input('post.username/s');
        $data['password'] = input('post.password/s');
        $data['name'] = input('post.name/s');
        $data['status'] = input('post.status/d');
        $data['auth_id'] = input('post.auth_id/d');
        $res=UserLib::editUser($data);
        if($res['err']){
            return $this->apiReturnError(0, $res['err']);
        }else{
            $this->apiReturnSuccess(0);
        }
    }
    
    // 用户列表
    public function getUserList(){
        $username=input('post.username');
        $where=[];
        if($username)$where[]=['username','=',$username];
        
        $findRes=Db::name('user')->where($where)->field('id,name,username,status,auth_id,create_time')->select();
        $count = Db::name('user')->where($where)->count();
       
        $this->apiReturnList($findRes, $count);
    }

    // // 修改用户信息
    // public function updateUserInfo() {
    //     $userId = input('post.user_id');
    //     $auth_id = input('post.auth_id');
    //     $status = input('post.status');
    //     $where[] = ['id', '=', $userId];
    //     $where[] = ['auth_id', '=', $auth_id];
    //     Db::name('user')->where($where)->update(['status'=> $status? $status:0]);
    //     $this->apiReturnSuccess(0);
    // }

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

    // 发送测试邮件
    public function sendTestMail(){
        $config['from_name'] = '日历记事本'; //发现人名称
        $config['username'] = input('post.username'); //账号
        $config['password'] = input('post.password'); //密码
        $config['from'] = input('post.username'); //发件人邮箱
        $config['host'] = input('post.host');
        $config['port'] = input('post.port');
        $toUser = input('post.to_user'); //收件人
        if(!Verification::checkMail($config['username'])){
            $this->apiReturnError(0, '账号(邮箱)的格式不正确');
        }
        if (!Verification::checkMail($toUser)) {
            $this->apiReturnError(0, '收件人邮箱的格式不正确');
        }
        // if (!Verification::checkPassword($config['password'])) {
        //     $this->apiReturnError(0, '密码在6-18位之间，可以是小写字母、大写字母、数字或者是".","@","_"');
        // }
        $mail=new Email();
        $res=$mail->sendMailBase($config, $toUser,'日历记事本测试邮件','这是一条测试邮件，如果你看见了此邮件，证明你邮箱信息填写没有问题，可以保存进行下一步操作了呦！');
        if($res){
            $this->apiReturnSuccess([]);
        }else{
            $this->apiReturnError(0,'发送失败,请检查各项信息填写是否正确');
        }
    }


    // 保存邮件信息
    public function saveMailConfig(){
        $config['host'] =  input('post.host'); //域名邮箱的服务器地址
        $config['from_name'] = '日历记事本'; //发现人名称
        $config['username'] = input('post.username'); //账号
        $config['password'] = input('post.password'); //密码
        $config['from'] = input('post.username'); //发件人邮箱
        $config['port'] = input('post.port'); //端口
        if (!Verification::checkMail($config['username'])) {
            $this->apiReturnError(0, '账号(邮箱)的格式不正确');
        }
        Config::setGroup('sys_mail',$config);
        return $this->apiReturnSuccess(0);
    }

    // 获取邮箱配置
    public function getMailConfig(){
        $res=Config::getGroup('sys_mail');
        return $this->apiReturnSuccess($res);
    }

    // 保存其他配置
    public function saveSystemOtherConfig() {
        $config['open_register'] = input('post.open_register'); //端口
       
        Config::setGroup('sys_other', $config);
        return $this->apiReturnSuccess(0);
    }

    // 获取其他配置
    public function getSystemOtherConfig() {
        $res = Config::getGroup('sys_other');
        return $this->apiReturnSuccess($res);
    }

   
}
