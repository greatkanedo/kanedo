<?php
/**
 * Created by Sublime Text.
 * User: kanedo
 * Date: 2017年4月12日 
 * Time: 11:08:33
 */


// ajax回调
function ajax($status = 0, $info = '操作成功', $data = array())
{
	die(json_encode(array('status'=>$status, 'info'=>$info, 'data'=>$data)));
}


function fun($str){

	echo '<pre />';
	print_r($str);
	die;
}

// 生成树形结构
function tree2html($tree){

	static $i;
	$i++;

	static $ul_class = 'sb-menu';
	static $a_class  = 'animsition-link';

	if($i == 1) $ul_class = 'sb-submenu';
	if($i  > 0) $a_class  = 'sb-toggle-submenu';


    echo '<ul class="'.$ul_class.'">';
    foreach($tree as $leaf) {  
        echo '<li><a href="/" target="_BLANK" class="'.$a_class.'">'.$leaf['cat_name'].'<small>(1)</small></a>';
        if( ! empty($leaf['children'])) tree2html($leaf['children']);
        echo '</li>';  
    }
    echo '</ul>';
}

//php防注入和XSS攻击通用过滤. 
// $_GET     && SafeFilter($_GET);
// $_POST    && SafeFilter($_POST);
// $_COOKIE  && SafeFilter($_COOKIE);
  
function SafeFilter(&$arr) 
{

	$ra=Array('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/','/script/','/javascript/','/vbscript/','/expression/','/applet/','/meta/','/xml/','/blink/','/link/','/style/','/embed/','/object/','/frame/','/layer/','/title/','/bgsound/','/base/','/onload/','/onunload/','/onchange/','/onsubmit/','/onreset/','/onselect/','/onblur/','/onfocus/','/onabort/','/onkeydown/','/onkeypress/','/onkeyup/','/onclick/','/ondblclick/','/onmousedown/','/onmousemove/','/onmouseout/','/onmouseover/','/onmouseup/','/onunload/');

	if(is_array($arr))
	{
		foreach($arr as $key => $value) 
		{
			if (!is_array($value))
			{
				if (!get_magic_quotes_gpc())//不对magic_quotes_gpc转义过的字符使用addslashes(),避免双重转义。
				{
					$value  = addslashes($value);//给单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）加上反斜线转义
				}
				$value       = preg_replace($ra,'',$value);     //删除非打印字符，粗暴式过滤xss可疑字符串
				$arr[$key]     = htmlentities(strip_tags($value)); //去除 HTML 和 PHP 标记并转换为 HTML 实体
			}
			else
			{
				SafeFilter($arr[$key]);
			}
		}
	}
}

// 压缩html代码
function compress_html($string) {

    $string  = str_replace("\r\n", '', $string); //清除换行符
    $string  = str_replace("\n", '', $string);   //清除换行符
    $string  = str_replace("\t", '', $string);   //清除制表符
    $pattern = array (
            "/> *([^ ]*) *",
            "/[\s]+/",
            "//",
            "/\" /",
            "/ \"/",
            "'/\*[^*]*\*/'"
    );
    $replace = array (
                    ">\\1<",
                    " ",
                    "",
                    "\"",
                    "\"",
                    ""
    );
    return preg_replace($pattern, $replace, $string);
}

/**
 * 获取用户真实 IP
 */
function get_client_ip(){
    
    static $realip;
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    return $realip;
}

function getIpInfo($ip)
{
    return file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$ip);
}



/**
 * 将前端的驼峰变量转换成数据库字段对应的下划线变量
 * @date 2016年08月08日16:42:08
 * @param $hump
 * @return array
 */
function changeHumpToUnderLine($hump)
{
    $underLineArr = [];
    foreach ($hump as $key => $value) {
        $underLineArr[strtolower(preg_replace('/((?<=[a-z])(?=[A-Z]))/', '_', $key)) ] = $value;
    }
    return $underLineArr;
}


/**
 * 获得toastr弹窗插件的参数
 * @date 2016年08月08日18:56:41
 * @return array
 */
function getToastParams()
{
    return [
        'positionClass'     => "toast-top-right",
        'closeButton'       => 'true',
        "progressBar"       => 'false',
        "showDuration"      => "400",
        "hideDuration"      => "1000",
        "timeOut"           => "7000",
        "extendedTimeOut"   => "1000",
        "showEasing"        => "swing",
        "hideEasing"        => "linear",
        "showMethod"        => "fadeIn",
        "hideMethod"        => "fadeOut"
    ];
}


/**
 * 截取含有 html标签的字符串
 * @param (string) $str   待截取字符串
 * @param (int)  $lenth  截取长度
 * @param (string) $repalce 超出的内容用$repalce替换之（该参数可以为带有html标签的字符串）
 * @param (string) $anchor 截取锚点，如果截取过程中遇到这个标记锚点就截至该锚点处
 * @return (string) $result 返回值
 * @demo  $res = cut_html_str($str, 256, '...'); //截取256个长度，其余部分用'...'替换
 * -------------------------------------------------------------------------------
 * $ Author: Wang Jian.  |   Email: wj@yurendu.com   |   Date: 2014/03/16
 * ===============================================================================
 */
if ( ! function_exists('cut_html_str'))
{
    function cut_html_str($str, $lenth, $replace='...', $anchor='<!-- break -->'){
        $_lenth = mb_strlen($str, "utf-8"); // 统计字符串长度（中、英文都算一个字符）
        if($_lenth <= $lenth){
            return $str;    // 传入的字符串长度小于截取长度，原样返回
        }
        $strlen_var = strlen($str);     // 统计字符串长度（UTF8编码下-中文算3个字符，英文算一个字符）
        if(strpos($str, '<') === false){
            return mb_substr($str, 0, $lenth);  // 不包含 html 标签 ，直接截取
        }
        if($e = strpos($str, $anchor)){
            return mb_substr($str, 0, $e);  // 包含截断标志，优先
        }
        $html_tag = 0;  // html 代码标记
        $result = '';   // 摘要字符串
        $html_array = array('left' => array(), 'right' => array()); //记录截取后字符串内出现的 html 标签，开始=>left,结束=>right
        /*
        * 如字符串为：<h3><p><b>a</b></h3>，假设p未闭合，数组则为：array('left'=>array('h3','p','b'), 'right'=>'b','h3');
        * 仅补全 html 标签，<? <% 等其它语言标记，会产生不可预知结果
        */
        for($i = 0; $i < $strlen_var; ++$i) {
            if(!$lenth) break;  // 遍历完之后跳出
            $current_var = substr($str, $i, 1); // 当前字符
            if($current_var == '<'){ // html 代码开始
                $html_tag = 1;
                $html_array_str = '';
            }else if($html_tag == 1){ // 一段 html 代码结束
                if($current_var == '>'){
                    $html_array_str = trim($html_array_str); //去除首尾空格，如 <br / > < img src="" / > 等可能出现首尾空格
                    if(substr($html_array_str, -1) != '/'){ //判断最后一个字符是否为 /，若是，则标签已闭合，不记录
                        // 判断第一个字符是否 /，若是，则放在 right 单元
                        $f = substr($html_array_str, 0, 1);
                        if($f == '/'){
                            $html_array['right'][] = str_replace('/', '', $html_array_str); // 去掉 '/'
                        }else if($f != '?'){ // 若是?，则为 PHP 代码，跳过
                            // 若有半角空格，以空格分割，第一个单元为 html 标签。如：<h2 class="a"> <p class="a">
                            if(strpos($html_array_str, ' ') !== false){
                                // 分割成2个单元，可能有多个空格，如：<h2 class="" id="">
                                $html_array['left'][] = strtolower(current(explode(' ', $html_array_str, 2)));
                            }else{
                                //若没有空格，整个字符串为 html 标签，如：<b> <p> 等，统一转换为小写
                                $html_array['left'][] = strtolower($html_array_str);
                            }
                        }
                    }
                    $html_array_str = ''; // 字符串重置
                    $html_tag = 0;
                }else{
                    $html_array_str .= $current_var; //将< >之间的字符组成一个字符串,用于提取 html 标签
                }
            }else{
                --$lenth; // 非 html 代码才记数
            }
            $ord_var_c = ord($str{$i});
            switch (true) {
                case (($ord_var_c & 0xE0) == 0xC0): // 2 字节
                    $result .= substr($str, $i, 2);
                    $i += 1; break;
                case (($ord_var_c & 0xF0) == 0xE0): // 3 字节
                    $result .= substr($str, $i, 3);
                    $i += 2; break;
                case (($ord_var_c & 0xF8) == 0xF0): // 4 字节
                    $result .= substr($str, $i, 4);
                    $i += 3; break;
                case (($ord_var_c & 0xFC) == 0xF8): // 5 字节
                    $result .= substr($str, $i, 5);
                    $i += 4; break;
                case (($ord_var_c & 0xFE) == 0xFC): // 6 字节
                    $result .= substr($str, $i, 6);
                    $i += 5; break;
                default: // 1 字节
                    $result .= $current_var;
            }
        }
        if($html_array['left']){ //比对左右 html 标签，不足则补全
            $html_array['left'] = array_reverse($html_array['left']); //翻转left数组，补充的顺序应与 html 出现的顺序相反
            foreach($html_array['left'] as $index => $tag){
                $key = array_search($tag, $html_array['right']); // 判断该标签是否出现在 right 中
                if($key !== false){ // 出现，从 right 中删除该单元
                    unset($html_array['right'][$key]);
                }else{ // 没有出现，需要补全
                    $result .= '</'.$tag.'>';
                }
            }
        }
        return $result.$replace;
    }
}



// 对象转换成数组
function object2array($array) {  
    if(is_object($array)) {  
        $array = (array)$array;  
     } if(is_array($array)) {  
         foreach($array as $key=>$value) {  
             $array[$key] = object2array($value);  
             }  
     }  
     return $array;  
}

/**
 *   构建树形结构
 *   @date 2017年2月14日 15:29:26
 *   @param array $list
 *   @param int $parentid
 *   @param int $deep
 *   @param boolean $flag
 *   @return array 
 */
if ( ! function_exists('createTree'))
{
    function createTree($list, $flag = TRUE, $parentid = 0, $deep = 0)
    {

        static $tree;

        foreach($list as $rows)
        {
            if ($rows['pid'] == $parentid){
                $rows['deep'] = $deep;

                $rows['cat_name'] = ($flag && $rows['deep'] > 0) ? 
                str_repeat('&nbsp;', $deep * 4).'|- '.$rows['cat_name'] :
                $rows['cat_name'];

                $tree[] = $rows;
                createTree($list, $flag, $rows['id'], $deep + 1);
            }
        }

        return $tree;
    }
}