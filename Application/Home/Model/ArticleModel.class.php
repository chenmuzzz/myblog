<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/9/17
 * Time: 21:41
 */
namespace Home\Model;
class ArticleModel extends \Think\Model{
    public function getAll($where=array()){
        $page=$this->page();
        $res=$this->where($where)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
//        echo $this->_sql();
        return $res;
    }
    public function get_count(){
        return $this->count();
    }
    public function get_one($id){
        $res=$this->find($id);
        $res['content']=html_entity_decode($res['content']);

        return $res;
    }
    public function page(){
        $page=new \Think\Page($this->get_count(),10);
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
//        $page->setConfig('header','<li class="disabled hwh-page-info"><a>共<em>%TOTAL_ROW%</em>条  <em>%NOW_PAGE%</em>/%TOTAL_PAGE%页</a></li>');
//        $page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        return $page;
    }
    public function max_id(){
        return $this->Max('id');
    }
    public function min_id(){
        return $this->Min('id');
    }
    public function get_one_article_id_name($id){
        $res=$this->field('id,title')->find($id);
        return $res;
    }
}