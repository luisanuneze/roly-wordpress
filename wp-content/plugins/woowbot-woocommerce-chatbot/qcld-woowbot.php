<?php
/**
 * Plugin Name: Chatbot for WooCommerce - WoowBot
 * Plugin URI: https://wordpress.org/plugins/woowbot-woocommerce-chatbot/
 * Description: WoowBot is a WooCommerce Chat Bot. This stand alone shopbot helps shoppers find the product they are looking for easily and increase sales!
 * Donate link: https://www.quantumcloud.com
 * Version: 3.1.5
 * @author    QuantumCloud
 * @category  WooCommerce
 * Author: QunatumCloud
 * Author URI: https://www.quantumcloud.com/
 * Requires at least: 4.9
 * Tested up to: 5.5
 * Text Domain: woochatbot
 * Domain Path: /lang
 * License: GPL2
 */


if (!defined('ABSPATH')) exit; // Exit if accessed directly

define('QCLD_WOOCHATBOT_VERSION', '1.0');
define('QCLD_WOOCHATBOT_REQUIRED_WOOCOMMERCE_VERSION', 2.2);
define('QCLD_WOOCHATBOT_PLUGIN_DIR_PATH', basename(plugin_dir_path(__FILE__)));
define('QCLD_WOOCHATBOT_PLUGIN_URL', plugin_dir_url(__FILE__));
define('QCLD_WOOCHATBOT_IMG_URL', QCLD_WOOCHATBOT_PLUGIN_URL . "images/");
define('QCLD_WOOCHATBOT_IMG_ABSOLUTE_PATH', plugin_dir_path(__FILE__) . "images");
require_once("functions.php");
require_once("qc-support-promo-page/class-qc-support-promo-page.php");
require_once("qcld-woowbot-info-page.php");
require_once("class-qc-free-plugin-upgrade-notice.php");


/**
 * Main Class.
 */
class QCLD_Woo_Chatbot
{

    private $id = 'woowbot';

    private static $instance;

    /**
     *  Get Instance creates a singleton class that's cached to stop duplicate instances
     */
    public static function qcld_woo_chatbot_get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self();
            self::$instance->qcld_woo_chatbot_init();
        }
        return self::$instance;
    }

    /**
     *  Construct empty on purpose
     */

    private function __construct()
    {
    }

    /**
     *  Init behaves like, and replaces, construct
     */

    public function qcld_woo_chatbot_init()
    {

        // Check if WooCommerce is active, and is required WooCommerce version.
        if (!class_exists('WooCommerce') || version_compare(get_option('woocommerce_db_version'), QCLD_WOOCHATBOT_REQUIRED_WOOCOMMERCE_VERSION, '<')) {
            add_action('admin_notices', array($this, 'woocommerce_inactive_notice_for_woo_chatbot'));
            return;
        }

        add_action('admin_menu', array($this, 'qcld_woo_chatbot_admin_menu'), 6);

        if ((!empty($_GET["page"])) && ($_GET["page"] == "woowbot")) {

            add_action('admin_init', array($this, 'qcld_woo_chatbot_save_options'));
        }
        if (is_admin()) {
            add_action('admin_enqueue_scripts', array($this, 'qcld_woo_chatbot_admin_scripts'));
        }
        if (!is_admin()) {
            add_action('wp_enqueue_scripts', array($this, 'qcld_woo_chatbot_frontend_scripts'));
        }
    }


    /**
     * Add a submenu item to the WooCommerce menu
     */
    public function qcld_woo_chatbot_admin_menu()
    {

        /*add_submenu_page('woocommerce',
            __('WoowBot', 'woochatbot'),
            __('WoowBot', 'woochatbot'),
            'manage_woocommerce',
            $this->id,
            array($this, 'qcld_woo_chatbot_admin_page'));*/
        //add_menu_page( 'WoowBot', 'WoowBot', 'manage_options', 'admin.php?page=woowbot', '', 'dashicons-format-status', 6 );
        add_menu_page('WoowBot', 'WoowBot', 'manage_options', 'woowbot', '', 'dashicons-format-status', 6);
        add_submenu_page(
            'woowbot',
            __( 'WoowBot Control Panel', 'woochatbot' ),
            __( 'WoowBot Panel', 'woochatbot' ),
            'manage_options',
            'woowbot',
            array($this, 'qcld_woo_chatbot_admin_page')
        );
    }



    /**
     * Include admin scripts
     */
    public function qcld_woo_chatbot_admin_scripts($hook)
    {
        global $woocommerce, $wp_scripts;

        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        if (((!empty($_GET["page"])) && ($_GET["page"] == "woowbot")) || ($hook == "widgets.php")) {

            wp_enqueue_script('jquery');

            wp_enqueue_media();

            wp_enqueue_style('woocommerce_admin_styles', $woocommerce->plugin_url() . '/assets/css/admin.css');

            wp_register_style('qlcd-woo-chatbot-admin-style', plugins_url(basename(plugin_dir_path(__FILE__)) . '/css/admin-style.css', basename(__FILE__)), '', QCLD_WOOCHATBOT_VERSION, 'screen');
            wp_enqueue_style('qlcd-woo-chatbot-admin-style');

            wp_register_style('qlcd-woo-chatbot-font-awesome', plugins_url(basename(plugin_dir_path(__FILE__)) . '/css/font-awesome.min.css', basename(__FILE__)), '', QCLD_WOOCHATBOT_VERSION, 'screen');
            wp_enqueue_style('qlcd-woo-chatbot-font-awesome');


            wp_register_style('qlcd-woo-chatbot-tabs-style', plugins_url(basename(plugin_dir_path(__FILE__)) . '/css/woo-chatbot-tabs.css', basename(__FILE__)), '', QCLD_WOOCHATBOT_VERSION, 'screen');
            wp_enqueue_style('qlcd-woo-chatbot-tabs-style');


            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'jquery-ui-core');
            wp_register_script('qcld-woo-chatbot-cbpFWTabs', plugins_url(basename(plugin_dir_path(__FILE__)) . '/js/cbpFWTabs.js', basename(__FILE__)), array(), true);
            wp_enqueue_script('qcld-woo-chatbot-cbpFWTabs');

            wp_register_script('qcld-woo-chatbot-modernizr-custom', plugins_url(basename(plugin_dir_path(__FILE__)) . '/js/modernizr.custom.js', basename(__FILE__)), array(), true);
            wp_enqueue_script('qcld-woo-chatbot-modernizr-custom');

            wp_register_script('qcld-woo-chatbot-bootstrap-js', plugins_url(basename(plugin_dir_path(__FILE__)) . '/js/bootstrap.js', basename(__FILE__)), array('jquery'), true);
            wp_enqueue_script('qcld-woo-chatbot-bootstrap-js');

            wp_register_style('qcld-woo-chatbot-bootstrap-css', plugins_url(basename(plugin_dir_path(__FILE__)) . '/css/bootstrap.min.css', basename(__FILE__)), '', QCLD_WOOCHATBOT_VERSION, 'screen');
            wp_enqueue_style('qcld-woo-chatbot-bootstrap-css');

            wp_register_script('qcld-woo-chatbot-repeatable', plugins_url(basename(plugin_dir_path(__FILE__)) . '/js/jquery.repeatable.js', basename(__FILE__)), array('jquery'));
            wp_enqueue_script('qcld-woo-chatbot-repeatable');

            wp_register_script('qcld-woo-chatbot-admin-js', plugins_url(basename(plugin_dir_path(__FILE__)) . '/js/qcld-woo-chatbot-admin.js', basename(__FILE__)), array('jquery', 'jquery-ui-core','qcld-woo-chatbot-slick'), true);
            wp_enqueue_script('qcld-woo-chatbot-admin-js');

            wp_localize_script('qcld-woo-chatbot-admin-js', 'ajax_object',
                array('ajax_url' => admin_url('admin-ajax.php')));

        }
        if (((!empty($_GET["page"])) && ($_GET["page"] == "woowbot")) || (!empty($_GET["page"])) && ($_GET["page"] == "qcpro-promo-page-woowbot-free") || (!empty($_GET["page"])) && ($_GET["page"] == "qcld_woowbot_info_page")) {
            wp_register_script('qcld-woo-chatbot-slick', plugins_url(basename(plugin_dir_path(__FILE__)) . '/js/slick.min.js', basename(__FILE__)), array('jquery'), true);
            wp_enqueue_script('qcld-woo-chatbot-slick');
            wp_register_style('qcld-woo-chatbot-slick-css', plugins_url(basename(plugin_dir_path(__FILE__)) . '/css/slick.css', basename(__FILE__)), '', QCLD_WOOCHATBOT_VERSION, 'screen');
            wp_enqueue_style('qcld-woo-chatbot-slick-css');
            wp_register_style('qcld-woo-chatbot-slick-theme', plugins_url(basename(plugin_dir_path(__FILE__)) . '/css/slick-theme.css', basename(__FILE__)), '', QCLD_WOOCHATBOT_VERSION, 'screen');
            wp_enqueue_style('qcld-woo-chatbot-slick-theme');
        }

    }


    public function qcld_woo_chatbot_frontend_scripts(){
        global $woocommerce, $wp_scripts;

        $woo_chatbot_obj = array(
            'woo_chatbot_position_x' => get_option('woo_chatbot_position_x'),
            'woo_chatbot_position_y' => get_option('woo_chatbot_position_y'),
            'ajax_url' => admin_url('admin-ajax.php'),
            'image_path'=>QCLD_WOOCHATBOT_IMG_URL,
            'host'=> get_option('qlcd_woo_chatbot_host'),
            'agent'=> get_option('qlcd_woo_chatbot_agent'),
            'agent_join'=> get_option('qlcd_woo_chatbot_agent_join'),
            'welcome'=> get_option('qlcd_woo_chatbot_welcome'),
            'asking_name'=> get_option('qlcd_woo_chatbot_asking_name'),
            'i_am'=> get_option('qlcd_woo_chatbot_i_am'),
            'name_greeting'=> get_option('qlcd_woo_chatbot_name_greeting'),
            'product_asking'=> get_option('qlcd_woo_chatbot_product_asking'),
            'product_suggest'=> get_option('qlcd_woo_chatbot_product_suggest'),
            'product_infinite'=> get_option('qlcd_woo_chatbot_product_infinite'),
			'conversations_with'=> get_option('qlcd_woo_chatbot_conversations_with'),
			'is_typing'=> get_option('qlcd_woo_chatbot_is_typing'),
			'send_a_msg'=> get_option('qlcd_woo_chatbot_send_a_msg'),
            'product_success'=> get_option('qlcd_woo_chatbot_product_success'),
            'product_fail'=> get_option('qlcd_woo_chatbot_product_fail'),
            'currency_symbol' => get_woocommerce_currency_symbol(),

            //bargainator
            'your_offer_price'  => (get_option('qcld_minimum_accept_price_heading_text')!=''?get_option('qcld_minimum_accept_price_heading_text'):'Please, tell me what is your offer price.'),
            'map_acceptable_prev_price'  => (get_option('qcld_minimum_accept_price_acceptable_prev_price')!=''?get_option('qcld_minimum_accept_price_acceptable_prev_price'):'We agreed on the price {offer price}. Continue?'),
            'your_offer_price_again'  => (get_option('qcld_minimum_accept_price_heading_text_again')!=''?get_option('qcld_minimum_accept_price_heading_text_again'):'It seems like you have not provided any offer amount. Please give me a number!'),
            'your_low_price_alert' => (get_option('qcld_minimum_accept_price_low_alert_text_two')!=''?get_option('qcld_minimum_accept_price_low_alert_text_two'):'Your offered price {offer price} is too low for us.'),
            'your_too_low_price_alert' => (get_option('qcld_minimum_accept_price_too_low_alert_text')!=''?get_option('qcld_minimum_accept_price_too_low_alert_text'):'The best we can do for you is {minimum amount}. Do you accept?'),
            'map_talk_to_boss' => (get_option('qcld_minimum_accept_price_talk_to_boss')!=''?get_option('qcld_minimum_accept_price_talk_to_boss'):'Please tell me your final price. I will talk to my boss.'),
            'map_get_email_address' => (get_option('qcld_minimum_accept_price_get_email_address')!=''?get_option('qcld_minimum_accept_price_get_email_address'):'Please tell me your email address so I can get back to you.'),
            'map_thanks_test' => (get_option('qcld_minimum_accept_price_thanks_test')!=''?get_option('qcld_minimum_accept_price_thanks_test'):'Thank you.'),
            'map_acceptable_price' => (get_option('qcld_minimum_accept_price_acceptable_price')!=''?get_option('qcld_minimum_accept_price_acceptable_price'):'Your offered price {offer price} is acceptable.'),
            'map_checkout_now_button_text' => (get_option('qcld_minimum_accept_modal_checkout_now_button_text')!=''?get_option('qcld_minimum_accept_modal_checkout_now_button_text'):'Checkout Now'),
            'map_get_checkout_url' => (wc_get_checkout_url()),
            'map_free_get_ajax_nonce' => (wp_create_nonce( 'woo-minimum-acceptable-price')),
        );



        wp_register_script('qcld-woo-chatbot-slimscroll-js', plugins_url(basename(plugin_dir_path(__FILE__)) . '/js/jquery.slimscroll.min.js', basename(__FILE__)), array('jquery'), QCLD_WOOCHATBOT_VERSION, true);
        wp_enqueue_script('qcld-woo-chatbot-slimscroll-js');

        wp_register_script('qcld-woo-chatbot-frontend', plugins_url(basename(plugin_dir_path(__FILE__)) . '/js/qcld-woo-chatbot-frontend.js', basename(__FILE__)), array('jquery'), QCLD_WOOCHATBOT_VERSION, true);
        wp_enqueue_script('qcld-woo-chatbot-frontend');


        wp_localize_script('qcld-woo-chatbot-frontend', 'woo_chatbot_obj', $woo_chatbot_obj);
        wp_register_style('qcld-woo-chatbot-frontend-style', plugins_url(basename(plugin_dir_path(__FILE__)) . '/css/frontend-style.css', basename(__FILE__)), '', QCLD_WOOCHATBOT_VERSION, 'screen');
        wp_enqueue_style('qcld-woo-chatbot-frontend-style');
    }


    /**
     * Render the admin page
     */
    public function qcld_woo_chatbot_admin_page()
    {

        global $woocommerce;

        $action = 'admin.php?page=woowbot'; ?>
        <div class="woo-chatbot-wrap">
            <div class="icon32"><br></div>
            <form action="<?php echo esc_attr($action); ?>" method="POST" enctype="multipart/form-data">
                <div class="container form-container">
                    <h2><?php _e('WoowBot Control Panel', 'woochatbot'); ?></h2>
                    <div class="qc_get_pro">
                        <h2><a href="https://www.quantumcloud.com/products/woocommerce-chatbot-woowbot/" target="_blank" ><?php _e(' Get the Professional Version Now!', 'woochatbot'); ?></a></h2>
                        <p><a href="https://www.quantumcloud.com/" target="_blank"><?php _e('WoowBot is a project by Web Design Company QuantumCloud', 'woochatbot'); ?> </a></p>
                    </div>
                    <section class="woo-chatbot-tab-container-inner">
                        <div class="woo-chatbot-tabs woo-chatbot-tabs-style-flip">
                            <nav>
                                <ul>
                                    <li><a href="#section-flip-1"><i class="fa fa-toggle-on"></i><span><?php _e('GENERAL SETTINGS', 'woochatbot'); ?></span></a>
                                    </li>
                                    <li><a href="#section-flip-3"><i class="fa fa-gear faa-spin"></i><span><?php _e('WoowBot ICONS', 'woochatbot'); ?> </span></a></li>
                                    <li><a href="#section-flip-7"><i class="fa fa-language"></i><span><?php _e('LANGUAGE CENTER', 'woochatbot'); ?> </span></a></li>
                                    <li><a href="#section-flip-8"><i class="fa fa-code"></i><span><?php _e('Custom CSS', 'woochatbot'); ?></span></a></li>
                                    <li><a href="#section-flip-9"><i class="fa fa-code"></i><span><?php _e('Bargain Bot', 'woochatbot'); ?></span></a></li>
									<li tab-data="addons"><a href="<?php echo esc_attr($action); ?>&tab=addons"> <span
                                            class="woowbot-admin-tab-icon"> <i class="fa fa-puzzle-piece" aria-hidden="true"></i> </span> <span
                                            class="woowbot-admin-tab-name">
									<?php _e('Addons', 'woochatbot'); ?>
									</span> </a></li>
                                </ul>
                            </nav>
                            <div class="content-wrap">
                                <section id="section-flip-1">
                                    <div class="top-section">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <br>
                                                <p class="qc-opt-title-font">
                                                    <?php _e('Disable WoowBot', 'woochatbot'); ?>
                                                </p>
                                                <div class="cxsc-settings-blocks">
                                                    <input  value="1" id="disable_woo_chatbot" type="checkbox" name="disable_woo_chatbot" <?php echo(get_option('disable_woo_chatbot') == 1 ? 'checked' : ''); ?>>
                                                    <label for="disable_woo_chatbot"><?php _e('Disable WoowBot to load', 'woochatbot'); ?> </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <p class="qc-opt-title-font"> <?php _e('Disable WooWBot on Mobile Device', 'woochatbot'); ?> </p>
                                                <div class="cxsc-settings-blocks">
                                                    <input value="1" id="disable_woo_chatbot_on_mobile" type="checkbox"
                                                           name="disable_woo_chatbot_on_mobile" <?php echo(get_option('disable_woo_chatbot_on_mobile') == 1 ? 'checked' : ''); ?>>
                                                    <label for="disable_woo_chatbot_on_mobile"><?php _e('Disable WoowBot to Load on Mobile Device', 'woochatbot'); ?> </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <p class="qc-opt-title-font">
                                                    <?php _e('Override WoowBot Icon\'s Position', 'woochatbot'); ?>
                                                </p>
                                                <div class="cxsc-settings-blocks">
                                                    <?php
                                                    $qcld_woo_chatbot_position_x = get_option('woo_chatbot_position_x');
                                                    if ((!isset($qcld_woo_chatbot_position_x)) || ($qcld_woo_chatbot_position_x == "")) {
                                                        $qcld_woo_chatbot_position_x = __("120", "woo_chatbot");
                                                    }
                                                    $qcld_woo_chatbot_position_y = get_option('woo_chatbot_position_y');
                                                    if ((!isset($qcld_woo_chatbot_position_y)) || ($qcld_woo_chatbot_position_y == "")) {
                                                        $qcld_woo_chatbot_position_y = __("50", "woo_chatbot");
                                                    } ?>

                                                    <input type="number" class="qc-opt-dcs-font"
                                                           name="woo_chatbot_position_x"
                                                           id=""
                                                           value="<?php echo($qcld_woo_chatbot_position_x); ?>"
                                                           placeholder="From Right In px"> <span class="qc-opt-dcs-font"><?php _e('From Right In px', 'woochatbot'); ?></span>
                                                    <input type="number" class="qc-opt-dcs-font"
                                                           name="woo_chatbot_position_y"
                                                           id=""
                                                           value="<?php echo($qcld_woo_chatbot_position_y); ?>"
                                                           placeholder="From Bottom In Px"> <span class="qc-opt-dcs-font"><?php _e('From Bottom In px', 'woochatbot'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <p class="qc-opt-title-font"><?php _e('Number of products to show in search results. ( \'-1\' for all products ).', 'woochatbot'); ?></p>
                                                    <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_ppp" value="<?php echo(get_option('qlcd_woo_chatbot_ppp')!=''? get_option('qlcd_woo_chatbot_ppp') :10);?>">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </section>
                                <section id="section-flip-3">
                                    <div class="top-section">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <ul class="radio-list">
                                                    <li><img src="<?php echo QCLD_WOOCHATBOT_IMG_URL; ?>/icon-0.png"
                                                             alt=""> <input type="radio"
                                                                            name="woo_chatbot_icon" <?php echo(get_option('woo_chatbot_icon') == 'icon-0.png' ? 'checked' : ''); ?>
                                                                            value="icon-0.png">
                                                       <span class="qc-opt-dcs-font"><?php _e('Icon - 0', 'woochatbot'); ?></span>
                                                    </li>


                                                    <li><img src="<?php echo QCLD_WOOCHATBOT_IMG_URL; ?>/icon-1.png"
                                                             alt=""> <input type="radio"
                                                                            name="woo_chatbot_icon" <?php echo(get_option('woo_chatbot_icon') == 'icon-1.png' ? 'checked' : ''); ?>
                                                                            value="icon-1.png">
                                                        <span class="qc-opt-dcs-font"><?php _e('Icon - 1', 'woochatbot'); ?></span>
                                                    </li>
                                                    <li><img src="<?php echo QCLD_WOOCHATBOT_IMG_URL; ?>/icon-2.png"
                                                             alt=""> <input type="radio" name="woo_chatbot_icon"
                                                                            value="icon-2.png" <?php echo(get_option('woo_chatbot_icon') == 'icon-2.png' ? 'checked' : ''); ?>>
                                                        <span class="qc-opt-dcs-font"><?php _e('Icon - 2', 'woochatbot'); ?></span>
                                                    </li>
                                                    <li><img src="<?php echo QCLD_WOOCHATBOT_IMG_URL; ?>/icon-3.png"
                                                             alt=""> <input type="radio" name="woo_chatbot_icon"
                                                                            value="icon-3.png" <?php echo(get_option('woo_chatbot_icon') == 'icon-3.png' ? 'checked' : ''); ?>>
                                                        <span class="qc-opt-dcs-font"><?php _e('Icon - 3', 'woochatbot'); ?></span>
                                                    </li>

                                                    <li><img src="<?php echo QCLD_WOOCHATBOT_IMG_URL; ?>/icon-4.png"
                                                             alt=""> <input type="radio" name="woo_chatbot_icon"
                                                                            value="icon-4.png" <?php echo(get_option('woo_chatbot_icon') == 'icon-4.png' ? 'checked' : ''); ?>>
                                                        <span class="qc-opt-dcs-font"><?php _e('Icon - 4', 'woochatbot'); ?></span>
                                                    </li>


                                                    <li><img src="<?php echo QCLD_WOOCHATBOT_IMG_URL; ?>/icon-5.png"
                                                             alt=""> <input type="radio" name="woo_chatbot_icon"
                                                                            value="icon-5.png" <?php echo(get_option('woo_chatbot_icon') == 'icon-5.png' ? 'checked' : ''); ?>>
                                                        <span class="qc-opt-dcs-font"><?php _e('Icon - 5', 'woochatbot'); ?></span>
                                                    </li>
                                                    <li><img src="<?php echo QCLD_WOOCHATBOT_IMG_URL; ?>/icon-6.png"
                                                             alt=""> <input type="radio" name="woo_chatbot_icon"
                                                                            value="icon-6.png" <?php echo(get_option('woo_chatbot_icon') == 'icon-6.png' ? 'checked' : ''); ?>>
                                                        <span class="qc-opt-dcs-font"><?php _e('Icon - 6', 'woochatbot'); ?></span>
                                                    </li>
                                                    <li><img src="<?php echo QCLD_WOOCHATBOT_IMG_URL; ?>/icon-7.png"
                                                             alt=""> <input type="radio" name="woo_chatbot_icon"
                                                                            value="icon-7.png" <?php echo(get_option('woo_chatbot_icon') == 'icon-7.png' ? 'checked' : ''); ?>>
                                                        <span class="qc-opt-dcs-font"><?php _e('Icon - 7', 'woochatbot'); ?></span>
                                                    </li>
                                                    <li><img src="<?php echo QCLD_WOOCHATBOT_IMG_URL; ?>/icon-8.png"
                                                             alt=""> <input type="radio" name="woo_chatbot_icon"
                                                                            value="icon-8.png" <?php echo(get_option('woo_chatbot_icon') == 'icon-8.png' ? 'checked' : ''); ?>>
                                                        <span class="qc-opt-dcs-font">Icon - 8</span>
                                                    </li>
                                                    <li><img src="<?php echo QCLD_WOOCHATBOT_IMG_URL; ?>/icon-9.png"
                                                             alt=""> <input type="radio" name="woo_chatbot_icon"
                                                                            value="icon-9.png" <?php echo(get_option('woo_chatbot_icon') == 'icon-9.png' ? 'checked' : ''); ?>>
                                                        <span class="qc-opt-dcs-font"><?php _e('Icon -9', 'woochatbot'); ?></span>
                                                    </li>
                                                    <li><img src="<?php echo QCLD_WOOCHATBOT_IMG_URL; ?>/icon-10.png"
                                                             alt=""> <input type="radio" name="woo_chatbot_icon"
                                                                            value="icon-10.png" <?php echo(get_option('woo_chatbot_icon') == 'icon-10.png' ? 'checked' : ''); ?>>
                                                        <span class="qc-opt-dcs-font"><?php _e('Icon - 10', 'woochatbot'); ?></span>
                                                    </li>
                                                    <li><img src="<?php echo QCLD_WOOCHATBOT_IMG_URL; ?>/icon-11.png"
                                                             alt=""> <input type="radio" name="woo_chatbot_icon"
                                                                            value="icon-11.png" <?php echo(get_option('woo_chatbot_icon') == 'icon-11.png' ? 'checked' : ''); ?>>
                                                        <span class="qc-opt-dcs-font"><?php _e('Icon - 11', 'woochatbot'); ?></span>
                                                    </li>
                                                    <li><img src="<?php echo QCLD_WOOCHATBOT_IMG_URL; ?>/icon-12.png"
                                                             alt=""> <input type="radio" name="woo_chatbot_icon"
                                                                            value="icon-12.png" <?php echo(get_option('woo_chatbot_icon') == 'icon-12.png' ? 'checked' : ''); ?>>
                                                        <span class="qc-opt-dcs-font"><?php _e('Icon - 12', 'woochatbot'); ?></span>
                                                    </li>


                                                    <li>
                                                        <img src="<?php echo QCLD_WOOCHATBOT_IMG_URL; ?>/custom.png?<?php echo time(); ?>"
                                                             alt=""> <input type="radio" name="woo_chatbot_icon"
                                                                            value="custom.png" <?php echo(get_option('woo_chatbot_icon') == 'custom.png' ? 'checked' : ''); ?>>

                                                        <span class="qc-opt-dcs-font"><?php _e('Custom Icon', 'woochatbot'); ?></span>
                                                    </li>


                                                </ul>
                                            </div>
                                        </div>
                                        </br></br>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="qc-opt-title">
                                                    <?php _e('Upload custom Icon', 'woochatbot'); ?>
                                                </h4>
                                                <div class="cxsc-settings-blocks">
                                                    <p class="qc-opt-dcs-font"><?php echo __('Select file to upload') ?><input type="file"
                                                                                                       name="custom_icon"
                                                                                                       id="custom_icon"
                                                                                                       size="35"
                                                                                                       class=""/>
                                                        
                                                </div>
                                            </div>
                                        </div>
										</br></br>
                                        <div class="row">
                                            <div class="col-xs-12">



           
                                                

                                          <div id="top-section">
                                                        <div class="row">
                                                          <div class="col-sm-12">
                                                            <h4 class="qc-opt-title">
                                                              <?php _e('Custom Backgroud', 'woochatbot'); ?>
                                                            </h4>
                                                            <div class="cxsc-settings-blocks">
                                                              <input value="1" id="qcld_woo_chatbot_change_bg" type="checkbox"
                                                                                               name="qcld_woo_chatbot_change_bg" <?php echo(get_option('qcld_woo_chatbot_change_bg') == 1 ? 'checked' : ''); ?>>
                                                              <label for="qcld_woo_chatbot_change_bg">
                                                                <?php _e('Change the  message board background image (except mini mode).', 'woochatbot'); ?>
                                                              </label>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="row qcld-woo-chatbot-board-bg-container" <?php if (get_option('qcld_woo_chatbot_change_bg') != 1) {
                                                                                echo 'style="display:none"';
                                                                            } ?>>
                                                          <div class="col-xs-6">
                                                            <p class="woo-chatbot-settings-instruction">
                                                              <?php _e('Upload  message board background (Ideal image size 376px X 688px).', 'woochatbot'); ?>
                                                            </p>
                                                            <div class="cxsc-settings-blocks">
                                                              <?php
                                                                                        if (get_option('qcld_woo_chatbot_board_bg_path') != "") {
                                                                                            $qcld_woo_chatbot_board_bg_path = get_option('qcld_woo_chatbot_board_bg_path');
                                                                                        } else {
                                                                                            $qcld_woo_chatbot_board_bg_path = '';
                                                                                        }
                                                                                        ?>
                                                              <input type="hidden" name="qcld_woo_chatbot_board_bg_path"
                                                                                               id="qcld_woo_chatbot_board_bg_path"
                                                                                               value="<?php echo $qcld_woo_chatbot_board_bg_path; ?>"/>
                                                              <button type="button" class="qcld_woo_chatbot_board_bg_button button">
                                                              <?php _e('Upload  background.', 'woochatbot'); ?>
                                                              </button>
                                                            </div>
                                                          </div>
                                                          <!--                                    col-xs-6-->
                                                          <div class="col-xs-6">
                                                            <p class="woo-chatbot-settings-instruction">
                                                              <?php _e('Custom message board background', 'woochatbot'); ?>
                                                            </p>
                                                            <img id="qcld_woo_chatbot_board_bg_image" style="height:100%;width:100%"
                                                                                         src="<?php echo $qcld_woo_chatbot_board_bg_path; ?>"
                                                                                         alt=""></div>
                                                        </div>
                                                    </div>      


                                            </div>
                                        </div>


                                    </div>
                                </section>
                                <section id="section-flip-7">
                                    <div class="top-section">
                                        <div class="row">
                                            <div class="col-xs-12" id="woo-chatbot-language-section">
                                                <p class="qc-opt-title-font"> <?php _e('Message setting for', 'woochatbot'); ?> <strong><?php _e('Identity', 'woochatbot'); ?> </strong ></p>

                                                <div class="form-group">
                                                    <p class="qc-opt-title-font"><?php _e('Your Company or Website Name', 'woochatbot'); ?></p>
                                                    <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_host" value="<?php echo(get_option('qlcd_woo_chatbot_host')!=''? get_option('qlcd_woo_chatbot_host') :'Our Store');?>">
                                                </div>
                                                <div class="form-group">
                                                    <p class="qc-opt-title-font"><?php _e('Agent name', 'woochatbot'); ?></p>
                                                    <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_agent" value="<?php echo(get_option('qlcd_woo_chatbot_agent')!=''? get_option('qlcd_woo_chatbot_agent') :'Carrie');?>">
                                                </div>
                                                <div class="form-group">
                                                    <p class="qc-opt-title-font"><?php _e('has joined the conversation', 'woochatbot'); ?></p>
                                                    <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_agent_join" value="<?php echo(get_option('qlcd_woo_chatbot_agent_join')!=''? get_option('qlcd_woo_chatbot_agent_join') :'has joined the conversation');?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12" id="woo-chatbot-language-section">
                                                <p class="qc-opt-title-font"> <?php _e('Message setting for', 'woochatbot'); ?> <strong><?php _e('Greetings', 'woochatbot'); ?>: </strong ></p>
                                                <div class="form-group">
                                                    <p class="qc-opt-title-font"><?php _e('Welcome to ', 'woochatbot'); ?></p>
                                                    <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_welcome" value="<?php echo(get_option('qlcd_woo_chatbot_welcome')!=''? get_option('qlcd_woo_chatbot_welcome') :'Welcome to ');?>">
                                                </div>

                                                <div class="form-group">
                                                    <p class="qc-opt-title-font"><?php _e('Hi There! May I know your name?', 'woochatbot'); ?></p>
                                                    <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_asking_name" value="<?php echo(get_option('qlcd_woo_chatbot_asking_name')!=''? get_option('qlcd_woo_chatbot_asking_name') :'Hi There! May I know your name?');?>">
                                                </div>
                                                <div class="form-group">
                                                    <p class="qc-opt-title-font"><?php _e('I am ', 'woochatbot'); ?> </p>
                                                    <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_i_am" value="<?php echo(get_option('qlcd_woo_chatbot_i_am')!=''? get_option('qlcd_woo_chatbot_i_am') :'I am ');?>">
                                                </div>

                                                <div class="form-group">
                                                    <p class="qc-opt-title-font"><?php _e('Nice to meet you', 'woochatbot'); ?></p>
                                                    <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_name_greeting" value="<?php echo(get_option('qlcd_woo_chatbot_name_greeting')!=''? get_option('qlcd_woo_chatbot_name_greeting') :'Nice to meet you');?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="top-section">
                                        <div class="row">
                                            <div class="col-xs-12" id="woo-chatbot-language-section">
                                                <p class="qc-opt-title-font"><?php _e('Message settings for', 'woochatbot'); ?> <strong> <?php _e('Editor Box', 'woochatbot'); ?>:</strong ></p>
                                                <div class="form-group">
                                                <p class="qc-opt-dcs-font"><?php _e('Conversations with', 'woochatbot'); ?></p>
                                                <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_conversations_with" value="<?php echo(get_option('qlcd_woo_chatbot_conversations_with')!=''? get_option('qlcd_woo_chatbot_conversations_with') :'Conversations with');?>">
                                            </div>
                                                
                                                
                                                
                                            <div class="form-group">
                                                <p class="qc-opt-dcs-font"><?php _e('is typing...', 'woochatbot'); ?></p>
                                                <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_is_typing" value="<?php echo(get_option('qlcd_woo_chatbot_is_typing')!=''? get_option('qlcd_woo_chatbot_is_typing') :'is typing...');?>">
                                            </div>
                                            
                                             <div class="form-group">
                                                <p class="qc-opt-dcs-font"><?php _e('Send a message', 'woochatbot'); ?></p>
                                                <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_send_a_msg" value="<?php echo(get_option('qlcd_woo_chatbot_send_a_msg')!=''? get_option('qlcd_woo_chatbot_send_a_msg') :'Send a message');?>">
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="top-section">
                                        <div class="row">
                                            <div class="col-xs-12" id="woo-chatbot-language-section">
                                                <p class="qc-opt-title-font"><?php _e('Message settings for', 'woochatbot'); ?> <strong> <?php _e('Products Search', 'woochatbot'); ?>:</strong ></p>
                                            <div class="form-group">
                                                <p class="qc-opt-dcs-font"><?php _e('I am here to find you the product you need. What are you shopping for', 'woochatbot'); ?> </p>
                                                <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_product_asking" value="<?php echo(get_option('qlcd_woo_chatbot_product_asking')!=''? get_option('qlcd_woo_chatbot_product_asking') :'I am here to find you the product you need. What are you shopping for');?>">
                                            </div>
                                            <div class="form-group">
                                                <p class="qc-opt-dcs-font"><?php _e('if products found', 'woochatbot'); ?>: </p>
                                                <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_product_success" value="<?php echo(get_option('qlcd_woo_chatbot_product_success')!=''? get_option('qlcd_woo_chatbot_product_success') :'Great! We have these products.');?>">
                                            </div>

                                            <div class="form-group">
                                                <p class="qc-opt-dcs-font"><?php _e('If no matching products is found', 'woochatbot'); ?>: </p>
                                                <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_product_fail" value="<?php echo(get_option('qlcd_woo_chatbot_product_fail')!=''? get_option('qlcd_woo_chatbot_product_fail') :'Oops! Nothing matches your criteria ');?>">
                                            </div>
                                             <div class="form-group">
                                                <p class="qc-opt-dcs-font"><?php _e('You can browse our extensive catalog. Just pick a category from below', 'woochatbot'); ?>:</p>
                                                <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_product_suggest" value="<?php echo(get_option('qlcd_woo_chatbot_product_suggest')!=''? get_option('qlcd_woo_chatbot_product_suggest') :'You can browse our extensive catalog. Just pick a category from below:');?>">
                                            </div>
                                             <div class="form-group">
                                                <p class="qc-opt-dcs-font"><?php _e('Too many choices? Let\'s try another search term', 'woochatbot'); ?></p>
                                                <input type="text" class="form-control qc-opt-dcs-font" name="qlcd_woo_chatbot_product_infinite" value="<?php echo(get_option('qlcd_woo_chatbot_product_infinite')!=''? get_option('qlcd_woo_chatbot_product_infinite') :"Too many choices? Let's try another search term");?>">
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </section>
                                <section id="section-flip-8">
                                    <div class="top-section">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <p class="qc-opt-dcs-font"><?php _e('You can paste or write your custom css here.', 'woochatbot'); ?></p>
                                                <textarea name="woo_chatbot_custom_css"
                                                          class="form-control woo-chatbot-custom-css"
                                                          cols="10"
                                                          rows="8"><?php echo get_option('woo_chatbot_custom_css'); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section id="section-flip-9">
                                    <div class="top-section">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="bargain-bot-wrapper">
                                                    <img src="<?php echo QCLD_WOOCHATBOT_IMG_URL; ?>/bargain-bot-free.png" alt="Bargain Bot">
                                                <h3><?php _e('Bargain Bot for WooCommerce', 'woochatbot'); ?></h3>
                                                <p><?php _e('Allow shoppers to Make Their Offer Now with a Bargaining ChatBot. Win more customers with smart price negotiations. Allow your customers to make an offer on your price and bargain. The ChatBot will Negotiate to more than a minimum price set by you. Capture shoppers while they have a high intent to purchase.', 'woochatbot'); ?></p>
                                                <p><a href="<?php echo esc_url('https://wordpress.org/plugins/bargain/'); ?>" target="_blank"> <b> <?php _e('Download Bargain bot Free', 'woochatbot'); ?></b></a> | <a href="<?php echo esc_url('https://www.quantumcloud.com/products/bargain-bot/'); ?>" target="_blank"> <b> <?php _e('Download Bargain bot Pro', 'woochatbot'); ?></b></a></p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </section>
								
								<section id="section-flip-15">
								  <div class="top-section">
									<div class="row">
									  <div class="col-xs-12">

										
									<?php wp_enqueue_style( 'qcpd-google-font-lato', 'https://fonts.googleapis.com/css?family=Lato' ); ?>
									<?php wp_enqueue_style( 'qcpd-style-addon-page', QCLD_WOOCHATBOT_PLUGIN_URL.'qc-support-promo-page/css/style.css' ); ?>
									<?php wp_enqueue_style( 'qcpd-style-responsive-addon-page', QCLD_WOOCHATBOT_PLUGIN_URL.'qc-support-promo-page/css/responsive.css' ); ?>
									
							<div class="qc_support_container" style="background-color:#fff;border:none;"><!--qc_support_container-->

							<div class="qc_tabcontent clearfix-div">
							<div class="qc-row">
								<div class="wpbot-chatbot-pro-link">
									<a href="https://www.quantumcloud.com/products/woocommerce-chatbot-woowbot/" target="_blank" >Get the WoowBot Pro <img src="<?php echo esc_url(QCLD_WOOCHATBOT_PLUGIN_URL.'images/icon-256x256.jpg'); ?>" /></a>
								</div>
								<h2 class="plugin-title wpbot_page_title" >Extend <a href="https://www.quantumcloud.com/products/woocommerce-chatbot-woowbot/" target="_blank">WoowBot Pro</a> and give it more Super Powers</h2>
								
								
								
								<div class="qc-column-6"><!-- qc-column-4 -->
									<!-- Feature Box 1 -->
									<div class="support-block support-block-custom">
										<div class="support-block-img">
											<a href="<?php echo esc_url('https://www.quantumcloud.com/products/chatbot-addons/'); ?>" target="_blank"> <img src="<?php echo esc_url(QCLD_WOOCHATBOT_PLUGIN_URL.'images/messenger-chatbot.png'); ?>" alt=""></a>
										</div>
										<div class="support-block-info">
											<h4><a href="<?php echo esc_url('https://www.quantumcloud.com/products/chatbot-addons/'); ?>" target="_blank">Messenger ChatBot Addon</a></h4>
											<p>Utilize the WPBot on your website as a hub to respond to customer questions on FB Page & Messenger</p>

										</div>
									</div>
								</div><!--/qc-column-4 -->
								
								<div class="qc-column-6"><!-- qc-column-4 -->
									<!-- Feature Box 1 -->
									<div class="support-block support-block-custom">
										<div class="support-block-img">
											<a href="<?php echo esc_url('https://www.quantumcloud.com/products/chatbot-addons/'); ?>" target="_blank"> <img src="<?php echo esc_url(QCLD_WOOCHATBOT_PLUGIN_URL.'images/custom-post-type-addon-logo.png'); ?>" alt=""></a>
										</div>
										<div class="support-block-info">
											<h4><a href="<?php echo esc_url('https://www.quantumcloud.com/products/chatbot-addons/'); ?>" target="_blank">Extended Search</a></h4>
											<p>Extend WPBot’s search power to include almost any Custom Post Type including WooCommerce</p>

										</div>
									</div>
								</div><!--/qc-column-4 -->
								
								<div class="qc-column-6"><!-- qc-column-4 -->
									<!-- Feature Box 1 -->
									<div class="support-block support-block-custom">
										<div class="support-block-img">
											<a href="<?php echo esc_url('https://www.quantumcloud.com/products/chatbot-addons/'); ?>" target="_blank"> <img src="<?php echo esc_url(QCLD_WOOCHATBOT_PLUGIN_URL.'images/chatbot-sesssion-save.png'); ?>" alt=""></a>
										</div>
										<div class="support-block-info">
											<h4><a href="<?php echo esc_url('https://www.quantumcloud.com/products/chatbot-addons/'); ?>" target="_blank">ChatBot Session Save Addon</a></h4>
											<p>This AddOn saves the user chat sessions and helps you fine tune the bot for better support and performance.</p>

										</div>
									</div>
								</div><!--/qc-column-4 -->
								
								
								<div class="qc-column-6"><!-- qc-column-4 -->
									<!-- Feature Box 1 -->
									<div class="support-block support-block-custom">
										<div class="support-block-img">
											<a href="<?php echo esc_url('https://www.quantumcloud.com/products/chatbot-addons/'); ?>" target="_blank"> <img src="<?php echo esc_url(QCLD_WOOCHATBOT_PLUGIN_URL.'images/WPBot-LiveChat.png'); ?>" alt=""></a>
										</div>
										<div class="support-block-info">
											<h4><a href="<?php echo esc_url('https://www.quantumcloud.com/products/chatbot-addons/'); ?>" target="_blank">LiveChat Addon</a></h4>
											<p>Live Human Chat integrated with WPBot<p/>
										</div>
									</div>
								</div><!--/qc-column-4 -->

								<div class="qc-column-6"><!-- qc-column-4 -->
									<!-- Feature Box 1 -->
									<div class="support-block support-block-custom">
										<div class="support-block-img">
											<a href="<?php echo esc_url('https://www.quantumcloud.com/products/chatbot-addons/'); ?>" target="_blank"> <img src="<?php echo esc_url(QCLD_WOOCHATBOT_PLUGIN_URL.'images/white-label.png'); ?>" alt=""></a>
										</div>
										<div class="support-block-info">
											<h4><a href="<?php echo esc_url('https://www.quantumcloud.com/products/chatbot-addons/'); ?>" target="_blank">White Label WPBot</a></h4>
											<p>Replace the QuantumCloud Logo and branding with yours. Suitable for developers and agencies interested in providing ChatBot services for their clients.<p/>
										</div>
									</div>
								</div><!--/qc-column-4 -->
								
								<div class="qc-column-6"><!-- qc-column-4 -->
									<!-- Feature Box 1 -->
									<div class="support-block support-block-custom">
										<div class="support-block-img">
											<a href="<?php echo esc_url('https://www.quantumcloud.com/products/chatbot-addons/'); ?>" target="_blank"> <img src="<?php echo esc_url(QCLD_WOOCHATBOT_PLUGIN_URL.'images/mailing-list-integrationt.png'); ?>" alt=""></a>
										</div>
										<div class="support-block-info">
											<h4><a href="<?php echo esc_url('https://www.quantumcloud.com/products/chatbot-addons/'); ?>" target="_blank">Mailing List Integration AddOn</a></h4>
											<p>Mailing List Integration is the ChatBot addon that lets you connect with your Mailchimp and Zapier accounts. You can add new subscribers to your Mailchimp Lists from the ChatBot and unsubscribe them. You can also create new Zap on your Zapier Account and connect with this addon.<p/>
										</div>
									</div>
								</div><!--/qc-column-4 -->
								<!--<div class="qc-column-12">
									<div style="text-align:center;font-size: 26px;">and <span style="font-size:50px"><a href="<?php echo esc_url('https://www.quantumcloud.com/products/chatbot-addons/'); ?>" target="_blank">More..</a></span></div>
								</div>-->
								<div class="qc-column-12"><!-- qc-column-4 -->
									<!-- Feature Box 1 -->
									<div class="support-block ">
										<div class="support-block-img">
											<a href="<?php echo esc_url('https://www.quantumcloud.com/products/themes/woowbot-theme/'); ?>" target="_blank"> <img class="wp_addon_fullwidth" src="<?php echo esc_url(QCLD_WOOCHATBOT_PLUGIN_URL.'images/ChatBot-Master-theme.png'); ?>" alt=""></a>
										</div>
										<div class="support-block-info">
											<h4><a href="<?php echo esc_url('https://www.quantumcloud.com/products/chatbot-addons/'); ?>" target="_blank">WoowBot Master Theme</a></h4>
											<p style="margin-top: -18px;">Get a WoowBot Powered Theme!</p>
										</div>
									</div>
								</div><!--/qc-column-4 -->
								

							</div>
							<!--qc row-->
							</div>

							</div><!--qc_support_container-->
										
										
									  </div>
									</div>
									<!--                                row--> 
								  </div>
								</section>
								
                            </div><!-- /content -->
                        </div><!-- /woo-chatbot-tabs -->
                        <hr>
                        <div class="text-right">
                            <input type="submit" class="btn btn-primary submit-button" name="submit"
                                   id="submit" value="<?php _e('Save Settings', 'woo_chatbot'); ?>"/>
                        </div>
                    </section>
                </div>


                <?php wp_nonce_field('woo_chatbot'); ?>
            </form>


        </div>


        <?php

    }

    function qcld_woo_chatbot_save_options()
    {


        global $woocommerce;
        if (isset($_POST['_wpnonce']) && $_POST['_wpnonce']) {


            wp_verify_nonce($_POST['_wpnonce'], 'woo_chatbot');


            // Check if the form is submitted or not

            if (isset($_POST['submit'])) {

                //WoowBoticon position settings.
                if (isset($_POST["woo_chatbot_position_x"])) {
                    $woo_chatbot_position_x = stripslashes(($_POST["woo_chatbot_position_x"]));
                    update_option('woo_chatbot_position_x', $woo_chatbot_position_x);
                }
                if (isset($_POST["woo_chatbot_position_y"])) {
                    $woo_chatbot_position_y = stripslashes(($_POST["woo_chatbot_position_y"]));
                    update_option('woo_chatbot_position_y', $woo_chatbot_position_y);
                }
                //Enable or disable WoowBot
                if (isset($_POST["disable_woo_chatbot"])) {
                    $disable_woo_chatbot = $_POST["disable_woo_chatbot"] ? $_POST["disable_woo_chatbot"] : '';
                    update_option('disable_woo_chatbot', stripslashes($disable_woo_chatbot));
                }else{
                    update_option('disable_woo_chatbot', '');

                }

                //Enable or disable on mobile device
                if (isset($_POST["disable_woo_chatbot_on_mobile"])) {
                $disable_woo_chatbot_on_mobile = $_POST["disable_woo_chatbot_on_mobile"] ? $_POST["disable_woo_chatbot_on_mobile"] : '';
                update_option('disable_woo_chatbot_on_mobile', stripslashes($disable_woo_chatbot_on_mobile));
                }else{
                update_option('disable_woo_chatbot_on_mobile', '');

                }
                //Product per page settings.
                if (isset($_POST["qlcd_woo_chatbot_ppp"])) {
                    $qlcd_woo_chatbot_ppp = $_POST["qlcd_woo_chatbot_ppp"];
                    update_option('qlcd_woo_chatbot_ppp', intval($qlcd_woo_chatbot_ppp));
                }
                //WoowBot icon settings.
                    $woo_chatbot_icon = $_POST['woo_chatbot_icon'] ? $_POST['woo_chatbot_icon'] : 'icon-1.png';
                    update_option('woo_chatbot_icon', sanitize_text_field($woo_chatbot_icon));
                // upload custom WoowBot icon

                if ($_FILES['custom_icon']['tmp_name'] != "") {

                    $pic = 'custom.png';
                    $img_path = QCLD_WOOCHATBOT_IMG_ABSOLUTE_PATH . '/' . $pic;

                    $pic_loc = $_FILES['custom_icon']['tmp_name'];


                    if (move_uploaded_file($pic_loc, $img_path)) {
                        update_option('woo_chatbot_icon', $pic);
                        ?>
                        <script> alert('successfully uploaded');</script><?php
                    } else {
                        ?>
                        <script> alert('error while uploading file');</script><?php
                    }


                }
                //To override style use custom css.
                $woo_chatbot_custom_css = $_POST["woo_chatbot_custom_css"];
                update_option('woo_chatbot_custom_css', stripslashes($woo_chatbot_custom_css));

                /****Language center settings.   ****/
                //identity
                $qlcd_woo_chatbot_host = $_POST["qlcd_woo_chatbot_host"];
                update_option('qlcd_woo_chatbot_host', sanitize_text_field($qlcd_woo_chatbot_host));

                $qlcd_woo_chatbot_agent = $_POST["qlcd_woo_chatbot_agent"];
                update_option('qlcd_woo_chatbot_agent', sanitize_text_field($qlcd_woo_chatbot_agent));

                $qlcd_woo_chatbot_agent_join = $_POST["qlcd_woo_chatbot_agent_join"];
                update_option('qlcd_woo_chatbot_agent_join', sanitize_text_field($qlcd_woo_chatbot_agent_join));

              //Greeting.
                $qlcd_woo_chatbot_welcome = $_POST["qlcd_woo_chatbot_welcome"];
                update_option('qlcd_woo_chatbot_welcome', sanitize_text_field($qlcd_woo_chatbot_welcome));

                $qlcd_woo_chatbot_asking_name = $_POST["qlcd_woo_chatbot_asking_name"];
                update_option('qlcd_woo_chatbot_asking_name', sanitize_text_field($qlcd_woo_chatbot_asking_name));

                $qlcd_woo_chatbot_name_greeting = $_POST["qlcd_woo_chatbot_name_greeting"];
                update_option('qlcd_woo_chatbot_name_greeting', sanitize_text_field($qlcd_woo_chatbot_name_greeting));

                $qlcd_woo_chatbot_i_am = $_POST["qlcd_woo_chatbot_i_am"];
                update_option('qlcd_woo_chatbot_i_am', sanitize_text_field($qlcd_woo_chatbot_i_am));

                //Products search .
                if (isset($_POST["qlcd_woo_chatbot_product_success"])) {
                    $qlcd_woo_chatbot_product_success = $_POST["qlcd_woo_chatbot_product_success"];
                    update_option('qlcd_woo_chatbot_product_success', sanitize_text_field($qlcd_woo_chatbot_product_success));
                }
                if (isset($_POST["qlcd_woo_chatbot_product_fail"])) {
                    $qlcd_woo_chatbot_product_fail = $_POST["qlcd_woo_chatbot_product_fail"];
                    update_option('qlcd_woo_chatbot_product_fail', sanitize_text_field($qlcd_woo_chatbot_product_fail));
                }
                $qlcd_woo_chatbot_product_asking = $_POST["qlcd_woo_chatbot_product_asking"];
                update_option('qlcd_woo_chatbot_product_asking', sanitize_text_field($qlcd_woo_chatbot_product_asking));

                $qlcd_woo_chatbot_product_suggest = $_POST["qlcd_woo_chatbot_product_suggest"];
                update_option('qlcd_woo_chatbot_product_suggest', sanitize_text_field($qlcd_woo_chatbot_product_suggest));

                $qlcd_woo_chatbot_product_infinite = str_replace('\\', '', $_POST["qlcd_woo_chatbot_product_infinite"]); 
                update_option('qlcd_woo_chatbot_product_infinite', sanitize_text_field($qlcd_woo_chatbot_product_infinite));
				
				$qlcd_woo_chatbot_conversations_with = $_POST["qlcd_woo_chatbot_conversations_with"];
                update_option('qlcd_woo_chatbot_conversations_with', sanitize_text_field($qlcd_woo_chatbot_conversations_with));
				
				
				$qlcd_woo_chatbot_is_typing = $_POST["qlcd_woo_chatbot_is_typing"];
                update_option('qlcd_woo_chatbot_is_typing', sanitize_text_field($qlcd_woo_chatbot_is_typing));
				
				$qlcd_woo_chatbot_send_a_msg = $_POST["qlcd_woo_chatbot_send_a_msg"];
                update_option('qlcd_woo_chatbot_send_a_msg', sanitize_text_field($qlcd_woo_chatbot_send_a_msg));


                //Theme custom background option
                if(isset( $_POST["qcld_woo_chatbot_change_bg"])) {
                    $qcld_woo_chatbot_change_bg = $_POST["qcld_woo_chatbot_change_bg"];
                }else{$qcld_woo_chatbot_change_bg='';}
                update_option('qcld_woo_chatbot_change_bg', stripslashes($qcld_woo_chatbot_change_bg));

                $qcld_woo_chatbot_board_bg_path = $_POST["qcld_woo_chatbot_board_bg_path"];
                update_option('qcld_woo_chatbot_board_bg_path', stripslashes($qcld_woo_chatbot_board_bg_path));

            }
        }
    }
    /**
     * Display Notifications on specific criteria.
     *
     * @since    2.14
     */
    public static function woocommerce_inactive_notice_for_woo_chatbot()
    {
        if (current_user_can('activate_plugins')) :
            if (!class_exists('WooCommerce')) :
                deactivate_plugins(plugin_basename(__FILE__));
                ?>
                <div id="message" class="error">
                    <p>
                        <?php
                        printf(
                            __('%s WoowBot for WooCommerce REQUIRES WooCommerce%s %sWooCommerce%s must be active for WoowBot to work. Please install & activate WooCommerce.', 'woo_chatbot'),
                            '<strong>',
                            '</strong><br>',
                            '<a href="http://wordpress.org/extend/plugins/woocommerce/" target="_blank" >',
                            '</a>'
                        );
                        ?>
                    </p>
                </div>
                <?php
            elseif (version_compare(get_option('woocommerce_db_version'), QCLD_WOOCHATBOT_REQUIRED_WOOCOMMERCE_VERSION, '<')) :
                ?>
                <div id="message" class="error">
                    <!--<p style="float: right; color: #9A9A9A; font-size: 13px; font-style: italic;">For more information <a href="http://cxthemes.com/plugins/update-notice.html" target="_blank" style="color: inheret;">click here</a></p>-->
                    <p>
                        <?php
                        printf(
                            __('%WoowBot for WooCommerce is inactive%s This version of WoowBot requires WooCommerce %s or newer. For more information about our WooCommerce version support %sclick here%s.', 'woo_chatbot'),
                            '<strong>',
                            '</strong><br>',
                            QCLD_WOOCHATBOT_REQUIRED_WOOCOMMERCE_VERSION
                        );
                        ?>
                    </p>
                    <div style="clear:both;"></div>
                </div>
                <?php
            endif;
        endif;
    }



}

/**
 * Instantiate plugin.
 *
 */

if (!function_exists('qcld_woo_chatboot_plugin_init')) {
    function qcld_woo_chatboot_plugin_init()
    {

        global $qcld_woo_chatbot;

        $qcld_woo_chatbot = QCLD_Woo_Chatbot::qcld_woo_chatbot_get_instance();
    }
}
add_action('plugins_loaded', 'qcld_woo_chatboot_plugin_init');

/*
* Initial Options will be insert as defualt data
*/
register_activation_hook(__FILE__, 'qcld_woo_chatboot_defualt_options');
function qcld_woo_chatboot_defualt_options(){
    if(!get_option('woo_chatbot_position_x')){
        update_option('woo_chatbot_position_x', intval(50));
    }
    if(!get_option('woo_chatbot_position_y')) {
        update_option('woo_chatbot_position_y', intval(50));
    }
    if(!get_option('qlcd_woo_chatbot_ppp')){
        update_option('qlcd_woo_chatbot_ppp', intval(10));
    }
    if(!get_option('disable_woo_chatbot')){
        update_option('disable_woo_chatbot', '');
    }
    if(!get_option('disable_woo_chatbot_on_mobile')) {
        update_option('disable_woo_chatbot_on_mobile', '');
    }
    if(!get_option('woo_chatbot_icon')) {
        update_option('woo_chatbot_icon', sanitize_text_field('icon-0.png'));
    }
    if(!get_option('qlcd_woo_chatbot_host')) {
        update_option('qlcd_woo_chatbot_host', sanitize_text_field('Our Store'));
    }
    if(!get_option('qlcd_woo_chatbot_agent')) {
        update_option('qlcd_woo_chatbot_agent', sanitize_text_field('Carrie'));
    }
    if(!get_option('qlcd_woo_chatbot_agent_join')) {
        update_option('qlcd_woo_chatbot_agent_join', sanitize_text_field('has joined the conversation'));
    }
    if(!get_option('qlcd_woo_chatbot_welcome')) {
        update_option('qlcd_woo_chatbot_welcome', sanitize_text_field('Welcome to'));
    }
    if(!get_option('qlcd_woo_chatbot_asking_name')) {
        update_option('qlcd_woo_chatbot_asking_name', sanitize_text_field('May I know your name?!'));
    }
    if(!get_option('qlcd_woo_chatbot_name_greeting')) {
        update_option('qlcd_woo_chatbot_name_greeting', sanitize_text_field('Nice to meet you'));
    }
    if(!get_option('qlcd_woo_chatbot_i_am')) {
        update_option('qlcd_woo_chatbot_i_am', sanitize_text_field('I am!'));
    }
    if(!get_option('qlcd_woo_chatbot_product_success')) {
        update_option('qlcd_woo_chatbot_product_success', sanitize_text_field('Great! We have these products.'));
    }
    if(!get_option('qlcd_woo_chatbot_product_fail')) {
        update_option('qlcd_woo_chatbot_product_fail', sanitize_text_field('Oops! Nothing matches your criteria'));
    }
    if(!get_option('qlcd_woo_chatbot_product_asking')) {
        update_option('qlcd_woo_chatbot_product_asking', sanitize_text_field('I am here to find you the product you need. What are you shopping for?'));
    }
    if(!get_option('qlcd_woo_chatbot_product_suggest')) {
        update_option('qlcd_woo_chatbot_product_suggest', sanitize_text_field('You can browse our extensive catalog. Just pick a category from below:'));
    }
    if(!get_option('qlcd_woo_chatbot_product_infinite')) {
        update_option('qlcd_woo_chatbot_product_infinite', sanitize_text_field('Too many choices? Lets try another search term'));
    }
	if(!get_option('qlcd_woo_chatbot_conversations_with')) {
        update_option('qlcd_woo_chatbot_conversations_with', sanitize_text_field('Conversations with'));
    }
	if(!get_option('qlcd_woo_chatbot_is_typing')) {
        update_option('qlcd_woo_chatbot_is_typing', sanitize_text_field('is typing...'));
    }
	if(!get_option('qlcd_woo_chatbot_send_a_msg')) {
        update_option('qlcd_woo_chatbot_send_a_msg', sanitize_text_field('Send a message'));
    }
	
}

/**
 *
 * Function to load translation files.
 *
 */

function woo_chatbot_lang_init() {
    load_plugin_textdomain( 'woochatbot', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
}

add_action( 'plugins_loaded', 'woo_chatbot_lang_init' );
//Blink
function qcld_chatbot_options_instructions_example() {
    global $my_admin_page;
    $screen = get_current_screen();


   if ( is_admin() && ($screen->parent_base == 'woowbot') ) {
        ?>
       <style>
           i.woobot_btn {
               width: 60px !important;
               background-size: 60px 20px;
               background-repeat: no-repeat;
           }
           .woowbot_info_carousel {
               padding:10px;
               width: 100%;
               margin-left: 15px;
           }
           
           .woowbot_info_carousel .slick-next {
                right: 0px;
            }
           .woowbot-notice {
               background: #9b8fd8;
               color: #fff;
           }

           .woowbot-notice {
               border-left-color: #f50029;
           }

           .notice-dismiss {
                top: 1px;
                right: -6px;
            }
       </style>
       <!--  <div class="notice notice-info is-dismissible woowbot-notice" style="display:none;width: 1270px;"> -->
        <div class="notice notice-info is-dismissible woowbot-notice" style="display:none;width: 1170px;">
            <div class="woowbot_info_carousel">

                <div class="woowbot_info_item">**Pro Tip: Want to make WoowBot Really intelligent with <strong style="color: yellow">AI and Natural Language Processing?</strong> Upgrade to the Pro version  </div>

                <div class="woowbot_info_item">**Pro Tip: WoowBot Pro is fully integrated with <strong style="color: yellow">Google's DialogFlow AI and Machine Learning</strong> </div>

                <div class="woowbot_info_item">**Pro Tip: Create  <strong style="color: yellow">Custom Intents and Rich Message</strong> Responses from Dialogflow with WoowBot Pro version.</div>

                <div class="woowbot_info_item">**Pro Tip: Are your customers adding products to the cart but not completing order and losing you money? Find out with the <strong style="color: yellow">Customer Conversion report</strong> in the Pro version .</div>

                <div class="woowbot_info_item">**Pro Tip: <strong style="color: yellow">Schedule WoowBot Pro</strong> to run only outside of your normal business hours. Use WoowBot with another Live Chat service!</div>

                <div class="woowbot_info_item">**Pro Tip: Use <strong style="color: yellow">Facebook Messenger</strong> for Live chat support with WoowBot Pro. Integration is easy!</div>

                <div class="woowbot_info_item">**Pro Tip: Utilize Onsite Retargeting for <strong style="color: yellow">Exit Intent or Scroll down Popups</strong> with WoowBot Pro. Increase sales by 50% or more!</div>

                <div class="woowbot_info_item">**Pro Tip: Setting up WoowBot pro is easy and quick! It's all <strong style="color: yellow">Plug and Play</strong>. No complex bot training required! </div>

                <div class="woowbot_info_item">**Pro Tip: WoowBot pro integrates with <strong style="color: yellow">Skype, Whatsapp, Viber, Facebook, eMail</strong> and more to give your customers the support they deserve. Increase customer satisfaction! </div>
            </div>
            <script>
                jQuery(document).ready(function($){
                    $('.woowbot-notice').show();
                    $('.woowbot_info_carousel').slick({
                        dots: false,
                        infinite: true,
                        speed: 1200,
                        slidesToShow: 1,
                        autoplaySpeed: 11000,
                        autoplay: true,
                        slidesToScroll: 1,

                    });
                });
            </script>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'qcld_chatbot_options_instructions_example',100 );

if( is_admin() ){
    require_once("class-plugin-deactivate-feedback.php");
    $wowbot_feedback = new Wp_Usage_Feedback( __FILE__, 'plugins@quantumcloud.com', false, true );
}