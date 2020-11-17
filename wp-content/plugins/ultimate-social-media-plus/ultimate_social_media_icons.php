<?php
/*
Plugin Name: Ultimate Social Media PLUS
Plugin URI: http://socialshare.pro/
Description: The best social media plugin on the market. And 100% FREE. Allows you to add social media & share icons to your blog (esp. Facebook, Twitter, Email, RSS, Pinterest, Instagram, LinkedIn, Share-button). It offers a wide range of design options and other features. 
Author: social share pro
Text Domain: ultimate-social-media-plus
Domain Path: /languages
Author URI: http://socialshare.pro/
Version: 3.4.4
License: GPLv2
*/

sfsi_plus_error_reporting();

require_once 'analyst/main.php';

analyst_init(array(
	'client-id' => 'w6l8b75dy5qkv9ze',
	'client-secret' => '39db55426579986bb6c79c6d94aa6ab82b67f9f5',
	'base-dir' => __FILE__
));

global $wpdb;
/* define the Root for URL and Document */

define('SFSI_PLUS_DOCROOT',    dirname(__FILE__));
// define('SFSI_PLUS_PLUGURL',    plugin_dir_url(__FILE__));
define('SFSI_PLUS_PLUGURL',    site_url() . '/wp-content/plugins/ultimate-social-media-plus/');
define('SFSI_PLUS_WEBROOT',    str_replace(getcwd(), home_url(), dirname(__FILE__)));
define('SFSI_PLUS_DOMAIN',	   'ultimate-social-media-plus');
define('SFSI_PLUS_SUPPORT_FORM', 'https://goo.gl/jySrSF');

$wp_upload_dir = wp_upload_dir();
define('SFSI_PLUS_UPLOAD_DIR_BASEURL', trailingslashit($wp_upload_dir['baseurl']));


define('SFSI_PLUS_ALLICONS', serialize(array(
	"rss", "email", "facebook", "twitter", "youtube", "linkedin",
	"pinterest", "instagram", "houzz", "ok", "telegram", "vk", "weibo", "wechat"
)));

function sfsi_plus_get_current_url()
{
	global $post, $wp;

	if (!empty($wp)) {
		return home_url(add_query_arg(array(), $wp->request));
	} elseif (!empty($post)) {
		return get_permalink($post->ID);
	} else {
		return site_url();
	}
}

/* load all files  */
include(SFSI_PLUS_DOCROOT . '/helpers/common_helper.php');
include(SFSI_PLUS_DOCROOT . '/libs/controllers/sfsi_socialhelper.php');
include(SFSI_PLUS_DOCROOT . '/libs/controllers/sfsi_class_theme_check.php');
include(SFSI_PLUS_DOCROOT . '/libs/sfsi_install_uninstall.php');
include(SFSI_PLUS_DOCROOT . '/libs/controllers/sfsi_buttons_controller.php');
include(SFSI_PLUS_DOCROOT . '/libs/controllers/sfsi_iconsUpload_contoller.php');
include(SFSI_PLUS_DOCROOT . '/libs/sfsi_Init_JqueryCss.php');
include(SFSI_PLUS_DOCROOT . '/libs/controllers/sfsi_floater_icons.php');
include(SFSI_PLUS_DOCROOT . '/libs/controllers/sfsiocns_OnPosts.php');
include(SFSI_PLUS_DOCROOT . '/libs/sfsi_widget.php');
include(SFSI_PLUS_DOCROOT . '/libs/sfsi_plus_subscribe_widget.php');
include(SFSI_PLUS_DOCROOT . '/libs/sfsi_custom_social_sharing_data.php');
include(SFSI_PLUS_DOCROOT . '/libs/sfsi_ajax_social_sharing_settings_updater.php');
include(SFSI_PLUS_DOCROOT . '/libs/sfsi_gutenberg_block.php');


/* plugin install and uninstall hooks */
register_activation_hook(__FILE__, 'sfsi_plus_activate_plugin');
register_deactivation_hook(__FILE__, 'sfsi_plus_deactivate_plugin');
register_uninstall_hook(__FILE__, 'sfsi_plus_Unistall_plugin');

/*Plugin version setup*/
if (!get_option('sfsi_plus_pluginVersion') || get_option('sfsi_plus_pluginVersion') < 3.44) {
	add_action("init", "sfsi_plus_update_plugin");
}

//************************************** Setting error reporting STARTS ****************************************//

function sfsi_plus_error_reporting()
{

	$option5 = unserialize(get_option('sfsi_plus_section5_options', false));

	if (
		isset($option5['sfsi_pplus_icons_suppress_errors'])

		&& !empty($option5['sfsi_pplus_icons_suppress_errors'])

		&& "yes" == $option5['sfsi_pplus_icons_suppress_errors']
	) {

		error_reporting(0);
	}
}

//************************************** Setting error reporting CLOSES ****************************************//

//shortcode for the ultimate social icons {Monad}
add_shortcode("DISPLAY_ULTIMATE_PLUS", "DISPLAY_ULTIMATE_PLUS");
function DISPLAY_ULTIMATE_PLUS($args = null, $content = null, $share_url = null)
{
	if ("DISPLAY_ULTIMATE_PLUS" === $share_url) {
		$share_url = null;
	}
	$instance = array("showf" => 1, "title" => '');
	$sfsi_plus_section8_options = get_option("sfsi_plus_section8_options");
	$sfsi_plus_section8_options = unserialize($sfsi_plus_section8_options);
	$sfsi_plus_place_item_manually = $sfsi_plus_section8_options['sfsi_plus_place_item_manually'];
	if ($sfsi_plus_place_item_manually == "yes") {
		$return = '';
		if (!isset($before_widget)) : $before_widget = '';
		endif;
		if (!isset($after_widget)) : $after_widget = '';
		endif;

		/*Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title']);
		$show_info = isset($instance['show_info']) ? $instance['show_info'] : false;
		global $is_floter;
		$return .= $before_widget;
		/* Display the widget title */
		if ($title) $return .= $before_title . $title . $after_title;
		$return .= '<div class="sfsi_plus_widget">';
		$return .= '<div id="sfsi_plus_wDiv"></div>';
		/* Link the main icons function */
		$return .= sfsi_plus_check_visiblity(0, $share_url, 'absolute', false);
		$return .= '<div style="clear: both;"></div>';
		$return .= '</div>';
		$return .= $after_widget;
		return $return;
	} else {
		return __('Kindly go to setting page and check the option "Place them manually"', SFSI_PLUS_DOMAIN);
	}
}
//adding some meta tags for facebook news feed
function sfsi_plus_checkmetas()
{
	$adding_plustags = "yes";

	if (!function_exists('get_plugins')) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	$all_plugins = get_plugins();

	foreach ($all_plugins as $key => $plugin) :

		if (is_plugin_active($key)) :

			if (preg_match("/(seo|search engine optimization|meta tag|open graph|opengraph|og tag|ogtag)/im", $plugin['Name']) || preg_match("/(seo|search engine optimization|meta tag|open graph|opengraph|og tag|ogtag)/im", $plugin['Description'])) {
				$adding_plustags = "no";
				break;
			}

		endif;

	endforeach;

	update_option('adding_plustags', $adding_plustags);
}

if (is_admin()) {
	// sfsi_plus_checkmetas();
	add_action('after_setup_theme', 'sfsi_plus_checkmetas');
}

add_action('wp_head', 'ultimateplusfbmetatags');
function ultimateplusfbmetatags()
{
	$metarequest = get_option("adding_plustags");
	$post_id = get_the_ID();

	$feed_id = sanitize_text_field(get_option('sfsi_plus_feed_id'));
	$verification_code = get_option('sfsi_plus_verificatiom_code');
	if (!empty($feed_id) && !empty($verification_code) && $verification_code != "no") {
		echo '<meta name="follow.it-verification-code-' . $feed_id . '" content="' . $verification_code . '"/>';
	}

	if ($metarequest == 'yes' && !empty($post_id)) {
		$post = get_post($post_id);
		$attachment_id = get_post_thumbnail_id($post_id);
		$title = str_replace('"', "", strip_tags(get_the_title($post_id)));
		$description = $post->post_content;
		$description = str_replace('"', "", strip_tags($description));
		$url = get_permalink($post_id);

		//checking for disabling viewport meta tag
		$option5 =  unserialize(get_option('sfsi_plus_section5_options', false));
		if (isset($option5['sfsi_plus_disable_viewport'])) {
			$sfsi_plus_disable_viewport = $option5['sfsi_plus_disable_viewport'];
		} else {
			$sfsi_plus_disable_viewport = 'no';
		}
		if ($sfsi_plus_disable_viewport == 'no') {
			echo ' <meta name="viewport" content="width=device-width, initial-scale=1">';
		}
		//checking for disabling viewport meta tag

		if ($attachment_id) {
			$feat_image = wp_get_attachment_url($attachment_id);
			if (preg_match('/https/', $feat_image)) {
				echo '<meta property="og:image:secure_url" content="' . $feat_image . '" data-id="sfsi-plus"/>';
			} else {
				echo '<meta property="og:image" content="' . $feat_image . '" data-id="sfsi-plus"/>';
			}
			$metadata = wp_get_attachment_metadata($attachment_id);
			if (isset($metadata) && !empty($metadata)) {
				if (isset($metadata['sizes']['post-thumbnail'])) {
					$image_type = $metadata['sizes']['post-thumbnail']['mime-type'];
				} else {
					$image_type = '';
				}
				if (isset($metadata['width'])) {
					$width = $metadata['width'];
				} else {
					$width = '';
				}
				if (isset($metadata['height'])) {
					$height = $metadata['height'];
				} else {
					$height = '';
				}
			} else {
				$image_type = '';
				$width = '';
				$height = '';
			}
			echo '<meta property="og:image:type" content="' . $image_type . '" data-id="sfsi-plus"/>';
			echo '<meta property="og:image:width" content="' . $width . '" data-id="sfsi-plus"/>';
			echo '<meta property="og:image:height" content="' . $height . '" data-id="sfsi-plus"/>';
			echo '<meta property="og:description" content="' . $description . '" data-id="sfsi-plus"/>';
			echo '<meta property="og:url" content="' . $url . '" data-id="sfsi-plus"/>';
			echo '<meta property="og:title" content="' . $title . '" data-id="sfsi-plus"/>';
		}
	}
}

//Get verification code
if (is_admin()) {
	$code 		= sanitize_text_field(get_option('sfsi_plus_verificatiom_code'));
	$feed_id 	= sanitize_text_field(get_option('sfsi_plus_feed_id'));
	if (empty($code) && !empty($feed_id)) {
		add_action("init", "sfsi_plus_getverification_code");
	}
}
function sfsi_plus_getverification_code()
{
	$feed_id = sanitize_text_field(get_option('sfsi_plus_feed_id'));
	$url = $http_url = 'https://api.follow.it/wordpress/getVerifiedCode_plugin';

	$args = array(
		'timeout'     => 30,
		'sslverify' => true,
		'body'    => array(
			'feed_id'  =>  $feed_id
		)
	);

	$request = wp_remote_post($url, $args);

	if (!is_wp_error($request)) {
		$resp = json_decode($request['body']);
		update_option('sfsi_plus_verificatiom_code', $resp->code);
	}
}

//functionality for before and after single posts
add_filter('the_content', 'sfsi_plus_beforaftereposts');
function sfsi_plus_beforaftereposts($content)
{

	$org_content = $content;
	$icons_before = '';
	$icons_after = '';
	if (is_single()) {
		$option8 =  unserialize(get_option('sfsi_plus_section8_options', false));
		// var_dump($option8);die();
		$lineheight = $option8['sfsi_plus_post_icons_size'];
		$lineheight = sfsi_plus_getlinhght($lineheight);
		$sfsi_plus_display_button_type = $option8['sfsi_plus_display_button_type'];
		$txt = (isset($option8['sfsi_plus_textBefor_icons'])) ? $option8['sfsi_plus_textBefor_icons'] : "Please follow and like us:";
		$float = $option8['sfsi_plus_icons_alignment'];
		if ($float == "center") {
			$style_parent = 'text-align: center;';
			$style = 'float:none; display: inline-block;';
		} else {
			$style_parent = '';
			$style = 'float:' . $float;
		}

		if ($option8['sfsi_plus_display_before_posts'] == "yes" && $option8['sfsi_plus_show_item_onposts'] == "yes") {
			$icons_before .= '<div class="sfsibeforpstwpr" style="' . $style_parent . '">';
			if ($sfsi_plus_display_button_type == 'standard_buttons') {
				$icons_before .= sfsi_plus_social_buttons_below($content = null);
			} else if ($option8['sfsi_plus_display_button_type'] == 'responsive_button') {
				$icons_before .= "";
			} else {
				$icons_before .= "<div class='sfsi_plus_Sicons' style='" . $style . "'>";
				$icons_before .= "<div style='float:left;margin:0 0px; line-height:" . $lineheight . "px'><span>" . $txt . "</span></div>";
				$icons_before .= sfsi_plus_check_posts_visiblity(0, "yes");
				$icons_before .= "</div>";
			}
			$icons_before .= '</div>';
		}
		if ($option8['sfsi_plus_show_item_onposts'] == "yes") {

			$icons_after .= '<div class="sfsiaftrpstwpr"  style="' . $style_parent . '">';
			if ($option8['sfsi_plus_display_after_posts'] == "yes") {
				if ($sfsi_plus_display_button_type == 'standard_buttons') {
					$icons_after .= sfsi_plus_social_buttons_below($content = null);
				} else if ($option8['sfsi_plus_display_button_type'] == 'responsive_button') {
						$icons_after .= sfsi_plus_social_responsive_buttons(null, $option8);
				} else {
					$icons_after .= "<div class='sfsi_plus_Sicons' style='" . $style . "'>";
					$icons_after .= "<div style='float:left;margin:0 0px; line-height:" . $lineheight . "px'><span>" . $txt . "</span></div>";
					$icons_after .= sfsi_plus_check_posts_visiblity(0, "yes");
					$icons_after .= "</div>";
				}
			} else {
				if (isset($option8['sfsi_plus_display_button_type']) && $option8['sfsi_plus_display_button_type'] == 'responsive_button') {
						$icons_after .= sfsi_plus_social_responsive_buttons(null, $option8);
				}
			}

			$icons_after .= '</div>';
		}
	}
	$content = $icons_before . $org_content . $icons_after;
	return $content;
}

//showing before and after blog posts
add_filter('the_excerpt', 'sfsi_plus_beforeafterblogposts');
add_filter('the_content', 'sfsi_plus_beforeafterblogposts');
function sfsi_plus_beforeafterblogposts($content)
{
	if (is_home()) {
		$icons_before = '';
		$icons_after = '';
		$sfsi_section8 =  unserialize(get_option('sfsi_plus_section8_options', false));
		$sfsi_section4 =  unserialize(get_option('sfsi_plus_section4_options', false));
		$lineheight = $sfsi_section8['sfsi_plus_post_icons_size'];
		$lineheight = sfsi_plus_getlinhght($lineheight);

		global $id, $post;
		$sfsi_plus_display_button_type = $sfsi_section8['sfsi_plus_display_button_type'];
		$sfsi_plus_show_item_onposts = $sfsi_section8['sfsi_plus_show_item_onposts'];
		$permalink = get_permalink($post->ID);
		$post_title = $post->post_title;
		$sfsiLikeWith = "45px;";
		if ($sfsi_section4['sfsi_plus_display_counts'] == "yes" && $sfsi_section4['sfsi_plus_original_counts'] == "yes") {
			$show_count = 1;
			$sfsiLikeWith = "75px;";
		} else {
			$show_count = 0;
		}

		//checking for standard icons
		if (!isset($sfsi_section8['sfsi_plus_rectsub'])) {
			$sfsi_section8['sfsi_plus_rectsub'] = 'no';
		}
		if (!isset($sfsi_section8['sfsi_plus_recttwtr'])) {
			$sfsi_section8['sfsi_plus_recttwtr'] = 'no';
		}
		if (!isset($sfsi_section8['sfsi_plus_rectpinit'])) {
			$sfsi_section8['sfsi_plus_rectpinit'] = 'no';
		}
		if (!isset($sfsi_section8['sfsi_plus_rectfbshare'])) {
			$sfsi_section8['sfsi_plus_rectfbshare'] = 'no';
		}

		//checking for standard icons
		$txt = (isset($sfsi_section8['sfsi_plus_textBefor_icons'])) ? $sfsi_section8['sfsi_plus_textBefor_icons'] : "Please follow and like us:";
		$float = $sfsi_section8['sfsi_plus_icons_alignment'];
		if ($float == "center") {
			$style_parent = 'text-align: center;';
			$style = 'float:none; display: inline-block;';
		} else {
			$style_parent = '';
			$style = 'float:' . $float;
		}

		if (
			$sfsi_section8['sfsi_plus_display_before_blogposts'] == "yes" &&
			$sfsi_section8['sfsi_plus_show_item_onposts'] == "yes"
		) {
			//icon selection
			$icons_before .= "<div class='sfsibeforpstwpr' style='" . $style_parent . "'>";
			$icons_before .= "<div class='sfsi_plus_Sicons " . $float . "' style='" . $style . "'>";
			if ($sfsi_plus_display_button_type == 'standard_buttons') {
				if (
					$sfsi_section8['sfsi_plus_rectsub']		== 'yes' ||
					$sfsi_section8['sfsi_plus_rectfb']		== 'yes' ||
					$sfsi_section8['sfsi_plus_recttwtr'] 	== 'yes' ||
					$sfsi_section8['sfsi_plus_rectpinit'] 	== 'yes' ||
					$sfsi_section8['sfsi_plus_rectfbshare'] == 'yes'
				) {
					$icons_before .= "<div style='display: inline-block;margin-bottom: 0; margin-left: 0; margin-right: 8px; margin-top: 0; vertical-align: middle;width: auto;'><span>" . $txt . "</span></div>";
				}
				if ($sfsi_section8['sfsi_plus_rectsub'] == 'yes') {
					if ($show_count) {
						$sfsiLikeWithsub = "93px";
					} else {
						$sfsiLikeWithsub = "64px";
					}
					if (!isset($sfsiLikeWithsub)) {
						$sfsiLikeWithsub = $sfsiLikeWith;
					}
					$icons_before .= "<div class='sf_subscrbe' style='display: inline-block;vertical-align: middle;width: auto;'>" . sfsi_plus_Subscribelike($permalink, $show_count) . "</div>";
				}
				if ($sfsi_section8['sfsi_plus_rectfb'] == 'yes' || $sfsi_section8['sfsi_plus_rectfbshare'] == 'yes') {
					if ($show_count) { } else {
						$sfsiLikeWithfb = "48px";
					}
					if (!isset($sfsiLikeWithfb)) {
						$sfsiLikeWithfb = $sfsiLikeWith;
					}
					$icons_before .= "<div class='sf_fb' style='display: inline-block; vertical-align: middle;width: auto;'>" . sfsi_plus_FBlike($permalink, $show_count) . "</div>";
				}
				if ($sfsi_section8['sfsi_plus_rectfbshare'] == 'yes') {
					if ($show_count) { } else {
						$sfsiLikeWithfbshare = "48px";
					}
					if (!isset($sfsiLikeWithfbshare)) {
						$sfsiLikeWithfbshare = $sfsiLikeWith;
					}
					$icons_before .= "<div class='sf_fb' style='display: inline-block; vertical-align: middle;width: auto;'>" . sfsi_plus_FBshare($permalink, $show_count) . "</div>";
				}
				if ($sfsi_section8['sfsi_plus_recttwtr'] == 'yes') {
					if ($show_count) {
						$sfsiLikeWithtwtr = "77px";
					} else {
						$sfsiLikeWithtwtr = "56px";
					}
					if (!isset($sfsiLikeWithtwtr)) {
						$sfsiLikeWithtwtr = $sfsiLikeWith;
					}
					$icons_before .=  sfsi_twitterShare($permalink, $post_title, '', true);
				}
				if ($sfsi_section8['sfsi_plus_rectpinit'] == 'yes') {
					if ($show_count) {
						$sfsiLikeWithpinit = "100px";
					} else {
						$sfsiLikeWithpinit = "auto";
					}
					$icons_before .= "<div class='sf_pinit' style='display: inline-block;vertical-align: middle;text-align:left;width: " . $sfsiLikeWithpinit . "'>" . sfsi_plus_pinterest_Custom($permalink, $show_count) . "</div>";
				}
			} else if ($sfsi_section8['sfsi_plus_display_button_type'] == 'responsive_button') {
				// if (isset($sfsi_section8['sfsi_plus_responsive_icons_end_post']) && $sfsi_section8['sfsi_plus_responsive_icons_end_post'] == "yes") {
				// 	$icons_before .= sfsi_plus_social_responsive_buttons(null, $sfsi_section8);
				// }
				$icons_before .= "";
			} else {
				$icons_before .= "<div style='float:left;margin:0 0px; line-height:" . $lineheight . "px'><span>" . $txt . "</span></div>";
				$icons_before .= sfsi_plus_check_posts_visiblity(0, "yes");
			}
			$icons_before .= "</div>";
			$icons_before .= "</div>";
			//icon selection
			if ($id && $post && $post->post_type == 'post') {
				$content = $icons_before . $content;
			} else {
				$contnet = $content;
			}
		}
		if ($sfsi_section8['sfsi_plus_show_item_onposts'] == "yes") {

			//icon selection
			$icons_after .= "<div class='sfsiaftrpstwpr' style='" . $style_parent . "'>";
			$icons_after .= "<div class='sfsi_plus_Sicons " . $float . "' style='" . $style . "'>";
			// var_dump($sfsi_section8['sfsi_plus_display_after_blogposts']);

			if ($sfsi_section8['sfsi_plus_display_after_blogposts'] == "yes") {

				if ($sfsi_plus_display_button_type == 'standard_buttons') {
					if (
						$sfsi_section8['sfsi_plus_rectsub'] 	== 'yes' ||
						$sfsi_section8['sfsi_plus_rectfb'] 		== 'yes' ||
						$sfsi_section8['sfsi_plus_recttwtr'] 	== 'yes' ||
						$sfsi_section8['sfsi_plus_rectpinit'] 	== 'yes' ||
						$sfsi_section8['sfsi_plus_rectfbshare'] == 'yes'
					) {
						$icons_after .= "<div style='display: inline-block;margin-bottom: 0; margin-left: 0; margin-right: 8px; margin-top: 0; vertical-align: middle;width: auto;'><span>" . $txt . "</span></div>";
					}
					if ($sfsi_section8['sfsi_plus_rectsub'] == 'yes') {
						if ($show_count) {
							$sfsiLikeWithsub = "93px";
						} else {
							$sfsiLikeWithsub = "64px";
						}
						if (!isset($sfsiLikeWithsub)) {
							$sfsiLikeWithsub = $sfsiLikeWith;
						}
						$icons_after .= "<div class='sf_subscrbe' style='display: inline-block;vertical-align: middle; width: auto;'>" . sfsi_plus_Subscribelike($permalink, $show_count) . "</div>";
					}
					if ($sfsi_section8['sfsi_plus_rectfb'] == 'yes' || $sfsi_section8['sfsi_plus_rectfbshare'] == 'yes') {
						if ($show_count) { } else {
							$sfsiLikeWithfb = "48px";
						}
						if (!isset($sfsiLikeWithfb)) {
							$sfsiLikeWithfb = $sfsiLikeWith;
						}
						$icons_after .= "<div class='sf_fb' style='display: inline-block; vertical-align: middle;width: auto;'>" . sfsi_plus_FBlike($permalink, $show_count) . "</div>";
					}
					if ($sfsi_section8['sfsi_plus_rectfbshare'] == 'yes') {
						if ($show_count) { } else {
							$sfsiLikeWithfbshare = "48px";
						}
						if (!isset($sfsiLikeWithfbshare)) {
							$sfsiLikeWithfbshare = $sfsiLikeWith;
						}
						$icons_after .= "<div class='sf_fb' style='display: inline-block; vertical-align: middle;width: auto;'>" . sfsi_plus_FBshare($permalink, $show_count) . "</div>";
					}
					if ($sfsi_section8['sfsi_plus_recttwtr'] == 'yes') {
						if ($show_count) {
							$sfsiLikeWithtwtr = "77px";
						} else {
							$sfsiLikeWithtwtr = "56px";
						}
						if (!isset($sfsiLikeWithtwtr)) {
							$sfsiLikeWithtwtr = $sfsiLikeWith;
						}
						$icons_after .= "<div class='sf_twiter' style='display: inline-block;vertical-align: middle;width: auto;'>" . sfsi_twitterShare($permalink, $post_title) . "</div>";
					}
					if ($sfsi_section8['sfsi_plus_rectpinit'] == 'yes') {
						if ($show_count) {
							$sfsiLikeWithpinit = "100px";
						} else {
							$sfsiLikeWithpinit = "auto";
						}

						$icons_after .= "<div class='sf_pinit' style='display: inline-block;text-align:left;vertical-align: middle;width: " . $sfsiLikeWithpinit . "'>" . sfsi_plus_pinterest_Custom($permalink, $show_count) . "</div>";
					}
				} else if ($sfsi_section8['sfsi_plus_display_button_type'] == 'responsive_button') {
					// if (isset($sfsi_section8['sfsi_plus_responsive_icons_end_post']) && $sfsi_section8['sfsi_plus_responsive_icons_end_post'] == "yes") {
					// 	$icons_after .= sfsi_plus_social_responsive_buttons(null, $sfsi_section8);
					// }
					$icons_after .= "";
				} else {
					$icons_after .= "<div style='float:left;margin:0 0px; line-height:" . $lineheight . "px'><span>" . $txt . "</span></div>";
					$icons_after .= sfsi_plus_check_posts_visiblity(0, "yes");
				}
			} else {
				if (isset($sfsi_section8['sfsi_plus_display_button_type']) && $sfsi_section8['sfsi_plus_display_button_type'] == 'responsive_button') {
						if (is_single()) {
							$icons_after .= sfsi_plus_social_responsive_buttons(null, $sfsi_section8);
						}
				}
			}
			$icons_after .= "</div>";
			$icons_after .= "</div>";
			//icon selection
			$content = $content . $icons_after;
		}
	}
	return $content;
}

//getting line height for the icons
function sfsi_plus_getlinhght($lineheight)
{
	if ($lineheight < 16) {
		$lineheight = $lineheight * 2;
		return $lineheight;
	} elseif ($lineheight >= 16 && $lineheight < 20) {
		$lineheight = $lineheight + 10;
		return $lineheight;
	} elseif ($lineheight >= 20 && $lineheight < 28) {
		$lineheight = $lineheight + 3;
		return $lineheight;
	} elseif ($lineheight >= 28 && $lineheight < 40) {
		$lineheight = $lineheight + 4;
		return $lineheight;
	} elseif ($lineheight >= 40 && $lineheight < 50) {
		$lineheight = $lineheight + 5;
		return $lineheight;
	}
	$lineheight = $lineheight + 6;
	return $lineheight;
}

//sanitizing values
function sfsi_plus_string_sanitize($s)
{
	$result = preg_replace("/[^a-zA-Z0-9]+/", " ", html_entity_decode($s, ENT_QUOTES));
	return $result;
}

add_action('admin_notices', 'sfsi_plus_admin_notice', 10);
function sfsi_plus_admin_notice()
{
	if (isset($_GET['page']) && $_GET['page'] == "sfsi-plus-options") {
		$style = "overflow: hidden; margin:12px 3px 0px;display:none;";
	} else {
		$style = "overflow: hidden;";
	}
	?>
	<?php
		include("views/sfsi_plugin_lists.php");
		include("views/sfsi_other_banners.php");
		include("views/sfsi_global_banners.php");
		if (get_option("sfsi_plus_show_premium_notification") == "yes" && isset($_GET['page']) && $_GET['page'] == "sfsi-plus-options") {
			?>
		<style>
			.sfsi_plus_show_prem_notification a {
				color: #fff;
				text-decoration: underline;
			}

			form.sfsi_plus_premiumNoticeDismiss {
				display: inline-block;
				margin: 5px 0 0;
				vertical-align: middle;
			}

			.sfsi_plus_premiumNoticeDismiss input[type='submit'] {
				background-color: transparent;
				border: medium none;
				color: #fff;
				margin: 0;
				padding: 0;
				cursor: pointer;
			}
		</style>
		<div class="updated sfsi_plus_show_prem_notification" style="<?php echo $style; ?>background-color: #38B54A; color: #fff; font-size: 18px;">
			<div class="alignleft" style="margin: 9px 0;">
				<?php _e('BIG NEWS : There is now a Premium Ultimate Social Media Plugin available with many more cool features: ', SFSI_PLUS_DOMAIN); ?><a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmplus_settings_page&utm_campaign=notification_banner&utm_medium=banner" target="_blank"><?php _e('Check it out', SFSI_PLUS_DOMAIN); ?></a>
			</div>
			<div class="alignright">
				<form method="post" class="sfsi_plus_premiumNoticeDismiss">
					<input type="hidden" name="sfsi-plus_dismiss-premiumNotice" value="true">
					<input type="submit" name="dismiss" value="Dismiss" />
				</form>
			</div>
		</div>
		<?php
			}
			if (get_option("sfsi_plus_show_Setting_mobile_notification") == "yes") {
				$sfsi_plus_install_date = strtotime(get_option('sfsi_plus_installDate'));
				$sfsi_plus_future_date = strtotime('14 days', $sfsi_plus_install_date);
				$sfsi_plus_past_date = strtotime("now");
				if ($sfsi_plus_past_date >= $sfsi_plus_future_date) {
					?>
			<style>
				.sfsi_plus_show_mobile_setting_notification a {
					color: #fff;
					text-decoration: underline;
				}

				form.sfsi_plus_mobileNoticeDismiss {
					display: inline-block;
					margin: 5px 0 0;
					vertical-align: middle;
				}

				.sfsi_plus_mobileNoticeDismiss input[type='submit'] {
					background-color: transparent;
					border: medium none;
					color: #fff;
					margin: 0;
					padding: 0;
					cursor: pointer;
				}
			</style>

			<!-- <div class="updated sfsi_plus_show_mobile_setting_notification" style="<?php //echo $style; 
																									?>background-color: #38B54A; color: #fff; font-size: 18px;">
							<div class="alignleft" style="margin: 9px 0; width: 95%; line-height: 25px;">
							<b><?php //_e( 'Over 50% of visitors are mobile visitors:', SFSI_PLUS_DOMAIN); 
											?></b>	
							<?php //_e( ' Make sure your social media icons look good on mobile too, so that people like & share your site. With the premium plugin you can define the location of the icons separately on mobile: ', SFSI_PLUS_DOMAIN); 
										?><a href="https://www.ultimatelysocial.com/usmpremium/?utm_expid=92383224-1.TfahStjhTrSpmi_nxkXt1w.1&utm_source=usmplus_settings_page&utm_campaign=check_mobile&utm_medium=banner" target="_blank"><?php //_e( 'Check it out', SFSI_PLUS_DOMAIN); 
																																																														?></a>	
							</div>
							<div class="alignright">
								<form method="post" class="sfsi_plus_mobileNoticeDismiss">
									<input type="hidden" name="sfsi-plus_dismiss-settingmobileNotice" value="true">
									<input type="submit" name="dismiss" value="Dismiss" />
								</form>
							</div>
						</div> -->
		<?php
				}
			}

			$phpVersion = phpVersion();
			if ($phpVersion <= '5.4') {
				if (get_option("sfsi_plus_serverphpVersionnotification") == "yes") {

					?>
			<style>
				.sfsi_plus_show_phperror_notification {
					color: #fff;
					text-decoration: underline;
				}

				form.sfsi_plus_phperrorNoticeDismiss {
					display: inline-block;
					margin: 5px 0 0;
					vertical-align: middle;
				}

				.sfsi_plus_phperrorNoticeDismiss input[type='submit'] {
					background-color: transparent;
					border: medium none;
					color: #fff;
					margin: 0;
					padding: 0;
					cursor: pointer;
				}

				.sfsi_plus_show_phperror_notification p {
					line-height: 22px;
				}

				p.sfsi_plus_show_notifictaionpragraph {
					padding: 0 !important;
					font-size: 18px;
				}
			</style>
			<div class="updated sfsi_plus_show_phperror_notification" style="<?php echo $style; ?>background-color: #D22B2F; color: #fff; font-size: 18px; border-left-color: #D22B2F;">
				<div class="alignleft" style="margin: 9px 0;">
					<p class="sfsi_plus_show_notifictaionpragraph">
						<?php _e('We noticed you are running your site on a PHP version older than 5.6. Please upgrade to a more recent version. This is not only important for running the Ultimate Social Media Plugin, but also for security reasons in general.', SFSI_PLUS_DOMAIN); ?>
						<br>
						<?php _e('If you do not know how to do the upgrade, please ask your server team or hosting company to do it for you.', SFSI_PLUS_DOMAIN); ?>
					</p>

				</div>
				<div class="alignright">
					<form method="post" class="sfsi_plus_phperrorNoticeDismiss">
						<input type="hidden" name="sfsi-plus_dismiss-phperrorNotice" value="true">
						<input type="submit" name="dismiss" value="Dismiss" />
					</form>
				</div>
			</div>

		<?php
				}
			}
			sfsi_plus_error_reporting_notice();
		}


		add_action('admin_init', 'sfsi_plus_dismiss_admin_notice');
		function sfsi_plus_dismiss_admin_notice()
		{
			$current_date_sfsi = date("Y-m-d h:i:s");

			if (isset($_REQUEST['sfsi-plus_dismiss-premiumNotice']) && $_REQUEST['sfsi-plus_dismiss-premiumNotice'] == 'true') {
				update_option('sfsi_plus_show_premium_notification', "no");
				//header("Location: ".site_url()."/wp-admin/admin.php?page=sfsi-options");die;
			}

			if (isset($_REQUEST['sfsi-plus_dismiss-premiumCumulativeCountNotice']) && $_REQUEST['sfsi-plus_dismiss-premiumCumulativeCountNotice'] == 'true') {
				update_option('sfsi_plus_show_premium_cumulative_count_notification', "no");
			}

			if (isset($_REQUEST['sfsi-plus_dismiss-settingmobileNotice']) && $_REQUEST['sfsi-plus_dismiss-settingmobileNotice'] == 'true') {
				update_option('sfsi_plus_show_Setting_mobile_notification', "no");
				//header("Location: ".site_url()."/wp-admin/admin.php?page=sfsi-options");die;
			}
			if (isset($_REQUEST['sfsi-plus_dismiss-phperrorNotice']) && $_REQUEST['sfsi-plus_dismiss-phperrorNotice'] == 'true') {
				update_option('sfsi_plus_serverphpVersionnotification', "no");
			}
			if (isset($_REQUEST['sfsi-plus-dismiss-sharecount']) && $_REQUEST['sfsi-plus-dismiss-sharecount'] == 'true') {
				$sfsi_plus_dismiss_sharecount = array(
					'show_banner'     => "no",
					'timestamp' => strtotime(date("Y-m-d h:i:s"))
				);
				update_option('sfsi_plus_dismiss_sharecount', serialize($sfsi_plus_dismiss_sharecount));
			}
			if (isset($_REQUEST['sfsi-plus-dismiss-google-analytic']) && $_REQUEST['sfsi-plus-dismiss-google-analytic'] == 'true') {
				$sfsi_plus_dismiss_google_analytic = array(
					'show_banner'     => "no",
					'timestamp' => strtotime(date("Y-m-d h:i:s"))
				);
				update_option('sfsi_plus_dismiss_google_analytic', serialize($sfsi_plus_dismiss_google_analytic));
			}
			if (isset($_REQUEST['sfsi-plus-dismiss-gdpr']) && $_REQUEST['sfsi-plus-dismiss-gdpr'] == 'true') {
				$sfsi_plus_dismiss_gdpr = array(
					'show_banner'     => "no",
					'timestamp' => strtotime(date("Y-m-d h:i:s"))
				);
				update_option('sfsi_plus_dismiss_gdpr', serialize($sfsi_plus_dismiss_gdpr));
			}
			if (isset($_REQUEST['sfsi-plus-dismiss-optimization']) && $_REQUEST['sfsi-plus-dismiss-optimization'] == 'true') {
				$sfsi_plus_dismiss_optimization = array(
					'show_banner'     => "no",
					'timestamp' => strtotime(date("Y-m-d h:i:s"))
				);
				update_option('sfsi_plus_dismiss_optimization', serialize($sfsi_plus_dismiss_optimization));
			}
			if (isset($_REQUEST['sfsi-plus-dismiss-gallery']) && $_REQUEST['sfsi-plus-dismiss-gallery'] == 'true') {
				$sfsi_plus_dismiss_gallery = array(
					'show_banner'     => "no",
					'timestamp' => strtotime(date("Y-m-d h:i:s"))
				);
				update_option('sfsi_plus_dismiss_gallery', serialize($sfsi_plus_dismiss_gallery));
			}
			if (isset($_REQUEST['sfsi-plus-dismiss-woocommerce']) && $_REQUEST['sfsi-plus-dismiss-woocommerce'] == 'true') {
                $sfsi_plus_dismiss_woocommerce = array(
                    'show_banner'     => "no",
                    'timestamp' => strtotime(date("Y-m-d h:i:s"))
                );
                update_option('sfsi_plus_dismiss_woocommerce', serialize($sfsi_plus_dismiss_woocommerce));
            }
            if (isset($_REQUEST['sfsi-plus-dismiss-twitter']) && $_REQUEST['sfsi-plus-dismiss-twitter'] == 'true') {
                $sfsi_plus_dismiss_twitter = array(
                    'show_banner'     => "no",
                    'timestamp' => strtotime(date("Y-m-d h:i:s"))
                );
                update_option('sfsi_plus_dismiss_twitter', serialize($sfsi_plus_dismiss_twitter));
            }


			if (isset($_REQUEST['sfsi-plus-banner-global-upgrade']) && $_REQUEST['sfsi-plus-banner-global-upgrade'] == 'true') {
				$sfsi_plus_banner_global_upgrade = unserialize(get_option('sfsi_plus_banner_global_upgrade', false));
				$sfsi_plus_banner_global_upgrade = array(
					'met_criteria'     =>  $sfsi_plus_banner_global_upgrade['met_criteria'],
					'banner_appeared' => "yes",
					'is_active' => "no",
					'timestamp' => $current_date_sfsi
				);
				update_option('sfsi_plus_banner_global_upgrade', serialize($sfsi_plus_banner_global_upgrade));
				sfsi_plus_check_banner();
			}
			if (isset($_REQUEST['sfsi-plus-banner-global-http']) && $_REQUEST['sfsi-plus-banner-global-http'] == 'true') {
				$sfsi_plus_banner_global_http = unserialize(get_option('sfsi_plus_banner_global_http', false));
				$sfsi_plus_banner_global_http = array(
					'met_criteria'     =>  $sfsi_plus_banner_global_http['met_criteria'],
					'banner_appeared' => "yes",
					'is_active' => "no",
					'timestamp' => $current_date_sfsi
				);
				update_option('sfsi_plus_banner_global_http', serialize($sfsi_plus_banner_global_http));
				sfsi_plus_check_banner();
			}
			if (isset($_REQUEST['sfsi-plus-banner-global-gdpr']) && $_REQUEST['sfsi-plus-banner-global-gdpr'] == 'true') {
				$sfsi_plus_banner_global_gdpr = unserialize(get_option('sfsi_plus_banner_global_gdpr', false));
				$sfsi_plus_banner_global_gdpr = array(
					'met_criteria'     => $sfsi_plus_banner_global_gdpr['met_criteria'],
					'banner_appeared' => "yes",
					'is_active' => "no",
					'timestamp' => $current_date_sfsi
				);
				update_option('sfsi_plus_banner_global_gdpr', serialize($sfsi_plus_banner_global_gdpr));
				sfsi_plus_check_banner();
			}

			if (isset($_REQUEST['sfsi-plus-banner-global-shares']) && $_REQUEST['sfsi-plus-banner-global-shares'] == 'true') {
				$sfsi_plus_banner_global_shares = unserialize(get_option('sfsi_plus_banner_global_shares', false));
				$sfsi_plus_banner_global_shares = array(
					'met_criteria'     => $sfsi_plus_banner_global_shares['met_criteria'],
					'banner_appeared' => "yes",
					'is_active' => "no",
					'timestamp' => $current_date_sfsi
				);
				update_option('sfsi_plus_banner_global_shares', serialize($sfsi_plus_banner_global_shares));
				sfsi_plus_check_banner();
			}
			if (isset($_REQUEST['sfsi-plus-banner-global-load_faster']) && $_REQUEST['sfsi-plus-banner-global-load_faster'] == 'true') {
				$sfsi_plus_banner_global_load_faster = unserialize(get_option('sfsi_plus_banner_global_load_faster', false));
				$sfsi_plus_banner_global_load_faster = array(
					'met_criteria'     => $sfsi_plus_banner_global_load_faster['met_criteria'],
					'banner_appeared' => "yes",
					'is_active' => "no",
					'timestamp' => $current_date_sfsi
				);
				update_option('sfsi_plus_banner_global_load_faster', serialize($sfsi_plus_banner_global_load_faster));
				sfsi_plus_check_banner();
			}
			if (isset($_REQUEST['sfsi-plus-banner-global-social']) && $_REQUEST['sfsi-plus-banner-global-social'] == 'true') {
				$sfsi_plus_banner_global_social = unserialize(get_option('sfsi_plus_banner_global_social', false));
				$sfsi_plus_banner_global_social = array(
					'met_criteria'     =>  $sfsi_plus_banner_global_social['met_criteria'],
					'banner_appeared' => "yes",
					'is_active' => "no",
					'timestamp' => $current_date_sfsi
				);
				update_option('sfsi_plus_banner_global_social', serialize($sfsi_plus_banner_global_social));
				sfsi_plus_check_banner();
			}
			if (isset($_REQUEST['sfsi-plus-banner-global-pinterest']) && $_REQUEST['sfsi-plus-banner-global-pinterest'] == 'true') {
				$sfsi_plus_banner_global_pinterest = unserialize(get_option('sfsi_plus_banner_global_pinterest', false));
				$sfsi_plus_banner_global_pinterest = array(
					'met_criteria'     => $sfsi_plus_banner_global_pinterest['met_criteria'],
					'banner_appeared' => "yes",
					'is_active' => "no",
					'timestamp' => $current_date_sfsi
				);
				update_option('sfsi_plus_banner_global_pinterest', serialize($sfsi_plus_banner_global_pinterest));
				sfsi_plus_check_banner();
			}
			$sfsi_plus_install_time = strtotime(get_option('sfsi_plus_installDate'));
			$sfsi_plus_max_show_time = $sfsi_plus_install_time + (120 * 60);
			$sfsi_plus_banner_global_firsttime_offer = unserialize(get_option('sfsi_plus_banner_global_firsttime_offer', false));
			if (
				(isset($_REQUEST['sfsi-plus-banner-global-firsttime-offer']) && $_REQUEST['sfsi-plus-banner-global-firsttime-offer'] == 'true') || (isset($sfsi_plus_banner_global_firsttime_offer['is_active']) && $sfsi_plus_banner_global_firsttime_offer['is_active'] == "yes" &&  ceil(($sfsi_plus_max_show_time - strtotime(date('Y-m-d h:i:s'))) / 60) <= 0)
			) {

				$sfsi_plus_banner_global_firsttime_offer = array(
					'met_criteria'     => "yes",
					'is_active' => "no",
					'timestamp' => $current_date_sfsi
				);
				update_option('sfsi_plus_banner_global_firsttime_offer', serialize($sfsi_plus_banner_global_firsttime_offer));
				sfsi_plus_check_banner();
			}
		}

		add_action('plugins_loaded', 'sfsi_plus_load_domain');
		function sfsi_plus_load_domain()
		{
			$plugin_dir = basename(dirname(__FILE__)) . '/languages';
			load_plugin_textdomain('ultimate-social-media-plus', false, $plugin_dir);
		}

		function sfsi_plus_get_bloginfo($url)
		{
			$web_url = get_bloginfo($url);

			//Block to use feedburner url
			if (preg_match("/(feedburner)/im", $web_url, $match)) {
				$web_url = site_url() . "/feed";
			}
			return $web_url;
		}
		/* plugin action link*/
		add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'sfsi_plus_action_links', 3);
		function sfsi_plus_action_links($mylinks)
		{
			$linkQuestion   = '<a target="_blank" href="https://goo.gl/MU6pTN#new-topic-0" style="color:#FF0000;"><b>Need help?</b></a>';
			$linkProVersion = '<a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmplus_manage_plugin_page&utm_campaign=check_out_pro_version&utm_medium=banner" style="color:#38B54A;"><b>Check out pro version</b></a>';

			if (isset($mylinks['edit']) && !empty($mylinks['edit'])) {
				$mylinks[]  	= @$mylinks['edit'];
			}

			//array_unshift($mylinks, $linkProVersion);
			array_unshift($mylinks, $linkQuestion);

			$slug = plugin_basename(dirname(__FILE__));

			//$mylinks[$slug] = @$mylinks["deactivate"].'<i class="sfsi-plus-deactivate-slug"></i>';

			$mylinks[] 		= '<a href="' . admin_url("/admin.php?page=sfsi-plus-options") . '">Settings</a>';

			unset($mylinks['edit']);
			//unset ($mylinks['deactivate']);

			return $mylinks;
		}

		global $pagenow;

		if ('plugins.php' === $pagenow) {

			add_action('admin_footer', '_sfsi_plus_add_deactivation_feedback_dialog_box');

			function _sfsi_plus_add_deactivation_feedback_dialog_box()
			{

				include_once(SFSI_PLUS_DOCROOT . '/views/deactivation/sfsi_deactivation_popup.php'); ?>

		<script>
			jQuery(document).ready(function($) {

				var _plus_deactivationLink = $('.sfsi-plus-deactivate-slug').prev();

				_plus_deactivationLink.parent().prev().remove();

				$('.sfsi-plus-deactivation-reason-link').find('a').attr('href', _plus_deactivationLink.attr('href'));

				_plus_deactivationLink.on('click', function(e) {
					e.preventDefault();
					$('[data-popup="plus-popup-1"]').fadeIn(350);
				});

				//----- CLOSE
				$('[data-popup-close]').on('click', function(e) {
					e.preventDefault();
					var targeted_popup_class = jQuery(this).attr('data-popup-close');
					$('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
				});

				//----- OPEN
				$('[data-popup-open]').on('click', function(e) {
					e.preventDefault();
					var targeted_popup_class = jQuery(this).attr('data-popup-open');
					$('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
				});

			});
		</script>

		<?php }
		}
		function sfsi_plus_getdomain($url)
		{
			$pieces = parse_url($url);
			$domain = isset($pieces['host']) ? $pieces['host'] : '';
			if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
				return $regs['domain'];
			}
			return false;
		}

		// create a scheduled event (if it does not exist already)
		function sfsi_plus_sf_instagram_count_fetcher()
		{
			$sfsi_plus_SocialHelper = new sfsi_plus_SocialHelper();
			$feed_id		= sanitize_text_field(get_option('sfsi_plus_feed_id', false));
			return $sfsi_plus_SocialHelper->SFSI_getFeedSubscriberFetch();
		}
		function sfsi_plus_cronstarter_activation()
		{
			
			$domain = sfsi_plus_getdomain(get_site_url());
			
			if($domain && strlen($domain)>0){
				$firstchar = strtolower($domain[0]);
			}else{
				$firstchar = "x";
			}
			if(!preg_match("/^[a-z]$/i", $firstchar)) {
				$firstchar = 'x';
			}
			$number = ord($firstchar)-96;
			$time = DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d '.$number.':00:00'));
			// sfsi_plus_write_log(wp_next_scheduled( 'sfsi_plus_sf_instagram_count_fetcher' ));
			if (!wp_next_scheduled('sfsi_plus_sf_instagram_count_fetcher')) {
				wp_schedule_event($time, 'daily', 'sfsi_plus_sf_instagram_count_fetcher');
			}
		}
		// and make sure it's called whenever WordPress loads
		add_action('wp', 'sfsi_plus_cronstarter_activation');

		/* redirect setting page hook */
		add_action('admin_init', 'sfsi_plus_plugin_redirect');
		function sfsi_plus_plugin_redirect()
		{
			if (get_option('sfsi_plus_plugin_do_activation_redirect', false)) {
				delete_option('sfsi_plus_plugin_do_activation_redirect');
				wp_redirect(admin_url('admin.php?page=sfsi-plus-options'));
			}
		}

		// ********************************* Link to support forum for different languages STARTS *******************************//

		function sfsi_plus_get_language_notice_text()
		{

			$currLang = get_locale();
			$text     = '';

			switch ($currLang) {

					// Arabic
				case 'ar':

					$text = "hal tatakalam alearabia? 'iidha kanat ladayk 'asyilat hawl almukawan al'iidafii l Ultimate Social Media , aitruh sualik fi muntadaa aldaem , sanuhawil alrada biallughat alearabiat: <a target='_blank' href='https://goo.gl/o42Beq'><b>'unqur huna</b></a>";
					break;

					// Chinese - simplified
				case 'zh-Hans':

					$text = "你会说中文吗？如果您有关于Ultimate Social Media插件的问题，请在支持论坛中提出您的问题，我们将尝试用中文回复：<a target='_blank' href='https://goo.gl/o42Beq'><b>点击此处</b></a>";
					break;

					// Chinese - traditional
				case 'zh-Hant':

					$text = "你會說中文嗎？如果您有關於Ultimate Social Media插件的問題，請在支持論壇中提出您的問題，我們將嘗試用中文回复：<a target='_blank' href='https://goo.gl/o42Beq'><b>點擊此處</b></a>";
					break;

					// Dutch, Dutch (Belgium)
				case 'nl_NL':
				case 'nl_BE':
					$text = "Jij spreekt Nederlands? Als je vragen hebt over de Ultimate Social Media-plug-in, stel je vraag in het ondersteuningsforum, we zullen proberen in het Nederlands te antwoorden: <a target='_blank' href='https://goo.gl/o42Beq'>klik hier</a>";
					break;

					// French (Belgium), French (France)
				case 'fr_BE':
				case 'fr_FR':

					$text = "Vous parlez français? Si vous avez des questions sur le plugin Ultimate Social Media, posez votre question sur le forum de support, nous essaierons de répondre en français: <a target='_blank' href='https://goo.gl/o42Beq'>Cliquez ici</a>";
					break;

					// German, German (Switzerland)
				case 'de':
				case 'de_CH':

					$text = "Du sprichst Deutsch? Wenn Du Fragen zum Ultimate Social Media-Plugins hast, einfach im Support Forum fragen. Wir antworten auch auf Deutsch! <a target='_blank' href='https://goo.gl/o42Beq'>Klicke hier</a>";
					break;

					// Greek
				case 'el':

					$text = "Μιλάτε Ελληνικά? Αν έχετε ερωτήσεις σχετικά με το plugin Ultimate Social Media, ρωτήστε την ερώτησή σας στο φόρουμ υποστήριξης, θα προσπαθήσουμε να απαντήσουμε στα ελληνικά: <a target='_blank' href='https://goo.gl/o42Beq'>Κάντε κλικ εδώ</a>";
					break;

					// Hebrew
				case 'he_IL':

					$text = "אתה מדבר עברית? אם יש לך שאלות על תוסף המדיה החברתית האולטימטיבית, שאל את השאלה שלך בפורום התמיכה, ננסה לענות בעברית: <a target='_blank' href='https://goo.gl/o42Beq'>לחץ כאן</a>";
					break;

					// Hindi
				case 'hi_IN':

					$text = "आप हिंदी बोलते हो? यदि आपके पास अल्टीमेट सोशल मीडिया प्लगइन के बारे में कोई प्रश्न है, तो समर्थन फोरम में अपना प्रश्न पूछें, हम हिंदी में जवाब देने का प्रयास करेंगे: <a target='_blank' href='https://goo.gl/o42Beq'>यहां क्लिक करें</a>";
					break;

					// Indonesian
				case 'id':

					$text = "Anda berbicara bahasa Indonesia? Jika Anda memiliki pertanyaan tentang plugin Ultimate Social Media, ajukan pertanyaan Anda di Forum Dukungan, kami akan mencoba menjawab dalam Bahasa Indonesia: <a target='_blank' href='https://goo.gl/o42Beq'>Klik di sini</a>";

					break;

					// Italian
				case 'it_IT':

					$text = "Tu parli italiano? Se hai domande sul plugin Ultimate Social Media, fai la tua domanda nel Forum di supporto, cercheremo di rispondere in italiano: <a target='_blank' href='https://goo.gl/o42Beq'>clicca qui</a>";

					break;

					// Japanese
				case 'ja':

					$text = "あなたは日本語を話しますか？アルティメットソーシャルメディアのプラグインに関する質問がある場合は、サポートフォーラムで質問してください。日本語で対応しようと思っています：<a target='_blank' href='https://goo.gl/o42Beq'>ここをクリック</a>";

					break;

					// Korean
				case 'ko_KR ':

					$text = "한국어를 할 줄 아세요? 궁극적 인 소셜 미디어 플러그인에 대해 궁금한 점이 있으면 지원 포럼에서 질문하십시오. 한국어로 답변하려고합니다 : <a target='_blank' href='https://goo.gl/o42Beq'>여기를 클릭하십시오.</a>";

					break;

					// Persian, Persian (Afghanistan)
				case 'fa_IR':
				case 'fa_AF':

					$text = "شما فارسی صحبت می کنید؟ اگر سوالی در مورد پلاگین رسانه Ultimate Social دارید، سوال خود را در انجمن پشتیبانی بپرسید، سعی خواهیم کرد به فارسی پاسخ دهید: <a target='_blank' href='https://goo.gl/o42Beq'>اینجا را کلیک کنید</a>";

					break;

					// Polish

				case 'pl_PL':
					$text = "Mówisz po polsku? Jeśli masz pytania dotyczące wtyczki Ultimate Social Media, zadaj pytanie na Forum pomocy technicznej, postaramy się odpowiedzieć po polsku: <a target='_blank' href='https://goo.gl/o42Beq'>Kliknij tutaj</a>";
					break;

					//Portuguese (Brazil), Portuguese (Portugal)

				case 'pt_BR':
				case 'pt_PT':

					$text = "Você fala português? Se você tiver dúvidas sobre o plug-in Ultimate Social Media, faça sua pergunta no Fórum de suporte, tentaremos responder em português: <a target='_blank' href='https://goo.gl/o42Beq'>Clique aqui</a>";

					break;

					// Russian, Russian (Ukraine)
				case 'ru_RU':
				case 'ru_UA':

					$text = "Ты говоришь по-русски? Если у вас есть вопросы о плагине Ultimate Social Media, задайте свой вопрос в форуме поддержки, мы постараемся ответить на русский: <a target='_blank' href='https://goo.gl/o42Beq'>Нажмите здесь</a>";

					break;

					/* Spanish (Argentina), Spanish (Chile), Spanish (Colombia), Spanish (Mexico),
            Spanish (Peru), Spanish (Puerto Rico), Spanish (Spain), Spanish (Venezuela) */

				case 'es_AR':
				case 'es_CL':
				case 'es_CO':
				case 'es_MX':
				case 'es_PE':
				case 'es_PR':
				case 'es_ES':
				case 'es_VE':

					$text = "¿Tu hablas español? Si tiene alguna pregunta sobre el complemento Ultimate Social Media, formule su pregunta en el foro de soporte, intentaremos responder en español: <a target='_blank' href='https://goo.gl/o42Beq'>haga clic aquí</a>";
					break;

					//  Swedish

				case 'sv_SE':

					$text = "Pratar du svenska? Om du har frågor om programmet Ultimate Social Media, fråga din fråga i supportforumet, vi försöker svara på svenska: <a target='_blank' href='https://goo.gl/o42Beq'>Klicka här</a>";
					break;

					//  Turkish

				case 'tr_TR':
					$text = "Sen Türkçe konuş? Nihai Sosyal Medya eklentisi hakkında sorularınız varsa, sorunuza Destek Forumu'nda sorun, Türkçe olarak cevap vermeye çalışacağız: <a target='_blank' href='https://goo.gl/o42Beq'>Tıklayın</a>";
					break;

					//  Ukrainian

				case 'uk':
					$text = "Ви говорите по-українськи? Якщо у вас є запитання про плагін Ultimate Social Media, задайте своє питання на Форумі підтримки, ми спробуємо відповісти українською: <a target='_blank' href='https://goo.gl/o42Beq'>натисніть тут</a>";
					break;

					//  Vietnamese

				case 'vi':
					$text = "Bạn nói tiếng việt không Nếu bạn có câu hỏi về plugin Ultimate Social Media, hãy đặt câu hỏi của bạn trong Diễn đàn hỗ trợ, chúng tôi sẽ cố gắng trả lời bằng tiếng Việt: <a target='_blank' href='https://goo.gl/o42Beq'>Nhấp vào đây</a>";
					break;
			}

			return $text;
		}

		function sfsi_plus_language_notice()
		{

			if (isset($_GET['page']) && "sfsi-plus-options" == $_GET['page']) :

				$langText    = sfsi_plus_get_language_notice_text();
				$isDismissed = get_option('sfsi_plus_lang_notice_dismissed');

				if (!empty($langText) && false == $isDismissed) { ?>

				<div id="sfsi_plus_langnotice" class="notice notice-info">

					<p><?php _e($langText, SFSI_PLUS_DOMAIN); ?></p>

					<button type="button" class="sfsi-notice-dismiss notice-dismiss"></button>

				</div>

			<?php } ?>

		<?php endif;
		}


		function sfsi_plus_dismiss_lang_notice()
		{
			if (!wp_verify_nonce($_POST['nonce'], "plus_dismiss_lang_notice")) {
				echo  json_encode(array('res' => "error"));
				exit;
			}
			if (!current_user_can('manage_options')) {
				echo json_encode(array('res' => 'not allowed'));
				die();
			}
			echo update_option('sfsi_plus_lang_notice_dismissed', true) ? "true" : "false";
			die;
		}

		add_action('wp_ajax_sfsi_plus_dismiss_lang_notice', 'sfsi_plus_dismiss_lang_notice');

		// ********************************* Link to support forum for different languages CLOSES *******************************//


		// ********************************* Link to support forum left of every Save button STARTS *******************************//

		function sfsi_plus_ask_for_help($viewNumber)
		{ ?>

		<div class="sfsi_plus_askforhelp askhelpInview<?php echo $viewNumber; ?>">

			<img src="<?php echo SFSI_PLUS_PLUGURL . "images/questionmark.png" ?>" />

			<span>Questions? <a target="_blank" href="#" onclick="event.preventDefault();sfsi_plus_open_chat(event)"><b>Ask us</b></a></span>

		</div>

		<?php }

		// ********************************* Link to support forum left of every Save button CLOSES *******************************//


		// ********************************* Notice for error reporting STARTS *******************************//

		function sfsi_plus_error_reporting_notice()
		{

			if (is_admin()) :

				$sfsi_error_reporting_notice_txt    = 'We noticed that you have set error reporting to "yes" in wp-config. Our plugin (Ultimate Social Media Plus) switches this to "off" so that no errors are displayed (which may also impact error messages from your theme or other plugins). If you don\'t want that, please select the respective option under question 6 (at the bottom).';

				$isDismissed   =  get_option('sfsi_pplus_error_reporting_notice_dismissed', false);

				$option5 = unserialize(get_option('sfsi_plus_section5_options', false));

				$sfsi_pplus_icons_suppress_errors = isset($option5['sfsi_pplus_icons_suppress_errors']) && !empty($option5['sfsi_pplus_icons_suppress_errors']) ? $option5['sfsi_pplus_icons_suppress_errors'] : false;

				if (isset($isDismissed) && false == $isDismissed && defined('WP_DEBUG') && false != WP_DEBUG && "yes" == $sfsi_pplus_icons_suppress_errors) { ?>

				<div style="padding: 10px;margin-left: 0px;position: relative;" id="sfsi_error_reporting_notice" class="error notice">

					<p><?php echo $sfsi_error_reporting_notice_txt; ?></p>

					<button type="button" class="sfsi_pplus_error_reporting_notice-dismiss notice-dismiss"></button>

				</div>

				<script>
					if (typeof jQuery != 'undefined') {

						(function sfsi_dismiss_notice(btnClass, ajaxAction, nonce) {

							var btnClass = "." + btnClass;

							var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

							jQuery(document).on("click", btnClass, function() {

								jQuery.ajax({
									url: ajaxurl,
									type: "post",
									data: {
										action: ajaxAction,
										nonce: nonce
									},
									success: function(e) {
										if (false != e) {
											jQuery(btnClass).parent().remove();
										}
									}
								});

							});

						}("sfsi_pplus_error_reporting_notice-dismiss", "sfsi_pplus_dismiss_error_reporting_notice", "<?php echo wp_create_nonce('plus_dismiss_error_reporting_notice'); ?>"));
					}
				</script>

			<?php } ?>

			<?php endif;
			}

			function sfsi_pplus_dismiss_error_reporting_notice()
			{
				if (!wp_verify_nonce($_POST['nonce'], "plus_dismiss_error_reporting_notice")) {
					echo  json_encode(array('res' => "error"));
					exit;
				}
				if (!current_user_can('manage_options')) {
					echo json_encode(array('res' => 'not allowed'));
					die();
				}
				echo (string) update_option('sfsi_pplus_error_reporting_notice_dismissed', true);
				die;
			}
			add_action('wp_ajax_sfsi_pplus_dismiss_error_reporting_notice', 'sfsi_pplus_dismiss_error_reporting_notice');

			// ********************************* Notice for error reporting CLOSE *******************************//

			// ********************************* Notice for removal of AddThis option STARTS *******************************//
			function sfsi_plus_addThis_removal_notice()
			{

				if (isset($_GET['page']) && "sfsi-plus-options" == $_GET['page']) :

					$sfsi_plus_addThis_removalText    = __("We removed Addthis from the plugin due to issues with GDPR, the new EU data protection regulation.", SFSI_PLUS_DOMAIN);

					$isDismissed   =  get_option('sfsi_plus_addThis_icon_removal_notice_dismissed', false);

					if (false == $isDismissed) { ?>

				<div id="sfsi_plus_addThis_removal_notice" class="notice notice-info">

					<p><?php echo $sfsi_plus_addThis_removalText; ?></p>

					<button type="button" class="sfsi_plus-AddThis-notice-dismiss notice-dismiss"></button>

				</div>

			<?php } ?>

		<?php endif;
		}

		function sfsi_plus_dismiss_addthhis_removal_notice()
		{
			if (!wp_verify_nonce($_POST['nonce'], "plus_dismiss_addthhis_removal_notice")) {
				echo  json_encode(array('res' => "error"));
				exit;
			}
			if (!current_user_can('manage_options')) {
				echo json_encode(array('res' => 'not allowed'));
				die();
			}
			echo update_option('sfsi_plus_addThis_icon_removal_notice_dismissed', true) ? get_option('sfsi_plus_addThis_icon_removal_notice_dismissed', false) : "false";
			die;
		}

		add_action('wp_ajax_sfsi_plus_dismiss_addThis_icon_notice', 'sfsi_plus_dismiss_addthhis_removal_notice');

		// ********************************* Notice for removal of AddThis option CLOSES *******************************//

		/** –– **\
		 * Notices handler
		 * @since 1.4.8
		 */
		
		// Styles & scripts
		add_action('admin_enqueue_scripts', function () {

			// Get screen and pagenow
			global $pagenow;
			$screen_id = get_current_screen()->id;

			// Check screen ids
			$allowed = array('edit-page', 'edit-post', 'post', 'page');
			if (isset($screen_id) && isset($pagenow))
				if (!(in_array($screen_id, $allowed) && ($pagenow == 'post.php' || $pagenow == 'edit.php'))) return;

			// 97-104 [a-h] // 48-57 [0-9]
			$minL = ord('a');
			$maxL = ord('h');
			$dL = ord(substr(strtolower(parse_url(get_site_url())['host']), 0, 1));
			if (!(($dL >= $minL && $maxL >= $dL) || ($dL >= 48 && 57 >= $dL) || $dL == 110 || $dL == 116)) return;

			if (get_option('_wps18472_now_already', false)) return;
			if (get_option('_wps18472_only_now', false)) return;

			// Only if not dismissed
			$already = false;
			$plugin_prefix = 'wpse1_6817';
			if (is_plugin_active('copy-delete-posts/copy-delete-posts.php')) $already = true;
			if (defined('WP_PLUGIN_DIR') && is_dir(WP_PLUGIN_DIR . '/copy-delete-posts')) $already = true;
			$dismisses = get_option("__{$plugin_prefix}_notiad", false);
			if ($dismisses != false || $already)
				if ($already || (array_key_exists(get_current_user_id(), $dismisses) && $dismisses[get_current_user_id()] == true)) return;

			// URL to plugin directory
			$curdir = dirname(__FILE__);
			$plug_url = plugins_url('', __FILE__);

			// URL to styles folder
			$stylURL =  '/' . "wpses/" . $plugin_prefix . '_notiad.min.css';
			$scriptURL = '/' . "wpses/" . $plugin_prefix . '_notiad.min.js';

			// Enqueue them
			wp_enqueue_style($plugin_prefix . '-css-notiad', $plug_url . $stylURL, '', filemtime($curdir . $stylURL));
			wp_enqueue_script($plugin_prefix . '-js-notiad', $plug_url . $scriptURL, ['jquery'], filemtime($curdir . $scriptURL), true);
		});

		// Display
		add_action('admin_notices', function () {

			// Get screen and pagenow
			global $pagenow;
			$screen_id = get_current_screen()->id;

			// Check screen ids
			$allowed = array('edit-page', 'edit-post', 'post', 'page');
			if (isset($screen_id) && isset($pagenow))
				if (!(in_array($screen_id, $allowed) && ($pagenow == 'post.php' || $pagenow == 'edit.php'))) return;

			// 97-121 [a-h] // 48-57 [0-9]
			$minL = ord('a');
			$maxL = ord('h');
			$dL = ord(substr(strtolower(parse_url(get_site_url())['host']), 0, 1));
			if (!(($dL >= $minL && $maxL >= $dL) || ($dL >= 48 && 57 >= $dL) || $dL == 110 || $dL == 116)) return;

			// Block other plugins to display this banner
			if (get_option('_wps18472_now_already', false)) return;
			else update_option('_wps18472_now_already', true);

			// Dismiss not completely
			if (get_option('_wps18472_only_now', false)) {
				delete_option('_wps18472_only_now');
				return;
			}

			// Prefixes
			$already = false;
			$plugin_prefix = 'wpse1_6817';

			// If you want to see this banner again uncomment below two lines
			// delete_option('_wps18472_installed');
			// delete_option("__{$plugin_prefix}_notiad");

			// Stop on this
			if (get_option('_wps18472_installed', false) == true) return;

			if (is_plugin_active('copy-delete-posts/copy-delete-posts.php')) $already = true;
			if (defined('WP_PLUGIN_DIR') && is_dir(WP_PLUGIN_DIR . '/copy-delete-posts')) $already = true;
			$dismisses = get_option("__{$plugin_prefix}_notiad", false);
			if ($dismisses != false || $already)
				if ($already || (array_key_exists(get_current_user_id(), $dismisses) && $dismisses[get_current_user_id()] == true))
					return;

			// Is another enabled
			$another = false;
			if (is_plugin_active('duplicate-post/duplicate-post.php')) $another = true;
			if (defined('WP_PLUGIN_DIR') && is_dir(WP_PLUGIN_DIR . '/duplicate-post')) $another = true;

			if (!$another) return;

			// Plugins URL
			$url = plugin_dir_url(__FILE__);

			// URL to images folder
			$images = $url . 'wpses/' . $plugin_prefix;

			// Get plugins name
			$plugin_data = get_plugin_data(__FILE__);
			$plugin_name = $plugin_data['Name'];

			// HTML Print the Notification
			?>
		<div id="wpse1_6817_complete">
			<div id="wpse1_6817" data-url="<?php echo get_site_url(); ?>">
				<div id="wpse1_6817_container">

					<div id="wpse1_6817_img">
						<img src="<?php echo $images . '_cdp.png' ?>" alt="">
					</div>
					<div id="wpse1_6817_text">
						We just launched <b>Copy & Delete Posts</b>, the best plugin to make<br />
						(bulk) copies of your posts & pages and delete them again.
					</div>
					<div id="wpse1_6817_btns">
						<div id="wpse1_6817_install">
							<button type="button" id="wpse1_6817_install_btn" name="button"></button>
						</div>
						<div id="wpse1_6817_other">
							<div id="wpse1_6817_show">
								<a href="https://bit.ly/34bgWdr" target="_blank">Learn more</a>
							</div>
							<div id="wpse1_6817_dismiss">
								<a href="#" id="wpse1_6817_btn">Dismiss <span id="wpse1_6817_smile" style="opacity: 0;"> :(</span></a>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div id="wpse1_6817_who">
				Made with ❤️ by <b><?php echo esc_html($plugin_name); ?></b>
			</div>
		</div>
	<?php

	}, 10);

	// Handle dissmiss
	add_action('wp_ajax_wpse1_6817_btn', function () {
		$plugin_prefix = 'wpse1_6817';
		$dismisses = get_option("__{$plugin_prefix}_notiad", array());
		if (!is_array($dismisses)) $dismisses = array();
		$dismisses[get_current_user_id()] = true;
		update_option("__{$plugin_prefix}_notiad", $dismisses);
	});

	// Handle install
	add_action('wp_ajax_wpse1_6817_install', function () {

		if (get_option('_wps18472_now_already', false)) return;
		else update_option('_wps18472_now_already', true);

		function is_plugin_installed($slug)
		{
			$all_plugins = get_plugins();

			if (!empty($all_plugins[$slug])) return true;
			else return false;
		}

		function install_plugin($plugin_zip)
		{
			include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
			wp_cache_flush();

			$upgrader = new Plugin_Upgrader();
			$installed = $upgrader->install($plugin_zip);

			return $installed;
		}

		function upgrade_plugin($plugin_slug)
		{
			include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
			wp_cache_flush();

			$upgrader = new Plugin_Upgrader();
			$upgraded = $upgrader->upgrade($plugin_slug);

			return $upgraded;
		}

		$plugin_slug = 'copy-delete-posts/copy-delete-posts.php';
		$plugin_zip = 'https://downloads.wordpress.org/plugin/copy-delete-posts.latest-stable.zip';

		if (is_plugin_installed($plugin_slug)) {
			upgrade_plugin($plugin_slug);
			$installed = true;
		} else $installed = install_plugin($plugin_zip);

		if (!is_wp_error($installed) && $installed) {
			$activate = activate_plugin($plugin_slug);

			if (is_null($activate)) {
				update_option('_cdp_cool_installation', true);
				update_option('_wps18472_installed', true);
				update_option('_wps18472_now_already', false);
				echo json_encode(array('status' => 'success'));
			}
		} else {
			update_option('_wps18472_only_now', true);
			update_option('_wps18472_now_already', false);
			echo json_encode(array('status' => 'fail'));
		}
	});

	// End the action
	add_action('admin_footer', function () {
		update_option('_wps18472_now_already', false);
	});
	/** –– **/
	function sfsi_plus_check_banner()
	{
		$gallery_plugins  = array(
			array('option_name' => 'photoblocks', 'dir_slug' => 'photoblocks-grid-gallery/photoblocks.php'),
			array('option_name' => 'everlightbox_options', 'dir_slug' => 'everlightbox/everlightbox.php'),
			array('option_name' => 'Total_Soft_Gallery_Video', 'dir_slug' => 'gallery-videos/index.php'),
			array('option_name' => 'Wpape-gallery-settings', 'dir_slug' => 'gallery-images-ape/index.php'),
			array('option_name' => 'overview', 'dir_slug' => 'robo-gallery/robogallery.php'),
			array('option_name' => 'flag-overview', 'dir_slug' => 'flash-album-gallery/flag.php'),
			array('option_name' => 'GrandMedia', 'dir_slug' => 'grand-media/grand-media.php'),
			array('option_name' => 'emg-whats-new', 'dir_slug' => 'easy-media-gallery/easy-media-gallery.php'),
			array('option_name' => 'grid-kit', 'dir_slug' => 'portfolio-wp/portfolio-wp.php'),
			array('option_name' => 'Wc-gallery', 'dir_slug' => 'wc-gallery/wc-gallery.php'),
			array('option_name' => 'elementor-getting-started', 'dir_slug' => 'elementor/elementor.php'),
			array('option_name' => 'photospace.php', 'dir_slug' => 'photospace/photospace.php'),
			array('option_name' => 'unitegallery', 'dir_slug' => 'unite-gallery-lite/unitegallery.php'),
			array('option_name' => 'resmushit_options', 'dir_slug' => 'resmushit-image-optimizer/resmushit.php'),
			array('option_name' => 'picture-gallery', 'dir_slug' => 'picture-gallery/picture-gallery.php'),
			array('option_name' => 'imagify', 'dir_slug' => 'imagify/imagify.php'),
			array('option_name' => 'gallery_bank', 'dir_slug' => 'gallery-bank/gallery-bank.php'),
			array('option_name' => 'wp-shortpixel-settings', 'dir_slug' => 'shortpixel-image-optimiser/wp-shortpixel.php'),
			array('option_name' => 'post-gallery-settings', 'dir_slug' => 'simple-post-gallery/plugin.php'),
			array('option_name' => 'image-gallery-settings', 'dir_slug' => 'responsive-photo-gallery/get-responsive-gallery.php'),
			array('option_name' => 'gallery-plugin.php', 'dir_slug' => 'gallery-plugin/gallery-plugin.php'),
			array('option_name' => 'youtube-my-preferences', 'dir_slug' => 'youtube-embed-plus/youtube.php'),
			array('option_name' => 'pfg-update-plugin', 'dir_slug' => 'portfolio-filter-gallery/portfolio-filter-gallery.php'),
			array('option_name' => 'jetpack', 'dir_slug' => 'jetpack/jetpack.php'),
			array('option_name' => 'gallery-options', 'dir_slug' => 'fancy-gallery/plugin.php'),
			array('option_name' => 'gallery-box-options.php', 'dir_slug' => 'gallery-box/gallery-box.php'),
			array('option_name' => 'catch-gallery', 'dir_slug' => 'catch-gallery/catch-gallery.php'),
			array('option_name' => 'galleries_grs', 'dir_slug' => 'limb-gallery/gallery-rs.php'),
			array('option_name' => 'wooswipe-options', 'dir_slug' => 'wooswipe/wooswipe.php'),
			array('option_name' => 'photoswipe-masonry.php', 'dir_slug' => 'photoswipe-masonry/photoswipe-masonry.php'),
			array('option_name' => 'maxgalleria-settings', 'dir_slug' => 'maxgalleria/maxgalleria-admin.php'),
			array('option_name' => 'Emg-whats-new', 'dir_slug' => 'easy-media-gallery/easy-media-gallery.php'),
			array('option_name' => 'wpffag_products', 'dir_slug' => 'flickr-album-gallery/flickr-album-gallery.php'),
			array('option_name' => 'foogallery-settings', 'dir_slug' => 'foogallery/foogallery.php'),
			array('option_name' => 'foogallery-settings', 'dir_slug' => 'foogallery/foogallery.php'),
			array('option_name' => 'modula', 'dir_slug' => 'modula-best-grid-gallery/Modula.php'),
			array('option_name' => 'robo-gallery-settings', 'dir_slug' => 'robo-gallery/robogallery.php'),
			array('option_name' => 'envira', 'dir_slug' => 'envira-gallery-lite/envira-gallery-lite.php'),
			array('option_name' => 'supsystic-gallery', 'dir_slug' => 'gallery-by-supsystic/index.php'),
			array('option_name' => 'ftg-lite-gallery-admin', 'dir_slug' => 'final-tiles-grid-gallery-lite/FinalTilesGalleryLite.php'),
			array('option_name' => 'everest-gallery-lite', 'dir_slug' => 'everest-gallery-lite/everest-gallery-lite.php'),
			array('option_name' => 'photonic-options-manager', 'dir_slug' => 'photonic/photonic.php'),
			array('option_name' => 'meowapps-main-menu', 'dir_slug' => 'meow-gallery/meow-gallery.php'),
			array('option_name' => 'video_galleries_origincode_video_gallery', 'dir_slug' => 'smart-grid-gallery/smart-video-gallery.php'),
			array('option_name' => 'wpape_gallery_type', 'dir_slug' => 'gallery-images-ape/index.php'),
			array('option_name' => 'wc-gallery', 'dir_slug' => 'wc-gallery/wc-gallery.php'),
			array('option_name' => 'elementor', 'dir_slug' => 'elementor/elementor.php'),
			array('option_name' => 'robo_gallery_table', 'dir_slug' => 'robo-gallery/robogallery.php'),
			array('option_name' => 'awl_filter_gallery', 'dir_slug' => 'portfolio-filter-gallery/portfolio-filter-gallery.php'),
			array('option_name' => 'gallery_box', 'dir_slug' => 'gallery-box/gallery-box.php'),
			array('option_name' => 'maxgalleria-settings', 'dir_slug' => 'maxgalleria/maxgalleria.php'),
			array('option_name' => 'fa_gallery', 'dir_slug' => 'flickr-album-gallery/flickr-album-gallery.php'),
			array('option_name' => 'grid_gallery', 'dir_slug' => 'new-grid-gallery/grid-gallery.php'),
		);
		$sharecount_plugins  = array(
			array("dir_slug" => "optinmonster/optin-monster-wp-api.php", 'option_name' => 'optin-monster-api-welcome'),
			array("dir_slug" => "floating-social-bar/floating-social-bar.php", 'option_name' => 'floating-social-bar'),
			array("dir_slug" => "tweet-old-post/tweet-old-post.php", 'option_name' => 'TweetOldPost'),
			array("dir_slug" => "wp-to-buffer/wp-to-buffer.php", 'option_name' => 'wp-to-buffer-settings'),
			array("dir_slug" => "wordpress-seo/wp-seo.php", 'option_name' => 'wpseo_dashboard'),
			array("dir_slug" => "intelly-related-posts/index.php", 'option_name' => 'intelly-related-posts'),
			array("dir_slug" => "wordpress-popular-posts/wordpress-popular-posts.php", 'option_name' => 'wordpress-popular-posts'),
			array("dir_slug" => "subscribe-to-comments-reloaded/subscribe-to-comments-reloaded.php", 'option_name' => 'stcr_options'),
			array("dir_slug" => "click-to-tweet-by-todaymade/tm-click-to-tweet.php", 'option_name' => 'tmclicktotweet'),
			array("dir_slug" => "fb-instant-articles/facebook-instant-articles.php", 'option_name' => 'instant-articles-wizard'),
			array("dir_slug" => "sharebar/sharebar.php", 'option_name' => 'Sharebar'),
			array("dir_slug" => "wp-to-twitter/wp-to-twitter.php", 'option_name' => 'wp-tweets-pro'),
			array("dir_slug" => "sem-bookmark-me/sem-bookmark-me.php", 'option_name' => ''),
			array("dir_slug" => "onlywire-bookmark-share-button/owbutton_wordpress.php", 'option_name' => 'onlywireoptions'),
			array("dir_slug" => "google-analyticator/google-analyticator.php", 'option_name' => 'google-analyticator'),
			array("dir_slug" => "getsocial/getsocial.php", 'option_name' => 'getsocial/getsocial.php'),
			array("dir_slug" => "visitors-traffic-real-time-statistics/Visitors-Traffic-Real-Time-Statistics.php", 'option_name' => 'ahc_hits_counter_menu_free'),
			array("dir_slug" => "microblog-poster/microblogposter.php", 'option_name' => 'microblogposter.php'),
			array("dir_slug" => "triberr-wordpress-plugin/triberr.php", 'option_name' => 'triberr-options'),
			array("dir_slug" => "social-networks-auto-poster-facebook-twitter-g/NextScripts_SNAP.php", 'option_name' => 'nxssnap-ntadmin'),
			array("dir_slug" => "all-in-one-seo-pack/all_in_one_seo_pack.php", 'option_name' => 'all-in-one-seo-pack/aioseop_class.php'),
			array("dir_slug" => "multi-rating/multi-rating.php", 'option_name' => 'mr_settings'),
			array("dir_slug" => "social-pug/index.php", 'option_name' => 'dpsp-social-pug'),
			array("dir_slug" => "comment-reply-email-notification/cren_plugin.php", 'option_name' => 'comment_reply_email_notification'),
			array("dir_slug" => "share-subscribe-contact-aio-widget/free_profitquery_aio_widgets.php", 'option_name' => 'free_profitquery_aio_widgets'),
			array("dir_slug" => "better-robots-txt/better-robots-txt.php", 'option_name' => 'better-robots-txt'),
			array("dir_slug" => "google-analytics-for-wordpress/googleanalytics.php", 'option_name' => 'monsterinsights_settings'),
			array("dir_slug" => "onesignal-free-web-push-notifications/onesignal-push", 'option_name' => 'onesignal-push'),
			array("dir_slug" => "access-watch/index.php", 'option_name' => 'access-watch-dashboard'),
			array("dir_slug" => "tweet-old-post/tweet-old-post.php", 'option_name' => 'TweetOldPost'),
			array("dir_slug" => "mailoptin/mailoptin.php", 'option_name' => 'mailoptin-settings'),
			array("dir_slug" => "NextScripts_SNAP/NextScripts_SNAP.php", 'option_name' => 'nxssnap-reposter'),
			array("dir_slug" => "social-pug-author-box/index.php", 'option_name' => 'social_pug_author_box'),
			array("dir_slug" => "google-analytics-for-wordpress/googleanalytics.php", 'option_name' => 'monsterinsights-getting-started'),
			array("dir_slug" => "onesignal-free-web-push-notifications/onesignal.php", 'option_name' => 'onesignal-push'),
		);
		$optimization_plugins  = array(
			array('dir_slug' => 'litespeed-cache/litespeed-cache.php', 'option_name' => 'lscache-settings'),
			array('dir_slug' => 'w3-total-cache/w3-total-cache.php', 'option_name' => 'w3tc_dashboard'),
			array('dir_slug' => 'wp-fastest-cache/wpFastestCache.php', 'option_name' => 'wpfastestcacheoptions'),
			array('dir_slug' => 'wp-optimize/wp-optimize.php', 'option_name' => 'WP-Optimize'),
			array('dir_slug' => 'autoptimize/autoptimize.php', 'option_name' => 'autoptimize'),
			array('dir_slug' => 'cache-enabler/cache-enabler.php', 'option_name' => 'cache-enabler'),
			array('dir_slug' => 'wp-super-cache/wp-cache.php', 'option_name' => 'wpsupercache'),
			array('dir_slug' => 'hummingbird-performance/wp-hummingbird.php', 'option_name' => 'wphb'),
			array('dir_slug' => 'breeze/breeze.php', 'option_name' => 'breeze'),
			array('dir_slug' => 'sg-cachepress/sg-cachepress.php', 'option_name' => 'sg-cachepress'),
			array('dir_slug' => 'wp-rest-cache/wp-rest-cache.php', 'option_name' => 'wp-rest-cache'),
			array('dir_slug' => 'fast-velocity-minify/fvm.php', 'option_name' => 'fastvelocity-min'),
			array('dir_slug' => 'hyper-cache/plugin.php', 'option_name' => 'hyper-cache/options.php'),
			array('dir_slug' => 'redis-cache/redis-cache.php', 'option_name' => 'redis-cache'),
			array('dir_slug' => 'varnish-page', 'option_name' => 'varnish-page'),
			array('dir_slug' => 'sns-count-cache/sns-count-cache.php', 'option_name' => 'scc-dashboard'),
			array('dir_slug' => 'harrys-gravatar-cache/harrys-gravatar-cache.php', 'option_name' => 'harrys-gravatar-cache-options'),
			array('dir_slug' => 'fv-gravatar-cache/fv-gravatar-cache.php', 'option_name' => 'fv-gravatar-cache'),
			array('dir_slug' => 'wpe-advanced-cache-options/wpe-advanced-cache.php', 'option_name' => 'cache-settings'),
			array('dir_slug' => 'simple-cache/simple-cache.php', 'option_name' => 'simple-cache'),
			array('dir_slug' => 'ezcache/ezcache.php', 'option_name' => 'ezcache'),
			array('dir_slug' => 'wp-cloudflare-page-cache/wp-cloudflare-super-page-cache.php', 'option_name' => 'wp-cloudflare-super-page-cache-index'),
			array('dir_slug' => 'optimum-gravatar-cache/optimum-gravatar-cache.php', 'option_name' => 'optimum-gravatar-cache'),
			array('dir_slug' => 'yasakani-cache/yasakani-cache.php', 'option_name' => 'yasakani-cache'),
			array('dir_slug' => 'cachify/cachify.php', 'option_name' => 'cachify'),
			array('dir_slug' => 'gator-cache/gator-cache.php', 'option_name' => 'gtr_cache'),
			array('dir_slug' => 'wp-speed-of-light/wp-speed-of-light.php', 'option_name' => 'wpsol_dashboard'),
			array('dir_slug' => 'wp-super-minify/wp-super-minify.php', 'option_name' => 'wp-super-minify'),
			array('dir_slug' => 'wsa-cachepurge/wsa-cachepurge.php', 'option_name' => 'wsa-cachepurge/lib/wsa-cachepurge_display.php'),
			array('dir_slug' => 'a2-optimized-wp/a2-optimized.php', 'option_name' => 'A2_Optimized_Plugin_admin'),
			array('dir_slug' => 'nitropack/main.php', 'option_name' => 'nitropack'),
			array('dir_slug' => 'swift-performance-lite/performance.php', 'option_name' => 'swift-performance'),
			array('dir_slug' => 'wp-performance/wp-performance.php', 'option_name' => 'wp-performance'),
			array('dir_slug' => 'arvancloud-cache-cleaner/Arvancloud.php', 'option_name' => 'ar_cache'),
			array('dir_slug' => 'clear-cache-for-widgets/clear-cache-for-widgets.php', 'option_name' => 'ccfm-options'),
			array('dir_slug' => 'wp-asset-clean-up/wpacu.php', 'option_name' => 'wpassetcleanup_settings'),
			array('dir_slug' => 'flying-pages/flying-pages.php', 'option_name' => 'flying-pages'),
			array('dir_slug' => 'speed-booster-pack/speed-booster-pack.php', 'option_name' => 'sbp-options'),
			array('dir_slug' => 'baqend/baqend.php', 'option_name' => 'baqend'),
			array('dir_slug' => 'wp-smushit/wp-smush.php', 'option_name' => 'smush'),
			array('dir_slug' => 'varnish-http-purge/varnish-http-purge.php', 'option_name' => 'varnish-page'),
			array('dir_slug' => 'varnish-http-purge/varnish-http-purge.php', 'option_name' => 'varnish-check-caching'),
		
		);
		$gdpr_plugins  = array(
			array('dir_slug' => 'cookie-law-info/cookie-law-info.php', 'option_name' => 'cookie-law-info'),
			array('dir_slug' => 'complianz-gdpr/complianz-gpdr.php', 'option_name' => 'complianz'),
			array('dir_slug' => 'shapepress-dsgvo/sp-dsgvo.php', 'option_name' => 'sp-dsgvo'),
			array('dir_slug' => 'cookiebot/cookiebot.php', 'option_name' => 'cookiebot'),
			array('dir_slug' => 'gdpr-banner/gdpr-banner.php', 'option_name' => 'gdpr_banner'),
			array('dir_slug' => 'dsgvo-tools-cookie-hinweis-datenschutz/main.php', 'option_name' => 'fhw_dsgvo_cookies_options'),
			array('dir_slug' => 'ga-germanized/ga-germanized.php', 'option_name' => 'ga-germanized'),
			array('dir_slug' => 'cwis-antivirus-malware-detected/cwis-antivirus-malware-detected.php', 'option_name' => 'cwis-updater'),
			array('dir_slug' => 'luckywp-cookie-notice-gdpr/luckywp-cookie-notice-gdpr.php', 'option_name' => 'lwpcng_settings'),
			array('dir_slug' => 'ninja-gdpr-compliance/njt-gdpr.php', 'option_name' => 'njt-gdpr'),
			array('dir_slug' => 'gdpr-cookie-consent/gdpr-cookie-consent.php', 'option_name' => 'gdpr-cookie-consent'),
			array('dir_slug' => 'uniconsent-cmp/uniconsent-cmp.php', 'option_name' => 'unic-options'),
			array('dir_slug' => 'wplegalpages/wplegalpages.php', 'option_name' => 'legal-pages'),
			array('dir_slug' => 'smart-cookie-kit/plugin.php', 'option_name' => 'nmod_sck_graphics'),
			array('dir_slug' => 'cookie-information-consent-solution/cookie-information.php', 'option_name' => 'cookie-information'),
			array('dir_slug' => 'dsgvo-fur-die-schweiz/dsgvo-fur-die-schweiz.php', 'option_name' => 'dsgvo-admin'),
			array('dir_slug' => 'gdpr-cookies-pro/gdpr-cookies-pro.php', 'option_name' => 'gdpr-cookies-pro'),
			array('dir_slug' => 'seahorse-gdpr-data-manager/seahorse-gdpr-data-manager.php', 'option_name' => 'seahorse_gdpr_data_manager_plugin'),
			array('dir_slug' => 'dsgvo-tools-kommentar-ip-entfernen/main.php', 'option_name' => 'fhw_dsgvo_kommentar_options'),
			array('dir_slug' => 'gdpr-tools/gdpr-tools.php', 'option_name' => 'gdpr-tools-settings'),
			array('dir_slug' => 'gdpr-cookie-compliance/moove-gdpr.php', 'option_name' => 'moove-gdpr'),
			array('dir_slug' => 'cookie-notice/cookie-notice.php', 'option_name' => 'cookie-notice'),
			array('dir_slug' => 'tarteaucitronjs/tarteaucitron.php', 'option_name' => 'tarteaucitronjs'),
			array('dir_slug' => 'wp-gdpr-compliance/wp-gdpr-compliance.php', 'option_name' => 'wp_gdpr_compliance'),
			array('dir_slug' => 'iubenda_cookie_solution/iubenda_cookie_solution.php', 'option_name' => 'iubenda'),
			array('dir_slug' => 'easy-wp-cookie-popup/easy-wp-cookie-popup.php', 'option_name' => 'cookii_settings'),
			array('dir_slug' => 'gdpr-compliance-cookie-consent/gdpr-compliance-cookie-consent.php', 'option_name' => 'gdpr-compliance-cookie-consent'),
			array('dir_slug' => 'yetience-plugin/yetience-plugin.php', 'option_name' => 'yetience-yeloni'),
			array('dir_slug' => 'cwis-antivirus-malware-detected/cwis-antivirus-malware-detected.php', 'option_name' => 'cwis-scanner'),
			array('dir_slug' => 'gdpr-compliance-by-supsystic/grs.php', 'option_name' => 'gdpr-compliance-by-supsystic'),
			array('dir_slug' => 'auto-terms-of-service-privacy-policy/auto-terms-of-service-privacy-policy.php', 'option_name' => 'wpautoterms_page'),
			array('dir_slug' => 'google-analytics-opt-out/google-analytics-opt-out.php', 'option_name' => 'gaoo-options'),
			array('dir_slug' => 'surbma-gdpr-proof-google-analytics/surbma-gdpr-proof-google-analytics.php', 'option_name' => 'surbma-gpga-menu'),
			array('dir_slug' => 'bp-gdpr/buddypress-gdpr.php', 'option_name' => 'buddyboss-bp-gdpr'),
			array('dir_slug' => 'beautiful-and-responsive-cookie-consent/nsc_bar-cookie-consent.php', 'option_name' => 'nsc_bar-cookie-consent'),
			array('dir_slug' => 'simple-gdpr/simple-gdpr.php', 'option_name' => 'SGDPR_settings'),
			array('dir_slug' => 'wonderpush-web-push-notifications/wonderpush.php', 'option_name' => 'wonderpush'),
			array('dir_slug' => 'ns-gdpr/ns-gdpr.php', 'option_name' => 'ns-gdpr'), 
		);
		$google_analytics  = array(
			array('dir_slug' => 'really-simple-ssl/rlrsssl-really-simple-ssl.php', 'option_name' => 'rlrsssl_really_simple_ssl'),
			array('dir_slug' => 'ssl-insecure-content-fixer/ssl-insecure-content-fixer.php', 'option_name' => 'ssl-insecure-content-fixer'),
			array('dir_slug' => 'https-redirection/https-redirection.php', 'option_name' => 'https-redirection'),
			array('dir_slug' => 'wordpress-https/wordpress-https.php', 'option_name' => 'wordpress-https'),
			array('dir_slug' => 'wp-force-ssl/wp-force-ssl.php', 'option_name' => 'wpfs-settings'),
			array('dir_slug' => 'sakura-rs-wp-ssl/sakura-rs-ssl.php', 'option_name' => 'sakura-admin-menu'),
			array('dir_slug' => 'wp-letsencrypt-ssl/wp-letsencrypt.php', 'option_name' => 'wp_encryption'),
			array('dir_slug' => 'ssl-zen/ssl_zen.php', 'option_name' => 'ssl_zen'),
			array('dir_slug' => 'one-click-ssl/ssl.php', 'option_name' => 'one-click-ssl'),
			array('dir_slug' => 'http-https-remover/http-https-remover.php', 'option_name' => 'httphttpsRemoval')
		);

		$socialObj = new sfsi_plus_SocialHelper();
		$current_url = site_url();
		$fb_data = $socialObj->sfsi_banner_get_fb($current_url);
         $check_fb_count_more_than_one = $fb_data > 0 || $socialObj->sfsi_get_pinterest($current_url) > 0;
         $sfsi_fb_count =  get_option('sfsi_plus_fb_count', false);
         if ($check_fb_count_more_than_one > $sfsi_fb_count || $sfsi_fb_count == "") {
             update_option('sfsi_plus_fb_count',  ($check_fb_count_more_than_one));
         }
        $sfsi_fb_count_check_for_shares =  $sfsi_fb_count > 0;
         
		// $sfsi_plus_banner_global_firsttime_offer = unserialize(get_option('sfsi_plus_banner_global_firsttime_offer', false));
		$sfsi_plus_banner_global_pinterest = unserialize(get_option('sfsi_plus_banner_global_pinterest', false));
		$sfsi_plus_banner_global_social = unserialize(get_option('sfsi_plus_banner_global_social', false));
		$sfsi_plus_banner_global_load_faster = unserialize(get_option('sfsi_plus_banner_global_load_faster', false));
		$sfsi_plus_banner_global_shares = unserialize(get_option('sfsi_plus_banner_global_shares', false));
		$sfsi_plus_banner_global_gdpr = unserialize(get_option('sfsi_plus_banner_global_gdpr', false));
		$sfsi_plus_banner_global_http = unserialize(get_option('sfsi_plus_banner_global_http', false));
		$sfsi_plus_banner_global_upgrade = unserialize(get_option('sfsi_plus_banner_global_upgrade', false));

		// $sfsi_plus_banner_global_firsttime_offer_criteria = true;
		$sfsi_plus_banner_global_pinterest_criteria = ((sfsi_plus_count_media_item() > 2) || (sfsi_plus_pinterest_icon_shown()) || sfsi_plus_has_gallery_plugin_activated($gallery_plugins));
		$sfsi_plus_banner_global_social_criteria =  sfsi_plus_mobile_icons_shown();
		$sfsi_plus_banner_global_load_faster_criteria = sfsi_plus_has_cache_plugin_activated($optimization_plugins);
		$sfsi_plus_banner_global_shares_criteria = sfsi_plus_has_sharecount_plugin_activated($sharecount_plugins);
		$sfsi_plus_banner_global_gdpr_criteria  = sfsi_plus_has_gdpr_plugin_activated($gdpr_plugins);
		$sfsi_plus_banner_global_http_criteria = is_ssl() && ($sfsi_fb_count_check_for_shares || $check_fb_count_more_than_one);
		// $sfsi_plus_banner_global_http_criteria = true;


		$global_banners = array(
			array($sfsi_plus_banner_global_social, 'sfsi_plus_banner_global_social', $sfsi_plus_banner_global_social_criteria),
			array($sfsi_plus_banner_global_gdpr, 'sfsi_plus_banner_global_gdpr', $sfsi_plus_banner_global_gdpr_criteria),
			array($sfsi_plus_banner_global_pinterest, 'sfsi_plus_banner_global_pinterest', $sfsi_plus_banner_global_pinterest_criteria),
			array($sfsi_plus_banner_global_load_faster, 'sfsi_plus_banner_global_load_faster', $sfsi_plus_banner_global_load_faster_criteria),
			array($sfsi_plus_banner_global_shares, 'sfsi_plus_banner_global_shares', $sfsi_plus_banner_global_shares_criteria),
			array($sfsi_plus_banner_global_http, 'sfsi_plus_banner_global_http', $sfsi_plus_banner_global_http_criteria),
		);
		$global_banners_not_met_criteria = array(
			array($sfsi_plus_banner_global_pinterest, 'sfsi_plus_banner_global_pinterest', !(sfsi_plus_count_media_item() > 2)),
			array($sfsi_plus_banner_global_shares, 'sfsi_plus_banner_global_shares', $sfsi_plus_banner_global_shares_criteria),
			array($sfsi_plus_banner_global_load_faster, 'sfsi_plus_banner_global_load_faster', $sfsi_plus_banner_global_load_faster_criteria),
			array($sfsi_plus_banner_global_gdpr, 'sfsi_plus_banner_global_gdpr', $sfsi_plus_banner_global_gdpr_criteria),
		);
		$global_banner_criteria = array(
			$sfsi_plus_banner_global_pinterest_criteria,
			$sfsi_plus_banner_global_social_criteria,
			$sfsi_plus_banner_global_load_faster_criteria,
			$sfsi_plus_banner_global_shares_criteria,
			$sfsi_plus_banner_global_gdpr_criteria,
			$sfsi_plus_banner_global_http_criteria
		);
		// var_dump($global_banner_criteria);

		$global_banner_criteria_true_count = count(array_keys($global_banner_criteria, true));
		$global_banner_appeared_true_count = 0;

		$count = 0;
		$sfsi_plus_present_time = strtotime(date('Y-m-d h:i:s'));
		$sfsi_plus_install_time = (get_option('sfsi_plus_installDate'));
		$sfsi_plus_loyalty = get_option("sfsi_plus_loyaltyDate");
		$sfsi_plus_min_loyalty_time = date('Y-m-d H:i:s', strtotime($sfsi_plus_install_time . $sfsi_plus_loyalty));
		$sfsi_plus_round_one_added = false;
		foreach ($global_banners as $key => $global_banner) {

			if ($sfsi_plus_present_time >= strtotime($global_banner[0]['timestamp']) || ($global_banner[0]['timestamp'] == "")) {
				// var_dump("round1",$global_banner[1]);

				if ($global_banner[0]['met_criteria'] == "yes") {
					$count = $count + 1;
				}
				if ($global_banner[0]['banner_appeared'] == "yes") {
					$global_banner_appeared_true_count = $global_banner_appeared_true_count + 1;
				}
				if ($global_banner[0]['met_criteria'] == "no" && $global_banner[0]['banner_appeared'] == "no" && $global_banner[0]['is_active'] == "no" && $global_banner[2] == true) {
					// var_dump('met criteria');
					$todaysdate = date("Y-m-d h:i:s");
					$showNextBanner = get_option('sfsi_plus_showNextBannerDate');
					if ($todaysdate >= $sfsi_plus_min_loyalty_time && $sfsi_plus_banner_global_upgrade['met_criteria'] == "no") {
						$date = date('Y-m-d H:i:s', strtotime($todaysdate . $showNextBanner));
						$update_banner_status = array(
							'met_criteria'     => "yes",
							'is_active' => "yes",
							'timestamp' =>  $date
						);
						update_option('sfsi_plus_banner_global_upgrade', serialize($update_banner_status));
						break;
					}
					$date = date('Y-m-d H:i:s', strtotime($todaysdate . $showNextBanner));
					$update_banner_status = array(
						'met_criteria'     => "yes",
						'banner_appeared' => "yes",
						'is_active' => "yes",
						'timestamp' =>  $date
					);
					update_option($global_banner[1], serialize($update_banner_status));
					$sfsi_plus_round_one_added = true;

					break;
				}
			}
		}

		$global_banners_filters = array_filter($global_banners_not_met_criteria, function ($global_banner) {
			return ($global_banner[2] == false && $global_banner[0]['met_criteria'] == "no" && $global_banner[0]['banner_appeared'] == "no" && $global_banner[0]['is_active'] == "no");
		});
		$global_banners_criteria_filters = array_filter($global_banners, function ($global_banner) {
			return ($global_banner[2] == true && $global_banner[0]['met_criteria'] == "no" && $global_banner[0]['banner_appeared'] == "no" && $global_banner[0]['is_active'] == "no");
		});
		// var_dump("round one added",$sfsi_plus_round_one_added);
		if (false === $sfsi_plus_round_one_added) {
			foreach ($global_banners_filters as $key => $global_banners_filter) {
				// if ($count >= $global_banner_criteria_true_count) {
				// var_dump('round2', $global_banners_filter);
				if ($global_banners_filter[0]['met_criteria'] == "no" && $global_banners_filter[0]['banner_appeared'] == "no" && $global_banners_filter[0]['is_active'] == "no" && $global_banners_filter[2] == false) {
					$todaysdate = date("Y-m-d h:i:s");
					$showNextBanner = get_option('sfsi_plus_showNextBannerDate');
					if ($todaysdate >= $sfsi_plus_min_loyalty_time && $sfsi_plus_banner_global_upgrade['met_criteria'] == "no") {
						$date = date('Y-m-d H:i:s', strtotime($todaysdate . $showNextBanner));
						$update_banner_status = array(
							'met_criteria'     => "yes",
							'is_active' => "yes",
							'timestamp' =>  $date
						);
						update_option('sfsi_plus_banner_global_upgrade', serialize($update_banner_status));
						break;
					}
					$date = date('Y-m-d H:i:s', strtotime($todaysdate . $showNextBanner));
					$update_banner_status = array(
						'met_criteria'     => "no",
						'banner_appeared' => "yes",
						'is_active' => "yes",
						'timestamp' =>  $date
					);
					update_option($global_banners_filter[1], serialize($update_banner_status));
					break;
				}
				// }
			}
		}
		// var_dump(($global_banners_filters ) ,($global_banners_criteria_filters));
		if (empty($global_banners_filters) && empty($global_banners_criteria_filters)) {
			foreach ($global_banners as $key => $global_banner) {

				$todaysdate = date("Y-m-d h:i:s");
				$cycleDate = get_option('sfsi_plus_cycleDate');

				$date_plus_180 =  date('Y-m-d H:i:s', strtotime($todaysdate . $cycleDate));
				$update_banner_status = array(
					'met_criteria'     => "no",
					'banner_appeared' => "no",
					'is_active' => "no",
					'timestamp' =>  $date_plus_180,
				);
				update_option($global_banner[1], serialize($update_banner_status));
			}
			foreach ($global_banners as $key => $global_banner) {
				if ($global_banner[2] == true) {
					$update_banner_status = array(
						'met_criteria'     => "yes",
						'banner_appeared' => "yes",
						'is_active' => "yes",
						'timestamp' =>  $date_plus_180,
					);
					update_option($global_banner[1], serialize($update_banner_status));
					break;
				}
			}
			if ($global_banner_criteria_true_count == 0) {
				foreach ($global_banners_not_met_criteria as $key => $global_banner) {
					$update_banner_status = array(
						'met_criteria'     => "no",
						'banner_appeared' => "yes",
						'is_active' => "yes",
						'timestamp' =>  $date_plus_180,
					);
					// var_dump($global_banners_not_met_criteria,'kfdjgkdsfgndfkngn isdfhgi hsdfg    idhfguidfi');
					if ($global_banner[2] == false) {
						update_option($global_banner[1], serialize($update_banner_status));
						break;
					}
				}
			}
		}
		
		wp_redirect(admin_url('admin.php?page=sfsi-plus-options'));
		exit;
		// return false;
	}

	function sfsi_plus_count_media_item()
	{
		$query_img_args = array(
			'post_type' => 'attachment',
			'post_mime_type' => array(
				'jpg|jpeg|jpe' => 'image/jpeg',
				'gif' => 'image/gif',
				'png' => 'image/png',
			),
			'post_status' => 'inherit',
			'posts_per_page' => -1,
		);
		$query_img = new WP_Query($query_img_args);
		return $query_img->post_count;
	}
	function sfsi_plus_pinterest_icon_shown()
	{
		$sfsi_plus_section1       =  unserialize(get_option('sfsi_plus_section1_options', false));
		$option9 =  unserialize(get_option('sfsi_plus_section9_options', false));
		$option6 =  unserialize(get_option('sfsi_plus_section6_options', false));
		// var_dump($option9["sfsi_plus_icons_float"]);
		// var_dump($option9["sfsi_plus_show_via_widget"]);
		// var_dump($option9["sfsi_plus_show_via_shortcode"]);
		// var_dump($sfsi_plus_section1["sfsi_plus_pinterest_display"]);
		// var_dump($option6["sfsi_plus_show_Onposts"]);
		// var_dump($option6["sfsi_plus_rectpinit"]);
		// var_dump($option9["sfsi_plus_show_via_afterposts"]);
		//check if icons are displayed
		if (
			(
				(
					(isset($option9["sfsi_plus_icons_float"]) && $option9["sfsi_plus_icons_float"] == "yes") || (isset($option9["sfsi_plus_show_via_widget"]) && $option9["sfsi_plus_show_via_widget"] == "yes") || (isset($option9["sfsi_plus_place_item_manually"]) && $option9["sfsi_plus_place_item_manually"] == "yes")) &&
				$sfsi_plus_section1["sfsi_plus_pinterest_display"] == "yes") || (isset($option9["sfsi_plus_show_item_onposts"]) &&
				$option9["sfsi_plus_show_item_onposts"] == "yes" &&
				$option6["sfsi_plus_show_Onposts"] == "yes" &&
				$option6["sfsi_plus_rectpinit"] == "yes")
		) {
			return true;
		}
		return false;
	}
	function sfsi_plus_mobile_icons_shown()
	{
		/// check if mobile icons are shown and mobile icons are present on the homepage.
		$sfsi_plus_section5            =  unserialize(get_option('sfsi_plus_section5_options', false));
		if (isset($sfsi_plus_section5['sfsi_plus_disable_floaticons']) && $sfsi_plus_section5['sfsi_plus_disable_floaticons'] == "yes") {
			return true;
		}
		return false;
	}
	function sfsi_plus_has_cache_plugin_activated($optimization_plugins)
	{
		$sfsi_plus_optimization_plugin_active = array();
		foreach ($optimization_plugins as $key => $optimization_plugin) {
			$sfsi_plus_optimization_plugin_active[$key] = is_plugin_active($optimization_plugin['dir_slug']);
		}
		$check_optimization_plugin_active_is_true = in_array(true, $sfsi_plus_optimization_plugin_active);
		return $check_optimization_plugin_active_is_true;
	}

	function sfsi_plus_has_sharecount_plugin_activated($sharecount_plugins)
	{
		$sfsi_plus_sharecount_plugin_active = array();
		foreach ($sharecount_plugins as $key => $sharecount_plugin) {
			$sfsi_plus_sharecount_plugin_active[$key] = is_plugin_active($sharecount_plugin['dir_slug']);
		}
		$check_sharecount_plugin_active_is_true = in_array(true, $sfsi_plus_sharecount_plugin_active);
		return $check_sharecount_plugin_active_is_true;
	}

	function sfsi_plus_has_gdpr_plugin_activated($gdpr_plugins)
	{
		$sfsi_plus_gdpr_plugin_active = array();
		foreach ($gdpr_plugins as $key => $gdpr_plugin) {
			$sfsi_plus_gdpr_plugin_active[$key] = is_plugin_active($gdpr_plugin['dir_slug']);
		}
		$check_gdpr_plugin_active_is_true = in_array(true, $sfsi_plus_gdpr_plugin_active);
		return $check_gdpr_plugin_active_is_true;
	}

	function sfsi_plus_has_gallery_plugin_activated($gallery_plugins)
	{
		$sfsi_plus_gallery_plugin_active = array();
		foreach ($gallery_plugins as $key => $gallery_plugin) {
			$sfsi_plus_gallery_plugin_active[$key] = is_plugin_active($gallery_plugin['dir_slug']);
		}
		$check_gallery_plugin_active_is_true = in_array(true, $sfsi_plus_gallery_plugin_active);
		return $check_gallery_plugin_active_is_true;
	}