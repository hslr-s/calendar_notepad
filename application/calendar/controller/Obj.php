<?php
namespace app\calendar\controller;
use think\Db;
use think\facade\App;
class Obj extends Common
{
 

    public function index(){
        $obj_id=input('get.obj_id');
        if($obj_id){
            $res=Db::name('obj_list')
            ->where('u_id', $this->userId)
            ->where('id',$obj_id)
            ->find();
            $data['title']=$res['name'];
            $data['note']=$res['note'];
            $data['password']=$res['pwd']==''?0:1;
            if($res){
                // return view('index');
                return view('index6', $data);
            }else{
                $this->error("这个项目不存在");
            }
            
        }
    }

    public function getPage($p) {
        // dump($pageName);
        return view($p);
    }
}
