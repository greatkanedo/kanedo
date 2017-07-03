

<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 日志管理 <span class="c-gray en">&gt;</span> 日志列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form method="post" action="" >
        <div class="text-c">
            <button onclick="removeIframe()" class="btn btn-primary radius">关闭选项卡</button>
            <span class="select-box inline">
                <select name="pid" class="select">
                    <option value="0">--- 请选择分类 ---</option>
                    <?php foreach($cat as $key=>$val): ?>
                        <option value="<?php echo $val['id']; ?>" ><?php echo $val['cat_name']; ?></option>
                    <?php endforeach; ?>
                </select>
    		</span> 日期范围：
            <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;"> -
            <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
            <input type="text" name="" id="" placeholder="日志名称" style="width:250px" class="input-text">
            <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜日志</button>
        </div>
    </form>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a class="btn btn-primary radius" data-title="添加日志" data-href="/Article/ArticleAdd" onclick="Hui_admin_tab(this)" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加日志</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
                <tr class="text-c">
                    <th width="80">ID</th>
                    <th>标题</th>
                    <th width="80">分类</th>
                    <th width="120">添加时间</th>
                    <th width="120">更新时间</th>
                    <th width="75">浏览次数</th>
                    <th width="60">发布状态</th>
                    <th width="120">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php 
					if ( ! empty($data)):

						foreach ($data as $key => $val):
				?>
                <tr class="text-c">
                    <td><?php echo $val['id']; ?></td>
                    <td class="text-l" style="text-align: center;">
                    	<u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10001')" title="查看"><?php echo $val['title']; ?></u>
                    	</td>
                    <td><?php echo $val['pid']; ?></td>
                    <td><?php echo date('Y-m-d H:i:s', $val['add_time']); ?></td>
                    <td><?php echo date('Y-m-d H:i:s', $val['last_edit_time']); ?></td>
                    <td><?php echo $val['views']; ?></td>
                    <td class="td-status">
                    <?php if ($val['is_show'] == 1): ?>
                        <span class="label label-success radius">已发布</span>
                    <?php else: ?>
                        <span class="label label-defaunt radius">未发布</span>
                    <?php endif; ?>
                    </td>
                    <td class="f-14 td-manage">
                        <?php if ($val['is_show'] == 1): ?>
                        <a style="text-decoration:none" onClick="article_stop(this,<?php echo $val['id']; ?>)" href="javascript:;" title="下架">
                            <i class="Hui-iconfont">&#xe6de;</i>
                        </a>
                        <?php else: ?>
                        <a style="text-decoration:none" onclick="article_start(this,<?php echo $val['id']; ?>)" href="javascript:;" title="发布">
                            <i class="Hui-iconfont">&#xe603;</i>
                        </a>
                        <?php endif; ?>
                        <a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html',<?php echo $val['id']; ?>)" href="javascript:;" title="编辑">
                            <i class="Hui-iconfont">&#xe6df;</i>
                        </a>
                        <a style="text-decoration:none" class="ml-5" onClick="article_del(this, <?php echo $val['id']; ?>)" href="javascript:;" title="删除">
                            <i class="Hui-iconfont">&#xe6e2;</i>
                        </a>
                    </td>
                </tr>
                <!-- 					<tr class="text-c">
						<td><input type="checkbox" value="" name=""></td>
						<td>10002</td>
						<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10002')" title="查看">资讯标题</u></td>
						<td>行业动态</td>
						<td>H-ui</td>
						<td>2014-6-11 11:11:42</td>
						<td>21212</td>
						<td class="td-status"><span class="label label-success radius">草稿</span></td>
						<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_shenhe(this,'10001')" href="javascript:;" title="审核">审核</a> <a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr> -->
                <?php
					endforeach;
					else:
				?>
                    <tr>
                        <td colspan="8" style="text-align: center;">暂无数据</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
