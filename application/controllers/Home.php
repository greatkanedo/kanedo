<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *	@author  kanedo
 *  @email   i@kanedo.cn
 *  @copyright www.kanedo.cn
 */

class Home extends CI_Controller 
{
	/**
	 *	@系统基础信息
	 *	@access  public
	 */
	public $option;


	/**
	 *  @导航
	 *	@access  public
	 */
	public $navigator;

	/**
	 *  @分类
	 *	@access  public
	 */
	public $category;


	/**
	 * @access  public 
	 */
	public function __construct()
	{
		parent::__construct();

		$this->mainInfo();

		$this->Visit_info_model->addEntry();
	}


	/**
	 * @构造数据 2017年5月11日 23:14:32
	 * @access  public
	 */
	private function mainInfo()
	{
		// 加载个性化配置
		$this->config->load('MY_Config');

		// 加载系统类库
		$this->load->helper(array('form', 'url'));

		// 加载模型
		$this->load->model(array('Options_model', 'Navigator_model', 'Category_model', 'Visit_info_model'));

		// 构造基础数据
		$this->option    = $this->Options_model->getOptions();

		// 构造导航
		//$this->navigator = $this->Navigator_model->getEntry();

		// 构造分类树
		$this->category  = createTree($this->Category_model->getCategoryTree(array()), FALSE);
	}


	/**
	 * @前台首页
	 * @access  public
	 */
	public function index()
	{

		$cate = $this->Category_model->getCategoryTree(array());

		$this->load->model('Article_model');

		$this->data = $this->Article_model->getEntry(array('is_show' => 1, 'is_draft' => 0));

		$this->load->view('Home/index', array(
											'option'	=>	$this->option,
											'cat'		=>	$this->category,
											'cate'      =>  $cate,
											'data'      =>  $this->data
											)
		);
		
		$this->output->cache($this->config->item('cache_time'));
	}



	/**
	 *	显示文章详情
	 *	@date 2017年2月15日 21:15:19
	 *
	 */
	public function detail()
	{

		$this->load->model('Article_model');

		$this->data = $this->Article_model->getArticle($this->uri->segment(2));

		if (empty($this->data))		$this->show_404();

		$this->load->view('Home/detail', array(
										'option'	=>	$this->option,
										'cat'		=>	$this->category,
										'data'      =>  $this->data
										));
		$this->output->cache($this->config->item('cache_time'));
	}


	/**
	 *	@分类详情
	 *	@date 2017年5月10日 19:50:20
	 *
	 */
	public function tags()
	{

		$data = $this->Category_model->getTagEntry($this->uri->segment(2));

		if (empty($data))	$this->show_404();
		
		$cat = $this->Category_model->getCategoryTree(array(), TRUE);

		$this->load->view('Home/tags', array(
										'option'	=>	$this->option,
										'cat'		=>	$this->category,
										'data'      =>  $data
										));
		$this->output->cache($this->config->item('cache_time'));
	}


	/**
	 *	@给我留言 
	 *	date 2017年5月14日 10:53:31
	 *
	 */
	public function message()
	{
		$this->load->view('Home/message', array(
											'option'	=>	$this->option,
											'cat'		=>	$this->category
											));
		$this->output->cache($this->config->item('cache_time'));
	}




	/**
	 *	@img
	 *	$date 2017年4月12日 14:22:07
	 *
	 */
	public function Photowall()
	{
		redirect($this->base_url);
		$this->load->view('Home/Photowall', array(
											'option'	=>	$this->option,
											'cat'		=>	$this->category
											));
	}


	/**
	 *	缩略图
	 *	@date 2017年4月12日 15:50:26
	 *
	 */
	public function thumbs()
	{
		$this->load->model('Images_model');
		$data = $this->Images_model->getEntry();

		$this->load->view('Home/thumbs', array('data' => $data));
	}

	/**
	 *	404
	 *	@date 2017年5月11日 20:38:22
	 */
	public function show_404()
	{
		header("HTTP/1.1 404 Forbidden");
		$this->load->view('404', array(
								'option'	=>	$this->option,
								)
		);
		$this->output->cache($this->config->item('cache_time'));
	}


	/**
	 *	404
	 *	@date 2017年2月17日 18:16:30
	 */

	public function _404()
	{
		header("HTTP/1.1 404 Forbidden");
echo <<<STATUS
        <!DOCTYPE html>
        <HTML>
                <meta charset="utf-8">
                <TITLE>404 Not Found</TITLE>
            </HEAD>
            <BODY>
                <H1>Not Found</H1>
                    The requested URL <?php echo dirname({$_SERVER["SCRIPT_NAME"]});?> was not found on this server.<P>
                <HR>
                <ADDRESS>Web Server at {$_SERVER["SERVER_NAME"]} Port {$_SERVER["SERVER_PORT"]}</ADDRESS>
            </BODY>
        </HTML>
STATUS;
die;
	}
}