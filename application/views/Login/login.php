<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>KaneDo's Blog</title>
<link href="/static/css/login/style_log.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/static/css/login/style.css">
<link rel="stylesheet" type="text/css" href="/static/css/login/userpanel.css">
<link rel="stylesheet" type="text/css" href="/static/css/login/jquery.ui.all.css">
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
</head>

<body class="login" mycollectionplug="bind">
<div class="login_m">
<div class="login_logo"><img src="/static/images/logo.png" width="196" height="46"></div>
<div class="login_boder">

<div class="login_padding" id="login_model">

  <h2>USERNAME</h2>
  <form action="/sign" method="post" id="login_form">
  <label>
    <input type="text" id="username" name="user" class="txt_input txt_input2" onfocus="" onblur="" />
  </label>
  <h2>PASSWORD</h2>
  <label>
    <input type="password" name="passwd" id="userpwd" class="txt_input" onfocus="" onblur="" />
  </label>
  <p class="forgot"><a id="iforget" href="javascript:void(0);">&nbsp;</a></p>
  <div class="rem_sub">
  <div class="rem_sub_l">
  <input type="checkbox" name="checkbox" id="save_me">
   <label for="checkbox">Remember me</label>
   </div>
   </form>
    <label>
      <input type="submit" class="sub_button" name="button" id="button" value="SIGN-IN" style="opacity: 0.7;">
    </label>
  </div>
</div>

<div class="copyrights">-------<a href="javascript:void(0);" >-------</a></div>

<div id="forget_model" class="login_padding" style="display:none">
<br>
<!--login_padding  Sign up end-->
</div>
<!--login_boder end-->
</div>
<!--login_m end-->
 <br> <br>
<p align="center"><?php echo validation_errors(); ?>
  <a href="javascript:void(0);" target="_blank" title=""></a>
  <a href="javascript:void(0);" title="" target="_blank"></a>
</p>
<script type="text/javascript" src="/static/js/common.js"></script>
<script type="text/javascript">
      if(window != top)
        top.location = location.href;
</script>
</body>
</html>