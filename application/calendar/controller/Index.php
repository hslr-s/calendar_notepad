<?php
namespace app\calendar\controller;
use think\Db;
use think\facade\App;
class Index extends Common
{
    // http://calendar.cn/calendar/index/design

    public function logout(){
        session('Calendar_user_id', null);
        session('Calendar_user_loginkey', null);
        $this->success('已退出登录','index/login');
    }
}
