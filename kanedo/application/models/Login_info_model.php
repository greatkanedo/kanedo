<?php   defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *	@author  kanedo 2017年5月13日 19:39:56
 *  @Email   i@kanedo.cn
 *  @copyright www.kanedo.cn
 */

class Login_info_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function addEntry($info)
	{
		$ip = get_client_ip();

		$ipInfo = object2array(json_decode(getIpInfo($ip)));

	    $data = array();
	    $data['user_name']  = $info->user_name;
	    $data['login_time'] = time();
	    $data['ip']         = ip2long($ip);
	    $data['city']       = empty($ipInfo) ? '' : $ipInfo['data']['city'];

		$this->db->insert('login_info_model', $data);
		return $this->db->affected_rows();
	}

}