<?php
namespace app\calendar\controller;
use think\Db;
use think\facade\App;
class Index extends Common
{
    // http://calendar.cn/calendar/index/design

    public function index(){
        // return view('../static/pages/index.html');
        return $this->fetch('../public/static/pages/index.html');
    }

}
