<?php

namespace app\calendar\lib;

use think\Db;
use think\Controller;

class UserLib  {

    // 编辑/添加用户
    public static function editUser($param) {
        $returnData=['data'=>'','err'=>''];
        $uid = isset($param['id'])? $param['id']: null;

        $username = isset($param['username'])? $param['username']: null;
        $password = isset($param['password'])? $param['password']: null;
        $name = isset($param['name'])? $param['name']: null;
        $status = isset($param['status'])? $param['status']: null;
        $auth_id = isset($param['auth_id'])? $param['auth_id']: null;

        $findRes = Db::name('user')->where('username', $username)->find();

        if ($username && !Verification::checkMail($username)) {
            $returnData['err']= '邮箱（账号）格式不正确';
            return $returnData;
        }
        if ($password && !Verification::checkPassword($password)) {
            // $this->apiReturnError(0, '密码格式不正确，可以是小写字母、大写字母、数字或者是".","@","_"');
            $returnData['err'] = '密码格式不正确，可以是小写字母、大写字母、数字或者是".","@","_"';
            return $returnData;
        }

        if ($username)$data['username'] = $username;
        if ($name) $data['name'] = $name;
        if ($status) $data['status'] = $status;
        if ($auth_id) $data['auth_id'] = $auth_id;
        
        if ($uid) {
            // 修改

            if ($findRes && $findRes['id'] != $uid) {
                // $this->apiReturnError(0, '用户已存在，不可以修改');
                $returnData['err'] = '用户已存在，不可以修改';
                return $returnData;
            }
            if ($password) {
                $data['password'] = md5($password);
            }
            $data['loginkey'] = '';
            $res=Db::name('user')->where('id', $uid)->update($data);
        } else {
            // 添加

            if (isset($findRes['id'])) {
                $returnData['err'] = '用户已存在，请更换账号后重试';
                return $returnData;
            }
            $data['password'] = md5($password);
            $data['create_time'] = date('Y-m-d H:i:s');
            if ($password == '' || $username == ''  || $status == '' || $auth_id == '') {
                $returnData['err'] = '信息填写不完整';
                return $returnData;
            }
            $res=Db::name('user')->insert($data);
        }
        $returnData['data']= $res;
        return $returnData;
    }

    // 获取用户详情
    public static function getInfo($uid){
        return Db::name('user')->where('id',$uid)->find();
    }
}
