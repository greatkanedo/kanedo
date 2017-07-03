<?php   defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *  @author  kanedo
 *  @Email   i@kanedo.cn
 *  @copyright www.kanedo.cn
 */
class Navigator_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function insertEntry($data)
	{
		// if(empty($data) || !is_array($data))
		// {
		// 	$this->err = array()'不允许提交空内容';	return false;
		// }

		$data['add_time'] = time();

		$this->db->insert('navigator_model', $data);
		return $this->db->affected_rows();
	}

	public function getEntry()
	{
		//$this->db->select('title,url');
		$this->db->where('is_show', 1);
		$query = $this->db->get('navigator_model');
		return $query->result_array();
	}

}