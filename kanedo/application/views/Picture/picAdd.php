

    <link href="/static/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
    <div class="page-container">
        <form class="form form-horizontal" id="my_form" method="post" action="/Picture/picDoAdd" >
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>图片标题：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" name="title">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box">
				<select name="pid" class="select">
					<option value="0">--- 请选择分类 ---</option>
				</select>
				</span>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">排序值：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="0" name="sort">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">是否显示：</label>
                <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                    <div class="check-box">
                        <input type="radio" name="is_show" value="1" checked="checked" id="checkbox-1">是&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="is_show" value="0" id="checkbox-1">否
                        <label for="checkbox-1">&nbsp;</label>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">关键词：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="0" name="key_words">
                    <input type="hidden" name="pics" value="">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">图片摘要：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <textarea name="abstract" cols="" rows="" class="textarea" placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="$.Huitextarealength(this,200)"></textarea>
                    <p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <div class="uploader-thum-container">
                        <div id="fileList" class="uploader-list"></div>
                        <div id="filePicker">选择图片</div>
                        <button id="btn-star" class="btn btn-default btn-uploadstar radius ml-10">开始上传</button>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">图片上传：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <div class="uploader-list-container">
                        <div class="queueList">
                            <div id="dndArea" class="placeholder">
                                <div id="filePicker-2"></div>
                                <p>或将照片拖到这里，单次最多可选300张</p>
                            </div>
                        </div>
                        <div class="statusBar" style="display:none;">
                            <div class="progress"> <span class="text">0%</span> <span class="percentage"></span> </div>
                            <div class="info"></div>
                            <div class="btns">
                                <div id="filePicker2"></div>
                                <div class="uploadBtn">开始上传</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <button onClick="article_save_submit();" id="submit" class="btn btn-primary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 提交</button>
                    <button onClick="layer_close();" class="btn btn-default radius" type="button"><a href="/Picture/pic_list">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></button>
                </div>
            </div>
        </form>
    </div>

