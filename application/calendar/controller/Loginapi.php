<?php
namespace app\calendar\controller;
use think\facade\Cache;
use think\Db;

class Loginapi{

    public function check(){
        $username=input('post.username');
        $password=input('post.password');
        if($username=='' || $password==''){
            return json(['code'=>0,'errMsg'=>'登录信息不正确']);
        }
        $where[]=['username','like',$username];
        $where[]=['password','like',md5($password)];
        $res=Db::name('user')->where($where)->find();
        if(!$res){
            return json(['code'=>0,'errMsg'=>'登录信息不正确']);
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
        return json(['code'=>1]);

        
    }

    public function loginout(){
        session('Calendar_user_id',null);
        session('Calendar_user_loginkey',null);
        
        return json(['code'=>1]);

        
    }

    // 获取注册验证码
    public function getRegisterGetVCode(){

    }

    // 清空所有的登录信息
    public function cleanLogin(){
        Cache::clear('Calendar_login');
    }

  
}
