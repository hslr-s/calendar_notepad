<?php

namespace app\calendar\controller;

use think\Db;
use think\facade\App;
use app\calendar\lib\Event as libEvent;
use app\calendar\lib\Project as libProject;

class Objectecharts extends Tkcommon {

    protected $beforeActionList = [
        'loginStatusCheck',
        'isUserObj'
    ];


    // 线图天总数
    public function lineDayTopicCount() {
        $start_time = input('post.start_time');
        $end_time = input('post.end_time');
        $obj_id = input('post.obj_id');
        $dateList=[];
        $dataArr=[];
        $subjsctList=Db::name('obj_subject')->where("obj_id", $obj_id)->column("title");

        $current_time= $start_time;
        // $ii=0;
        while (substr($current_time, 0, 10)!= substr(date('Y-m-d H:i:s', strtotime($end_time . ' +1 day')),0,10)) {
            $dateList[] = substr($current_time, 0, 10) ;
            $current_time = date('Y-m-d H:i:s', strtotime($current_time . ' +1 day'));
            // dump([$current_time, $end_time]);
            // $ii++;
        }
        foreach ($subjsctList as $key => $value) {
            $current_time= $start_time;
            $dataArr[$value]=[];
            for ($i=0; $i < count($dateList); $i++) {
                $currendData = Db::name('note_list')
                    ->where('obj_id', $obj_id)
                    ->where('title', 'like', '#' . $value . '# %')
                    ->where("start_time", 'LIKE', $dateList[$i]. ' %')
                    ->count();
                $dataArr[$value][] = $currendData;
                // dump(Db::getLastSql());
            }
        }
        
        $this->apiReturnSuccess([
            'topics'=> $subjsctList,
            'datas'=> $dataArr,
            'dates' => $dateList,
        ]);
    }

    // 线图月总数
    public function lineMonthTopicCount() {
        $start_time = input('post.start_time');
        $end_time = input('post.end_time');
        $obj_id = input('post.obj_id');
        $dateList = [];
        $dataArr = [];
        $subjsctList = Db::name('obj_subject')->where("obj_id", $obj_id)->column("title");

        $current_time = $start_time;
        // $ii=0;
        while (substr($current_time, 0, 7) != substr(date('Y-m-d H:i:s', strtotime($end_time . ' +1 month')), 0, 7)) {
            $dateList[] = substr($current_time, 0, 7);
            $current_time = date('Y-m-d H:i:s', strtotime($current_time . ' +1 month'));
        }
        foreach ($subjsctList as $key => $value) {
            $current_time = $start_time;
            $dataArr[$value] = [];
            for ($i = 0; $i < count($dateList); $i++) {
                $currendData = Db::name('note_list')
                ->where('obj_id', $obj_id)
                    ->where('title', 'like', '#' . $value . '# %')
                    ->where("start_time", 'LIKE', $dateList[$i] . '%')
                    ->count();
                $dataArr[$value][] = $currendData;
                // dump(Db::getLastSql());
            }
        }

        $this->apiReturnSuccess([
            'topics' => $subjsctList,
            'datas' => $dataArr,
            'dates' => $dateList,
        ]);
    }

    // 折线统计（自动选择按月还是按天统计）大于31天按月统计
    public function lineTopicCount(){

        $start_time = input('post.start_time');
        $end_time = input('post.end_time');
        $s_int= strtotime($start_time);
        $e_int = strtotime($end_time);
        // 大于31天按月统计
        if($e_int- $s_int>2678400){
            $this->lineMonthTopicCount();
        }else{
            $this->lineDayTopicCount();
        }
    }

    public function pieChartTopic() {
        $start_time = input('post.start_time');
        $end_time = input('post.end_time');
        $obj_id = input('post.obj_id');
        $dataArr = [];
        $subjsctList = Db::name('obj_subject')->where("obj_id", $obj_id)->column("title");
        $calcCount=0;
        foreach ($subjsctList as $key => $value) {
            $currendData['name']= $value;
            $currendData['value'] = Db::name('note_list')
                ->where('obj_id', $obj_id)
                ->where('title', 'like', '#' . $value . '# %')
                ->where("start_time", '>=', $start_time)
                ->where("start_time", '<=', $end_time)
                ->count();
            $calcCount+= $currendData['value'];
            $dataArr[] = $currendData;
        }
        // 其他
        $count=Db::name('note_list')
        ->where('obj_id', $obj_id)
        ->where("start_time", '>=', $start_time)
        ->where("start_time", '<=', $end_time)
        ->count();
        $currendData['name'] = '其他事件主题';
        $currendData['value'] = $count - $calcCount;
        $dataArr[]= $currendData;
        $this->apiReturnSuccess($dataArr);
    }

    // 是否为当前用户的项目
    protected function isUserObj(){
        $obj_id = input('post.obj_id');
        $res=Db::name('obj_list')->where('u_id', $this->userId)->where('id', $obj_id)->find();
        if(!$res){
            $this->apiReturnError(0, '没有权限');
        }
    }

    
}
