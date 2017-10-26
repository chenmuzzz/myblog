<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends AdminController{
	 public function __construct(){
	 	parent::__construct();
	 }
	public function index(){
		$article_res=D('Article')->getAll();
		// print_r($article_res);
		//所有的分类
		$field[]='id';
		$field[]='cate_name';
		$cate_res=D('Cate')->get_all($field);
		foreach($cate_res as $k => $v){
			$temp[$v['id']]=$v['cate_name'];
		}

		foreach($article_res as $k=>$v){
			$article_res[$k]['cate_name']=$temp[$v['cate_id']];
		}
		$this->assign('res',$article_res);
		$this->display('index');
	}
	public function add_article(){
		if(IS_POST){
			$data=I('post.');
			dd($data);
			preg_match_all("/[0-9]{8}\/[0-9]{10,}\.(jpg|png|jpeg)/",$data['content'],$img_arr);
//			preg_match("/article_image\/[0-9]{8}\/[0-9]{10,}\.(jpg|png|jpeg)$/",'article_image/20171023/1508757741352353.jpg',$img_arr);
			if($img_arr != array() && $img_arr[0]!= array()){
				foreach($img_arr[0] as $k=>$v){
					if($k==0){
						$data['image'].=$v;
					}else{
						$data['image'].=';'.$v;
					}
				}
			}
			$data['created_time']=time();
			$data['updated_time']=time();
			$obj=D('Article');
			$res=$obj->add_one($data);
			if($res){
				$this->success('添加成功',U('article/index'),2);
			}
			
		}else{
			$this->display();	
		}
		
	}

	public function edit_article(){
	    $obj=D('Article');
	    if(IS_POST){
	        $data=I('post.');

	        $data['updated_time']=time();
            $res=$obj->update_one($data['article_id'],$data);
            if($res){
                $this->success('修改成功',U('article/index'),1);
            }
	    }else{
            $id=I('id');
            $res=$obj->get_one($id);
            $res['content']=html_entity_decode($res['content']);
            $this->assign('res',$res);
            $this->display();
        }

    }

    public function del_article(){
	    $id=I('id');
	    $res=D('Article')->delete_one($id);
        if($res){
            $d['code']=1;
        }else{
            $d['code']=0;
        }
        echo json_encode($d);
	}

	public function change_status(){
        $id=I('id');
        $flag=I('flag');
        $data['display']=$flag;
        $res=D('Article')->update_one($id,$data);
        if($res){
            $d['code']=1;
        }else{
            $d['code']=0;
        }
        echo json_encode($d);
    }
	public function redis(){
		$redis=new \Redis();
		$redis->connect('127.0.0.1','6379');
		$redis->set('a','hello world');
		echo $redis->get('a');
//	    s('a','helleo');
//        echo S('a');
    }
}