<article class="page-container">
    <form class="form form-horizontal" id="my_form" action="/Article/articleDoAdd">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章标题：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="articletitle" name="title">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
                <select name="pid" class="select">
                    <option value="0">--- 请选择分类 ---</option>
                    <?php foreach($cat as $key=>$val): ?>
                        <option value="<?php echo $val['id']; ?>" ><?php echo $val['cat_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                </span> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">排序值：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="0" placeholder="" id="articlesort" name="sort">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">关键词：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="keywords" name="keywords">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">文章作者：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="author" name="authour">
                <input type="hidden" name="is_draft" value="0">
            </div>
        </div>
<!--         <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">允许评论：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="check-box">
                    <input type="checkbox" id="allowcomments" name="allowcomments" value="">
                    <label for="checkbox-pinglun">&nbsp;</label>
                </div>
            </div>
        </div> -->
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">是否显示：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="radio" name="is_show" checked="checked" value="1">是&nbsp;&nbsp;
                <input type="radio" name="is_show" value="0">否
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">文章内容：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea id="TextArea1" cols="20" rows="2" class="ckeditor"></textarea>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button class="btn btn-primary radius" id="submit" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                <button onClick="article_save();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>
                <button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</article>
