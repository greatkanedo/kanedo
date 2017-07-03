$(function(){

    $('#button').click(function(){

        var form = $('#login_form');
        var url_ = form.attr('action');
        $.ajax({
            url: url_,
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(textStatus);
            },
            success: function(re){
                if(re.status == 1)
                {
                    window.location.href = re.data.go;
                }else{
                    layer.msg(re.info);
                }
            },
        })
        return false;
    });

    $("#submit").click(function() {

        var form = $("#my_form");
        var this_ = $("#submit");
        this_.attr('disabled', true).addClass('disabled');
        var url_ = form.attr('action');
        $.ajax({
            url: url_,
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(textStatus);
            },
            success: function(re) {
                this_.removeAttr('disabled', true).removeClass('disabled');
                if (re.status == '1') {
                    if (re.data.go)
                    {
                        window.location.href = re.data.go
                    }else{
                        layer.msg(re.info, {
                            icon: 1,
                            time: 3000
                        });
                        window.location.reload();
                    }
                } else {
                    layer.alert(re.info)
                }
            }
        });
        return false;
    });
});


String.prototype.trimEnd = function(c)  
{  
    if(c==null||c=="")  
    {  
        var str = this;  
        var rg  = c;
        var i   = str.length;  
        while (rg.test(str.charAt(--i)));  
        return str.slice(0, i + 1);  
    }  
    else  
    {  
        var str= this;  
        var rg = new RegExp(c);  
        var i = str.length;  
        while (rg.test(str.charAt(--i)));  
        return str.slice(0, i + 1);  
    }  
}