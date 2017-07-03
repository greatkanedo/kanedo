<?php   defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *  @author  kanedo
 *  @Email   i@kanedo.cn
 *  @copyright www.kanedo.cn
 */
 
class Category_model extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }


    /**
     *   添加分类
     *   @date 2017年2月14日 15:45:11
     *   @param array $data
     *   @return int
     */
	public function addCat($data)
	{
        $data['add_time'] = time();
		$this->db->insert('category_model', $data);
		return $this->db->affected_rows();
	}

    /**
     *   构建树形结构
     *   @date 2017年2月14日 15:29:26
     *   @param array $list
     *   @param int $parentid
     *   @param int $deep
     *   @param boolean $flag
     *   @return array 
     */
    // private function createTree($list, $parentid = 0, $deep = 0, $flag)
    // {

    //     static $tree;

    //     foreach($list as $rows)
    //     {
    //         if ($rows['pid'] == $parentid){
    //             $rows['deep'] = $deep;

    //             $rows['cat_name'] = ($flag && $rows['deep'] > 0) ? 
    //             str_repeat('&nbsp;', $deep * 4).'|- '.$rows['cat_name'] :
    //             $rows['cat_name'];

    //             $tree[] = $rows;
    //             $this->createTree($list, $rows['id'], $deep + 1, $flag);
    //         }
    //     }

    //     return $tree;
    // }

    /**
     *   获取树形结构
     *   @date 2017年2月14日 15:41:57
     *   @param boolean $flag
     *   @return array
     */
    public function getCategoryTree($where = array())
    {

    	$this->db->select('id, pid, cat_name, num, sort, is_show, add_time, update_time');
    	$this->db->where($where);

    	$query = $this->db->get('category_model');

        return $query->result_array();
    }

    /**
     *   后台获取所有分类
     *   @date 2017年2月14日 15:46:38
     *   @return array
     */
    public function getEntry()
    {
    	$this->db->select('id, pid, cat_name, sort, is_show');
    	$query = $this->db->get('category_model');
    	return $query->result_array();
    }



    public function getCate($id)
    {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('category_model');
        return $query->row_array();
    }


    public function updateEntry($data)
    {
        $id = $data['id'];
        unset($data['id']);
        $data['update_time'] = time();
        $this->db->where(array('id' => $id));
        $this->db->update('category_model', $data);

        return $this->db->affected_rows();
    }

    /**
     *  是否显示
     *  @date 2017年4月13日 22:34:33
     *  @pagram $id int
     */
    public function isShow($id)
    {

        $this->db->where(array('id' => $id));
        $this->db->select('is_show');
        $query = $this->db->get('category_model');

        $data = array();
        $data['is_show'] = $query->result_array()[0]['is_show'] == 1 ? 0 : 1;
        $this->db->where(array('id' => $id));
        $this->db->update('category_model', $data);
        return $this->db->affected_rows();
    }



    /**
     *  @删除单列
     *  @date
     *  @pagram $id int
     */
    public function delEntry($id)
    {
        $this->db->where(array('id' => $id));
        return $this->db->delete('category_model');
    }



    /**
     *  @按标签搜索
     *  @date 2017年5月10日 21:56:07
     *  @pagram tag Int
     */
    public function getTagEntry($id)
    {
        $this->db->select('a.*');
        $this->db->from('category_model as c');
        $this->db->join('article_model as a', 'a.pid=c.id');
        //$this->db->group_by("a.id"); 
        $this->db->order_by('a.id', 'DESC');
        $this->db->where(array('c.id' => $id));
        $query = $this->db->get();
        // echo $this->db->last_query();
        // die;
        return $query->result_array();
    }

}