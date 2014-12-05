<?php
/*
Plugin Name: 微信机器人
Plugin URI: http://blog.wpjam.com/project/weixin-robot-advanced/
Description: 微信机器人的主要功能就是能够将你的公众账号和你的 WordPress 博客联系起来，搜索和用户发送信息匹配的日志，并自动回复用户，让你使用微信进行营销事半功倍。
Version: 4.2.4
Author: Denis
Author URI: http://blog.wpjam.com/
*/

define('WEIXIN_ROBOT_PLUGIN_URL', plugins_url('', __FILE__));
define('WEIXIN_ROBOT_PLUGIN_DIR', WP_PLUGIN_DIR.'/'. dirname(plugin_basename(__FILE__)));
define('WEIXIN_ROBOT_PLUGIN_FILE',  __FILE__);

if(!function_exists('wpjam_net_check_domain')){
	include(WEIXIN_ROBOT_PLUGIN_DIR.'/include/wpjam-net-api.php');		// WPJAM 应用商城接口
}

if(!function_exists('wpjam_option_page')){
	include(WEIXIN_ROBOT_PLUGIN_DIR.'/include/wpjam-setting-api.php');	// 后台设置接口
}

include(WEIXIN_ROBOT_PLUGIN_DIR.'/include/deprecated.php');				// 舍弃的函数
include(WEIXIN_ROBOT_PLUGIN_DIR.'/weixin-robot-class.php');				// 微信类库
include(WEIXIN_ROBOT_PLUGIN_DIR.'/weixin-robot-functions.php');			// 函数
include(WEIXIN_ROBOT_PLUGIN_DIR.'/weixin-robot-hook.php');				// 自定义接口
include(WEIXIN_ROBOT_PLUGIN_DIR.'/weixin-robot-user.php');				// 微信用户系统

if(weixin_robot_get_setting('weixin_credit')){
	include(WEIXIN_ROBOT_PLUGIN_DIR.'/weixin-robot-credit.php');		// 微信积分系统
}

if(is_admin()){
	include(WEIXIN_ROBOT_PLUGIN_DIR.'/weixin-robot-options.php');		// 后台选项
	include(WEIXIN_ROBOT_PLUGIN_DIR.'/weixin-robot-custom-reply.php');	// 自定义回复
	include(WEIXIN_ROBOT_PLUGIN_DIR.'/weixin-robot-custom-menu.php');	// 自定义菜单
	
	if(weixin_robot_get_setting('weixin_disable_stats') == false) {
		include(WEIXIN_ROBOT_PLUGIN_DIR.'/weixin-robot-stats.php');		// 数据统计分析
	}

	if(weixin_robot_get_setting('weixin_advanced_api')) {
		include(WEIXIN_ROBOT_PLUGIN_DIR.'/weixin-robot-qrcode.php');	// 带参数二维码
	}
}

$weixin_extend_dir = WEIXIN_ROBOT_PLUGIN_DIR.'/extends';
if (is_dir($weixin_extend_dir)) {
	if ($weixin_extend_handle = opendir($weixin_extend_dir)) {   
		while (($weixin_extend_file = readdir($weixin_extend_handle)) !== false) {
			if ($weixin_extend_file!="." && $weixin_extend_file!=".." && is_file($weixin_extend_dir.'/'.$weixin_extend_file)) {
				if(pathinfo($weixin_extend_file, PATHINFO_EXTENSION) == 'php'){
					include($weixin_extend_dir.'/'.$weixin_extend_file);
				}
			}
		}   
		closedir($weixin_extend_handle);   
	}   
}

add_action('init', 'weixin_robot_init', 11);
function weixin_robot_init($wp){
	
	// 定义数据库表名
	global $wpdb;
	$wpdb->weixin_messages			= $wpdb->prefix.'weixin_messages';
	if(isset($_GET['yixin'])){
		$wpdb->weixin_messages		= $wpdb->prefix.'yixin_messages';
	}
	
	$wpdb->weixin_custom_replies	= $wpdb->prefix . 'weixin_custom_replies';
	$wpdb->weixin_qrcodes			= $wpdb->prefix . 'weixin_qrcodes';
	
	$wpdb->weixin_users				= $wpdb->prefix . 'weixin_users';
	$wpdb->weixin_credits			= $wpdb->prefix . 'weixin_credits';
	$wpdb->weixin_checkin			= $wpdb->prefix . 'weixin_checkin';
	
	$wpdb->weixin_redeems			= $wpdb->prefix . 'weixin_redeems';
	$wpdb->weixin_redeem_codes		= $wpdb->prefix . 'weixin_redeem_codes';

	$wpdb->weixin_postviews			= $wpdb->prefix . 'weixin_postviews';

	// 被动响应微信用户消息
	if(isset($_GET['weixin']) || isset($_GET['yixin']) || isset($_GET['signature'])){ 
		global $wechatObj;
		if(!isset($wechatObj)){
			$wechatObj = new wechatCallback();
			$wechatObj->valid();
			exit;
		}
	}

	// OAuth 2.0 
	if(weixin_robot_get_setting('weixin_advanced_api') && isset($_GET['weixin_oauth'])){
		if(isset($_GET['get_userinfo'])){		// 发起获取用户信息的 OAuth 请求
			wp_redirect(weixin_robot_get_oauth_redirect());
			exit;
		}elseif(isset($_GET['get_openid'])){	// 发起获取 weixin_openid 的 OAuth 请求
			wp_redirect(weixin_robot_get_oauth_redirect($scope='snsapi_base'));
			exit;
		}elseif(isset($_GET['code']) && isset($_GET['state'])){	// 微信 OAuth 请求
			if($_GET['state']=='openid'){	// 仅仅获取 weixin_openid
				$access_token 	= weixin_robot_get_oauth_access_token($_GET['code']);
				if($access_token && isset($access_token->openid)){
					$query_id 		= weixin_robot_get_user_query_id($access_token->openid);
					weixin_robot_set_query_cookie($query_id);
				}
			}elseif($_GET['state']=='userinfo'){	// 获取用户详细信息
				weixin_robot_oauth_update_user($_GET['code']);
			}else{
				if($_GET['code']=='authdeny'){	// 用户取消授权。
					//echo 'User Deny';
				}
			}
		}
	}

	// 将用户的 query_id 保存到 cookie 里面
	$query_key = weixin_robot_get_user_query_key();
	if(!empty($_GET[$query_key])){
		weixin_robot_set_query_cookie($_GET[$query_key]);
	}

	// 微信用户中心
	if(isset($_GET['weixin_user'])){
			
		if(isset($_GET['profile'])){
			if(file_exists(TEMPLATEPATH.'/weixin/weixin-user-profile.php')){
				include(TEMPLATEPATH.'/weixin/weixin-user-profile.php');
			}else{
				include(WEIXIN_ROBOT_PLUGIN_DIR.'/template/weixin-user-profile.php');
			}
	        exit;
		}

	}
}