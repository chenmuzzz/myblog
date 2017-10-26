<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/9/17
 * Time: 21:41
 */
namespace Home\Model;
class LifeModel extends \Think\Model{
    public function get_one($id){
        $res=$this->find($id);
        $res['content']=html_entity_decode($res['content']);

        return $res;
    }
    public function get_all(){
        $page=$this->page();
        $res=$this->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
        return $res;
    }

    public function page(){
        $page=new \Think\Page($this->get_count(),110);
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
//        $page->setConfig('header','<li class="disabled hwh-page-info"><a>共<em>%TOTAL_ROW%</em>条  <em>%NOW_PAGE%</em>/%TOTAL_PAGE%页</a></li>');
//        $page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        return $page;
    }
    public function get_count(){
        return $this->count();
    }
}