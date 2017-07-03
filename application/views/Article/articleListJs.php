<script type="text/javascript">

/*日志-添加*/
function article_add(title, url, w, h) {
    var index = layer.open({
        type: 2,
        title: title,
        content: url
    });
    layer.full(index);
}
/*日志-编辑*/
function article_edit(title, url, id, w, h) {
    var index = layer.open({
        type: 2,
        title: title,
        content: url
    });
    layer.full(index);
}
/*日志-删除*/
function article_del(obj, id) {
    layer.confirm('确认要删除吗？', function(index) {
        $.ajax({
            type: 'POST',
            url: '/Article/articleDel',
            dataType: 'json',
            data:{id: id},
            success: function(re) {
                if (re.status == '1')
                {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {
                        icon: 1,
                        time: 1000
                    }); 
                }else{
                    layer.msg(re.info, {
                        icon: 1,
                        time: 1000
                    }); 
                }
            },
            error: function(re) {
                console.log(re);
            },
        });
    });
}
 

/*日志-下架*/
function article_stop(obj, id) {
    layer.confirm('确认要下架吗？', function(index) {
        $.ajax({
            method:'POST',
            url:'/Article/isShow',
            data:{"id":id},
            dataType:'json',
            success:function(re){
                if(re.status == 1)
                {
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,'+ id +')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
                    $(obj).remove();
                    layer.msg('已下架!', {
                        icon: 5,
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
}

/*日志-发布*/
function article_start(obj, id) {
    layer.confirm('确认要发布吗？', function(index) {
        $.ajax({
            method:'POST',
            url:'/Article/isShow',
            data:{"id":id},
            dataType:'json',
            success:function(re){
                if(re.status == 1)
                {
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,'+ id +')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
                    $(obj).remove();
                    layer.msg('已发布!', {
                        icon: 6,
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
}
</script>
