
    <article class="page-container">
        <form class="form form-horizontal" id="my_form" method="post" action="/Category/cateDoEdit">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类标题：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="<?php if(!empty($data['cat_name'])) echo $data['cat_name']; ?>" placeholder="" id="articletitle" name="cat_name">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属分类：</label>
                <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="pid" class="select">
					<option value="0">--- 请选择分类 ---</option>
					<?php foreach($cat as $key=>$val): ?>
						<option value="<?php echo $val['id']; ?>" <?php if($val['id'] == $data['pid']) echo 'selected="selected"'; ?> ><?php echo $val['cat_name']; ?></option>
					<?php endforeach; ?>
				</select>
				</span> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">链接：</label>
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="<?php if(!empty($data['link'])) echo $data['link']; ?>" placeholder="" id="articlesort" name="link">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">排序：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="<?php if(!empty($data['sort'])) echo $data['sort']; else echo 0; ?>" placeholder="" id="articlesort" name="sort">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">是否显示：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="radio" name="is_show" <?php echo $data['is_show'] == 1 ? 'checked="checked"' : ''; ?> value="1">是
                    <input type="radio" name="is_show" <?php echo $data['is_show'] == '0' ? 'checked="checked"' : ''; ?> value="0">否
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <button id="submit" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                    <button onClick="" class="btn btn-default radius" type="button"><a href="/Category/cateList">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></button>
                </div>
            </div>
        </form>
    </article>

