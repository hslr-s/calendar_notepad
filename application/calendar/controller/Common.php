<?php
namespace app\calendar\controller;
use think\Db;
use think\Cache;
use think\Controller;

class Common extends Controller{

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
            $loginKey=$res['loginkey'];
            if($loginKey!=''){
                \think\facade\Cache::tag('Calendar_login')->set('Calendar_login_loginkey_'.$uid,$loginKey);
            }
            
        }
        // dump([$loginKey,$uid,session('Calendar_user_loginkey')]);
        if($loginKey=='' or $loginKey!=session('Calendar_user_loginkey')){
            $this->error('未登录','/calendar/index/login');
            return ['code'=>0];
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

    public function file_hash($file){
        $blockSize=4*1024*1024;
        $f = fopen($file, "r");
        if (!$f) exit("open $file error");
     
        $fileSize = filesize($file);
        $buffer   = '';
        $sha      = '';
        // 一共有多少分片
        $blkcnt   = $fileSize/$blockSize;
        if ($fileSize % $blockSize) $blkcnt += 1;
        // 把数据装入一个二进制字符串
        $buffer .= pack("L", $blkcnt);
        if ($fileSize <= $blockSize) {
            $content = fread($f, $blockSize);
            if (!$content) {
                fclose($f);
                exit("read file error");
            }
            $sha .= sha1($content, TRUE);
        } else {
            for($i=0; $i<$blkcnt; $i+=1) {
                $content = fread($f, $blockSize);
                if (!$content) {
                    if (feof($f)) break;
                    fclose($f);
                    exit("read file error");
                }
                $sha .= sha1($content, TRUE);
            }
            $sha = sha1($sha, TRUE);
        }
        $buffer .= $sha;
        $hash = $this->urlSafeEncode(base64_encode($buffer));
        fclose($f);
        return $hash;
    }

    public function urlSafeEncode($data){
        $find = array('+', '/');
        $replace = array('-', '_');
        return str_replace($find, $replace, $data);
    }

    public function rapi($data=[],$err_code=0,$err_msg='SUCCESS'){
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode(['data'=>$data,'code'=>$err_code,'err_msg'=>$err_msg]));
    }

    

    public function apiReturn($code,$msg="OK",$data=null){
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode(['code' => $code, 'data' => $data, 'msg' => $msg])) ;
    }

    public function apiReturnSuccess( $data) {
        return $this->apiReturn(1,  "OK", $data);
    }

    public function apiReturnError($code, $msg) {
        return $this->apiReturn($code,  $msg,null);
    }


    // 转到页面
    public function _empty($name) {
        // dump(request());
        // dump(request()->controller().'/'.request()->action());
        return view(strtolower(request()->controller()).'/'.strtolower(request()->action()));
    }

  
}
