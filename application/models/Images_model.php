<?php   defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *  @author  kanedo
 *  @Email   i@kanedo.cn
 *  @copyright www.kanedo.cn
 */
class Images_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

	/**
	 *	上传图片
	 *	@date 2017年4月12日 16:20:28
	 *
	 */
	public function addEntry($data)
	{
        $data['add_time'] = time();
		$this->db->insert('kd_images', $data);
		return $this->db->affected_rows();
	}


	public function getEntry()
	{
		$where = array();

		$query = $this->db->where($where)
						  ->get('images_model');

		$array = array();
		foreach ($query->result_array() as $key => $val)
		{
			if (empty($val['pics']))
				continue;

			if ( ! strpos($val['pics'], '|'))
			{
				$array[] = $val['pics'];
				continue;
			}

			$tmp = explode('|', $val['pics']);
			foreach ($tmp as $k => $v)
			{
				$array[] = $v;
			}
			
		}
		return $array;
	}

}