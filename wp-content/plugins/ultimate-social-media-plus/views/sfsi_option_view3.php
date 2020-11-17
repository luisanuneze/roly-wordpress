<?php
/* unserialize all saved option for second section options */
$option3 =  unserialize(get_option('sfsi_plus_section3_options', false));
/*
	 * Sanitize, escape and validate values
	 */
$option3['sfsi_plus_actvite_theme']         = (isset($option3['sfsi_plus_actvite_theme']))
    ? sanitize_text_field($option3['sfsi_plus_actvite_theme'])
    : '';
$option3['sfsi_plus_mouseOver']             = (isset($option3['sfsi_plus_mouseOver']))
    ? sanitize_text_field($option3['sfsi_plus_mouseOver'])
    : '';
$option3['sfsi_plus_mouseOver_effect']         = (isset($option3['sfsi_plus_mouseOver_effect']))
    ? sanitize_text_field($option3['sfsi_plus_mouseOver_effect'])
    : '';

$option3['sfsi_plus_shuffle_Firstload']     = (isset($option3['sfsi_plus_shuffle_Firstload']))
    ? sanitize_text_field($option3['sfsi_plus_shuffle_Firstload'])
    : '';
$option3['sfsi_plus_shuffle_interval']         = (isset($option3['sfsi_plus_shuffle_interval']))
    ? sanitize_text_field($option3['sfsi_plus_shuffle_interval'])
    : '';
$option3['sfsi_plus_shuffle_intervalTime']     = (isset($option3['sfsi_plus_shuffle_intervalTime']))
    ? intval($option3['sfsi_plus_shuffle_intervalTime'])
    : '';
$option3['sfsi_plus_premium_icons_design_box']     = (isset($option3['sfsi_plus_premium_icons_design_box']))
    ? intval($option3['sfsi_plus_premium_icons_design_box'])
    : 'yes';
$option3['sfsi_plus_mouseOver_effect_type'] = (isset($option3['sfsi_plus_mouseOver_effect_type'])) ? sanitize_text_field($option3['sfsi_plus_mouseOver_effect_type']) : 'same_icons';

$mouseover_other_icons_transition_effect = (isset($option3['mouseover_other_icons_transition_effect'])) ? sanitize_text_field($option3['mouseover_other_icons_transition_effect']) : 'flip';
?>
<!-- Section 3 "What design & animation do you want to give your icons?" main div Start -->
<div class="tab3">
    <!--Content of 4-->
    <div class="row mouse_txt sfsiplusmousetxt tab3">
        <p>
            <?php _e('A good & well-fitting design is not only nice to look at, but it increases the chances that people will subscribe and/or share your site with friends:', SFSI_PLUS_DOMAIN); ?>
        </p>
        <ul class="tab_3_list">
            <li>
                <?php _e('It comes across as more professional and gives your site more “credit”', SFSI_PLUS_DOMAIN); ?>
            </li>
            <li>
                <?php _e('A smart automatic animation can make your visitors aware of your icons in an unintrusive manner', SFSI_PLUS_DOMAIN); ?>
            </li>
        </ul>

        <p style="padding:0px;">
            <?php _e('The icons have been compressed by Shortpixel.com for faster loading of your site. Thank you Shortpixel!', SFSI_PLUS_DOMAIN); ?>
        </p>

        <div class="row">
            <h3>
                <?php _e('Theme options', SFSI_PLUS_DOMAIN); ?>
            </h3>
            <!--icon themes section start -->
            <ul class="sfsiplus_tab_3_icns">
                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'default') ?  'checked="true"' : ''; ?> type="radio" value="default" class="styled" />
                    <label>
                        <?php _e('Default', SFSI_PLUS_DOMAIN); ?>
                    </label>
                    <div class="sfsiplus_icns_tab_3">
                        <span class="sfsiplus_row_1_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_1_2 sfsiplus_email_section"></span><span class="sfsiplus_row_1_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_1_5 sfsiplus_twitter_section"></span><span class="sfsiplus_row_1_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_1_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_1_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_1_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_1_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_1_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_1_23 sfsiplus_vk_section"></span><span class="sfsiplus_row_1_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_1_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_1_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_1_11 sf_section"></span>-->
                    </div>
                </li>

                <li class="sfsi_plus_notificationBannner" style="display:none">
                </li>

                <li class="sfsi_webtheme" style='display:none'>
                    <span class="radio" style="opacity: 0.5;"></span>
                    <label class="sfsi_premium_ad_lable" style="text-transform: capitalize;">Default</label>
                    <div class="icns_tab_3 sfsi_premium_ad"><span class="premium_col_1 rss_section"></span><span class="premium_col_2 email_section"></span><span class="premium_col_3 facebook_section"></span><span class="premium_col_4 twitter_section"></span>
                        <div class="sfis_premium_ad_name">(Premium)</div>
                        <!--<span class="row_1_11 sf_section"></span>-->
                    </div>
                </li>

                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'flat') ?  'checked="true"' : ''; ?> type="radio" value="flat" class="styled" />
                    <label>
                        <?php _e('Flat', SFSI_PLUS_DOMAIN); ?>
                    </label>
                    <div class="sfsiplus_icns_tab_3"><span class="sfsiplus_row_2_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_2_2 sfsiplus_email_section"></span><span class="sfsiplus_row_2_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_2_5 sfsiplus_twitter_section"></span><span class="sfsiplus_row_2_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_2_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_2_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_2_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_2_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_2_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_2_23 sfsiplus_vk_section"></span><span class="sfsiplus_row_2_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_2_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_2_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_2_11 sf_section"></span>-->
                    </div>
                </li>

                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'thin') ?  'checked="true"' : ''; ?> type="radio" value="thin" class="styled" />
                    <label>
                        <?php _e('Thin', SFSI_PLUS_DOMAIN); ?>
                    </label>
                    <div class="sfsiplus_icns_tab_3"><span class="sfsiplus_row_3_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_3_2 sfsiplus_email_section"></span><span class="sfsiplus_row_3_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_3_5 sfsiplus_twitter_section"></span><span class="sfsiplus_row_3_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_3_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_3_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_3_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_3_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_3_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_3_23 sfsiplus_vk_section"></span><span class="sfsiplus_row_3_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_3_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_3_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_3_11 sf_section"></span>-->
                    </div>
                </li>

                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'cute') ?  'checked="true"' : ''; ?> type="radio" value="cute" class="styled" />
                    <label>
                        <?php _e('Cute', SFSI_PLUS_DOMAIN); ?>
                    </label>
                    <div class="sfsiplus_icns_tab_3"><span class="sfsiplus_row_4_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_4_2 sfsiplus_email_section"></span><span class="sfsiplus_row_4_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_4_5  sfsiplus_twitter_section"></span><span class="sfsiplus_row_4_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_4_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_4_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_4_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_4_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_4_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_4_23 sfsiplus_vk_section"></span><span class="sfsiplus_row_4_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_4_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_4_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_4_11 sf_section"></span>-->
                    </div>
                </li>

                <!--------------------start next four------------------------>

                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'cubes') ?  'checked="true"' : ''; ?> type="radio" value="cubes" class="styled" />
                    <label><?php _e('Cubes', SFSI_PLUS_DOMAIN); ?></label>

                    <div class="sfsiplus_icns_tab_3"><span class="sfsiplus_row_5_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_5_2 sfsiplus_email_section"></span><span class="sfsiplus_row_5_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_5_5 sfsiplus_twitter_section"></span><span class="sfsiplus_row_5_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_5_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_5_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_5_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_5_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_5_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_5_23 sfsiplus_vk_section"></span><span class="sfsiplus_row_5_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_5_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_5_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_5_11 sf_section"></span>-->
                    </div>
                </li>

                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'chrome_blue') ?  'checked="true"' : ''; ?> type="radio" value="chrome_blue" class="styled" />
                    <label><?php _e('Chrome Blue', SFSI_PLUS_DOMAIN); ?></label>
                    <div class="sfsiplus_icns_tab_3"><span class="sfsiplus_row_6_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_6_2 sfsiplus_email_section"></span><span class="sfsiplus_row_6_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_6_5 sfsiplus_twitter_section"></span><span class="sfsiplus_row_6_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_6_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_6_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_6_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_6_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_6_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_6_23 sfsiplus_vk_section"></span> <span class="sfsiplus_row_6_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_6_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_6_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_6_11 sf_section"></span>-->
                    </div>
                </li>

                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'chrome_grey') ?  'checked="true"' : ''; ?> type="radio" value="chrome_grey" class="styled" />
                    <label><?php _e('Chrome Grey', SFSI_PLUS_DOMAIN); ?></label>
                    <div class="sfsiplus_icns_tab_3"><span class="sfsiplus_row_7_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_7_2 sfsiplus_email_section"></span><span class="sfsiplus_row_7_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_7_5 sfsiplus_twitter_section"></span><span class="sfsiplus_row_7_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_7_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_7_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_7_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_7_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_7_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_7_23 sfsiplus_vk_section"></span> <span class="sfsiplus_row_7_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_7_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_7_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_7_11 sf_section"></span>-->
                    </div>
                </li>

                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'splash') ?  'checked="true"' : ''; ?> type="radio" value="splash" class="styled" />
                    <label><?php _e('Splash', SFSI_PLUS_DOMAIN); ?></label>
                    <div class="sfsiplus_icns_tab_3"><span class="sfsiplus_row_8_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_8_2 sfsiplus_email_section"></span><span class="sfsiplus_row_8_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_8_5  sfsiplus_twitter_section"></span><span class="sfsiplus_row_8_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_8_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_8_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_8_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_8_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_8_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_8_23 sfsiplus_vk_section"></span> <span class="sfsiplus_row_8_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_8_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_8_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_8_11 sf_section"></span>-->
                    </div>
                </li>


                <!--------------------start second four------------------------>


                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'orange') ?  'checked="true"' : ''; ?> type="radio" value="orange" class="styled" />
                    <label><?php _e('Orange', SFSI_PLUS_DOMAIN); ?></label>
                    <div class="sfsiplus_icns_tab_3"><span class="sfsiplus_row_9_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_9_2 sfsiplus_email_section"></span><span class="sfsiplus_row_9_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_9_5 sfsiplus_twitter_section"></span><span class="sfsiplus_row_9_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_9_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_9_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_9_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_9_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_9_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_9_23 sfsiplus_vk_section"></span> <span class="sfsiplus_row_9_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_9_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_9_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_9_11 sf_section"></span>-->
                    </div>
                </li>

                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'crystal') ?  'checked="true"' : ''; ?> type="radio" value="crystal" class="styled" />
                    <label><?php _e('Crystal', SFSI_PLUS_DOMAIN); ?></label>
                    <div class="sfsiplus_icns_tab_3"><span class="sfsiplus_row_10_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_10_2 sfsiplus_email_section"></span><span class="sfsiplus_row_10_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_10_5 sfsiplus_twitter_section"></span><span class="sfsiplus_row_10_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_10_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_10_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_10_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_10_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_10_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_10_23 sfsiplus_vk_section"></span><span class="sfsiplus_row_10_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_10_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_10_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_10_11 sf_section"></span>-->
                    </div>
                </li>

                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'glossy') ?  'checked="true"' : ''; ?> type="radio" value="glossy" class="styled" />
                    <label><?php _e('Glossy', SFSI_PLUS_DOMAIN); ?></label>
                    <div class="sfsiplus_icns_tab_3"><span class="sfsiplus_row_11_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_11_2 sfsiplus_email_section"></span><span class="sfsiplus_row_11_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_11_5 sfsiplus_twitter_section"></span><span class="sfsiplus_row_11_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_11_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_11_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_11_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_11_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_11_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_11_23 sfsiplus_vk_section"></span> <span class="sfsiplus_row_11_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_11_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_11_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_11_11 sf_section"></span>-->
                    </div>
                </li>

                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'black') ?  'checked="true"' : ''; ?> type="radio" value="black" class="styled" />
                    <label><?php _e('Black', SFSI_PLUS_DOMAIN); ?></label>
                    <div class="sfsiplus_icns_tab_3"><span class="sfsiplus_row_12_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_12_2 sfsiplus_email_section"></span><span class="sfsiplus_row_12_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_12_5  sfsiplus_twitter_section"></span><span class="sfsiplus_row_12_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_12_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_12_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_12_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_12_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_12_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_12_23 sfsiplus_vk_section"></span> <span class="sfsiplus_row_12_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_12_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_12_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_12_11 sf_section"></span>-->
                    </div>
                </li>


                <!--------------------start last four------------------------>

                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'silver') ?  'checked="true"' : ''; ?> type="radio" value="silver" class="styled" />
                    <label><?php _e('Silver', SFSI_PLUS_DOMAIN); ?></label>
                    <div class="sfsiplus_icns_tab_3"><span class="sfsiplus_row_13_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_13_2 sfsiplus_email_section"></span><span class="sfsiplus_row_13_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_13_5 sfsiplus_twitter_section"></span><span class="sfsiplus_row_13_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_13_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_13_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_13_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_13_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_13_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_13_23 sfsiplus_vk_section"></span><span class="sfsiplus_row_13_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_13_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_13_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_13_11 sf_section"></span>-->
                    </div>
                </li>

                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'shaded_dark') ?  'checked="true"' : ''; ?> type="radio" value="shaded_dark" class="styled" />
                    <label><?php _e('Shaded Dark', SFSI_PLUS_DOMAIN); ?></label>
                    <div class="sfsiplus_icns_tab_3"><span class="sfsiplus_row_14_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_14_2 sfsiplus_email_section"></span><span class="sfsiplus_row_14_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_14_5 sfsiplus_twitter_section"></span><span class="sfsiplus_row_14_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_14_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_14_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_14_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_14_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_14_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_14_23 sfsiplus_vk_section"></span> <span class="sfsiplus_row_14_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_14_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_14_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_14_11 sf_section"></span>-->
                    </div>
                </li>

                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'shaded_light') ?  'checked="true"' : ''; ?> type="radio" value="shaded_light" class="styled" />
                    <label><?php _e('Shaded Light', SFSI_PLUS_DOMAIN); ?></label>
                    <div class="sfsiplus_icns_tab_3"><span class="sfsiplus_row_15_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_15_2 sfsiplus_email_section"></span><span class="sfsiplus_row_15_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_15_5 sfsiplus_twitter_section"></span><span class="sfsiplus_row_15_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_15_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_15_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_15_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_15_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_15_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_15_23 sfsiplus_vk_section"></span> <span class="sfsiplus_row_15_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_15_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_15_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_15_11 sf_section"></span>-->
                    </div>
                </li>

                <li>
                    <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'transparent') ?  'checked="true"' : ''; ?> type="radio" value="transparent" class="styled" />
                    <label style="line-height:20px !important;margin-top:15px;  ">
                        <?php _e('Transparent', SFSI_PLUS_DOMAIN); ?> <br />
                        <span style="font-size: 9px;">(<?php _e('for dark backgrounds', SFSI_PLUS_DOMAIN) ?>)</span>
                    </label>
                    <div class="sfsiplus_icns_tab_3 trans_bg" style="padding-left: 6px;"><span class="sfsiplus_row_16_1 sfsiplus_rss_section"></span><span class="sfsiplus_row_16_2 sfsiplus_email_section"></span><span class="sfsiplus_row_16_3 sfsiplus_facebook_section"></span><span class="sfsiplus_row_16_5  sfsiplus_twitter_section"></span><span class="sfsiplus_row_16_7 sfsiplus_youtube_section"></span><span class="sfsiplus_row_16_8 sfsiplus_pinterest_section"></span><span class="sfsiplus_row_16_9 sfsiplus_linkedin_section"></span><span class="sfsiplus_row_16_10 sfsiplus_instagram_section"></span><span class="sfsiplus_row_16_11 sfsiplus_houzz_section"></span><span class="sfsiplus_row_16_22 sfsiplus_telegram_section"></span><span class="sfsiplus_row_16_23 sfsiplus_vk_section"></span> <span class="sfsiplus_row_16_24 sfsiplus_ok_section"></span><span class="sfsiplus_row_16_26 sfsiplus_wechat_section"></span><span class="sfsiplus_row_16_25 sfsiplus_weibo_section"></span>
                        <!--<span class="sfsiplus_row_16_11 sf_section"></span>-->
                    </div>
                </li>

                <?php if (get_option('sfsi_plus_custom_icons') == 'yes') { ?>
                    <!--Custom Icon Support {Monad}-->
                    <li class="cstomskins_upload">
                        <input name="sfsi_plus_actvite_theme" <?php echo ($option3['sfsi_plus_actvite_theme'] == 'custom_support') ?  'checked="true"' : ''; ?> type="radio" value="custom_support" class="styled" />
                        <label style="line-height:20px !important;margin-top:15px;  ">
                            <?php _e('Custom Icons', SFSI_PLUS_DOMAIN); ?>
                            <br />
                        </label>
                        <div class="sfsiplus_icns_tab_3" style="padding-left: 6px;">
                            <?php
                                if (get_option("plus_rss_skin")) {
                                    $icon = get_option("plus_rss_skin");
                                    echo '<span class="sfsiplus_row_17_1 sfsiplus_rss_section sfsi_plus-bgimage" style="background: url(' . $icon . ') no-repeat;">		
                                </span>';
                                } else {
                                    echo '<span class="sfsiplus_row_17_1 sfsiplus_rss_section" style="background-position:-1px 0;"></span>';
                                }

                                if (get_option("plus_email_skin")) {
                                    $icon = get_option("plus_email_skin");
                                    echo '<span class="sfsiplus_row_17_2 sfsiplus_email_section sfsi_plus-bgimage" style="background: url(' . $icon . ') no-repeat;"></span>';
                                } else {
                                    echo '<span class="sfsiplus_row_17_2 sfsiplus_email_section" style="background-position:-58px 0;"></span>';
                                }

                                if (get_option("plus_facebook_skin")) {
                                    $icon = get_option("plus_facebook_skin");
                                    echo '<span class="sfsiplus_row_17_3 sfsiplus_facebook_section sfsi_plus-bgimage" style="background: url(' . $icon . ') no-repeat;"></span>';
                                } else {
                                    echo '<span class="sfsiplus_row_17_3 sfsiplus_facebook_section" style="background-position:-118px 0;"></span>';
                                }

                                if (get_option("plus_twitter_skin")) {
                                    $icon = get_option("plus_twitter_skin");
                                    echo '<span class="sfsiplus_row_17_5 sfsiplus_twitter_section sfsi_plus-bgimage" style="background: url(' . $icon . ') no-repeat;"></span>';
                                } else {
                                    echo '<span class="sfsiplus_row_17_5 sfsiplus_twitter_section" style="background-position:-235px 0;"></span>';
                                }

                                if (get_option("plus_youtube_skin")) {
                                    $icon = get_option("plus_youtube_skin");
                                    echo '<span class="sfsiplus_row_17_7 sfsiplus_youtube_section sfsi_plus-bgimage" style="background: url(' . $icon . ') no-repeat;"></span>';
                                } else {
                                    echo '<span class="sfsiplus_row_17_7 sfsiplus_youtube_section" style="background-position:-350px 0;"></span>';
                                }

                                if (get_option("plus_pintrest_skin")) {
                                    $icon = get_option("plus_pintrest_skin");
                                    echo '<span class="sfsiplus_row_17_8 sfsiplus_pinterest_section sfsi_plus-bgimage" style="background: url(' . $icon . ') no-repeat;"></span>';
                                } else {
                                    echo '<span class="sfsiplus_row_17_8 sfsiplus_pinterest_section" style="background-position:-409px 0;"></span>';
                                }

                                if (get_option("plus_linkedin_skin")) {
                                    $icon = get_option("plus_linkedin_skin");
                                    echo '<span class="sfsiplus_row_17_9 sfsiplus_linkedin_section sfsi_plus-bgimage" style="background: url(' . $icon . ') no-repeat;"></span>';
                                } else {
                                    echo '<span class="sfsiplus_row_17_9 sfsiplus_linkedin_section" style="background-position:-467px 0;"></span>';
                                }

                                if (get_option("plus_instagram_skin")) {
                                    $icon = get_option("plus_instagram_skin");
                                    echo '<span class="sfsiplus_row_17_10 sfsiplus_instagram_section sfsi_plus-bgimage" style="background: url(' . $icon . ') no-repeat;"></span>';
                                } else {
                                    echo '<span class="sfsiplus_row_17_10 sfsiplus_instagram_section" style="background-position:-526px 0;"></span>';
                                }
                                if (get_option("plus_houzz_skin")) {
                                    $icon = get_option("plus_houzz_skin");
                                    echo '<span class="sfsiplus_row_17_11 sfsiplus_houzz_section sfsi_plus-bgimage" style="background: url(' . $icon . ') no-repeat;"></span>';
                                } else {
                                    echo '<span class="sfsiplus_row_17_11 sfsiplus_houzz_section" style="background-position:-711px 0;"></span>';
                                }

                                if (get_option("plus_telegram_skin")) {
                                    $icon = get_option("plus_telegram_skin");
                                    echo '<span class="sfsiplus_row_17_22 sfsiplus_telegram_section sfsi_plus-bgimage" style="background: url(' . $icon . ') no-repeat;"></span>';
                                } else {
                                    echo '<span class="sfsiplus_row_17_22 sfsiplus_telegram_section" style="background-position:-769px 0;"></span>';
                                }
                                if (get_option("plus_vk_skin")) {
                                    $icon = get_option("plus_vk_skin");
                                    echo '<span class="sfsiplus_row_17_23 sfsiplus_vk_section sfsi_plus-bgimage" style="background: url(' . $icon . ') no-repeat;margin-top:6px;"></span>';
                                } else {
                                    echo '<span class="sfsiplus_row_17_23 sfsiplus_vk_section" style="background-position:-839px 0;"></span>';
                                }

                                if (get_option("plus_ok_skin")) {
                                    $icon = get_option("plus_ok_skin");
                                    echo '<span class="sfsiplus_row_17_24 sfsiplus_ok_section sfsi_plus-bgimage" style="background: url(' . $icon . ') no-repeat;margin-top:6px;"></span>';
                                } else {
                                    echo '<span class="sfsiplus_row_17_24 sfsiplus_ok_section" style="background-position:-909px 0;"></span>';
                                }

                                if (get_option("plus_wechat_skin")) {
                                    $icon = get_option("plus_wechat_skin");
                                    echo '<span class="sfsiplus_row_17_25 sfsiplus_wechat_section sfsi_plus-bgimage" style="background: url(' . $icon . ') no-repeat;margin-top:6px;"></span>';
                                } else {
                                    echo '<span class="sfsiplus_row_17_26 sfsiplus_wechat_section" style="background-position:-1045px 0;"></span>';
                                }
                                if (get_option("plus_weibo_skin")) {
                                    $icon = get_option("plus_weibo_skin");
                                    echo '<span class="sfsiplus_row_17_25 sfsiplus_weibo_section sfsi_plus-bgimage" style="background: url(' . $icon . ') no-repeat;margin-top:6px;"></span>';
                                } else {
                                    echo '<span class="sfsiplus_row_17_25 sfsiplus_weibo_section" style="background-position:-979px 0;"></span>';
                                }


                                ?>

                        </div>
                    </li>
                <?php
                }
                ?>
                <?php if (get_option('sfsi_plus_custom_icons') == 'no') { ?>

                    <li style="display: flex;align-items: center;">
                        <a class="pop-up" data-id="sfsi_plus_quickpay-overlay" onclick="sfsi_plus_open_quick_checkout(event)" target="_blank" style="display: flex;">

                            <input name="sfsi_plus_actvite_theme" type="radio" value="custom_support" class="styled" />
                            <label style="line-height:20px !important;margin-top:15px;opacity:0.5;font-weight:normal;">
                                <?php _e('Custom Icons -', SFSI_PLUS_DOMAIN); ?>
                                <br />
                            </label>
                        </a>

                        <div class="sfsiplus_icns_tab_3" style="padding-left: 6px;">
                            <p>
                                <a style="color: #12a252 !important;font-weight: bold; border-bottom:none;text-decoration: none;">
                                    <?php _e('Premium Feature:', SFSI_PLUS_DOMAIN); ?>
                                </a>
                                <?php _e('Upload any icons you want', SFSI_PLUS_DOMAIN); ?>
                                <a class="pop-up" style="cursor:pointer; color: #12a252 !important;border-bottom: 1px solid #12a252;text-decoration: none;" data-id="sfsi_plus_quickpay-overlay" onclick="sfsi_plus_open_quick_checkout(event)" target="_blank">
                                    <?php _e('Get it now.', SFSI_PLUS_DOMAIN); ?>
                                </a>
                            </p>
                        </div>
                    </li>

                    <li style="display: flex;align-items: center;">
                        <a class="pop-up" data-id="sfsi_plus_quickpay-overlay" onclick="sfsi_plus_open_quick_checkout(event)" target="_blank" style="display: flex;">

                            <input type="radio" class="styled" />
                            <label style="line-height:20px !important;margin-top:15px;opacity: 0.5;min-width: 79px;font-weight: normal;">
                                <?php _e('Tailored -', SFSI_PLUS_DOMAIN); ?>
                                <br />
                            </label>
                        </a>

                        <div class="sfsiplus_icns_tab_3" style="padding-left: 6px;">
                            <p>
                                <span>
                                    <?php _e('Let us create icons matching your site perfectly (both in terms of colors and shape).', SFSI_PLUS_DOMAIN); ?>
                                </span>
                                <a href="https://sellcodes.com/0AL0J23f" style="cursor:pointer; color: #12a252 !important;border-bottom: 1px solid #12a252;text-decoration: none;font-weight: bold;" target="_blank">
                                    Learn more.
                                </a>
                            </p>
                        </div>
                    </li>

                <?php
                }
                ?>
                <?php

                if ($option3['sfsi_plus_premium_icons_design_box'] == 'yes') { ?>
                    <li>
                        <?php include_once(SFSI_PLUS_DOCROOT . '/views/subviews/que4/banner.php'); ?>

                    </li>
                <?php } ?>

                <li>
                    <p style="font-weight: bold; margin: 12px 0 0;">
                        <?php _e("Need icons for another theme? Let us know in the", SFSI_PLUS_DOMAIN); ?>
                        <a target="_blank" href="https://wordpress.org/support/plugin/ultimate-social-media-plus/#new-topic-0" style="color:#8E81BD; text-decoration:underline;">
                            <?php _e(" Support Forum", SFSI_PLUS_DOMAIN); ?>
                        </a>
                        <?php //_e("to offer your icons here and get a free link (& traffic) back to your site!", SFSI_PLUS_DOMAIN); 
                        ?>
                    </p>
                </li>
            </ul>
            <!--icon themes section start -->

            <?php include_once(SFSI_PLUS_DOCROOT . '/views/subviews/que4/animatethem.php'); ?>

        </div>
    </div>
    <!--Content of 4-->


    <?php sfsi_plus_ask_for_help(3); ?>


    <!-- SAVE BUTTON SECTION   -->
    <div class="save_button tab_3_sav">
        <img src="<?php echo SFSI_PLUS_PLUGURL ?>images/ajax-loader.gif" class="loader-img" />
        <?php $nonce = wp_create_nonce("update_plus_step3"); ?>
        <a href="javascript:;" id="sfsi_plus_save3" title="Save" data-nonce="<?php echo $nonce; ?>">
            <?php _e('Save', SFSI_PLUS_DOMAIN); ?>
        </a>
    </div> <!-- END SAVE BUTTON SECTION   -->

    <a class="sfsiColbtn closeSec" href="javascript:;">
        <?php _e('Collapse area', SFSI_PLUS_DOMAIN); ?>
    </a>
    <label class="closeSec"></label>
    <!-- ERROR AND SUCCESS MESSAGE AREA-->
    <p class="red_txt errorMsg" style="display:none"> </p>
    <p class="green_txt sucMsg" style="display:none"> </p>
</div><!-- END Section 3 "What design & animation do you want to give your icons?" main div  -->