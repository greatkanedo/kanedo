<?php   defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *  @author  kanedo
 *  @Email   i@kanedo.cn
 *  @copyright www.kanedo.cn
 */
class Options_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	/**
	*	网站基础信息
	*	@return array
	*/
	public function getOptions()
	{
		$query = $this->db->get('options_model');

		$array = array();
		foreach($query->result() as $val)
		{
			$array[$val->option_name] = $val->option_value;
		}

		return $array;
	}

	public function updateEntry($data)
	{

		$arr = array();
		foreach($data as $key=>$val)
		{
			$this->db->where('option_name', $key);
			$arr['option_value'] = trim($val);
			$this->db->update('options_model', $arr);
			$arr = array();
		}

		return $this->db->affected_rows();
	}

}