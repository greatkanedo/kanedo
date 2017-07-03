<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Article_model');
	}


	/**
	 *	@文章列表 2017年5月8日 22:32:16
	 *	@access  public
	 *
	 */
	public function articleList()
	{
		$cat = $this->Category_model->getCategoryTree(array(), true);

		$data = $this->Article_model->getEntry();

		$this->load->view('Article/list', array(
										'cat'    => $cat,
										'option' => $this->option,
										'data'   => $data
											));
	}


	/**
	 *	@文章添加页 2017年5月8日 22:32:16
	 *	@access  public
	 *
	 */
	public function articleAdd()
	{
		$cat = $this->Category_model->getCategoryTree(array(), true);

		$this->load->view('Article/add', array(
										'cat'   => $cat,
										'option' => $this->option
											));
	}

	/**
	 *	@添加文章API 2017年5月8日 22:24:37
	 *	@access  public
	 *
	 */
	public function articleDoAdd()
	{
		if ($this->Article_model->addEntry($this->input->post()))
		{
			ajax(1, '', array('go' => '/Article/articleList'));
		}else{
			ajax(1, '添加失败');
		}

	}

	/**
	 *	@删除文章API 2017年5月9日 09:30:53
	 *	@access  public
	 *
	 */
	public function articleDel()
	{
		if ($this->Article_model->delEntry($this->input->post('id')))
		{
			ajax(1, '删除成功');
		}
		ajax(1, '删除失败');
	}


	/**
	 *	@是否显示文章API 2017年5月9日 19:30:36
	 *	@access  public
	 *
	 */
	public function isShow()
	{
		if ($this->Article_model->isShow($this->input->post('id')))
		{
			ajax(1, '修改成功');
		}
		ajax(0, '修改失败');
	}

	/**
	 *	@文章编辑 2017年5月10日 09:54:32
	 *	@access  public
	 *
	 */
	public function articleEdit()
	{
		$cat = $this->Category_model->getCategoryTree(array(), TRUE);

		$this->load->model('Article_model');

		$data = $this->Article_model->getArticle($this->uri->segment(3));

		$this->load->view('/Article/edit', array(
											'option' => $this->option,
											'data'   => $data,
											'cat'    => $cat
											));
	}

	public function articleDoEdit()
	{
		$this->load->model('Article');

		if ($this->Article->updateEntry($this->input->post()))
		{
			ajax(1, '', array('go' => '/Article/list'));
		}else{
			ajax(1, '添加失败');
		}
	}
}