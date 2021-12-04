<?php
namespace app\calendar\controller;
use think\Db;
use think\facade\App;
use app\calendar\lib\Project as libProject;
use app\calendar\lib\Email;
class Objectapi extends Tkcommon
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

    // 获取设置内容
    public function getSetting() {
        $obj_id = input('get.obj_id');


        $info = libProject::getInfo($obj_id);
        

        $where[] = ['obj_id', 'like', $obj_id];
        $findRes = Db::name('obj_config')->where($where)->select();
        $config = [];
        foreach ($findRes as $key => $value) {
            $config[$value['config']] = $value['value'];
        }
        $config['project_name']=$info['name'];
        $config['project_note']=$info['note'];
        $config['project_password'] = $info['pwd'];
        return json(['code' => 1, 'data' => $config]);
    }

    public function getList(){
        $findRes=Db::name('obj_list')
        ->where('u_id', $this->userId)
        ->order('update_time desc')->select();
        foreach ($findRes as $key => $value) {
            unset($value['pwd']);
        }
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
        if($this->object_is_user($obj_id)==false){
            $this->apiReturnError(0,'不是你的项目');
        }
        

        foreach ($data as $key => $value) {
            if(substr($key,0,8)=='project_'){
                if(substr($key, 8)=='password'){
                    Db::name('obj_list')->where('id', $obj_id)->update(['pwd'=> $value]);
                }
                if (substr($key, 8) == 'name' && $value) {
                    Db::name('obj_list')->where('id', $obj_id)->update(['name' => $value]);
                }
                if (substr($key, 8) == 'note' && $value) {
                    Db::name('obj_list')->where('id', $obj_id)->update(['note' => $value]);
                }
                continue;
            }
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
        return $this->apiReturnSuccess([]);
    }

    // 添加一个项目
    public function add(){
        $name = input('post.name');
        $insertData['id']=libProject::addGetId($name,$this->userId);
        return $this->apiReturnSuccess($insertData);
    }

    // 获取详情
    public function getInfo(){
        $obj_id = input('get.obj_id');
        $info=libProject::getInfo($obj_id);
        if($info && $info['pwd']){
            unset($info['pwd']);
            $info['password']=true;
        }
        $this->apiReturnSuccess($info);
    }

    // 找回密码
    public function retrievePassword(){
        $obj_id = input('get.obj_id');
        if(!$this->object_is_user($obj_id)){
            $this->apiReturnError(0, '此项目不是你的');
        }
        $info = libProject::getInfo($obj_id);
        if($info){
            $mail=new Email();
            $status=$mail->sendTplMail('95302870@qq.com','日历记事本 - 项目密码找回','您的项目['. $info['name'].']访问密码是：'. $info['pwd'].'。');
            if($status){
                $this->apiReturnSuccess([]);
            }else{
                $this->apiReturnError(0,'邮件发送失败，请联系管理员');
            }
        }
        $this->apiReturnError(0, '我觉得此项目好像没有设置密码');
    }

    // 删除项目
    public function delete(){
        $obj_id = input('post.obj_id');
        $name = input('post.name');// 项目名字
        $res=Db::name('obj_list')->where('id', $obj_id)->where('name', $name)->delete();
        if($res){
            $this->apiReturnSuccess([]);
        }else{
            $this->apiReturnError(0,'删除失败，请刷新后重试');
        }
        
    }
}
