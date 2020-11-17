<?php
/* save all option to options table in database using ajax */
/* save settings for section 1 */
add_action('wp_ajax_plus_updateSrcn1', 'sfsi_plus_options_updater1');
function sfsi_plus_options_updater1()
{
	if (!wp_verify_nonce($_POST['nonce'], "update_plus_step1")) {
		echo  json_encode(array("wrong_nonce"));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}
	$option1 =  unserialize(get_option('sfsi_plus_section1_options', false));
	$sfsi_plus_rss_display		= isset($_POST["sfsi_plus_rss_display"]) ? sanitize_text_field($_POST["sfsi_plus_rss_display"]) : 'no';
	$sfsi_plus_email_display    = isset($_POST["sfsi_plus_email_display"]) ? sanitize_text_field($_POST["sfsi_plus_email_display"]) : 'no';
	$sfsi_plus_facebook_display = isset($_POST["sfsi_plus_facebook_display"]) ? sanitize_text_field($_POST["sfsi_plus_facebook_display"]) : 'no';
	$sfsi_plus_twitter_display  = isset($_POST["sfsi_plus_twitter_display"]) ? sanitize_text_field($_POST["sfsi_plus_twitter_display"]) : 'no';
	$sfsi_plus_youtube_display  = isset($_POST["sfsi_plus_youtube_display"]) ? sanitize_text_field($_POST["sfsi_plus_youtube_display"]) : 'no';
	$sfsi_plus_pinterest_display = isset($_POST["sfsi_plus_pinterest_display"]) ? sanitize_text_field($_POST["sfsi_plus_pinterest_display"]) : 'no';
	$sfsi_plus_instagram_display = isset($_POST["sfsi_plus_instagram_display"]) ? sanitize_text_field($_POST["sfsi_plus_instagram_display"]) : 'no';
	$sfsi_plus_houzz_display	= isset($_POST["sfsi_plus_houzz_display"]) ? sanitize_text_field($_POST["sfsi_plus_houzz_display"]) : 'no';
	$sfsi_plus_telegram_display = isset($_POST["sfsi_plus_telegram_display"]) ? sanitize_text_field($_POST["sfsi_plus_telegram_display"]) : 'no';
	$sfsi_plus_vk_display = isset($_POST["sfsi_plus_vk_display"]) ? sanitize_text_field($_POST["sfsi_plus_vk_display"]) : 'no';
	$sfsi_plus_ok_display = isset($_POST["sfsi_plus_ok_display"]) ? sanitize_text_field($_POST["sfsi_plus_ok_display"]) : 'no';
	$sfsi_plus_weibo_display = isset($_POST["sfsi_plus_weibo_display"]) ? sanitize_text_field($_POST["sfsi_plus_weibo_display"]) : 'no';
	$sfsi_plus_wechat_display = isset($_POST["sfsi_plus_wechat_display"]) ? sanitize_text_field($_POST["sfsi_plus_wechat_display"]) : 'no';
	$sfsi_plus_houzz_display	= isset($_POST["sfsi_plus_houzz_display"]) ? sanitize_text_field($_POST["sfsi_plus_houzz_display"]) : 'no';
	$sfsi_plus_linkedin_display = isset($_POST["sfsi_plus_linkedin_display"]) ? sanitize_text_field($_POST["sfsi_plus_linkedin_display"]) : 'no';

	$sfsi_custom_icons          = isset($option1['sfsi_custom_files']) ? $option1['sfsi_custom_files'] : '';
	$up_option1 = array(
		'sfsi_plus_rss_display'			=> sanitize_text_field($sfsi_plus_rss_display),
		'sfsi_plus_email_display'		=> sanitize_text_field($sfsi_plus_email_display),
		'sfsi_plus_facebook_display'	=> sanitize_text_field($sfsi_plus_facebook_display),
		'sfsi_plus_twitter_display'		=> sanitize_text_field($sfsi_plus_twitter_display),
		'sfsi_plus_youtube_display'		=> sanitize_text_field($sfsi_plus_youtube_display),
		'sfsi_plus_pinterest_display'	=> sanitize_text_field($sfsi_plus_pinterest_display),
		'sfsi_plus_linkedin_display'	=> sanitize_text_field($sfsi_plus_linkedin_display),
		'sfsi_plus_instagram_display'	=> sanitize_text_field($sfsi_plus_instagram_display),
		'sfsi_plus_ok_display'	        => sanitize_text_field($sfsi_plus_ok_display),
		'sfsi_plus_telegram_display'	=> sanitize_text_field($sfsi_plus_telegram_display),
		'sfsi_plus_vk_display'	        => sanitize_text_field($sfsi_plus_vk_display),
		'sfsi_plus_wechat_display'	    => sanitize_text_field($sfsi_plus_wechat_display),
		'sfsi_plus_weibo_display'	    => sanitize_text_field($sfsi_plus_weibo_display),
		'sfsi_plus_houzz_display'		=> sanitize_text_field($sfsi_plus_houzz_display),
		'sfsi_custom_files'				=> $sfsi_custom_icons
	);

	$c = update_option('sfsi_plus_section1_options',  serialize($up_option1));

	header('Content-Type: application/json');
	echo  json_encode(array("success"));
	exit;
}
/* save settings for section 2 */
add_action('wp_ajax_plus_updateSrcn2', 'sfsi_plus_options_updater2');
function sfsi_plus_options_updater2()
{
	if (!wp_verify_nonce($_POST['nonce'], "update_plus_step2")) {
		echo  json_encode(array("wrong_nonce"));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}
	$sfsi_plus_rss_url				= isset($_POST["sfsi_plus_rss_url"]) ? esc_url(trim($_POST["sfsi_plus_rss_url"])) : '';
	$sfsi_plus_rss_icons        	= isset($_POST["sfsi_plus_rss_icons"]) ? sanitize_text_field($_POST["sfsi_plus_rss_icons"]) : 'email';

	$sfsi_plus_facebookPage_option 	= isset($_POST["sfsi_plus_facebookPage_option"]) ? sanitize_text_field($_POST["sfsi_plus_facebookPage_option"]) : 'no';
	$sfsi_plus_facebookPage_url    	= isset($_POST["sfsi_plus_facebookPage_url"]) ? esc_url(trim($_POST["sfsi_plus_facebookPage_url"])) : '';
	$sfsi_plus_facebookLike_option 	= isset($_POST["sfsi_plus_facebookLike_option"]) ? sanitize_text_field($_POST["sfsi_plus_facebookLike_option"]) : 'no';
	$sfsi_plus_facebookShare_option	= isset($_POST["sfsi_plus_facebookShare_option"]) ? sanitize_text_field($_POST["sfsi_plus_facebookShare_option"]) : 'no';

	$sfsi_plus_twitter_followme    	= isset($_POST["sfsi_plus_twitter_followme"]) ? sanitize_text_field($_POST["sfsi_plus_twitter_followme"]) : 'no';
	$sfsi_plus_twitter_followUserName = isset($_POST["sfsi_plus_twitter_followUserName"]) ? sanitize_text_field(trim($_POST["sfsi_plus_twitter_followUserName"])) : '';
	$sfsi_plus_twitter_aboutPage   	= isset($_POST["sfsi_plus_twitter_aboutPage"]) ? sanitize_text_field($_POST["sfsi_plus_twitter_aboutPage"]) : 'no';
	$sfsi_plus_twitter_page        	= isset($_POST["sfsi_plus_twitter_page"]) ? sanitize_text_field($_POST["sfsi_plus_twitter_page"]) : 'no';
	$sfsi_plus_twitter_pageURL     	= isset($_POST["sfsi_plus_twitter_pageURL"]) ? esc_url(trim($_POST["sfsi_plus_twitter_pageURL"])) : '';
	$sfsi_plus_twitter_aboutPageText = isset($_POST["sfsi_plus_twitter_aboutPageText"]) ? sanitize_text_field($_POST["sfsi_plus_twitter_aboutPageText"]) : 'Hey check out this cool site I found';

	$sfsi_plus_youtube_pageUrl     	= isset($_POST["sfsi_plus_youtube_pageUrl"]) ? esc_url(trim($_POST["sfsi_plus_youtube_pageUrl"])) : '';
	$sfsi_plus_youtube_page        	= isset($_POST["sfsi_plus_youtube_page"]) ? sanitize_text_field($_POST["sfsi_plus_youtube_page"]) : 'no';
	$sfsi_plus_youtube_follow      	= isset($_POST["sfsi_plus_youtube_follow"]) ? sanitize_text_field($_POST["sfsi_plus_youtube_follow"]) : 'no';

	$sfsi_plus_pinterest_page      	= isset($_POST["sfsi_plus_pinterest_page"]) ? sanitize_text_field($_POST["sfsi_plus_pinterest_page"]) : 'no';
	$sfsi_plus_pinterest_pageUrl   	= isset($_POST["sfsi_plus_pinterest_pageUrl"]) ? esc_url(trim($_POST["sfsi_plus_pinterest_pageUrl"])) : '';
	$sfsi_plus_pinterest_pingBlog  	= isset($_POST["sfsi_plus_pinterest_pingBlog"]) ? sanitize_text_field($_POST["sfsi_plus_pinterest_pingBlog"]) : 'no';

	$sfsi_plus_instagram_pageUrl   	= isset($_POST["sfsi_plus_instagram_pageUrl"]) ? esc_url(trim($_POST["sfsi_plus_instagram_pageUrl"])) : '';

	$sfsi_plus_linkedin_page        = isset($_POST["sfsi_plus_linkedin_page"]) ? sanitize_text_field($_POST["sfsi_plus_linkedin_page"]) : 'no';
	$sfsi_plus_linkedin_pageURL     = isset($_POST["sfsi_plus_linkedin_pageURL"]) ? esc_url(trim($_POST["sfsi_plus_linkedin_pageURL"])) : '';
	$sfsi_plus_linkedin_follow      = isset($_POST["sfsi_plus_linkedin_follow"]) ? sanitize_text_field($_POST["sfsi_plus_linkedin_follow"]) : 'no';
	$sfsi_plus_linkedin_SharePage   = isset($_POST["sfsi_plus_linkedin_SharePage"]) ? sanitize_text_field($_POST["sfsi_plus_linkedin_SharePage"]) : 'no';

	$sfsi_plus_linkedin_followCompany		= 	isset($_POST["sfsi_plus_linkedin_followCompany"])
		? intval(
			trim($_POST["sfsi_plus_linkedin_followCompany"])
		) : '';
	$sfsi_plus_linkedin_recommendBusines	= 	isset($_POST["sfsi_plus_linkedin_recommendBusines"])
		? sanitize_text_field(
			$_POST["sfsi_plus_linkedin_recommendBusines"]
		) : 'no';
	$sfsi_plus_linkedin_recommendCompany	= 	isset($_POST["sfsi_plus_linkedin_recommendCompany"])
		? sanitize_text_field(
			trim($_POST["sfsi_plus_linkedin_recommendCompany"])
		) : '';
	$sfsi_plus_linkedin_recommendProductId	= 	isset($_POST["sfsi_plus_linkedin_recommendProductId"])
		? intval(
			trim($_POST["sfsi_plus_linkedin_recommendProductId"])
		) : '';

	$sfsi_plus_youtubeusernameorid 	= isset($_POST["sfsi_plus_youtubeusernameorid"]) ? sanitize_text_field(trim($_POST["sfsi_plus_youtubeusernameorid"])) : '';
	$sfsi_plus_ytube_user      		= isset($_POST["sfsi_plus_ytube_user"]) ? sanitize_text_field($_POST["sfsi_plus_ytube_user"]) : '';
	$sfsi_plus_ytube_chnlid    		= isset($_POST["sfsi_plus_ytube_chnlid"]) ? sanitize_text_field($_POST["sfsi_plus_ytube_chnlid"]) : '';

	$sfsi_plus_okVisit_option  = isset($_POST["sfsi_plus_okVisit_option"]) ? sanitize_text_field($_POST["sfsi_plus_okVisit_option"]) : 'no';
	$sfsi_plus_okVisit_url  = isset($_POST["sfsi_plus_okVisit_url"]) ? esc_url($_POST["sfsi_plus_okVisit_url"]) : '';

	$sfsi_plus_okSubscribe_option  = isset($_POST["sfsi_plus_okSubscribe_option"]) ? sanitize_text_field($_POST["sfsi_plus_okSubscribe_option"]) : 'no';
	$sfsi_plus_okSubscribe_userid  = isset($_POST["sfsi_plus_okSubscribe_userid"]) ? sanitize_text_field($_POST["sfsi_plus_okSubscribe_userid"]) : '';

	$sfsi_plus_okLike_option  = isset($_POST["sfsi_plus_okLike_option"]) ? sanitize_text_field($_POST["sfsi_plus_okLike_option"]) : 'no';

	$sfsi_plus_telegramShare_option     = isset($_POST["sfsi_plus_telegramShare_option"]) ? sanitize_text_field($_POST["sfsi_plus_telegramShare_option"]) : 'no';
	$sfsi_plus_telegramMessage_option   = isset($_POST["sfsi_plus_telegramMessage_option"]) ? sanitize_text_field($_POST["sfsi_plus_telegramMessage_option"]) : 'no';
	$sfsi_plus_telegram_message         = isset($_POST["sfsi_plus_telegram_message"]) ? sanitize_text_field($_POST["sfsi_plus_telegram_message"]) : '';
	$sfsi_plus_telegram_username     = isset($_POST["sfsi_plus_telegram_username"]) ? sanitize_text_field($_POST["sfsi_plus_telegram_username"]) : '';


	$sfsi_plus_vkVisit_option      = isset($_POST["sfsi_plus_vkVisit_option"]) ? sanitize_text_field($_POST["sfsi_plus_vkVisit_option"]) : 'no';
	$sfsi_plus_vkShare_option      = isset($_POST["sfsi_plus_vkShare_option"]) ? sanitize_text_field($_POST["sfsi_plus_vkShare_option"]) : 'no';
	$sfsi_plus_vkLike_option       = isset($_POST["sfsi_plus_vkLike_option"]) ? sanitize_text_field($_POST["sfsi_plus_vkLike_option"]) : 'no';
	$sfsi_plus_vkVisit_url  = isset($_POST["sfsi_plus_vkVisit_url"]) ? sanitize_text_field($_POST["sfsi_plus_vkVisit_url"]) : '';


	$sfsi_plus_weiboVisit_option      = isset($_POST["sfsi_plus_weiboVisit_option"]) ? sanitize_text_field($_POST["sfsi_plus_weiboVisit_option"]) : 'no';
	$sfsi_plus_weiboShare_option      = isset($_POST["sfsi_plus_weiboShare_option"]) ? sanitize_text_field($_POST["sfsi_plus_weiboShare_option"]) : 'no';
	$sfsi_plus_weiboLike_option       = isset($_POST["sfsi_plus_weiboLike_option"]) ? sanitize_text_field($_POST["sfsi_plus_weiboLike_option"]) : 'no';
	$sfsi_plus_weiboVisit_url  = isset($_POST["sfsi_plus_weiboVisit_url"]) ? sanitize_text_field($_POST["sfsi_plus_weiboVisit_url"]) : '';;
	$sfsi_plus_wechatFollow_option      = isset($_POST["sfsi_plus_wechatFollow_option"]) ? sanitize_text_field($_POST["sfsi_plus_wechatFollow_option"]) : 'no';
	$sfsi_plus_wechatShare_option      = isset($_POST["sfsi_plus_wechatShare_option"]) ? sanitize_text_field($_POST["sfsi_plus_wechatShare_option"]) : 'no';
	$sfsi_plus_wechat_scan_image      = isset($_POST["sfsi_plus_wechat_scan_image"]) ? sanitize_text_field($_POST["sfsi_plus_wechat_scan_image"]) : '';

	/*
	 * Escape custom icons url
	 */
	if (
		isset($_POST["sfsi_plus_custom_links"]) &&
		!empty($_POST["sfsi_plus_custom_links"])
	) {
		$esacpedUrls = array();
		$sfsi_plus_CustomIcon_links = $_POST["sfsi_plus_custom_links"];

		foreach ($sfsi_plus_CustomIcon_links as $key => $sfsi_pluscustomIconUrl) {
			$esacpedUrls[$key] = esc_url($sfsi_pluscustomIconUrl);
		}
	} else {
		$esacpedUrls = '';
	}
	$sfsi_plus_CustomIcon_links = isset($_POST["sfsi_plus_custom_links"]) ? serialize($esacpedUrls) : '';
	$sfsi_plus_houzz_pageUrl   = isset($_POST["sfsi_plus_houzz_pageUrl"]) ? esc_url(trim($_POST["sfsi_plus_houzz_pageUrl"])) : '';

	$option2	= unserialize(get_option('sfsi_plus_section2_options', false));
	$up_option2	= array(
		'sfsi_plus_rss_url'					=> esc_url($sfsi_plus_rss_url),
		'sfsi_rss_blogName'					=> '',
		'sfsi_rss_blogEmail'				=> '',
		'sfsi_plus_rss_icons'				=> sanitize_text_field($sfsi_plus_rss_icons),
		'sfsi_plus_email_url'				=> esc_url($option2['sfsi_plus_email_url']),
		/* facebook buttons options */
		'sfsi_plus_facebookPage_option'		=> sanitize_text_field($sfsi_plus_facebookPage_option),
		'sfsi_plus_facebookPage_url'		=> esc_url($sfsi_plus_facebookPage_url),
		'sfsi_plus_facebookLike_option'		=> sanitize_text_field($sfsi_plus_facebookLike_option),
		'sfsi_plus_facebookShare_option'	=> sanitize_text_field($sfsi_plus_facebookShare_option),

		/* Twitter buttons options */
		'sfsi_plus_twitter_followme'		=> sanitize_text_field($sfsi_plus_twitter_followme),
		'sfsi_plus_twitter_followUserName'	=> sanitize_text_field($sfsi_plus_twitter_followUserName),
		'sfsi_plus_twitter_aboutPage'		=> sanitize_text_field($sfsi_plus_twitter_aboutPage),
		'sfsi_plus_twitter_page'			=> sanitize_text_field($sfsi_plus_twitter_page),
		'sfsi_plus_twitter_pageURL'			=> esc_url($sfsi_plus_twitter_pageURL),
		'sfsi_plus_twitter_aboutPageText'	=> sanitize_text_field($sfsi_plus_twitter_aboutPageText),

		/* youtube options */
		'sfsi_plus_youtube_pageUrl'			=> esc_url($sfsi_plus_youtube_pageUrl),
		'sfsi_plus_youtube_page'			=> sanitize_text_field($sfsi_plus_youtube_page),
		'sfsi_plus_youtube_follow'			=> sanitize_text_field($sfsi_plus_youtube_follow),
		'sfsi_plus_ytube_user'				=> sanitize_text_field($sfsi_plus_ytube_user),
		'sfsi_plus_youtubeusernameorid'		=> sanitize_text_field($sfsi_plus_youtubeusernameorid),
		'sfsi_plus_ytube_chnlid'			=> sanitize_text_field($sfsi_plus_ytube_chnlid),

		/* pinterest options */
		'sfsi_plus_pinterest_page'			=> sanitize_text_field($sfsi_plus_pinterest_page),
		'sfsi_plus_pinterest_pageUrl'		=> esc_url($sfsi_plus_pinterest_pageUrl),
		'sfsi_plus_pinterest_pingBlog'		=> sanitize_text_field($sfsi_plus_pinterest_pingBlog),

		/* instagram and houzz options */
		'sfsi_plus_instagram_pageUrl'		=> esc_url($sfsi_plus_instagram_pageUrl),
		'sfsi_plus_houzz_pageUrl'			=> esc_url($sfsi_plus_houzz_pageUrl),
		//MZ CODE START

		/** OK */
		'sfsi_plus_okVisit_option'      => sanitize_text_field($sfsi_plus_okVisit_option),
		'sfsi_plus_okVisit_url'         => sanitize_text_field($sfsi_plus_okVisit_url),
		'sfsi_plus_okSubscribe_option'  => sanitize_text_field($sfsi_plus_okSubscribe_option),
		'sfsi_plus_okSubscribe_userid'  => sanitize_text_field($sfsi_plus_okSubscribe_userid),
		'sfsi_plus_okLike_option'       => sanitize_text_field($sfsi_plus_okLike_option),

		/* telegram */
		'sfsi_plus_telegramShare_option'    => sanitize_text_field($sfsi_plus_telegramShare_option),
		'sfsi_plus_telegramMessage_option'  => sanitize_text_field($sfsi_plus_telegramMessage_option),
		'sfsi_plus_telegram_message'        => sanitize_text_field($sfsi_plus_telegram_message),
		'sfsi_plus_telegram_username'    => sanitize_text_field($sfsi_plus_telegram_username),

		/* VK */
		'sfsi_plus_vkVisit_option'      => sanitize_text_field($sfsi_plus_vkVisit_option),
		'sfsi_plus_vkShare_option'      => sanitize_text_field($sfsi_plus_vkShare_option),
		'sfsi_plus_vkLike_option'       => sanitize_text_field($sfsi_plus_vkLike_option),
		'sfsi_plus_vkVisit_url'         => sanitize_text_field($sfsi_plus_vkVisit_url),

		/** Weibo */
		'sfsi_plus_weiboVisit_option'   => sanitize_text_field($sfsi_plus_weiboVisit_option),
		'sfsi_plus_weiboShare_option'   => sanitize_text_field($sfsi_plus_weiboShare_option),
		'sfsi_plus_weiboLike_option'    => sanitize_text_field($sfsi_plus_weiboLike_option),
		'sfsi_plus_weiboVisit_url'      => sanitize_text_field($sfsi_plus_weiboVisit_url),

		/**Wechat */
		'sfsi_plus_wechatFollow_option' => sanitize_text_field($sfsi_plus_wechatFollow_option),
		'sfsi_plus_wechatShare_option' => sanitize_text_field($sfsi_plus_wechatShare_option),
		'sfsi_plus_wechat_scan_image' => sanitize_text_field($sfsi_plus_wechat_scan_image),


		//MZ CODE END
		/* linkedIn options */
		'sfsi_plus_linkedin_page'			=> sanitize_text_field($sfsi_plus_linkedin_page),
		'sfsi_plus_linkedin_pageURL'		=> esc_url($sfsi_plus_linkedin_pageURL),
		'sfsi_plus_linkedin_follow'			=> sanitize_text_field($sfsi_plus_linkedin_follow),
		'sfsi_plus_linkedin_followCompany'	=> intval($sfsi_plus_linkedin_followCompany),
		'sfsi_plus_linkedin_SharePage'		=> sanitize_text_field($sfsi_plus_linkedin_SharePage),
		'sfsi_plus_linkedin_recommendBusines' => sanitize_text_field($sfsi_plus_linkedin_recommendBusines),
		'sfsi_plus_linkedin_recommendCompany' => sanitize_text_field($sfsi_plus_linkedin_recommendCompany),
		'sfsi_plus_linkedin_recommendProductId' => intval($sfsi_plus_linkedin_recommendProductId),
		'sfsi_plus_CustomIcon_links'		=> $sfsi_plus_CustomIcon_links
	);
	update_option('sfsi_plus_section2_options', serialize($up_option2));
	$option4	= unserialize(get_option('sfsi_plus_section4_options', false));

	$option4['sfsi_plus_youtubeusernameorid']	= sanitize_text_field($sfsi_plus_youtubeusernameorid);
	$option4['sfsi_plus_ytube_chnlid']			= sfsi_plus_sanitize_field($sfsi_plus_ytube_chnlid);
	update_option('sfsi_plus_section4_options',	serialize($option4));

	header('Content-Type: application/json');
	echo  json_encode(array("success"));
	exit;
}
/* save settings for section 3 */
add_action('wp_ajax_plus_updateSrcn3', 'sfsi_plus_options_updater3');
function sfsi_plus_options_updater3()
{
	if (!wp_verify_nonce($_POST['nonce'], "update_plus_step3")) {
		echo  json_encode(array("wrong_nonce"));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}
	$sfsi_plus_actvite_theme             = isset($_POST["sfsi_plus_actvite_theme"]) ? sanitize_text_field($_POST["sfsi_plus_actvite_theme"]) : 'no';
	$sfsi_plus_mouseOver                 = isset($_POST["sfsi_plus_mouseOver"]) ? sanitize_text_field($_POST["sfsi_plus_mouseOver"]) : 'no';

	$sfsi_plus_mouseOver_effect          = isset($_POST["sfsi_plus_mouseOver_effect"]) ? sanitize_text_field($_POST["sfsi_plus_mouseOver_effect"]) : 'fade_in';

	$sfsi_plus_mouseover_effect_type     = isset($_POST["sfsi_plus_mouseover_effect_type"]) ? sanitize_text_field($_POST["sfsi_plus_mouseover_effect_type"]) : 'same_icons';

	$sfsi_plus_shuffle_icons             = isset($_POST["sfsi_plus_shuffle_icons"]) ? sanitize_text_field($_POST["sfsi_plus_shuffle_icons"]) : 'no';
	$sfsi_plus_shuffle_Firstload         = isset($_POST["sfsi_plus_shuffle_Firstload"]) ? sanitize_text_field($_POST["sfsi_plus_shuffle_Firstload"]) : 'no';
	$sfsi_plus_shuffle_interval          = isset($_POST["sfsi_plus_shuffle_interval"]) ? sanitize_text_field($_POST["sfsi_plus_shuffle_interval"]) : 'no';
	$sfsi_plus_shuffle_intervalTime      = isset($_POST["sfsi_plus_shuffle_intervalTime"]) ? intval($_POST["sfsi_plus_shuffle_intervalTime"]) : '';
	$sfsi_plus_specialIcon_animation     = isset($_POST["sfsi_plus_specialIcon_animation"]) ? sanitize_text_field($_POST["sfsi_plus_specialIcon_animation"]) : '';
	$sfsi_plus_specialIcon_MouseOver     = isset($_POST["sfsi_plus_specialIcon_MouseOver"]) ? sanitize_text_field($_POST["sfsi_plus_specialIcon_MouseOver"]) : 'no';
	$sfsi_plus_specialIcon_Firstload     = isset($_POST["sfsi_plus_specialIcon_Firstload"]) ? sanitize_text_field($_POST["sfsi_plus_specialIcon_Firstload"]) : 'no';

	$sfsi_plus_specialIcon_Firstload_Icons 	= 	isset($_POST["sfsi_plus_specialIcon_Firstload_Icons"])
		? sanitize_text_field(
			$_POST["sfsi_plus_specialIcon_Firstload_Icons"]
		) : 'all';
	$sfsi_plus_specialIcon_interval       	= isset($_POST["sfsi_plus_specialIcon_interval"])
		? sanitize_text_field(
			$_POST["sfsi_plus_specialIcon_interval"]
		) : 'no';
	$sfsi_plus_specialIcon_intervalTime     = isset($_POST["sfsi_plus_specialIcon_intervalTime"])
		? sanitize_text_field(
			$_POST["sfsi_plus_specialIcon_intervalTime"]
		) : '';
	$sfsi_plus_specialIcon_intervalIcons    = isset($_POST["sfsi_plus_specialIcon_intervalIcons"])
		? sanitize_text_field(
			$_POST["sfsi_plus_specialIcon_intervalIcons"]
		) : 'all';

	/* Design and animation option  */
	$up_option3 = array(
		'sfsi_plus_actvite_theme'				=> sanitize_text_field($sfsi_plus_actvite_theme),
		/* animations options */
		'sfsi_plus_mouseOver'					=> sanitize_text_field($sfsi_plus_mouseOver),
		'sfsi_plus_mouseOver_effect'			=> sanitize_text_field($sfsi_plus_mouseOver_effect),
		'sfsi_plus_mouseover_effect_type'		=> sanitize_text_field($sfsi_plus_mouseover_effect_type),
		'sfsi_plus_shuffle_icons'				=> sanitize_text_field($sfsi_plus_shuffle_icons),
		'sfsi_plus_shuffle_Firstload'			=> sanitize_text_field($sfsi_plus_shuffle_Firstload),
		'sfsi_plus_shuffle_interval'			=> sanitize_text_field($sfsi_plus_shuffle_interval),
		'sfsi_plus_shuffle_intervalTime'		=> intval($sfsi_plus_shuffle_intervalTime),
		'sfsi_plus_specialIcon_animation'		=> sanitize_text_field($sfsi_plus_specialIcon_animation),
		'sfsi_plus_specialIcon_MouseOver'		=> sanitize_text_field($sfsi_plus_specialIcon_MouseOver),
		'sfsi_plus_specialIcon_Firstload'		=> sanitize_text_field($sfsi_plus_specialIcon_Firstload),
		'sfsi_plus_specialIcon_Firstload_Icons'	=> sanitize_text_field($sfsi_plus_specialIcon_Firstload_Icons),
		'sfsi_plus_specialIcon_interval'		=> sanitize_text_field($sfsi_plus_specialIcon_interval),
		'sfsi_plus_specialIcon_intervalTime'	=> sanitize_text_field($sfsi_plus_specialIcon_intervalTime),
		'sfsi_plus_specialIcon_intervalIcons'	=> sanitize_text_field($sfsi_plus_specialIcon_intervalIcons),
	);
	update_option('sfsi_plus_section3_options', serialize($up_option3));
	header('Content-Type: application/json');
	echo  json_encode(array("success"));
	exit;
}
/* save settings for section 4 */
add_action('wp_ajax_plus_updateSrcn4', 'sfsi_plus_options_updater4');
function sfsi_plus_options_updater4()
{
	if (!wp_verify_nonce($_POST['nonce'], "update_plus_step4")) {
		echo  json_encode(array("wrong_nonce"));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}
	$sfsi_plus_display_counts            = isset($_POST["sfsi_plus_display_counts"]) ? sanitize_text_field($_POST["sfsi_plus_display_counts"]) : 'no';

	$sfsi_plus_email_countsDisplay       = isset($_POST["sfsi_plus_email_countsDisplay"]) ? sanitize_text_field($_POST["sfsi_plus_email_countsDisplay"]) : 'no';
	$sfsi_plus_email_countsFrom          = isset($_POST["sfsi_plus_email_countsFrom"]) ? sanitize_text_field($_POST["sfsi_plus_email_countsFrom"]) : 'manual';
	$sfsi_plus_email_manualCounts        = isset($_POST["sfsi_plus_email_manualCounts"]) ? intval(trim($_POST["sfsi_plus_email_manualCounts"])) : '';

	$sfsi_plus_rss_countsDisplay         = isset($_POST["sfsi_plus_rss_countsDisplay"]) ? sanitize_text_field($_POST["sfsi_plus_rss_countsDisplay"]) : 'no';
	$sfsi_plus_rss_manualCounts          = isset($_POST["sfsi_plus_rss_manualCounts"]) ? intval(trim($_POST["sfsi_plus_rss_manualCounts"])) : '';

	$sfsi_plus_facebook_countsDisplay    = isset($_POST["sfsi_plus_facebook_countsDisplay"]) ? sanitize_text_field($_POST["sfsi_plus_facebook_countsDisplay"]) : 'no';
	$sfsi_plus_facebook_countsFrom       = isset($_POST["sfsi_plus_facebook_countsFrom"]) ? sanitize_text_field($_POST["sfsi_plus_facebook_countsFrom"]) : 'manual';
	$sfsi_plus_facebook_mypageCounts     = isset($_POST["sfsi_plus_facebook_mypageCounts"]) ? sanitize_text_field(trim($_POST["sfsi_plus_facebook_mypageCounts"])) : '';
	$sfsi_plus_facebook_manualCounts     = isset($_POST["sfsi_plus_facebook_manualCounts"]) ? intval(trim($_POST["sfsi_plus_facebook_manualCounts"])) : '';
	$sfsi_plus_facebook_PageLink         = isset($_POST["sfsi_plus_facebook_PageLink"]) ? sanitize_text_field(trim($_POST["sfsi_plus_facebook_PageLink"])) : '';

	$sfsi_plus_twitter_countsDisplay     = isset($_POST["sfsi_plus_twitter_countsDisplay"]) ? sanitize_text_field($_POST["sfsi_plus_twitter_countsDisplay"]) : 'no';
	$sfsi_plus_twitter_countsFrom        = isset($_POST["sfsi_plus_twitter_countsFrom"]) ? sanitize_text_field($_POST["sfsi_plus_twitter_countsFrom"]) : 'manual';
	$sfsi_plus_twitter_manualCounts      = isset($_POST["sfsi_plus_twitter_manualCounts"]) ? intval(trim($_POST["sfsi_plus_twitter_manualCounts"])) : '';
	$sfsiplus_tw_consumer_key            = isset($_POST["sfsiplus_tw_consumer_key"]) ? sanitize_text_field(trim($_POST["sfsiplus_tw_consumer_key"])) : '';
	$sfsiplus_tw_consumer_secret         = isset($_POST["sfsiplus_tw_consumer_secret"]) ? sanitize_text_field(trim($_POST["sfsiplus_tw_consumer_secret"])) : '';
	$sfsiplus_tw_oauth_access_token      = isset($_POST["sfsiplus_tw_oauth_access_token"]) ? sanitize_text_field(trim($_POST["sfsiplus_tw_oauth_access_token"])) : '';
	$sfsiplus_tw_oauth_access_token_secret = 	isset($_POST["sfsiplus_tw_oauth_access_token_secret"])
		? sanitize_text_field(
			trim($_POST["sfsiplus_tw_oauth_access_token_secret"])
		) : '';

	$sfsi_plus_linkedIn_countsDisplay    = isset($_POST["sfsi_plus_linkedIn_countsDisplay"]) ? sanitize_text_field($_POST["sfsi_plus_linkedIn_countsDisplay"]) : 'no';
	$sfsi_plus_linkedIn_countsFrom       = isset($_POST["sfsi_plus_linkedIn_countsFrom"]) ? sanitize_text_field($_POST["sfsi_plus_linkedIn_countsFrom"]) : 'manual';
	$sfsi_plus_linkedIn_manualCounts     = isset($_POST["sfsi_plus_linkedIn_manualCounts"]) ? intval(trim($_POST["sfsi_plus_linkedIn_manualCounts"])) : '';
	$sfsi_plus_ln_company                = isset($_POST["sfsi_plus_ln_company"]) ? sanitize_text_field(trim($_POST["sfsi_plus_ln_company"])) : '';
	$sfsi_plus_ln_api_key                = isset($_POST["sfsi_plus_ln_api_key"]) ? sanitize_text_field(trim($_POST["sfsi_plus_ln_api_key"])) : '';
	$sfsi_plus_ln_secret_key             = isset($_POST["sfsi_plus_ln_secret_key"]) ? sanitize_text_field(trim($_POST["sfsi_plus_ln_secret_key"])) : '';
	$sfsi_plus_ln_oAuth_user_token       = isset($_POST["sfsi_plus_ln_oAuth_user_token"]) ? sanitize_text_field(trim($_POST["sfsi_plus_ln_oAuth_user_token"])) : '';

	$sfsi_plus_youtube_countsDisplay     = isset($_POST["sfsi_plus_youtube_countsDisplay"]) ? sanitize_text_field($_POST["sfsi_plus_youtube_countsDisplay"]) : 'no';
	$sfsi_plus_youtube_countsFrom        = isset($_POST["sfsi_plus_youtube_countsFrom"]) ? sanitize_text_field($_POST["sfsi_plus_youtube_countsFrom"]) : 'manual';
	$sfsi_plus_youtube_manualCounts      = isset($_POST["sfsi_plus_youtube_manualCounts"]) ? intval($_POST["sfsi_plus_youtube_manualCounts"]) : '';
	$sfsi_plus_youtube_user              = isset($_POST["sfsi_plus_youtube_user"]) ? sanitize_text_field(trim($_POST["sfsi_plus_youtube_user"])) : '';
	$sfsi_plus_youtube_channelId		 = isset($_POST["sfsi_plus_youtube_channelId"]) ? sanitize_text_field(trim($_POST["sfsi_plus_youtube_channelId"])) : '';

	$sfsi_plus_pinterest_countsDisplay   = isset($_POST["sfsi_plus_pinterest_countsDisplay"]) ? sanitize_text_field($_POST["sfsi_plus_pinterest_countsDisplay"]) : 'no';
	$sfsi_plus_pinterest_countsFrom      = isset($_POST["sfsi_plus_pinterest_countsFrom"]) ? sanitize_text_field($_POST["sfsi_plus_pinterest_countsFrom"]) : 'manual';
	$sfsi_plus_pinterest_manualCounts    = isset($_POST["sfsi_plus_pinterest_manualCounts"]) ? intval(trim($_POST["sfsi_plus_pinterest_manualCounts"])) : '';
	$sfsi_plus_pinterest_user            = isset($_POST["sfsi_plus_pinterest_user"]) ? sanitize_text_field(trim($_POST["sfsi_plus_pinterest_user"])) : '';
	$sfsi_plus_pinterest_board           = isset($_POST["sfsi_plus_pinterest_board"]) ? sanitize_text_field(trim($_POST["sfsi_plus_pinterest_board"])) : '';

	$sfsi_plus_instagram_countsDisplay   = isset($_POST["sfsi_plus_instagram_countsDisplay"]) ? sanitize_text_field($_POST["sfsi_plus_instagram_countsDisplay"]) : 'no';
	$sfsi_plus_instagram_countsFrom      = isset($_POST["sfsi_plus_instagram_countsFrom"]) ? sanitize_text_field($_POST["sfsi_plus_instagram_countsFrom"]) : 'manual';
	$sfsi_plus_instagram_manualCounts    = isset($_POST["sfsi_plus_instagram_manualCounts"]) ? intval(trim($_POST["sfsi_plus_instagram_manualCounts"])) : '';
	$sfsi_plus_instagram_User            = isset($_POST["sfsi_plus_instagram_User"]) ? sanitize_text_field($_POST["sfsi_plus_instagram_User"]) : '';
	$sfsi_plus_instagram_clientid        = isset($_POST["sfsi_plus_instagram_clientid"]) ? sanitize_text_field($_POST["sfsi_plus_instagram_clientid"]) : '';
	$sfsi_plus_instagram_appurl          = isset($_POST["sfsi_plus_instagram_appurl"]) ? sanitize_text_field($_POST["sfsi_plus_instagram_appurl"]) : '';
	$sfsi_plus_instagram_token           = isset($_POST["sfsi_plus_instagram_token"]) ? sanitize_text_field($_POST["sfsi_plus_instagram_token"]) : '';

	$sfsi_plus_houzz_countsDisplay       = isset($_POST["sfsi_plus_houzz_countsDisplay"]) ? sanitize_text_field($_POST["sfsi_plus_houzz_countsDisplay"]) : 'no';
	$sfsi_plus_houzz_countsFrom          = isset($_POST["sfsi_plus_houzz_countsFrom"]) ? sanitize_text_field($_POST["sfsi_plus_houzz_countsFrom"]) : 'manual';
	$sfsi_plus_houzz_manualCounts        = isset($_POST["sfsi_plus_houzz_manualCounts"]) ? intval(trim($_POST["sfsi_plus_houzz_manualCounts"])) : '';

	$sfsi_plus_facebookPage_url          = isset($_POST["sfsi_plus_facebookPage_url"]) ? sanitize_text_field(trim($_POST["sfsi_plus_facebookPage_url"])) : '';

	$sfsi_plus_telegram_countsDisplay       = isset($_POST["sfsi_plus_telegram_countsDisplay"]) ? sanitize_text_field($_POST["sfsi_plus_telegram_countsDisplay"]) : 'no';
	$sfsi_plus_telegram_manualCounts        = isset($_POST["sfsi_plus_telegram_manualCounts"]) ? intval(trim($_POST["sfsi_plus_telegram_manualCounts"])) : '';

	$sfsi_plus_vk_countsDisplay       = isset($_POST["sfsi_plus_vk_countsDisplay"]) ? sanitize_text_field($_POST["sfsi_plus_vk_countsDisplay"]) : 'no';
	$sfsi_plus_vk_manualCounts        = isset($_POST["sfsi_plus_vk_manualCounts"]) ? intval(trim($_POST["sfsi_plus_vk_manualCounts"])) : '';

	$sfsi_plus_ok_countsDisplay       = isset($_POST["sfsi_plus_ok_countsDisplay"]) ? sanitize_text_field($_POST["sfsi_plus_ok_countsDisplay"]) : 'no';
	$sfsi_plus_ok_manualCounts        = isset($_POST["sfsi_plus_ok_manualCounts"]) ? intval(trim($_POST["sfsi_plus_ok_manualCounts"])) : '';

	$sfsi_plus_wechat_countsDisplay       = isset($_POST["sfsi_plus_wechat_countsDisplay"]) ? sanitize_text_field($_POST["sfsi_plus_wechat_countsDisplay"]) : 'no';
	$sfsi_plus_wechat_manualCounts        = isset($_POST["sfsi_plus_wechat_manualCounts"]) ? intval(trim($_POST["sfsi_plus_wechat_manualCounts"])) : '';

	$sfsi_plus_weibo_countsDisplay       = isset($_POST["sfsi_plus_weibo_countsDisplay"]) ? sanitize_text_field($_POST["sfsi_plus_weibo_countsDisplay"]) : 'no';
	$sfsi_plus_weibo_manualCounts        = isset($_POST["sfsi_plus_weibo_manualCounts"]) ? intval(trim($_POST["sfsi_plus_weibo_manualCounts"])) : '';
	$sfsi_plus_round_counts = isset($_POST["sfsi_plus_round_counts"]) ? sanitize_text_field($_POST["sfsi_plus_round_counts"]) : 'no';
	$sfsi_plus_original_counts = isset($_POST["sfsi_plus_original_counts"]) ? sanitize_text_field($_POST["sfsi_plus_original_counts"]) : 'no';
	$sfsi_plus_responsive_share_count = isset($_POST["sfsi_plus_responsive_share_count"]) ? sanitize_text_field($_POST["sfsi_plus_responsive_share_count"]) : 'no';
	$up_option4 = array(
		'sfsi_plus_display_counts'			=> sanitize_text_field($sfsi_plus_display_counts),

		'sfsi_plus_email_countsDisplay'		=> sanitize_text_field($sfsi_plus_email_countsDisplay),
		'sfsi_plus_email_countsFrom'			=> sanitize_text_field($sfsi_plus_email_countsFrom),
		'sfsi_plus_email_manualCounts' 		=> intval($sfsi_plus_email_manualCounts),

		'sfsi_plus_rss_countsDisplay'		=> sanitize_text_field($sfsi_plus_rss_countsDisplay),
		'sfsi_plus_rss_manualCounts'			=> intval($sfsi_plus_rss_manualCounts),

		'sfsi_plus_facebook_countsDisplay'	=> sanitize_text_field($sfsi_plus_facebook_countsDisplay),
		'sfsi_plus_facebook_countsFrom'	 	=> sanitize_text_field($sfsi_plus_facebook_countsFrom),
		'sfsi_plus_facebook_mypageCounts' 	=> sfsi_plus_sanitize_field($sfsi_plus_facebook_mypageCounts),
		'sfsi_plus_facebook_manualCounts' 	=> intval($sfsi_plus_facebook_manualCounts),
		//'sfsi_plus_facebook_PageLink'	 	=> $sfsi_plus_facebook_PageLink,

		'sfsi_plus_twitter_countsDisplay' 	=> sanitize_text_field($sfsi_plus_twitter_countsDisplay),
		'sfsi_plus_twitter_countsFrom'	 	=> sanitize_text_field($sfsi_plus_twitter_countsFrom),
		'sfsi_plus_twitter_manualCounts'  	=> intval($sfsi_plus_twitter_manualCounts),
		'sfsiplus_tw_consumer_key'			=> sfsi_plus_sanitize_field($sfsiplus_tw_consumer_key),
		'sfsiplus_tw_consumer_secret'	 	=> sfsi_plus_sanitize_field($sfsiplus_tw_consumer_secret),
		'sfsiplus_tw_oauth_access_token'  	=> sfsi_plus_sanitize_field($sfsiplus_tw_oauth_access_token),
		'sfsiplus_tw_oauth_access_token_secret' => sfsi_plus_sanitize_field($sfsiplus_tw_oauth_access_token_secret),

		/*'sfsi_plus_ln_company'            	=> $sfsi_plus_ln_company,
	   'sfsi_plus_ln_api_key'            	=> $sfsi_plus_ln_api_key,
	   'sfsi_plus_ln_secret_key'         	=> $sfsi_plus_ln_secret_key,
	   'sfsi_plus_ln_oAuth_user_token'   	=> $sfsi_plus_ln_oAuth_user_token,*/
		'sfsi_plus_linkedIn_countsDisplay'	=> sanitize_text_field($sfsi_plus_linkedIn_countsDisplay),
		'sfsi_plus_linkedIn_countsFrom'	 	=> sanitize_text_field($sfsi_plus_linkedIn_countsFrom),
		'sfsi_plus_linkedIn_manualCounts' 	=> intval($sfsi_plus_linkedIn_manualCounts),

		'sfsi_plus_youtube_countsDisplay'	=> sanitize_text_field($sfsi_plus_youtube_countsDisplay),
		'sfsi_plus_youtube_countsFrom'	 	=> sanitize_text_field($sfsi_plus_youtube_countsFrom),
		'sfsi_plus_youtube_manualCounts'  	=> intval($sfsi_plus_youtube_manualCounts),
		'sfsi_plus_youtube_user'     	 	=> sfsi_plus_sanitize_field($sfsi_plus_youtube_user),
		'sfsi_plus_youtube_channelId'	 	=> sfsi_plus_sanitize_field($sfsi_plus_youtube_channelId),

		'sfsi_plus_pinterest_countsDisplay'	=> sanitize_text_field($sfsi_plus_pinterest_countsDisplay),
		'sfsi_plus_pinterest_countsFrom'	  	=> sanitize_text_field($sfsi_plus_pinterest_countsFrom),
		'sfsi_plus_pinterest_manualCounts' 	=> intval($sfsi_plus_pinterest_manualCounts),
		//'sfsi_plus_pinterest_user'		  	=> $sfsi_plus_pinterest_user,     
		//'sfsi_plus_pinterest_board'		=> $sfsi_plus_pinterest_board,

		'sfsi_plus_instagram_countsFrom'	  	=> sanitize_text_field($sfsi_plus_instagram_countsFrom),
		'sfsi_plus_instagram_countsDisplay'	=> sanitize_text_field($sfsi_plus_instagram_countsDisplay),
		'sfsi_plus_instagram_manualCounts' 	=> intval($sfsi_plus_instagram_manualCounts),
		'sfsi_plus_instagram_User' 		  	=> sanitize_text_field($sfsi_plus_instagram_User),
		'sfsi_plus_instagram_clientid' 		=> sanitize_text_field($sfsi_plus_instagram_clientid),
		'sfsi_plus_instagram_appurl' 		=> sanitize_text_field($sfsi_plus_instagram_appurl),
		'sfsi_plus_instagram_token' 		  	=> sanitize_text_field($sfsi_plus_instagram_token),

		'sfsi_plus_houzz_countsDisplay'		=> sanitize_text_field($sfsi_plus_houzz_countsDisplay),
		'sfsi_plus_houzz_countsFrom'			=> sanitize_text_field($sfsi_plus_houzz_countsFrom),
		'sfsi_plus_houzz_manualCounts'		=> intval($sfsi_plus_houzz_manualCounts),

		'sfsi_plus_telegram_countsDisplay'	=> sanitize_text_field($sfsi_plus_telegram_countsDisplay),
		'sfsi_plus_telegram_manualCounts' 	=> intval($sfsi_plus_telegram_manualCounts),

		'sfsi_plus_vk_countsDisplay'	=> sanitize_text_field($sfsi_plus_vk_countsDisplay),
		'sfsi_plus_vk_manualCounts' 	=> intval($sfsi_plus_vk_manualCounts),

		'sfsi_plus_ok_countsDisplay'	=> sanitize_text_field($sfsi_plus_ok_countsDisplay),
		'sfsi_plus_ok_manualCounts' 	=> intval($sfsi_plus_ok_manualCounts),

		'sfsi_plus_weibo_countsDisplay'	=> sanitize_text_field($sfsi_plus_weibo_countsDisplay),
		'sfsi_plus_weibo_manualCounts' 	=> intval($sfsi_plus_weibo_manualCounts),

		'sfsi_plus_wechat_countsDisplay'	=> sanitize_text_field($sfsi_plus_wechat_countsDisplay),
		'sfsi_plus_wechat_manualCounts' 	=> intval($sfsi_plus_wechat_manualCounts),
		'sfsi_plus_round_counts'            => sanitize_text_field($sfsi_plus_round_counts),
		'sfsi_plus_original_counts'         => sanitize_text_field($sfsi_plus_original_counts),
		'sfsi_plus_responsive_share_count'  => sanitize_text_field($sfsi_plus_responsive_share_count),
	);
	update_option('sfsi_plus_section4_options', serialize($up_option4));

	$new_counts = sfsi_plus_getCounts();
	header('Content-Type: application/json');
	echo  json_encode(array("res" => "success", 'counts' => $new_counts));
	exit;
}
/* save settings for section 5 */
add_action('wp_ajax_plus_updateSrcn5', 'sfsi_plus_options_updater5');
function sfsi_plus_options_updater5()
{
	if (!wp_verify_nonce($_POST['nonce'], "update_plus_step5")) {
		echo  json_encode(array("wrong_nonce"));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}
	$sfsi_plus_icons_size                = isset($_POST["sfsi_plus_icons_size"]) 	  ? intval($_POST["sfsi_plus_icons_size"]) : '51';
	$sfsi_plus_icons_spacing             = isset($_POST["sfsi_plus_icons_spacing"])   ? intval($_POST["sfsi_plus_icons_spacing"]) : '2';
	$sfsi_plus_icons_Alignment           = isset($_POST["sfsi_plus_icons_Alignment"]) ? sanitize_text_field($_POST["sfsi_plus_icons_Alignment"]) : 'center';
	$sfsi_plus_icons_perRow              = isset($_POST["sfsi_plus_icons_perRow"]) 	  ? intval($_POST["sfsi_plus_icons_perRow"]) : '5';

	$sfsi_plus_icons_language            = isset($_POST["sfsi_plus_icons_language"]) 	  ? sanitize_text_field($_POST["sfsi_plus_icons_language"]) : 'en_US';
	$sfsi_plus_icons_ClickPageOpen       = isset($_POST["sfsi_plus_icons_ClickPageOpen"]) ? sanitize_text_field($_POST["sfsi_plus_icons_ClickPageOpen"]) : 'no';
	$sfsi_plus_icons_float               = isset($_POST["sfsi_plus_icons_float"]) 		  ? sanitize_text_field($_POST["sfsi_plus_icons_float"]) : 'no';
	$sfsi_plus_disable_floaticons		 = isset($_POST["sfsi_plus_disable_floaticons"])  ? sanitize_text_field($_POST["sfsi_plus_disable_floaticons"]) : 'no';
	$sfsi_plus_disable_viewport		     = isset($_POST["sfsi_plus_disable_viewport"]) 	  ? sanitize_text_field($_POST["sfsi_plus_disable_viewport"]) : 'no';
	$sfsi_plus_icons_floatPosition       = isset($_POST["sfsi_plus_icons_floatPosition"]) ? sanitize_text_field($_POST["sfsi_plus_icons_floatPosition"]) : 'center-right';
	$sfsi_plus_icons_stick               = isset($_POST["sfsi_plus_icons_stick"]) 		  ? sanitize_text_field($_POST["sfsi_plus_icons_stick"]) : 'no';
	$sfsi_plus_rss_MouseOverText         = isset($_POST["sfsi_plus_rss_MouseOverText"])   ? sanitize_text_field($_POST["sfsi_plus_rss_MouseOverText"]) : '';
	$sfsi_plus_email_MouseOverText       = isset($_POST["sfsi_plus_email_MouseOverText"]) ? sanitize_text_field($_POST["sfsi_plus_email_MouseOverText"]) : '';

	$sfsi_plus_twitter_MouseOverText     = isset($_POST["sfsi_plus_twitter_MouseOverText"])   ? sanitize_text_field($_POST["sfsi_plus_twitter_MouseOverText"]) : '';
	$sfsi_plus_facebook_MouseOverText    = isset($_POST["sfsi_plus_facebook_MouseOverText"])  ? sanitize_text_field($_POST["sfsi_plus_facebook_MouseOverText"]) : '';
	$sfsi_plus_linkedIn_MouseOverText    = isset($_POST["sfsi_plus_linkedIn_MouseOverText"])  ? sanitize_text_field($_POST["sfsi_plus_linkedIn_MouseOverText"]) : '';
	$sfsi_plus_pinterest_MouseOverText   = isset($_POST["sfsi_plus_pinterest_MouseOverText"]) ? sanitize_text_field($_POST["sfsi_plus_pinterest_MouseOverText"]) : '';
	$sfsi_plus_instagram_MouseOverText   = isset($_POST["sfsi_plus_instagram_MouseOverText"]) ? sanitize_text_field($_POST["sfsi_plus_instagram_MouseOverText"]) : '';
	$sfsi_plus_houzz_MouseOverText       = isset($_POST["sfsi_plus_houzz_MouseOverText"]) 	  ? sanitize_text_field($_POST["sfsi_plus_houzz_MouseOverText"]) : '';
	$sfsi_plus_youtube_MouseOverText     = isset($_POST["sfsi_plus_youtube_MouseOverText"])   ? sanitize_text_field($_POST["sfsi_plus_youtube_MouseOverText"]) : '';

	if (isset($_POST["sfsi_plus_custom_orders"])) {
		$sfsi_plus_custom_orders = array();
		foreach ($_POST["sfsi_plus_custom_orders"] as $index => $custom_order) {
			$sfsi_plus_custom_orders[$index] = array();
			$sfsi_plus_custom_orders[$index]["order"] = intval($_POST["sfsi_plus_custom_orders"][$index]["order"]);
			$sfsi_plus_custom_orders[$index]["ele"] = intval($_POST["sfsi_plus_custom_orders"][$index]["ele"]);
		}
	}
	$sfsi_plus_custom_orders             = isset($sfsi_plus_custom_orders) ? serialize($sfsi_plus_custom_orders) : '';

	$sfsi_plus_rssIcon_order             = isset($_POST["sfsi_plus_rssIcon_order"]) 	  ? intval($_POST["sfsi_plus_rssIcon_order"]) : '1';
	$sfsi_plus_emailIcon_order           = isset($_POST["sfsi_plus_emailIcon_order"]) 	  ? intval($_POST["sfsi_plus_emailIcon_order"]) : '2';
	$sfsi_plus_facebookIcon_order        = isset($_POST["sfsi_plus_facebookIcon_order"])  ? intval($_POST["sfsi_plus_facebookIcon_order"]) : '3';
	$sfsi_plus_twitterIcon_order         = isset($_POST["sfsi_plus_twitterIcon_order"])   ? intval($_POST["sfsi_plus_twitterIcon_order"]) : '5';
	$sfsi_plus_youtubeIcon_order         = isset($_POST["sfsi_plus_youtubeIcon_order"])   ? intval($_POST["sfsi_plus_youtubeIcon_order"]) : '7';
	$sfsi_plus_pinterestIcon_order       = isset($_POST["sfsi_plus_pinterestIcon_order"]) ? intval($_POST["sfsi_plus_pinterestIcon_order"]) : '8';
	$sfsi_plus_linkedinIcon_order        = isset($_POST["sfsi_plus_linkedinIcon_order"])  ? intval($_POST["sfsi_plus_linkedinIcon_order"]) : '9';
	$sfsi_plus_instagramIcon_order       = isset($_POST["sfsi_plus_instagramIcon_order"]) ? intval($_POST["sfsi_plus_instagramIcon_order"]) : '10';
	$sfsi_plus_houzzIcon_order         	 = isset($_POST["sfsi_plus_houzzIcon_order"])     ? intval($_POST["sfsi_plus_houzzIcon_order"]) : '11';
	$sfsi_plus_telegramIcon_order       = isset($_POST["sfsi_plus_telegramIcon_order"]) ? intval($_POST["sfsi_plus_telegramIcon_order"]) : '22';
	$sfsi_plus_vkIcon_order       = isset($_POST["sfsi_plus_vkIcon_order"]) ? intval($_POST["sfsi_plus_vkIcon_order"]) : '23';
	$sfsi_plus_okIcon_order       = isset($_POST["sfsi_plus_okIcon_order"]) ? intval($_POST["sfsi_plus_okIcon_order"]) : '24';
	$sfsi_plus_weiboIcon_order       = isset($_POST["sfsi_plus_weiboIcon_order"]) ? intval($_POST["sfsi_plus_weiboIcon_order"]) : '25';
	$sfsi_plus_wechatIcon_order       = isset($_POST["sfsi_plus_wechatIcon_order"]) ? intval($_POST["sfsi_plus_wechatIcon_order"]) : '26';

	if (isset($_POST["sfsi_plus_custom_MouseOverTexts"])) {
		$sfsi_plus_custom_MouseOverTexts = array();
		foreach ($_POST['sfsi_plus_custom_MouseOverTexts'] as $index => $a) {
			$sfsi_plus_custom_MouseOverTexts[$index] = sanitize_text_field($_POST["sfsi_plus_custom_MouseOverTexts"][$index]);
		}
	}
	$sfsi_plus_custom_MouseOverTexts     = isset($sfsi_plus_custom_MouseOverTexts) ? serialize($sfsi_plus_custom_MouseOverTexts) : '';

	$sfsi_plus_follow_icons_language     =	isset($_POST["sfsi_plus_follow_icons_language"])
		? sanitize_text_field(
			$_POST["sfsi_plus_follow_icons_language"]
		) : 'Follow_en_US';
	$sfsi_plus_facebook_icons_language   = 	isset($_POST["sfsi_plus_facebook_icons_language"])
		? sanitize_text_field(
			$_POST["sfsi_plus_facebook_icons_language"]
		) : 'Visit_us_en_US';
	$sfsi_plus_twitter_icons_language    = 	isset($_POST["sfsi_plus_twitter_icons_language"])
		? sanitize_text_field(
			$_POST["sfsi_plus_twitter_icons_language"]
		) : 'Visit_us_en_US';

	$sfsi_plus_custom_social_hide        = isset($_POST["sfsi_plus_custom_social_hide"]) ? sanitize_text_field($_POST["sfsi_plus_custom_social_hide"]) : 'no';

	$sfsi_pplus_icons_suppress_errors        = isset($_POST["sfsi_pplus_icons_suppress_errors"]) ? sanitize_text_field($_POST["sfsi_pplus_icons_suppress_errors"]) : 'no';

	$sfsi_plus_icons_sharing_and_traffic_tips        = isset($_POST["sfsi_plus_icons_sharing_and_traffic_tips"]) ? sanitize_text_field($_POST["sfsi_plus_icons_sharing_and_traffic_tips"]) : 'yes';

	/* size and spacing of icons */
	$up_option5 = array(
		'sfsi_plus_icons_size'				=> intval($sfsi_plus_icons_size),
		'sfsi_plus_icons_spacing'			=> intval($sfsi_plus_icons_spacing),
		'sfsi_plus_icons_Alignment'			=> sanitize_text_field($sfsi_plus_icons_Alignment),
		'sfsi_plus_icons_perRow'			=> intval($sfsi_plus_icons_perRow),
		'sfsi_plus_follow_icons_language'	=> sanitize_text_field($sfsi_plus_follow_icons_language),
		'sfsi_plus_facebook_icons_language'	=> sanitize_text_field($sfsi_plus_facebook_icons_language),
		'sfsi_plus_twitter_icons_language'	=> sanitize_text_field($sfsi_plus_twitter_icons_language),
		'sfsi_plus_icons_language'			=> sanitize_text_field($sfsi_plus_icons_language),
		'sfsi_plus_icons_ClickPageOpen'		=> sanitize_text_field($sfsi_plus_icons_ClickPageOpen),
		'sfsi_plus_icons_float'				=> sanitize_text_field($sfsi_plus_icons_float),
		'sfsi_plus_disable_floaticons'		=> sanitize_text_field($sfsi_plus_disable_floaticons),
		'sfsi_plus_disable_viewport'		=> sanitize_text_field($sfsi_plus_disable_viewport),
		'sfsi_plus_icons_floatPosition'		=> sanitize_text_field($sfsi_plus_icons_floatPosition),
		'sfsi_plus_icons_stick'				=> sanitize_text_field($sfsi_plus_icons_stick),
		/* mouse over texts */
		'sfsi_plus_rss_MouseOverText'		=> sanitize_text_field($sfsi_plus_rss_MouseOverText),
		'sfsi_plus_email_MouseOverText'		=> sanitize_text_field($sfsi_plus_email_MouseOverText),
		'sfsi_plus_twitter_MouseOverText'	=> sanitize_text_field($sfsi_plus_twitter_MouseOverText),
		'sfsi_plus_facebook_MouseOverText'	=> sanitize_text_field($sfsi_plus_facebook_MouseOverText),
		'sfsi_plus_linkedIn_MouseOverText'	=> sanitize_text_field($sfsi_plus_linkedIn_MouseOverText),
		'sfsi_plus_pinterest_MouseOverText'	=> sanitize_text_field($sfsi_plus_pinterest_MouseOverText),
		'sfsi_plus_youtube_MouseOverText'	=> sanitize_text_field($sfsi_plus_youtube_MouseOverText),
		'sfsi_plus_instagram_MouseOverText'	=> sanitize_text_field($sfsi_plus_instagram_MouseOverText),
		'sfsi_plus_houzz_MouseOverText'		=> sanitize_text_field($sfsi_plus_houzz_MouseOverText),
		'sfsi_plus_CustomIcons_order'		=> $sfsi_plus_custom_orders,
		'sfsi_plus_rssIcon_order'			=> intval($sfsi_plus_rssIcon_order),
		'sfsi_plus_emailIcon_order'			=> intval($sfsi_plus_emailIcon_order),
		'sfsi_plus_facebookIcon_order'		=> intval($sfsi_plus_facebookIcon_order),
		'sfsi_plus_twitterIcon_order'		=> intval($sfsi_plus_twitterIcon_order),
		'sfsi_plus_youtubeIcon_order'		=> intval($sfsi_plus_youtubeIcon_order),
		'sfsi_plus_pinterestIcon_order'		=> intval($sfsi_plus_pinterestIcon_order),
		'sfsi_plus_instagramIcon_order'		=> intval($sfsi_plus_instagramIcon_order),
		'sfsi_plus_houzzIcon_order'			=> intval($sfsi_plus_houzzIcon_order),
		'sfsi_plus_okIcon_order'			=> intval($sfsi_plus_okIcon_order),
		'sfsi_plus_telegramIcon_order'			=> intval($sfsi_plus_telegramIcon_order),
		'sfsi_plus_vkIcon_order'			=> intval($sfsi_plus_vkIcon_order),
		'sfsi_plus_weiboIcon_order'			=> intval($sfsi_plus_weiboIcon_order),
		'sfsi_plus_wechatIcon_order'			=> intval($sfsi_plus_wechatIcon_order),
		'sfsi_plus_linkedinIcon_order'		=> intval($sfsi_plus_linkedinIcon_order),
		'sfsi_plus_custom_MouseOverTexts'	=> $sfsi_plus_custom_MouseOverTexts,
		'sfsi_plus_custom_social_hide'		=> $sfsi_plus_custom_social_hide,
		'sfsi_pplus_icons_suppress_errors'  => sanitize_text_field($sfsi_pplus_icons_suppress_errors),
		'sfsi_plus_icons_sharing_and_traffic_tips' => sanitize_text_field($sfsi_plus_icons_sharing_and_traffic_tips)
	);

	update_option('sfsi_plus_section5_options', serialize($up_option5));
	header('Content-Type: application/json');
	echo  json_encode(array("success"));
	exit;
}
/* save settings for section 6 */
add_action('wp_ajax_plus_updateSrcn6', 'sfsi_plus_options_updater6');
function sfsi_plus_options_updater6()
{
	if (!wp_verify_nonce($_POST['nonce'], "update_plus_step6")) {
		echo  json_encode(array("wrong_nonce"));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}
	$sfsi_plus_show_Onposts                = isset($_POST["sfsi_plus_show_Onposts"]) ? sanitize_text_field($_POST["sfsi_plus_show_Onposts"]) : 'no';
	$sfsi_plus_icons_postPositon           = isset($_POST["sfsi_plus_icons_postPositon"]) ? sanitize_text_field($_POST["sfsi_plus_icons_postPositon"]) : '';
	$sfsi_plus_icons_alignment             = isset($_POST["sfsi_plus_icons_alignment"]) ? sanitize_text_field($_POST["sfsi_plus_icons_alignment"]) : 'center-right';
	$sfsi_plus_textBefor_icons             = isset($_POST["sfsi_plus_textBefor_icons"]) ? sanitize_text_field($_POST["sfsi_plus_textBefor_icons"]) : '';
	$sfsi_plus_icons_DisplayCounts         = isset($_POST["sfsi_plus_icons_DisplayCounts"]) ? sanitize_text_field($_POST["sfsi_plus_icons_DisplayCounts"]) : 'no';
	/* post options */
	$up_option6 = array(
		'sfsi_plus_show_Onposts'		=> sanitize_text_field($sfsi_plus_show_Onposts),
		'sfsi_plus_icons_postPositon'	=> sanitize_text_field($sfsi_plus_icons_postPositon),
		'sfsi_plus_icons_alignment'		=> sanitize_text_field($sfsi_plus_icons_alignment),
		'sfsi_plus_textBefor_icons'		=> sanitize_text_field(stripslashes($sfsi_plus_textBefor_icons)),
		'sfsi_plus_icons_DisplayCounts'	=> sanitize_text_field($sfsi_plus_icons_DisplayCounts),
	);
	update_option('sfsi_plus_section6_options', serialize($up_option6));
	header('Content-Type: application/json');
	echo  json_encode(array("success"));
	exit;
}
/* save settings for section 7 */
add_action('wp_ajax_plus_updateSrcn7', 'sfsi_plus_options_updater7');
function sfsi_plus_options_updater7()
{
	if (!wp_verify_nonce($_POST['nonce'], "update_plus_step7")) {
		echo  json_encode(array("wrong_nonce"));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}
	$sfsi_plus_popup_text                    = 	isset($_POST["sfsi_plus_popup_text"]) ? sanitize_text_field($_POST["sfsi_plus_popup_text"]) : '';
	$sfsi_plus_popup_background_color        = 	isset($_POST["sfsi_plus_popup_background_color"])
		? sfsi_plus_sanitize_hex_color(
			$_POST["sfsi_plus_popup_background_color"]
		) : '#fffff';
	$sfsi_plus_popup_border_color            = 	isset($_POST["sfsi_plus_popup_border_color"])
		? sfsi_plus_sanitize_hex_color(
			$_POST["sfsi_plus_popup_border_color"]
		) : 'center-right';
	$sfsi_plus_popup_border_thickness        = 	isset($_POST["sfsi_plus_popup_border_thickness"]) ? sanitize_text_field($_POST["sfsi_plus_popup_border_thickness"]) : '';
	$sfsi_plus_popup_border_shadow           = 	isset($_POST["sfsi_plus_popup_border_shadow"]) ? sanitize_text_field($_POST["sfsi_plus_popup_border_shadow"]) : 'no';
	$sfsi_plus_popup_font                    = 	isset($_POST["sfsi_plus_popup_font"]) ? sanitize_text_field($_POST["sfsi_plus_popup_font"]) : '';
	$sfsi_plus_popup_fontSize                = 	isset($_POST["sfsi_plus_popup_fontSize"]) ? intval($_POST["sfsi_plus_popup_fontSize"]) : 'no';
	$sfsi_plus_popup_fontStyle               = 	isset($_POST["sfsi_plus_popup_fontStyle"]) ? sanitize_text_field($_POST["sfsi_plus_popup_fontStyle"]) : '';
	$sfsi_plus_popup_fontColor               = 	isset($_POST["sfsi_plus_popup_fontColor"]) ? sfsi_plus_sanitize_hex_color($_POST["sfsi_plus_popup_fontColor"]) : 'no';
	$sfsi_plus_Show_popupOn                  = 	isset($_POST["sfsi_plus_Show_popupOn"]) ? sanitize_text_field($_POST["sfsi_plus_Show_popupOn"]) : '';
	// if (isset($_POST["sfsi_plus_Show_popupOn_PageIDs"])) {
	// 	$sfsi_plus_Show_popupOn_PageIDs_arr = array();
	// 	foreach ($_POST["sfsi_plus_Show_popupOn_PageIDs"] as $index => $sfsi_plus_Show_popupOn_PageID) {
	// 		$sfsi_plus_Show_popupOn_PageIDs_arr[$index] = intval($sfsi_plus_Show_popupOn_PageID);
	// 	}
	// }
    $sfsi_plus_Show_popupOn_PageIDs          =  isset($_POST["sfsi_plus_Show_popupOn_PageIDs"]) ? serialize($_POST["sfsi_plus_Show_popupOn_PageIDs"]) : '';

	// $sfsi_plus_Show_popupOn_PageIDs          = 	isset($sfsi_plus_Show_popupOn_PageID)
	// 	? serialize($sfsi_plus_Show_popupOn_PageID)
	// 	: '';
	$sfsi_plus_Shown_pop                     = 	isset($_POST["sfsi_plus_Shown_pop"]) ? sanitize_text_field($_POST["sfsi_plus_Shown_pop"]) : '';
	$sfsi_plus_Shown_popupOnceTime           = 	isset($_POST["sfsi_plus_Shown_popupOnceTime"]) ? intval($_POST["sfsi_plus_Shown_popupOnceTime"]) : 'no';
	$sfsi_plus_Shown_popuplimitPerUserTime   = 	isset($_POST["sfsi_plus_Shown_popuplimitPerUserTime"])
		? sanitize_text_field(
			$_POST["sfsi_plus_Shown_popuplimitPerUserTime"]
		) : '';
	/* icons pop options */
	$up_option7 = array(
		'sfsi_plus_popup_text'				=> sanitize_text_field(stripslashes($sfsi_plus_popup_text)),
		'sfsi_plus_popup_font'				=> sanitize_text_field($sfsi_plus_popup_font),
		'sfsi_plus_popup_fontColor'			=> sfsi_plus_sanitize_hex_color($sfsi_plus_popup_fontColor),
		'sfsi_plus_popup_fontSize'			=> intval($sfsi_plus_popup_fontSize),
		'sfsi_plus_popup_fontStyle'			=> sanitize_text_field($sfsi_plus_popup_fontStyle),
		'sfsi_plus_popup_background_color'	=> sfsi_plus_sanitize_hex_color($sfsi_plus_popup_background_color),
		'sfsi_plus_popup_border_color'		=> sfsi_plus_sanitize_hex_color($sfsi_plus_popup_border_color),
		'sfsi_plus_popup_border_thickness'	=> intval($sfsi_plus_popup_border_thickness),
		'sfsi_plus_popup_border_shadow'		=> sanitize_text_field($sfsi_plus_popup_border_shadow),
		'sfsi_plus_Show_popupOn'			=> sanitize_text_field($sfsi_plus_Show_popupOn),
		'sfsi_plus_Show_popupOn_PageIDs'	=> $sfsi_plus_Show_popupOn_PageIDs,
		'sfsi_plus_Shown_pop'				=> sanitize_text_field($sfsi_plus_Shown_pop),
		'sfsi_plus_Shown_popupOnceTime'		=> intval($sfsi_plus_Shown_popupOnceTime),
		//'sfsi_plus_Shown_popuplimitPerUserTime'	=> $sfsi_plus_Shown_popuplimitPerUserTime,
	);
	update_option('sfsi_plus_section7_options', serialize($up_option7));
	header('Content-Type: application/json');
	echo  json_encode(array("success"));
	exit;
}
/* save settings for section 3 */

add_action('wp_ajax_plus_updateSrcn8', 'sfsi_plus_options_updater8');

function sfsi_plus_options_updater8()
{
	
	if (!wp_verify_nonce($_POST['nonce'], "update_plus_step8")) {
		echo  json_encode(array("wrong_nonce"));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}
	
	$sfsi_plus_show_via_widget		= isset($_POST["sfsi_plus_show_via_widget"]) ? sanitize_text_field($_POST["sfsi_plus_show_via_widget"]) : 'no';
	$sfsi_plus_float_on_page		= isset($_POST["sfsi_plus_float_on_page"]) ? sanitize_text_field($_POST["sfsi_plus_float_on_page"]) : 'no';
	$sfsi_plus_float_page_position	= isset($_POST["sfsi_plus_float_page_position"]) ? sanitize_text_field($_POST["sfsi_plus_float_page_position"]) : 'no';

	$sfsi_plus_icons_floatMargin_top     = isset($_POST["sfsi_plus_icons_floatMargin_top"]) ? intval($_POST["sfsi_plus_icons_floatMargin_top"]) : '';
	$sfsi_plus_icons_floatMargin_bottom  = isset($_POST["sfsi_plus_icons_floatMargin_bottom"]) ? intval($_POST["sfsi_plus_icons_floatMargin_bottom"]) : '';
	$sfsi_plus_icons_floatMargin_left    = isset($_POST["sfsi_plus_icons_floatMargin_left"]) ? intval($_POST["sfsi_plus_icons_floatMargin_left"]) : '';
	$sfsi_plus_icons_floatMargin_right   = isset($_POST["sfsi_plus_icons_floatMargin_right"]) ? intval($_POST["sfsi_plus_icons_floatMargin_right"]) : '';

	$sfsi_plus_place_item_manually	= isset($_POST["sfsi_plus_place_item_manually"]) ? sanitize_text_field($_POST["sfsi_plus_place_item_manually"]) : 'no';
	$sfsi_plus_place_item_gutenberg	= isset($_POST["sfsi_plus_place_item_gutenberg"]) ? sanitize_text_field($_POST["sfsi_plus_place_item_gutenberg"]) : 'no';
	$sfsi_plus_show_item_onposts	= isset($_POST["sfsi_plus_show_item_onposts"]) ? sanitize_text_field($_POST["sfsi_plus_show_item_onposts"]) : 'no';
	$sfsi_plus_display_button_type	= isset($_POST["sfsi_plus_display_button_type"]) ? sanitize_text_field($_POST["sfsi_plus_display_button_type"]) : 'standard_buttons';

	$sfsi_plus_post_icons_size		= isset($_POST["sfsi_plus_post_icons_size"]) ? intval($_POST["sfsi_plus_post_icons_size"]) : 40;
	$sfsi_plus_post_icons_spacing 	= isset($_POST["sfsi_plus_post_icons_spacing"]) ? intval($_POST["sfsi_plus_post_icons_spacing"]) : 5;
	$sfsi_plus_show_Onposts			= isset($_POST["sfsi_plus_show_Onposts"]) ? sanitize_text_field($_POST["sfsi_plus_show_Onposts"]) : 'no';
	$sfsi_plus_textBefor_icons  	= isset($_POST["sfsi_plus_textBefor_icons"]) ? sanitize_text_field($_POST["sfsi_plus_textBefor_icons"]) : 'Please follow and like us:';
	$sfsi_plus_icons_alignment  	= isset($_POST["sfsi_plus_icons_alignment"]) ? sanitize_text_field($_POST["sfsi_plus_icons_alignment"]) : 'center-right';
	$sfsi_plus_icons_DisplayCounts  = isset($_POST["sfsi_plus_icons_DisplayCounts"]) ? sanitize_text_field($_POST["sfsi_plus_icons_DisplayCounts"]) : 'no';
	$sfsi_plus_display_before_posts = isset($_POST["sfsi_plus_display_before_posts"]) ? sanitize_text_field($_POST["sfsi_plus_display_before_posts"]) : 'no';
	$sfsi_plus_display_after_posts  = isset($_POST["sfsi_plus_display_after_posts"]) ? sanitize_text_field($_POST["sfsi_plus_display_after_posts"]) : 'no';

	//$sfsi_plus_display_on_postspage 	= isset($_POST["sfsi_plus_display_on_postspage"]) ? sanitize_text_field( $_POST["sfsi_plus_display_on_postspage"] ): 'no'; 
	//$sfsi_plus_display_on_homepage    = isset($_POST["sfsi_plus_display_on_homepage"]) ? sanitize_text_field( $_POST["sfsi_plus_display_on_homepage"] ): 'no'; 

	$sfsi_plus_display_before_blogposts	= isset($_POST["sfsi_plus_display_before_blogposts"]) ? sanitize_text_field($_POST["sfsi_plus_display_before_blogposts"]) : 'no';
	$sfsi_plus_display_after_blogposts  = isset($_POST["sfsi_plus_display_after_blogposts"]) ? sanitize_text_field($_POST["sfsi_plus_display_after_blogposts"]) : 'no';
	$sfsi_plus_rectsub    				= isset($_POST["sfsi_plus_rectsub"]) ? sanitize_text_field($_POST["sfsi_plus_rectsub"]) : 'no';
	$sfsi_plus_rectfb    				= isset($_POST["sfsi_plus_rectfb"]) ? sanitize_text_field($_POST["sfsi_plus_rectfb"]) : 'no';
	$sfsi_plus_recttwtr    				= isset($_POST["sfsi_plus_recttwtr"]) ? sanitize_text_field($_POST["sfsi_plus_recttwtr"]) : 'no';
	$sfsi_plus_rectpinit    			= isset($_POST["sfsi_plus_rectpinit"]) ? sanitize_text_field($_POST["sfsi_plus_rectpinit"]) : 'no';
	$sfsi_plus_rectfbshare    			= isset($_POST["sfsi_plus_rectfbshare"]) ? sanitize_text_field($_POST["sfsi_plus_rectfbshare"]) : 'no';
	
	$sfsi_plus_responsive_icons_end_post = isset($_POST["sfsi_plus_responsive_icons_end_post"]) ? sanitize_text_field($_POST["sfsi_plus_responsive_icons_end_post"]) : 'no';
	$sfsi_plus_responsive_icons_default = array(
		"default_icons" => array(
			"facebook" => array("active" => "yes", "text" => "Share on Facebook", "url" => ""),
			"Twitter" => array("active" => "yes", "text" => "Tweet", "url" => ""),
			"Follow" => array("active" => "yes", "text" => "Follow us", "url" => "")
		),
		"settings" => array(
			"icon_size" => "Medium",
			"icon_width_type" => "Fully responsive",
			"icon_width_size" => 240,
			"edge_type" => "Round",
			"edge_radius" => 5,
			"style" => "Gradient",
			"margin" => 10,
			"text_align" => "Centered",
			"show_count" => "no",
			"counter_color" => "#aaaaaa",
			"counter_bg_color" => "#fff",
			"share_count_text" => "SHARES",
			"margin_above" => 10,
			"margin_below" => 10

		)
	);
	$sfsi_plus_responsive_icons = array();
	// var_dump($_POST['sfsi_plus_responsive_icons']);
	if (isset($_POST['sfsi_plus_responsive_icons']) && is_array($_POST['sfsi_plus_responsive_icons'])) {
		foreach ($_POST['sfsi_plus_responsive_icons'] as $key => $value) {
			if (!is_array($value)) {
				$sfsi_plus_responsive_icons[$key] = sanitize_text_field($value);
			} else {
				$sfsi_plus_responsive_icons[$key] = array();
				foreach ($value as $key2 => $value2) {
					if (!is_array($value2)) {
						$sfsi_plus_responsive_icons[$key][$key2] = sanitize_text_field($value2);
					} else {
						$sfsi_plus_responsive_icons[$key][$key2] = array();
						foreach ($value2 as $key3 => $value3) {
							if (!is_array($value3)) {
								$sfsi_plus_responsive_icons[$key][$key2][$key3] = sanitize_text_field($value3);
							}
						}
					}
				}
			}
		}
	}
	if (empty($sfsi_plus_responsive_icons)) {
		$sfsi_plus_responsive_icons = $sfsi_plus_responsive_icons_default;
	} else {
		if (!isset($sfsi_plus_responsive_icons['default_icons'])) {
			$sfsi_plus_responsive_icons["default_icons"] = $sfsi_plus_responsive_icons_default["default_icons"];
		}
		if (!isset($sfsi_plus_responsive_icons['settings'])) {
			$sfsi_plus_responsive_icons["settings"] = $sfsi_plus_responsive_icons_default["settings"];
		}
		foreach ($sfsi_plus_responsive_icons['default_icons'] as $key => $value) {
			foreach (array_keys($sfsi_plus_responsive_icons_default['default_icons']['facebook']) as $default_icon_key) {
				if (!isset($value[$default_icon_key])) {
					$sfsi_plus_responsive_icons["default_icons"][$key][$default_icon_key] = $sfsi_plus_responsive_icons_default['default_icons'][$key][$default_icon_key];
				} else {
					$sfsi_plus_responsive_icons["default_icons"][$key][$default_icon_key] = sanitize_text_field($sfsi_plus_responsive_icons["default_icons"][$key][$default_icon_key]);
				}
			}
		}

		foreach (array_keys($sfsi_plus_responsive_icons_default['settings']) as $setting_key) {
			if (!isset($sfsi_plus_responsive_icons["settings"][$setting_key])  || is_null($sfsi_plus_responsive_icons["settings"][$setting_key]) || $sfsi_plus_responsive_icons["settings"][$setting_key] === "") {
				$sfsi_plus_responsive_icons["settings"][$setting_key] = $sfsi_plus_responsive_icons_default['settings'][$setting_key];
			} else {
				$sfsi_plus_responsive_icons["settings"][$setting_key] = sanitize_text_field($sfsi_plus_responsive_icons["settings"][$setting_key]);
			}
		}
	}
	$up_option8 = array(
		'sfsi_plus_show_via_widget'			=> sanitize_text_field($sfsi_plus_show_via_widget),
		'sfsi_plus_float_on_page'			=> sanitize_text_field($sfsi_plus_float_on_page),
		'sfsi_plus_float_page_position'		=> sanitize_text_field($sfsi_plus_float_page_position),
		'sfsi_plus_icons_floatMargin_top'	=> intval($sfsi_plus_icons_floatMargin_top),
		'sfsi_plus_icons_floatMargin_bottom' => intval($sfsi_plus_icons_floatMargin_bottom),
		'sfsi_plus_icons_floatMargin_left'	=> intval($sfsi_plus_icons_floatMargin_left),
		'sfsi_plus_icons_floatMargin_right'	=> intval($sfsi_plus_icons_floatMargin_right),
		'sfsi_plus_place_item_manually'		=> sanitize_text_field($sfsi_plus_place_item_manually),
		'sfsi_plus_place_item_gutenberg'		=> sanitize_text_field($sfsi_plus_place_item_gutenberg),
		'sfsi_plus_show_item_onposts'		=> sanitize_text_field($sfsi_plus_show_item_onposts),
		'sfsi_plus_display_button_type'		=> sanitize_text_field($sfsi_plus_display_button_type),
		'sfsi_plus_post_icons_size'			=> intval($sfsi_plus_post_icons_size),
		'sfsi_plus_post_icons_spacing'		=> intval($sfsi_plus_post_icons_spacing),
		'sfsi_plus_show_Onposts'			=> sanitize_text_field($sfsi_plus_show_Onposts),
		'sfsi_plus_textBefor_icons'			=> sanitize_text_field(stripslashes($sfsi_plus_textBefor_icons)),
		'sfsi_plus_icons_alignment'			=> sanitize_text_field($sfsi_plus_icons_alignment),
		'sfsi_plus_icons_DisplayCounts'		=> sanitize_text_field($sfsi_plus_icons_DisplayCounts),
		'sfsi_plus_display_before_posts'	=> sanitize_text_field($sfsi_plus_display_before_posts),
		'sfsi_plus_display_after_posts'		=> sanitize_text_field($sfsi_plus_display_after_posts),

		//'sfsi_plus_display_on_postspage'	=> $sfsi_plus_display_on_postspage,
		//'sfsi_plus_display_on_homepage'	=> $sfsi_plus_display_on_homepage,

		'sfsi_plus_display_before_blogposts' => sanitize_text_field($sfsi_plus_display_before_blogposts),
		'sfsi_plus_display_after_blogposts'	=> sanitize_text_field($sfsi_plus_display_after_blogposts),
		'sfsi_plus_rectsub'					=> sanitize_text_field($sfsi_plus_rectsub),
		'sfsi_plus_rectfb'					=> sanitize_text_field($sfsi_plus_rectfb),
		'sfsi_plus_recttwtr'				=> sanitize_text_field($sfsi_plus_recttwtr),
		'sfsi_plus_rectpinit'				=> sanitize_text_field($sfsi_plus_rectpinit),
		'sfsi_plus_rectfbshare'				=> sanitize_text_field($sfsi_plus_rectfbshare),
		'sfsi_plus_responsive_icons_end_post'  =>$sfsi_plus_responsive_icons_end_post,
		'sfsi_plus_responsive_icons'        => $sfsi_plus_responsive_icons,


	);
	update_option('sfsi_plus_section8_options', serialize($up_option8));

	header('Content-Type: application/json');
	echo  json_encode(array("success"));
	exit;
}

/* save settings for section 8 */
add_action('wp_ajax_plus_updateSrcn9', 'sfsi_plus_options_updater9');
function sfsi_plus_options_updater9()
{
	if (!wp_verify_nonce($_POST['nonce'], "update_plus_step9")) {
		echo  json_encode(array("wrong_nonce"));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}
	$sfsi_plus_form_adjustment		= isset($_POST["sfsi_plus_form_adjustment"]) ? sanitize_text_field($_POST["sfsi_plus_form_adjustment"]) : 'yes';
	$sfsi_plus_form_height			= isset($_POST["sfsi_plus_form_height"]) ? intval($_POST["sfsi_plus_form_height"]) : '180';
	$sfsi_plus_form_width			= isset($_POST["sfsi_plus_form_width"]) ? intval($_POST["sfsi_plus_form_width"]) : '230';
	$sfsi_plus_form_border			= isset($_POST["sfsi_plus_form_border"]) ? sanitize_text_field($_POST["sfsi_plus_form_border"]) : 'no';
	$sfsi_plus_form_border_thickness = isset($_POST["sfsi_plus_form_border_thickness"]) ? intval($_POST["sfsi_plus_form_border_thickness"]) : '1';
	$sfsi_plus_form_border_color	= isset($_POST["sfsi_plus_form_border_color"]) ? sfsi_plus_sanitize_hex_color($_POST["sfsi_plus_form_border_color"]) : '#f3faf2';
	$sfsi_plus_form_background		= isset($_POST["sfsi_plus_form_background"]) ? sfsi_plus_sanitize_hex_color($_POST["sfsi_plus_form_background"]) : '#eff7f7';

	$sfsi_plus_form_heading_text	= isset($_POST["sfsi_plus_form_heading_text"]) ? sanitize_text_field($_POST["sfsi_plus_form_heading_text"]) : '';
	$sfsi_plus_form_heading_font	= isset($_POST["sfsi_plus_form_heading_font"]) ? sanitize_text_field($_POST["sfsi_plus_form_heading_font"]) : '';
	$sfsi_plus_form_heading_fontstyle = isset($_POST["sfsi_plus_form_heading_fontstyle"]) ? sanitize_text_field($_POST["sfsi_plus_form_heading_fontstyle"]) : '';
	$sfsi_plus_form_heading_fontcolor = isset($_POST["sfsi_plus_form_heading_fontcolor"]) ? sfsi_plus_sanitize_hex_color($_POST["sfsi_plus_form_heading_fontcolor"]) : '';
	$sfsi_plus_form_heading_fontsize = isset($_POST["sfsi_plus_form_heading_fontsize"]) ? intval($_POST["sfsi_plus_form_heading_fontsize"]) : '22';
	$sfsi_plus_form_heading_fontalign = isset($_POST["sfsi_plus_form_heading_fontalign"]) ? sanitize_text_field($_POST["sfsi_plus_form_heading_fontalign"]) : 'center';

	$sfsi_plus_form_field_text		= isset($_POST["sfsi_plus_form_field_text"]) ? sanitize_text_field($_POST["sfsi_plus_form_field_text"]) : '';
	$sfsi_plus_form_field_font		= isset($_POST["sfsi_plus_form_field_font"]) ? sanitize_text_field($_POST["sfsi_plus_form_field_font"]) : '';
	$sfsi_plus_form_field_fontstyle	= isset($_POST["sfsi_plus_form_field_fontstyle"]) ? sanitize_text_field($_POST["sfsi_plus_form_field_fontstyle"]) : '';
	$sfsi_plus_form_field_fontcolor	= isset($_POST["sfsi_plus_form_field_fontcolor"]) ? sfsi_plus_sanitize_hex_color($_POST["sfsi_plus_form_field_fontcolor"]) : '';
	$sfsi_plus_form_field_fontsize	= isset($_POST["sfsi_plus_form_field_fontsize"]) ? intval($_POST["sfsi_plus_form_field_fontsize"]) : '22';
	$sfsi_plus_form_field_fontalign	= isset($_POST["sfsi_plus_form_field_fontalign"]) ? sanitize_text_field($_POST["sfsi_plus_form_field_fontalign"]) : 'center';

	$sfsi_plus_form_button_text		= isset($_POST["sfsi_plus_form_button_text"]) ? sanitize_text_field($_POST["sfsi_plus_form_button_text"]) : 'Subscribe';
	$sfsi_plus_form_button_font		= isset($_POST["sfsi_plus_form_button_font"]) ? sanitize_text_field($_POST["sfsi_plus_form_button_font"]) : '';
	$sfsi_plus_form_button_fontstyle = isset($_POST["sfsi_plus_form_button_fontstyle"]) ? sanitize_text_field($_POST["sfsi_plus_form_button_fontstyle"]) : '';
	$sfsi_plus_form_button_fontcolor = isset($_POST["sfsi_plus_form_button_fontcolor"]) ? sfsi_plus_sanitize_hex_color($_POST["sfsi_plus_form_button_fontcolor"]) : '';
	$sfsi_plus_form_button_fontsize	= isset($_POST["sfsi_plus_form_button_fontsize"]) ? intval($_POST["sfsi_plus_form_button_fontsize"]) : '22';
	$sfsi_plus_form_button_fontalign = isset($_POST["sfsi_plus_form_button_fontalign"]) ? sanitize_text_field($_POST["sfsi_plus_form_button_fontalign"]) : 'center';
	$sfsi_plus_form_button_background = isset($_POST["sfsi_plus_form_button_background"]) ? sfsi_plus_sanitize_hex_color($_POST["sfsi_plus_form_button_background"]) : '#5a6570';

	/* icons pop options */
	$up_option9 = array(
		'sfsi_plus_form_adjustment'		 =>	sanitize_text_field($sfsi_plus_form_adjustment),
		'sfsi_plus_form_height'			 =>	intval($sfsi_plus_form_height),
		'sfsi_plus_form_width'			 =>	intval($sfsi_plus_form_width),
		'sfsi_plus_form_border'			 =>	sanitize_text_field($sfsi_plus_form_border),
		'sfsi_plus_form_border_thickness' =>	intval($sfsi_plus_form_border_thickness),
		'sfsi_plus_form_border_color'	 =>	sfsi_plus_sanitize_hex_color($sfsi_plus_form_border_color),
		'sfsi_plus_form_background'		 =>	sfsi_plus_sanitize_hex_color($sfsi_plus_form_background),

		'sfsi_plus_form_heading_text'	 =>	sanitize_text_field(stripslashes($sfsi_plus_form_heading_text)),
		'sfsi_plus_form_heading_font'	 =>	sanitize_text_field($sfsi_plus_form_heading_font),
		'sfsi_plus_form_heading_fontstyle' => sanitize_text_field($sfsi_plus_form_heading_fontstyle),
		'sfsi_plus_form_heading_fontcolor' => sfsi_plus_sanitize_hex_color($sfsi_plus_form_heading_fontcolor),
		'sfsi_plus_form_heading_fontsize' => intval($sfsi_plus_form_heading_fontsize),
		'sfsi_plus_form_heading_fontalign' => sanitize_text_field($sfsi_plus_form_heading_fontalign),

		'sfsi_plus_form_field_text'		=>	sanitize_text_field(stripslashes($sfsi_plus_form_field_text)),
		'sfsi_plus_form_field_font'		=>	sanitize_text_field($sfsi_plus_form_field_font),
		'sfsi_plus_form_field_fontstyle' =>	sanitize_text_field($sfsi_plus_form_field_fontstyle),
		'sfsi_plus_form_field_fontcolor' =>	sfsi_plus_sanitize_hex_color($sfsi_plus_form_field_fontcolor),
		'sfsi_plus_form_field_fontsize'	=>	intval($sfsi_plus_form_field_fontsize),
		'sfsi_plus_form_field_fontalign' =>	sanitize_text_field($sfsi_plus_form_field_fontalign),

		'sfsi_plus_form_button_text'	=>	sanitize_text_field(stripslashes($sfsi_plus_form_button_text)),
		'sfsi_plus_form_button_font'	=>	sanitize_text_field($sfsi_plus_form_button_font),
		'sfsi_plus_form_button_fontstyle' =>	sanitize_text_field($sfsi_plus_form_button_fontstyle),
		'sfsi_plus_form_button_fontcolor' =>	sfsi_plus_sanitize_hex_color($sfsi_plus_form_button_fontcolor),
		'sfsi_plus_form_button_fontsize' =>	intval($sfsi_plus_form_button_fontsize),
		'sfsi_plus_form_button_fontalign' =>	 sanitize_text_field($sfsi_plus_form_button_fontalign),
		'sfsi_plus_form_button_background' => sfsi_plus_sanitize_hex_color($sfsi_plus_form_button_background),
	);

	update_option('sfsi_plus_section9_options', serialize($up_option9));
	header('Content-Type: application/json');
	echo  json_encode(array("success"));
	exit;
}

/* upload custom icons images */
/* get counts for admin section */
function sfsi_plus_getCounts($for_resposive = false)
{
	$socialObj = new sfsi_plus_SocialHelper();

	$option4 = unserialize(get_option('sfsi_plus_section4_options', 'a:0:{}'));
	$sfsi_plus_section2_options = unserialize(get_option('sfsi_plus_section2_options', 'a:0:{}'));

	$scounts = array(
		'rss_count' => '',
		'email_count' => '',
		'fb_count' => '',
		'twitter_count' => '',
		'linkedIn_count' => '',
		'youtube_count' => '',
		'pin_count' => '',
		'share_count' => '',
		'houzz_count' => '',
		'telegram_count' => '',
		'vk_count' => '',
		'ok_count' => '',
		'weibo_count' => '',
		'wechat_count' => '',

	);
	/* get rss count */
	if (isset($option4['sfsi_plus_rss_manualCounts']) && !empty($option4['sfsi_plus_rss_manualCounts'])) {
		$scounts['rss_count'] =  $option4['sfsi_plus_rss_manualCounts'];
	}
	/* get email count */
	if (isset($option4['sfsi_plus_email_countsFrom']) && !empty($option4['sfsi_plus_email_countsFrom']) && $option4['sfsi_plus_email_countsFrom'] == "source") {
		$feed_id		= sanitize_text_field(get_option('sfsi_plus_feed_id', false));
		$feed_data		= $socialObj->SFSI_getFeedSubscriber($feed_id);

		$scounts['email_count'] = $socialObj->format_num($feed_data);
		if (empty($scounts['email_count'])) {
			$scounts['email_count'] = (string) "0";
		}
	} else {
		$scounts['email_count'] = $option4['sfsi_plus_email_manualCounts'];
	}


	/* get fb count */
	if (isset($option4['sfsi_plus_facebook_countsFrom']) && !empty($option4['sfsi_plus_facebook_countsFrom'])) {

		if ($option4['sfsi_plus_facebook_countsFrom'] == "likes") {
			$url = home_url();
			$fb_data = $socialObj->sfsi_get_fb($url);

			$scounts['fb_count'] = $socialObj->format_num($fb_data['like_count']);
		} else if ($option4['sfsi_plus_facebook_countsFrom'] == "followers") {
			$url = home_url();
			$fb_data = $socialObj->sfsi_get_fb($url);
			$scounts['fb_count'] = format_num($fb_data['share_count']);
			if (empty($scounts['fb_count'])) {
				$scounts['fb_count'] = (string) "0";
			}
		} else if ($option4['sfsi_plus_facebook_countsFrom'] == "mypage") {
			$url = $option4['sfsi_plus_facebook_mypageCounts'];
			$fb_data = $socialObj->sfsi_get_fb_pagelike($url);
			$scounts['fb_count'] = $fb_data;
		} else {
			$scounts['fb_count'] = $option4['sfsi_plus_facebook_manualCounts'];
		}
	}

	/* get twitter counts */
	if (isset($option4['sfsi_plus_twitter_countsFrom']) && !empty($option4['sfsi_plus_twitter_countsFrom']) && $option4['sfsi_plus_twitter_countsFrom'] == "source") {
		$twitter_user = $sfsi_plus_section2_options['sfsi_plus_twitter_followUserName'];
		$tw_settings = array(
			'sfsiplus_tw_consumer_key' => $option4['sfsiplus_tw_consumer_key'],
			'sfsiplus_tw_consumer_secret' => $option4['sfsiplus_tw_consumer_secret'],
			'sfsiplus_tw_oauth_access_token' => $option4['sfsiplus_tw_oauth_access_token'],
			'sfsiplus_tw_oauth_access_token_secret' => $option4['sfsiplus_tw_oauth_access_token_secret']
		);

		$followers = $socialObj->sfsi_get_tweets($twitter_user, $tw_settings);
		$scounts['twitter_count'] = $socialObj->format_num($followers);
	} else {
		$scounts['twitter_count'] = $option4['sfsi_plus_twitter_manualCounts'];
	}

	if($for_resposive==false){
		/* get linkedIn counts */
		if (isset($option4['sfsi_plus_linkedIn_countsFrom']) && !empty($option4['sfsi_plus_linkedIn_countsFrom']) && $option4['sfsi_plus_linkedIn_countsFrom'] == "follower") {
			$linkedIn_compay = $sfsi_plus_section2_options['sfsi_plus_linkedin_followCompany'];
			$linkedIn_compay = $option4['sfsi_plus_ln_company'];
			$ln_settings = array(
				'sfsi_plus_ln_api_key'			=> $option4['sfsi_plus_ln_api_key'],
				'sfsi_plus_ln_secret_key'		=> $option4['sfsi_plus_ln_secret_key'],
				'sfsi_plus_ln_oAuth_user_token'	=> $option4['sfsi_plus_ln_oAuth_user_token']
			);
			$followers = $socialObj->sfsi_getlinkedin_follower($linkedIn_compay, $ln_settings);
			$scounts['linkedIn_count'] = $socialObj->format_num($followers);
		} else {
			$scounts['linkedIn_count'] = $option4['sfsi_plus_linkedIn_manualCounts'];
		}

		/* get youtube counts */
		if (isset($option4['sfsi_plus_youtube_countsFrom']) && !empty($option4['sfsi_plus_youtube_countsFrom']) && $option4['sfsi_plus_youtube_countsFrom'] == "subscriber") {
			if (
				isset($option4['sfsi_plus_youtube_user'])
			) {
				$youtube_user = $option4['sfsi_plus_youtube_user'];

				$youtube_user = (isset($option4['sfsi_plus_youtube_user']) &&
					!empty($option4['sfsi_plus_youtube_user'])) ? $option4['sfsi_plus_youtube_user'] : 'SpecificFeeds';

				$followers = $socialObj->sfsi_get_youtube($youtube_user);
				$scounts['youtube_count'] = $socialObj->format_num($followers);
			} else {
				$scounts['youtube_count'] = 01;
			}
		} else {
			$scounts['youtube_count'] = $option4['sfsi_plus_youtube_manualCounts'];
		}
		/* get Pinterest counts */
		if (isset($option4['sfsi_plus_pinterest_countsFrom']) && !empty($option4['sfsi_plus_pinterest_countsFrom']) && $option4['sfsi_plus_pinterest_countsFrom'] == "pins") {
			$url = home_url();
			$pins = $socialObj->sfsi_get_pinterest($url);
			$scounts['pin_count'] = $socialObj->format_num($pins);
		} else {
			$scounts['pin_count'] = $option4['sfsi_plus_pinterest_manualCounts'];
		}
		/* get instagram count */
		if (isset($option4['sfsi_plus_instagram_countsFrom']) && !empty($option4['sfsi_plus_instagram_countsFrom']) && $option4['sfsi_plus_instagram_countsFrom'] == "followers") {
			$iuser_name = $option4['sfsi_plus_instagram_User'];
			$counts = $socialObj->sfsi_get_instagramFollowers($iuser_name);
			if (empty($counts)) {
				$scounts['instagram_count'] = (string) "0";
			} else {
				$scounts['instagram_count'] = $counts;
			}
		} else {
			$scounts['instagram_count'] = $option4['sfsi_plus_instagram_manualCounts'];
		}

		/* get instagram count */
		if (isset($option4['sfsi_plus_houzz_countsFrom']) && !empty($option4['sfsi_plus_houzz_countsFrom']) && $option4['sfsi_plus_houzz_countsFrom'] == "manual") {
			if (
				isset($option4['sfsi_plus_houzz_manualCounts'])
			) {
				$scounts['houzz_count'] =  $option4['sfsi_plus_houzz_manualCounts'];
			} else {
				$scounts['houzz_count'] = '20';
			}
		} elseif (!isset($option4['sfsi_plus_houzz_countsFrom'])) {
			$scounts['houzz_count'] = '20';
		}

	/* get rss count */
		if (isset($option4['sfsi_plus_telegram_manualCounts']) && !empty($option4['sfsi_plus_telegram_manualCounts'])) {
			$scounts['telegram_count'] =  $option4['sfsi_plus_telegram_manualCounts'];
		}

		if (isset($option4['sfsi_plus_vk_manualCounts']) && !empty($option4['sfsi_plus_vk_manualCounts'])) {
			$scounts['vk_count'] =  $option4['sfsi_plus_vk_manualCounts'];
		}
		if (isset($option4['sfsi_plus_ok_manualCounts']) && !empty($option4['sfsi_plus_ok_manualCounts'])) {
			$scounts['ok_count'] =  $option4['sfsi_plus_ok_manualCounts'];
		}
		if (isset($option4['sfsi_plus_weibo_manualCounts']) && !empty($option4['sfsi_plus_weibo_manualCounts'])) {
			$scounts['weibo_count'] =  $option4['sfsi_plus_weibo_manualCounts'];
		}
		if (isset($option4['sfsi_plus_wechat_manualCounts']) && !empty($option4['sfsi_plus_wechat_manualCounts'])) {
			$scounts['wechat_count'] =  $option4['sfsi_plus_wechat_manualCounts'];
		}
	}
	return $scounts;
	exit;
}

/* activate and remove footer credit link */
add_action('wp_ajax_plus_activateFooter', 'sfsiplusActivateFooter');
function sfsiplusActivateFooter()
{
	if (!wp_verify_nonce($_POST['nonce'], "active_plusfooter")) {
		echo  json_encode(array('res' => 'wrong_nonce'));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}

	update_option('sfsi_plus_footer_sec', 'yes');
	echo json_encode(array('res' => 'success'));
	exit;
}
 
add_action('wp_ajax_plus_removeFooter', 'sfsiplusremoveFooter');
function sfsiplusremoveFooter()
{
	if (!wp_verify_nonce($_POST['nonce'], "remove_plusfooter")) {
		echo  json_encode(array('res' => 'wrong_nonce'));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}

	update_option('sfsi_plus_footer_sec', 'no');
	echo json_encode(array('res' => 'success'));
	exit;
}

add_action('wp_ajax_getIconPreview', 'sfsiPlusGetIconPreview');
function sfsiPlusGetIconPreview()
{
	if (!wp_verify_nonce($_POST['nonce'], "plus_getIconPreview")) {
		echo  json_encode(array("wrong_nonce"));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}
	$iconname = isset($_POST) && isset($_POST['iconname']) ? sanitize_text_field($_POST['iconname']) : '';
	$iconValue = isset($_POST) && isset($_POST['iconValue']) ? sanitize_text_field($_POST['iconValue']) : '';
	echo '<img src="' . $iconname . "/icon_" . $iconValue . '.png" >';
	die;
}
add_action("wp_ajax_sfsiplus_curlerrornotification", "sfsiplus_curlerrornotification");
function sfsiPlusGetForm()
{
	if (!wp_verify_nonce($_POST['nonce'], "plus_getForm")) {
		echo  json_encode(array("wrong_nonce"));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}
	$heading = isset($_POST) && isset($_POST['heading']) ? sanitize_text_field($_POST['heading']) : '';
	$placeholder = isset($_POST) && isset($_POST['placeholder']) ? sanitize_text_field($_POST['placeholder']) : '';
	$button = isset($_POST) && isset($_POST['button']) ? sanitize_text_field($_POST['button']) : '';

	?>
	<xmp>
	    <div class="sfsi_subscribe_Popinner">
	        <form method="post">
	            <h5><?php echo $heading; ?></h5>
	            <div class="sfsi_subscription_form_field">
	                <input type="email" name="subscribe_email" placeholder="<?php echo $placeholder; ?>" value="" />
	            </div>
	            <div class="sfsi_subscription_form_field">
	                <input type="submit" name="subscribe" value="<?php echo $button; ?>" />
	            </div>
	        </form>
	    </div>
	</xmp>
	<?php
	die;
}

add_action("wp_ajax_sfsiPlus_notification_read", "sfsiPlus_notification_read");
function sfsiPlus_notification_read()
{
	if (!wp_verify_nonce($_POST['nonce'], "plus_notification_read")) {
		echo  json_encode(array("wrong_nonce"));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}
	update_option("sfsi_plus_show_notification", "no");
	echo "success";
	die;
}

add_action("wp_ajax_sfsiPlus_new_notification_read", "sfsiPlus_new_notification_read");
function sfsiPlus_new_notification_read()
{
	if (!wp_verify_nonce($_POST['nonce'], "plus_notification_read")) {
		echo  json_encode(array("wrong_nonce"));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}
	update_option("sfsi_plus_new_show_notification", "no");
	echo "success";
	die;
}

function sfsi_plus_sanitize_field($value)
{
	return strip_tags(trim($value));
}
//Sanitize color code
if (@!function_exists("sfsi_plus_sanitize_hex_color")) {
	function sfsi_plus_sanitize_hex_color($color)
	{
		if ('' === $color)
			return '';

		// 3 or 6 hex digits, or the empty string.
		if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color))
			return $color;
	}
}

function sfsi_plus_returningElement($element)
{
	return $element[0];
}

function sfsi_plus_get_keywordEnglish()
{
	$keywordFile    = SFSI_PLUS_DOCROOT . "/All_english_words_better_list.csv";
	$keywordData    = @file_get_contents($keywordFile);
	$keywordEnglish = array_map("str_getcsv", explode("\n", $keywordData));
	$keywordEnglish = array_map('array_filter', $keywordEnglish);
	$keywordEnglish = array_filter(array_map(sfsi_plus_returningElement($element), $keywordEnglish));
	return $keywordEnglish;
}

add_action('wp_ajax_sfsiplusbannerOption', 'sfsi_plus_bannerOption');
function sfsi_plus_bannerOption()
{
	error_reporting(1);
	if (!wp_verify_nonce($_POST['nonce'], "plus_sfsiplusbannerOption")) {
		echo  json_encode(array("wrong_nonce"));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}
	try {
		if (get_option("sfsi_plus_new_show_notification") == "yes") {

			$objThemeCheck  = new sfsi_plus_ThemeCheck();

			$domainname     = $objThemeCheck->sfsi_plus_getdomain(get_bloginfo('url'));

			// Get all themes data which incudes nobrainer 
			$themeDataArr	  = $objThemeCheck->sfsi_plus_get_themeData();
			// var_dump($themeDataArr);die();
			$matchFound  	  = false;
			foreach ($themeDataArr as $themeDataObj) :
				if (isset($themeDataObj->themeName) && strlen($themeDataObj->themeName) > 0) {
					$themeName 			= $themeDataObj->themeName;
					$noBrainerKeywords  = $themeDataObj->noBrainerKeywords;
					$separateKeywords   = $themeDataObj->separateKeywords;
					$negativeKeywords   = $themeDataObj->negativeKeywords;
					$noBrainerAndSeparateKeywords = array_merge($noBrainerKeywords, $separateKeywords);
					if ($objThemeCheck->sfsi_plus_check_type_of_websiteWithNoBrainerAndSeparateAndNegativeKeywords($themeName, $noBrainerKeywords, $separateKeywords, $noBrainerAndSeparateKeywords, $negativeKeywords, $domainname) == $themeName) {
						$matchFound = true;

						$themeName = strtolower($themeName);

						$objThemeCheck->sfsi_plus_bannereHtml(
							$themeDataObj->headline,
							$themeName,
							(SFSI_PLUS_PLUGURL) . 'images/website_theme/' . $themeName . '.png',
							$themeDataObj->bottomtext
						);
						$objThemeCheck->sfsi_plus_bannereHtml_main(
							$themeDataObj->headline,
							$themeName,
							(SFSI_PLUS_PLUGURL) . 'images/website_theme/' . $themeName . '.png',
							$themeDataObj->bottomtext
						);

						break;
					}
				}

			endforeach;
			if (!$matchFound) {
				foreach ($themeDataArr as $themeDataObj) {

					if (isset($themeDataObj->themeName) && strlen($themeDataObj->themeName) > 0) {

						$themeName          = $themeDataObj->themeName;
						$noBrainerKeywords  = $themeDataObj->noBrainerKeywords;
						$separateKeywords   = $themeDataObj->separateKeywords;
						$negativeKeywords   = $themeDataObj->negativeKeywords;
						$noBrainerAndSeparateKeywords = array_merge($noBrainerKeywords, $separateKeywords);


						if ($objThemeCheck->sfsi_plus_check_type_of_metaTitleWithNoBrainerAndSeparateAndNegativeKeywords($themeName, $noBrainerKeywords, $separateKeywords, $noBrainerAndSeparateKeywords, $negativeKeywords, $domainname) == $themeName) {
							$matchFound = true;

							$themeName = strtolower($themeName);

							$objThemeCheck->sfsi_plus_bannereHtml(
								$themeDataObj->headline,
								$themeName,
								SFSI_PLUS_PLUGURL . 'images/website_theme/' . $themeName . '.png',
								$themeDataObj->bottomtext
							);
							$objThemeCheck->sfsi_plus_bannereHtml_main(
								$themeDataObj->headline,
								$themeName,
								(SFSI_PLUS_PLUGURL) . 'images/website_theme/' . $themeName . '.png',
								$themeDataObj->bottomtext
							);
							break;
						}
					}
				}
			}
			if (!$matchFound) {
				foreach ($themeDataArr as $themeDataObj) {

					if (isset($themeDataObj->themeName) && strlen($themeDataObj->themeName) > 0) {

						$themeName          = $themeDataObj->themeName;
						$noBrainerKeywords  = $themeDataObj->noBrainerKeywords;
						$separateKeywords   = $themeDataObj->separateKeywords;
						$negativeKeywords   = $themeDataObj->negativeKeywords;
						$noBrainerAndSeparateKeywords = array_merge($noBrainerKeywords, $separateKeywords);


						if ($objThemeCheck->sfsi_plus_check_type_of_metaKeywordsWithNoBrainerAndSeparateAndNegativeKeywords($themeName, $noBrainerKeywords, $separateKeywords, $noBrainerAndSeparateKeywords, $negativeKeywords, $domainname) == $themeName) {
							$matchFound = true;

							$themeName = strtolower($themeName);

							$objThemeCheck->sfsi_plus_bannereHtml(
								$themeDataObj->headline,
								$themeName,
								SFSI_PLUS_PLUGURL . 'images/website_theme/' . $themeName . '.png',
								$themeDataObj->bottomtext
							);
							$objThemeCheck->sfsi_plus_bannereHtml_main(
								$themeDataObj->headline,
								$themeName,
								(SFSI_PLUS_PLUGURL) . 'images/website_theme/' . $themeName . '.png',
								$themeDataObj->bottomtext
							);
							break;
						}
					}
				}
			}
			if (!$matchFound) {
				foreach ($themeDataArr as $themeDataObj) {

					if (isset($themeDataObj->themeName) && strlen($themeDataObj->themeName) > 0) {

						$themeName          = $themeDataObj->themeName;
						$noBrainerKeywords  = $themeDataObj->noBrainerKeywords;
						$separateKeywords   = $themeDataObj->separateKeywords;
						$negativeKeywords   = $themeDataObj->negativeKeywords;
						$noBrainerAndSeparateKeywords = array_merge($noBrainerKeywords, $separateKeywords);


						if ($objThemeCheck->sfsi_plus_check_type_of_metaDescriptionWithNoBrainerAndSeparateAndNegativeKeywords($themeName, $noBrainerKeywords, $separateKeywords, $noBrainerAndSeparateKeywords, $negativeKeywords, $domainname) == $themeName) {
							$matchFound = true;

							$themeName = strtolower($themeName);

							$objThemeCheck->sfsi_plus_bannereHtml(
								$themeDataObj->headline,
								$themeName,
								SFSI_PLUS_PLUGURL . 'images/website_theme/' . $themeName . '.png',
								$themeDataObj->bottomtext
							);
							$objThemeCheck->sfsi_plus_bannereHtml_main(
								$themeDataObj->headline,
								$themeName,
								(SFSI_PLUS_PLUGURL) . 'images/website_theme/' . $themeName . '.png',
								$themeDataObj->bottomtext
							);
							break;
						}
					}
				}
			}
			echo '<script>
                jQuery("body").on("click", ".sfsi_plus_new_notification_cross_cat", function(){
                    SFSI.ajax({
                        url:sfsi_plus_ajax_object.ajax_url,
                        type:"post",
                        data: {action: "sfsiPlus_new_notification_read",nonce:"' . (wp_create_nonce('plus_notification_read')) . '"},
                        success:function(msg){
                            if(jQuery.trim(msg) == "success")
                            {
                                jQuery(".sfsi_plus_new_notification_cat").hide("fast");
                            }
                        }
                    });
                });
        </script>';
		}
	} catch (Exception $e) {
		// var_dump($e);die();
	}
	die;
}

add_action('wp_ajax_sfsiplusOfflineChatMessage', 'sfsi_plus_OfflineChatMessage');
function sfsi_plus_OfflineChatMessage()
{
	if (!wp_verify_nonce($_POST['nonce'], "plus_sfsiplusOfflineChatMessage")) {
		echo  json_encode(array("wrong_nonce"));
		exit;
	}
	if (!current_user_can('manage_options')) {
		echo json_encode(array('res' => 'not allowed'));
		die();
	}
	error_reporting(0);
	$email = isset($_POST) && isset($_POST['email']) ? sanitize_text_field($_POST['email']) : '';
	$message = isset($_POST) && isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';
	$body = "<table><tr><th>Site:</th><td>" . home_url() . "</td></tr><tr><th>Email:</th><td>" . $email . "</td></tr><tr><th>Message:</th><td>" . $message . "</td></tr></table>";
	$sent = wp_mail('help@ultimatelysocial.com', "New question from user", $body, array('Content-Type: text/html; charset=UTF-8'));
	if (isset($sent) && (true === $sent)) {
		echo "success";
	} else {
		echo "failure";
	}
	die();
}


/* save settings for save export */
add_action('wp_ajax_save_export', 'sfsi_plus_save_export');
function sfsi_plus_save_export()
{
	$option1 =  unserialize(get_option('sfsi_plus_section1_options', false));
	$option2 =  unserialize(get_option('sfsi_plus_section2_options', false));
	$option3 =  unserialize(get_option('sfsi_plus_section3_options', false));
	$option4 =  unserialize(get_option('sfsi_plus_section4_options', false));
	$option5 =  unserialize(get_option('sfsi_plus_section5_options', false));
	$option6 =  unserialize(get_option('sfsi_plus_section6_options', false));
	$option7 =  unserialize(get_option('sfsi_plus_section7_options', false));
	$option8 =  unserialize(get_option('sfsi_plus_section8_options', false));
	$option9 =  unserialize(get_option('sfsi_plus_section9_options', false));
	$sfsi_plus_new_show_notification = get_option("sfsi_plus_new_show_notification");
	$sfsi_plus_show_notification = get_option("sfsi_plus_show_notification");
	$sfsi_plus_footer_sec = get_option("sfsi_plus_footer_sec");
	$sfsi_plus_new_show_notification = get_option("sfsi_plus_new_show_notification");
	$sfsi_plus_pluginVersion = get_option("sfsi_plus_pluginVersion");
	$sfsi_plus_show_Setting_mobile_notification = get_option("sfsi_plus_show_Setting_mobile_notification");
	$sfsi_plus_installDate = get_option("sfsi_plus_installDate");
	
	/* size and spacing of icons */
	$save_export_options = array(
		'option1'				=> $option1,
		'option2'				=> $option2,
		'option3'				=> $option3,
		'option4'				=> $option4,
		'option5'				=> $option5,
		'option6'				=> $option6,
		'option7'				=> $option7,
		'option8'				=> $option8,
		'option9'				=> $option9,	
		'sfsi_plus_new_show_notification' => $sfsi_plus_new_show_notification,	
		'sfsi_plus_show_notification' => $sfsi_plus_show_notification,
		'sfsi_plus_footer_sec' => $sfsi_plus_footer_sec,
		'sfsi_plus_new_show_notification' => $sfsi_plus_new_show_notification,
		'sfsi_plus_pluginVersion' => $sfsi_plus_pluginVersion,
		'sfsi_plus_show_Setting_mobile_notification' => $sfsi_plus_show_Setting_mobile_notification,
		'sfsi_plus_installDate' => $sfsi_plus_installDate
	);

	$json = json_encode($save_export_options);
	header('Content-disposition: attachment; filename=file.json');
	header('Content-type: application/json');
	echo $json;
	exit;
}

add_action('wp_ajax_worker_plugin','sfsi_plus_worker_plugin');

function sfsi_plus_worker_plugin(){
	if ( !wp_verify_nonce( $_POST['nonce'], "plus_worker_plugin")) {
		echo  json_encode(array("wrong_nonce")); exit;
	}
	if(!current_user_can('manage_options')){ echo json_encode(array('res'=>'not allowed'));die(); }
	
	ob_start();
	update_option("sfsi_plus_premium_install_link",$_POST["premium_url"]);
	update_option("sfsi_plus_premium_install_licence",$_POST["licence"]);
	update_option("sfsi_plus_install_premium","yes");
	include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	wp_cache_flush();
	$plugin_slug= "sfsi_worker_premium_installer/sfsi_worker_premium_installer.php";
	$upgrader = new Plugin_Upgrader();
	
	// sfsi_plus_get_all_options();
	if (sfsi_plus_worker_plugin_installed($plugin_slug)) {
		$installed = true;
	}else{
		$installed = $upgrader->install('https://shopify-js-bucket.s3.ap-south-1.amazonaws.com/sfsi_worker_premium_installer-0.0.1.zip');
	}
	$activate = activate_plugin($plugin_slug);
	$data = ob_get_flush();
	ob_clean();
	echo  json_encode(array("installed"=>$installed,"plugin_info"=>$upgrader->plugin_info(),"html_message"=>$data,"activate"=>$activate));
	wp_die();	
}
/* install newsletter */
add_action('wp_ajax_install_newsletter', 'sfsi_plus_install_newsletter');
function sfsi_plus_install_newsletter()
{
	wp_cache_flush();
	$plugin_slug= "newsletter-email-mailing-list/newsletter-email-mailing-list.php";
	if (sfsi_plus_worker_plugin_installed($plugin_slug)) {
		$installed = true;
	}else{
		$plugin_name = "newsletter-email-mailing-list";
		$plugin_url = "https://downloads.wordpress.org/plugin/".$plugin_name.".latest-stable.zip";
		$upgrader = new Plugin_Upgrader();
		// var_dump($upgrader);
		try{
			$installed = $upgrader->install($plugin_url);
		}catch(\Exception $e){
			var_dump($e);
		}
	}
	$activate = activate_plugin($plugin_slug);
	$data = ob_get_flush();
	ob_clean();
	$json = json_encode(array("installed"=>$installed,"activate"=>$activate));
	echo  $json;

	// echo $jsons;
	exit;
}
if(!function_exists("sfsi_plus_worker_plugin_installed")){
  function sfsi_plus_worker_plugin_installed($slug)
  {

    if (!function_exists('get_plugins')) {
      require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    $all_plugins = get_plugins();
   if (!empty($all_plugins[$slug])) {
      return true;
    } else {
      return false;
    }
  }
}

if(!function_exists("sfsi_plus_worker_plugin_installed")){
  function sfsi_plus_worker_plugin_installed($slug)
  {

    if (!function_exists('get_plugins')) {
      require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    $all_plugins = get_plugins();
   	if (!empty($all_plugins[$slug])) {
      return true;
    } else {
      return false;
    }
  }
}
add_action('wp_ajax_sfsi_plus_get_feed_id', 'sfsi_plus_get_feed_id');

function sfsi_plus_get_feed_id()
{
    if (!wp_verify_nonce($_POST['nonce'], "sfsi_plus_get_feed_id")) {
        echo  json_encode(array('res' => 'wrong_nonce'));
        exit;
    }
    if (!current_user_can('manage_options')) {
        echo  json_encode(array("res"=>"Failed",'message'=>"You should be admin to take this action"));
        exit;
    }
	$feed_id = sanitize_text_field(get_option('sfsi_plus_feed_id'));
    if(""==$feed_id){
        $sfsiId = SFSI_PLUS_getFeedUrl();
        update_option('sfsi_plus_feed_id'        , sanitize_text_field($sfsiId->feed_id));
        update_option('sfsi_plus_redirect_url'   , sanitize_text_field($sfsiId->redirect_url));
        echo json_encode(array("res"=>"success",'feed_id'=>$sfsiId->feed_id));
        sfsi_getverification_code();
        exit;
    }else{
        echo json_encode(array("res"=>"success","feed_id"=>$feed_id));
        exit;
    }
    wp_die();
}

add_action('wp_ajax_sfsi_plus_installDate', 'sfsi_plus_installDate');
function sfsi_plus_installDate()
{
    $sfsi_plus_installDate_value   = isset($_POST["sfsi_plus_installDate"]) ? $_POST["sfsi_plus_installDate"] : '';
    update_option('sfsi_plus_installDate',  $sfsi_plus_installDate_value);
    echo  json_encode(array("success"));
    exit;
}

add_action('wp_ajax_sfsi_plus_currentDate', 'sfsi_plus_currentDate');
function sfsi_plus_currentDate()
{
    $sfsi_plus_currentDate_value   = isset($_POST["sfsi_plus_currentDate"]) ? $_POST["sfsi_plus_currentDate"] : '';
    update_option('sfsi_plus_currentDate',  $sfsi_plus_currentDate_value);
    echo  json_encode(array("success"));
    exit;
}

add_action('wp_ajax_sfsi_plus_showNextBannerDate', 'sfsi_plus_showNextBannerDate');
function sfsi_plus_showNextBannerDate()
{
    $sfsi_plus_showNextBannerDate_value   = isset($_POST["sfsi_plus_showNextBannerDate"]) ? $_POST["sfsi_plus_showNextBannerDate"] : '';
    update_option('sfsi_plus_showNextBannerDate',  $sfsi_plus_showNextBannerDate_value);
    echo  json_encode(array("success"));
    exit;
}

add_action('wp_ajax_sfsi_plus_cycleDate', 'sfsi_plus_cycleDate');
function sfsi_plus_cycleDate()
{
    $sfsi_plus_cycleDate_value   = isset($_POST["sfsi_plus_cycleDate"]) ? $_POST["sfsi_plus_cycleDate"] : '';
    update_option('sfsi_plus_cycleDate',  $sfsi_plus_cycleDate_value);
    echo  json_encode(array("success"));
    exit;
}

add_action('wp_ajax_sfsi_plus_loyaltyDate', 'sfsi_plus_loyaltyDate');
function sfsi_plus_loyaltyDate()
{
    $sfsi_plus_loyaltyDate_value   = isset($_POST["sfsi_plus_loyaltyDate"]) ? $_POST["sfsi_plus_loyaltyDate"] : '';
    update_option('sfsi_plus_loyaltyDate',  $sfsi_plus_loyaltyDate_value);
    echo  json_encode(array("success"));
    exit;
}

add_action('wp_ajax_sfsi_plus_banner_global_pinterest', 'sfsi_plus_banner_global_pinterest');
function sfsi_plus_banner_global_pinterest()
{
    $sfsi_plus_banner_global_pinterest_value   = isset($_POST["sfsi_plus_banner_global_pinterest"]) ? $_POST["sfsi_plus_banner_global_pinterest"] : '';
    $sfsi_plus_banner_global_pinterest = unserialize(get_option('sfsi_plus_banner_global_pinterest', false));
    $sfsi_plus_banner_global_pinterest['timestamp'] = $sfsi_plus_banner_global_pinterest_value;
    update_option('sfsi_plus_banner_global_pinterest',  serialize($sfsi_plus_banner_global_pinterest));
    echo  json_encode(array("success"));
    exit;
}

add_action('wp_ajax_sfsi_plus_banner_global_firsttime_offer', 'sfsi_plus_banner_global_firsttime_offer');
function sfsi_plus_banner_global_firsttime_offer()
{
    $sfsi_plus_banner_global_firsttime_offer_value   = isset($_POST["sfsi_plus_banner_global_firsttime_offer"]) ? $_POST["sfsi_plus_banner_global_firsttime_offer"] : '';
    $sfsi_plus_banner_global_firsttime_offer = unserialize(get_option('sfsi_plus_banner_global_firsttime_offer', false));
    $sfsi_plus_banner_global_firsttime_offer['timestamp'] = $sfsi_plus_banner_global_firsttime_offer_value;
    update_option('sfsi_plus_banner_global_firsttime_offer',  serialize($sfsi_plus_banner_global_firsttime_offer));
    echo  json_encode(array("success"));
    exit;
}

add_action('wp_ajax_sfsi_plus_banner_global_social', 'sfsi_plus_banner_global_social');
function sfsi_plus_banner_global_social()
{
    $sfsi_plus_banner_global_social_value   = isset($_POST["sfsi_plus_banner_global_social"]) ? $_POST["sfsi_plus_banner_global_social"] : '';
    $sfsi_plus_banner_global_social = unserialize(get_option('sfsi_plus_banner_global_social', false));
    $sfsi_plus_banner_global_social['timestamp'] = $sfsi_plus_banner_global_social_value;
    update_option('sfsi_plus_banner_global_social',  serialize($sfsi_plus_banner_global_social));
    echo  json_encode(array("success"));
    exit;
}

add_action('wp_ajax_sfsi_plus_banner_global_load_faster', 'sfsi_plus_banner_global_load_faster');
function sfsi_plus_banner_global_load_faster()
{
    $sfsi_plus_banner_global_load_faster_value   = isset($_POST["sfsi_plus_banner_global_load_faster"]) ? $_POST["sfsi_plus_banner_global_load_faster"] : '';
    $sfsi_plus_banner_global_load_faster = unserialize(get_option('sfsi_plus_banner_global_load_faster', false));
    $sfsi_plus_banner_global_load_faster['timestamp'] = $sfsi_plus_banner_global_load_faster_value;
    update_option('sfsi_plus_banner_global_load_faster',  serialize($sfsi_plus_banner_global_load_faster));
    echo  json_encode(array("success"));
    exit;
}

add_action('wp_ajax_sfsi_plus_banner_global_shares', 'sfsi_plus_banner_global_shares');
function sfsi_plus_banner_global_shares()
{
    $sfsi_plus_banner_global_shares_value   = isset($_POST["sfsi_plus_banner_global_shares"]) ? $_POST["sfsi_plus_banner_global_shares"] : '';
    $sfsi_plus_banner_global_shares = unserialize(get_option('sfsi_plus_banner_global_shares', false));
    $sfsi_plus_banner_global_shares['timestamp'] = $sfsi_plus_banner_global_shares_value;
    update_option('sfsi_plus_banner_global_shares',  serialize($sfsi_plus_banner_global_shares));
    echo  json_encode(array("success"));
    exit;
}


add_action('wp_ajax_sfsi_plus_banner_global_gdpr', 'sfsi_plus_banner_global_gdpr');
function sfsi_plus_banner_global_gdpr()
{
    $sfsi_plus_banner_global_gdpr_value   = isset($_POST["sfsi_plus_banner_global_gdpr"]) ? $_POST["sfsi_plus_banner_global_gdpr"] : '';
    $sfsi_plus_banner_global_gdpr = unserialize(get_option('sfsi_plus_banner_global_gdpr', false));
    $sfsi_plus_banner_global_gdpr['timestamp'] = $sfsi_plus_banner_global_gdpr_value;
    update_option('sfsi_plus_banner_global_gdpr',  serialize($sfsi_plus_banner_global_gdpr));
    echo  json_encode(array("success"));
    exit;
}

add_action('wp_ajax_sfsi_plus_banner_global_http', 'sfsi_plus_banner_global_http');
function sfsi_plus_banner_global_http()
{
    $sfsi_plus_banner_global_http_value   = isset($_POST["sfsi_plus_banner_global_http"]) ? $_POST["sfsi_plus_banner_global_http"] : '';
    $sfsi_plus_banner_global_http = unserialize(get_option('sfsi_plus_banner_global_http', false));
    $sfsi_plus_banner_global_http['timestamp'] = $sfsi_plus_banner_global_http_value;
    update_option('sfsi_plus_banner_global_http',  serialize($sfsi_plus_banner_global_http));
    echo  json_encode(array("success"));
    exit;
}

add_action('wp_ajax_sfsi_plus_banner_global_upgrade', 'sfsi_plus_banner_global_upgrade');
function sfsi_plus_banner_global_upgrade()
{
    $sfsi_plus_banner_global_upgrade_value   = isset($_POST["sfsi_plus_banner_global_upgrade"]) ? $_POST["sfsi_plus_banner_global_upgrade"] : '';
    $sfsi_plus_banner_global_upgrade = unserialize(get_option('sfsi_plus_banner_global_upgrade', false));
    $sfsi_plus_banner_global_upgrade['timestamp'] = $sfsi_plus_banner_global_upgrade_value;
    update_option('sfsi_plus_banner_global_upgrade',  serialize($sfsi_plus_banner_global_upgrade));
    echo  json_encode(array("success"));
    exit;
}




?>