<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Category extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
	}


	public function cateList()
	{

		$category = $this->Category_model->getCategoryTree();

		$this->load->view('Category/list', array(
										'cate'   => $category,
										'option' => $this->option
											));
	}



	public function cateAdd()
	{
		$where = array();
		
		$this->load->view('Category/add', array(
									'option' => $this->option,
									'cat'    => $this->category,
										));
	}


	public function cateDoAdd()
	{
		$this->Category_model->addCat($this->input->post()) ? 
		ajax(1, '添加成功') : ajax(0, '添加失败');
	}


	public function cateEdit()
	{
		$cat  = $this->Category_model->getCategoryTree(array(), TRUE);
		$data = $this->Category_model->getCate($this->uri->segment(3));

		$this->load->view('Category/edit', array(
											'option' =>  $this->option,
											'data'   =>  $data, 
											'cat'    =>  $this->category
											));
	}



	public function cateDoEdit()
	{
		$this->Category_model->updateEntry($this->input->post()) !== false ? 
		ajax(1, '', array('go' => '/Category/cateList')) : ajax(0, '编辑失败');
	}


	// 是否显示分类
	public function isShow()
	{
		$this->Category_model->isShow($this->input->post('id')) ? 
		ajax(1, '修改成功') : ajax(0, '修改失败');
	}


	// 删除分类
	public function cateDel()
	{
		$this->Category_model->delEntry($this->input->post('id')) ? 
		ajax(1, '修改成功') : ajax(0, '修改失败');
	}


}