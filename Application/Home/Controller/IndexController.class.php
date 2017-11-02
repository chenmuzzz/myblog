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
        $ajax = I('ajax');
        $obj = D('article');

        $limit = 3;

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
        $res = D('life')->get_all();
        foreach ($res as $k => $v) {
            $res[$k]['time'] = date('m-d H:i', $v['add_time']);
        }

        $page = D('life')->page();
        $show = $page->show();

        $this->assign('page', $show);
        $this->assign('res', $res);
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

}