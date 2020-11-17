<?php
  	/* unserialize all saved option for  section 4 options */
	$option2 =  unserialize(get_option('sfsi_plus_section2_options',false));
	$option4 =  unserialize(get_option('sfsi_plus_section4_options',false));
	if(!isset($option4['sfsi_plus_facebook_mypageCounts']))
	{
		$option4['sfsi_plus_facebook_mypageCounts'] = '';
	}
    
	/*
	 * Sanitize, escape and validate values
	 */
	$option4['sfsi_plus_display_counts'] 			= 	(isset($option4['sfsi_plus_display_counts']))
															? sanitize_text_field($option4['sfsi_plus_display_counts'])
															: '';
	$option4['sfsi_plus_email_countsFrom'] 			= 	(isset($option4['sfsi_plus_email_countsFrom']))
															? sanitize_text_field($option4['sfsi_plus_email_countsFrom'])
															: '';
	$option4['sfsi_plus_email_manualCounts'] 		= 	(isset($option4['sfsi_plus_email_manualCounts']))
															? intval($option4['sfsi_plus_email_manualCounts'])
															: '';
	$option4['sfsi_plus_rss_countsDisplay'] 		= 	(isset($option4['sfsi_plus_rss_countsDisplay']))
															? sanitize_text_field($option4['sfsi_plus_rss_countsDisplay'])
															: '';
	$option4['sfsi_plus_rss_manualCounts'] 			= 	(isset($option4['sfsi_plus_rss_manualCounts']))
															? intval($option4['sfsi_plus_rss_manualCounts'])
															: '';
	$option4['sfsi_plus_email_countsDisplay'] 		= 	(isset($option4['sfsi_plus_email_countsDisplay']))
															? sanitize_text_field($option4['sfsi_plus_email_countsDisplay'])
															: '';
	
	$option4['sfsi_plus_facebook_countsDisplay']	= 	(isset($option4['sfsi_plus_facebook_countsDisplay']))
															? sanitize_text_field($option4['sfsi_plus_facebook_countsDisplay'])
															: '';
	$option4['sfsi_plus_facebook_countsFrom'] 		= 	(isset($option4['sfsi_plus_facebook_countsFrom']))
															? sanitize_text_field($option4['sfsi_plus_facebook_countsFrom'])
															: '';
	$option4['sfsi_plus_facebook_mypageCounts'] 	= 	(isset($option4['sfsi_plus_facebook_mypageCounts']))
															? sfsi_plus_sanitize_field($option4['sfsi_plus_facebook_mypageCounts'])
															: '';
	$option4['sfsi_plus_facebook_manualCounts'] 	= 	(isset($option4['sfsi_plus_facebook_manualCounts']))
															? intval($option4['sfsi_plus_facebook_manualCounts'])
															: '';
	
	
	$option4['sfsi_plus_twitter_countsDisplay'] 	= 	(isset($option4['sfsi_plus_twitter_countsDisplay']))
															? sanitize_text_field($option4['sfsi_plus_twitter_countsDisplay'])
															: '';
	$option4['sfsi_plus_twitter_countsFrom'] 		= 	(isset($option4['sfsi_plus_twitter_countsFrom']))
															? sanitize_text_field($option4['sfsi_plus_twitter_countsFrom'])
															: '';
	$option4['sfsi_plus_twitter_manualCounts'] 		= 	(isset($option4['sfsi_plus_twitter_manualCounts']))
															? intval($option4['sfsi_plus_twitter_manualCounts'])
															: '';
	$option4['sfsiplus_tw_consumer_key'] 			= 	(isset($option4['sfsiplus_tw_consumer_key']))
															? sfsi_plus_sanitize_field($option4['sfsiplus_tw_consumer_key'])
															: '';
	$option4['sfsiplus_tw_consumer_secret'] 		= 	(isset($option4['sfsiplus_tw_consumer_secret']))
															? sfsi_plus_sanitize_field($option4['sfsiplus_tw_consumer_secret'])
															: '';
	$option4['sfsiplus_tw_oauth_access_token'] 		= 	(isset($option4['sfsiplus_tw_oauth_access_token']))
															? sfsi_plus_sanitize_field($option4['sfsiplus_tw_oauth_access_token'])
															: '';
	$option4['sfsiplus_tw_oauth_access_token_secret']= 	(isset($option4['sfsiplus_tw_oauth_access_token_secret']))
															? sfsi_plus_sanitize_field($option4['sfsiplus_tw_oauth_access_token_secret'])
															: '';
	$option4['sfsi_plus_youtube_countsDisplay'] 	= 	(isset($option4['sfsi_plus_youtube_countsDisplay']))
															? sanitize_text_field($option4['sfsi_plus_youtube_countsDisplay'])
															: '';
	$option4['sfsi_plus_youtube_countsFrom'] 		= 	(isset($option4['sfsi_plus_youtube_countsFrom']))
															? sanitize_text_field($option4['sfsi_plus_youtube_countsFrom'])
															: '';
	$option4['sfsi_plus_youtubeusernameorid'] 		= 	(isset($option4['sfsi_plus_youtubeusernameorid']))
															? sanitize_text_field($option4['sfsi_plus_youtubeusernameorid'])
															: '';
	$option4['sfsi_plus_youtube_manualCounts'] 		= 	(isset($option4['sfsi_plus_youtube_manualCounts']))
															? intval($option4['sfsi_plus_youtube_manualCounts'])
															: '';
	$option4['sfsi_plus_youtube_user'] 				= 	(isset($option4['sfsi_plus_youtube_user']))
															? sfsi_plus_sanitize_field($option4['sfsi_plus_youtube_user'])
															: '';
	$option4['sfsi_plus_youtube_channelId'] 		= 	(isset($option4['sfsi_plus_youtube_channelId']))
															? sfsi_plus_sanitize_field($option4['sfsi_plus_youtube_channelId'])
															: '';	
	
	$option4['sfsi_plus_instagram_manualCounts'] 	= 	(isset($option4['sfsi_plus_instagram_manualCounts']))
															? intval($option4['sfsi_plus_instagram_manualCounts'])
															: '';
	$option4['sfsi_plus_instagram_User'] 			= 	(isset($option4['sfsi_plus_instagram_User']))
															? sfsi_plus_sanitize_field($option4['sfsi_plus_instagram_User'])
															: '';
	$option4['sfsi_plus_instagram_clientid'] 		= 	(isset($option4['sfsi_plus_instagram_clientid']))
															? sfsi_plus_sanitize_field($option4['sfsi_plus_instagram_clientid'])
															: '';
	$option4['sfsi_plus_instagram_appurl'] 			= 	(isset($option4['sfsi_plus_instagram_appurl']))
															? sfsi_plus_sanitize_field($option4['sfsi_plus_instagram_appurl'])
															: '';	
	$option4['sfsi_plus_instagram_token'] 			= 	(isset($option4['sfsi_plus_instagram_token']))
															? sfsi_plus_sanitize_field($option4['sfsi_plus_instagram_token'])
															: '';														
	$option4['sfsi_plus_instagram_countsFrom'] 		= 	(isset($option4['sfsi_plus_instagram_countsFrom']))
															? sanitize_text_field($option4['sfsi_plus_instagram_countsFrom'])
															: '';
	$option4['sfsi_plus_instagram_countsDisplay']	= 	(isset($option4['sfsi_plus_instagram_countsDisplay']))
															? sanitize_text_field($option4['sfsi_plus_instagram_countsDisplay'])
															: '';
	
	$option4['sfsi_plus_linkedIn_manualCounts'] 	= 	(isset($option4['sfsi_plus_linkedIn_manualCounts']))
															? intval($option4['sfsi_plus_linkedIn_manualCounts'])
															: '';
	$option4['sfsi_plus_houzz_manualCounts'] 		= 	(isset($option4['sfsi_plus_houzz_manualCounts']))
															? intval($option4['sfsi_plus_houzz_manualCounts'])
															: ''; 													
	$option4['sfsi_plus_pinterest_manualCounts'] 	= 	(isset($option4['sfsi_plus_pinterest_manualCounts']))
															? intval($option4['sfsi_plus_pinterest_manualCounts'])
															: '';
    $option4['sfsi_plus_premium_count_box'] 		= 	(isset($option4['sfsi_plus_premium_count_box']))
															? sanitize_text_field($option4['sfsi_plus_premium_count_box'])
															: 'yes';
	$option4['sfsi_plus_telegram_countsDisplay'] 		= 	(isset($option4['sfsi_plus_telegram_countsDisplay']))
															? sanitize_text_field($option4['sfsi_plus_telegram_countsDisplay'])
															: '';
	$option4['sfsi_plus_telegram_manualCounts'] 			= 	(isset($option4['sfsi_plus_telegram_manualCounts']))
															? intval($option4['sfsi_plus_telegram_manualCounts'])
															: '';	
	$option4['sfsi_plus_vk_countsDisplay'] 		= 	(isset($option4['sfsi_plus_vk_countsDisplay']))
															? sanitize_text_field($option4['sfsi_plus_vk_countsDisplay'])
															: '';
	$option4['sfsi_plus_vk_manualCounts'] 			= 	(isset($option4['sfsi_plus_vk_manualCounts']))
															? intval($option4['sfsi_plus_vk_manualCounts'])
															: '';	
															
	$option4['sfsi_plus_ok_countsDisplay'] 		= 	(isset($option4['sfsi_plus_ok_countsDisplay']))
															? sanitize_text_field($option4['sfsi_plus_ok_countsDisplay'])
															: '';
	$option4['sfsi_plus_ok_manualCounts'] 			= 	(isset($option4['sfsi_plus_ok_manualCounts']))
															? intval($option4['sfsi_plus_ok_manualCounts'])
															: '';	

	$option4['sfsi_plus_weibo_countsDisplay'] 		= 	(isset($option4['sfsi_plus_weibo_countsDisplay']))
															? sanitize_text_field($option4['sfsi_plus_weibo_countsDisplay'])
															: '';
	$option4['sfsi_plus_weibo_manualCounts'] 			= 	(isset($option4['sfsi_plus_weibo_manualCounts']))
															? intval($option4['sfsi_plus_weibo_manualCounts'])
															: '';	

	$option4['sfsi_plus_wechat_countsDisplay'] 		= 	(isset($option4['sfsi_plus_wechat_countsDisplay']))
															? sanitize_text_field($option4['sfsi_plus_wechat_countsDisplay'])
															: '';
	$option4['sfsi_plus_wechat_manualCounts'] 			= 	(isset($option4['sfsi_plus_wechat_manualCounts']))
															? intval($option4['sfsi_plus_wechat_manualCounts'])
															: '';	
	$option4['sfsi_plus_round_counts'] 		= 	(isset($option4['sfsi_plus_round_counts']))
												? sanitize_text_field($option4['sfsi_plus_round_counts'])
												: '';
	$option4['sfsi_plus_original_counts'] 		= 	(isset($option4['sfsi_plus_original_counts']))
													? sanitize_text_field($option4['sfsi_plus_original_counts'])
												    : '';
	$option4['sfsi_plus_responsive_share_count'] 		= 	(isset($option4['sfsi_plus_responsive_share_count']))
															? sanitize_text_field($option4['sfsi_plus_responsive_share_count'])
															: '';
	$counts = sfsi_plus_getCounts();
	/* fetch counts for admin sections */
    
	/* check for email icon display */
    $email_image="email.png";
    if($option2['sfsi_plus_rss_icons']=="sfsi")
    { 
        $email_image="sf_arow_icn.png";
    }
	elseif($option2['sfsi_plus_rss_icons']=="email")
	{
		$email_image="email.png";
	}
	else
	{
		$email_image = "subscribe.png";
	}
    $hide="display:none;";
?>
<!-- Section 4 "Do you want to display "counts" next to your icons?" main div Start -->
<div class="tab4">
	<p>
   		<?php  _e('It’s a psychological fact that people like to follow other people, so when they see that your site has already a good number of Facebook likes, it’s more likely that they will subscribe/like/share your site than if it had 0.', SFSI_PLUS_DOMAIN ); ?>
    </p>
	<p>
  	  	<?php  _e( 'Therefore, you can select to display the count next to your icons which will look like this:', SFSI_PLUS_DOMAIN ); ?>
    </p>
	
    <!-- sample icons --> 
	<ul class="like_icon">
        <li class="sfsiplus_rss_section">
			<a href="#" title="RSS">
				<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/rss.png" alt="RSS" />
			</a><span>12k</span>
		</li>
        <li class="sfsiplus_email_section">
			<a href="#" title="Email">
				<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/<?php echo $email_image; ?>" alt="Email" class="icon_img" />
			</a><span>12k</span>
		</li>
        <li class="sfsiplus_facebook_section">
			<a href="#" title="Facebook">
				<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/fb.png" alt="Facebook" />
			</a><span>12k</span>
		</li>
        <li class="sfsiplus_twitter_section">
			<a href="#" title="Twitter">
				<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/twitter.png" alt="Twitter" />
			</a><span>12k</span>
		</li>
        <li class="sfsiplus_youtube_section">
			<a href="#" title="YouTube">
				<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/youtube.png" alt="YouTube" />
			</a><span>12k</span>
		</li>
        <li class="sfsiplus_pinterest_section">
			<a href="#" title="Pinterest">
				<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/pinterest.png" alt="Pinterest" />
			</a><span>12k</span>
		</li>
        <li class="sfsiplus_linkedin_section">
			<a href="#" title="Linked In">
				<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/linked_in.png" alt="Linked In" />
			</a><span>12k</span>
		</li>
        <li class="sfsiplus_instagram_section">
			<a href="#" title="Instagram">
				<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/instagram.png" alt="instagram" />
			</a><span>12k</span>
		</li>
        <li class="sfsiplus_houzz_section">
			<a href="#" title="Houzz">
				<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/houzz.png" alt="instagram" />
			</a><span>12k</span>
		</li>
			<!--MZ CODE START-->
			<li class="sfsiplus_telegram_section">
			<a href="#" title="Telegram">
				<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/telegram.png" alt="Telegram" />
			</a><span>12k</span>
		</li>
		
		<li class="sfsiplus_vk_section">
			<a href="#" title="Vk">
				<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/vk.png" alt="Telegram" />
			</a><span>12k</span>
		</li>
		<li class="sfsiplus_ok_section">
			<a href="#" title="Ok">
				<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/icons_theme/default/default_ok.png" alt="Ok" width="50px" height="50px" />
			</a><span>12k</span>
		</li>
		<li class="sfsiplus_weibo_section">
			<a href="#" title="Weibo">
				<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/weibo.png" alt="Weibo" width="50px" height="50px"  />
			</a><span>12k</span>
		</li>
		<li class="sfsiplus_wechat_section">
			<a href="#" title="Wechat">
				<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/wechat.png" alt="Weibo" width="50px" height="50px"  />
			</a><span>12k</span>
		</li>


		
    </ul>  <!-- END sample icons -->
    <p>
    	<?php  _e( 'Of course, if you start at 0, you shoot yourself in the foot with that. So we suggest that you only turn this feature on once you have a good number of followers/likes/shares (min. of 20 – no worries if it’s not too many, it should just not be 0).', SFSI_PLUS_DOMAIN ); ?>
    </p>
  	<h4>
   		<?php  _e( 'Enough waffling. So do you want to display counts?', SFSI_PLUS_DOMAIN ); ?>
    </h4>
  	<!-- show/hide counts for icons section  START --> 
  	<ul class="enough_waffling">
  		<li>
			<input name="sfsi_plus_display_counts" <?php echo ($option4['sfsi_plus_display_counts']=='yes') ?  'checked="true"' : '' ;?> type="radio" value="yes" class="styled"  />
        	<label>
       			<?php  _e( 'Yes', SFSI_PLUS_DOMAIN ); ?>
        	</label>
		</li>
    	<li>
			<input name="sfsi_plus_display_counts" <?php echo ($option4['sfsi_plus_display_counts']=='no') ?  'checked="true"' : '' ;?> type="radio" value="no" class="styled"  />
        	<label>
        		<?php  _e( 'No', SFSI_PLUS_DOMAIN ); ?>
        	</label>
		</li>
	  </ul>
	  
    <!-- END  show/hide counts for icons section --> 
	<!-- show/hide counts for all icons section  START --> 
	<div class="sfsiplus_count_sections" style="display:none">
	<?php
	$socialObj = new sfsi_plus_SocialHelper();
	$current_url = site_url();
	$fb_data = $socialObj->sfsi_banner_get_fb($current_url);
	 $check_fb_count_more_than_one = $fb_data > 0 || $socialObj->sfsi_get_pinterest($current_url) > 0;
	 $sfsi_fb_count =  get_option('sfsi_plus_fb_count', false);
	 if ($check_fb_count_more_than_one > $sfsi_fb_count || $sfsi_fb_count == "") {
		 update_option('sfsi_plus_fb_count',  ($check_fb_count_more_than_one));
	 }
	$sfsi_fb_count_check_for_shares =  $sfsi_fb_count > 0;
	if (is_ssl() && ($sfsi_fb_count_check_for_shares ||  $check_fb_count_more_than_one)) {
		?>
		<div class="sfsi_new_prmium_follw sfsi_banner_body sfsi_warning_banner">
			<div>
				<p style="margin-bottom: 12px !important;"><b>Important:</b> Your website used to be on http (before you enabled an SSL certificate to switch to https). We found share counts for your URLs on http which usually get lost
					after switch to https (because Facebook etc. provide the counts per url, and an url on https is a different url then one on http). <b>We found a solution for that</b> so that your share counts on http and https will
					be aggregated and your full number of share counts is restored. It is implemented in the Premium Plugin - <a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmi_settings_page&utm_campaign=share_count_recovery_notification&utm_medium=link" style="cursor:pointer; color: #12a252 !important;border-bottom: 1px solid #222222;text-decoration: none;font-weight: bold;font-family: unset;" data-id="sfsi_quickpay-overlay" target="_blank">
						<b>Get it now.</b>
					</a>
				</p>
			</div>
			<small class="sfsi_banner_dismiss">Dismiss</small>
		</div>
	<?php
	}
	?>
		<h4>
			<?php  _e( 'Please specify which counts should be shown:', SFSI_PLUS_DOMAIN ); ?>
		</h4>
        
		<!-- RSS ICON COUNT SECTION-->
		<div class="sfsiplus_specify_counts sfsiplus_rss_section">
			<div class="radio_section">
				<input name="sfsi_plus_rss_countsDisplay" <?php echo ($option4['sfsi_plus_rss_countsDisplay']=='yes') ?  'checked="true"' : '' ;?> type="checkbox" value="yes" class="styled"  />
			</div>
			<div class="social_icon_like">
				<ul class="like_icon">
					<li>
						<a title="RSS">
							<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/rss.png" alt="RSS" />
							<span><?php echo $counts['rss_count']; ?></span>
						</a>
					</li>
				</ul>
			</div>
			<div class="listing">
				<ul>
					<li>
						<?php 
							_e('We cannot track this. So enter the figure here:',SFSI_PLUS_DOMAIN); ?> 
						<input name="sfsi_plus_rss_manualCounts" type="text" class="input" value="<?php echo ($option4['sfsi_plus_rss_manualCounts']!='') ?  $option4['sfsi_plus_rss_manualCounts'] : '' ;?>" />
					</li>
				</ul>
			</div>    
		</div>
		<!-- END RSS ICON COUNT SECTION-->  
        
		<!-- EMAIL ICON COUNT SECTION-->
		<div class="sfsiplus_specify_counts sfsiplus_email_section">
			<div class="radio_section">
				<input name="sfsi_plus_email_countsDisplay" <?php echo ($option4['sfsi_plus_email_countsDisplay']=='yes') ?  'checked="true"' : '' ;?> type="checkbox" value="yes" class="styled"  />
			</div>
			<div class="social_icon_like">
				<ul class="like_icon">
					<li>
						<a title="Email">
							<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/<?php echo $email_image; ?>" alt="Email" />
							<span><?php echo $counts['email_count']; ?></span>
						</a>
					</li>
				</ul>
			</div>
			<div class="listing">
				<ul>
					<li>
						<input name="sfsi_plus_email_countsFrom" <?php echo ($option4['sfsi_plus_email_countsFrom']=='source') ?  'checked="true"' : '' ;?>  type="radio" value="source" class="styled"  />
						 <?php
							_e('Retrieve the number of subscribers automatically', SFSI_PLUS_DOMAIN); ?>
					</li>
					<li>
						<input name="sfsi_plus_email_countsFrom" <?php echo ($option4['sfsi_plus_email_countsFrom']=='manual') ?  'checked="true"' : '' ;?>  type="radio" value="manual" class="styled" />
						<?php  _e( 'Enter the figure manually', SFSI_PLUS_DOMAIN ); ?>
						<input name="sfsi_plus_email_manualCounts" type="text" class="input" value="<?php echo ($option4['sfsi_plus_email_manualCounts']!='') ?  $option4['sfsi_plus_email_manualCounts'] : '' ;?>" style="<?php echo ($option4['sfsi_plus_email_countsFrom']=='source') ?  'display:none;' : '' ;?>" />
					</li>
				</ul>
			</div>    
		</div>
		<!--END  EMAIL  ICON COUNT SECTION--> 
        
		<!-- FACEBOOK ICON COUNT SECTION-->
		<div class="sfsiplus_specify_counts sfsiplus_facebook_section">
			<div class="radio_section">
				<input name="sfsi_plus_facebook_countsDisplay" <?php echo ($option4['sfsi_plus_facebook_countsDisplay']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled"  />
			</div>
			<div class="social_icon_like">
				<ul class="like_icon">
					<li>
						<a title="Facebook">
							<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/fb.png" alt="Facebook" />
							<span><?php echo $counts['fb_count']; ?></span>
						</a>
					</li>
				</ul>
			</div>
			<div class="listing">
				<ul class="sfsi_plus_fb_popup_contain">
					<li>
						<input name="sfsi_plus_facebook_countsFrom" <?php echo ($option4['sfsi_plus_facebook_countsFrom']=='likes') ?  'checked="true"' : '' ;?>  type="radio" value="likes" class="styled"  />           
						<?php  _e( 'Retrieve the number of likes of your blog', SFSI_PLUS_DOMAIN ); ?>
					</li>
					<li>
						<input name="sfsi_plus_facebook_countsFrom" <?php echo ($option4['sfsi_plus_facebook_countsFrom']=='mypage') ?  'checked="true"' : '' ;?>  type="radio" value="mypage" class="styled"  />
						<?php  _e( 'Retrieve the number of likes of your Facebook page', SFSI_PLUS_DOMAIN ); ?>
						<br>
						<div class="sfsiplus_fbpgiddesc sfsi_plus_fbpaget">
							<div class="sfsiplus_fbpgidwpr sfsi_plus_count" style="<?php echo ($option4['sfsi_plus_facebook_countsFrom']=='likes' || $option4['sfsi_plus_facebook_countsFrom']=='followers' || $option4['sfsi_plus_facebook_countsFrom']=='manual') ?  'display:none;' : '' ;?>">
								 Facebook <?php  _e( 'page ID:', SFSI_PLUS_DOMAIN ); ?>
							</div>
							<input name="sfsi_plus_facebook_mypageCounts" type="text" class="input mypginpt" value="<?php echo ($option4['sfsi_plus_facebook_mypageCounts']!='') ?  $option4['sfsi_plus_facebook_mypageCounts'] : '' ;?>" style="<?php echo ($option4['sfsi_plus_facebook_countsFrom']=='likes' || $option4['sfsi_plus_facebook_countsFrom']=='followers' || $option4['sfsi_plus_facebook_countsFrom']=='manual') ?  'display:none;' : '' ;?>" />
						</div>
						<div class="sfsiplus_fbpgidwpr sfsiplus_fbpgiddesc sfsi_plus_facebook_count" style="<?php echo ($option4['sfsi_plus_facebook_countsFrom']=='likes' || $option4['sfsi_plus_facebook_countsFrom']=='followers' || $option4['sfsi_plus_facebook_countsFrom']=='manual') ?  'display:none;' : '' ;?>">
							(<?php  _e( "You'll find it at the bottom of the << About >> -tab on your Facebook page", SFSI_PLUS_DOMAIN ); ?>)
						</div>
					</li>
					<li>
						<input name="sfsi_plus_facebook_countsFrom" <?php echo ($option4['sfsi_plus_facebook_countsFrom']=='manual') ?  'checked="true"' : '' ;?>  type="radio" value="manual" class="styled" />
						<?php  _e( 'Enter the figure manually', SFSI_PLUS_DOMAIN ); ?>
						<input name="sfsi_plus_facebook_manualCounts" type="text" class="input" value="<?php echo ($option4['sfsi_plus_facebook_manualCounts']!='') ?  $option4['sfsi_plus_facebook_manualCounts'] : '' ;?>"  style="<?php echo ($option4['sfsi_plus_facebook_countsFrom']=='likes' || $option4['sfsi_plus_facebook_countsFrom']=='followers' || $option4['sfsi_plus_facebook_countsFrom']=='mypage') ?  'display:none;' : '' ;?>" />
					</li>
				</ul>
				<?php if($option4['sfsi_plus_premium_count_box'] =='yes') { ?>
				<div class="sfsi_plus_facebook_pagedeasc" style="<?php echo (isset($option4['sfsi_plus_facebook_countsFrom']) && $option4['sfsi_plus_facebook_countsFrom'] =='manual') ?  'display:none;' : '' ;?>">
					<p class="sfsi_plus_shared_premium">
						<b><?php  _e( 'Note: ', SFSI_PLUS_DOMAIN ); ?></b><?php  _e( 'This plugin uses one API shared by all users of this plugin. There is a limit (set by Facebook) how often this API can get the counts per day, so it may happen that it returns “0 counts” later in the day.', SFSI_PLUS_DOMAIN ); ?><br><br><?php  _e( 'Therefore we implemented a solution as part of our Premium Plugin where you can easily set up your own API in a few steps, which will fix this problem.', SFSI_PLUS_DOMAIN ); ?><br><br><a  class="pop-up" data-id="sfsi_plus_quickpay-overlay" onclick="sfsi_plus_open_quick_checkout(event)"  class="sfisi_plus_font_bold" style="cursor:pointer;border-bottom: 1px solid #12a252;color: #12a252 !important;" target="_blank">Go premium now</a><a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmplus_settings_page&utm_campaign=facebook_counts&utm_medium=banner" class="sfsi_plus_font_inherit" style="color: #12a252 !important" target="_blank"> or learn more</a>
						</p>
                </div>
				<?php } ?>
			</div>    
		</div>
		<!-- END FACEBOOK ICON COUNT SECTION-->
        
		<!-- TWITTER ICON COUNT SECTION-->
		<div class="sfsiplus_specify_counts sfsiplus_twitter_section">
			<div class="radio_section">
				<input name="sfsi_plus_twitter_countsDisplay" <?php echo ($option4['sfsi_plus_twitter_countsDisplay']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled"  />
			</div>
			<div class="social_icon_like">
				<ul class="like_icon">
					<li>
						<a title="Twitter">
							<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/twitter.png" alt="Twitter" />
							<span><?php echo $counts['twitter_count']; ?></span>
						</a>
					</li>
				</ul>
			</div>
			<div class="listing">
				<ul>
					<li>
						<input name="sfsi_plus_twitter_countsFrom" <?php echo ($option4['sfsi_plus_twitter_countsFrom']=='source') ?  'checked="true"' : '' ;?>  type="radio" value="source" class="styled" />
						<?php  _e( 'Retrieve the number of Twitter followers', SFSI_PLUS_DOMAIN ); ?>
					</li>
					<li class="SFSI_tglli">
						<ul class="SFSI_lsngfrm">
							<li class="tw_follow_options" style="<?php echo ($option4['sfsi_plus_twitter_countsFrom']=='manual') ?  'display:none;' : '' ;?>">
								<label>
									<?php  _e( 'Enter Consumer Key', SFSI_PLUS_DOMAIN ); ?>
								</label>
								<input name="sfsiplus_tw_consumer_key" class="input_facebook" type="text" value="<?php echo (isset($option4['sfsiplus_tw_consumer_key']) && $option4['sfsiplus_tw_consumer_key']!='') ?  $option4['sfsiplus_tw_consumer_key'] : '' ;?>"  />
							</li>
							<li class="tw_follow_options" style="<?php echo ($option4['sfsi_plus_twitter_countsFrom']=='manual') ?  'display:none;' : '' ;?>">
								<label>
									<?php  _e( 'Enter Consumer Secret', SFSI_PLUS_DOMAIN ); ?>
							   </label>
								<input name="sfsiplus_tw_consumer_secret" class="input_facebook" type="text" value="<?php echo (isset($option4['sfsiplus_tw_consumer_secret']) && $option4['sfsiplus_tw_consumer_secret']!='') ?  $option4['sfsiplus_tw_consumer_secret'] : '' ;?>"  />
							</li>
							<li class="tw_follow_options" style="<?php echo ($option4['sfsi_plus_twitter_countsFrom']=='manual') ?  'display:none;' : '' ;?>">
								<label>
									<?php  _e( 'Enter Access Token', SFSI_PLUS_DOMAIN ); ?>
								</label> 
								<input name="sfsiplus_tw_oauth_access_token" class="input_facebook" type="text" value="<?php echo (isset($option4['sfsiplus_tw_oauth_access_token']) && $option4['sfsiplus_tw_oauth_access_token']!='') ?  $option4['sfsiplus_tw_oauth_access_token'] : '' ;?>"  />
							</li>
							<li class="tw_follow_options" style="<?php echo ($option4['sfsi_plus_twitter_countsFrom']=='manual') ?  'display:none;' : '' ;?>">
								<label>
									<?php  _e( 'Enter Access Token Secret', SFSI_PLUS_DOMAIN ); ?>
								</label>
								<input name="sfsiplus_tw_oauth_access_token_secret" class="input_facebook" type="text" value="<?php echo (isset($option4['sfsiplus_tw_oauth_access_token_secret']) && $option4['sfsiplus_tw_oauth_access_token_secret']!='') ?  $option4['sfsiplus_tw_oauth_access_token_secret'] : '' ;?>"  /> 	
							</li>
						 </ul>
						<ul class="SFSI_instructions">
							<li class="tw_follow_options" style="<?php echo ($option4['sfsi_plus_twitter_countsFrom']=='manual') ?  'display:none;' : '' ;?>">
								<?php  _e( 'Please make sure you have entered the Username for "Follow me on Twitter:" in twitter settings under question number 2.', SFSI_PLUS_DOMAIN ); ?>
							</li>
							<li class="tw_follow_options" style="<?php echo ($option4['sfsi_plus_twitter_countsFrom']=='manual') ?  'display:none;' : '' ;?>">
								<h3 style="font-size: 18px;">
									<?php  _e( 'To get this information:', SFSI_PLUS_DOMAIN ); ?> 
								</h3>
							</li>
							<li class="tw_follow_options" style="<?php echo ($option4['sfsi_plus_twitter_countsFrom']=='manual') ?  'display:none;' : '' ;?>">
								1: <?php  _e( 'Go to', SFSI_PLUS_DOMAIN ); ?>
								<a href="https://apps.twitter.com" target="_blank">
								 apps.twitter.com
								</a>
							</li>
							<li class="tw_follow_options" style="<?php echo ($option4['sfsi_plus_twitter_countsFrom']=='manual') ?  'display:none;' : '' ;?>">
								2: <?php  _e( 'Click on "Create new app"', SFSI_PLUS_DOMAIN ); ?>
							</li>
							<li class="tw_follow_options" style="<?php echo ($option4['sfsi_plus_twitter_countsFrom']=='manual') ?  'display:none;' : '' ;?>">
								3: <?php  _e( 'Enter a random Name, Description and Website URL (including the "http://", e.g. http://dummysitename.com)', SFSI_PLUS_DOMAIN ); ?>
							</li>
							<li class="tw_follow_options" style="<?php echo ($option4['sfsi_plus_twitter_countsFrom']=='manual') ?  'display:none;' : '' ;?>">
								4: <?php  _e( 'Go to "Keys and Access Tokens" tab and click on "Generate Token" in the "Token actions" section at the bottom', SFSI_PLUS_DOMAIN ); ?>
							</li>
							<li class="tw_follow_options" style="<?php echo ($option4['sfsi_plus_twitter_countsFrom']=='manual') ?  'display:none;' : '' ;?>">
								5: <?php _e('Then click on "Test OAuth" at the top right and you will see the 4 token key',SFSI_PLUS_DOMAIN ); ?>
						   </li>
						</ul>
					</li>
					<li>
						<input name="sfsi_plus_twitter_countsFrom" <?php echo ($option4['sfsi_plus_twitter_countsFrom']=='manual') ?  'checked="true"' : '' ;?>  type="radio" value="manual" class="styled" />
						<?php  _e( 'Enter the figure manually', SFSI_PLUS_DOMAIN ); ?>
						<input name="sfsi_plus_twitter_manualCounts" type="text" class="input" value="<?php echo ($option4['sfsi_plus_twitter_manualCounts']!='') ?  $option4['sfsi_plus_twitter_manualCounts'] : '' ;?>" style="<?php echo ($option4['sfsi_plus_twitter_countsFrom']=='source') ?  'display:none;' : '' ;?>" />
					</li>
				</ul>
			</div>    
		</div>  
		<!--END TWITTER ICON COUNT SECTION-->
        
		<!-- LINKEDIN ICON COUNT SECTION-->
		<div class="sfsiplus_specify_counts sfsiplus_linkedin_section">
			<div class="radio_section">
				<input name="sfsi_plus_linkedIn_countsDisplay" <?php echo ($option4['sfsi_plus_linkedIn_countsDisplay']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled"  />
			</div>
			<div class="social_icon_like">
				<ul class="like_icon">
					<li>
						<a title="Linked in">
							<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/linked_in.png" alt="Linked in" />
							<span><?php echo $counts['linkedIn_count']; ?></span>
						</a>
					</li>
				</ul>
			</div>

			<div class="listing">
				<ul>
					<?php /*?><li><input name="sfsi_plus_linkedIn_countsFrom" <?php echo ($option4['sfsi_plus_linkedIn_countsFrom']=='follower') ?  'checked="true"' : '' ;?>  type="radio" value="follower" class="styled"  />Retrieve the number of Linkedin followers</li>
						<li class="SFSI_tglli">
							<ul class="SFSI_lsngfrm">
								<li class="linkedIn_options" style="<?php echo ($option4['sfsi_plus_linkedIn_countsFrom']=='manual') ?  'display:none;' : '' ;?>"><label>Enter Company Name </label><input name="sfsi_plus_ln_company" class="input_facebook" type="text" value="<?php echo (isset($option4['sfsi_plus_ln_company']) && $option4['sfsi_plus_ln_company']!='') ?  $option4['sfsi_plus_ln_company'] : '' ;?>"  /> </li>
						<li  class="linkedIn_options" style="<?php echo ($option4['sfsi_plus_linkedIn_countsFrom']=='manual') ?  'display:none;' : '' ;?>"><label>Enter API Key </label><input name="sfsi_plus_ln_api_key" class="input_facebook" type="text" value="<?php echo (isset($option4['sfsi_plus_ln_api_key']) && $option4['sfsi_plus_ln_api_key']!='') ?  $option4['sfsi_plus_ln_api_key'] : '' ;?>"  /> </li>
						<li  class="linkedIn_options" style="<?php echo ($option4['sfsi_plus_linkedIn_countsFrom']=='manual') ?  'display:none;' : '' ;?>"><label>Enter Secret Key </label><input name="sfsi_plus_ln_secret_key" class="input_facebook" type="text" value="<?php echo (isset($option4['sfsi_plus_ln_secret_key']) && $option4['sfsi_plus_ln_secret_key']!='') ?  $option4['sfsi_plus_ln_secret_key'] : '' ;?>"  /> </li>
						<li  class="linkedIn_options" style="<?php echo ($option4['sfsi_plus_linkedIn_countsFrom']=='manual') ?  'display:none;' : '' ;?>" ><label>Enter OAuth User Token</label> <input name="sfsi_plus_ln_oAuth_user_token" class="input_facebook" type="text" value="<?php echo (isset($option4['sfsi_plus_ln_oAuth_user_token']) && $option4['sfsi_plus_ln_oAuth_user_token']!='') ?  $option4['sfsi_plus_ln_oAuth_user_token'] : '' ;?>"  /> </li>
					</ul>
					<ul class="SFSI_instructions">
						<li class="linkedIn_options" style="<?php echo ($option4['sfsi_plus_linkedIn_countsFrom']=='manual') ?  'display:none;' : '' ;?>"><h3>To get the API key for LinkedIn:</h3></li>
						<li class="linkedIn_options" style="<?php echo ($option4['sfsi_plus_linkedIn_countsFrom']=='manual') ?  'display:none;' : '' ;?>">1: Go to <a href="https://developer.linkedin.com/" target="_blank">www.developer.linkedin.com</a>, mouse over “Support” and select “API keys”</li>
						<li class="linkedIn_options" style="<?php echo ($option4['sfsi_plus_linkedIn_countsFrom']=='manual') ?  'display:none;' : '' ;?>">2: Then login with your Linkedin account and create a new application</li>
						<li class="linkedIn_options" style="<?php echo ($option4['sfsi_plus_linkedIn_countsFrom']=='manual') ?  'display:none;' : '' ;?>">3: Fill the required boxes in the form with random data, accept the Terms and add the application</li>
						<li class="linkedIn_options" style="<?php echo ($option4['sfsi_plus_linkedIn_countsFrom']=='manual') ?  'display:none;' : '' ;?>">4: In the next step you will see the required API information</li>
						<li class="linkedIn_options" style="<?php echo ($option4['sfsi_plus_linkedIn_countsFrom']=='manual') ?  'display:none;' : '' ;?>">When you enter this key into the plugin for the first time, it may take some time until the correct follower count is displayed on your website.</li>
					</ul>    
					</li><?php */?>
					<li>
						<input name="sfsi_plus_linkedIn_countsFrom" <?php echo ($option4['sfsi_plus_linkedIn_countsFrom']=='manual' || $option4['sfsi_plus_linkedIn_countsFrom']=='follower') ?  'checked="true"' : '' ;?>  type="radio" value="manual" class="styled" />
						<?php  _e( 'Enter the figure manually', SFSI_PLUS_DOMAIN ); ?>
						<input name="sfsi_plus_linkedIn_manualCounts" type="text" class="input" value="<?php echo ($option4['sfsi_plus_linkedIn_manualCounts']!='') ?  $option4['sfsi_plus_linkedIn_manualCounts'] : '' ;?>" style="<?php echo ($option4['sfsi_plus_linkedIn_countsFrom']=='follower') ?  'display:none;' : '' ;?>" />
					</li>
				</ul>
			</div>
		</div>
		<!-- END LINKEDIN ICON COUNT SECTION-->
        
		<!-- YOUTUBE ICON COUNT SECTION-->
		<div class="sfsiplus_specify_counts sfsiplus_youtube_section">
			<div class="radio_section">
				<input name="sfsi_plus_youtube_countsDisplay" <?php echo ($option4['sfsi_plus_youtube_countsDisplay']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled"  />
			</div>
			<div class="social_icon_like">
				<ul class="like_icon">
					<li>
						<a title="YouTube">
							<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/youtube.png" alt="YouTube" />
							<span><?php echo $counts['youtube_count']; ?></span>
						</a>
					</li>
				</ul>
			</div>
			<div class="listing">
				<ul>
					<li>
						<input name="sfsi_plus_youtube_countsFrom" type="radio" value="subscriber" <?php echo ($option4['sfsi_plus_youtube_countsFrom']=='subscriber') ?  'checked="true"' : '' ;?>  class="styled"  />
						<?php  _e( 'Retrieve the number of Subscribers', SFSI_PLUS_DOMAIN ); ?>
					</li>
					<li class="youtube_options" style="<?php echo ($option4['sfsi_plus_youtube_countsFrom']=='manual') ?  'display:none;' : '' ;?>">
                    	<div>
                            <label>
                                <?php  _e( 'Enter Youtube User name', SFSI_PLUS_DOMAIN ); ?>
                            </label>
                            <input name="sfsi_plus_youtube_user" class="input_facebook" type="text" value="<?php echo (isset($option4['sfsi_plus_youtube_user']) && $option4['sfsi_plus_youtube_user']!='') ?  $option4['sfsi_plus_youtube_user'] : '' ;?>"/>
                        </div>
                        
                        <div>
                            <label>
                                <?php  _e( 'Enter Youtube Channel id', SFSI_PLUS_DOMAIN ); ?>
                            </label>
                            <input name="sfsi_plus_youtube_channelId" class="input_facebook" type="text" value="<?php echo (isset($option4['sfsi_plus_youtube_channelId']) && $option4['sfsi_plus_youtube_channelId']!='') ? $option4['sfsi_plus_youtube_channelId'] : '' ;?>"/>
                        </div>    
					</li>
					<li>
						<input name="sfsi_plus_youtube_countsFrom" type="radio" value="manual" <?php echo ($option4['sfsi_plus_youtube_countsFrom']=='manual') ?  'checked="true"' : '' ;?>  class="styled" />
						<?php  _e( 'Enter the figure manually', SFSI_PLUS_DOMAIN ); ?>
						<input name="sfsi_plus_youtube_manualCounts" type="text" class="input" value="<?php echo ($option4['sfsi_plus_youtube_manualCounts']!='') ?  $option4['sfsi_plus_youtube_manualCounts'] : '' ;?>" style="<?php echo ($option4['sfsi_plus_youtube_countsFrom']=='subscriber') ?  'display:none;' : '' ;?>" />
					</li>
				</ul>
			</div>
		</div>
		<!-- END YOUTUBE ICON COUNT SECTION-->
        
		<!-- PINIT ICON COUNT SECTION-->
		<div class="sfsiplus_specify_counts sfsiplus_pinterest_section">
			<div class="radio_section">
				<input name="sfsi_plus_pinterest_countsDisplay" <?php echo ($option4['sfsi_plus_pinterest_countsDisplay']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled"  />
			</div>
			<div class="social_icon_like">
				<ul class="like_icon">
					<li>
						<a title="Pinterest">
							<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/pinterest.png" alt="Pinterest" />
							<span><?php echo $counts['pin_count']; ?></span>
						</a>
					</li>
				</ul>
			</div>
			<div class="listing">
				<ul>
					<li>
						<input name="sfsi_plus_pinterest_countsFrom" <?php echo ($option4['sfsi_plus_pinterest_countsFrom']=='pins') ?  'checked="true"' : '' ;?>  type="radio" value="pins" class="styled"  />
						<?php  _e( 'Retrieve the number of Pins', SFSI_PLUS_DOMAIN ); ?>
					</li>
					<li>
						<input name="sfsi_plus_pinterest_countsFrom" <?php echo ($option4['sfsi_plus_pinterest_countsFrom']=='manual') ?  'checked="true"' : '' ;?>  type="radio" value="manual" class="styled" />
						<label class="high_prb">
							<?php  _e( 'Enter the figure manually', SFSI_PLUS_DOMAIN ); ?>
						</label>
						<input name="sfsi_plus_pinterest_manualCounts" type="text" class="input" value="<?php echo ($option4['sfsi_plus_pinterest_manualCounts']!='') ?  $option4['sfsi_plus_pinterest_manualCounts'] : '' ;?>" style="<?php echo ($option4['sfsi_plus_pinterest_countsFrom']=='pins') ?  'display:none;' : '' ;?>" />
					</li>
				</ul>
			</div>

			<div class="sfsi_plus_new_prmium_follw">
					<p>
						<b>New: </b>In the Premium Plugin you can also automatically show the number of PINs from your Pinterest account, or of a specific board, or the number of your Pinterest followers. <a style="cursor:pointer" class="pop-up" data-id="sfsi_plus_quickpay-overlay" onclick="sfsi_plus_open_quick_checkout(event)"  class="sfisi_plus_font_bold" target="_blank"><?php _e( 'Go premium now', SFSI_PLUS_DOMAIN); ?></a><a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmplus_settings_page&utm_campaign=more_pinterest_counts&utm_medium=banner" class="sfsi_plus_font_inherit" target="_blank"><?php _e( ' or learn more', SFSI_PLUS_DOMAIN); ?></a>
					</p>
			</div>			    
		</div>
		<!-- END PINIT ICON COUNT SECTION-->
        
		<!-- INSTAGRAM ICON COUNT SECTION-->
		<div class="sfsiplus_specify_counts sfsiplus_instagram_section">
			<div class="radio_section">
				<input name="sfsi_plus_instagram_countsDisplay" <?php echo ($option4['sfsi_plus_instagram_countsDisplay']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled"  />
			</div>
			<div class="social_icon_like">
				<ul class="like_icon">
					<li>
						<a title="Instagram">
							<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/instagram.png" alt="instagram" />
							<span><?php echo $counts['instagram_count']; ?></span>
						</a>
					</li>
				</ul>
			</div>
			<div class="listing">
				<ul>
					<li>
						<input name="sfsi_plus_instagram_countsFrom" <?php echo ($option4['sfsi_plus_instagram_countsFrom']=='followers') ?  'checked="true"' : '' ;?>  type="radio" value="followers" class="styled"  />
						<?php  _e( 'Retrieve the number of Instagram followers', SFSI_PLUS_DOMAIN ); ?>
					</li>
					<li class="instagram_userLi" style="<?php echo ($option4['sfsi_plus_instagram_countsFrom']=='manual') ?  'display:none;' : '' ;?>">
						<div class='sfsi_instagram_follower'>
							<div>
								<label>
									<?php  _e( 'Enter Instagram User name', SFSI_PLUS_DOMAIN ); ?>
								</label>
								<input name="sfsi_plus_instagram_User" class="input_facebook" type="text" value="<?php echo (isset($option4['sfsi_plus_instagram_User']) && $option4['sfsi_plus_instagram_User']!='') ?  $option4['sfsi_plus_instagram_User'] : '' ;?>"  />
							</div>
	                        <div>
	                            <label>
	                                <?php  _e( 'Enter Instagram Client Id', SFSI_PLUS_DOMAIN ); ?>
	                            </label>
	                            <input name="sfsi_plus_instagram_clientid" class="input_facebook" type="text" value="<?php echo (isset($option4['sfsi_plus_instagram_clientid']))? $option4['sfsi_plus_instagram_clientid']:'';?>"/>
	                        </div>
	                        <div>
	                            <label>
	                        	    <?php  _e( 'Enter Instagram Redirect Url', SFSI_PLUS_DOMAIN ); ?>
	                            </label>
	                           	<input name="sfsi_plus_instagram_appurl" class="input_facebook" type="text" value="<?php echo (isset($option4['sfsi_plus_instagram_appurl'])) ? $option4['sfsi_plus_instagram_appurl'] : '';?>"/>
	                        </div>
	                        <div class="sfsi_plus_tokenGenerateButton">
	                            <p>For generate your app token you need to enter your "Client Id" and "Redirect Url".</p>
	                            <a href="javascript:">
	                                <?php _e("Generate Token", SFSI_PLUS_DOMAIN);?>
	                            </a>
	                        </div>
	                        <div>
	                            <label>
	                                <?php  _e( 'Enter Instagram Token', SFSI_PLUS_DOMAIN ); ?>
	                            </label>
	                            <input name="sfsi_plus_instagram_token" class="input_facebook" type="text" value="<?php echo (isset($option4['sfsi_plus_instagram_token'])) ? $option4['sfsi_plus_instagram_token'] : '';?>"/>
	                        </div>
                        </div>
                        <div class="sfsi_plus_instagramInstruction">
                        	<p>To complete the process please follow these steps:</p>
                            <ul>
                            	<li>Go to <a href="https://www.instagram.com/developer" target="_blank">https://www.instagram.com/developer</a></li>
                                <li><?php _e('Login and then click on “Register Your Application” to get to the “Manage Clients” section. On there click on the “Register a new client” button', SFSI_PLUS_DOMAIN ); ?>.</li>
                                <li><?php _e('Fill out the form and make sure that the “Redirect url” is valid and uncheck the “Disable Implicit oAuth” under the security tab', SFSI_PLUS_DOMAIN ); ?>.</li> 
                                <li><?php _e('Then click on “Register” button', SFSI_PLUS_DOMAIN ); ?>.</li>
                                <li><?php _e('Copy the “Client id” and “Redirect url” you entered into the plugin. Also enter your Instagram User name. After that click on the “Generate token” button', SFSI_PLUS_DOMAIN ); ?>.</li>
                                <li><?php _e('Authorize your app to access your account info by clicking the “Authorize” button', SFSI_PLUS_DOMAIN ); ?>.</li>
                                <li><?php _e('Now you will be redirected to the redirect url (which you entered during app creation) and find your access token at the end of this url', SFSI_PLUS_DOMAIN ); ?> (For example: http://your-website.com/#access_token=< your access token >)</li>
                                <li><?php _e('Copy the access token, paste it into the plugin and click on “Save”', SFSI_PLUS_DOMAIN ); ?>.</li>
                            </ul>
                        </div>
					</li>
					<li>
						<input name="sfsi_plus_instagram_countsFrom" <?php echo ($option4['sfsi_plus_instagram_countsFrom']=='manual') ?  'checked="true"' : '' ;?>  type="radio" value="manual" class="styled" />
						<label class="high_prb">
							<?php  _e( 'Enter the figure manually', SFSI_PLUS_DOMAIN ); ?>
						</label>
							<input name="sfsi_plus_instagram_manualCounts" type="text" class="input" value="<?php echo ($option4['sfsi_plus_instagram_manualCounts']!='') ?  $option4['sfsi_plus_instagram_manualCounts'] : '' ;?>" style="<?php echo ($option4['sfsi_plus_instagram_countsFrom']=='followers') ?  'display:none;' : '' ;?>" />
					</li>
				</ul>
		   </div>    
		</div>
		<!-- END INSTAGRAM ICON COUNT SECTION-->
        
		<!-- HOUZZ ICON COUNT SECTION-->
		<div class="sfsiplus_specify_counts sfsiplus_houzz_section">
			<div class="radio_section">
				<input name="sfsi_plus_houzz_countsDisplay" <?php echo (isset($option4['sfsi_plus_houzz_countsDisplay']) && $option4['sfsi_plus_houzz_countsDisplay']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled"  />
			</div>
			<div class="social_icon_like">
				<ul class="like_icon">
					<li>
						<a title="Houzz">
							<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/houzz.png" alt="Houzz" />
							<span><?php echo isset($counts['houzz_count'])?$counts['houzz_count']:0; ?></span>
						</a>
					</li>
				</ul>
			</div>
			<div class="listing">
				<ul>
					<li>
						<input name="sfsi_plus_houzz_countsFrom" checked="true" type="radio" value="manual" class="styled" />
						<label class="high_prb">
							<?php  _e( 'Enter the figure manually', SFSI_PLUS_DOMAIN ); ?>
						</label>
						<input name="sfsi_plus_houzz_manualCounts" type="text" class="input" value="<?php echo (isset($option4['sfsi_plus_houzz_manualCounts']) && $option4['sfsi_plus_houzz_manualCounts']!='') ?  $option4['sfsi_plus_houzz_manualCounts'] : '20' ;?>" />
					</li>
				</ul>
			</div>    
		</div>
  		<!-- END HOUZZ ICON COUNT SECTION-->

  		<!-- TELEGRAM ICON COUNT SECTION-->
		<div class="sfsiplus_specify_counts sfsiplus_telegram_section">
			<div class="radio_section">
				<input name="sfsi_plus_telegram_countsDisplay" <?php echo (isset($option4['sfsi_plus_telegram_countsDisplay']) && $option4['sfsi_plus_telegram_countsDisplay']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled"  />
			</div>
			<div class="social_icon_like">
				<ul class="like_icon">
					<li>
						<a title="Telegram">
							<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/telegram.png" alt="Telegram" />
							<span><?php echo isset($counts['telegram_count'])?$counts['telegram_count']:0; ?></span>
						</a>
					</li>
				</ul>
			</div>
			<div class="listing">
				<ul>
					<li>
						<input name="sfsi_plus_telegram_countsFrom" checked="true" type="radio" value="manual" class="styled" />
						<label class="high_prb">
							<?php  _e( 'Enter the figure manually', SFSI_PLUS_DOMAIN ); ?>
						</label>
						<input name="sfsi_plus_telegram_manualCounts" type="text" class="input" value="<?php echo (isset($option4['sfsi_plus_telegram_manualCounts']) && $option4['sfsi_plus_telegram_manualCounts']!='') ?  $option4['sfsi_plus_telegram_manualCounts'] : '20' ;?>" />
					</li>
				</ul>
			</div>    
		</div>
  		<!-- END TELEGRAM ICON COUNT SECTION-->

  		<!-- VK ICON COUNT SECTION-->
		<div class="sfsiplus_specify_counts sfsiplus_vk_section">
			<div class="radio_section">
				<input name="sfsi_plus_vk_countsDisplay" <?php echo (isset($option4['sfsi_plus_vk_countsDisplay']) && $option4['sfsi_plus_vk_countsDisplay']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled"  />
			</div>
			<div class="social_icon_like">
				<ul class="like_icon">
					<li>
						<a title="VK">
							<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/vk.png" alt="VK" />
							<span><?php echo isset($counts['vk_count'])?$counts['vk_count']:0; ?></span>
						</a>
					</li>
				</ul>
			</div>
			<div class="listing">
				<ul>
					<li>
						<input name="sfsi_plus_vk_countsFrom" checked="true" type="radio" value="manual" class="styled" />
						<label class="high_prb">
							<?php  _e( 'Enter the figure manually', SFSI_PLUS_DOMAIN ); ?>
						</label>
						<input name="sfsi_plus_vk_manualCounts" type="text" class="input" value="<?php echo (isset($option4['sfsi_plus_vk_manualCounts']) && $option4['sfsi_plus_vk_manualCounts']!='') ?  $option4['sfsi_plus_vk_manualCounts'] : '20' ;?>" />
					</li>
				</ul>
			</div>    
		</div>
  		<!-- END VK ICON COUNT SECTION-->

  		<!-- OK ICON COUNT SECTION-->
		<div class="sfsiplus_specify_counts sfsiplus_ok_section">
			<div class="radio_section">
				<input name="sfsi_plus_ok_countsDisplay" <?php echo (isset($option4['sfsi_plus_ok_countsDisplay']) && $option4['sfsi_plus_ok_countsDisplay']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled"  />
			</div>
			<div class="social_icon_like">
				<ul class="like_icon">
					<li>
						<a title="OK">
							<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/ok.png" alt="OK" />
							<span><?php echo isset($counts['ok_count'])?$counts['ok_count']:0; ?></span>
						</a>
					</li>
				</ul>
			</div>
			<div class="listing">
				<ul>
					<li>
						<input name="sfsi_plus_ok_countsFrom" checked="true" type="radio" value="manual" class="styled" />
						<label class="high_prb">
							<?php  _e( 'Enter the figure manually', SFSI_PLUS_DOMAIN ); ?>
						</label>
						<input name="sfsi_plus_ok_manualCounts" type="text" class="input" value="<?php echo (isset($option4['sfsi_plus_ok_manualCounts']) && $option4['sfsi_plus_ok_manualCounts']!='') ?  $option4['sfsi_plus_ok_manualCounts'] : '20' ;?>" />
					</li>
				</ul>
			</div>    
		</div>
  		<!-- END OK ICON COUNT SECTION-->

  		<!-- WEIBO ICON COUNT SECTION-->
		<div class="sfsiplus_specify_counts sfsiplus_weibo_section">
			<div class="radio_section">
				<input name="sfsi_plus_weibo_countsDisplay" <?php echo (isset($option4['sfsi_plus_weibo_countsDisplay']) && $option4['sfsi_plus_weibo_countsDisplay']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled"  />
			</div>
			<div class="social_icon_like">
				<ul class="like_icon">
					<li>
						<a title="Weibo">
							<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/weibo.png" alt="Weibo" />
							<span><?php echo isset($counts['weibo_count'])?$counts['weibo_count']:0; ?></span>
						</a>
					</li>
				</ul>
			</div>
			<div class="listing">
				<ul>
					<li>
						<input name="sfsi_plus_weibo_countsFrom" checked="true" type="radio" value="manual" class="styled" />
						<label class="high_prb">
							<?php  _e( 'Enter the figure manually', SFSI_PLUS_DOMAIN ); ?>
						</label>
						<input name="sfsi_plus_weibo_manualCounts" type="text" class="input" value="<?php echo (isset($option4['sfsi_plus_weibo_manualCounts']) && $option4['sfsi_plus_weibo_manualCounts']!='') ?  $option4['sfsi_plus_weibo_manualCounts'] : '20' ;?>" />
					</li>
				</ul>
			</div>    
		</div>
  		<!-- END WEIBO ICON COUNT SECTION-->

  		<!-- WECHAT ICON COUNT SECTION-->
		<div class="sfsiplus_specify_counts sfsiplus_wechat_section">
			<div class="radio_section">
				<input name="sfsi_plus_wechat_countsDisplay" <?php echo (isset($option4['sfsi_plus_wechat_countsDisplay']) && $option4['sfsi_plus_wechat_countsDisplay']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled"  />
			</div>
			<div class="social_icon_like">
				<ul class="like_icon">
					<li>
						<a title="Wechat">
							<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/wechat.png" alt="Wechat" />
							<span><?php echo $counts['wechat_count']?></span>
						</a>
					</li>
				</ul>
			</div>
			<div class="listing">
				<ul>
					<li>
						<input name="sfsi_plus_wechat_countsFrom" checked="true" type="radio" value="manual" class="styled" />
						<label class="high_prb">
							<?php  _e( 'Enter the figure manually', SFSI_PLUS_DOMAIN ); ?>
						</label>
						<input name="sfsi_plus_wechat_manualCounts" type="text" class="input" value="<?php echo (isset($option4['sfsi_plus_wechat_manualCounts']) && $option4['sfsi_plus_wechat_manualCounts']!='') ?  $option4['sfsi_plus_wechat_manualCounts'] : '20' ;?>" />
					</li>
				</ul>
			</div>    
		</div>
		  <!-- END WECHAT ICON COUNT SECTION-->
		  <h4 style="clear: both;"><?php  _e( 'For which icons do you want to show the counts?', SFSI_PLUS_DOMAIN ); ?></h4>
		  <div class="sfsiplus_specify_counts" style="border-top: 0px solid #eaebee;padding-top: 0px;">
				<div class="radio_section">
					<input name="sfsi_plus_round_counts" <?php echo (isset($option4['sfsi_plus_round_counts']) && $option4['sfsi_plus_round_counts']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled"  />
				</div>
				<div >
					<ul class="listing">
						<li>
						<?php  _e( 'Round icons', SFSI_PLUS_DOMAIN ); ?>
							
						</li>
					</ul>
				</div>
			</div>
			
			<div class="sfsiplus_specify_counts" style="border-top: 0px solid #eaebee;padding-top: 0px;">
				<div class="radio_section">
					<input name="sfsi_plus_original_counts" <?php echo (isset($option4['sfsi_plus_original_counts']) && $option4['sfsi_plus_original_counts']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled"  />
				</div>
				<div >
					<ul class="listing">
						<li>
						<?php  _e( 'Original icons', SFSI_PLUS_DOMAIN ); ?>
							
						</li>
					</ul>
				</div>
			</div>
			
			<div class="sfsiplus_specify_counts" style="border-top: 0px solid #eaebee;padding-top: 0px;">
				<div class="radio_section">
					<input name="sfsi_plus_responsive_share_count" <?php echo (isset($option4['sfsi_plus_responsive_share_count']) && $option4['sfsi_plus_responsive_share_count']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled"  />
				</div>
				<div >
					<ul class="listing">
						<li>
						<?php  _e( 'Responsive icons', SFSI_PLUS_DOMAIN ); ?>
							
						</li>
					</ul>
				</div>
		    </div>
  		
	</div>
	<!-- END show/hide counts for all icons section -->
    
	<?php sfsi_plus_ask_for_help(4); ?>

	<!-- SAVE BUTTON SECTION   --> 
	<div class="save_button">
		<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/ajax-loader.gif" class="loader-img" />
		<?php  $nonce = wp_create_nonce("update_plus_step4"); ?>
		<a href="javascript:;" id="sfsi_plus_save4" title="Save" data-nonce="<?php echo $nonce;?>">
			<?php  _e( 'Save', SFSI_PLUS_DOMAIN ); ?>
		</a>
	</div>
	<!-- END SAVE BUTTON SECTION   -->
	<a class="sfsiColbtn closeSec" href="javascript:;">
		<?php  _e( 'Collapse area', SFSI_PLUS_DOMAIN ); ?>
	</a>
	<label class="closeSec"></label>
	<!-- ERROR AND SUCCESS MESSAGE AREA-->
	<p class="red_txt errorMsg" style="display:none"> </p>
	<p class="green_txt sucMsg" style="display:none"> </p>
	<div class="clear"></div>
</div>
<!-- END Section 4 "Do you want to display "counts" next to your icons?"  -->
