<?php
/**
*	首页分页配置
*	@date 2017年2月15日 16:46:26
*	@return array
*/

$config['base_url'] = 'https://www.kanedo.com/page/';
$config['total_rows'] = '';								// 总条数
$config['per_page'] = 10;								// 每页显示数量
$config['full_tag_open'] = '<ul class="pagination">';	// 起始标签放在所有结果的左侧。可以直接在标签内部加上class标签
$config['full_tag_close'] = '</ul>';					// 结束标签放在所有结果的右侧。

$config['num_links'] = 2;								// 页码的前面和后面的“数字”链接的数量


$config['first_tag_open'] = '<span>';						// 第一个链接的起始标签。
$config['first_tag_close'] = '</span>';					// 第一个链接的结束标签。

$config['next_tag_open'] = '<li>';						// 下一页链接的起始标签。
$config['next_tag_close'] = '</li>';					// 下一页链接的结束标签。

$config['prev_tag_open'] = '<li>';						// 上一页链接的起始标签。
$config['prev_tag_close'] = '</li>';					// 上一页链接的结束标签。

$config['cur_tag_open'] = '<li class="active"><span>';	// 当前页链接的起始标签。可以加多个标签(因为当前页会自动屏蔽了a标签需要手动加上，为保持样式一致)
$config['cur_tag_close'] = '</span></li>';				// 当前页链接的结束标签。

$config['num_tag_open'] = '<li><a>';					// 数字链接的起始标签。
$config['num_tag_close'] = '</a></li>';					// 数字链接的结束标签。