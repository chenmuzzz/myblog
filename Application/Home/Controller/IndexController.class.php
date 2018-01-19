<?php
namespace Home\Controller;

use Think\Controller;

vendor('phpmail.Smtp');

class IndexController extends HomeController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //判断访问量
        $this->page_view();

        $ajax = I('ajax');
        $obj = D('article');

        $limit = 5;

        $page = I('page') ? I('page') : 1;

        $start = $limit * ($page - 1);
        $total = $obj->get_count();

        $res = $obj->getAll($where = array(), $start, $limit);
        //最新文章
        $max_id = $obj->max_id();
        $new_article = $obj->get_one_article_id_name($max_id);

        $this->assign('new_article', $new_article);
        $this->assign('page', $page);
        $this->assign('all_page', ceil($total / $limit));
        $this->assign('total', $total);
        $this->assign('article', $res);
        if ($ajax == 'ajax') {
            $this->display('index_ajax');
        } else {
            $this->display('index');
        }

    }
    //统计访问量
    private function page_view(){
        $ip = get_real_ip();
        $_COOKIE['test'] = 1;
        if($_COOKIE['visitor_ip'] == $ip || !$_COOKIE['test']){
            unset($_COOKIE['test']);
        }else{
            setcookie("visitor_ip",$ip,time()+7200);
            $redis = new \Redis();
            $redis->connect('127.0.0.1','6379');
            $redis->incr("page_view");
        }
    }

    public function new_article()
    {

    }

//文章详情
    public function article()
    {
        header("Content-type:text/html;charset=utf-8");
        $id = I('id');
        $article_obj = D('Article');
        $res = $article_obj->get_one($id);

        $max_id = $article_obj->max_id();
        $min_id = $article_obj->min_id();
        if ($id > $min_id) {
            $prev_res = $article_obj->get_one($id - 1);
        } else {
            $prev_res['title'] = '已经是第一篇了';
            $prev_res['id'] = 0;
        }
        if ($id < $max_id) {
            $next_res = $article_obj->get_one($id + 1);
        } else {
            $next_res['title'] = '已经是最后一篇了';
            $next_res['id'] = 0;
        }
        //取 分类名称
        $cate_obj = new \Admin\Model\CateModel();
        $field[] = 'cate_name';
        $res['cate_name'] = $cate_obj->get_one($res['cate_id'], $field)['cate_name'];

        $this->assign('prev_res', $prev_res);
        $this->assign('next_res', $next_res);
        $this->assign('res', $res);
        $this->display();
    }

    public function cate()
    {
        $this->display();
    }

    public function cate_1()
    {
        $this->display();
    }

    public function about()
    {
        $this->display();
    }

    public function contact()
    {
        $this->display();
    }

    public function picture()
    {
        $this->display();
    }

    public function life()
    {
        $keyword=I('keyword');
        if($keyword){
            header("Content-type:text/html;charset=utf-8");
            $s = new \SphinxClient();
            $s->setServer("127.0.0.1", 9312);

            $s->setMatchMode(SPH_MATCH_ALL);
            $s->setMaxQueryTime(30);
            $res = $s->query($keyword,'life'); #[宝马]关键字，[main]数据源source
            $err = $s->GetLastError();
            $ress=array_keys($res['matches']);
            $ids=implode(',',$ress);
            $where['ids']=$ids;
            if($ids==''){
                $this->assign('res', '');
                $this->display();
                exit;
            }
        }

        $page = I('page') ? I('page') : 1;
        $limit=8;
        $start = $limit * ($page - 1);
//        $total=D('life')->get_count();
        $life_res = D('life')->get_all($where,$limit,$start);
//dump($res);die;
        $res=$life_res['res'];
        $total=$life_res['total'];
        foreach ($res as $k => $v) {
            $res[$k]['time'] = date('m-d H:i', $v['add_time']);
        }

//        $page = D('life')->page();
//        $show = $page->show();

//        $this->assign('page', $show);
        $this->assign('all_page', ceil($total / $limit));
        $this->assign('res', $res);
        $this->assign('page', $page);

        $this->display();
    }
    //想册
    public function pic(){
        $this->display();
    }
    public function article_list()
    {
        $ajax = I('ajax');
        $cate_id = I('cate_id');
        $cate_name = I('cate_name');
        $where = array();
        //按ID查询
        if ($cate_id) {
            $where['cate_id'] = $cate_id;
        }

        $res = D('article')->getAll($where);
        foreach ($res as $k => $v) {
            if (date('Y', $v['created_time']) == '2018') {
                $data['2018'][] = $v;
            }
            if (date('Y', $v['created_time']) == '2017') {
                $data['2017'][] = $v;
            }
        }
        if ($ajax) {
            $this->assign('ajax', $ajax);
        }
        $this->assign('cate_name', $cate_name);
        $this->assign('article_list', $data);
        $this->display('list');
    }

    /*发送邮件方法
     *@param $to：接收者 $title：标题 $content：邮件内容
     *@return bool true:发送成功 false:发送失败
     */

    public function sendMail()
    {
        $title = I('title');
        $content = I('content');
        $content = html_entity_decode($content);
        $res = sendMail('571524655@qq.com', $title, $content);
        if ($res) {
            $data['code'] = 1;
            $data['msg'] = '发送成功';
//        邮件自动回复
//        $name=I('name');
//        $email=I('email');
//        $this->autoReply($name,$email);

        } else {
            $data['code'] = 0;
            $data['msg'] = '服务器繁忙，请稍后再试';
        }
        echo json_encode($data);
    }

//自动回复邮件
    public function autoReply($name, $email)
    {
        $content = $name . '你好';
        sendMail($email, '来自沉木博客的自动回复', $content);
    }

    public function crontab(){
        file_put_contents('try.txt','hello'.PHP_EOL,FILE_APPEND);
    }


//获取dnf官网的活动推送
    public function get_sth(){
//        header("Content-type:text/html;charset=gb2312");
        $a=file_get_contents('http://dnf.qq.com/main.shtml');
	preg_match_all('/<ul class="news-list">.*<\/ul>/sU',$a,$str);
        //所有的活动列表
            $all_str=$str[0][2];
        //按li搜索出其中的 每一条
        preg_match_all('/<li>.*<\/li>/sU',$all_str,$arr_li);
        //存放 新活动消息
        $new_dnf='';
        $num = 0;
        foreach($arr_li[0] as $k=>$v){
            $data=array();
            preg_match('/\w{1,2}\/\w{2}/U',$v,$time);
            preg_match('/\/webplat.*\.shtml/',$v,$url);
//            preg_match('/(?:(blank">)).*(?:(<\/a>))/Us',$v,$data['content']);
            preg_match('/(?<=(k">)).*(?=(<\/a>))/Us',$v,$content);
            $data['time'] = $time[0];
            $data['url']=$url[0];
            $data['content']= iconv('GB2312', 'UTF-8', $content[0]);
            //在数据库 搜索此条数据
//            $data['content'] = '[活动] 心跳邂逅：萝莉、御姐谁才是你的爱？';
            $where['url']=$data['url'];
            $res=D('dnf')->get($where);
            if($res){
                if($k==0){
                    continue;
                }else{
                    break;
                }
            }else{
                $num++;
                //拼接推送的 消息字符
                $new_dnf.=$num.": <a href='http://dnf.qq.com".$data['url']."'>".$data['content']."</a>"."<br>";
                //加入数据库
                D('dnf')->add_one($data);
            }
        }
        //推送至邮件
        if($new_dnf){
            sendMail('571524655@qq.com', 'dnf新更新活动', $new_dnf);
        }else{
            file_put_contents('dnf.txt',date('m-d H:i',time()).'无新推送'.PHP_EOL,FILE_APPEND);
        }
    }
//机器人聊天页面
    public function robot(){
        $this->display();
    }
}
