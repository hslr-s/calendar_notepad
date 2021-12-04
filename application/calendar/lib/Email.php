<?php

namespace app\calendar\lib;

use think\Db;
use think\Controller;

class Email {
    public $errorMsg='';

    // 发送邮件，统一模板
    public function sendTplMail($toMail, $title, $content) {
        return $this->sendMail($toMail, $title, $content);
    }
    
    // 发送邮件，读取系统配置
    public function sendMail($toMail, $title, $content){
        $configs=Config::getGroup('sys_mail');
        $config['host'] = $configs['host']; //域名邮箱的服务器地址
        $config['from_name'] = $configs['from_name']; //发现人名称
        $config['username'] = $configs['username']; //账号
        $config['password'] = $configs['password']; //密码
        $config['from'] = $configs['from']; //发件人邮箱
        $config['secure'] = $configs['secure']; //加密方式
        $config['port'] = $configs['port']; //端口
        return $this->sendMailBase($config, $toMail, $title, $content);
    }


    /**
     * 发送邮件方法
     * @param string $to：接收者邮箱地址
     * @param string $title：邮件的标题
     * @param string $content：邮件内容
     * @return boolean true:发送成功 false:发送失败
     */
    // $config['host']='smtp.mxhichina.com'; //域名邮箱的服务器地址
    //   可选   $config['SMTPSecure'] = 'tls'; //设置使用ssl加密方式登录鉴权
    //   可选   $config['port'] = 465; //端口可选465或587
    // $config['from_name'] = '日历记事本'; //发现人名称
    // $config['username'] = 'admin@example.com'; //账号
    // $config['password'] = '123456'; //密码
    // $config['from'] = 'admin@example.com'; //发件人邮箱
    public function sendMailBase($config,$to, $title, $content) {
        $config['port']=isset($config['port'])? $config['port']:25;
        require_once __DIR__ . '/../../../extend/PHPMailer/PHPMailer.php';
        $mail = new \PHPMailer(false);
        //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
        // $mail->SMTPDebug = 1;
        //使用smtp鉴权方式发送邮件
        $mail->isSMTP();
        //smtp需要鉴权 这个必须是true
        $mail->SMTPAuth = true;
        //域名邮箱的服务器地址
        $mail->Host = $config['host'];
        //设置使用ssl加密方式登录鉴权
        $mail->SMTPSecure = isset($config['secure'])? $config['secure']: 'tls';
        //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
        $mail->Port = $config['port'];
        //设置smtp的helo消息头 这个可有可无 内容任意
        //$mail->Helo = 'Hello mail.163.com Server';
        //设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
        //$mail->Hostname = 'localhost';
        // //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
        $mail->CharSet = 'UTF-8';
        //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
        $mail->FromName = $config['from_name'];
        //smtp登录的账号 这里填入字符串格式的qq号即可
        $mail->Username = $config['username'];
        //smtp登录的密码 使用生成的授权码 你的最新的授权码
        $mail->Password =  $config['password'];
        //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
        $mail->From = $config['from'];
        //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
        $mail->isHTML(true);
        //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
        $mail->addAddress($to);
        //添加多个收件人 则多次调用方法即可
        // $mail->addAddress('xxx@qq.com','lsgo在线通知');
        //添加该邮件的主题
        $mail->Subject = $title;
        //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
        $mail->Body = $content;

        //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
        // $mail->addAttachment('./d.jpg','mm.jpg');
        //同样该方法可以多次调用 上传多个附件
        // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');
        // dump($mail);
        $status = $mail->send();

        //简单的判断与提示信息
        if ($status) {
            return true;
        } else {
            $this->errorMsg= $mail->ErrorInfo;
            // dump($mail->ErrorInfo);
            return false;
        }
    }
}
