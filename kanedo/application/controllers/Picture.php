<?php
/**
 *	@author  kanedo
 *  @Email   i@kanedo.cn
 *  @copyright www.kanedo.cn
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require dirname(__FILE__).'/../libraries/php-sdk-7.1.3/autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;


class Picture extends MY_Controller {

	/**
	 *	@access private
	 */
	private $accessKey;

	/**
	 *	@access private
	 */
  	private $secretKey;

	/**
	 *	@access private
	 */
  	private $auth;

	/**
	 *	@access private
	 */
  	private $bucket;

	/**
	 *	@access private
	 */
  	private $token;


  	private $uploadMgr;


	public function __construct()
	{
		parent::__construct();
	}


	/**
	 *	图片列表 2017年4月14日 18:30:25
	 *	@access public
     *  @param  
     *  @return 
	 */
	public function picList()
	{
		$this->output->cache('60');
		$this->load->view('Picture/list', array('option' => $this->option));
	}

	/**
	 *	图片添加 
	 *	@access public
     *  @param  
     *  @return 
	 */
	public function picAdd()
	{  		
		$url = $this->config->item('url');

		$this->load->view('Picture/add', array(
										'option' => $this->option,
										'url'    => $url
										));
	}

	/**
	 *	图片添加API
	 *	@access public
     *  @param  
     *  @return 
	 */
	public function picDoAdd()
	{
		$this->accessKey = $this->config->item('accessKey');
		$this->secretKey = $this->config->item('secretKey');
		$this->bucket    = $this->config->item('bucket');

		$this->load->model('Images');

		if ($this->Images->addEntry($this->input->post()))
		{
			ajax(1, '上传成功');
		}
		ajax(0, '操作失败');
	}

	/**
	 *	@TokenAPI
	 *	@access public
     *  @param  
     *  @return 
	 */
	public function getToken()
	{
		$data = $this->mkQiniuToken();
		if (empty($data))
			ajax(0, '');
		ajax(1, '', array('key'  =>  $data));
	}


    /**
     *	@param  $bucket.七牛存储空间
     *	@access private
     *	return  返回生成的 token 和 key
     */
    private function mkQiniuToken()
    {
        $this->auth = new Auth($this->accessKey, $this->secretKey);
        $this->token = $this->auth->uploadToken($this->bucket);

        return array('token'=>$this->token);
    }


}