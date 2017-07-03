<?php    defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *	@author  kanedo
 *  @Email   i@kanedo.cn
 *  @copyright www.kanedo.cn
 */

class MY_Controller extends CI_Controller {

	protected $uinfo;

	/**
	 *	@access  public
	 */
	public $option;


	/**
	 *	@access  public
	 */
	public $navigator;


	public $category;


	public function __construct()
	{
		parent::__construct();
		$this->mainInfo();
		if (empty($this->session->userdata['is_login']) || $this->session->userdata['is_login'] != 1)
			redirect(base_url(), 'location');
	}


	/**
	 *	@构建基础信息 2017年5月12日 11:53:34
	 *	
	 *
	 */
	private function mainInfo()
	{
		// 加载个性化配置
		$this->config->load('MY_Config');

		// 加载系统类库
		$this->load->helper(array('form', 'url'));
		
		// 加载模型
		$this->load->model(array('Options_model', 'Order_model'));

		// 构造基础数据
		$this->option    = $this->Options_model->getOptions();

		// 构造导航
		$this->navigator = $this->Navigator_model->getEntry();

		// 构造分类树
		$this->category  = createTree($this->Category_model->getCategoryTree(array()), TRUE);

		// 用户登录信息
		$this->uinfo     = $this->session->admin_info;
	}
}