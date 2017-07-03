

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 分类管理 <span class="c-gray en">&gt;</span> 分类列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a class="btn btn-primary radius" data-title="添加分类" data-href="/Category/cateAdd" onclick="Hui_admin_tab(this)" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a></span> <span class="r">共有数据：<strong><?php echo empty($cate) ? 0 : count($cate); ?></strong> 条</span> </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-hover table-sort">
                <thead>
                    <tr class="text-c">
                        <th width="25">
                            <input type="checkbox" name="" value="">
                        </th>
                        <th width="80">ID</th>
                        <th>分类标题</th>
                        <th width="75">浏览次数</th>
                        <th width="120">添加时间</th>
                        <th width="120">最后编辑时间</th>
                        <th width="60">是否启用</th>
                        <th width="120">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cate as $key=>$val): ?>
                    <tr class="text-c">
                        <td>
                            <input type="checkbox" value="" name="">
                        </td>
                        <td>
                            <?php echo $val['id']; ?>
                        </td>
                        <td class="text-c" style="width: 100px;"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','category_edit','<?php echo $val['id']; ?>')" title="查看"><?php echo $val['cat_name']; ?></u></td>
                        <td><?php echo $val['num']; ?></td>
                        <td>
                            <?php echo date('Y-m-d H:i:s', $val['add_time']); ?>
                        </td>
                        <td>
                            <?php echo date('Y-m-d H:i:s', $val['update_time']); ?>
                        </td>
                        <td class="td-status">
                        <?php if($val['is_show'] == 1): ?>
                        	<span class="label label-success radius">启用</span>
                        <?php else: ?>
                        	<span class="label label-defaunt radius">不启用</span>
                        <?php endif; ?>
                        </td>
                        <td class="f-14 td-manage">
                        	<?php if($val['is_show'] == 1): ?>
		                        <a style="text-decoration:none" onClick="article_stop(this,<?php echo $val['id']; ?>)" href="javascript:;" title="启动">
		                        	<i class="Hui-iconfont">&#xe6de;</i>
		                        </a>
							<?php else: ?>
								<a style="text-decoration:none" onclick="article_start(this,<?php echo $val['id']; ?>)" href="javascript:;" title="不启用"><i class="Hui-iconfont"></i>
								</a>
		                    <?php endif; ?>
	                        <a style="text-decoration:none" class="ml-5" onClick="article_edit('分类编辑','cateEdit/<?php echo $val['id']; ?>','')" href="javascript:;" title="编辑">
	                        	<i class="Hui-iconfont">&#xe6df;</i>
	                        </a>
	                        <a style="text-decoration:none" class="ml-5" onClick="article_del(this,<?php echo $val['id']; ?>)" href="javascript:;" title="删除">
	                        	<i class="Hui-iconfont">&#xe6e2;</i>
	                        </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

