<?php   defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *	@author  kanedo
 *  @Email   i@kanedo.cn
 *  @copyright www.kanedo.cn
 */

class Admin_model extends CI_Model {

	/**
	 *	@access private
	 */
	private $username;

	/**
	 *	@access private
	 */
	private $passwd;


	private $user;


	public function __construct()
	{
		parent::__construct();
	}

	/**
	 *	判断是否包含该用户
	 *	@param 
	 *
	 */
	private function getByUsername()
	{
		$this->db->where('user_name', $this->username);
		$query = $this->db->get('admin_model');

		if ($query->num_rows() == 1)
		{
			return $query->row();
		}
		return FALSE;
	}


	public function passwordCheck($username, $passwd)
	{
		$this->username = $username;
		$this->passwd   = $passwd;

		$passwd = md5($this->config->item('pwd_code').$this->passwd);

		if ($this->user = $this->getByUsername())
		{
			return $this->user->user_pass == $passwd ? $this->updateEntry() : FALSE;
		}

		return FALSE;
	}

	private function updateEntry()
	{
		$data = array();
		$data['last_login_ip']   = ip2long(get_client_ip());
		$data['last_login_time'] = time();

		$this->db->where('id', $this->user->id);
		$this->db->set('login_num', 'login_num + 1', FALSE); 
		$this->db->update('admin_model', $data);
		return $this->user;
	}

}