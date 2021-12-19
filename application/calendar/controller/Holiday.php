<?php
namespace app\calendar\controller;
use think\Db;

class Holiday extends Tkcommon
{

    public function initialize() {
        echo "<pre style='font-size:30px'>";
    }	

    // 2022年节假日解析
    // http://[你的ip(域名)+端口]/holiday/y_2022
    // 示例：
    // http://calendar.cn/holiday/y_2022
    public function y_2022(){
        $this->echo("准备进行2022年所有假日的更新");
        $file_name='../holiday-json/2022.json';
        if(!file_exists($file_name)){
            $this->echo("更新失败：文件 ".$file_name." 不存在");
            return;
        }
        $content=file_get_contents($file_name);
        $jsonHoliday=json_decode($content,true);
        if(!$jsonHoliday){
            $this->echo("更新失败：文件格式非json");
            return;
        }
        // 删除已有
        Db::name("holiday_list")->where("start_time","between",["2021-12-31 00:00:00", "2023-01-01 00:00:00"])->delete();
        $list=$jsonHoliday['holiday'];
        try {
            foreach ($list as $key => $value) {
                $insertData['start_time'] = $value['date'] . ' 00:00:00';
                $insertData['end_time'] = date('Y-m-d 00:00:00', strtotime($value['date'] . '+ 1 day'));
                $insertData['create_time'] = date('Y-m-d H:i:s');
                $insertData['type'] =1;
                $this->echo("添加日期：" .$value['date']);
                Db::name('holiday_list')->insert($insertData);
            }
        } catch (\Throwable $th) {
            $this->echo("更新失败：数据格式不正确 ");
        }
        
        
        $this->echo("2022年所有假日的更新完成");
    }

    private function echo($content){
        echo $content. PHP_EOL;
    }
}
