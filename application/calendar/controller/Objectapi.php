<?php
namespace app\calendar\controller;
use think\Db;
use think\facade\App;
class Objectapi extends Common
{
 
    public function getConfig(){
        $obj_id=input('get.obj_id');
        $where[]=['obj_id','like',$obj_id];
        $findRes=Db::name('obj_config')->where($where)->select();
        $config=[];
        foreach ($findRes as $key => $value) {
            $config[$value['config']]=$value['value'];
        }
        return json(['code'=>1,'data'=>$config]);
    }

    public function getList(){
        $findRes=Db::name('obj_list')
        ->where('u_id', $this->userId)
        ->order('update_time desc')->select();
        return json(['code'=>1,'data'=>$findRes]);
    }

    public function pwdCheck(){
        $obj_id=input('get.obj_id');
        $pwd=input('post.pwd');
        $where[]=['id','like',$obj_id];
        $getPwd=Db::name('obj_list')->where($where)->value('pwd');
        if($pwd==$getPwd){
            return json(['code'=>1]);
        }else{
            return json(['code'=>0]);
        }
    }

    public function update(){
        $data=input('post.');
        $obj_id=input('get.obj_id');
        

        foreach ($data as $key => $value) {
            $where=[];
            $where[]=['config','like',$key];
            $where[]=['obj_id','like',$obj_id];
            $findRes=Db::name('obj_config')->where($where)->find();
            if($findRes){
                $updateData['config']=$key;
                $updateData['value']=$value;
                Db::name('obj_config')->where('id',$findRes['id'])->update($updateData);
            }else{
                $insertData['config']=$key;
                $insertData['value']=$value;
                $insertData['obj_id']=$obj_id;
                Db::name('obj_config')->insert($insertData);
            }
        }
        return json(['code'=>1]);
    }

    // 添加一个项目
    public function add(){
        $name = input('post.name');
        $insertData['name']=$name;
        $insertData['create_time'] = date('Y-m-d H:i:s');
        $insertData['update_time'] = $insertData['create_time'];
        $insertData['u_id'] = $this->userId;
        
        $id=Db::name('obj_list')->insertGetId($insertData);
        $insertData['id']=$id;
        return json(['code' => 1,'data'=> $insertData]);
    }
}
