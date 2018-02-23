<?php
if (! defined ( 'ABSPATH' ))
	exit (); // Exit if accessed directly

/**
 * 微信接口
 *
 * @since 1.0.0
 * @author ranj
 */
class XH_Social_Channel_Facebook extends Abstract_XH_Social_Settings_Channel{    
    /**
     * Instance
     * @var XH_Social_Channel_Facebook
     * @since  1.0.0
     */
    private static $_instance;

    /**
     * @return XH_Social_Channel_Facebook
     * @since  1.0.0
     */
    public static function instance() {
        if ( is_null( self::$_instance ) )
            self::$_instance = new self();
            return self::$_instance;
    }
    
    /**
     * 初始化接口ID，标题等信息
     * 
     * @since 1.0.0
     */
    protected function __construct(){
        $this->id='social_facebook';
        
        $this->icon =XH_SOCIAL_URL.'/assets/image/facebook-icon.png';
        $this->title =__('Facebook', XH_SOCIAL);
        $this->description=__('登陆facebook开发者平台 (https://developers.facebook.com/)， 注册facebook开发者账号。',XH_SOCIAL);
        $this->init_form_fields(); 
        
        $this->supports=array('login');
        $this->enabled ='yes'== $this->get_option('enabled');
    }
  
    
    /**
     * 初始化设置项
     *
     * {@inheritDoc}
     * @see Abstract_XH_Social_Settings::init_form_fields()
     * @since 1.0.0
     */
    public function init_form_fields(){
        $fields =array(
            'enabled' => array (
                'title' => __ ( 'Enable/Disable', XH_SOCIAL ),
                'type' => 'checkbox',
                'label' => __ ( 'Enable Facebook connect', XH_SOCIAL ),
                'default' => 'yes'
            ),
            'appid'=>array(
                'title' => __ ( 'App ID', XH_SOCIAL ),
                'type' => 'textbox',
                'description'=>sprintf(__('Facebook互联中，请设置网站回调域为:%s',XH_SOCIAL),admin_url('admin-ajax.php'))
            ),
            'appsecret'=>array(
                'title' => __ ( 'APP Key', XH_SOCIAL ),
                'type' => 'textbox'
            )
        );
           
        $this->form_fields=apply_filters('xh_social_channel_facebook_form_fields', $fields,$this);
    }
    
    /**
     * {@inheritDoc}
     * @see Abstract_XH_Social_Settings_Channel::update_wp_user_info($ext_user_id,$wp_user_id=null)
     */
    public function update_wp_user_info($ext_user_id,$wp_user_id=null){
        $ext_user_info = $this->get_ext_user_info($ext_user_id);
        if(!$ext_user_info){
            return XH_Social_Error::error_unknow();
        }
        
        global $wpdb;
        if(!$wp_user_id){
            $wp_user=null;
            if(!empty($ext_user_info['user_email'])){
                $wp_user = get_user_by('email', $ext_user_info['user_email']);
            }
            
            if(!$wp_user){
                $user_login = XH_Social::instance()->WP->generate_user_login($ext_user_info['nickname']);
                $userdata=array(
                    'user_login'=>$user_login,
                    'user_nicename'=>$ext_user_info['nicename'],
                    'first_name'=>$ext_user_info['first_name'],
                    'last_name'=>$ext_user_info['last_name'],
                    
                    'user_email'=>$ext_user_info['user_email'],
                    'display_name'=>$ext_user_info['nickname'],
                    'nickname'=>$ext_user_info['nickname'],
                    'user_pass'=>str_shuffle(time())
                );
                
                $wp_user_id = $this->wp_insert_user_Info($ext_user_id, $userdata);
                if($wp_user_id instanceof XH_Social_Error){
                    return $wp_user_id;
                }
            }
        }
        
        if($wp_user_id!=$ext_user_info['wp_user_id']){
            //若当前用户已绑定过其他微信号？那么解绑
            $wpdb->query(
            "delete from  {$wpdb->prefix}xh_social_channel_facebook
             where user_id=$wp_user_id and id<>$ext_user_id; ");
            if(!empty($wpdb->last_error)){
                XH_Social_Log::error($wpdb->last_error);
                return XH_Social_Error::err_code(500);
            }
            
            $result =$wpdb->query(
                         "update {$wpdb->prefix}xh_social_channel_facebook
                          set user_id=$wp_user_id
                          where id=$ext_user_id;");
            if(!$result||!empty($wpdb->last_error)){
                XH_Social_Log::error("update xh_social_channel_facebook failed.detail error:".$wpdb->last_error);
                return XH_Social_Error::err_code(500);
            }
        }
        
        $ext_user_info['wp_user_id']=$wp_user_id;
        
        do_action('xh_social_channel_update_wp_user_info',$ext_user_info);
        do_action('xh_social_channel_facebook_update_wp_user_info',$ext_user_info);
        update_user_meta($wp_user_id, '_social_img', $ext_user_info['user_img']);
        return $this->get_wp_user_info($ext_user_id);
    }
    
    /**
     * {@inheritDoc}
     * @see Abstract_XH_Social_Settings_Channel::get_wp_user_info($ext_user_id)
     */
    public function get_wp_user_info($ext_user_id){
        $ext_user_id = intval($ext_user_id);
        global $wpdb;
        $user = $wpdb->get_row(
           "select w.user_id
            from {$wpdb->prefix}xh_social_channel_facebook w
            where w.id=$ext_user_id
            limit 1;");
        if(!$user||!$user->user_id) {
            return null;
        }
        
        return get_userdata($user->user_id);
    }
    /**
     * {@inheritDoc}
     * @see Abstract_XH_Social_Settings_Channel::get_ext_user_info_by_wp($wp_user_id)
     */
    public function get_ext_user_info_by_wp($wp_user_id){
        $wp_user_id = intval($wp_user_id);
        
        global $wpdb;
        $user = $wpdb->get_row(
            "select w.*
            from {$wpdb->prefix}xh_social_channel_facebook w
            where w.user_id=$wp_user_id
            limit 1;");
        
        if(!$user) {
            return null;
        }
        $guid = XH_Social_Helper_String::guid();
        return array(
            'nickname'=>$user->nickname,
            'first_name'=>$user->first_name,
            'middle_name'=>$user->middle_name,
            'last_name'=>$user->last_name,
        
            'user_login'=>null,
            'user_email'=>$user->email,
            'user_img'=>$user->img,
            'wp_user_id'=>$user->user_id,
            'ext_user_id'=>$user->id,
            'nicename'=>$guid,
            'uid'=>$user->fid
        );
    }
  
    /**
     * {@inheritDoc}
     * @see Abstract_XH_Social_Settings_Channel::remove_ext_user_info_by_wp($wp_user_id)
     */
    public function remove_ext_user_info_by_wp($wp_user_id){
        global $wpdb;
        $wpdb->query("delete from {$wpdb->prefix}xh_social_channel_facebook where user_id={$wp_user_id};");
        if(!empty($wpdb->last_error)){
            return XH_Social_Error::error_custom($wpdb->last_error);
        }
        
        return XH_Social_Error::success();
    }
    
    /**
     * {@inheritDoc}
     * @see Abstract_XH_Social_Settings_Channel::get_ext_user_info($ext_user_id)
     */
    public function get_ext_user_info($ext_user_id){
        $ext_user_id = intval($ext_user_id);
        global $wpdb;
        $user = $wpdb->get_row(
                    "select w.*
                     from {$wpdb->prefix}xh_social_channel_facebook w
                     where w.id=$ext_user_id
                     limit 1;");
        if(!$user) {
            return null;
        }    
       
        $guid = XH_Social_Helper_String::guid();
        return  array(
            'nickname'=>$user->nickname,
            'first_name'=>$user->first_name,
            'middle_name'=>$user->middle_name,
            'last_name'=>$user->last_name,
        
            'user_login'=>null,
            'user_email'=>$user->email,
            'user_img'=>$user->img,
            'wp_user_id'=>$user->user_id,
            'ext_user_id'=>$user->id,
            'nicename'=>$guid,
            'uid'=>$user->fid
        );
    }
    
    public function process_authorization_callback($wp_user_id){
        $login_location_uri=XH_Social::instance()->session->get('social_login_location_uri');  
        if(empty($login_location_uri)){
            $login_location_uri = home_url('/');
        }
        
        $userdata=array();
        
        if(isset($_POST['user_hash'])){
            $userdata = isset($_POST['userdata'])? base64_decode($_POST['userdata']):null;
            $user_hash = $_POST['user_hash'];
            $userdata =$userdata?json_decode($userdata,true):null;
            if(!$userdata){
                return $login_location_uri;
            }
            
            $ohash =XH_Social_Helper::generate_hash($userdata, $this->get_option('appsecret'));
            if($user_hash!=$ohash){
                XH_Social_Log::error(__('Please check cross-domain app secret config(equal to current website app secret)!',XH_SOCIAL));
                return $login_location_uri;
            }
            
            $userdata['last_update']=date_i18n('Y-m-d H:i');
        }else{
            $code = isset($_GET['code'])?$_GET['code']:null;
            if(empty($code)){
                return $login_location_uri;
            }
            
            try {
                //获取accesstoken
                $userdata = $this->get_facebook_user_by_code($code,$this->get_option("appid"),$this->get_option("appsecret"));
            } catch (Exception $e) {
                XH_Social_Log::error($e);
                $err_times = isset($_GET['err_times'])?intval($_GET['err_times']):3;
                 
                if($err_times>0){
                    $err_times--;
                    return $this->_login_get_authorization_uri($wp_user_id, $err_times);
                }
                
                XH_Social::instance()->WP->set_wp_error($login_location_uri, $e->getMessage());
                return $login_location_uri;
            }
        }
        
        if(!$userdata||empty($userdata)){
           return $login_location_uri;
        }
        
        //获取到用户信息，存储且跳转
        global $wpdb;
        $ext_user_id = 0;
        $wpdb->last_error='';
        
        try {
            $ext_user_info = $wpdb->get_row(
            $wpdb->prepare(
               "select id,
                        user_id
                from {$wpdb->prefix}xh_social_channel_facebook
                where fid=%s
                limit 1;", $userdata['fid']));
        
            if($wp_user_id
                &&$wp_user_id>0
                &&$ext_user_info
                &&$ext_user_info->user_id
                &&$ext_user_info->user_id!=$wp_user_id){
                    $wp_user = get_userdata($ext_user_info->user_id);
                    if($wp_user){
                        throw new Exception(sprintf(__("对不起，您的Facebook已与账户(%s)绑定，请解绑后重试！",XH_SOCIAL),$wp_user->nickname));
                    }
            }
            
            if($wp_user_id>0
                &&(!$ext_user_info||$ext_user_info->user_id<>$wp_user_id)){
                
                $wpdb->query("delete from {$wpdb->prefix}xh_social_channel_facebook where user_id=$wp_user_id ;");
                if(!empty($wpdb->last_error)){
                    XH_Social_Log::error($wpdb->last_error);
                    throw new Exception(__($wpdb->last_error,XH_SOCIAL));
                }
            }
            
            if(!$ext_user_info){
                if($wp_user_id>0){
                    $userdata['user_id']=$wp_user_id;
                }
                $wpdb->insert("{$wpdb->prefix}xh_social_channel_facebook", $userdata);
                if(!empty($wpdb->last_error)){
                    throw new Exception($wpdb->last_error);
                }
        
                if($wpdb->insert_id<=0){
                    XH_Social_Log::error('insert facebook user info failed');
                    throw new Exception('insert facebook user info failed');
                }
        
                $ext_user_id=$wpdb->insert_id;
            } else{
                //user_id
                if($wp_user_id>0){
                    $userdata['user_id'] =$wp_user_id;
                }
                
                $wpdb->update("{$wpdb->prefix}xh_social_channel_facebook", $userdata,
                array(
                    'id'=>$ext_user_info->id
                ));
        
                if(!empty($wpdb->last_error)){
                    XH_Social_Log::error($wpdb->last_error);
                    throw new Exception($wpdb->last_error);
                }
        
                $ext_user_id=$ext_user_info->id;
            }
        
             return $this->process_login($ext_user_id);
        } catch (Exception $e) {
            XH_Social_Log::error($e);
            XH_Social::instance()->WP->set_wp_error($login_location_uri, $e->getMessage());
            return $login_location_uri;
        }
    }
    
    public function get_facebook_user_by_code($code,$appid,$appsecret){
        $params=array();
        $redirect_uri = XH_Social_Helper_Uri::get_uri_without_params(XH_Social_Helper_Uri::get_location_uri(),$params);
        if(isset($params['code'])) unset($params['code']);
        if(isset($params['state'])) unset($params['state']);
        $redirect_uri.="?".http_build_query($params);
        
        $request=array(
            'code'=>$code,
            'client_id'=>$appid,
            'client_secret'=>$appsecret,
            'redirect_uri'=>$redirect_uri
        );
        
        $content = XH_Social_Helper_Http::http_get('https://graph.facebook.com/oauth/access_token?'.http_build_query($request));
        $response = $content?json_decode($content,true):null;
        if(!$response){
            throw new Exception('Facebook SDK returned an error: ' . $content);
        }
    
        if(isset($response['error'])){
            $error = $response['error'];
            $error_code = isset($response['error_code'])?$response['error_code']:null;
            $error_reason = isset($response['error_reason'])?$response['error_reason']:null;
            $error_description = isset($response['error_description'])?$response['error_description']:null;
            
            throw new Exception("Error: {$error};Error Code:{$error_code},Error Reason:{$error_reason};Error Description: {$error_description}");
        }
        
        $access_token = $response['access_token'];
        $content = XH_Social_Helper_Http::http_get("https://graph.facebook.com/me?access_token={$access_token}");
        $userdata = $content?json_decode($content,true):null;
        if(!$userdata){
            throw new Exception('Facebook SDK returned an error: ' . $content);
        }
        
        if(isset($userdata['error'])){
            $error = $userdata['error'];
            $error_code = isset($userdata['error_code'])?$userdata['error_code']:null;
            $error_reason = isset($userdata['error_reason'])?$userdata['error_reason']:null;
            $error_description = isset($userdata['error_description'])?$userdata['error_description']:null;
        
            throw new Exception("Error: {$error};Error Code:{$error_code},Error Reason:{$error_reason};Error Description: {$error_description}");
        }

        return array(
            'fid'=>$userdata['id'],
            
            'nickname'=>isset($userdata['name'])?XH_Social_Helper_String::remove_emoji($userdata['name']):null,
            'first_name'=>isset($userdata['first_name'])?XH_Social_Helper_String::remove_emoji($userdata['first_name']):null,
            'last_name'=>isset($userdata['last_name'])?XH_Social_Helper_String::remove_emoji($userdata['last_name']):null,
            'middle_name'=>isset($userdata['middle_name'])?XH_Social_Helper_String::remove_emoji($userdata['middle_name']):null,
            
            'link'=>isset($userdata['link'])?$userdata['link']:null,
            'gender'=>isset($userdata['gender'])?$userdata['gender']:null,
            'email'=>isset($userdata['email'])?$userdata['email']:null,
            'img'=>"//graph.facebook.com/{$userdata['id']}/picture?type=large",
            
            'birthday'=>isset($userdata['birthday'])?$userdata['birthday']:null,
            'hometown'=>isset($userdata['hometown'])?$userdata['hometown']:null,
            'location'=>isset($userdata['location'])?$userdata['location']:null,
            
            'last_update'=>date_i18n('Y-m-d H:i')
        );
    }
    
    public function get_wp_user($field,$field_val){
        if(!in_array($field, array(
            'fid',
            'email'
        ))){
            return null;
        }
    
        global $wpdb;
        $ext_user_info =$wpdb->get_row($wpdb->prepare(
            "select user_id
            from {$wpdb->prefix}xh_social_channel_facebook
            where $field=%s
            limit 1;", $field_val));
        if($ext_user_info&&$ext_user_info->user_id){
            return get_userdata($ext_user_info->user_id);
        }
    
        return null;
    }
    
    public function get_ext_user($field,$field_val){
        if(!in_array($field, array(
            'fid',
            'email'
        ))){
            return null;
        }
    
        global $wpdb;
        return $wpdb->get_row($wpdb->prepare(
            "select *
            from {$wpdb->prefix}xh_social_channel_facebook
            where $field=%s
            limit 1;", $field_val));
    }

    /**
     * {@inheritDoc}
     * @see Abstract_XH_Social_Settings_Channel::generate_authorization_uri()
     */
    public function generate_authorization_uri($user_ID=0,$login_location_uri=null){
       return $this->_login_get_authorization_uri(is_null($user_ID)?0:$user_ID,0);
    }
    
    /**
     * 获取登录授权链接
     * @param string $login_location_uri
     * @param int $error_times
     * @return string
     * @since 1.0.0
     */
    private function _login_get_authorization_uri($user_ID=0,$error_times=null){
        $params=array();
        $api = XH_Social_Add_On_Social_Facebook::instance();
        $url=XH_Social_Helper_Uri::get_uri_without_params(XH_Social::instance()->ajax_url(
            array(
                'tab'=>'authorization',
                'action'=>"xh_social_{$api->id}",
                'uid'=>is_null($user_ID)?0:$user_ID
            ),true,true
            ),$params);
         
        if(!is_null($error_times)){
            $params['err_times']=$error_times;
        }
         
        $redirect_uri= $url."?".http_build_query($params);
        
        return $this->get_facebook_authorize_url($this->get_option('appid'),$redirect_uri);
    }
    
    public function get_facebook_authorize_url($appid,$redirect_uri){
        $request=array(
            'response_type'=>'code',
            'client_id'=>$appid,
            'redirect_uri'=>$redirect_uri,
            'state'=>str_shuffle(time()),
            'display'=>'page',
            'auth_type'=>'reauthenticate'
        );
       
        return 'https://www.facebook.com/dialog/oauth?'.http_build_query($request);
    }
}

require_once XH_SOCIAL_DIR.'/includes/abstracts/abstract-xh-schema.php';
/**
* 微信接口
*
* @since 1.0.0
* @author ranj
*/
class XH_Social_Channel_Facebook_Model extends Abstract_XH_Social_Schema{

    /**
     * {@inheritDoc}
     * @see Abstract_XH_Social_Schema::init()
     */
    public function init(){
        $collate=$this->get_collate();
        global $wpdb;
        $wpdb->query("CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}xh_social_channel_facebook` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `user_id` BIGINT(20) NULL,
            `fid` VARCHAR(64) NULL DEFAULT NULL,
            
            `last_update` DATETIME NOT NULL,
            `first_name` VARCHAR(512) NULL DEFAULT NULL,
            `last_name` VARCHAR(512) NULL DEFAULT NULL,
            `middle_name` VARCHAR(512) NULL DEFAULT NULL,
            `nickname` VARCHAR(512) NULL DEFAULT NULL,
            
            `link` text NULL DEFAULT NULL,
            `gender` VARCHAR(16) NULL DEFAULT NULL,
            `email` VARCHAR(512) NULL DEFAULT NULL,
            `img` TEXT NULL,
            
            `birthday` VARCHAR(64) NULL DEFAULT NULL,
            `hometown` text NULL DEFAULT NULL,
            `location` text NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE INDEX `fid_unique` (`fid`),
            UNIQUE INDEX `user_id_unique` (`user_id`)
        )
        $collate;");
        
        if(!empty($wpdb->last_error)){
            XH_Social_Log::error($wpdb->last_error);
            throw new Exception($wpdb->last_error);
        }
    }
}