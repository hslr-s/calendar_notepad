<?php
namespace app\calendar\controller;
use think\Db;
use think\facade\App;
class Styleapi extends Common
{
 


    // 获取样式内容
    public function getStyleText(){
        // header('Content-Type: text/css');
        $style_text= cache('style_css');
        if(!$style_text){
            $list = Db::name('style_list')->select();
            $style_text = '';
            foreach ($list as $key => $value) {
                $value['border_color'] = $value['border_color'] ? ('1px solid ' . $value['border_color']) : 'none';
                $style_text .= '.' . $value['name'] . '{color:' . $value['text_color'] . ' !important;background-color:' . $value['background_color'] . ' !important;border:' . $value['border_color'] . ' !important;}';
            }
            cache('style_css', $style_text);
        }
        echo $style_text;
        exit;
    }

    // 获取样式列表
    public function getStyleList(){
        $list=Db::name('style_list')->order('sort desc')->select();
        return json(['code'=>1,'data'=>$list]);
    }

    // 添加样式
    public function designAdd(){
        $data=input('post.');
        if($data['name_cn']==''){
            $code=0;
            $msg='未填写名称';
        }else{
            $where[]=['background_color','=',$data['background_color']];
            $where[]=['text_color','=',$data['text_color']];
            $where[]=['border_color','=',$data['border_color']];
            $findRes=Db::name('style_list')->where($where)->find();
            if(!$findRes){
                $insertData['name_cn']=$data['name_cn'];
                $insertData['background_color']=$data['background_color'];
                $insertData['text_color']=$data['text_color'];
                $insertData['border_color']=$data['border_color'];
                $id=Db::name('style_list')->insertGetId($insertData);
                $updateData['name']='color-c-name'.$id;
                Db::name('style_list')->where('id',$id)->update($updateData);
                $code=1;
                $msg='ok';
            }else{
                $code=0;
                $msg='已存在该配色';
            }
        }
        return json(['code'=>$code,'msg'=>$msg]);
    }

    // 更新样式
    public function designUpdate(){
        $data=input('post.');
        if($data['name_cn']==''){
            $code=0;
            $msg='未填写名称';
        }else{
            $updateData['name_cn']=$data['name_cn'];
            $updateData['background_color']=$data['background_color'];
            $updateData['text_color']=$data['text_color'];
            $updateData['border_color']=$data['border_color'];
            Db::name('style_list')->where('id',$data['id'])->update($updateData);
            $msg='ok';
            $code=1;
        }
        return json(['code'=>$code,'msg'=>$msg]);
    }

}
