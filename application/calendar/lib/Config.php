<?php

namespace app\calendar\lib;

use think\Db;
use think\Controller;

class Config  {

    
    // 获取配置
    public static function get($key) {
        $info = Db::name('config')->where('config', $key)->value('value');
        return $info;
    }

    // 获取一组配置,前缀 不需要加下划线，自动加
    public static function getGroup($prefix) {
        $config=[];
        $info = Db::name('config')->where('config','like', $prefix.'_%')->select();
        foreach ($info as $key => $value) {
            dump(substr($value['config'], strlen($value['config']) + 1));
            $config[substr($value['config'], strlen($value['config']) + 1)]= $value['value'];
        }
        dump($config);
        return $config;
    }
    
    // 保存配置
    public static function set($key,$content){
        $res=self::get($key);
        if($res){
            $saveRes=Db::name('config')->where('config', $key)->update(['value'=> $content]);
        }else{
            $saveRes=Db::name('config')->insert(['config'=> $key,'value' => $content]);
        }
        return $saveRes;
    }
}
