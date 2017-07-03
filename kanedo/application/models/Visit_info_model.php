<?php   defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *	@author  kanedo 
 *  @Email   i@kanedo.cn
 *  @copyright www.kanedo.cn
 */

class Visit_info_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 *	@记录访客信息 2017年5月13日 20:55:47
	 *	return  boolean
	 *
	 */
	public function addEntry()
	{
		$ip = get_client_ip();

		$ipInfo = object2array(json_decode(getIpInfo($ip)));

	    $data = array();
	    
	    $data['country']  = empty($ipInfo['data']['country']) ? 'Unknown' : $ipInfo['data']['country'];
	    $data['area']     = empty($ipInfo['data']['area'])    ? 'Unknown' : $ipInfo['data']['area'];
	    $data['region']   = empty($ipInfo['data']['region'])  ? 'Unknown' : $ipInfo['data']['region'];
	    $data['isp']      = empty($ipInfo['data']['isp'])     ? 'Unknown' : $ipInfo['data']['isp'];
	    $data['city']     = empty($ipInfo['data']['city'])    ? 'Unknown' : $ipInfo['data']['city'];
	    $data['ip']       = ip2long($ip);
	    $data['add_time'] = time();
	    
	    $this->db->where(array('ip' => $data['ip']));
        $query = $this->db->get('visit_info_model');
        if ( ! empty($query->row_array()))
        {
        	if ((time() - $query->row_array()['add_time']) < 600)
        		return false;
        }
	    

		$this->db->insert('visit_info_model', $data);
		return $this->db->affected_rows();
	}

}