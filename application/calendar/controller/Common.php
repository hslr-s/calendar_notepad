<?php
namespace app\calendar\controller;
use think\Db;
use think\Cache;
use think\Controller;

class Common extends Controller{


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
