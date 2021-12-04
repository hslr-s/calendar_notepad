<?php
namespace app\calendar\controller;
use think\Db;
use think\facade\App;
use app\calendar\lib\Event as libEvent;
use app\calendar\lib\Project as libProject;
class Eventapi extends Tkcommon
{

    protected $beforeActionList = [
        'loginStatusCheck',
        'pwdCheck',
    ];


    // 访问密码验证
    public function pwdCheck(){
        $pwd=input('post.pwd');
        $objId = input('get.obj_id');
        $info=libProject::getInfo($objId);
        
        if (!$info || $info['u_id']!=$this->userId) {
            // 项目不存在
            return $this->apiReturnError(0,'项目不存在');
        }

        // 接口密码验证
        
        // // 无需密码
        // if(!$info['pwd']){
        //     return ;
        // }
        
        // // 没输入密码并且有密码
        // if (!$pwd && $info['pwd']) {
        //     return $this->apiReturnError(-1, '需要密码但是没有输入');
        // }

        // // 输入密码，并且等于
        // if($pwd && $info['pwd']!=$pwd){
        //     return $this->apiReturnError(0, '密码错误');
        // }
    }

 
    public function add(){
        $data=input('post.');
        $obj_id=input('get.obj_id');
        $event_id=libEvent::addGetId($data, $obj_id);
        return json(['code'=>1,'event_id'=>$event_id]);
    }

    public function delete(){
        $data=input('post.');
        $obj_id=input('get.obj_id');
        $where[]=['id','like',$data['event_id']];
        $where[]=['obj_id','like',$obj_id];
        Db::name('note_list')->where($where)->delete();
        Db::name('obj_list')->where('id', $obj_id)->update(['update_time' => date('Y-m-d H:i:s')]);
        return json(['code'=>1]);
    }

    public function update(){
        $data=input('post.');
        $obj_id=input('get.obj_id');
        $where[]=['id','like',$data['event_id']];
        $where[]=['obj_id','like',$obj_id];

        $updateData['title']=$data['title'];
        $updateData['color']=isset($data['color'])?$data['color']:'';
        $updateData['class_name']=isset($data['class_name'])?$data['class_name']:'';
        $updateData['content']=$data['content'];
        $updateData['start_time']=$data['start_time'];
        $updateData['end_time']=$data['end_time'];

        // dump($updateData);
        Db::name('note_list')->where($where)->update($updateData);
        Db::name('obj_list')->where('id', $obj_id)->update(['update_time' => date('Y-m-d H:i:s')]);
        return json(['code'=>1]);
    }

    public function addHolidayEvent(){
        $data=input('post.');
        $obj_id=input('get.obj_id');
        // file_get_contents("http://apis.map.qq.com/ws/distance/v1/?mode=driving&from=30.56808,104.064305&to=30.5702,104.06476&key=your key");
        // $insertData['title']=$data['title'];
        // $insertData['color']=$data['color'];
        // $insertData['class_name']=isset($data['className'])?$data['className']:'';
        // $insertData['content']=$data['content'];
        $insertData['start_time']=$data['startTime'];
        $insertData['end_time']=$data['endTime'];
        $insertData['create_time']=date('Y-m-d H:i:s');
        // $insertData['obj_id']=$obj_id;
        $event_id=Db::name('note_list')->insertGetId($insertData);
        return json(['code'=>1,'event_id'=>$event_id]);
    }

    public function getHolidayList(){
        $data=input('post.');
        // $obj_id=input('get.obj_id');
        $start=date('Y-m-d H:i:s',strtotime($data['start_time'].'-15 day'));
        $end=date('Y-m-d H:i:s',strtotime($data['end_time'].'+15 day'));
        $where[]=['start_time','>=',$start];
        $where[]=['start_time','<=',$end];
        $data=Db::name('holiday_list')->where($where)->field('start_time start,end_time end')->select();
        return $this->apiReturnSuccess($data);
    }

    public function getInfo(){
        $obj_id = input('get.obj_id');
        if (!$this->object_is_user($obj_id)) {
            $this->apiReturnError(0, '此项目不是你的');
        }
        $event_id = input('post.event_id');
        Db::name('note_list')->where('obj_id', $obj_id)->where('id',$event_id)->find();
    }

    // 关键字搜索
    public function searchWord() {
        $obj_id = input('get.obj_id');
        if (!$this->object_is_user($obj_id)) {
            $this->apiReturnError(0, '此项目不是你的');
        }
        $word = input('post.word');
        $list = Db::name('note_list')->where('obj_id', $obj_id)->where('(`title` LIKE "%'. $word.'%" OR `content` LIKE "%' . $word . '%")')->select();
        // dump(Db::getLastSql());
        $this->apiReturnSuccess($list);
    }

    // http://tp51.cn/calendar/eventapi/buildHoliday?month=8
    public function buildHoliday(){

        set_time_limit(0);
        ob_end_clean();
        ob_implicit_flush();
        header('X-Accel-Buffering: no');// 关键是加了这一行。
        // 以上实时输出
        $month=input('get.month')?input('get.month'):date('m');
        $year=input('get.year')?input('get.year'):date('Y');
        $totalDays = date('t',strtotime(date($year.'-'.$month)));  
        $month=sprintf ("%02d",$month);
        for( $i=1; $i<= $totalDays; $i++){
            // $day=str_pad($i,2,'0', STR_PAD_LEFT);
            $day=sprintf ("%02d",$i);
            $url="http://tool.bitefu.net/jiari/?d=".$year.$month.$day;
            $res=file_get_contents($url);
            dump([$url,'结果',$res]);
            if($res==1 || $res==2){
                $insertData['start_time']=$year.'-'.$month.'-'.$day.' 00:00:00';
                $insertData['end_time']=date('Y-m-d 00:00:00',strtotime($year.'-'.$month.'-'.$day.'+ 1 day'));
                $insertData['create_time']=date('Y-m-d H:i:s');
                $insertData['type']=$res;

                
                $resFind=Db::name('holiday_list')->where('start_time','like',$year.'-'.$month.'-'.$day.' %')->find();

                if($resFind){
                    dump([$year.'-'.$month.'-'.$day,'修改']);
                    Db::name('holiday_list')->where('id','like',$resFind['id'])->update($insertData);
                }else{
                    dump([$year.'-'.$month.'-'.$day,'新增']);
                    Db::name('holiday_list')->insert($insertData);
                }
                // $event_id=Db::name('note_list')->insertGetId($insertData);
            }
            // ob_flush();
            // flush();
            sleep(1);
        }   
            // $insertData['obj_id']=$obj_id;
            
        // dump($dates);

        // file_get_contents("http://apis.map.qq.com/ws/distance/v1/?mode=driving&from=30.56808,104.064305&to=30.5702,104.06476&key=your 
    }

    // 更新地址：http://tp51.enianteam.com/calendar/eventapi/buildHolidayNew?month=8&year=2021
    // 基于第三方文档：http://timor.tech/api/holiday
    public function buildHolidayNew() {

        set_time_limit(0);
        ob_end_clean();
        ob_implicit_flush();
        header('X-Accel-Buffering: no'); // 关键是加了这一行。
        // 以上实时输出
        $month = input('get.month') ? input('get.month') : date('m');
        $year = input('get.year') ? input('get.year') : date('Y');
        $totalDays = date('t', strtotime(date($year . '-' . $month)));
        $month = sprintf("%02d", $month);
        $url = 'http://timor.tech/api/holiday/year/'.$year.'-'.$month.'?type=Y&week=Y';
        dump($url);
        $res = file_get_contents($url);
        
        $resArr=json_decode($res,true);
        if(!$resArr || $resArr['code']==-1){
            dump('失败');
            dump($resArr);
            return;
        }
        $list=$resArr['type'];
        dump('已成功获取到节假日列表');
        foreach ($list as $key => $value) {
            $insertData['start_time'] = $key . ' 00:00:00';
            $insertData['end_time'] = date('Y-m-d 00:00:00', strtotime($key . '+ 1 day'));
            $insertData['create_time'] = date('Y-m-d H:i:s');
            $insertData['type'] = $value['type'];
            $resFind = Db::name('holiday_list')->where('start_time', 'like', $key . ' %')->find();
            // dump($key);
            if ($resFind) {
                dump([$key, '修改']);
                Db::name('holiday_list')->where('id', 'like', $resFind['id'])->update($insertData);
            } else {
                dump([$key, '新增']);
                Db::name('holiday_list')->insert($insertData);
            }
            // sleep(1);
        }
        dump($year.'_'.$month.' 节假日获取结束');
    }

    
    public function getList(){
        $data=input('post.');
        $obj_id=input('get.obj_id');
        $start_time=input('post.start_time');
        $end_time = input('post.end_time');
        $start=date('Y-m-d H:i:s',strtotime($start_time.'-30 day'));
        $end=date('Y-m-d H:i:s',strtotime($end_time.'+30 day'));
        // 验证是否为当前用户项目
        $res = Db::name('obj_list')
            ->where('u_id', $this->userId)
            ->where('id', $obj_id)
            ->find();
        if(!$res){
            return $this->apiReturnError(0, $data);
        }
        $where[]=['start_time','>=',$start];
        $where[]=['start_time','<=',$end];
        $where[]=['obj_id','=',$obj_id];
        $data=Db::name('note_list')->where($where)->field('start_time start,end_time end,title,color,class_name className,id event_id,id,content,create_time')->select();
        return $this->apiReturnSuccess( $data);
    }
}
