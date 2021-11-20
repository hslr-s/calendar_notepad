<?php

namespace app\calendar\lib;

use think\Db;
use think\Controller;

class Config  {

    
    // 获取配置
    public static function get(string $key) {
        $info = Db::name('config')->where('config', $key)->value('value');
        return $info;
    }

    // 获取一组配置,前缀 不需要加下划线，自动加
    public static function getGroup(string $prefix) {
        $config=[];
        $info = Db::name('config')->where('config','like', $prefix.'_%')->select();
        foreach ($info as $key => $value) {
            $config[substr($value['config'], strlen($prefix) + 1)]= $value['value'];
        }
        return $config;
    }
    
    // 保存配置
    public static function set(string $key,string $content){
        $res= Db::name('config')->where('config', $key)->find();
        if($res){
            $saveRes=Db::name('config')->where('config', $key)->update(['value'=> $content]);
        }else{
            $saveRes=Db::name('config')->insert(['config'=> $key,'value' => $content]);
        }
        return $saveRes;
    }

    // 保存组配置
    public static function setGroup(string $prefix,array $content) {
        foreach ($content as $key => $value) {
            self::set($prefix.'_' . $key, $value);
        }
    }
}
