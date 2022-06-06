<?php
namespace app\calendar\controller;
use think\Db;
use think\Cache;
use think\Controller;

class Tkcommon extends Common{

    protected $beforeActionList = [
        'loginStatusCheck'=>['except'=>'login']
    ];

    public $userId;

    public function loginStatusCheck(){
        $uid=$this->userId=session('Calendar_user_id');

        $loginKey=cache('Calendar_login_loginkey_'.$uid);
        // 缓存中没有loginKey，则读取数据库，并保存
        if(!$loginKey){
            $res=Db::name('user')->where('id',$uid)->find();
            if(isset($res['loginkey'])){
                $loginKey = $res['loginkey'];
                \think\facade\Cache::tag('Calendar_login')->set('Calendar_login_loginkey_'.$uid,$loginKey);
            }
            
        }
        // dump([$loginKey,$uid,session('Calendar_user_loginkey')]);
        if($loginKey=='' or $loginKey!=session('Calendar_user_loginkey')){
            $this->apiReturnError(1000,'未登录或登录过期');
        }
    }

    

    /**
     * 参数检测
     * @param  [type] $params   [description]
     * @param  [type] $allparam [description]
     * @return [type]           [description]
     */
    public function param_exists($params,$allparam){
        foreach ($params as $k => $v) {
            if(!in_array($v, $allparam)){
                return $v;
            }
        }
        return true;
    }

    public function object_is_user($object_id){
        // 判断该项目是否为该用户所有
        $whereMap[]=['id','like',$object_id];
        $whereMap[]=['u_id','like',$this->userId];
        $res=Db::name('obj_list')->where($whereMap)->find();
        if(!$res){
            return false;
        }
        return true;
    }

}
