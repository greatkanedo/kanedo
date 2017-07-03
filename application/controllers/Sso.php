<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 单点登录控制器类
 *
 */
class Sso extends CI_Controller {
        
    /**
     * session存储位置
     * 
     * @var string
     */
    public $links_path;
        
    /**
     * 标识sessioin是否开启
     * @var boolean
     */
    protected $started = false;        
        
    /**
     * 当前应用
     * @var string
     */
    protected $broker = null;
        
    /**
     * 当前用户
     */        
     
    protected $user = null;

    /**
     * 构造函数
     */
    public function __construct()
    {
        parent::__construct();
                        
        $this->load->model('broker_model');
        
        $this->load->model('user_model');
        
        //如果创建连接函数没有开启，$link_path系统默认存储session目录
        //if (!function_exists('symlink')) $this->links_path = sys_get_temp_dir();
        $this->links_path = sys_get_temp_dir();
    
    }
        
    public function index()
    {
        exit('1');
    }

        
    /**
     * 登录
     */

    public function login()
    {

        $this->_session_start();
                
        $username = $this->input->post('username');
                
        $password = $this->input->post('password');
                
        if (empty($username)) $this->failLogin("no_user_name");
                
        if (empty($password)) $this->failLogin("no_password");

        //数据库验证
        
        $info = $this->user_model->_web_login($this->input->post('username'),$this->input->post('password'));
                
        if (isset($info['user'])&&$info['user']!='')
        {
            $_SESSION['user'] = $info['user'];
                
            $this->info();
                
        }else{
                
            $this->failLogin($info['error']);
        }
                
    }
        
        
    /**
     * PC登录
     */

    public function pc_login()
    {

        $this->_session_start();
                
        $cihiuserno = $this->input->post('cihiuserno');
                
        $cihikey = $this->input->post('cihikey');
                
        if (empty($cihiuserno)) $this->failLogin("no_cihiuserno");
                
        if (empty($cihikey)) $this->failLogin("no_cihikey");

        //数据库验证
        
        $info = $this->user_model->_pc_login($this->input->post('cihiuserno'),$this->input->post('cihikey'));
                
                
        if (isset($info['user'])&&$info['user']!='')
        {
            $_SESSION['user'] = $info['user'];
            $this->info();
                
        }else{
                
            $this->failLogin($info['error']);
        }

    }                
        
    /**
     * 退出
     */
    public function logout()
    {
        header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
                
        $this->load->model('broker_model');
                
        $brokers = $this->broker_model->get_all_broker();

        $res='';
        foreach ($brokers as $k=>$v)
        {
            if (trim($v['api_url'])!=''){
                $tmp_s = strstr($v['api_url'], '?') ? '&' : '?';
                $res .= '<script type="text/javascript" src="'.$v['api_url'].$tmp_s.'&time='.time().' reload="1"></script>';                                
            }
        }
                
               
       $this->_session_start();
       unset($_SESSION['user']);
           echo $res;

    }
        
        
    /**
     * 输出用户信息
     */
    public function info()
    {
        $this->_session_start();
                //如果不存在登陆用户 返回提示
        if (!isset($_SESSION['user'])) $this->failLogin("Not logged in");
                
        echo json_encode($_SESSION['user']);exit();

    }        
        
        
    /**
     * 连接session
     */
    public function attach()
    {
            //开启回话
        $this->_session_start();

        //检验broker
        $broker = $this->input->get_post('broker');
        if (empty($broker)) $this->fail("No broker specified");

        //检验token
        $token = $this->input->get_post('token');
        if (empty($token)) $this->fail("No token specified");

        //检验校验码
        $checksum = $this->input->get_post('checksum');
        if (empty($checksum) || $this->generateAttachChecksum($broker, $token) != $checksum) $this->fail("Invalid_checksum");

        //如果没有设置session存储位置
        if (!isset($this->links_path)) {
                
            //拼接session存储文件  
            $link = (session_save_path() ? session_save_path() : sys_get_temp_dir()) . "/sess_" . $this->generateSessionId($broker, $token);
                        //如果sessioin文件不存在 把本文件链接到系统的session_id上
            if (!file_exists($link)) $attached = symlink('sess_' . session_id(), $link);
                        //如果没有链接成功，报错
            if (!$attached) trigger_error("Failed to attach; Symlink wasn't created.", E_USER_ERROR);
        } else {
            //指定session路径存放session
            $link = "{$this->links_path}/" . $this->generateSessionId($broker, $token);
            if (!file_exists($link)) $attached = file_put_contents($link, session_id());
            if (!$attached) trigger_error("Failed to attach; Link file wasn't created.", E_USER_ERROR);
            }
            //跳转至broker
            $redirect = $this->input->get_post('redirect');
        if (isset($redirect)) {
            header("Location: " . $redirect, true, 307);
            exit;        
        }

        // 输出图片用于ajax登录
        header("Content-Type: image/png");
        readfile("empty.png");
    }        
                
        /*
         * 开启session并且防止session劫持
     */

    protected function _session_start()
    {
        //如果session已经开水器  false
            
       if ($this->started) return;
        $this->started = true;
        // 应用session
        $matches = null;
                
        $cookie = $this->input->cookie(session_name());
                
        //如果通过request方式获取到PHPSSID 并且匹配本规则
        if (isset($cookie) && preg_match('/^SSO-(\w*+)-(\w*+)-([a-z0-9]*+)$/', $cookie, $matches)) {
                
            $sid = $cookie;
                        
            if (isset($this->links_path) && file_exists("{$this->links_path}/$sid")) {
                    session_id(file_get_contents("{$this->links_path}/$sid"));
                    session_start();
                    setcookie(session_name(), "", 1);
                }else{
                    session_start();
                }

            if (!isset($_SESSION['client_addr'])) {
                session_destroy();
                $this->fail("Not attached");
            }

            if ($this->generateSessionId($matches[1], $matches[2], $_SESSION['client_addr']) != $sid) {
                session_destroy();
                $this->fail("Invalid session id");
            }

            $this->broker = $matches[1];
            return;
        }

        // 开启用户会话
        session_start();
                //如果存在客户端IP并且客户端IP和服务端不一致，更新SESSIONID
        if (isset($_SESSION['client_addr']) && $_SESSION['client_addr'] != $_SERVER['REMOTE_ADDR']) session_regenerate_id(true);
                //如果存在客户端IP并且一致，客户端IP设置为服务端IP
        if (!isset($_SESSION['client_addr'])) $_SESSION['client_addr'] = $_SERVER['REMOTE_ADDR'];
    }        

    /**
         * 通过session token生成session id
     * 
     * @return string
     */
    protected function generateSessionId($broker, $token, $client_addr=null)
    {
                //验证broker
                $info = $this->broker_model->get_broker_by_broker($broker);        
                if ($info) {
                        $secret = $info['secret'];
                }else{
                        return null;
                }
                //如果客户端地址没有设置，获取客户端IP
        if (!isset($client_addr)) $client_addr = $_SERVER['REMOTE_ADDR'];
                //根据 参数生出客户端session文件名称
        return "SSO-{$broker}-{$token}-" . md5('session' . $token . $client_addr . $secret);
    }
        
    /**
         * 通过session token生成session id
     * 
     * @return string
     */
    protected function generateAttachChecksum($broker, $token)
    {
            
                //验证broker
                $info = $this->broker_model->get_broker_by_broker($broker);        
                if ($info) {
                        $secret = $info['secret'];
                }else{
                        return null;
                }
                
        return md5('attach' . $token . $_SERVER['REMOTE_ADDR'] . $secret);
    }
        
    /**
     * 错误
     *
     * @param string $message
     */
    protected function fail($message)
    {
        header("HTTP/1.1 406 Not Acceptable");
        echo $message;
        exit;
    }
        
    /**
     * 登录失败
     *
     * @param string $message
     */
    protected function failLogin($message)
    {
        header("HTTP/1.1 401 Unauthorized");
        echo $message;
        exit;
    }
        
}

/* End of file sso.php */
/* Location: ./application/controllers/sso.php */


代理端：

<?php
/**
* 单点登录服务
*/
class Sso
{
        /**
         * 取消服务端 HTTP401
         */
        public $pass401=false;

    /**
     * SSO服务地址
     * @var string
     */
    public $url = "http://sso.lab.mycihi.cn/sso/";

    /**
     * 代理ID
     * @var string
     */
    public $broker = "cihi";

    /**
     * 秘药
     * @var string
     */
    public $secret = "1A9624F80F6FCE52325B74255ABE7A94";

    /**
     * 不能比服务端设置的小
     * @var string
     */
    public $sessionExpire = 1800;

    /**
     * SESSION hash
     * @var string
     */
    protected $sessionToken;

    /**
     * 用户信息
     * @var array
     */
    protected $userinfo;
        
        
        /**
         * 错误信息
         * 
         * 1. no_username 缺少用户名
         * 2. no_password 缺少密码
         * 3. user_not_exists 用户不存在
         * 4. bad_password 密码错误
         * 4. unknown  未知
         * 
         */
        public  $error;


    /**
     * 构造函数
     */
    public function __construct($auto_attach=true)
    {
            $this->test_connectiong();
            //如果cookie存在session_token 
        if (isset($_COOKIE['session_token'])) $this->sessionToken = $_COOKIE['session_token'];
        //如果设置自动粘贴token并且不存在sessiontoken,带上参数跳转的服务端
        if ($auto_attach && !isset($this->sessionToken)) {
                //跳转至SSO
            header("Location: " . $this->getAttachUrl() . "&redirect=". urlencode("http://{$_SERVER["SERVER_NAME"]}{$_SERVER["REQUEST_URI"]}"), true, 307);
            exit;
        }
    }

        //测试通讯

        public function test_connectiong ()
        {
                if(isset($_GET['testsso'])&&$_GET['testsso']==1){
                        echo "connected";
                }
        }

    /**
     * 获取客户端的session_token
     * 
     * @return string
     */
    public function getSessionToken()
    {
            //如果没有生成过session_token 生成session_token
        if (!isset($this->sessionToken)) {
                //随机申城session_token
            $this->sessionToken = md5(uniqid(rand(), true));
                        //吧session_token写入cookie
            setcookie('session_token', $this->sessionToken, time() + $this->sessionExpire);
        }

        return $this->sessionToken;
    }

    /**
     * 生成session id
     * 
     * @return string
     */
    protected function getSessionId()
    {
                if (!isset($this->sessionToken)) return null;
        return "SSO-{$this->broker}-{$this->sessionToken}-" . md5('session' . $this->sessionToken . $_SERVER['REMOTE_ADDR'] . $this->secret);
    }

    /**
         * 获取URL并传递session到sso服务器
     *
     * @return string
     */
    public function getAttachUrl() 
    {
                $token = $this->getSessionToken();
                //根据token和IP和代理端秘药生成校验码传递给服务端
                $checksum = md5("attach{$token}{$_SERVER['REMOTE_ADDR']}{$this->secret}");
                //拼接URL 传递 sessioin_token和校验码到服务端
        return "{$this->url}attach?broker={$this->broker}&token=$token&checksum=$checksum";
    }    


    /**
     * WEB登录
     * 
     * @param string $username
     * @param string $password
     * @return boolean
         * 
     */
    public function login($username, $password)
    {   
        list($ret, $body) = $this->serverCmd('login', array('username'=>$username, 'password'=>$password));

        switch ($ret) {
                
            case 200: $this->parseInfo($body);
                      return 1;
            case 401: $this->error= $body;
                                          return 0;
            default:  $this->error= $body;
                                          return 0;

        }
    }
        
    /**
     * PC登录
     * 
     * @param string $username
     * @param string $password
     * @return boolean
         * 
     */
    public function pc_login($cihiuserno, $cihikey)
    {   
        list($ret, $body) = $this->serverCmd('pc_login', array('cihiuserno'=>$cihiuserno, 'cihikey'=>$cihikey));

        switch ($ret) {
                
            case 200: $this->parseInfo($body);
                      return 1;
            case 401: $this->error= $body;
                                          return 0;
            default:  $this->error= $body;
                                          return 0;

        }
    }

        
                        

    /**
     * 退出单点登录
     */
    public function logout()
    {
                if(isset($_GET['testsso'])&&$_GET['testsso']==1){
                        echo "connected";exit();
                }
            //header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
                
        list($ret, $body) = $this->serverCmd('logout');

                echo $body;

                setcookie('session_token', '');
                
                
                
                


    }



    /**
     * 获取SSO当前登陆用户信息
     */
    public function getInfo()
    {
        if (!isset($this->userinfo)) {
                
            list($ret, $body) = $this->serverCmd('info');
            switch ($ret) {
                     case 200: 
                              return $this->parseInfo($body);
                     case 401: $this->error= $body;
                                                  return 0;
                     default:  $this->error= $body;
                                                  return 0;
            }
        }

        return $this->userinfo;
    }

    /**
     * 执行CURL请求
     *
     * @param string $cmd   Command
     * @param array  $vars  Post variables
     * @return array
         * 
     */
    protected function serverCmd($cmd, $vars = array())
    {
            
        $curl = curl_init($this->url . '/' . urlencode($cmd));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_COOKIE, "PHPSESSID=" . $this->getSessionId());
        
        if (!empty($vars)) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $vars);
       }

                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $body = curl_exec($curl);

                
        $ret = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        if (curl_errno($curl) != 0) throw new Exception("SSO failure: HTTP request to server failed. " . curl_error($curl));

        return array($ret, $body);
    }
        

    /**
     * 解析返回用户信息数据
     *
     * @param string $json
     */
    protected function parseInfo($json)
    {
        $josn = json_decode($json);
        return $this->userinfo = (array)$josn;
    }
        
    /**
     * 获取错误信息
     */
    
    public function get_error()
    {
        return $this->error;
    }        
}
