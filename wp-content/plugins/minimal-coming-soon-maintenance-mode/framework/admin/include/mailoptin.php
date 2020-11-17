<?php

if (!defined('WPINC')) {
	die;
}

function csmm_mailoptin_settings($signals_csmm_options){
    global $wpdb;
    if(csmm_is_mailoptin_active()){
        $mailoptin_campaigns = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'mo_optin_campaigns');

        echo '<label for="signals_csmm_mailoptin_campaign" class="signals-strong">MailOptin Campaign:</label>';
        if (empty($mailoptin_campaigns)) {
          echo '<p><a href="' . admin_url('admin.php?page=mailoptin-optin-campaigns') . '">Create your first optin</a> to start collecting leads and subscribers via in-content optins or popups.</p>';
        } else {
          echo '<select name="signals_csmm_mailoptin_campaign" id="signals_csmm_mailoptin_campaign">';
          echo '<option value="0">Select Campaign</option>';
          foreach($mailoptin_campaigns as $mailoptin_campaign) {
            if ($mailoptin_campaign->optin_type == 'lightbox') {
              $type = 'lightbox optin';
            } else {
              $type = 'content optin';
            }
            echo '<option value="'.$mailoptin_campaign->id.'" '.($signals_csmm_options['mailoptin_campaign'] == $mailoptin_campaign->id?'selected':'').'>'.$mailoptin_campaign->name . ' - ' . $type . '</option>';
          } // foreach
        echo '</select>';
        echo '<p class="signals-form-help-block">Create, edit and manage optins on the <a href="' . admin_url('admin.php?page=mailoptin-optin-campaigns') . '">MailOptin campaigns page</a>. Lightbox optins are more prominent but some users find them annoying. Content box optins tend to generate leads of higher quality.</p>';
        }
    } else {
        echo '<p class="signals-form-help-block"><a href="#" class="button button-primary open-mailoptin-upsell">Enable the free MailOptin plugin</a> to start creating in-content optin forms and popup optins. MailOptin is fully integrated into Coming Soon pages and offers numerous customization options.</p>';
    }

    // mailoptin install dialog
    echo '<div id="csmm-mailoptin-upsell-dialog" style="display: none;" title="MailOptin"><span class="ui-helper-hidden-accessible"><input type="text"/></span>';
    echo '<div style="padding: 20px; font-size: 14px;">';
    echo '<ul class="normal-list">';
    echo '<li>completely free plugin that integrates into Coming Soon pages</li>';
    echo '<li>instantly start collecting leads &amp; subscribers</li>';
    echo '<li>use an in-content optin form</li>';
    echo '<li>or try a popup/lightbox optin</li>';
    echo '<li>easily connect with numerous leading autoresponder services</li>';
    echo '<li>completely customize the look &amp; feel of the optin form</li>';
    echo '</ul>';
    echo '<p class="upsell-footer"><a class="button button-primary" id="install-mailoptin">Install &amp; activate MailOptin to start collecting leads</a></p>';
    echo '</div>';
    echo '</div>'; // mailoptin install dialog
}


function csmm_is_mailoptin_active() {
    if ( ! function_exists( 'is_plugin_active' ) || ! function_exists( 'get_plugin_data' )) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    if(is_plugin_active('mailoptin/mailoptin.php')){
        $mailoptin_info = get_plugin_data(ABSPATH.'wp-content/plugins/mailoptin/mailoptin.php');
        if(version_compare($mailoptin_info['Version'],'1.2.10.1','<')){
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }

}

function csmm_install_mailoptin() {
    $plugin_slug = 'mailoptin/mailoptin.php';
    $plugin_zip = 'https://downloads.wordpress.org/plugin/mailoptin.latest-stable.zip';

    @include_once ABSPATH . 'wp-admin/includes/plugin.php';
    @include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    @include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
    @include_once ABSPATH . 'wp-admin/includes/file.php';
    @include_once ABSPATH . 'wp-admin/includes/misc.php';
		echo '<style>
		body{
			font-family: sans-serif;
			font-size: 14px;
			line-height: 1.5;
			color: #444;
		}
		</style>';

    echo '<div style="margin: 20px; color:#444;">';
    echo 'If things are not done in a minute <a target="_parent" href="' . admin_url('plugin-install.php?s=mailoptin&tab=search&type=term') .'">install the plugin manually via Plugins page</a><br><br>';
    echo 'Starting ...<br><br>';

    wp_cache_flush();
    $upgrader = new Plugin_Upgrader();
    echo 'Check if MailOptin is already installed ... <br />';
    if (csmm_is_plugin_installed($plugin_slug)) {
      echo 'MailOptin is already installed! <br /><br />Making sure it\'s the latest version.<br />';
      $upgrader->upgrade($plugin_slug);
      $installed = true;
    } else {
      echo 'Installing MailOptin.<br />';
      $installed = $upgrader->install($plugin_zip);
    }
    wp_cache_flush();

    if (!is_wp_error($installed) && $installed) {
      echo 'Activating MailOptin.<br />';
      $activate = activate_plugin($plugin_slug);

      if (is_null($activate)) {
        echo 'MailOptin Activated.<br />';
        echo '<script>setTimeout(function() { top.location = "options-general.php?page=maintenance_mode_options"; }, 800);</script>';
        echo '<br>If you are not redirected in a few seconds - <a href="options-general.php?page=maintenance_mode_options" target="_parent">click here</a>.';
      }
    } else {
      echo 'Could not install MailOptin. You\'ll have to <a target="_parent" href="' . admin_url('plugin-install.php?s=mailoptin&tab=search&type=term') .'">download and install manually</a>.';
    }

    echo '</div>';
  } // replace


