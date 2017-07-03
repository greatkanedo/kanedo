<?php
/**
 *	@author  kanedo
 *  @Email   i@kanedo.cn
 *  @copyright www.kanedo.cn
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(dirname(__FILE__).'/../libraries/php-sdk-7.1.3/autoload.php');

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

		// 后台首页
	public function index()
	{
		$this->load->view('Admin/index', array(
										'uinfo'   => $this->uinfo,
										'option'  => $this->option
										));
	}

		// 基础信息
	public function welcome()
	{
		$server = array();
		$server['server_name'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$server['server_ip']   = $_SERVER["SERVER_ADDR"];
		$server['host']        = $_SERVER['HTTP_HOST'];
		$server['port']        = $_SERVER["SERVER_PORT"];
		$server['server_info'] = php_uname('s');
		$server['php_info']    = PHP_VERSION;
		$server['server_os']   = PHP_OS;
		$server['server_time'] = time();
		$server['server_user'] = Get_Current_User();
		$server['server_lang'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$server['run_time']    = explode(",", exec('uptime'))[0];

		$this->load->view('Admin/inc/header', array('option' => $this->option));
		$this->load->view('Admin/welcome', array(
											'uinfo'  => $this->uinfo,
											'server' => $server
											)
		);

		$this->load->view('Admin/inc/footer');
	}




		// 编辑基础信息api
	public function info_edit()
	{

		// -------- 代码待修改 ---------
		if ($this->Options_model->update_entry($this->input->post()))
		{
			ajax(1, '');
		}else{
			ajax(1, '操作失败');
		}
	}

		// 首页导航列表
	public function web_list()
	{
		$this->load->model('Nav');
		$data = $this->kd_nav->get_entry();
		$this->load->view('Admin/web_list', array('data' => $data));
	}

		// 添加首页导航
	public function web_add()
	{
		$this->load->view('Admin/web_add');
	}

		// 首页导航添加api
	public function web_do_add()
	{
		$this->load->model('Nav');
		if ($this->Nav->insert_entry($this->input->post()))
		{
			ajax(1, '');
		}else{
			ajax(0, '操作失败');
		}
	}

	public function pass()
	{
		$this->load->view('Admin/pass');
	}

	public function page()
	{
		$this->load->view('Admin/page');
	}

	public function adv()
	{
		$this->load->view('Admin/adv', array('error' => ''));
	}


	/**
	 *
	 *
	 */
	public function upload()
	{
		$path = date('Ymd');
		$config['upload_path']   = './uploads/'.$path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 0;
        $config['max_width']     = 0;
        $config['max_height']    = 0;

        if  ( ! is_dir($config['upload_path']))
        {
        	mkdir($config['upload_path']);
        }

        $this->load->library('upload', $config);

        if  ( ! $this->upload->do_upload('img'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('success', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            $this->load->view('success', $data);
        }
	}


	public function message()
	{
		$this->load->view('Admin/message');
	}


	public function column()
	{
		$this->load->view('Admin/column');
	}



}