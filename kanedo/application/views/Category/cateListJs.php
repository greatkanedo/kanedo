    <script type="text/javascript" src="/static/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="/static/lib/laypage/1.2/laypage.js"></script>
    <script type="text/javascript">


    /*分类-添加*/
    function article_add(title, url, w, h) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    
    /*分类-编辑*/
    function article_edit(title, url, id, w, h) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*分类-删除*/
    function article_del(obj, id) {
        layer.confirm('确认要删除吗？', function(index) {
            $.ajax({
                type: 'POST',
                url: '/Category/cateDel',
                data:{"id":id},
                dataType: 'json',
                success: function(re) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {
                        icon: 1,
                        time: 1000
                    });
                },
                error: function(err) {
                    layer.msg(err, {
                        icon: 1,
                        time: 1000
                    });
                },
            });
        });
    }

    /*分类*/
    function article_stop(obj, id) {
    	layer.confirm('确认不启用该分类？', function(index) {
	        $.ajax({
	           	method:'POST',
	           	url:'/Category/isShow',
	           	data:{"id":id},
	           	dataType:'json',
	           	success:function(re){
	           		if(re.status == 1)
	                {
	                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,' + id + ')" href="javascript:;" title="不启用"><i class="Hui-iconfont">&#xe603;</i></a>');
	                    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">不启用</span>');
	                    $(obj).remove();
	                    layer.msg(re.info, {
	                        icon: 1,
	                        time: 1000
	                    });
	                }else{
	                    layer.msg(re.info, {
	                        icon: 5,
	                        time: 1000
	                    });
	                }
	           	},
	           	error:function(err){
	       		    layer.msg(err.info, {
	                    icon: 5,
	                    time: 1000
	                });
	           	}
	        });
    	});
    };

    /*分类-发布*/
    function article_start(obj, id) {
    	layer.confirm('确认启用该分类？', function(index) {
	    	$.ajax({
	           	method:'POST',
	           	url:'/Category/isShow',
	           	data:{"id":id},
	           	dataType:'json',
	           	success:function(re){
	                if(re.status == 1)
	                {
	                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,' + id + ')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6de;</i></a>');
	                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">启用</span>');
	                    $(obj).remove();
	                    layer.msg(re.info, {
	                        icon: 1,
	                        time: 1000
	                    });
	                }else{
	                    layer.msg(re.info, {
	                        icon: 5,
	                        time: 1000
	                    });
	                }
	            },
	            error:function(err){
	       		    layer.msg(err, {
	                    icon: 5,
	                    time: 1000
	                });
	           	}
	        });
	    });
    };
    </script>