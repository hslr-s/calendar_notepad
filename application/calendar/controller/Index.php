<?php
namespace app\calendar\controller;
use think\Db;
use think\facade\App;
class Index extends Common
{
    public function login(){
        return view('');
    }

    public function test(){
        return view('');
    }

    public function design(){
        return view('');
    }

    public function index(){
        return view('obj/list');
    }

    public function logout(){
        session('NoteBook_user_id',null);
        session('NoteBook_user_loginkey',null);
        $this->success('已退出登录','index/login');
    }
}
