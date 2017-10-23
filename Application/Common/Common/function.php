<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/9/23
 * Time: 11:49
 */

/*发送邮件方法
 *@param $to：接收者 $title：标题 $content：邮件内容
 *@return bool true:发送成功 false:发送失败
 */

function sendMail($to, $title, $content)
{
    //引入PHPMailer的核心文件 使用require_once包含避免出现PHPMailer类重复定义的警告
    vendor('PHPMailer.PHPMailerAutoload');
    //实例化PHPMailer核心类
    $mail = new PHPMailer();
    //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
//    $mail->SMTPDebug = 1;
    //使用smtp鉴权方式发送邮件
    $mail->isSMTP();
    //smtp需要鉴权 这个必须是true
    $mail->SMTPAuth = true;
    //链接qq域名邮箱的服务器地址
    $mail->Host = 'smtp.ym.163.com';
    //设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';
    //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
    $mail->Port = 994;
    //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
    $mail->CharSet = 'UTF-8';
    //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = '沉木的博客';
    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username = 'zxf@chenmu.me';
    //smtp登录的密码 使用生成的授权码（就刚才叫你保存的最新的授权码）
//    $mail->Password = 'acbysseygffrbdej';
    $mail->Password = '571524655zxf';
    //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = 'zxf@chenmu.me';
    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true);
    //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    $mail->addAddress($to, 'zxf');
    //添加多个收件人 则多次调用方法即可
    // $mail->addAddress('xxx@163.com','lsgo在线通知');
    //添加该邮件的主题
    $mail->Subject = $title;
    //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    $mail->Body = $content;
    //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
    // $mail->addAttachment('./d.jpg','mm.jpg');
    //同样该方法可以多次调用 上传多个附件
    // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');
    $status = $mail->send();
    //简单的判断与提示信息
    if ($status) {
        return true;
    } else {
        return false;
    }
}

/**
 * Thinkphp默认分页样式转Bootstrap分页样式
 * @author H.W.H
 * @param string $page_html tp默认输出的分页html代码
 * @return string 新的分页html代码
 */
function bootstrap_page_style($page_html){
    if ($page_html) {
        $page_show = str_replace('<div>','<nav><ul class="pagination">',$page_html);
        $page_show = str_replace('</div>','</ul></nav>',$page_show);
        $page_show = str_replace('<span class="current">','<li class="active"><a>',$page_show);
        $page_show = str_replace('</span>','</a></li>',$page_show);
        $page_show = str_replace(array('<a class="num"','<a class="prev"','<a class="next"','<a class="end"','<a class="first"'),'<li><a',$page_show);
        $page_show = str_replace('</a>','</a></li>',$page_show);
    }
    return $page_show;
}
//获取当前浏览器
function my_get_browser(){
    if(empty($_SERVER['HTTP_USER_AGENT'])){
        return 'robot！';
    }
    if( (false == strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident')!==FALSE) ){
        return 'Internet Explorer 11.0';
    }
    if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 10.0')){
        return 'Internet Explorer 10.0';
    }
    if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Edge')){
        return 'Edge';
    }
    if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Firefox')){
        return 'Firefox';
    }
    if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Chrome')){
        return 'Chrome';
    }
    if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Safari')){
        return 'Safari';
    }
    if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Opera')){
        return 'Opera';
    }
    if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'360SE')){
        return '360SE';
    }
    //微信浏览器
    if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessage')){
        return 'MicroMessage';
    }
}

//上传文件
