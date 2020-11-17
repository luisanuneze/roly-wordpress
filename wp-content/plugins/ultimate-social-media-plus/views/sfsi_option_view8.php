<?php
/* unserialize all saved option for Eight options */
$option8 =  unserialize(get_option('sfsi_plus_section8_options', false));
if (!isset($option8['sfsi_plus_rectsub'])) {
	$option8['sfsi_plus_rectsub'] = 'no';
}
if (!isset($option8['sfsi_plus_rectfb'])) {
	$option8['sfsi_plus_rectfb'] = 'yes';
}
if (!isset($option8['sfsi_plus_recttwtr'])) {
	$option8['sfsi_plus_recttwtr'] = 'no';
}
if (!isset($option8['sfsi_plus_rectpinit'])) {
	$option8['sfsi_plus_rectpinit'] = 'no';
}
if (!isset($option8['sfsi_plus_rectfbshare'])) {
	$option8['sfsi_plus_rectfbshare'] = 'no';
}
if (!isset($option4)) {
	$option4 =  unserialize(get_option('sfsi_plus_section4_options', false));
}
$sfsi_plus_responsive_icons_default = array(
	"default_icons" => array(
		"facebook" => array("active" => "yes", "text" => "Share on Facebook", "url" => ""),
		"Twitter" => array("active" => "yes", "text" => "Tweet", "url" => ""),
		"Follow" => array("active" => "yes", "text" => "Follow us", "url" => ""),
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
$sfsi_plus_responsive_icons = (isset($option8["sfsi_plus_responsive_icons"]) ? $option8["sfsi_plus_responsive_icons"] : $sfsi_plus_responsive_icons_default);

$analyst_cache = unserialize(get_option("analyst_cache"));
$sfsi_plus_willshow_analyst_popup = false;
if (!is_null($analyst_cache) && isset($analyst_cache["plugin_to_install"])) {
	$sfsi_plus_willshow_analyst_popup = true;
}
/**
 * Sanitize, escape and validate values
 */

$option8['sfsi_plus_show_via_widget'] 			= (isset($option8['sfsi_plus_show_via_widget']))
	? sanitize_text_field($option8['sfsi_plus_show_via_widget'])
	: '';
$option8['sfsi_plus_float_on_page'] 			= (isset($option8['sfsi_plus_float_on_page']))
	? sanitize_text_field($option8['sfsi_plus_float_on_page'])
	: '';
$option8['sfsi_plus_float_page_position'] 		= (isset($option8['sfsi_plus_float_page_position']))
	? sanitize_text_field($option8['sfsi_plus_float_page_position'])
	: '';
$option8['sfsi_plus_icons_floatMargin_top'] 	= (isset($option8['sfsi_plus_icons_floatMargin_top']))
	? intval($option8['sfsi_plus_icons_floatMargin_top'])
	: '';
$option8['sfsi_plus_icons_floatMargin_bottom'] 	= (isset($option8['sfsi_plus_icons_floatMargin_bottom']))
	? intval($option8['sfsi_plus_icons_floatMargin_bottom'])
	: '';
$option8['sfsi_plus_icons_floatMargin_left'] 	= (isset($option8['sfsi_plus_icons_floatMargin_left']))
	? intval($option8['sfsi_plus_icons_floatMargin_left'])
	: '';
$option8['sfsi_plus_icons_floatMargin_right'] 	= (isset($option8['sfsi_plus_icons_floatMargin_right']))
	? intval($option8['sfsi_plus_icons_floatMargin_right'])
	: '';
$option8['sfsi_plus_place_item_manually'] 		= (isset($option8['sfsi_plus_place_item_manually']))
	? sanitize_text_field($option8['sfsi_plus_place_item_manually'])
	: '';
$option8['sfsi_plus_place_item_gutenberg'] 		= (isset($option8['sfsi_plus_place_item_gutenberg']))
	? sanitize_text_field($option8['sfsi_plus_place_item_gutenberg'])
	: 'no';
$option8['sfsi_plus_display_button_type'] 		= (isset($option8['sfsi_plus_display_button_type']))
	? sanitize_text_field($option8['sfsi_plus_display_button_type'])
	: '';
$option8['sfsi_plus_post_icons_size'] 			= (isset($option8['sfsi_plus_post_icons_size']))
	? intval($option8['sfsi_plus_post_icons_size'])
	: '';
$option8['sfsi_plus_post_icons_spacing'] 		= (isset($option8['sfsi_plus_post_icons_spacing']))
	? intval($option8['sfsi_plus_post_icons_spacing'])
	: '';

$option8['sfsi_plus_show_item_onposts'] 		= (isset($option8['sfsi_plus_show_item_onposts']))
	? sanitize_text_field($option8['sfsi_plus_show_item_onposts'])
	: '';
$option8['sfsi_plus_icons_alignment'] 			= (isset($option8['sfsi_plus_icons_alignment']))
	? sanitize_text_field($option8['sfsi_plus_icons_alignment'])
	: '';
$option8['sfsi_plus_textBefor_icons'] 			= (isset($option8['sfsi_plus_textBefor_icons']))
	? sanitize_text_field($option8['sfsi_plus_textBefor_icons'])
	: '';
$option8['sfsi_plus_icons_DisplayCounts']		= (isset($option8['sfsi_plus_icons_DisplayCounts']))
	? sanitize_text_field($option8['sfsi_plus_icons_DisplayCounts'])
	: '';
$option8['sfsi_plus_rectsub'] 					= (isset($option8['sfsi_plus_rectsub']))
	? sanitize_text_field($option8['sfsi_plus_rectsub'])
	: '';
$option8['sfsi_plus_rectfb'] 					= (isset($option8['sfsi_plus_rectfb']))
	? sanitize_text_field($option8['sfsi_plus_rectfb'])
	: '';
$option8['sfsi_plus_recttwtr'] 					= (isset($option8['sfsi_plus_recttwtr']))
	? sanitize_text_field($option8['sfsi_plus_recttwtr'])
	: '';
$option8['sfsi_plus_rectpinit'] 				= (isset($option8['sfsi_plus_rectpinit']))
	? sanitize_text_field($option8['sfsi_plus_rectpinit'])
	: '';
$option8['sfsi_plus_rectfbshare'] 				= (isset($option8['sfsi_plus_rectfbshare']))
	? sanitize_text_field($option8['sfsi_plus_rectfbshare'])
	: '';
$option8['sfsi_plus_show_premium_placement_box'] = (isset($option8['sfsi_plus_show_premium_placement_box']))
	? sanitize_text_field($option8['sfsi_plus_show_premium_placement_box'])
	: 'yes';
$option8['sfsi_plus_responsive_icons_end_post']  = (isset($option8['sfsi_plus_responsive_icons_end_post']))
	? sanitize_text_field($option8['sfsi_plus_responsive_icons_end_post'])
	: '';
?>
<div class="tab8">
	<ul class="sfsiplus_icn_listing8" style="margin-top:0">
		<span id="sfsi_plus_analyst_pop" style="display:none" data-status="<?php echo $sfsi_plus_willshow_analyst_popup ? "yes" : "no"; ?>"></span>
		<!--Second Section-->
		<p class="sfsi_premium_feature_note" style="font-size:18px;margin-bottom:15px;padding-top:0!important;">Please select one or multiple placement options:</p>
		<li class="">
			<div class="radio_section tb_4_ck cstmfltonpgstck" onclick="sfsiplus_toggleflotpage(this);">
				<input name="sfsi_plus_float_on_page" <?php echo ($option8['sfsi_plus_float_on_page'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_plus_float_on_page" type="checkbox" value="yes" class="styled" />
			</div>

			<div class="sfsiplus_right_info">

				<p>
					<span class="sfsiplus_toglepstpgspn">
						<?php _e("Floating over your website's pages", SFSI_PLUS_DOMAIN); ?>
					</span>
				</p>
				<?php
				if ($option8['sfsi_plus_float_on_page'] == "yes") {
					$style = 'display: block;';
				} else {
					$style = "display: none;";
				}
				?>
				<div class="sfsiplus_tab_3_icns" <?php echo 'style="' . $style . '"'; ?>>
					<p style="font-size:19px;"><span class="margin-left:31px">Define the location:</span></p>
					<!-- 					<ul class="sfsiplus_tab_3_icns flthmonpg" style="margin-top:10px" >
						<li>
							<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'top-left') ?  'checked="true"' : ''; ?> type="radio" value="top-left" class="styled" />
							<span class="sfsi_flicnsoptn3 sfsioptntl">
								<?php _e('Top left', SFSI_PLUS_DOMAIN); ?>
							</span>
							<label><img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/top_left.png" /></label>
						</li>
						<li>
							<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'center-top') ?  'checked="true"' : ''; ?> type="radio" value="center-top" class="styled" />
							<span class="sfsi_flicnsoptn3 sfsioptncl">
								<?php _e('Center top', SFSI_PLUS_DOMAIN); ?>
							</span>
							<label><img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/center_top.png" /></label>
						</li>
						<li>
							<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'top-right') ?  'checked="true"' : ''; ?> type="radio" value="top-right" class="styled" />
							<span class="sfsi_flicnsoptn3 sfsioptntr">
								<?php _e('Top right', SFSI_PLUS_DOMAIN); ?>
							</span>
							<label><img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/top_right.png" /></label>
						</li>
						<li>
							<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'center-left') ?  'checked="true"' : ''; ?> type="radio" value="center-left" class="styled" />
							<span class="sfsi_flicnsoptn3 sfsioptncl">
								<?php _e('Center left', SFSI_PLUS_DOMAIN); ?>
							</span>
							<label><img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/center_left.png" /></label>
						</li>
						<li>
							<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'center-right') ?  'checked="true"' : ''; ?> type="radio" value="center-right" class="styled" />
							<span class="sfsi_flicnsoptn3 sfsioptncr">
								<?php _e('Center right', SFSI_PLUS_DOMAIN); ?>
							</span>
							<label><img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/center_right.png" /></label>
						</li>
						<li>
							<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'bottom-left') ?  'checked="true"' : ''; ?> type="radio" value="bottom-left" class="styled" />
							<span class="sfsi_flicnsoptn3 sfsioptnbl">
								<?php _e('Bottom left', SFSI_PLUS_DOMAIN); ?>
							</span>
							<label><img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/bottom_left.png" /></label>
						</li>
						<li>
							<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'center-bottom') ?  'checked="true"' : ''; ?> type="radio" value="center-bottom" class="styled" />
							<span class="sfsi_flicnsoptn3 sfsioptncl">
								<?php _e('Center top', SFSI_PLUS_DOMAIN); ?>
							</span>
							<label><img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/center_bottom.png" /></label>
						</li>
						<li>
							<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'bottom-right') ?  'checked="true"' : ''; ?> type="radio" value="bottom-right" class="styled" />
							<span class="sfsi_flicnsoptn3 sfsioptnbr">
								<?php _e('Bottom right', SFSI_PLUS_DOMAIN); ?>
							</span>
							<label><img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/bottom_right.png" /></label>
						</li>
					</ul> -->
					<ul class="sfsi_tab_3_icns flthmonpg">
						<div class="sfsi_position_divider">
							<li>
								<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'top-left') ?  'checked="true"' : ''; ?> type="radio" value="top-left" class="styled" />
								<span class="sfsi_flicnsoptn3 sfsioptntl">Top left</span>
								<label><img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/top_left.png" alt='error' /></label>
							</li>
							<li>
								<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'center-top') ?  'checked="true"' : ''; ?> type="radio" value="center-top" class="styled" />
								<span class="sfsi_flicnsoptn3 sfsioptncl">Center top</span>
								<label class="sfsi_float_position_icon_label"><img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/float_position_icon.png" alt='error' /></label>
							</li>
							<li>
								<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'top-right') ?  'checked="true"' : ''; ?> type="radio" value="top-right" class="styled" />
								<span class="sfsi_flicnsoptn3 sfsioptntr">Top right</span>
								<label><img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/top_right.png" alt='error' /></label>
							</li>
						</div>
						<div class="sfsi_position_divider">
							<li>
								<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'center-left') ?  'checked="true"' : ''; ?> type="radio" value="center-left" class="styled" />
								<span class="sfsi_flicnsoptn3 sfsioptncl">Center left</span>
								<label><img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/center_left.png" alt='error' /></label>
							</li>
							<li></li>
							<li>
								<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'center-right') ?  'checked="true"' : ''; ?> type="radio" value="center-right" class="styled" />
								<span class="sfsi_flicnsoptn3 sfsioptncr">Center right</span>
								<label><img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/center_right.png" alt='error' /></label>
							</li>
						</div>
						<div class="sfsi_position_divider">
							<li>
								<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'bottom-left') ?  'checked="true"' : ''; ?> type="radio" value="bottom-left" class="styled" />
								<span class="sfsi_flicnsoptn3 sfsioptnbl">Bottom left</span>
								<label><img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/bottom_left.png" alt='error' alt='error' /></label>
							</li>
							<li>
								<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'center-bottom') ?  'checked="true"' : ''; ?> type="radio" value="center-bottom" class="styled" />
								<span class="sfsi_flicnsoptn3 sfsioptncr">Center bottom</span>
								<label class="sfsi_float_position_icon_label sfsi_center_botttom"><img class="sfsi_img_center_bottom" src="<?php echo SFSI_PLUS_PLUGURL; ?>images/float_position_icon.png" alt='error' /></label>
							</li>
							<li>
								<input name="sfsi_plus_float_page_position" <?php echo ($option8['sfsi_plus_float_page_position'] == 'bottom-right') ?  'checked="true"' : ''; ?> type="radio" value="bottom-right" class="styled" />
								<span class="sfsi_flicnsoptn3 sfsioptnbr">Bottom right</span>
								<label><img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/bottom_right.png" alt='error' /></label>
							</li>
						</div>
					</ul>

					<div style="width: 88%; float: left; margin:25px 0 0 47px">
						<h4 style="color: #5a6570 !important;font-family: 'helveticaneue-light';font-size:19px;">
							<?php _e('Margin From:', SFSI_PLUS_DOMAIN); ?>
						</h4>
						<ul class="sfsi_plus_floaticon_margin_sec">
							<li>
								<label>
									<?php _e('Top:', SFSI_PLUS_DOMAIN); ?>
								</label>
								<input name="sfsi_plus_icons_floatMargin_top" type="text" value="<?php echo ($option8['sfsi_plus_icons_floatMargin_top'] != '') ?  $option8['sfsi_plus_icons_floatMargin_top'] : ''; ?>" />
								<ins>
									<?php _e('Pixels', SFSI_PLUS_DOMAIN); ?>
								</ins>
							</li>
							<li>
								<label>
									<?php _e('Bottom:', SFSI_PLUS_DOMAIN); ?>
								</label>
								<input name="sfsi_plus_icons_floatMargin_bottom" type="text" value="<?php echo ($option8['sfsi_plus_icons_floatMargin_bottom'] != '') ?  $option8['sfsi_plus_icons_floatMargin_bottom'] : ''; ?>" />
								<ins>
									<?php _e('Pixels', SFSI_PLUS_DOMAIN); ?>
								</ins>
							</li>
							<li>
								<label>
									<?php _e('Left:', SFSI_PLUS_DOMAIN); ?>
								</label>
								<input name="sfsi_plus_icons_floatMargin_left" type="text" value="<?php echo ($option8['sfsi_plus_icons_floatMargin_left'] != '') ?  $option8['sfsi_plus_icons_floatMargin_left'] : ''; ?>" />
								<ins>
									<?php _e('Pixels', SFSI_PLUS_DOMAIN); ?>
								</ins>
							</li>
							<li>
								<label>
									<?php _e('Right:', SFSI_PLUS_DOMAIN); ?>
								</label>
								<input name="sfsi_plus_icons_floatMargin_right" type="text" value="<?php echo ($option8['sfsi_plus_icons_floatMargin_right'] != '') ?  $option8['sfsi_plus_icons_floatMargin_right'] : ''; ?>" />
								<ins>
									<?php _e('Pixels', SFSI_PLUS_DOMAIN); ?>
								</ins>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</li>
		<!--First Section-->
		<li class="">
			<div class="radio_section tb_4_ck" onclick="checkforinfoslction(this);"><input name="sfsi_plus_show_via_widget" <?php echo ($option8['sfsi_plus_show_via_widget'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_plus_show_via_widget" type="checkbox" value="yes" class="styled" /></div>
			<div class="sfsiplus_right_info">
				<p>
					<span class="sfsiplus_toglepstpgspn">
						<?php _e('Show them via a widget', SFSI_PLUS_DOMAIN); ?>
					</span><br>
					<?php
					if ($option8['sfsi_plus_show_via_widget'] == 'yes') {
						$label_style = 'style="display:block; font-size: 16px;"';
					} else {
						$label_style = 'style="font-size: 16px;"';
					}
					?>
					<label class="sfsiplus_sub-subtitle ckckslctn" <?php echo $label_style; ?>>
						<?php _e('Go to the widget area and drag & drop it where you want to have it!', SFSI_PLUS_DOMAIN); ?>
						<a href="<?php echo admin_url('widgets.php'); ?>" style="font-size:16px">
							<?php _e('Click here', SFSI_PLUS_DOMAIN); ?>
						</a>
					</label>
				</p>
			</div>
		</li>



		<!--Third Section-->
		<li class="sfsiplusplacethemanulywpr">
			<div class="radio_section tb_4_ck" onclick="checkforinfoslction(this);"><input name="sfsi_plus_place_item_manually" <?php echo ($option8['sfsi_plus_place_item_manually'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_plus_place_item_manually" type="checkbox" value="yes" class="styled" /></div>
			<div class="sfsiplus_right_info">
				<p>
					<span class="sfsiplus_toglepstpgspn">
						<?php _e('Place them manually', SFSI_PLUS_DOMAIN); ?>
					</span><br>
					<?php
					if ($option8['sfsi_plus_place_item_manually'] == 'yes') {
						$label_style = 'style="display:block; font-size: 15px;"';
					} else {
						$label_style = 'style="font-size: 15px;"';
					}
					?>
					<label class="sfsiplus_sub-subtitle ckckslctn" <?php echo $label_style; ?>>
						<?php _e('Place the following string into your theme codes: ', SFSI_PLUS_DOMAIN); ?>

						&lt;?php echo DISPLAY_ULTIMATE_PLUS(); ?&gt;

						<?php _e('Or use the shortcode [DISPLAY_ULTIMATE_PLUS] to display them wherever you want.', SFSI_PLUS_DOMAIN); ?>

						<?php _e('Need help with that? Ask us! <a style="color:#5a6570 !important; font-size:16px;" target="_blank" href="https://wordpress.org/support/plugin/ultimate-social-media-plus#no-topic-0">Click here</a>', SFSI_PLUS_DOMAIN); ?>

					</label>
				</p>
			</div>
		</li>




		<!--In your theme's header -->
		<li class="sfsiplusplacethemanulywpr">
			<div class="radio_section tb_4_ck" onclick="checkforinfoslction2(this);"><input name="sfsi_plus_show_theme_header" id="sfsi_plus_place_item_manually" type="checkbox" value="yes" class="styled" /></div>
			<div class="sfsiplus_right_info">
				<p>
					<span class="sfsiplus_toglepstpgspn">
						<?php _e('In your theme\'s header', SFSI_PLUS_DOMAIN); ?>
					</span><br>
				</p>
				<label class="sfsiplus_sub-subtitle ckckslctn" style="display: none;">
					<p style="padding-top: 3px;font-size:19px">
						<?php _e('Placing icons in your theme\'s header can be tricky / technical as CSS & PHP know-how is required (as every theme is different, no "automatic" placement is possible).', SFSI_PLUS_DOMAIN); ?>
					</p>
					<p style="font-size:19px">
						<?php _e('You can try via shortcode (see above), however if you don\'t want any hassle, check out our ', SFSI_PLUS_DOMAIN); ?>
						<a class="pop-up" data-id="sfsi_plus_quickpay-overlay" onclick="sfsi_plus_open_quick_checkout(event)" style="text-decoration:none">
							<span style="text-decoration: underline;cursor: pointer;color:#5A6570"><?php _e('Premium plugin', SFSI_PLUS_DOMAIN); ?></span>
						</a>
						<?php _e(' where - as part of our service - we can place the icons for you, making theme adjustments
								where needed. This ensures the perfect appearance (on all devices) for your icons.', SFSI_PLUS_DOMAIN); ?>
						<a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmplus_settings_page&utm_campaign=theme_header_placement&utm_medium=link" style="cursor:pointer; color: #1a1d20 !important;border-bottom: 1px solid #12a252;text-decoration: none;font-weight: bold;" target="_blank">
							<b><?php _e('Get it now', SFSI_PLUS_DOMAIN); ?></b>
						</a>
					</p>

				</label>
			</div>
		</li>
		<!--Fifth Section-->
		<li class="sfsiplusplaceusinggutenberg">
			<div class="radio_section tb_4_ck" onclick="checkforinfoslction(this);"><input name="sfsi_plus_place_item_gutenberg" <?php echo ($option8['sfsi_plus_place_item_gutenberg'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_plus_place_item_gutenberg" type="checkbox" value="yes" class="styled" /></div>
			<div class="sfsiplus_right_info">
				<p>
					<span class="sfsiplus_toglepstpgspn">
						<?php _e('Show them in the Gutenberg editor', SFSI_PLUS_DOMAIN); ?>
					</span><br>
					<?php
					if ($option8['sfsi_plus_place_item_gutenberg'] == 'yes') {
						$label_style = 'style="display:block; font-size: 15px;"';
					} else {
						$label_style = 'style="font-size: 15px;"';
					}
					?>
					<label class="sfsiplus_sub-subtitle ckckslctn" <?php echo $label_style; ?>>
						<?php _e('Look for this sign', SFSI_PLUS_DOMAIN); ?> <img style="margin-bottom:-4px" width="20" src="<?php echo SFSI_PLUS_PLUGURL ?>images/sfsi_block_icon.jpg"> <?php _e(' in your Gutenberg editor and click on it. Then a new block with the icons will be added.', SFSI_PLUS_DOMAIN); ?>

					</label>
				</p>
			</div>
		</li>

		<!--Fourth Section-->
		<li class="sfsiplusbeforeafterpostselector">
			<div class="radio_section tb_4_ck" onclick="sfsiplus_toggleflotpage(this);"><input name="sfsi_plus_show_item_onposts" <?php echo ($option8['sfsi_plus_show_item_onposts'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_plus_show_item_onposts" type="checkbox" value="yes" class="styled" /></div>
			<div class="sfsiplus_right_info">
				<p>
					<span class="sfsiplus_toglepstpgspn">
						<?php _e('Show them before or after posts', SFSI_PLUS_DOMAIN); ?>
					</span>
					<br>
					<?php
					if ($option8['sfsi_plus_show_item_onposts'] != "yes") {
						$style_float = "style='font-size: 15px; display: none;'";
					} else {
						$style_float = "style='font-size: 15px;'";
					}
					?>
					<label class="sfsiplus_sub-subtitle sfsiplus_toglpstpgsbttl" <?php echo $style_float; ?>>
						<?php _e('Here you have three options:', SFSI_PLUS_DOMAIN); ?>
					</label>
				</p>

				<ul class="sfsiplus_tab_3_icns sfsiplus_shwthmbfraftr" <?php echo ($option8['sfsi_plus_show_item_onposts'] != "yes") ? 'style="display: none";' : ''; ?>>
					<li onclick="sfsiplus_togglbtmsection('sfsiplus_toggleonlystndrshrng, .sfsiplus_responsive_hide', 'sfsiplus_toggledsplyitemslctn, .sfsiplus_toggleonlyrspvshrng, .sfsiplus_responsive_show', this);" class="clckbltglcls sfsi_plus_border_left_0">
						<input name="sfsi_plus_display_button_type" <?php echo ($option8['sfsi_plus_display_button_type'] == 'standard_buttons') ?  'checked="true"' : ''; ?> type="radio" value="standard_buttons" class="styled" />
						<label class="labelhdng4">
							<?php _e('Original icons', SFSI_PLUS_DOMAIN); ?>
						</label>
					</li>
					<li onclick="sfsiplus_togglbtmsection('sfsiplus_toggledsplyitemslctn, .sfsiplus_responsive_hide', 'sfsiplus_toggleonlystndrshrng, .sfsiplus_toggleonlyrspvshrng, .sfsiplus_responsive_show', this);" class="clckbltglcls sfsi_plus_border_left_0">
						<input name="sfsi_plus_display_button_type" <?php echo ($option8['sfsi_plus_display_button_type'] == 'normal_button') ?  'checked="true"' : ''; ?> type="radio" value="normal_button" class="styled" />
						<label class="labelhdng4">
							<?php _e('Icons I selected the above', SFSI_PLUS_DOMAIN); ?>
						</label>
					<li onclick="sfsiplus_togglbtmsection('sfsiplus_toggleonlyrspvshrng, .sfsiplus_responsive_show', 'sfsiplus_toggleonlystndrshrng, .sfsiplus_toggledsplyitemslctn, .sfsiplus_responsive_hide', this);" class="clckbltglcls sfsi_plus_border_left_0">
						<input name="sfsi_plus_display_button_type" <?php echo ($option8['sfsi_plus_display_button_type'] == 'responsive_button') ?  'checked="true"' : ''; ?> type="radio" value="responsive_button" class="styled" />
						<label class="labelhdng4">
							<?php _e('Responsive icons', SFSI_PLUS_DOMAIN); ?>
						</label>
					</li>
					<li class="sfsiplus_toggleonlystndrshrng sfsi_plus_border_left_0">
						<?php if ($option8['sfsi_plus_display_button_type'] == 'standard_buttons') : $display = "display:block";
						else :  $display = "display:none";
						endif; ?>
						<div class="radiodisplaysection" style="<?php echo $display; ?>">

							<p class="cstmdisplaysharingtxt cstmdisextrpdng">
								<?php _e('Rectangle icons spell out the «call to action» which increases the chances that visitors do it.', SFSI_PLUS_DOMAIN); ?>
							</p>
							<p class="cstmdisplaysharingtxt">
								<?php _e('Select the icons you want to show:', SFSI_PLUS_DOMAIN); ?>
							</p>
							<div class="social_icon_like1 cstmdsplyulwpr">
								<ul>
									<li>
										<div class="radio_section tb_4_ck"><input name="sfsi_plus_rectsub" <?php echo ($option8['sfsi_plus_rectsub'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_plus_rectsub" type="checkbox" value="yes" class="styled" /></div>
										<a href="#" title="Subscribe Follow" class="cstmdsplsub">
											<img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/follow_subscribe.png" alt="Subscribe Follow" /><span style="display: none;">18k</span>
										</a>
									</li>
									<li>
										<div class="radio_section tb_4_ck"><input name="sfsi_plus_rectfb" <?php echo ($option8['sfsi_plus_rectfb'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_plus_rectfb" type="checkbox" value="yes" class="styled" /></div>
										<a href="#" title="Facebook Like" class="cstmdspllke">
											<img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/like.jpg" alt="Facebook Like" /><span style="display: none;">18k</span>
										</a>
									</li>
									<li>
										<div class="radio_section tb_4_ck"><input name="sfsi_plus_rectfbshare" <?php echo ($option8['sfsi_plus_rectfbshare'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_plus_rectfbshare" type="checkbox" value="yes" class="styled" /></div>
										<a href="#" title="Facebook Share" class="cstmdsplfbshare">
											<img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/fbshare.png" alt="Facebook Share" /><span style="display: none;">18k</span>
										</a>
									</li>
									<li>
										<div class="radio_section tb_4_ck"><input name="sfsi_plus_recttwtr" <?php echo ($option8['sfsi_plus_recttwtr'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_plus_recttwtr" type="checkbox" value="yes" class="styled" /></div>
										<a href="#" title="twitter" class="cstmdspltwtr">
											<img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/twiiter.png" alt="Twitter like" /><span style="display: none;">18k</span>
										</a>
									</li>
									<li>
										<div class="radio_section tb_4_ck"><input name="sfsi_plus_rectpinit" <?php echo ($option8['sfsi_plus_rectpinit'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_plus_rectpinit" type="checkbox" value="yes" class="styled" /></div>
										<a href="#" title="Pinit" class="cstmdsplpinit">
											<img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/pinit.png" alt="Pinit" /><span style="display: none;">18k</span>
										</a>
									</li>


								</ul>
							</div>
							<?php if ($option8['sfsi_plus_show_premium_placement_box'] == 'yes') { ?>
								<p class="sfsi_plus_prem_plu_desc">
									<b><?php _e('New: ', SFSI_PLUS_DOMAIN); ?></b><?php _e('We also added a Linkedin share-icon in the Premium Plugin.', SFSI_PLUS_DOMAIN); ?> <a class="pop-up" data-id="sfsi_plus_quickpay-overlay" onclick="sfsi_plus_open_quick_checkout(event)" class="sfisi_plus_font_bold" style="border-bottom: 1px solid #12a252;color: #12a252 !important;cursor:pointer;" target="_blank"><?php _e('Go premium now', SFSI_PLUS_DOMAIN); ?></a><a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmplus_settings_page&utm_campaign=linkedin_icon&utm_medium=banner" class="sfsi_plus_font_inherit" style="color: #12a252 !important" target="_blank"><?php _e(' or learn more', SFSI_PLUS_DOMAIN); ?></a>
								</p>
							<?php } ?>
							
						</div>
					</li>
					<?php
					if ($option8['sfsi_plus_display_button_type'] == 'normal_button' || $option8["sfsi_plus_display_button_type"] == "standard_buttons") : $display = "display:block";
						$sfsi_plus_display_normal_type = "display:block";
						$sfsi_plus_display_responsive_type = "display:none";
					else :  $display = "display:none";
						$sfsi_plus_display_normal_type = "display:none";
						$sfsi_plus_display_responsive_type = "display:block";
					endif;
					?>
					<li class="sfsiplus_toggledsplyitemslctn sfsi_plus_border_left_0" style="max-width:1000px!important;<?php echo $display; ?>">

						<div class="row radiodisplaysection">
							<h4>
								<?php _e('Size and spacing of your icons:', SFSI_PLUS_DOMAIN); ?>
							</h4>
							<div class="icons_size">
								<span>
									<?php _e('Size:', SFSI_PLUS_DOMAIN); ?>
								</span><input name="sfsi_plus_post_icons_size" value="<?php echo ($option8['sfsi_plus_post_icons_size'] != '') ?  $option8['sfsi_plus_post_icons_size'] : ''; ?>" type="text" /><ins>
									<?php _e('pixels wide and tall', SFSI_PLUS_DOMAIN); ?>
								</ins> <span class="last">
									<?php _e('Spacing between icons:', SFSI_PLUS_DOMAIN); ?>
								</span><input name="sfsi_plus_post_icons_spacing" type="text" value="<?php echo ($option8['sfsi_plus_post_icons_spacing'] != '') ?  $option8['sfsi_plus_post_icons_spacing'] : ''; ?>" /><ins>
									<?php _e('Pixels', SFSI_PLUS_DOMAIN); ?>
								</ins></div>
						</div>
					</li>
					<li class="sfsiplus_toggleonlyrspvshrng" style="<?php echo ($sfsi_plus_display_responsive_type) ?>">

						<label style="width: 80%;width:calc( 100% - 102px );font-family: helveticaregular;font-size: 18px;color: #5c6267;"><?php _e('These are responsive & independent from the icons you selected elsewhere in the plugin. Preview:', SFSI_PLUS_DOMAIN); ?></label>
						<div style="width: 80%; margin-left:5px;  width:calc( 100% - 102px );">
							<div class="sfsi_plus_responsive_icon_preview" style="width:calc( 100% - 50px )">

								<?php echo sfsi_plus_social_responsive_buttons(null, $option8, true); ?>
							</div> <!-- end sfsi_plus_responsive_icon_preview -->
						</div>
						<ul>
							<li class="sfsi_plus_responsive_default_icon_container sfsi_plus_border_left_0 ">
								<label class="heading-label select-icons">
									<?php _e('Select Icons', SFSI_PLUS_DOMAIN); ?>
								</label>
							</li>
							<?php foreach ($sfsi_plus_responsive_icons['default_icons'] as $icon => $icon_config) :
								?>
								<li class="sfsi_plus_responsive_default_icon_container sfsi_vertical_center sfsi_plus_border_left_0">
									<div class="radio_section tb_4_ck">
										<input name="sfsi_plus_responsive_<?php echo $icon; ?>_display" <?php echo ($icon_config['active'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_plus_responsive_<?php echo $icon; ?>_display" type="checkbox" value="yes" class="styled" data-icon="<?php echo $icon; ?>" />
									</div>
									<span class="sfsi_plus_icon_container">
										<div class="sfsi_plus_responsive_icon_item_container sfsi_plus_responsive_icon_<?php echo strtolower($icon); ?>_container" style="word-break:break-all;padding-left:0">
											<div style="display: inline-block;height: 40px;width: 40px;text-align: center;vertical-align: middle!important;float: left;">
												<img style="float:none" src="<?php echo SFSI_PLUS_PLUGURL; ?>images/responsive-icon/<?php echo $icon; ?><?php echo 'Follow' === $icon ? '.png' : '.svg'; ?>"></div>
											<span> <?php echo $icon_config["text"];  ?> </span>
										</div>
									</span>
									<input type="text" class="sfsi_plus_responsive_input" name="sfsi_plus_responsive_<?php echo $icon ?>_input" value="<?php echo $icon_config["text"]; ?>" />
									<a href="#" class="sfsi_plus_responsive_default_url_toggler" style="text-decoration: none;"><?php _e('Define URL*', SFSI_PLUS_DOMAIN); ?></a>
									<input style="display:none" class="sfsi_plus_responsive_url_input" type="text" placeholder="Enter url" name="sfsi_plus_responsive_<?php echo $icon ?>_url_input" value="<?php echo $icon_config["url"]; ?>" />
									<a href="#" class="sfsi_plus_responsive_default_url_hide" style="display:none"><span class="sfsi_plus_cancel_text"><?php _e('Cancel', SFSI_PLUS_DOMAIN); ?></span><span class="sfsi_plus_cancel_icon">&times;</span></a>
								</li>

							<?php endforeach; ?>
						</ul>
						<?php if ($option8['sfsi_plus_show_premium_placement_box'] == 'yes') { ?>
							<div class="sfsi_plus_new_prmium_follw">
								<p class="sfsi_plus_border_left_0" style="font-size:16px !important">
									<b><?php _e('New: ', SFSI_PLUS_DOMAIN); ?></b><?php _e('In the Premium Plugin, we also added: Pinterest, Linkedin, WhatsApp, VK, OK, Telegram, Weibo, WeChat, Xing and the option to add custom icons. There are more placement options too, e.g. place the responsive icons before/after posts/pages, show them only on desktop/mobile, insert them manually (via shortcode).', SFSI_PLUS_DOMAIN); ?><a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmplus_settings_page&utm_campaign=responsive_icons&utm_medium=banner" class="sfsi_plus_font_inherit" target="_blank"><?php _e(' See all features', SFSI_PLUS_DOMAIN); ?></a>
								</p>
							</div>
						<?php } ?>

					</li>

					<!-- sfsi_plus_responsive_icons_end_post -->
					<li class="sfsi_plus_responsive_icon_option_li sfsiplus_responsive_show " style="<?php echo ($sfsi_plus_display_responsive_type) ?>">
						<label class="heading-label">
							<?php _e('Design options', SFSI_PLUS_DOMAIN); ?>
						</label>
						<div class="options sfsi_plus_border_left_0 ">
							<label class="first">
								<?php _e('Icons size:', SFSI_PLUS_DOMAIN); ?>
							</label>
							<div class="field">
								<div style="display:inline-block">
									<select name="sfsi_plus_responsive_icons_settings_icon_size" class="styled">
										<option value="Small" <?php echo (isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["icon_size"]) && $sfsi_plus_responsive_icons["settings"]["icon_size"] === "Small") ? 'selected="selected"' : ""; ?>>
											Small
										</option>
										<option value="Medium" <?php echo (isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["icon_size"]) && $sfsi_plus_responsive_icons["settings"]["icon_size"] === "Medium") ? 'selected="selected"' : ""; ?>>
											Medium
										</option>
										<option value="Large" <?php echo (isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["icon_size"]) && $sfsi_plus_responsive_icons["settings"]["icon_size"] === "Large") ? 'selected="selected"' : ""; ?>>
											Large
										</option>
									</select>
								</div>
							</div>
						</div>

						<div class="options sfsi_plus_border_left_0 ">
							<label class="first">
								<?php _e('Icons width:', SFSI_PLUS_DOMAIN); ?>
							</label>
							<div class="field">
								<div style="display:inline-block">
									<select name="sfsi_plus_responsive_icons_settings_icon_width_type" class="styled">
										<option value="Fixed icon width" <?php echo (isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["icon_width_type"]) && $sfsi_plus_responsive_icons["settings"]["icon_width_type"] === "Fixed icon width") ? 'selected="selected"' : ""; ?>>
											<?php _e('Fixed icon width', SFSI_PLUS_DOMAIN); ?>
										</option>
										<option value="Fully responsive" <?php echo (isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["icon_width_type"]) && $sfsi_plus_responsive_icons["settings"]["icon_width_type"] === "Fully responsive") ? 'selected="selected"' : ""; ?>>
											<?php _e('Fully responsive', SFSI_PLUS_DOMAIN); ?>
										</option>
									</select>
								</div>
								<div class="sfsi_plus_responsive_icons_icon_width sfsi_plus_inputSec" style='display:<?php echo (isset($sfsi_plus_responsive_icons["settings"]["icon_width_type"]) && $sfsi_plus_responsive_icons["settings"]["icon_width_type"] == 'Fully responsive') ? 'none' : 'inline-block'; ?>'>
									<span style="width:auto!important"><?php _e('of', SFSI_PLUS_DOMAIN); ?></span>
									<input type="number" value="<?php echo isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["icon_width_size"]) ? $sfsi_plus_responsive_icons["settings"]["icon_width_size"] : 140;  ?>" name="sfsi_plus_responsive_icons_sttings_icon_width_size" style="float:none" />
									</select>
									<span class="sfsi_plus_span_after_input"><?php _e('pixels', SFSI_PLUS_DOMAIN); ?></span>
								</div>
							</div>
						</div>

						<div class="options sfsi_plus_border_left_0" style="display: flow-root;">
							<label class="first">
								<?php _e('Edges:', SFSI_PLUS_DOMAIN); ?>
							</label>
							<div class="field">
								<div style="display:inline-block">
									<select name="sfsi_plus_responsive_icons_settings_edge_type" class="styled">
										<option value="Round" <?php echo (isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["edge_type"]) && $sfsi_plus_responsive_icons["settings"]["edge_type"] === "Round") ? 'selected="selected"' : ""; ?>>
											<?php _e('Round', SFSI_PLUS_DOMAIN); ?>
										</option>
										<option value="Sharp" <?php echo (isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["edge_type"]) && $sfsi_plus_responsive_icons["settings"]["edge_type"] === "Sharp") ? 'selected="selected"' : ""; ?>>
											<?php _e('Sharp', SFSI_PLUS_DOMAIN); ?>
										</option>
									</select>
								</div>
							</div>
							<span style="width:auto!important;font-size: 18px;color: #5A6570;line-height: 45px;font-family: 'helveticaneue-light';margin-left:4px; <?php echo (isset($sfsi_plus_responsive_icons["settings"]["edge_type"]) && $sfsi_plus_responsive_icons["settings"]["edge_type"] == 'Sharp') ? 'display:none' : ''; ?>"><?php _e('with border radius', SFSI_PLUS_DOMAIN); ?></span>
							<div style="position:absolute;<?php echo (isset($sfsi_plus_responsive_icons["settings"]["edge_type"]) && $sfsi_plus_responsive_icons["settings"]["edge_type"] == 'Sharp') ? 'display:none' : 'display:inline-block'; ?>">
								<select name="sfsi_plus_responsive_icons_settings_edge_radius" id="sfsi_plus_icons_alignment" class="styled">
									<?php for ($i = 1; $i <= 20; $i++) : ?>
										<option value="<?php echo $i; ?>" <?php echo (isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["edge_radius"]) && $sfsi_plus_responsive_icons["settings"]["edge_radius"] == $i) ?  'selected="selected"' : ''; ?>>
											<?php echo $i; ?>
										</option>
									<?php endfor; ?>
								</select>
							</div>
							<span style=" <?php echo (isset($sfsi_plus_responsive_icons["settings"]["edge_type"]) && $sfsi_plus_responsive_icons["settings"]["edge_type"] == 'Sharp') ? 'display:none' : ''; ?>"><?php _e('pixels', SFSI_PLUS_DOMAIN); ?></span>

						</div>

						<div class="options sfsi_plus_border_left_0">
							<label class="first">
								<?php _e('Style:', SFSI_PLUS_DOMAIN); ?>
							</label>
							<div class="field">
								<div style="display:inline-block">
									<select name="sfsi_plus_responsive_icons_settings_style" class="styled">
										<option value="Flat" <?php echo (isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["style"]) && $sfsi_plus_responsive_icons["settings"]["style"] === "Flat") ? 'selected="selected"' : ""; ?>>
											<?php _e('Flat', SFSI_PLUS_DOMAIN); ?>
										</option>
										<option value="Gradient" <?php echo (isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["style"]) && $sfsi_plus_responsive_icons["settings"]["style"] === "Gradient") ? 'selected="selected"' : ""; ?>>
											<?php _e('Gradient', SFSI_PLUS_DOMAIN); ?>
										</option>
									</select>
								</div>
							</div>
						</div>

						<div class="options sfsi_plus_border_left_0 sfsi_plus_inputSec">
							<label class="first">
								<?php _e('Margin between icons:', SFSI_PLUS_DOMAIN); ?>
							</label>
							<div class="field">
								<input type="number" value="<?php echo isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["margin"]) ? $sfsi_plus_responsive_icons["settings"]["margin"] : 0;  ?>" name="sfsi_plus_responsive_icons_settings_margin" style="float:none" />
								<span class="span_after_input"><?php _e('pixels', SFSI_PLUS_DOMAIN); ?></span>
							</div>
						</div>

						<div class="options sfsi_plus_border_left_0 sfsi_plus_inputSec">
							<label class="first">
								<?php _e('Margins:', SFSI_PLUS_DOMAIN); ?>
							</label>
							<div class="field" style="float: none;">
								<span class="span_before_input" style="width: 120px;">Above Icon</span>
								<input type="number" value="<?php echo isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["margin_above"]) ? $sfsi_plus_responsive_icons["settings"]["margin_above"] : 0;  ?>" name="sfsi_plus_responsive_icons_settings_margin_above" style="float:none" />
								<span class="span_after_input"><?php _e('px', SFSI_PLUS_DOMAIN); ?></span>
							</div>
							<div class="field" style="float: none;">
								<span class="span_before_input" style="width: 120px;">Below Icon</span>
								<input type="number" value="<?php echo isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["margin_below"]) ? $sfsi_plus_responsive_icons["settings"]["margin_below"] : 0;  ?>" name="sfsi_plus_responsive_icons_settings_margin_below" style="float:none" />
								<span class="span_after_input"><?php _e('px', SFSI_PLUS_DOMAIN); ?></span>
							</div>
						</div>



						<div class="options sfsi_plus_border_left_0">
							<label class="first">
								<?php _e('Text on icons:', SFSI_PLUS_DOMAIN); ?>
							</label>
							<div class="field">
								<div style="display:inline-block">
									<select name="sfsi_plus_responsive_icons_settings_text_align" class="styled">
										<option value="Left aligned" <?php echo (isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["text_align"]) && $sfsi_plus_responsive_icons["settings"]["text_align"] === "Left aligned") ? 'selected="selected"' : ""; ?>>
											<?php _e('Left aligned', SFSI_PLUS_DOMAIN); ?>
										</option>
										<option value="Centered" <?php echo (isset($sfsi_plus_responsive_icons["settings"]) && isset($sfsi_plus_responsive_icons["settings"]["text_align"]) && $sfsi_plus_responsive_icons["settings"]["text_align"] === "Centered") ? 'selected="selected"' : ""; ?>>
											<?php _e('Centered', SFSI_PLUS_DOMAIN); ?>
										</option>
									</select>
								</div>
							</div>
						</div>
					</li>
				

					<li class="sfsi_plus_responsive_icon_option_li sfsiplus_responsive_hide" style="<?php echo ($sfsi_plus_display_normal_type) ?>">
						<ul class="sfsiplus_tab_3_icns sfsiplus_shwthmbfraftr ">
							<li class="row sfsiplus_PostsSettings_section sfsi_plus_border_left_0" style="width: 100% !important;padding-left: 16px">
								<div class="options sfsipluspstvwpr">
									<label class="first chcklbl">
										<?php _e('Display them:', SFSI_PLUS_DOMAIN); ?>
									</label>
									<label class="seconds chcklbl labelhdng4" style="font-size: 18px;">
										<?php _e('On Post Pages', SFSI_PLUS_DOMAIN); ?>
									</label>
									<div class="chckwpr">
										<div class="snglchckcntr">
											<div class="radio_section tb_4_ck"><input name="sfsi_plus_display_before_posts" <?php echo ($option8['sfsi_plus_display_before_posts'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_plus_display_before_posts" type="checkbox" value="yes" class="styled" /></div>
											<div class="sfsiplus_right_info">
												<?php _e('Before posts', SFSI_PLUS_DOMAIN); ?>
											</div>
										</div>
										<div class="snglchckcntr">
											<div class="radio_section tb_4_ck"><input name="sfsi_plus_display_after_posts" <?php echo ($option8['sfsi_plus_display_after_posts'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_plus_display_after_posts" type="checkbox" value="yes" class="styled" /></div>
											<div class="sfsiplus_right_info">
												<?php _e('After posts', SFSI_PLUS_DOMAIN); ?>
											</div>
										</div>

									</div>
								</div>

								<div class="options sfsipluspstvwpr">
									<label class="first chcklbl"> &nbsp;</label>
									<label class="seconds chcklbl labelhdng4" style="font-size: 18px;">
										<?php _e('On Homepage', SFSI_PLUS_DOMAIN); ?>
									</label>
									<div class="chckwpr">
										<div class="snglchckcntr">
											<div class="radio_section tb_4_ck"><input name="sfsi_plus_display_before_blogposts" <?php echo ($option8['sfsi_plus_display_before_blogposts'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_plus_display_before_blogposts" type="checkbox" value="yes" class="styled" /></div>
											<div class="sfsiplus_right_info">
												<?php _e('Before posts', SFSI_PLUS_DOMAIN); ?>
											</div>
										</div>
										<div class="snglchckcntr">
											<div class="radio_section tb_4_ck"><input name="sfsi_plus_display_after_blogposts" <?php echo ($option8['sfsi_plus_display_after_blogposts'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_plus_display_after_blogposts" type="checkbox" value="yes" class="styled" /></div>
											<div class="sfsiplus_right_info">
												<?php _e('After posts', SFSI_PLUS_DOMAIN); ?>
											</div>
										</div>

									</div>
								</div>

								<!--Display them options-->
								<div class="options shareicontextfld">
									<label class="first" style="width: 36% !important;line-height: 42px !important;">
										<?php _e('Text to appear before the sharing icons:', SFSI_PLUS_DOMAIN); ?>
									</label><input name="sfsi_plus_textBefor_icons" type="text" value="<?php echo ($option8['sfsi_plus_textBefor_icons'] != '') ?  $option8['sfsi_plus_textBefor_icons'] : ''; ?>" />
									<?php if ($option8['sfsi_plus_show_premium_placement_box'] == 'yes') { ?>
										<p class="sfsi_plus_prem_plu_desc_define">
											<b><?php _e('New: ', SFSI_PLUS_DOMAIN); ?></b><?php _e(' In the Premium Plugin you can now also define the font size, type, and the margins below/the above icons. ', SFSI_PLUS_DOMAIN); ?><a class="pop-up" data-id="sfsi_plus_quickpay-overlay" onclick="sfsi_plus_open_quick_checkout(event)" style="cursor:pointer;border-bottom: 1px solid #12a252;color: #12a252 !important" class="sfisi_plus_font_bold" target="_blank"><?php _e('Go premium now', SFSI_PLUS_DOMAIN); ?></a><a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmplus_settings_page&utm_campaign=more_placement_options&utm_medium=banner" class="sfsi_plus_font_inherit" style="color: #12a252 !important" target="_blank"><?php _e(' or learn more', SFSI_PLUS_DOMAIN); ?></a>
										</p>
									<?php } ?>
								</div>

								<div class="options">
									<label>
										<?php _e('Alignment of share icons:', SFSI_PLUS_DOMAIN); ?>
									</label>
									<div class="field">
										<select name="sfsi_plus_icons_alignment" id="sfsi_plus_icons_alignment" class="styled">
											<option value="left" <?php echo ($option8['sfsi_plus_icons_alignment'] == 'left') ?  'selected="selected"' : ''; ?>>
												<?php _e('Left', SFSI_PLUS_DOMAIN); ?>
											</option>
											<option value="right" <?php echo ($option8['sfsi_plus_icons_alignment'] == 'right') ?  'selected="selected"' : ''; ?>>
												<?php _e('Right', SFSI_PLUS_DOMAIN); ?>
											</option>
											<option value="center" <?php echo ($option8['sfsi_plus_icons_alignment'] == 'center') ?  'selected="selected"' : ''; ?>>
												<?php _e('Center', SFSI_PLUS_DOMAIN); ?>
											</option>
										</select>
									</div>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</li>

		<!-- pinterest on image over icon -->
		<li class="row sfsiplus_show_via_onhover  disabled_checkbox">

			<div class="radio_section tb_4_ck">
				<span class="checkbox" style="background-position:0px 0px!important;width:31px"></span>
				<input name="" type="checkbox" disable value="" class="hide" style="display:none;" /></div>

			<div class="sfsiplus_right_info">

				<p style="display:block">
					<span class="sfsiplus_toglepstpgspn" style="display:inline-block">Show a Pinterest icon over images on mouse-over </span> <span> - <a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmplus_settings_page&utm_campaign=pinterest_icon_mouse_over&utm_medium=link" target="_blank" style="font-weight:800;color:#777">Premium feature</a></span>
				</p>

			</div>
		</li>

		<!-- Woocommerce -->
		<?php
		$sfsi_woocommerce_path = "woocommerce/woocommerce.php";
		if(is_plugin_active($sfsi_woocommerce_path)){
		?>
		<li class="row sfsiplus_show_via_onhover  disabled_checkbox">

			<div class="radio_section tb_4_ck">
				<span class="checkbox" style="background-position:0px 0px!important;width:31px"></span>
				<input name="" type="checkbox" disable value="" class="hide" style="display:none;" /></div>

			<div class="sfsiplus_right_info sfsi_plus_Woocommerce_disable">

				<p style="display:block">
					<span class="sfsiplus_toglepstpgspn" style="display:inline-block">On your Woocommerce product pages</span> <span> - <a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmplus_settings_page&utm_campaign=woocommerce_placement&utm_medium=link" target="_blank" style="font-weight:800;color:#777">Premium feature</a></span>
				</p>

			</div>
		</li>
		<?php
		}
		?>
	</ul>

	<?php if ($option8['sfsi_plus_show_premium_placement_box'] == 'yes') { ?>
		<div class="sfsi_plus_new_prmium_follw ">
			<p>
				<b><?php _e('New: ', SFSI_PLUS_DOMAIN); ?></b><?php _e('In our Premium Plugin you have many more placement options, e.g. place the icons statically on the page, optimize placement for mobile, don’t show them on certain pages, show them while the user is scrolling down the page (or not), etc. ', SFSI_PLUS_DOMAIN); ?><a style="cursor:pointer" class="pop-up" data-id="sfsi_plus_quickpay-overlay" onclick="sfsi_plus_open_quick_checkout(event)" class="sfisi_plus_font_bold" target="_blank"><?php _e('Go premium now', SFSI_PLUS_DOMAIN); ?></a><a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmplus_settings_page&utm_campaign=more_placement_options&utm_medium=banner" class="sfsi_plus_font_inherit" target="_blank"><?php _e(' or learn more', SFSI_PLUS_DOMAIN); ?></a>
			</p>
		</div>
	<?php } ?>

	<?php sfsi_plus_ask_for_help(8); ?>

	<!-- SAVE BUTTON SECTION   -->
	<div class="save_button">
		<img src="<?php echo SFSI_PLUS_PLUGURL ?>images/ajax-loader.gif" class="loader-img" />
		<?php $nonce = wp_create_nonce("update_plus_step8"); ?>
		<a href="javascript:;" id="sfsi_plus_save8" title="Save" data-nonce="<?php echo $nonce; ?>">
			<?php _e('Save', SFSI_PLUS_DOMAIN); ?>
		</a>
	</div>
	<!-- END SAVE BUTTON SECTION   -->

	<a class="sfsiColbtn closeSec" href="javascript:;">
		<?php _e('Collapse area', SFSI_PLUS_DOMAIN); ?>
	</a>
	<label class="closeSec"></label>

	<!-- ERROR AND SUCCESS MESSAGE AREA-->
	<p class="red_txt errorMsg" style="display:none"> </p>
	<p class="green_txt sucMsg" style="display:none"> </p>
	<div class="clear"></div>

</div>