<?php

namespace app\calendar\lib;

use think\Db;
use think\Controller;

class Verification {


    // 验证密码
    public static function checkPassword($v) {
        $pattern = "/^[0-9a-zA-Z_\.@]{6,16}$/i";
        if (preg_match($pattern, $v)) {
            return true;
        } else {
            return false;
        }
    }

    // 验证邮箱
    public static function checkMail($mail){
        $regex = '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
        return preg_match($regex, $mail);
    }
  
}
