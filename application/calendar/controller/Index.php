<?php
namespace app\calendar\controller;
use think\Db;
use think\facade\App;
class Index extends Common
{
    // http://calendar.cn/calendar/index/design

    public function logout(){
        session('NoteBook_user_id',null);
        session('NoteBook_user_loginkey',null);
        $this->success('已退出登录','index/login');
    }
}
