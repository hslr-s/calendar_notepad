<?php
namespace app\calendar\controller;
use think\facade\Cache;
use think\Db;

use app\calendar\lib\Email;
use app\calendar\lib\Config;
use app\calendar\lib\Verification;

class Loginapi extends Common{

    public function check(){
        $username=input('post.username');
        $password=input('post.password');
        if($username=='' || $password==''){
            $this->apiReturnError(0,'登录信息不正确');
        }
        $where[]=['username','like',$username];
        $where[]=['password','like',md5($password)];
        $where[]=['status','=',1];
        $res=Db::name('user')->where($where)->find();
        if(!$res){
            $this->apiReturnError(0, '账号或密码错误，或者账号被锁定');
        }
        if($res['loginkey']==""){
            $loginKey=md5(date('Y-m-d H:i:s').$username).$username;
            Db::name('user')->where('id',$res['id'])->update(['loginkey'=>$loginKey]);
            Cache::tag('Calendar_login')->set('Calendar_login_loginkey_'.$res['id'],$loginKey);
        }else{
            $loginKey=$res['loginkey'];
            Cache::tag('Calendar_login')->set('Calendar_login_loginkey_'.$res['id'],$loginKey);
        }
        session('Calendar_user_loginkey',$loginKey);
        session('Calendar_user_id',$res['id']);
        // return json(['code'=>1]);
        $returnData=[];
        $returnData['auth_id']=$res['auth_id'];
        $returnData['username'] = $res['username'];
        $returnData['name'] = $res['name'];
        $this->apiReturnSuccess($returnData);
    }

    public function logout(){
        session('Calendar_user_id',null);
        session('Calendar_user_loginkey',null);
        $this->apiReturnSuccess([]);
    }

    // 获取注册验证码
    public function getRegisterGetVCode(){
        $mail=input('post.mail');
        if(!$this->checkMail($mail)){
            $this->apiReturnError(0,'邮箱格式不正确');
        }

        // 判断邮箱是否被注册
        $findRes=Db::name('user')->where('username')->find();
        if($findRes){
            $this->apiReturnError(0, '此邮箱已被注册');
        }
       

        // 生成注册验证码，并进行缓存，等待验证
        $code= $this->makePassword(6);
        cache('register_'.$mail, $code, 3600);
        // dump(cache('register_' . $mail));

        $mailObj = new Email();
        if($mailObj->sendMail($mail,'欢迎注册日历记事本','你的注册验证码是:'.$code)){
            $this->apiReturnSuccess([]);
        }else{
            $this->apiReturnError(0, '邮件发送失败，请联系管理员');
        }
    }


    // 注册信息提交
    public function registerSubmit() {
        $mail = input('post.username');
        $name = input('post.name');
        $password = input('post.password');
        $callback_url = input('post.callback_url');
        $openRegist=Config::get('sys_open_regist');

        if(!$openRegist){
            $this->apiReturnError(0, '管理员未开放注册功能，请联系管理员');
        }

        if (!$this->checkMail($mail)) {
            $this->apiReturnError(0, '邮箱格式不正确');
        }

        // 判断邮箱是否被注册
        $findRes = Db::name('user')->where('username', $mail)->find();
        if ($findRes) {
            $this->apiReturnError(0, '此邮箱已被注册');
        }

        // 验证密码
        $isPassWord=$this->checkPassword($password);
        if (!$isPassWord) {
            $this->apiReturnError(0, '密码在6-18位之间，可以是小写字母、大写字母、数字或者是".","@","_"');
        }

        // 生成一段code作为注册时的凭证
        $code = $this->makePassword(50);

        $registerInfo['username'] = $mail;
        $registerInfo['password'] = $password;
        $registerInfo['name'] = $name;
        $registerInfo['callback_url'] = $callback_url;

        cache('register_' . $code, $registerInfo, 3600);
        $url= $callback_url.'?code='.$code;
        $mailObj = new Email();
        if ($mailObj->sendMail($mail, '欢迎注册日历记事本', '请点击下面链接完成注册（1小时内有效）：<br>' . $url )) {
            $this->apiReturnSuccess([]);
        } else {
            $this->apiReturnError(0, '邮件发送失败，请联系管理员');
        }
    }

    // 获取开放配置(允许注册等)
    public function getOpenInfo(){
        $res=Config::get('sys_other_open_register');
        return $this->apiReturnSuccess(['open_register'=> $res]);
    }

    // 链接方式注册
    public function linkRegister(){
        $code=input('get.code');
        $info=cache('register_' . $code);
        if(!$info){
            $this->apiReturnError(0, '链接已过期');
        }
        $findRes = Db::name('user')->where('username', $info['username'])->find();
        if ($findRes) {
            $this->apiReturnError(0, '此邮箱已被注册');
        }
        $insert['username']= $insert['name'] =  $info['username'];
        $insert['password'] = md5($info['password']);
        $insert['create_time'] = date('Y-m-d H:i:s');
        $insert['name'] = $info['name'];
        Db::name('user')->insert($insert);
        cache('register_' . $code,null); //删除缓存

        // 注册完成发送邮件
        $mailObj = new Email();
        $mailObj->sendMail($info['username'], '【日历记事本】注册成功', '终于等到你了' . $info['name'].'，现在开始记录你的生活吧。');
        $this->apiReturnSuccess([]);
    }

    // 清空所有的登录信息
    public function cleanLogin(){
        Cache::clear('Calendar_login');
    }


    protected function checkMail($mail){
        return Verification::checkMail($mail);
    }

    protected function makePassword($length = 8, $chars = '') {
        if (empty($chars)) {
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        }
        $chars = str_shuffle($chars);
        $num = $length < strlen($chars) - 1 ? $length : strlen($chars) - 1;
        return substr($chars, 0, $num);
    }

    // 验证密码
    protected function checkPassword($v){
        return Verification::checkPassword($v);
    }
  
}
