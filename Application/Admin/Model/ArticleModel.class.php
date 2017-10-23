<?php
namespace Admin\Model;
// user Think\Model;
class ArticleModel extends \Think\Model{
	public function add_one($data){
        $res=$this->add($data);
//		echo $this->_sql();
		return $res;
	}
	public function getAll(){
		$res=$this->select();
		return $res;
	}
	public function get_one($id){
	    $res=$this->find($id);
	    return $res;
    }
    public function update_one($id,$data){
	    $res=$this->where('id='.$id)->save($data);
	    return $res;
    }
    public function delete_one($id){
        return $this->delete($id);
    }
	//文章总数
	public function get_num(){
		return $this->count();
	}
}