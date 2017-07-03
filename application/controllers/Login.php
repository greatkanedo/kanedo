<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *	@author  kanedo
 *  @Email   i@kanedo.cn
 *  @copyright www.kanedo.cn
 */
class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Options_model', 'Navigator_model', 'Category_model'));
	}

		// 登录页
	public function login()
	{
		$this->load->view('Login/login');
	}


		// 登录
	public function checkUser()
	{
		$this->form_validation->set_rules('user', '用户名', 'trim|required|htmlspecialchars');
		$this->form_validation->set_rules('passwd', '密码', 'trim|required|htmlspecialchars');

		if( $this->form_validation->run() === FALSE )
		{
			ajax(0, validation_errors());
			return FALSE;
		}else
		{
			$this->load->model('Admin_model');

			if($info = $this->Admin_model->passwordCheck($this->input->post('user'), $this->input->post('passwd')))
			{
				$this->setInfo($info);
				ajax(1, '', array('go' => '/admin'));
			}else{

				ajax(0, '用户名或密码错误');
			}
		}
	}

	// 记录登录信息
	private function setInfo($info)
	{
		$this->session->is_login   = 1;
		$this->session->admin_info = object2array($info);
		$this->load->model('Login_info_model');
		// 添加登录记录
		$this->Login_info_model->addEntry($info);
	}

		// 后台登出
	public function logout()
	{
		$this->session->userdata['is_login'] = 0;
		unset(
			$this->session->userdata['user'],
			$this->session->userdata['user_nicename'],
			$this->session->userdata['user_email']
		);
		redirect(base_url('login'), 'location');
	}





}