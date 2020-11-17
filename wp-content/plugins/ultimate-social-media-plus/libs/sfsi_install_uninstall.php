<?php
function sfsi_plus_update_plugin()
{
	if($feed_id = sanitize_text_field(get_option('sfsi_plus_feed_id')))
	{
		if(is_numeric($feed_id))
		{
			$sfsiId = SFSI_PLUS_updateFeedUrl();
			update_option('sfsi_plus_feed_id'		, sanitize_text_field($sfsiId->feed_id));
			update_option('sfsi_plus_redirect_url'	, sanitize_text_field($sfsiId->redirect_url));
		}
		if(""==$feed_id){
			$sffeeds = SFSI_PLUS_getFeedUrl();
			update_option('sfsi_plus_feed_id'		, sanitize_text_field($sffeeds->feed_id));
			update_option('sfsi_plus_redirect_url'	, sanitize_text_field($sffeeds->redirect_url));
		}
	}

	$lastversion = get_option("sfsi_plus_pluginVersion");
	$sfsi_banner_error_version = ['3.39','3.40','3.41'];

	//Install version
	update_option("sfsi_plus_pluginVersion", "3.44");	
	if(!get_option('sfsi_plus_serverphpVersionnotification'))
	{
		add_option("sfsi_plus_serverphpVersionnotification", "yes");
	}
	/* show notification on about mobile setting */
	if(!get_option('sfsi_plus_show_Setting_mobile_notification'))
	{
		add_option("sfsi_plus_show_Setting_mobile_notification", "yes");
	}
	/* show premium notification */
	if(!get_option('sfsi_plus_show_premium_notification'))
	{
		add_option("sfsi_plus_show_premium_notification", "yes");
	}
	if(!get_option('sfsi_plus_show_premium_cumulative_count_notification'))
	{
		add_option("sfsi_plus_show_premium_cumulative_count_notification", "yes");
	}	
	/*show notification*/
	if(!get_option('sfsi_plus_show_notification'))
	{
		add_option("sfsi_plus_show_notification", "yes");
	}
	/* show new notification*/
	if(!get_option('sfsi_plus_new_show_notification'))
	{
		add_option("sfsi_plus_new_show_notification", "no");
	}

	 
	// var_dump(get_option('sfsi_plus_custom_icons'),'yes');
		// die();

	if(!get_option('sfsi_plus_custom_icons'))
	{
		update_option("sfsi_plus_custom_icons", "yes");
	}   
	add_option('sfsi_plus_footer_sec','no');
	
	if(in_array($lastversion,$sfsi_banner_error_version)){


        $sfsi_plus_dismiss_sharecount = array(
            'show_banner'     => "yes",
            'timestamp' => ""
        );
        update_option("sfsi_plus_dismiss_sharecount", serialize($sfsi_plus_dismiss_sharecount));

        $sfsi_plus_dismiss_google_analytic = array(
            'show_banner'     => "yes",
            'timestamp' => ""
        );
        update_option("sfsi_plus_dismiss_google_analytic", serialize($sfsi_plus_dismiss_google_analytic));


        $sfsi_plus_banner_global_firsttime_offer = array(
            'met_criteria'     => "yes",
            'is_active' => "yes",
            'timestamp' => ""
        );
        update_option("sfsi_plus_banner_global_firsttime_offer", serialize($sfsi_plus_banner_global_firsttime_offer));

        $sfsi_plus_dismiss_gdpr = array(
            'show_banner'     => "yes",
            'timestamp' => ""
        );
        update_option("sfsi_plus_dismiss_gdpr", serialize($sfsi_plus_dismiss_gdpr));

        $sfsi_plus_dismiss_optimization = array(
            'show_banner'     => "yes",
            'timestamp' => ""
        );
        update_option("sfsi_plus_dismiss_optimization", serialize($sfsi_plus_dismiss_optimization));

        $sfsi_plus_dismiss_gallery = array(
            'show_banner'     => "yes",
            'timestamp' => ""
        );
        update_option("sfsi_plus_dismiss_gallery", serialize($sfsi_plus_dismiss_gallery));
        $sfsi_plus_banner_global_upgrade = array(
            'met_criteria'     => "no",
            'banner_appeared' => "no",
            'is_active' => "no",
            'timestamp' => ""
        );
        update_option("sfsi_plus_banner_global_upgrade", serialize($sfsi_plus_banner_global_upgrade));

        $sfsi_plus_banner_global_http = array(
            'met_criteria'     => "no",
            'banner_appeared' => "no",
            'is_active' => "no",
            'timestamp' => ""
        );
        update_option("sfsi_plus_banner_global_http", serialize($sfsi_plus_banner_global_http));

        $sfsi_plus_banner_global_gdpr = array(
            'met_criteria'     => "no",
            'banner_appeared' => "no",
            'is_active' => "no",
            'timestamp' => ""
        );
        update_option("sfsi_plus_banner_global_gdpr", serialize($sfsi_plus_banner_global_gdpr));

        $sfsi_plus_banner_global_shares = array(
            'met_criteria'     => "no",
            'banner_appeared' => "no",
            'is_active' => "no",
            'timestamp' => ""
        );
        update_option("sfsi_plus_banner_global_shares", serialize($sfsi_plus_banner_global_shares));

        $sfsi_plus_banner_global_load_faster = array(
            'met_criteria'     => "no",
            'banner_appeared' => "no",
            'is_active' => "no",
            'timestamp' => ""
        );
        update_option("sfsi_plus_banner_global_load_faster", serialize($sfsi_plus_banner_global_load_faster));

        $sfsi_plus_banner_global_social = array(
            'met_criteria'     => "no",
            'banner_appeared' => "no",
            'is_active' => "no",
            'timestamp' => ""
        );
        update_option("sfsi_plus_banner_global_social", serialize($sfsi_plus_banner_global_social));

        $sfsi_plus_banner_global_pinterest = array(
            'met_criteria'     => "no",
            'banner_appeared' => "no",
            'is_active' => "no",
            'timestamp' => ""
        );
	    update_option("sfsi_plus_banner_global_pinterest", serialize($sfsi_plus_banner_global_pinterest));
	    update_option('sfsi_plus_currentDate',  date('Y-m-d h:i:s'));
	    update_option('sfsi_plus_showNextBannerDate', '15 day');
	    update_option('sfsi_plus_cycleDate',  "180 day");
	    update_option('sfsi_plus_loyaltyDate',  "180 day");
	    sfsi_plus_check_banner();
	}else{
	    $sfsi_plus_dismiss_sharecount = unserialize(get_option('sfsi_plus_dismiss_sharecount'));
	    if (!isset($sfsi_plus_dismiss_sharecount) || empty($sfsi_plus_dismiss_sharecount)) {
	        $sfsi_plus_dismiss_sharecount = array(
	            'show_banner'     => "yes",
	            'timestamp' => ""
	        );
	        update_option("sfsi_plus_dismiss_sharecount", serialize($sfsi_plus_dismiss_sharecount));
	    }

	    $sfsi_plus_dismiss_google_analytic = unserialize(get_option('sfsi_plus_dismiss_google_analytic'));
	    if (!isset($sfsi_plus_dismiss_google_analytic) || empty($sfsi_plus_dismiss_google_analytic)) {
	        $sfsi_plus_dismiss_google_analytic = array(
	            'show_banner'     => "yes",
	            'timestamp' => ""
	        );
	        update_option("sfsi_plus_dismiss_google_analytic", serialize($sfsi_plus_dismiss_google_analytic));
	    }


	    $sfsi_plus_banner_global_firsttime_offer = unserialize(get_option('sfsi_plus_banner_global_firsttime_offer'));
	    if (!isset($sfsi_plus_banner_global_firsttime_offer) || empty($sfsi_plus_banner_global_firsttime_offer) || !isset($sfsi_plus_banner_global_firsttime_offer["is_active"])) {
	        $sfsi_plus_banner_global_firsttime_offer = array(
	            'met_criteria'     => "yes",
	            'is_active' => "yes",
	            'timestamp' => ""
	        );
	        update_option("sfsi_plus_banner_global_firsttime_offer", serialize($sfsi_plus_banner_global_firsttime_offer));
	    }

	    $sfsi_plus_dismiss_gdpr = unserialize(get_option('sfsi_plus_dismiss_gdpr'));
	    if (!isset($sfsi_plus_dismiss_gdpr) || empty($sfsi_plus_dismiss_gdpr)) {
	        $sfsi_plus_dismiss_gdpr = array(
	            'show_banner'     => "yes",
	            'timestamp' => ""
	        );
	        update_option("sfsi_plus_dismiss_gdpr", serialize($sfsi_plus_dismiss_gdpr));
	    }

	    $sfsi_plus_dismiss_optimization = unserialize(get_option('sfsi_plus_dismiss_optimization'));
	    if (!isset($sfsi_plus_dismiss_optimization) || empty($sfsi_plus_dismiss_optimization)) {
	        $sfsi_plus_dismiss_optimization = array(
	            'show_banner'     => "yes",
	            'timestamp' => ""
	        );
	        update_option("sfsi_plus_dismiss_optimization", serialize($sfsi_plus_dismiss_optimization));
	    }

	    $sfsi_plus_dismiss_gallery = unserialize(get_option('sfsi_plus_dismiss_gallery'));
	    if (!isset($sfsi_plus_dismiss_gallery) || empty($sfsi_plus_dismiss_gallery)) {
	        $sfsi_plus_dismiss_gallery = array(
	            'show_banner'     => "yes",
	            'timestamp' => ""
	        );
	        update_option("sfsi_plus_dismiss_gallery", serialize($sfsi_plus_dismiss_gallery));
		}
		
		$sfsi_plus_dismiss_woocommerce = unserialize(get_option('sfsi_plus_dismiss_woocommerce'));
	    if (!isset($sfsi_plus_dismiss_woocommerce) || empty($sfsi_plus_dismiss_woocommerce)) {
	        $sfsi_plus_dismiss_woocommerce = array(
	            'show_banner'     => "yes",
	            'timestamp' => ""
	        );
	        update_option("sfsi_plus_dismiss_woocommerce", serialize($sfsi_plus_dismiss_woocommerce));
	    }

		$sfsi_plus_dismiss_twitter = unserialize(get_option('sfsi_plus_dismiss_twitter'));
	    if (!isset($sfsi_plus_dismiss_twitter) || empty($sfsi_plus_dismiss_twitter)) {
	        $sfsi_plus_dismiss_twitter = array(
	            'show_banner'     => "yes",
	            'timestamp' => ""
	        );
	        update_option("sfsi_plus_dismiss_twitter", serialize($sfsi_plus_dismiss_twitter));
	    }

	    $sfsi_plus_banner_global_upgrade =  unserialize(get_option('sfsi_plus_banner_global_upgrade'));
	    if (!isset($sfsi_plus_banner_global_upgrade) || empty($sfsi_plus_banner_global_upgrade) || !isset($sfsi_plus_banner_global_upgrade["is_active"])) {
	        $sfsi_plus_banner_global_upgrade = array(
	            'met_criteria'     => "no",
	            'banner_appeared' => "no",
	            'is_active' => "no",
	            'timestamp' => ""
	        );
	        update_option("sfsi_plus_banner_global_upgrade", serialize($sfsi_plus_banner_global_upgrade));
	    }
	    $sfsi_plus_banner_global_http =  unserialize(get_option('sfsi_plus_banner_global_http'));
	    if (!isset($sfsi_plus_banner_global_http) || empty($sfsi_plus_banner_global_http) || !isset($sfsi_plus_banner_global_http["is_active"])) {
	        $sfsi_plus_banner_global_http = array(
	            'met_criteria'     => "no",
	            'banner_appeared' => "no",
	            'is_active' => "no",
	            'timestamp' => ""
	        );
	        update_option("sfsi_plus_banner_global_http", serialize($sfsi_plus_banner_global_http));
	    }
	    $sfsi_plus_banner_global_gdpr =  unserialize(get_option('sfsi_plus_banner_global_gdpr'));
	    if (!isset($sfsi_plus_banner_global_gdpr) || empty($sfsi_plus_banner_global_gdpr)) {
	        $sfsi_plus_banner_global_gdpr = array(
	            'met_criteria'     => "no",
	            'banner_appeared' => "no",
	            'is_active' => "no",
	            'timestamp' => ""
	        );
	        update_option("sfsi_plus_banner_global_gdpr", serialize($sfsi_plus_banner_global_gdpr));
	    }
	    $sfsi_plus_banner_global_shares =  unserialize(get_option('sfsi_plus_banner_global_shares'));
	    if (!isset($sfsi_plus_banner_global_shares) || empty($sfsi_plus_banner_global_shares) ||!isset($sfsi_plus_banner_global_shares["is_active"])) {
	        $sfsi_plus_banner_global_shares = array(
	            'met_criteria'     => "no",
	            'banner_appeared' => "no",
	            'is_active' => "no",
	            'timestamp' => ""
	        );
	        update_option("sfsi_plus_banner_global_shares", serialize($sfsi_plus_banner_global_shares));
	    }
	    $sfsi_plus_banner_global_load_faster =  unserialize(get_option('sfsi_plus_banner_global_load_faster'));
	    if (!isset($sfsi_plus_banner_global_load_faster) || empty($sfsi_plus_banner_global_load_faster) || !isset($sfsi_plus_banner_global_load_faster["is_active"])) {
	        $sfsi_plus_banner_global_load_faster = array(
	            'met_criteria'     => "no",
	            'banner_appeared' => "no",
	            'is_active' => "no",
	            'timestamp' => ""
	        );
	        update_option("sfsi_plus_banner_global_load_faster", serialize($sfsi_plus_banner_global_load_faster));
	    }
	    $sfsi_plus_banner_global_social =  unserialize(get_option('sfsi_plus_banner_global_social'));
	    if (!isset($sfsi_plus_banner_global_social) || empty($sfsi_plus_banner_global_social) || !isset($sfsi_plus_banner_global_load_faster["is_active"])) {
	        $sfsi_plus_banner_global_social = array(
	            'met_criteria'     => "no",
	            'banner_appeared' => "no",
	            'is_active' => "no",
	            'timestamp' => ""
	        );
	        update_option("sfsi_plus_banner_global_social", serialize($sfsi_plus_banner_global_social));
	    }
	    $sfsi_plus_banner_global_pinterest =  unserialize(get_option('sfsi_plus_banner_global_pinterest'));
	    if (!isset($sfsi_plus_banner_global_pinterest) || empty($sfsi_plus_banner_global_pinterest) || !isset($sfsi_plus_banner_global_pinterest["is_active"])) {
	        $sfsi_plus_banner_global_pinterest = array(
	            'met_criteria'     => "no",
	            'banner_appeared' => "no",
	            'is_active' => "no",
	            'timestamp' => ""
	        );
	        update_option("sfsi_plus_banner_global_pinterest", serialize($sfsi_plus_banner_global_pinterest));
	    }
	}
    
	/* subscription form */
    $options9 = array('sfsi_plus_form_adjustment'=>'yes',
        'sfsi_plus_form_height'=>'180',
        'sfsi_plus_form_width' =>'230',
        'sfsi_plus_form_border'=>'yes',
        'sfsi_plus_form_border_thickness'=>'1',
        'sfsi_plus_form_border_color'=>'#b5b5b5',
        'sfsi_plus_form_background'=>'#ffffff',
		
        'sfsi_plus_form_heading_text'=>'Get new posts by email:',
        'sfsi_plus_form_heading_font'=>'Helvetica,Arial,sans-serif',
        'sfsi_plus_form_heading_fontstyle'=>'bold',
        'sfsi_plus_form_heading_fontcolor'=>'#000000',
        'sfsi_plus_form_heading_fontsize'=>'16',
        'sfsi_plus_form_heading_fontalign'=>'center',
		
		'sfsi_plus_form_field_text'=>'Enter your email',
        'sfsi_plus_form_field_font'=>'Helvetica,Arial,sans-serif',
        'sfsi_plus_form_field_fontstyle'=>'normal',
        'sfsi_plus_form_field_fontcolor'=>'#000000',
        'sfsi_plus_form_field_fontsize'=>'14',
        'sfsi_plus_form_field_fontalign'=>'center',
		
		'sfsi_plus_form_button_text'=>'Subscribe',
        'sfsi_plus_form_button_font'=>'Helvetica,Arial,sans-serif',
        'sfsi_plus_form_button_fontstyle'=>'bold',
        'sfsi_plus_form_button_fontcolor'=>'#000000',
        'sfsi_plus_form_button_fontsize'=>'16',
        'sfsi_plus_form_button_fontalign'=>'center',
        'sfsi_plus_form_button_background'=>'#dedede',
    );
	add_option('sfsi_plus_section9_options',  serialize($options9));
	
	$sfsi_plus_instagram_sf_count = unserialize(get_option('sfsi_plus_instagram_sf_count',false));
	/*Extra important options*/
	if($sfsi_plus_instagram_sf_count === false){
		$sfsi_plus_instagram_sf_count = array(
			"date_sf" => strtotime(date("Y-m-d")),
			"date_instagram" => strtotime(date("Y-m-d")),
			"sfsi_plus_sf_count" => "",
			"sfsi_plus_instagram_count" => ""
		);
		add_option('sfsi_plus_instagram_sf_count',  serialize($sfsi_plus_instagram_sf_count));
	}else{
		if(isset($sfsi_plus_instagram_sf_count["date"])) {
			$sfsi_plus_instagram_sf_count["date_sf"] = $sfsi_plus_instagram_sf_count["date"];
			$sfsi_plus_instagram_sf_count["date_instagram"] = $sfsi_plus_instagram_sf_count["date"];
			update_option('sfsi_plus_instagram_sf_count',  serialize($sfsi_plus_instagram_sf_count));
		}
	}
	
	/*Float Icon setting*/
	$option8 = unserialize(get_option('sfsi_plus_section8_options',false));
	if(isset($option8) && !empty($option8) && !isset($option8['sfsi_plus_icons_floatMargin_top']))
	{
		$option8['sfsi_plus_icons_floatMargin_top'] = '';
		$option8['sfsi_plus_icons_floatMargin_bottom'] = '';
		$option8['sfsi_plus_icons_floatMargin_left'] = '';
		$option8['sfsi_plus_icons_floatMargin_right'] = '';
		update_option('sfsi_plus_section8_options', serialize($option8));
	}
	if(isset($option8) && !empty($option8))
	{
		if(!isset($option8['sfsi_plus_rectpinit']))
		{
			$option8['sfsi_plus_rectpinit'] = 'no';
		}
		if(!isset($option8['sfsi_plus_rectfbshare']))
		{
			$option8['sfsi_plus_rectfbshare'] = 'no';
		}
		update_option('sfsi_plus_section8_options', serialize($option8));
	}
	
	/*Language icons*/
	$option5 =  unserialize(get_option('sfsi_plus_section5_options',false));
	
	if(isset($option5) && !empty($option5))
	{
		if(!isset($option5['sfsi_plus_follow_icons_language'])){
			$option5['sfsi_plus_follow_icons_language']   = 'Follow_en_US';			
		}
		if(!isset($option5['sfsi_plus_facebook_icons_language'])){
			$option5['sfsi_plus_facebook_icons_language']   = 'Visit_us_en_US';			
		}
		if(!isset($option5['sfsi_plus_twitter_icons_language'])){
			$option5['sfsi_plus_twitter_icons_language']   = 'Visit_us_en_US';			
		}
		if(!isset($option5['sfsi_plus_icons_language'])){
			$option5['sfsi_plus_icons_language']   = 'en_US';			
		}								
		if(!isset($option5['sfsi_plus_premium_size_box'])){
			$option5['sfsi_plus_premium_size_box'] = 'no';			
		}
		if(!isset($option5['sfsi_plus_custom_social_hide'])){
			$option5['sfsi_plus_custom_social_hide'] = 'no';			
		}
		if(!isset($option5['sfsi_plus_telegramIcon_order'])){
			$option5['sfsi_plus_telegramIcon_order'] = '22';			
		}
		if(!isset($option5['sfsi_plus_vkIcon_order'])){
			$option5['sfsi_plus_vkIcon_order'] = '23';			
		}
		if(!isset($option5['sfsi_plus_okIcon_order'])){
			$option5['sfsi_plus_okIcon_order'] = '24';			
		}
		if(!isset($option5['sfsi_plus_weiboIcon_order'])){
			$option5['sfsi_plus_weiboIcon_order'] = '25';			
		}
		if(!isset($option5['sfsi_plus_wechatIcon_order'])){
			$option5['sfsi_plus_wechatIcon_order'] = '26';			
		}
		
        if(!isset($option5['sfsi_icons_suppress_errors'])){
        	
        	$sup_errors = "no";
        	$sup_errors_banner_dismissed = true;

        	if(defined('WP_DEBUG') && false != WP_DEBUG){
            	$sup_errors = 'yes';
            	$sup_errors_banner_dismissed = false;
        	}

            $option5['sfsi_icons_suppress_errors'] = $sup_errors;
            update_option('sfsi_error_reporting_notice_dismissed',$sup_errors_banner_dismissed);            
        }				
		update_option('sfsi_plus_section5_options', serialize($option5));
	}
	
	/*Youtube Channelid settings*/
	$option4 = unserialize(get_option('sfsi_plus_section4_options',false));
	if(isset($option4) && !empty($option4) && !isset($option4['sfsi_plus_youtube_channelId']))
	{
		$option4['sfsi_plus_youtube_channelId'] = '';
		update_option('sfsi_plus_section4_options', serialize($option4));

		if (!isset($option4['sfsi_plus_round_counts'])) {
            $option4['sfsi_plus_round_counts'] = "no";
        }
        if (!isset($option4['sfsi_plus_original_counts'])) {
            $option4['sfsi_plus_original_counts'] = "no";
        }
        if (!isset($option4['sfsi_plus_responsive_share_count'])) {
            $option4['sfsi_plus_responsive_share_count'] = "no";
        }
	}
	/* section1 */
	$option1 = unserialize(get_option('sfsi_plus_section1_options',false));
	if(isset($option1) && !empty($option1) )
	{
		if(!isset($option1['sfsi_plus_ok_display'])){
			$option1['sfsi_plus_ok_display'] = 'no';
		}
		if(!isset($option1['sfsi_plus_telegram_display'])){
			$option1['sfsi_plus_telegram_display'] = 'no';
		}
		if(!isset($option1['sfsi_plus_vk_display'])){
			$option1['sfsi_plus_vk_display'] = 'no';
		}
		if(!isset($option1['sfsi_plus_weibo_display'])){
			$option1['sfsi_plus_weibo_display'] = 'no';
		}
		if(!isset($option1['sfsi_plus_wechat_display'])){
			$option1['sfsi_plus_wechat_display'] = 'no';
		}
		 
		
		update_option('sfsi_plus_section1_options', serialize($option1));
	}
	/* section2 */
	$option2 = unserialize(get_option('sfsi_plus_section2_options',false));
	if(isset($option2) && !empty($option2) && !isset($option2['sfsi_plus_premium_email_box']))
	{
		$option2['sfsi_plus_premium_email_box'] = 'no';
		$option2['sfsi_plus_premium_facebook_box'] = 'no';
		$option2['sfsi_plus_premium_twitter_box'] = 'no';

		if(!isset($option2['sfsi_plus_mouseover_effect_type'])){
			$option2['sfsi_plus_mouseover_effect_type'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_okVisit_url'])){
			$option2['sfsi_plus_okVisit_url'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_okSubscribe_option'])){
			$option2['sfsi_plus_okSubscribe_option'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_okSubscribe_userid'])){
			$option2['sfsi_plus_okSubscribe_userid'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_okLike_option'])){
			$option2['sfsi_plus_okLike_option'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_telegramShare_option'])){
			$option2['sfsi_plus_telegramShare_option'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_telegramMessage_option'])){
			$option2['sfsi_plus_telegramMessage_option'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_telegram_message'])){
			$option2['sfsi_plus_telegram_message'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_telegram_username'])){
			$option2['sfsi_plus_telegram_username'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_vkVisit_option'])){
			$option2['sfsi_plus_vkVisit_option'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_vkShare_option'])){
			$option2['sfsi_plus_vkShare_option'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_vkLike_option'])){
			$option2['sfsi_plus_vkLike_option'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_vkFollow_option'])){
			$option2['sfsi_plus_vkFollow_option'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_vkVisit_url'])){
			$option2['sfsi_plus_vkVisit_url'] = 'no';			
		}
		if(!isset($option2['gvfergergergergregergrg'])){
			$option2['gvfergergergergregergrg'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_vkFollow_url'])){
			$option2['sfsi_plus_vkFollow_url'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_weiboVisit_option'])){
			$option2['sfsi_plus_weiboVisit_option'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_weiboShare_option'])){
			$option2['sfsi_plus_weiboShare_option'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_weiboLike_option'])){
			$option2['sfsi_plus_weiboLike_option'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_weiboVisit_url'])){
			$option2['sfsi_plus_weiboVisit_url'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_wechatFollow_option'])){
			$option2['sfsi_plus_wechatFollow_option'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_wechatShare_option'])){
			$option2['sfsi_plus_wechatShare_option'] = 'no';			
		}
		if(!isset($option2['sfsi_plus_wechat_scan_image'])){
			$option2['sfsi_plus_wechat_scan_image'] = 'no';			
		}
		
		update_option('sfsi_plus_section2_options', serialize($option2));
	}
	/* section3 */
	$option3 = unserialize(get_option('sfsi_plus_section3_options',false));
	if(isset($option3) && !empty($option3))
	{		
		if(!isset($option3['sfsi_plus_mouseover_effect_type'])){
			$option3['sfsi_plus_mouseover_effect_type'] = 'same_icons';			
		}
		if(!isset($option3['mouseover_other_icons_transition_effect'])){
			$option3['mouseover_other_icons_transition_effect'] = 'flip';			
		}

		if(!isset($option3['sfsi_plus_premium_icons_design_box'])){
			$option3['sfsi_plus_premium_icons_design_box'] = 'no';			
		}

		update_option('sfsi_plus_section3_options', serialize($option3));
	}
	/* section4 */
	$option4 = unserialize(get_option('sfsi_plus_section4_options',false));
	if(isset($option4) && !empty($option4) && !isset($option4['sfsi_plus_premium_count_box']))
	{
		$option4['sfsi_plus_premium_count_box'] = 'no';
		update_option('sfsi_plus_section4_options', serialize($option4));
	}
	/* section7 */
	$option7 = unserialize(get_option('sfsi_plus_section7_options',false));
	if(isset($option7) && !empty($option7) && !isset($option7['sfsi_plus_premium_popup_box']))
	{
		$option7['sfsi_plus_premium_popup_box'] = 'no';
		update_option('sfsi_plus_section7_options', serialize($option7));
	}
	/* section8 */
	$option8 = unserialize(get_option('sfsi_plus_section8_options',false));
	if(isset($option8) && !empty($option8) && !isset($option8['sfsi_plus_show_premium_placement_box']))
	{
		$option8['sfsi_plus_show_premium_placement_box'] = 'no';
		update_option('sfsi_plus_section8_options', serialize($option8));
	}
	$option4 = unserialize(get_option('sfsi_plus_section4_options',false));
	if(isset($option4) && !empty($option4) && !isset($option4['sfsi_plus_instagram_clientid']))
	{
		$option4['sfsi_plus_instagram_clientid'] = '';
		$option4['sfsi_plus_instagram_appurl'] 	 = '';
		$option4['sfsi_plus_instagram_token']    = '';
		update_option('sfsi_plus_section4_options', serialize($option4));
	}
	if(isset($option8["sfsi_plus_display_button_type"]) && (""==$option8["sfsi_plus_display_button_type"] || "yes"==$option8["sfsi_plus_display_button_type"]) ) {
		$option8["sfsi_plus_display_button_type"] = "standard_buttons";
	}
	sfsi_plus_remove_google();
    // Add this removed in version 2.9.3, removing values from section 1 & section 6 & setting notice display value
    sfsi_plus_was_displaying_addthis();
    //deleteing as we dont need curl now.
    delete_option("sfsi_plus_curlErrorNotices");
	delete_option("sfsi_plus_curlErrorMessage");
	
	update_option('sfsi_plus_currentDate',  date('Y-m-d h:i:s'));
	update_option('sfsi_plus_showNextBannerDate', '14 day');
    // if (get_option('sfsi_plus_showNextBannerDate') == "21 day") {
    //     update_option('sfsi_plus_showNextBannerDate', '14 day');
    // }
    update_option('sfsi_plus_cycleDate',  "180 day");
	update_option('sfsi_plus_loyaltyDate',  "180 day");
	if (!get_option('sfsi_plus_fb_count')) {
        add_option("sfsi_plus_fb_count", "");
    }
	
}
function sfsi_plus_activate_plugin()
{
    /* check for CURL enable at server */
    add_option('sfsi_plus_plugin_do_activation_redirect', true);
    // sfsi_plus_curl_enable_notice();	
    
    if(!get_option('sfsi_plus_new_show_notification'))
	{
		add_option("sfsi_plus_new_show_notification", "yes");
	}
    
    if(!get_option('sfsi_plus_show_premium_cumulative_count_notification'))
	{
		add_option("sfsi_plus_show_premium_cumulative_count_notification", "yes");
	}    
	// var_dump(get_option('sfsi_plus_custom_icons'),'no');

	if(!get_option('sfsi_plus_custom_icons'))
	{
		add_option("sfsi_plus_custom_icons", "no");
	}          

    $options1=array('sfsi_plus_rss_display'=>'yes',
          'sfsi_plus_email_display'=>'yes',
          'sfsi_plus_facebook_display'=>'yes',
          'sfsi_plus_twitter_display'=>'yes',
          'sfsi_plus_pinterest_display'=>'no',
	  	  'sfsi_plus_instagram_display'=>'no',
          'sfsi_plus_linkedin_display'=>'no',
          'sfsi_plus_youtube_display'=>'no',
		  'sfsi_plus_houzz_display'=>'no',
		  'sfsi_plus_ok_display'=>'no',
		  'sfsi_plus_telegram_display'=>'no',
		  'sfsi_plus_vk_display'=>'no',
		  'sfsi_plus_weibo_display'=>'no',
		  'sfsi_plus_wechat_display'=>'no',
          'sfsi_custom_display'=>'',
          'sfsi_custom_files'=>'',
          'sfsi_plus_premium_icons_box' =>'yes',
          );
	add_option('sfsi_plus_section1_options',  serialize($options1));
    
	if(get_option('sfsi_plus_feed_id') && get_option('sfsi_plus_redirect_url'))
	{
		$sffeeds["feed_id"] 		= sanitize_text_field(get_option('sfsi_plus_feed_id'));
		$sffeeds["redirect_url"] 	= sanitize_text_field(get_option('sfsi_plus_redirect_url'));
		$sffeeds = (object)$sffeeds;
	}
    else
	{
		$sffeeds = SFSI_PLUS_getFeedUrl();
	}
	
    /* Links and icons  options */	 
    $options2=array('sfsi_plus_rss_url'=>sfsi_plus_get_bloginfo('rss2_url'),
        'sfsi_plus_rss_icons'=>'subscribe', 
        'sfsi_plus_email_url'=>$sffeeds->redirect_url,
        'sfsi_plus_facebookPage_option'=>'no',
        'sfsi_plus_facebookPage_url'=>'',
        'sfsi_plus_facebookLike_option'=>'yes',
        'sfsi_plus_facebookShare_option'=>'yes',
        'sfsi_plus_twitter_followme'=>'no',
        'sfsi_plus_twitter_followUserName'=>'',
        'sfsi_plus_twitter_aboutPage'=>'yes',
		'sfsi_plus_twitter_page'=>'no',
        'sfsi_plus_twitter_pageURL'=>'',
        'sfsi_plus_twitter_aboutPageText'=>'Hey, check out this cool site I found: www.yourname.com #Topic via@my_twitter_name',
        'sfsi_plus_youtube_pageUrl'=>'',
        'sfsi_plus_youtube_page'=>'no',
        'sfsi_plus_youtube_follow'=>'no',
		'sfsi_plus_youtubeusernameorid'=>'name',
		'sfsi_plus_ytube_chnlid'=>'',
		'sfsi_plus_ytube_user'=>'',
        'sfsi_plus_pinterest_page'=>'no',
        'sfsi_plus_pinterest_pageUrl'=>'',
        'sfsi_plus_pinterest_pingBlog'=>'',
	 	'sfsi_plus_instagram_page'=>'no',
        'sfsi_plus_instagram_pageUrl'=>'',
		'sfsi_plus_houzz_pageUrl'=>'',
		'sfsi_plus_linkedin_page'=>'no',
        'sfsi_plus_linkedin_pageURL'=>'',
        'sfsi_plus_linkedin_follow'=>'no',
        'sfsi_plus_linkedin_followCompany'=>'',
        'sfsi_plus_linkedin_SharePage'=>'yes',
        'sfsi_plus_linkedin_recommendBusines'=>'no',
        'sfsi_plus_linkedin_recommendCompany'=>'',
		'sfsi_plus_linkedin_recommendProductId'=>'',
		'sfsi_plus_okVisit_option'			=> 'no',
        'sfsi_plus_okVisit_url'				=> '',
        'sfsi_plus_okSubscribe_option'		=> 'no',
        'sfsi_plus_okSubscribe_userid'		=> '',
        'sfsi_plus_okLike_option'			=> 'no',
        'sfsi_plus_wechatFollow_option'		=> 'no',
        'sfsi_plus_wechatShare_option'		=> 'no',

        'sfsi_plus_telegramShare_option'    => 'no',
        'sfsi_plus_telegramMessage_option'  => 'no',
        'sfsi_plus_telegram_message'   		=> '',
        'sfsi_plus_telegram_username'    => '',
        'sfsi_plus_CustomIcon_links'=>'',
        'sfsi_plus_premium_email_box'=>'yes',
        'sfsi_plus_premium_facebook_box'=>'yes',
        'sfsi_plus_premium_twitter_box'=>'yes',
        );
	add_option('sfsi_plus_section2_options',  serialize($options2));
    
	/* Design and animation option  */
	$options3= array(
		'sfsi_plus_mouseOver'				=>'no',
        'sfsi_plus_mouseOver_effect'		=>'fade_in',
		'sfsi_plus_mouseover_effect_type' 	=> 'same_icons',			
		'mouseover_other_icons_transition_effect' => 'flip',
        'sfsi_plus_shuffle_icons'			=>'no',
        'sfsi_plus_shuffle_Firstload'		=>'no',
        'sfsi_plus_shuffle_interval'		=>'no',
        'sfsi_plus_shuffle_intervalTime'	=>'',                              
        'sfsi_plus_actvite_theme'			=>'default',
        'sfsi_plus_premium_icons_design_box'=>'yes',        
        );

	add_option('sfsi_plus_section3_options',  serialize($options3));
	
	/* display counts options */         
    $options4=array('sfsi_plus_display_counts'=>'no',
        'sfsi_plus_email_countsDisplay'=>'no',
        'sfsi_plus_email_countsFrom'=>'source',
        'sfsi_plus_email_manualCounts'=>'20',
        'sfsi_plus_rss_countsDisplay'=>'no',
        'sfsi_plus_rss_manualCounts'=>'20',
        'sfsi_plus_facebook_PageLink'=>'',
        'sfsi_plus_facebook_countsDisplay'=>'no',
        'sfsi_plus_facebook_countsFrom'=>'manual',
        'sfsi_plus_facebook_manualCounts'=>'20',
        'sfsi_plus_twitter_countsDisplay'=>'no',
        'sfsi_plus_twitter_countsFrom'=>'manual',
        'sfsi_plus_twitter_manualCounts'=>'20',
        'sfsi_plus_google_api_key'=>'',   
        'sfsi_plus_linkedIn_countsDisplay'=>'no',
        'sfsi_plus_linkedIn_countsFrom'=>'manual',
        'sfsi_plus_linkedIn_manualCounts'=>'20',
        'sfsi_plus_ln_api_key'=>'',
        'sfsi_plus_ln_secret_key'=>'',
        'sfsi_plus_ln_oAuth_user_token'=>'',
        'sfsi_plus_ln_company'=>'',
		'sfsi_plus_youtube_user'=>'',
		'sfsi_plus_youtube_channelId'=>'',
		'sfsi_plus_youtube_countsDisplay'=>'no',
        'sfsi_plus_youtube_countsFrom'=>'manual',
        'sfsi_plus_youtube_manualCounts'=>'20',
        'sfsi_plus_pinterest_countsDisplay'=>'no',
        'sfsi_plus_pinterest_countsFrom'=>'manual',
        'sfsi_plus_pinterest_manualCounts'=>'20',
        'sfsi_plus_pinterest_user'=>'',
        'sfsi_plus_pinterest_board'=>'',
		'sfsi_plus_instagram_countsFrom'=>'manual',
		'sfsi_plus_instagram_countsDisplay'=>'no',
		'sfsi_plus_instagram_manualCounts'=>'20',
		'sfsi_plus_instagram_User'=>'',
		'sfsi_plus_instagram_clientid'=>'',
		'sfsi_plus_instagram_appurl'  =>'',
		'sfsi_plus_instagram_token'   =>'',
		'sfsi_plus_houzz_countsDisplay'=>'no',
        'sfsi_plus_houzz_countsFrom'=>'manual',
		'sfsi_plus_houzz_manualCounts'=>'20',
		'sfsi_plus_ok_countsDisplay' 		  => 'no',
			'sfsi_plus_vk_countsDisplay' 		  => 'no',
			'sfsi_plus_telegram_countsDisplay' 	  => 'no',
			'sfsi_plus_weibo_countsDisplay'		  => 'no',
			'sfsi_plus_ok_manualCounts' 		 => '20',
			'sfsi_plus_vk_manualCounts' 		 => '20',
			'sfsi_plus_telegram_manualCounts' 	 => '20',
			'sfsi_plus_weibo_manualCounts' 		 => '20',
			'sfsi_plus_wechat_manualCounts' 	 => '20',
		 'sfsi_plus_premium_count_box'=>'yes',
		 'sfsi_plus_responsive_share_count' => 'yes',
		 'sfsi_plus_original_counts' => 'yes',
		 'sfsi_plus_round_counts' => 'yes',
        );
	add_option('sfsi_plus_section4_options',  serialize($options4));
  
    $options5=array('sfsi_plus_icons_size'=>'40',
        'sfsi_plus_icons_spacing'=>'5',
        'sfsi_plus_icons_Alignment'=>'left',
        'sfsi_plus_icons_perRow'=>'5',
		'sfsi_plus_follow_icons_language'=>'Follow_en_US',
		'sfsi_plus_facebook_icons_language'=>'Visit_us_en_US',
		'sfsi_plus_twitter_icons_language'=>'Visit_us_en_US',
		'sfsi_plus_icons_language'=>'en_US',
        'sfsi_plus_icons_ClickPageOpen'=>'yes',
        'sfsi_plus_icons_float'=>'yes',
		'sfsi_plus_disable_floaticons'=>'no',
		'sfsi_plus_disable_viewport'=>'no',
        'sfsi_plus_icons_floatPosition'=>'center-right',
        'sfsi_plus_icons_stick'=>'no',
        'sfsi_plus_rssIcon_order'=>'1',
        'sfsi_plus_emailIcon_order'=>'2',
        'sfsi_plus_facebookIcon_order'=>'3',
        'sfsi_plus_twitterIcon_order'=>'4',
        'sfsi_plus_youtubeIcon_order'=>'5',
        'sfsi_plus_pinterestIcon_order'=>'7',
        'sfsi_plus_linkedinIcon_order'=>'8',
		'sfsi_plus_instagramIcon_order'=>'9',
		'sfsi_plus_houzzIcon_order'=>'10',
		'sfsi_plus_telegramIcon_order'=>'22',
		'sfsi_plus_vkIcon_order'=>'23',
		'sfsi_plus_okIcon_order'=>'24',
		'sfsi_plus_weiboIcon_order'=>'25',
		'sfsi_plus_wechatIcon_order'=>'26',
        'sfsi_plus_CustomIcons_order'=>'',
        'sfsi_plus_rss_MouseOverText'=>'RSS',
        'sfsi_plus_email_MouseOverText'=>'Follow by Email',
        'sfsi_plus_twitter_MouseOverText'=>'Twitter',
        'sfsi_plus_facebook_MouseOverText'=>'Facebook',
        'sfsi_plus_linkedIn_MouseOverText'=>'LinkedIn',
        'sfsi_plus_pinterest_MouseOverText'=>'Pinterest',
		'sfsi_plus_instagram_MouseOverText'=>'Instagram',
		'sfsi_plus_telegram_MouseOverText'=>'Telegram',
		'sfsi_plus_vk_MouseOverText'=>'Vk',
		'sfsi_plus_houzz_MouseOverText'=>'Houzz',
		'sfsi_plus_youtube_MouseOverText'=>'YouTube',
		'sfsi_plus_ok_MouseOverText' 		  => "Ok",
		
		'sfsi_plus_vk_MouseOverText'		  => "Vk",
		'sfsi_plus_weibo_MouseOverText'		  => "Weibo",
		'sfsi_plus_wechat_MouseOverText'		  => "Wechat",
        'sfsi_plus_custom_MouseOverTexts'=>'',
        'sfsi_plus_premium_size_box'=>'yes',
        'sfsi_plus_custom_social_hide'=>'no',
		'sfsi_pplus_icons_suppress_errors'=>'no',
		'sfsi_plus_icons_sharing_and_traffic_tips'=> "yes"
    );
	add_option('sfsi_plus_section5_options',  serialize($options5));
    
	/* post options */	                
    $options6=array('sfsi_plus_show_Onposts'=>'yes',
        'sfsi_plus_show_Onbottom'=>'no',
        'sfsi_plus_icons_postPositon'=>'source',
        'sfsi_plus_icons_alignment'=>'center-right',
        'sfsi_plus_rss_countsDisplay'=>'no',
        'sfsi_plus_textBefor_icons'=>'Please follow and like us:',
        'sfsi_plus_icons_DisplayCounts'=>'no');
	add_option('sfsi_plus_section6_options',  serialize($options6));       
    
	/* icons pop options */
    $options7=array('sfsi_plus_show_popup'=>'no',
        'sfsi_plus_popup_text'=>'Enjoy this blog? Please spread the word :)',
        'sfsi_plus_popup_background_color'=>'#eff7f7',
        'sfsi_plus_popup_border_color'=>'#f3faf2',
        'sfsi_plus_popup_border_thickness'=>'1',
        'sfsi_plus_popup_border_shadow'=>'yes',
        'sfsi_plus_popup_font'=>'Helvetica,Arial,sans-serif',
        'sfsi_plus_popup_fontSize'=>'30',
        'sfsi_plus_popup_fontStyle'=>'normal',
        'sfsi_plus_popup_fontColor'=>'#000000',
        'sfsi_plus_Show_popupOn'=>'none',
        'sfsi_plus_Show_popupOn_PageIDs'=>'',
        'sfsi_plus_Shown_pop'=>'ETscroll',
        'sfsi_plus_Shown_popupOnceTime'=>'',
        'sfsi_plus_Shown_popuplimitPerUserTime'=>'',
        'sfsi_plus_premium_popup_box' =>'yes',
        
        );
	add_option('sfsi_plus_section7_options',  serialize($options7));
	
	/*options that are added in the third question*/
	if(get_option('sfsi_plus_section4_options',false))
		$option4=  unserialize(get_option('sfsi_plus_section4_options',false));
	if(get_option('sfsi_plus_section5_options',false))	
		$option5=  unserialize(get_option('sfsi_plus_section5_options',false));
	if(get_option('sfsi_plus_section6_options',false))	
		$option6=  unserialize(get_option('sfsi_plus_section6_options',false));
	
	/*if($option6['sfsi_plus_show_Onposts'] == 'yes')
	{
		$sfsi_plus_display_button_type = 'standard_buttons';
	}
	else
	{
		$sfsi_plus_display_button_type = '';
	}*/
	
	$options8 = array(
		'sfsi_plus_show_via_widget'=>'no',
        'sfsi_plus_float_on_page'=> $option5['sfsi_plus_icons_float'],
        'sfsi_plus_float_page_position'=>$option5['sfsi_plus_icons_floatPosition'],
		'sfsi_plus_icons_floatMargin_top'=>'',
		'sfsi_plus_icons_floatMargin_bottom'=>'',
		'sfsi_plus_icons_floatMargin_left'=>'',
		'sfsi_plus_icons_floatMargin_right'=>'',
        'sfsi_plus_post_icons_size'=>$option5['sfsi_plus_icons_size'],
        'sfsi_plus_post_icons_spacing'=>$option5['sfsi_plus_icons_spacing'],
		'sfsi_plus_show_Onposts'=>$option6['sfsi_plus_show_Onposts'],
		'sfsi_plus_textBefor_icons'=>$option6['sfsi_plus_textBefor_icons'],
		'sfsi_plus_icons_alignment'=>$option6['sfsi_plus_icons_alignment'],
		'sfsi_plus_icons_DisplayCounts'=>$option6['sfsi_plus_icons_DisplayCounts'],
		'sfsi_plus_place_item_manually'=>'no',
        /*'sfsi_plus_show_item_onposts'=>'no',*/
		'sfsi_plus_show_item_onposts'=> $option6['sfsi_plus_show_Onposts'],
		'sfsi_plus_display_button_type'=> 'standard_buttons',
        'sfsi_plus_display_before_posts'=>'no',
		'sfsi_plus_display_after_posts'=>$option6['sfsi_plus_show_Onposts'],
		'sfsi_plus_display_on_postspage'=>'no',
		'sfsi_plus_display_on_homepage'=>'no',
		'sfsi_plus_display_before_blogposts'=>'no',
		'sfsi_plus_display_after_blogposts'=>'no',
		'sfsi_plus_rectsub'=>'yes',
		'sfsi_plus_rectfb'=>'yes',
		'sfsi_plus_rectgp'=>'no',
		'sfsi_plus_recttwtr'=>'yes',
		'sfsi_plus_rectpinit'=>'yes',
		'sfsi_plus_rectfbshare'=>'yes',
	    'sfsi_plus_show_premium_placement_box'=>'yes',
	    'sfsi_plus_place_item_gutenberg'=>'no'
	);

	add_option('sfsi_plus_section8_options',  serialize($options8));		
	
	/*Some additional option added*/	
	update_option('sfsi_plus_feed_id'		, sanitize_text_field($sffeeds->feed_id));
	update_option('sfsi_plus_redirect_url'	, sanitize_text_field($sffeeds->redirect_url));
	
	add_option('sfsi_plus_RatingDiv','no');
	update_option('sfsi_plus_activate', 1);

	if(!get_option('sfsi_plus_installDate')){
		update_option('sfsi_plus_installDate', date('Y-m-d h:i:s'));
    }
	update_option('sfsi_plus_currentDate',  date('Y-m-d h:i:s'));
	update_option('sfsi_plus_showNextBannerDate', '14 day');
	// if (get_option('sfsi_plus_showNextBannerDate') == "21 day") {
    //     update_option('sfsi_plus_showNextBannerDate', '14 day');
    // }
    update_option('sfsi_plus_cycleDate',  "180 day");
    update_option('sfsi_plus_loyaltyDate',  "180 day");

    $sfsi_plus_dismiss_sharecount = array(
        'show_banner'     => "yes",
        'timestamp' => ""
    );
    update_option("sfsi_plus_dismiss_sharecount", serialize($sfsi_plus_dismiss_sharecount));
    
    $sfsi_plus_dismiss_google_analytic = array(
        'show_banner'     => "yes",
        'timestamp' => ""
    );
    update_option("sfsi_plus_dismiss_google_analytic", serialize($sfsi_plus_dismiss_google_analytic));
    
    $sfsi_plus_banner_global_firsttime_offer = array(
        'met_criteria'     => "yes",
        'is_active' => "yes",
        'timestamp' => ""
    );
    update_option("sfsi_plus_banner_global_firsttime_offer", serialize($sfsi_plus_banner_global_firsttime_offer));
    
    $sfsi_plus_dismiss_gdpr = array(
        'show_banner'     => "yes",
        'timestamp' => ""
    );
    update_option("sfsi_plus_dismiss_gdpr", serialize($sfsi_plus_dismiss_gdpr));

    $sfsi_plus_dismiss_optimization = array(
        'show_banner'     => "yes",
        'timestamp' => ""
    );
    update_option("sfsi_plus_dismiss_optimization", serialize($sfsi_plus_dismiss_optimization));

    $sfsi_plus_dismiss_gallery = array(
        'show_banner'     => "yes",
        'timestamp' => ""
    );
	update_option("sfsi_plus_dismiss_gallery", serialize($sfsi_plus_dismiss_gallery));

	$sfsi_plus_dismiss_woocommerce = array(
        'show_banner'     => "yes",
        'timestamp' => ""
    );
	update_option("sfsi_plus_dismiss_woocommerce", serialize($sfsi_plus_dismiss_woocommerce));

	$sfsi_plus_dismiss_twitter = array(
        'show_banner'     => "yes",
        'timestamp' => ""
    );
    update_option("sfsi_plus_dismiss_twitter", serialize($sfsi_plus_dismiss_twitter));
    
    $sfsi_plus_banner_global_upgrade = array(
        'met_criteria'     => "no",
        'banner_appeared' => "no",
        'is_active' => "no",
        'timestamp' => ""
    );
    update_option("sfsi_plus_banner_global_upgrade", serialize($sfsi_plus_banner_global_upgrade));
 
    $sfsi_plus_banner_global_http = array(
        'met_criteria'     => "no",
        'banner_appeared' => "no",
        'is_active' => "no",
        'timestamp' => ""
    );
    update_option("sfsi_plus_banner_global_http", serialize($sfsi_plus_banner_global_http));
    
    $sfsi_plus_banner_global_gdpr = array(
        'met_criteria'     => "no",
        'banner_appeared' => "no",
        'is_active' => "no",
        'timestamp' => ""
    );
    update_option("sfsi_plus_banner_global_gdpr", serialize($sfsi_plus_banner_global_gdpr));

    $sfsi_plus_banner_global_shares = array(
        'met_criteria'     => "no",
        'banner_appeared' => "no",
        'is_active' => "no",
        'timestamp' => ""
    );
    update_option("sfsi_plus_banner_global_shares", serialize($sfsi_plus_banner_global_shares));
    
    $sfsi_plus_banner_global_load_faster = array(
        'met_criteria'     => "no",
        'banner_appeared' => "no",
        'is_active' => "no",
        'timestamp' => ""
    );
    update_option("sfsi_plus_banner_global_load_faster", serialize($sfsi_plus_banner_global_load_faster));
    
    $sfsi_plus_banner_global_social = array(
        'met_criteria'     => "no",
        'banner_appeared' => "no",
        'is_active' => "no",
        'timestamp' => ""
    );
    update_option("sfsi_plus_banner_global_social", serialize($sfsi_plus_banner_global_social));

    $sfsi_plus_banner_global_pinterest = array(
        'met_criteria'     => "no",
        'banner_appeared' => "no",
        'is_active' => "no",
        'timestamp' => ""
    );
    update_option("sfsi_plus_banner_global_pinterest", serialize($sfsi_plus_banner_global_pinterest));
	
	/*Changes in option 2*/
	$get_option2 = unserialize(get_option('sfsi_plus_section2_options',false));
	$get_option2['sfsi_plus_email_url'] = $sffeeds->redirect_url;
	update_option('sfsi_plus_section2_options', serialize($get_option2));
	
	$addThisDismissed = get_option('sfsi_addThis_icon_removal_notice_dismissed',false);

    if(!isset($addThisDismissed)){
        update_option('sfsi_addThis_icon_removal_notice_dismissed',true);
    }

	/*Activation Setup for (specificfeed)*/
	sfsi_plus_setUpfeeds($sffeeds->feed_id);
	sfsi_plus_updateFeedPing('N',$sffeeds->feed_id);
	
	/*Extra important options*/
	$sfsi_plus_instagram_sf_count = array(
		"date_sf" => strtotime(date("Y-m-d")),
		"date_instagram" => strtotime(date("Y-m-d")),
		"sfsi_plus_sf_count" => "",
		"sfsi_plus_instagram_count" => ""
	);
	add_option('sfsi_plus_instagram_sf_count',  serialize($sfsi_plus_instagram_sf_count));
	sfsi_plus_remove_google();

	$sfsi_plus_responsive_icons_end_post = 'no';
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
	$up_option8=  unserialize(get_option('sfsi_plus_section8_options',false));
	$up_option8["sfsi_plus_responsive_icons_end_post"]="no";
	$up_option8["sfsi_plus_responsive_icons"] = $sfsi_plus_responsive_icons_default;
	update_option('sfsi_plus_section8_options', serialize($up_option8));
	if (!get_option('sfsi_plus_fb_count')) {
        add_option("sfsi_plus_fb_count", "");
    }
}
/* end function  */
/* deactivate plugin */
function sfsi_plus_deactivate_plugin()
{
     global $wpdb;
     sfsi_plus_updateFeedPing('Y',sanitize_text_field(get_option('sfsi_plus_feed_id')));
     
} /* end function  */
function sfsi_plus_remove_google(){
	$option1 = unserialize(get_option('sfsi_plus_section1_options',false));
	if(isset($option1['sfsi_plus_google_display'])){
		unset($option1['sfsi_plus_google_display']);			
	}
	update_option('sfsi_plus_section1_options', serialize($option1));
	
	$option2 = unserialize(get_option('sfsi_plus_section2_options',false));
	if(isset($option2['sfsi_plus_premium_google_box'])){
		unset($option2['sfsi_plus_premium_google_box']);			
	}
	if(isset($option2['sfsi_plus_google_page'])){
		unset($option2['sfsi_plus_google_page']);			
	}
	if(isset($option2['sfsi_plus_google_pageURL'])){
		unset($option2['sfsi_plus_google_pageURL']);			
	}
	if(isset($option2['sfsi_plus_googleLike_option'])){
		unset($option2['sfsi_plus_googleLike_option']);			
	}
	if(isset($option2['sfsi_plus_googleShare_option'])){
		unset($option2['sfsi_plus_googleShare_option']);			
	}
	update_option('sfsi_plus_section2_options', serialize($option2));
	
	$option4 =  unserialize(get_option('sfsi_plus_section4_options',false));
	if(isset($option4['sfsi_plus_google_api_key'])){
		unset($option4['sfsi_plus_google_api_key']);			
	}
	if(isset($option4['sfsi_plus_google_countsDisplay'])){
		unset($option4['sfsi_plus_google_countsDisplay']);			
	}
	if(isset($option4['sfsi_plus_google_countsFrom'])){
		unset($option4['sfsi_plus_google_countsFrom']);			
	}
	if(isset($option4['sfsi_plus_google_manualCounts'])){
		unset($option4['sfsi_plus_google_manualCounts']);			
	}
	update_option('sfsi_plus_section4_options', serialize($option4));
	
	$option5 =  unserialize(get_option('sfsi_plus_section5_options',false));
	if(isset($option5['sfsi_plus_google_icons_language'])){
		unset($option5['sfsi_plus_google_icons_language']);			
	}
	if(isset($option5['sfsi_plus_googleIcon_order'])){
		unset($option5['sfsi_plus_googleIcon_order']);			
	}
	if(isset($option5['sfsi_plus_google_MouseOverText'])){
		unset($option5['sfsi_plus_google_MouseOverText']);			
	}
	update_option('sfsi_plus_section5_options', serialize($option5));

}
function sfsi_plus_updateFeedPing($status,$feed_id)
{
    $body = array(
	    'feed_id' => $feed_id,
	    'status' => $status
	);
	 
	$args = array(
	    'body' => $body,
		'timeout'     => 30,
		'sslverify' => true,
	    'redirection' => '5',
	    'httpversion' => '1.0',
	    'blocking' => true,
	    'headers' => array(),
	    'cookies' => array()
	);
	 
	$resp = wp_remote_post( 'https://api.follow.it/wordpress/pingfeed', $args );
	return $resp;
}
/* unistall plugin function */	
function sfsi_plus_Unistall_plugin()
{   
	global $wpdb;
    /* Delete option for which icons to display */
    delete_option('sfsi_plus_section1_options');
    delete_option('sfsi_plus_section2_options');
    delete_option('sfsi_plus_section3_options');
    delete_option('sfsi_plus_section4_options');
    delete_option('sfsi_plus_section5_options');
    delete_option('sfsi_plus_section6_options');
    delete_option('sfsi_plus_section7_options');
	delete_option('sfsi_plus_section8_options');
	delete_option('sfsi_plus_section9_options');
    delete_option('sfsi_plus_feed_id');
	delete_option('sfsi_plus_redirect_url');
    delete_option('sfsi_plus_footer_sec');
    delete_option('sfsi_plus_activate');
	delete_option("sfsi_plus_pluginVersion");
	delete_option("sfsi_plus_verificatiom_code");
	delete_option("sfsi_plus_curlErrorNotices");
	delete_option("sfsi_plus_curlErrorMessage");

	delete_option("adding_plustags");
	delete_option("sfsi_plus_installDate");
	delete_option("sfsi_plus_RatingDiv");
	delete_option("sfsi_plus_instagram_sf_count");
	delete_option("sfsi_plus_new_show_notification");
	delete_option("sfsi_plus_show_Setting_mobile_notification");
	delete_option("sfsi_plus_show_premium_notification");
	delete_option("sfsi_plus_show_notification");
	delete_option('sfsi_plus_serverphpVersionnotification');
	delete_option("sfsi_plus_show_premium_cumulative_count_notification");
    
    delete_option("sfsi_addThis_icon_removal_notice_dismissed");
    delete_option('widget_sfsi-plus-widget');
	delete_option('widget_sfsiplus_subscriber_widget');

	delete_option('fs_active_plugins');
	delete_option('fs_accounts');
	delete_option('fs_api_cache');
	delete_option('fs_debug_mode'); 	

	delete_option("sfsi_plus_dismiss_sharecount");
    delete_option("sfsi_plus_dismiss_google_analytic");
    delete_option("sfsi_plus_dismiss_gdpr");
    delete_option("sfsi_plus_dismiss_optimization");
	delete_option("sfsi_plus_dismiss_gallery");
    delete_option("sfsi_plus_dismiss_woocommerce");
    delete_option("sfsi_plus_dismiss_twitter");
    delete_option("sfsi_plus_banner_global_firsttime_offer");
    delete_option("sfsi_plus_banner_global_social");
    delete_option("sfsi_plus_banner_global_gdpr");
    delete_option("sfsi_plus_banner_global_pinterest");
    delete_option("sfsi_plus_banner_global_load_faster");
    delete_option("sfsi_plus_banner_global_shares");
    delete_option("sfsi_plus_banner_global_http");
	delete_option("sfsi_plus_banner_global_upgrade");
	
    delete_option("sfsi_plus_currentDate");
    delete_option("sfsi_plus_showNextBannerDate");
    delete_option("sfsi_plus_cycleDate");
	delete_option("sfsi_plus_loyaltyDate");
    delete_option("sfsi_plus_fb_count");
	
}
/* end function */
/* check CUrl */
function sfsi_plus_curl_enable_notice(){
    if(!function_exists('curl_init')) {
	echo '<div class="error"><p> '.__('Error: It seems that CURL is disabled on your server. Please contact your server administrator to install / enable CURL.',SFSI_PLUS_DOMAIN).'</p></div>'; die;
    }
}
	
/* add admin menus */
function sfsi_plus_admin_menu() {
	add_menu_page(
		'Ultimate Social Media PLUS',
		'Ultimate Social Media PLUS',
		'administrator',
		'sfsi-plus-options',
		'sfsi_plus_options_page',
		plugins_url( 'images/logo.png' , dirname(__FILE__) )
	);
}
function sfsi_plus_options_page(){ include SFSI_PLUS_DOCROOT . '/views/sfsi_options_view.php';	} /* end function  */
function sfsi_plus_about_page(){ include SFSI_PLUS_DOCROOT . '/views/sfsi_aboutus.php';	} /* end function  */
if ( is_admin() ){
    add_action('admin_menu', 'sfsi_plus_admin_menu');
}

/* fetch rss url from specificfeeds */ 
function SFSI_PLUS_getFeedUrl()
{
	$body = array(
            'web_url'	=> get_bloginfo('url'),
            'feed_url'	=> sfsi_plus_get_bloginfo('rss2_url'),
            'email'		=> '',
			'subscriber_type' => 'PLWP'
        );
	 
	$args = array(
	    'body' => $body,
		'blocking' => true,
		'timeout'     => 30,
		'sslverify' => true,
	    'user-agent' => 'sf rss request',
	    'header'	=> array("Content-Type"=>"application/x-www-form-urlencoded")
	   
	);
	$resp = wp_remote_post( 'https://api.follow.it/wordpress/plugin_setup', $args );
	if ( !is_wp_error( $resp ) ) {
		$resp = json_decode($resp['body']);
	}
	if(isset($resp->redirect_url) && isset($resp->feed_id)){
        $feed_url = stripslashes_deep($resp->redirect_url);
        return $resp;
    }else{
        return (Object)array('redirect_url'=>'https://follow.it/now','feed_id'=>'');
    }
    exit;
}
/* fetch rss url from specificfeeds on */ 
function SFSI_PLUS_updateFeedUrl()
{
    $body = array(
            'feed_id' 	=> sanitize_text_field(get_option('sfsi_plus_feed_id')),
            'web_url' 	=> get_bloginfo('url'),
            'feed_url' 	=> sfsi_plus_get_bloginfo('rss2_url'),
            'email'		=> ''
        );
	 
	$args = array(
	    'body' => $body,
	    'blocking' => true,
	    'user-agent' => 'sf rss request',
	    'header'	=> array("Content-Type"=>"application/x-www-form-urlencoded"),
	    'timeout'     => 30,
		'sslverify' => true
	);
	$resp = wp_remote_post( 'https://api.follow.it/wordpress/updateFeedPlugin', $args );
	if ( is_wp_error( $resp ) ) {
	} else {
	   $resp = json_decode($resp['body']);
	}

	$feed_url = stripslashes_deep($resp->redirect_url);
	return $resp;exit;
}
/* add sf tags */
function sfsi_plus_setUpfeeds($feed_id)
{
	$args = array(
	    'blocking' => true,
	    'user-agent' => 'sf rss request',
	    'header'	=> array("Content-Type"=>"application/json"),
		'timeout'     => 30,
		'sslverify' => true
	);
	$resp = wp_remote_get( 'https://api.follow.it/rssegtcrons/download_rssmorefeed_data_single/'.$feed_id."/Y", $args );
}
/* admin notice if wp_head is missing in active theme */
function sfsi_plus_check_wp_head() {
	
	$template_directory = get_template_directory();
	$header = $template_directory . '/header.php';
	
	if (is_file($header)) {
		
	    $search_header = "wp_head";
	    $file_lines = @file($header);
	    $foind_header=0;
	    foreach ($file_lines as $line)
		{
		    $searchCount = substr_count($line, $search_header);
		    if ($searchCount > 0)
			{
			    return true;
		    }
		}
	    $path=pathinfo($_SERVER['REQUEST_URI']);
	    if($path['basename']=="themes.php" || $path['basename']=="theme-editor.php" || $path['basename']=="admin.php?page=sfsi-plus-options")
	    {
	    	$currentTheme = wp_get_theme();
	    		    	
	    	if(isset($currentTheme) && !empty($currentTheme) && $currentTheme->get( 'Name' ) != "Customizr"){

	    		echo "<div class=\"error\" ><p>". __( 'Error : Please fix your theme to make plugins work correctly. Go to the Theme Editor and insert the following string:', SFSI_PLUS_DOMAIN )." &lt;?php wp_head(); ?&gt; ".__('Please enter it just before the following line of your header.php file:',SFSI_PLUS_DOMAIN)." &lt;/head&gt; ".__('Go to your theme editor: ',SFSI_PLUS_DOMAIN)."<a href=\"theme-editor.php\">".__('click here', SFSI_PLUS_DOMAIN )."</a>.</p></div>";	    		
	    	}
			
		}		
	}
}
/* admin notice if wp_footer is missing in active theme */
function sfsi_plus_check_wp_footer() {
    $template_directory = get_template_directory();
    $footer = $template_directory . '/footer.php';
 
	if (is_file($footer)) {
		$search_string = "wp_footer";
		$file_lines = @file($footer);
		
		foreach ($file_lines as $line) {
			$searchCount = substr_count($line, $search_string);
			if ($searchCount > 0) {
				return true;
			}
		}
		$path=pathinfo($_SERVER['REQUEST_URI']);
		
		if($path['basename']=="themes.php" || $path['basename']=="theme-editor.php" || $path['basename']=="admin.php?page=sfsi-plus-options")
		{
			echo "<div class=\"error\" ><p>".	__("Error: Please fix your theme to make plugins work correctly. Go to the Theme Editor and insert the following string as the first line of your theme's footer.php file: ", SFSI_PLUS_DOMAIN)." &lt;?php wp_footer(); ?&gt; ".__("Go to your theme editor: ", SFSI_PLUS_DOMAIN)."<a href=\"theme-editor.php\">".__('click here', SFSI_PLUS_DOMAIN )."</a>.</p></div>";
		} 	    
	}
}
/* admin notice for first time installation */
function sfsi_plus_activation_msg()
{
	global $wp_version;
	
	if(get_option('sfsi_plus_activate',false)==1)
	{
		echo "<div class='updated'><p>".__("Thank you for installing the Ultimate Social Media PLUS plugin. Please go to the plugin's settings page to configure it: ",SFSI_PLUS_DOMAIN)."<b><a href='admin.php?page=sfsi-plus-options'>".__("Click here",SFSI_PLUS_DOMAIN)."</a></b></p></div>";
		update_option('sfsi_plus_activate',0);
	}
	
	$path=pathinfo($_SERVER['REQUEST_URI']);
	update_option('sfsi_plus_activate',0);		
	
	if($wp_version < 3.5 && $path['basename'] == "admin.php?page=sfsi-plus-options")
	{
		echo "<div class=\"update-nag\" ><p><b>".__('You`re using an old Wordpress version, which may cause several of your plugins to not work correctly. Please upgrade', SFSI_PLUS_DOMAIN)."</b></p></div>"; 
	}
}
/* admin notice for first time installation */
function sfsi_plus_rating_msg()
{
    global $wp_version;
    $install_date = get_option('sfsi_plus_installDate');
    $display_date = date('Y-m-d h:i:s');
	$datetime1 = new DateTime($install_date);
	$datetime2 = new DateTime($display_date);
	$diff_inrval = round(($datetime2->format('U') - $datetime1->format('U')) / (60*60*24));
    $screen = get_current_screen();
	if($diff_inrval >= 40 && get_option('sfsi_plus_RatingDiv')=="no" && !is_null($screen) && "toplevel_page_sfsi-plus-options"==$screen->id)
	{ ?>
		<style >
        .sfsi_plus_plg-rating-dismiss:before {
            background: none;
            color: #72777c;
            content: "\f153";
            display: block;
            font: normal 16px/20px dashicons;
            speak: none;
            height: 20px;
            text-align: center;
            width: 20px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }      
        .sfsi_plus_plg-rating-dismiss{
            position: absolute;
            top: 45px;
            right: 15px;
            border: none;
            margin: 0;
            padding: 9px;
            background: none;
            color: #72777c;
            cursor: pointer;
        }
      </style>
	 <div class="sfsi_plus_sfwp_fivestar notice notice-success">
    	<p><?php echo __('We noticed you\'ve been using the Ultimate Social Media PLUS Plugin for more than 40 days. If you\'re happy with it, could you please do us a BIG favor and let us know ONE thing we can improve in it?', SFSI_PLUS_DOMAIN);?></p>
        <ul class="sfwp_fivestar_ul">
        	<li><a href="https://wordpress.org/support/plugin/ultimate-social-media-plus#new-topic-0" target="_new" title="<?php echo __('Yes, let me give feedback.',SFSI_PLUS_DOMAIN); ?>"><?php echo __('Yes, let me give feedback.', SFSI_PLUS_DOMAIN); ?></a></li>
            <li><a href="https://wordpress.org/support/plugin/ultimate-social-media-plus/reviews/?filter=5" target="_new" title="<?php echo __('No clue, let me give a 5-star rating instead',SFSI_PLUS_DOMAIN) ?>"><?php echo __('No clue, let me give a 5-star rating instead',SFSI_PLUS_DOMAIN) ?></a></li>
            <li><a href="javascript:void(0);" class="sfsiHideRating" title="<?php echo __('I already did', SFSI_PLUS_DOMAIN)?>"> <?php echo __('I already did (don\'t show this again)', SFSI_PLUS_DOMAIN); ?> </a></li>
        </ul>
        <button type="button" class="sfsi_plus_plg-rating-dismiss"><span class="screen-reader-text"><?php echo __('Dismiss this notice.',SFSI_PLUS_DOMAIN); ?></span></button>    
    </div>
    <script>
    jQuery( document ).ready(function( $ ) {
    	$('.sfsi_plus_plg-rating-dismiss').css({'top':$('.sfsi_plus_sfwp_fivestar')[0].offsetTop+'px'})
    	var sel1 = jQuery('.sfsiHideRating');
        var sel2 = jQuery('.sfsi_plus_plg-rating-dismiss');
		function sfsi_plus_hide_rating(element){
		    element.on('click',function(){
		        var data={'action':'plushideRating','nonce':'<?php echo wp_create_nonce('plus_plushideRating'); ?>'};
		        jQuery.ajax({
		    
			        url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
			        type: "post",
			        data: data,
			        dataType: "json",
			        async: !0,
			        success: function(e) {
			            if (e=="success") {
			               jQuery('.sfsi_plus_sfwp_fivestar').slideUp('slow');
			            }
			        }
		     	});
		    });
		}
		sfsi_plus_hide_rating(sel1);
        sfsi_plus_hide_rating(sel2);
    });
    </script>
    <?php
   }
}
add_action('wp_ajax_plushideRating','sfsi_plusHideRatingDiv');
function sfsi_plusHideRatingDiv()
{
	if ( !wp_verify_nonce( $_POST['nonce'], "plus_plushideRating")) {
		echo  json_encode(array('res'=>"error")); exit;
	} 
	if(!current_user_can('manage_options')){ echo json_encode(array('res'=>'not allowed'));die(); }
    update_option('sfsi_plus_RatingDiv','yes');
    echo  json_encode(array("success")); exit;
}
/* add all admin message */
add_action('admin_notices', 'sfsi_plus_activation_msg');
add_action('admin_notices', 'sfsi_plus_rating_msg');
add_action('admin_notices', 'sfsi_plus_check_wp_head');
add_action('admin_notices', 'sfsi_plus_check_wp_footer');
function sfsi_plus_pingVendor( $post_id )
{
    global $wp,$wpdb;
	// If this is just a revision, don't send the email.
	if ( wp_is_post_revision( $post_id ) )
		return;
		
	$post_data=get_post($post_id,ARRAY_A);
	if($post_data['post_status']=='publish' && $post_data['post_type']=='post') : 
		$feed_id = sanitize_text_field(get_option('sfsi_plus_feed_id'));
		return sfsi_plus_setUpfeeds($feed_id);
    endif;
}
add_action( 'save_post', 'sfsi_plus_pingVendor' );

function sfsi_plus_was_displaying_addthis(){

    $isDismissed   =  true;
    $sfsi_plus_section1 =  unserialize(get_option('sfsi_plus_section1_options',false));
    $sfsi_plus_section8 =  unserialize(get_option('sfsi_plus_section8_options',false));
    $sfsi_plus_addThiswasDisplayed_section1 = isset($sfsi_plus_section1['sfsi_plus_share_display']) && 'yes'== sanitize_text_field($sfsi_plus_section1['sfsi_plus_share_display']);

    $sfsi_plus_addThiswasDisplayed_section8 = isset($sfsi_plus_section8['sfsi_plus_rectshr']) && 'yes'== sanitize_text_field($sfsi_plus_section8['sfsi_plus_rectshr']);

    $isDisplayed = $sfsi_plus_addThiswasDisplayed_section1 || $sfsi_plus_addThiswasDisplayed_section8;

    // If icon was displayed
    $isDismissed = false != $isDisplayed ? false : true;

    update_option('sfsi_plus_addThis_icon_removal_notice_dismissed',$isDismissed);

    if($sfsi_plus_addThiswasDisplayed_section1){
        unset($sfsi_plus_section1['sfsi_plus_share_display']);
        update_option('sfsi_plus_section1_options', serialize($sfsi_plus_section1) );
    }

    if($sfsi_plus_addThiswasDisplayed_section8){
        unset($sfsi_plus_section8['sfsi_plus_rectshr']);
        update_option('sfsi_plus_section8_options', serialize($sfsi_plus_section8) );
    }
}

?>