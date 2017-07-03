<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *	@author  kanedo
 *  @Email   i@kanedo.cn
 *  @copyright www.kanedo.cn
 */

class Article_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }	

	// 添加文章
	public function addEntry($data)
	{
		$data['author_IP']      = get_client_ip();
		$data['add_time']       = time();
		$data['last_edit_time'] = time();

		return $this->db->insert('article_model', $data);
	}

	// 
	public function getEntry($where = array())
	{

		// $data['keywords'] = ! empty($data['keywords']) ? $data['keywords'] : '';

		// $where = array();
		// if( ! empty($data['pid']))
		// 	$where['pid'] = $data['pid'];


		$query = $this->db->where($where)
						  ->get('article_model');

		return $query->result_array();
	}

	// 获取单条
	public function getArticle($id)
	{
		$this->db->where(array('id' => $id));
		$this->db->set('views','views + 1', FALSE);
		$this->db->update('article_model');

		$this->db->where(array('id' => $id));
		$query = $this->db->get('article_model');

		return $query->row_array();
	}

	/**
	 *	@date 2017年2月15日 15:46:37
	 *	@param array $data
	 *	@return array
	 */
	public function updateEntry($data)
	{
		$this->db->where('id', $data['id']);
		unset($data['id']);
		$data['last_edit_time'] = time();
		$data['date'] = strtotime($data['date']);

		$this->db->update('article_model', $data);

		return $this->db->affected_rows();
	}

	/**
	 *	@date 2017年5月9日 09:28:23
	 *	@param int id
	 *	@return array
	 */
    public function delEntry($id)
    {
        $this->db->where(array('id' => $id));
        return $this->db->delete('article_model');
    }

	/**
	 *	@date 2017年5月9日 19:29:23
	 *	@param  int id
	 *	@return
	 */
    public function isShow($id)
    {
        $this->db->where(array('id' => $id));
        $this->db->select('is_show');
        $query = $this->db->get('article_model');

        $data = array();
        $data['is_show'] = $query->result_array()[0]['is_show'] == 1 ? 0 : 1;
        $this->db->where(array('id' => $id));
        $this->db->update('article_model', $data);
        return $this->db->affected_rows();
    }

}