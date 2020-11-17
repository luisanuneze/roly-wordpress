<?php 
/* create SFSI widget */
class Sfsi_Plus_Widget extends WP_Widget 
{
	function __construct()
	{
        $widget_ops = array( 'classname' => 'sfsi_plus', 'description' => 'Ultimate Social Media PLUS widgets');
        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'sfsi-plus-widget' );
        
		parent::__construct(
			// Base ID of your widget
			'sfsi-plus-widget', 
	
			// Widget name will appear in UI
			'Ultimate Social Media PLUS', 
	
			// Widget description
			$widget_ops,
			
			$control_ops
		);
	}
	
	function widget( $args, $instance )
	{
		$before_title = isset($args["before_title"])?$args["before_title"]:'';
		$after_title = isset($args["after_title"])?$args["after_title"]:'';
		$before_widget = isset($args["before_widget"])?$args["before_widget"]:'';
		$after_widget = isset($args["after_widget"])?$args["after_widget"]:'';
		//if show via widget is checked
		$sfsi_plus_section8_options = get_option("sfsi_plus_section8_options");
		$sfsi_plus_section8_options = unserialize($sfsi_plus_section8_options);
		$sfsi_plus_show_via_widget = $sfsi_plus_section8_options['sfsi_plus_show_via_widget'];
		if($sfsi_plus_show_via_widget == "yes")
		{
			/*Our variables from the widget settings. */
			$title = apply_filters('widget_title', $instance['title'] );
			$show_info = isset( $instance['show_info'] ) ? $instance['show_info'] : false;
			global $is_floter;	      
			echo $before_widget;
			/* Display the widget title */
			if ( $title ) echo $before_title . $title . $after_title;
			?>
			<div class="sfsi_plus_widget" data-position="widget">
			    <div id='sfsi_plus_wDiv'></div>
			    <?php 
					/* Link the main icons function */
				 	echo sfsi_plus_check_visiblity(0);
				?>
			    <div style="clear: both;"></div>
			</div>
			<?php
			if ( is_active_widget( false, false, $this->id_base, true ) ) { }
				echo $after_widget;
		}
		else
		{
			//echo 'Kindly go to setting page and check the option "show them via a widget"';
		}
	}
	
	/*Update the widget */ 
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		if($new_instance['showf']==0)
		{
		    $instance['showf']=1;
		}
		else
		{
		     $instance['showf']=0;
		}
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}
	
	/* Set up some default widget settings. */
	function form( $instance )
	{
		$defaults = array( 'title' =>"" );
		$instance = wp_parse_args( (array) $instance, $defaults );
		if(isset($instance['showf']))
		{
			if( $instance['showf'] == 0 && empty($instance['title']))
			{
				$instance['title']='Please follow & like us :)';
			}
			else
			{
				$instance['title'];
			}
		}
		else
		{
			$instance['title']='Please follow & like us :)';
		}
		?>
<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>">
        <?php _e('Title', SFSI_PLUS_DOMAIN); ?>:
    </label>
    <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>"
        value="<?php echo $instance['title']; ?>" style="width:100%;" />
    <input type="hidden" value="<?php echo isset($instance['showf'])?$instance['showf']:''; ?>"
        id="<?php echo $this->get_field_id( 'showf' ); ?>" name="<?php echo $this->get_field_name( 'showf' ); ?>" />
</p>
<p>
    <?php	_e('Please go to the plugin page to set your preferences:',SFSI_PLUS_DOMAIN); ?>
    <a href="admin.php?page=sfsi-plus-options"><?php _e('Click here', SFSI_PLUS_DOMAIN); ?></a>
</p>
<?php
	}
}
/* END OF widget Class */

/* register widget to wordpress */
function register_sfsi_plus_widgets()
{
    register_widget( 'sfsi_plus_widget' );
}
add_action( 'widgets_init', 'register_sfsi_plus_widgets' );

/* check the icons visiblity  */
function sfsi_plus_check_visiblity($isFloter=0,$share_url=null,$container_position='absolute',$shortcode_listener=true)
{
  	global $wpdb;
    /* Access the saved settings in database  */
    $sfsi_plus_section1_options =  unserialize(get_option('sfsi_plus_section1_options',false));
    $sfsi_section3 = unserialize(get_option('sfsi_plus_section3_options',false));
    $sfsi_section5 = unserialize(get_option('sfsi_plus_section5_options',false));
	//options that are added on the third question
	$sfsi_section8 = unserialize(get_option('sfsi_plus_section8_options',false));
	   
    /* calculate the width and icons display alignments */
    $icons_space = $sfsi_section5['sfsi_plus_icons_spacing'];
    $icons_size = $sfsi_section5['sfsi_plus_icons_size'];
    $icons_per_row = ($sfsi_section5['sfsi_plus_icons_perRow'])? $sfsi_section5['sfsi_plus_icons_perRow'] : '';
    $icons_alignment = $sfsi_section5['sfsi_plus_icons_Alignment'];
	$position = 'position:absolute;';
    $position1 = 'position:'.$container_position.';';
    $jquery='<script>';
	
	// $jquery .= 'jQuery(".sfsi_plus_widget").each(function( index ) {
	// 				if(jQuery(this).attr("data-position") == "widget")
	// 				{
	// 					var wdgt_hght = jQuery(this).children(".sfsiplus_norm_row.sfsi_plus_wDiv").height();
	// 					var title_hght = jQuery(this).parent(".widget.sfsi_plus").children(".widget-title").height();
	// 					var totl_hght = parseInt( title_hght ) + parseInt( wdgt_hght );
	// 					jQuery(this).parent(".widget.sfsi_plus").css("min-height", totl_hght+"px");
	// 				}
    //             });';
    if($shortcode_listener):
    ?>
	<script>
	window.addEventListener('sfsi_plus_functions_loaded', function() {
	    if (typeof sfsi_plus_widget_set == 'function') {
	        sfsi_plus_widget_set();
	    }
	})
	</script>
	<?php
	endif;
	/* check if icons shuffling is activated in admin or not */
    if($sfsi_section5['sfsi_plus_icons_stick']=="yes")
	{
	    if(is_admin_bar_showing())
		{
		    $Ictop="30px";
	    }
	    else
		{
			$Ictop="0";   
	    }
         $jquery.='window.addEventListener("sfsi_plus_functions_loaded",function(){window.sfsi_plsu_s = jQuery(".sfsi_plus_widget");
					var pos = window.sfsi_plsu_s.position();            
					jQuery(window).scroll(function(){      
					sfsi_plus_stick_widget("'.$Ictop.'");
		 }); })';
    }
	
    /* check if icons floating  is activated in admin */
	/*settings under third question*/
    if($sfsi_section8['sfsi_plus_float_on_page']=="yes")
	{
         $top="15";
         //switch($sfsi_section5['sfsi_plus_icons_floatPosition'])
		 switch($sfsi_section8['sfsi_plus_float_page_position'])
		 {
			case "top-left" :
				if(is_admin_bar_showing())
				{
					$position.="position:absolute;left:30px;top:35px;"; $top="35";
				}
				else
				{
					$position.="position:absolute;left:10px;top:2%"; $top="10";
				}                                                
             break;
             case "top-right" :
			 	if(is_admin_bar_showing())
				{
					$position.="position:absolute;right:30px;top:35px;"; $top="35";
				}else
				{
					$position.="position:absolute;right:10px;top:2%"; $top="10";
				}                       
             break;
             case "center-right" :
				 $position.="position:absolute;right:30px;top:50%"; $top="center";
             break;
             case "center-left" :
			 	$position.="position:absolute;left:30px;top:50%"; $top="center";  
             break;
             case "bottom-right" :
			 	$position.="position:absolute;right:30px;bottom:0px"; $top="bottom"; 
             break;
             case "bottom-left" :
			 	$position.="position:absolute;left:30px;bottom:0px"; $top="bottom"; 
             break;
             case "center-top" :
				if(is_admin_bar_showing())
				{
					$position .= "left:50%;top:35px;"; $top="35";
				}
				else
				{
					$position .= "left:50%;top:10px;"; $top="10";
				} 
			 break;
			 case "center-bottom" :
				$position .= "left:50%;bottom:0px"; $top="bottom";  
			 break;
         }
       	 if($sfsi_section8['sfsi_plus_float_page_position'] == 'center-right' || $sfsi_section8['sfsi_plus_float_page_position'] == 'center-left')
		 {
        	$jquery.="window.addEventListener('sfsi_plus_functions_loaded',function( totwith=".(isset($totwith)?$totwith:0)." )
					  {
						var topalign = ( jQuery(window).height() - jQuery('#sfsi_plus_floater').height() ) / 2;
						jQuery('#sfsi_plus_floater').css('top',topalign);
					  	sfsi_plus_float_widget('".$top."');
					  });";
		 }
		 else
		 {
			$jquery.="window.addEventListener('sfsi_plus_functions_loaded',function( totwith=".(isset($totwith)?$totwith:0)." ) { sfsi_plus_float_widget('".$top."')});"; 
		 }
    }
	  
    $extra=0;
    if($sfsi_section3['sfsi_plus_shuffle_icons']=="yes")
    {
       if($sfsi_section3['sfsi_plus_shuffle_Firstload']=="yes" && $sfsi_section3['sfsi_plus_shuffle_interval']=="yes")
	   {
	     	$shuffle_time=(isset($sfsi_section3['sfsi_plus_shuffle_intervalTime'])) ? $sfsi_section3['sfsi_plus_shuffle_intervalTime'] : 3;
			$shuffle_time=$shuffle_time*1000;
			$jquery.="window.addEventListener('sfsi_plus_functions_loaded',function( totwith=".(isset($totwith)?$totwith:0)." ) {  jQuery('.sfsi_plus_wDiv').each(function(){ new window.Manipulator( jQuery(this)); });  setTimeout(function(){  jQuery('#sfsi_plus_wDiv').each(function(){ jQuery(this).click(); })},2000);  setInterval(function(){  jQuery('#sfsi_plus_wDiv').each(function(){ jQuery(this).click(); })},".$shuffle_time."); });";
       }
	   else if($sfsi_section3['sfsi_plus_shuffle_Firstload']=="no" && $sfsi_section3['sfsi_plus_shuffle_interval']=="yes")
       {   
		   $shuffle_time=(isset($sfsi_section3['sfsi_plus_shuffle_intervalTime'])) ? $sfsi_section3['sfsi_plus_shuffle_intervalTime'] : 3;
		   $shuffle_time=$shuffle_time*1000; 
		   $jquery.="window.addEventListener('sfsi_plus_functions_loaded',function( totwith=".(isset($totwith)?$totwith:0)." ) {  jQuery('.sfsi_plus_wDiv').each(function(){ new window.Manipulator( jQuery(this)); });  setInterval(function(){  jQuery('#sfsi_plus_wDiv').each(function(){ jQuery(this).click(); })},".$shuffle_time."); });";
        }
        else
        {
            $jquery.="window.addEventListener('sfsi_plus_functions_loaded',function( totwith=".(isset($totwith)?$totwith:0)." ) {  jQuery('.sfsi_plus_wDiv').each(function(){ new window.Manipulator( jQuery(this)); });  setTimeout(function(){  jQuery('#sfsi_plus_wDiv').each(function(){ jQuery(this).click(); })},2000); });";
        }    
    }
	    
   	/* magnage the icons in saved order in admin */ 
   	$custom_icons_order = unserialize($sfsi_section5['sfsi_plus_CustomIcons_order']);
   	$icons_list = array();
   	if(isset($sfsi_plus_section1_options['sfsi_custom_files'])){
   		if(is_string($sfsi_plus_section1_options['sfsi_custom_files'])){
   			$icons_list= unserialize($sfsi_plus_section1_options['sfsi_custom_files']);
   		}else{
   			$icons_list= $sfsi_plus_section1_options['sfsi_custom_files'];
   		}
   	}
   	if(!isset($sfsi_plus_section5_options['sfsi_plus_houzzIcon_order'])){
   		$sfsi_plus_section5_options['sfsi_plus_houzzIcon_order']=11;
   	}
   	if(!isset($sfsi_plus_section5_options['sfsi_plus_okIcon_order'])){
   		$sfsi_plus_section5_options['sfsi_plus_okIcon_order']=22;
   	}
   	if(!isset($sfsi_plus_section5_options['sfsi_plus_telegramIcon_order'])){
   		$sfsi_plus_section5_options['sfsi_plus_telegramIcon_order']=23;
   	}
   	if(!isset($sfsi_plus_section5_options['sfsi_plus_vkIcon_order'])){
   		$sfsi_plus_section5_options['sfsi_plus_vkIcon_order']=24;
   	}
   	if(!isset($sfsi_plus_section5_options['sfsi_plus_wechatIcon_order'])){
   		$sfsi_plus_section5_options['sfsi_plus_wechatIcon_order']=26;
   	}
   	if(!isset($sfsi_plus_section5_options['sfsi_plus_weiboIcon_order'])){
   		$sfsi_plus_section5_options['sfsi_plus_weiboIcon_order']=25;
   	}
   
//    $icons_list = (isset($sfsi_plus_section1_options['sfsi_custom_files']))?(!is_string($sfsi_plus_section1_options['sfsi_custom_files'])?unserialize($sfsi_plus_section1_options['sfsi_custom_files'],false):$sfsi_plus_section1_options['sfsi_custom_files']):(array());
   	$icons_order = array(
		'0' => '',
		$sfsi_section5['sfsi_plus_rssIcon_order']=>'rss',
		$sfsi_section5['sfsi_plus_emailIcon_order']=>'email',
		$sfsi_section5['sfsi_plus_facebookIcon_order']=>'facebook',
		$sfsi_section5['sfsi_plus_twitterIcon_order']=>'twitter',
		$sfsi_section5['sfsi_plus_youtubeIcon_order']=>'youtube',
		$sfsi_section5['sfsi_plus_pinterestIcon_order']=>'pinterest',
		$sfsi_section5['sfsi_plus_linkedinIcon_order']=>'linkedin',
		$sfsi_section5['sfsi_plus_instagramIcon_order']=>'instagram',
		$sfsi_section5['sfsi_plus_houzzIcon_order']=>'houzz',
		$sfsi_section5['sfsi_plus_okIcon_order']=>'ok',
		$sfsi_section5['sfsi_plus_telegramIcon_order']=>'telegram',
		$sfsi_section5['sfsi_plus_vkIcon_order']=>'vk',
		$sfsi_section5['sfsi_plus_wechatIcon_order']=>'wechat',
		$sfsi_section5['sfsi_plus_weiboIcon_order']=>'weibo'
	);
   	if(!is_array($custom_icons_order)){
  		$custom_icons_order = array();
  	}
  	$max_custom_icon_order=max(array_keys($icons_order));
  	if(is_array($icons_list)){
	  	foreach($icons_list as $index=>$icon){
			if(false===array_search($index, array_column($custom_icons_order, 'ele'))){
				array_push($custom_icons_order,array('order'=>($max_custom_icon_order+count($custom_icons_order)),'ele'=>$index));
			}
		}
	}
   	if(is_array($custom_icons_order) ) 
   	{
		foreach($custom_icons_order as $data)
		{
		   $icons_order[$data['order']] = $data;
		}
   	}

   	ksort($icons_order);
   	/* calculate the total width of widget according to icons  */
   	if(!empty($icons_per_row))
   	{
		$width = ((int)$icons_space+(int)$icons_size)*(int)$icons_per_row;
		$main_width = $width=$width+$extra;
		$main_width = $main_width."px";
   	}
	
    /* built the main widget div */
    $icons_main='<div class="sfsiplus_norm_row sfsi_plus_wDiv"  style="'.(isset($main_width)?'width:'.$main_width.';'.$position1:'').';text-align:'.$icons_alignment.'">';
	$icons="";
	// var_dump($icons_order);
    /* loop through icons and bulit the icons with all settings applied in admin */
	foreach($icons_order  as $index => $icn)
	{
		// var_dump($icn);
		if(is_array($icn))
		{
			$icon_arry=$icn; $icn="custom" ;
		} 
		switch ($icn)
		{
			case 'rss' :  if($sfsi_plus_section1_options['sfsi_plus_rss_display']=='yes')  $icons.= sfsi_plus_prepairIcons('rss',0,"no",null,$share_url);  
			break;
			case 'email' :   if($sfsi_plus_section1_options['sfsi_plus_email_display']=='yes')   $icons.= sfsi_plus_prepairIcons('email',0,"no",null,$share_url); 
			break;
			case 'facebook' :  if($sfsi_plus_section1_options['sfsi_plus_facebook_display']=='yes') $icons.= sfsi_plus_prepairIcons('facebook',0,"no",null,$share_url);
			break;
			
			case 'twitter' :  if($sfsi_plus_section1_options['sfsi_plus_twitter_display']=='yes')    $icons.= sfsi_plus_prepairIcons('twitter',0,"no",null,$share_url); 
			break;
			case 'youtube' :  if($sfsi_plus_section1_options['sfsi_plus_youtube_display']=='yes')     $icons.= sfsi_plus_prepairIcons('youtube',0,"no",null,$share_url); 
			break;
			case 'pinterest' :   if($sfsi_plus_section1_options['sfsi_plus_pinterest_display']=='yes')     $icons.= sfsi_plus_prepairIcons('pinterest',0,"no",null,$share_url);
			break;
			case 'linkedin' :  if($sfsi_plus_section1_options['sfsi_plus_linkedin_display']=='yes')    $icons.= sfsi_plus_prepairIcons('linkedin',0,"no",null,$share_url); 
			break;
			case 'instagram' :  if($sfsi_plus_section1_options['sfsi_plus_instagram_display']=='yes')    $icons.= sfsi_plus_prepairIcons('instagram',0,"no",null,$share_url); 
			break;
			case 'houzz' :
				if(
					isset($sfsi_plus_section1_options['sfsi_plus_houzz_display']) &&
					$sfsi_plus_section1_options['sfsi_plus_houzz_display'] == 'yes'
				)
				{
					$icons.= sfsi_plus_prepairIcons('houzz',0,"no",null,$share_url);
				}
			break;
			case 'ok' :
				if(isset($sfsi_plus_section1_options['sfsi_plus_ok_display']) && $sfsi_plus_section1_options['sfsi_plus_ok_display']=='yes') {
					$icons.= sfsi_plus_prepairIcons('ok',0,"no",null,$share_url); 
				}
			break;
            case 'telegram' :  if(isset($sfsi_plus_section1_options['sfsi_plus_telegram_display']) && $sfsi_plus_section1_options['sfsi_plus_telegram_display']=='yes')     $icons.= sfsi_plus_prepairIcons('telegram',0,"no",null,$share_url); 
			break;
			case 'vk' :  if(isset($sfsi_plus_section1_options['sfsi_plus_vk_display']) && $sfsi_plus_section1_options['sfsi_plus_vk_display']=='yes')     $icons.= sfsi_plus_prepairIcons('vk',0,"no",null,$share_url); 
			break;
			case 'weibo' :  if(isset($sfsi_plus_section1_options['sfsi_plus_weibo_display']) && $sfsi_plus_section1_options['sfsi_plus_weibo_display']=='yes')     $icons.= sfsi_plus_prepairIcons('weibo',0,"no",null,$share_url); 
			break;
			
			case 'wechat' :  if(isset($sfsi_plus_section1_options['sfsi_plus_wechat_display']) && $sfsi_plus_section1_options['sfsi_plus_wechat_display']=='yes')     $icons.= sfsi_plus_prepairIcons('wechat',0,"no",null,$share_url); 
			break;			
			case 'custom' : $icons.= sfsi_plus_prepairIcons($icon_arry['ele'],0,"no",null,$share_url); 
			break;    
		}
	}

    $jquery.="</script>";
    $icons.='</div >';

	$width = isset($width) && !empty($width) ? $width : 0;

    $margin= $width+11;

    $icons_main.=$icons.'<div id="sfsi_holder" class="sfsi_plus_holders" style="position: relative; float: left;width:100%;z-index:-1;"></div >'.$jquery;
    /* if floating of icons is active create a floater div */
    $icons_float='';
	if($sfsi_section8['sfsi_plus_float_on_page']=="yes" && $isFloter==1)
    {
		if($sfsi_section8['sfsi_plus_float_page_position'] == "top-left")
		{
			$styleMargin = "margin-top:".$sfsi_section8['sfsi_plus_icons_floatMargin_top']."px;margin-left:".$sfsi_section8['sfsi_plus_icons_floatMargin_left']."px;";
		}
		elseif($sfsi_section8['sfsi_plus_float_page_position'] == "top-right")
		{
			$styleMargin = "margin-top:".$sfsi_section8['sfsi_plus_icons_floatMargin_top']."px;margin-right:".$sfsi_section8['sfsi_plus_icons_floatMargin_right']."px;";
		}
		elseif($sfsi_section8['sfsi_plus_float_page_position'] == "center-left")
		{
			$styleMargin = "margin-left:".$sfsi_section8['sfsi_plus_icons_floatMargin_left']."px;";
		}
		elseif($sfsi_section8['sfsi_plus_float_page_position'] == "center-right")
		{
			$styleMargin = "margin-right:".$sfsi_section8['sfsi_plus_icons_floatMargin_right']."px;";
		}
		elseif($sfsi_section8['sfsi_plus_float_page_position'] == "bottom-left")
		{
			$styleMargin = "margin-bottom:".$sfsi_section8['sfsi_plus_icons_floatMargin_bottom']."px;margin-left:".$sfsi_section8['sfsi_plus_icons_floatMargin_left']."px;";
		}
		elseif($sfsi_section8['sfsi_plus_float_page_position'] == "bottom-right")
		{
			$styleMargin = "margin-bottom:".$sfsi_section8['sfsi_plus_icons_floatMargin_bottom']."px;margin-right:".$sfsi_section8['sfsi_plus_icons_floatMargin_right']."px;";
		}
		
		if(!isset($styleMargin)){
			$styleMargin = "";
		}
		
		// $icons_float = '<style >#sfsi_plus_floater { '.$styleMargin.' }</style>';
		add_action('wp_footer',function()use($styleMargin){
			echo '<script>var css = "#sfsi_plus_floater { '.$styleMargin.' }",
				    head = document.head || document.getElementsByTagName("head")[0],
				    style = document.createElement("style");

				head.appendChild(style);
				if (style.styleSheet){
				  // This is required for IE8 and below.
				  style.styleSheet.cssText = css;
				} else {
				  style.appendChild(document.createTextNode(css));
				}</script>';
		},100);
		$icons_float .= '<div class="sfsiplus_norm_row sfsi_plus_wDiv" id="sfsi_plus_floater"  style="z-index: 9999;width:'.$width.'px;text-align:'.$icons_alignment.';'.$position.'">';
	  	$icons_float .= $icons;
	  	$icons_float .= "<input type='hidden' id='sfsi_plus_floater_sec' value='".$sfsi_section8['sfsi_plus_float_page_position']."' />";
	  	$icons_float .= $jquery;
	 	return $icons_float; exit;
    }
    $icons_data=$icons_main.$icons_float;
    return $icons_data;
}
/* make all icons with saved settings in admin */
function sfsi_plus_prepairIcons($icon_name,$is_front=0, $onpost="no", $fromPost = NULL,$share_url=null)
{  
    global $wpdb; global $socialObj; global $post;
    $mouse_hover_effect = ''; 
    $active_theme = 'official';
    $sfsi_plus_shuffle_Firstload = 'no';
    $sfsi_plus_display_counts = "no";
    $icon = '';
    $url = '';
    $alt_text = '';
    $new_window = '';
    $class = '';
    /* access  all saved settings in admin */
    $sfsi_plus_section1_options = unserialize(get_option('sfsi_plus_section1_options',false));
    $sfsi_plus_section2_options = unserialize(get_option('sfsi_plus_section2_options',false));
    $sfsi_plus_section3_options = unserialize(get_option('sfsi_plus_section3_options',false));
    $sfsi_plus_section4_options = unserialize(get_option('sfsi_plus_section4_options',false));
    $sfsi_plus_section5_options = unserialize(get_option('sfsi_plus_section5_options',false));
    $sfsi_plus_section6_options = unserialize(get_option('sfsi_plus_section6_options',false));
    $sfsi_plus_section7_options = unserialize(get_option('sfsi_plus_section7_options',false));
	$sfsi_plus_section8_options = unserialize(get_option('sfsi_plus_section8_options',false));
	 /* get active theme */
     $border_radius = '';
     $active_theme = $sfsi_plus_section3_options['sfsi_plus_actvite_theme'];
    
    
    /* shuffle effect */   
    if($sfsi_plus_section3_options['sfsi_plus_shuffle_icons']=='yes')
	{
	    $sfsi_plus_shuffle_Firstload=$sfsi_plus_section3_options["sfsi_plus_shuffle_Firstload"];
        if($sfsi_plus_section3_options["sfsi_plus_shuffle_interval"]=="yes")
		{
            $sfsi_plus_shuffle_interval = $sfsi_plus_section3_options["sfsi_plus_shuffle_intervalTime"];
        }
    }
     /* define the main url for icon access */ 
     $icons_baseUrl = SFSI_PLUS_PLUGURL."images/icons_theme/".$active_theme."/";
     $visit_iconsUrl = SFSI_PLUS_PLUGURL."images/visit_icons/";   
     $share_iconsUrl = SFSI_PLUS_PLUGURL."images/share_icons/"; 
     $hoverSHow = 0;
   	// var_dump($icons_baseUrl,$visit_iconsUrl);die();
   	/* check is icon is a custom icon or default icon */  
   	if(is_numeric($icon_name)) { $icon_n=$icon_name; $icon_name="custom" ; } 
    $counts='';
    $twit_tolCls = "";
    $twt_margin = "";
    $icons_space = $sfsi_plus_section5_options['sfsi_plus_icons_spacing'];
    $padding_top = '';

    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";
    $option3 = unserialize(get_option('sfsi_plus_section3_options',false));

    if(isset($option3['sfsi_plus_actvite_theme']) && !empty($option3['sfsi_plus_actvite_theme'])){

        $active_theme = $option3['sfsi_plus_actvite_theme'];
    }else{
    	$active_theme = "default";
    }
    $glossy_theme_adjustment=0;
	//$current_url = $scheme.'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	if(null!==$share_url){
		$current_url = $share_url;
	}elseif($fromPost == 'yes' && !empty($post))
	{
		$current_url = get_permalink($post->ID);
	}
	else
	{
		//$current_url = $scheme.'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$current_url = sfsi_plus_get_current_url();
	}
	$url = "#";
    $cmcls='';
    $toolClass = '';
	$icons_language = $sfsi_plus_section5_options['sfsi_plus_icons_language'];
	switch($icon_name)
    {
		
		
        case "rss" :
			 $socialObj = new sfsi_plus_SocialHelper(); /* global object to access 3rd party icon's actions */	
		     $url = ($sfsi_plus_section2_options['sfsi_plus_rss_url'])? $sfsi_plus_section2_options['sfsi_plus_rss_url'] : 'javascript:void(0);';
             $toolClass = "rss_tool_bdr";
		     $hoverdiv = '';
		     $arsfsiplus_row_class = "bot_rss_arow";
		     
			 /* fecth no of counts if active in admin section */
			 if($sfsi_plus_section4_options['sfsi_plus_rss_countsDisplay']=="yes" &&
			  $sfsi_plus_section4_options['sfsi_plus_display_counts']=="yes" &&
			  $sfsi_plus_section4_options['sfsi_plus_round_counts']=="yes" 

			  )
			 {
				 $counts=$socialObj->format_num($sfsi_plus_section4_options['sfsi_plus_rss_manualCounts']);
			 }
			 
			 if(!empty($sfsi_plus_section5_options['sfsi_plus_rss_MouseOverText'])) 
			 {	
			 	$alt_text = $sfsi_plus_section5_options['sfsi_plus_rss_MouseOverText'];
			 }
			 else
			 {
				 $alt_text = 'RSS';
			 }
			 
			 //Custom Skin Support {Monad}	 
			 if($active_theme == 'custom_support')
			 {
				 if(get_option("plus_rss_skin"))
				 {
					$icon = get_option("plus_rss_skin");
				 }
				 else
				 {
					$active_theme = 'default';
					$icons_baseUrl = SFSI_PLUS_PLUGURL."images/icons_theme/default/";
					$icon = $icons_baseUrl.$active_theme."_rss.png"; 
				 }
			 }
			 else
			 {
				$icon = $icons_baseUrl.$active_theme."_rss.png";
			 }		 
        break;
        
		case "email" :
			   $socialObj = new sfsi_plus_SocialHelper();  /* global object to access 3rd party icon's actions */	
			   $hoverdiv = '';
			   $sfsi_plus_section2_options['sfsi_plus_email_url'];
			   $url = (isset($sfsi_plus_section2_options['sfsi_plus_email_url'])) ? $sfsi_plus_section2_options['sfsi_plus_email_url'] : 'https://follow.it/now';
			   $toolClass = "email_tool_bdr";
		       $arsfsiplus_row_class = "bot_eamil_arow";
		       
			/* fecth no of counts if active in admin section */
			if($sfsi_plus_section4_options['sfsi_plus_email_countsDisplay']=="yes" &&
			 $sfsi_plus_section4_options['sfsi_plus_display_counts']=="yes" &&
			 $sfsi_plus_section4_options['sfsi_plus_round_counts']=="yes" 
			 )
			{
				if($sfsi_plus_section4_options['sfsi_plus_email_countsFrom']=="manual")
				{    
				 	$counts=$socialObj->format_num($sfsi_plus_section4_options['sfsi_plus_email_manualCounts']);
			   	}
				else
				{
					$counts= $socialObj->SFSI_getFeedSubscriber(sanitize_text_field(get_option('sfsi_plus_feed_id',false)));           
				}  
			}
			   
			if(!empty($sfsi_plus_section5_options['sfsi_plus_email_MouseOverText']))
			{ 
            	$alt_text = $sfsi_plus_section5_options['sfsi_plus_email_MouseOverText'];
			}
			else
			{
			   $alt_text = 'EMAIL';
			}
					  
			//Custom Skin Support {Monad}	 
			if($active_theme == 'custom_support')
			{
				if(get_option("plus_email_skin"))
				{
					$icon = get_option("plus_email_skin");
			 	}
				else
				{
					$active_theme = 'default';
					$icons_baseUrl = SFSI_PLUS_PLUGURL."images/icons_theme/default/";
					//$icon=($sfsi_plus_section2_options['sfsi_plus_rss_icons']=="sfsi") ? $icons_baseUrl.$active_theme."_sf.png" : $icons_baseUrl.$active_theme."_email.png";
					if($sfsi_plus_section2_options['sfsi_plus_rss_icons']=="sfsi")
					{
						$icon = $icons_baseUrl.$active_theme."_sf.png";
					}
					elseif($sfsi_plus_section2_options['sfsi_plus_rss_icons']=="email")
					{
						$icon = $icons_baseUrl.$active_theme."_email.png";
					}
					else
					{
						$icon = $icons_baseUrl.$active_theme."_subscribe.png";
					}
				}
			}
			else
			{
				//$icon=($sfsi_plus_section2_options['sfsi_plus_rss_icons']=="sfsi") ? $icons_baseUrl.$active_theme."_sf.png" : $icons_baseUrl.$active_theme."_email.png";
				if($sfsi_plus_section2_options['sfsi_plus_rss_icons']=="sfsi")
				{
					$icon = $icons_baseUrl.$active_theme."_sf.png";
				}
				elseif($sfsi_plus_section2_options['sfsi_plus_rss_icons']=="email")
				{
					$icon = $icons_baseUrl.$active_theme."_email.png";
				}
				else
				{
					$icon = $icons_baseUrl.$active_theme."_subscribe.png";
				}
			}
        break;
        
		case "facebook" :
			$socialObj = new sfsi_plus_SocialHelper();
			$width = 62;
		    $totwith     = $width+28+$icons_space;
		    $twt_margin = $totwith    /2;
		    $toolClass = "sfsi_plus_fb_tool_bdr";
		    $arsfsiplus_row_class = "bot_fb_arow";
		    
			/* check for the over section */
			if(!empty($sfsi_plus_section5_options['sfsi_plus_facebook_MouseOverText']))
			{
				$alt_text = $sfsi_plus_section5_options['sfsi_plus_facebook_MouseOverText'];
			}
			else
			{
				$alt_text = "FACEBOOK";
			}
			
			$facebook_icons_lang = $sfsi_plus_section5_options['sfsi_plus_facebook_icons_language'];
			// return $facebook_icons_lang;die();wp_die();
		   	$visit_icon = SFSI_PLUS_DOCROOT.'/images/visit_icons/Visit_us_fb/icon_'.$facebook_icons_lang.'.png';
			if(file_exists($visit_icon))
		    {
				$visit_icon = $visit_iconsUrl."Visit_us_fb/icon_".$facebook_icons_lang.".png";
		   }
		   else
		   {
				$visit_icon = $visit_iconsUrl."fb.png";
		   }
			
			//$visit_iconDefault = $visit_iconsUrl."facebook.png";
			
		    
			$url = ($sfsi_plus_section2_options['sfsi_plus_facebookPage_url']) ? $sfsi_plus_section2_options['sfsi_plus_facebookPage_url']:'javascript:void(0);';
            
			if($sfsi_plus_section2_options['sfsi_plus_facebookLike_option']=="yes" || $sfsi_plus_section2_options['sfsi_plus_facebookShare_option']=="yes" )
			{
				 $url=($sfsi_plus_section2_options['sfsi_plus_facebookPage_url']) ? $sfsi_plus_section2_options['sfsi_plus_facebookPage_url']:'javascript:void(0);';
				 $hoverSHow=1;
				 $hoverdiv='';
				 if($sfsi_plus_section2_options['sfsi_plus_facebookPage_option']=="yes")
				 {
					 $hoverdiv.="<div  class='icon1'><a href='".$url."' ".sfsi_plus_checkNewWindow($url)."><img class='sfsi_plus_wicon' alt='".$alt_text."' title='".$alt_text."' src='".$visit_icon."'  /></a></div>";
				 }  
				 if($sfsi_plus_section2_options['sfsi_plus_facebookLike_option']=="yes")
				 {
					 $hoverdiv.="<div  class='icon2'>".$socialObj->sfsi_plus_FBlike($current_url)."</div>";
				 }    
				 if($sfsi_plus_section2_options['sfsi_plus_facebookShare_option']=="yes")
				 {
					 $hoverdiv.="<div  class='icon3'>".$socialObj->sfsiFB_Share($current_url)."</div>";
				 } 
				 
			 }
			 
			 /* fecth no of counts if active in admin section */
			 if(
			 	$fromPost == 'yes' && !empty($post) &&
				$sfsi_plus_section4_options['sfsi_plus_facebook_countsDisplay']=="yes" &&
				$sfsi_plus_section4_options['sfsi_plus_display_counts']=="yes" && 
				$sfsi_plus_section4_options['sfsi_plus_round_counts']=="yes" 
			 )
			{
				$fb_data=$socialObj->sfsi_get_fb($current_url);   
				$counts=$socialObj->format_num($fb_data['total_count']);
				if(empty($counts))
				{
					$counts=(string) "0";
				}
			}
			else
			{
			 	if(
			 	$sfsi_plus_section4_options['sfsi_plus_facebook_countsDisplay']=="yes" &&
				$sfsi_plus_section4_options['sfsi_plus_display_counts']=="yes" &&
				$sfsi_plus_section4_options['sfsi_plus_round_counts']=="yes" 
			 )
			 	{
					 if($sfsi_plus_section4_options['sfsi_plus_facebook_countsFrom']=="manual")
					 {    
						$counts=$socialObj->format_num($sfsi_plus_section4_options['sfsi_plus_facebook_manualCounts']);
					 }
					 else if($sfsi_plus_section4_options['sfsi_plus_facebook_countsFrom']=="likes")
					 {
						 $fb_data=$socialObj->sfsi_get_fb($current_url);   
						 $counts=$socialObj->format_num($fb_data);
						 if(empty($counts))
						 {
						   $counts=(string) "0";
						 }
					 }
					 else if($sfsi_plus_section4_options['sfsi_plus_facebook_countsFrom']=="followers")
					 {
						 $fb_data=$socialObj->sfsi_get_fb($current_url);
						 $counts=$socialObj->format_num($fb_data['share_count']);
						
					 }
					 else if($sfsi_plus_section4_options['sfsi_plus_facebook_countsFrom']=="mypage")
					 {
						 $current_url = $sfsi_plus_section4_options['sfsi_plus_facebook_mypageCounts'];
						 $fb_data=$socialObj->sfsi_get_fb_pagelike($current_url);
						 $counts=$socialObj->format_num($fb_data);
					 }
			 	}
			}
			
			//Custom Skin Support {Monad}	 
			if($active_theme == 'custom_support')
			{
				 if(get_option("plus_facebook_skin"))
				 {
					$icon = get_option("plus_facebook_skin");
				 }
				 else
				 {
					$active_theme = 'default';
					$icons_baseUrl = SFSI_PLUS_PLUGURL."images/icons_theme/default/";
					$icon=$icons_baseUrl.$active_theme."_fb.png";
				 }
			}
			else
			{
				$icon=$icons_baseUrl.$active_theme."_fb.png";
			}		 	
        break;
       
		case "twitter" :
				$toolClass = "sfsi_plus_twt_tool_bdr";
				$arsfsiplus_row_class = "bot_twt_arow";
				$socialObj = new sfsi_plus_SocialHelper();
				$url = ($sfsi_plus_section2_options['sfsi_plus_twitter_pageURL'])?$sfsi_plus_section2_options['sfsi_plus_twitter_pageURL'] : 'javascript:void(0);';
				$twitter_user = $sfsi_plus_section2_options['sfsi_plus_twitter_followUserName'];
				$twitter_text = __($sfsi_plus_section2_options['sfsi_plus_twitter_aboutPageText'],SFSI_PLUS_DOMAIN);
				$width = 59;
				$totwith     = $width+28+$icons_space;
				$twt_margin = $totwith    /2;
             	/* check for icons to display */
		     	$hoverdiv='';
			    
				$twitter_icons_lang = $sfsi_plus_section5_options['sfsi_plus_twitter_icons_language'];
				$visit_icon = SFSI_PLUS_DOCROOT.'/images/visit_icons/Visit_us_twitter/icon_'.$twitter_icons_lang.'.png';
				if(file_exists($visit_icon))
				{
					$visit_icon = $visit_iconsUrl."Visit_us_twitter/icon_".$twitter_icons_lang.".png";
				}
				else
				{
					$visit_icon = $visit_iconsUrl."twitter.png";
				}
				//$visit_icon = $visit_iconsUrl."twitter.png";
				
				if($icons_language == 'nn_NO')
				{
					$icons_language = 'no';
				}
				
				if($sfsi_plus_section2_options['sfsi_plus_twitter_followme']=="yes" || $sfsi_plus_section2_options['sfsi_plus_twitter_aboutPage']=="yes")
				{
					 $hoverSHow=1;
					 //Visit twitter page {Monad}	 
					 if($sfsi_plus_section2_options['sfsi_plus_twitter_page']=="yes")
					 {
						  $hoverdiv.="<style>#sfsi_plus_floater .sfsi_plus_twt_tool_bdr .sfsi_plus_inside{margin-top: -18px;}</style><div  class='cstmicon1'><a href='".$url."' ".sfsi_plus_checkNewWindow($url)."><img class='sfsi_plus_wicon' alt='Visit Us' title='Visit Us' src='".$visit_icon."'  /></a></div>";  
					 }
					 if($sfsi_plus_section2_options['sfsi_plus_twitter_followme']=="yes" && !empty($twitter_user))
					 {
						 $hoverdiv.="<div  class='icon1'>".$socialObj->sfsi_twitterFollow($twitter_user,$icons_language)."</div>";
					 }    
					 if($sfsi_plus_section2_options['sfsi_plus_twitter_aboutPage']=="yes")
					 {
					 	 $hoverdiv.="<div  class='icon2'>".$socialObj->sfsi_twitterShare($current_url,$twitter_text,$icons_language)."</div>";
					 } 
					 
				}
		      	 
				/* fecth no of counts if active in admin section */
				if($sfsi_plus_section4_options['sfsi_plus_twitter_countsDisplay']=="yes" &&
				 $sfsi_plus_section4_options['sfsi_plus_display_counts']=="yes" &&
				 $sfsi_plus_section4_options['sfsi_plus_round_counts']=="yes" 
				 )
				{
					if($sfsi_plus_section4_options['sfsi_plus_twitter_countsFrom']=="manual")
					{    
						$counts=$socialObj->format_num($sfsi_plus_section4_options['sfsi_plus_twitter_manualCounts']);
					}
					else if($sfsi_plus_section4_options['sfsi_plus_twitter_countsFrom']=="source")
					{
						$tw_settings=array('sfsiplus_tw_consumer_key'=>$sfsi_plus_section4_options['sfsiplus_tw_consumer_key'],
										   'sfsiplus_tw_consumer_secret'=> $sfsi_plus_section4_options['sfsiplus_tw_consumer_secret'],
										   'sfsiplus_tw_oauth_access_token'=> $sfsi_plus_section4_options['sfsiplus_tw_oauth_access_token'],
										   'sfsiplus_tw_oauth_access_token_secret'=> $sfsi_plus_section4_options['sfsiplus_tw_oauth_access_token_secret']);
										   
						$followers=$socialObj->sfsi_get_tweets($twitter_user,$tw_settings);
						$counts=$socialObj->format_num($followers);
						 if(empty($counts))
						 {
						   $counts=(string) "0";
						 }
					}
				 } 
                 
				 //Giving alternative text to image 	 
				 if(!empty($sfsi_plus_section5_options['sfsi_plus_twitter_MouseOverText']))
				 {
				 	$alt_text = $sfsi_plus_section5_options['sfsi_plus_twitter_MouseOverText'];
				 }
				 else
				 {
					 $alt_text = "TWITTER"; 
				 }
				 
				//Custom Skin Support {Monad}	 
				if($active_theme == 'custom_support')
				{
					 if(get_option("plus_twitter_skin"))
					 {
						$icon = get_option("plus_twitter_skin");
					 }
					 else
					 {
						$active_theme = 'default';
						$icons_baseUrl = SFSI_PLUS_PLUGURL."images/icons_theme/default/";
						$icon=$icons_baseUrl.$active_theme."_twitter.png";
					 }
				}
				else
				{
					$icon=$icons_baseUrl.$active_theme."_twitter.png";
				}
        break;
        
		case "youtube" :
				$socialObj = new sfsi_plus_SocialHelper();
				$toolClass = "utube_tool_bdr";
				$arsfsiplus_row_class = "bot_utube_arow";
				$socialObj = new sfsi_plus_SocialHelper();
				$width = 96;
				$totwith     = $width+28+$icons_space;
				$twt_margin = $totwith    /2;
				$youtube_user = (isset($sfsi_plus_section4_options['sfsi_plus_youtube_user']) && !empty($sfsi_plus_section4_options['sfsi_plus_youtube_user'])) ? $sfsi_plus_section4_options['sfsi_plus_youtube_user'] : 'follow.it';
				$visit_icon = $visit_iconsUrl."youtube.png";
				
				$url = ($sfsi_plus_section2_options['sfsi_plus_youtube_pageUrl'])? $sfsi_plus_section2_options['sfsi_plus_youtube_pageUrl'] : 'javascript:void(0);';
				
				//Giving alternative text to image
				if(!empty($sfsi_plus_section5_options['sfsi_plus_youtube_MouseOverText']))
				{	
				 	$alt_text = $sfsi_plus_section5_options['sfsi_plus_youtube_MouseOverText'];
				}
				else
				{
					 $alt_text = "YOUTUBE";
				}
				 
				/* check for icons to display */
				$hoverdiv="";
				if($sfsi_plus_section2_options['sfsi_plus_youtube_follow']=="yes" )
				{
					$hoverSHow=1;
					if($sfsi_plus_section2_options['sfsi_plus_youtube_page']=="yes")
					{ 
						  $hoverdiv.="<div  class='icon1'><a href='".$url."'  ".sfsi_plus_checkNewWindow($url)."><img class='sfsi_plus_wicon' alt='".$alt_text."' title='".$alt_text."' src='".$visit_icon."'  /></a></div>";  
					} 
					if($sfsi_plus_section2_options['sfsi_plus_youtube_follow']=="yes")
					{
						 $hoverdiv.="<div  class='icon2'>".$socialObj->sfsi_YouTubeSub($youtube_user)."</div>";
					}    
				 }
                 
				 /* fecth no of counts if active in admin section */  
				 if($sfsi_plus_section4_options['sfsi_plus_youtube_countsDisplay']=="yes" &&
				  $sfsi_plus_section4_options['sfsi_plus_display_counts']=="yes" &&
			  $sfsi_plus_section4_options['sfsi_plus_round_counts']=="yes" 
			  )
                 {
                      if($sfsi_plus_section4_options['sfsi_plus_youtube_countsFrom']=="manual")
                      {    
                         $counts=$socialObj->format_num($sfsi_plus_section4_options['sfsi_plus_youtube_manualCounts']);
                      }
                      else if($sfsi_plus_section4_options['sfsi_plus_youtube_countsFrom']=="subscriber")
                      {
						  	$followers=$socialObj->sfsi_get_youtube($youtube_user);
                             $counts=$socialObj->format_num($followers);
                             if(empty($counts))
							 {
							   $counts=(string) "0";
							 }
                       }
                  }
			
				//Custom Skin Support {Monad}	 
				if($active_theme == 'custom_support')
				{
					 if(get_option("plus_youtube_skin"))
					 {
						$icon = get_option("plus_youtube_skin");
					 }
					 else
					 {
						$active_theme = 'default';
						$icons_baseUrl = SFSI_PLUS_PLUGURL."images/icons_theme/default/";
						$icon = $icons_baseUrl.$active_theme."_youtube.png";
					 }
				}
				else
				{
					$icon = $icons_baseUrl.$active_theme."_youtube.png";
				}	  
       break;
       
	   case "pinterest" :
				$width = 73;
				$totwith     = $width+28+$icons_space;
				$twt_margin = $totwith    /2;
				$socialObj = new sfsi_plus_SocialHelper();			 
				$toolClass = "sfsi_plus_printst_tool_bdr";
				$arsfsiplus_row_class = "bot_pintst_arow";
				
				$pinterest_user 	= 	(isset($sfsi_plus_section4_options['sfsi_plus_pinterest_user']))
											? $sfsi_plus_section4_options['sfsi_plus_pinterest_user'] : '';
				
				$pinterest_board 	= 	(isset($sfsi_plus_section4_options['sfsi_plus_pinterest_board']))
											? $sfsi_plus_section4_options['sfsi_plus_pinterest_board'] : '';
									
				$visit_icon = $visit_iconsUrl."pinterest.png";
				
		        $url = (isset($sfsi_plus_section2_options['sfsi_plus_pinterest_pageUrl'])) ? $sfsi_plus_section2_options['sfsi_plus_pinterest_pageUrl'] : 'javascript:void(0);';
                
				//Giving alternative text to image
				if(!empty($sfsi_plus_section5_options['sfsi_plus_pinterest_MouseOverText']))
				{	
				 	$alt_text = $sfsi_plus_section5_options['sfsi_plus_pinterest_MouseOverText'];
				}
				else
				{
					 $alt_text = "PINTEREST";
				}
				
				/* check for icons to display */  
                $hoverdiv="";
			    if($sfsi_plus_section2_options['sfsi_plus_pinterest_pingBlog']=="yes" )  
			    {
					$hoverSHow=1;
				 	if($sfsi_plus_section2_options['sfsi_plus_pinterest_page']=="yes")
					{
						  $hoverdiv.="<div  class='icon1'><a href='".$url."' ".sfsi_plus_checkNewWindow($url)."><img class='sfsi_plus_wicon' alt='".$alt_text."' title='".$alt_text."' src='".$visit_icon."'  /></a></div>";
					} 
					if($sfsi_plus_section2_options['sfsi_plus_pinterest_pingBlog']=="yes")
					{
						 if($sfsi_plus_section2_options['sfsi_plus_pinterest_pingBlog']=="yes")
						 {
							 $hoverdiv.="<div  class='icon2'>".$socialObj->sfsi_PinIt($current_url)."</div>";
						 }    
					}
			   } 
               
			   /* fecth no of counts if active in admin section */   
				  if($sfsi_plus_section4_options['sfsi_plus_pinterest_countsDisplay']=="yes" &&
				   $sfsi_plus_section4_options['sfsi_plus_display_counts']=="yes" && 
			       $sfsi_plus_section4_options['sfsi_plus_round_counts']=="yes" 
			  )
               {
					 if($sfsi_plus_section4_options['sfsi_plus_pinterest_countsFrom']=="manual")
					 {    
						$counts = $socialObj->format_num($sfsi_plus_section4_options['sfsi_plus_pinterest_manualCounts']);
					 }
					 else if($sfsi_plus_section4_options['sfsi_plus_pinterest_countsFrom']=="pins")
					 {
						$pins=$socialObj->sfsi_get_pinterest($current_url);
						$counts=$pins;
						if(empty($counts))
						{
						   $counts=(string) "0";
						}
					 }
                }
				
				//Custom Skin Support {Monad}	 
				if($active_theme == 'custom_support')
				{
					 if(get_option("plus_pintrest_skin"))
					 {
						$icon = get_option("plus_pintrest_skin");
					 }
					 else
					 {
						$active_theme = 'default';
						$icons_baseUrl = SFSI_PLUS_PLUGURL."images/icons_theme/default/";
						$icon=$icons_baseUrl.$active_theme."_pinterest.png";
					 }
				}
				else
				{
					$icon=$icons_baseUrl.$active_theme."_pinterest.png";
				}	                
        break;
		
		case "instagram" :		 
				$toolClass = "instagram_tool_bdr";
				$arsfsiplus_row_class = "bot_pintst_arow";
				$socialObj = new sfsi_plus_SocialHelper();
				$url = (isset($sfsi_plus_section2_options['sfsi_plus_instagram_pageUrl'])) ? $sfsi_plus_section2_options['sfsi_plus_instagram_pageUrl'] : 'javascript:void(0);';
				$instagram_user_name = $sfsi_plus_section4_options['sfsi_plus_instagram_User'];
				
				//Giving alternative text to image
				if(!empty($sfsi_plus_section5_options['sfsi_plus_instagram_MouseOverText']))
				{	
				 	$alt_text = $sfsi_plus_section5_options['sfsi_plus_instagram_MouseOverText'];
				}
				else
				{
					 $alt_text = "INSTAGRAM";
				}
				     
		     	$hoverdiv="";
                /* fecth no of counts if active in admin section */ 
				if($sfsi_plus_section4_options['sfsi_plus_instagram_countsDisplay']=="yes" &&
				 $sfsi_plus_section4_options['sfsi_plus_display_counts']=="yes" &&
				 $sfsi_plus_section4_options['sfsi_plus_round_counts']=="yes" 
				 )
				{
					if($sfsi_plus_section4_options['sfsi_plus_instagram_countsFrom']=="manual")
					{    
						$counts = $socialObj->format_num($sfsi_plus_section4_options['sfsi_plus_instagram_manualCounts']);
					}
					else if($sfsi_plus_section4_options['sfsi_plus_instagram_countsFrom']=="followers")
					{
						$counts=$socialObj->sfsi_get_instagramFollowers($instagram_user_name);
						if(empty($counts))
						{
						   $counts=(string) "0";
						}
					 }      
				 }
				 
            	//Custom Skin Support {Monad}	 
				if($active_theme == 'custom_support')
				{
					 if(get_option("plus_instagram_skin"))
					 {
						$icon = get_option("plus_instagram_skin");
					 }
					 else
					 {
						$active_theme = 'default';
						$icons_baseUrl = SFSI_PLUS_PLUGURL."images/icons_theme/default/";
						$icon=$icons_baseUrl.$active_theme."_instagram.png";
					 }
				}
				else
				{
					$icon=$icons_baseUrl.$active_theme."_instagram.png";
				}
        break;
        
		case "houzz" :
			 $socialObj = new sfsi_plus_SocialHelper(); /* global object to access 3rd party icon's actions */	
		     $url = ($sfsi_plus_section2_options['sfsi_plus_houzz_pageUrl'])? $sfsi_plus_section2_options['sfsi_plus_houzz_pageUrl'] : 'javascript:void(0);';
             $toolClass = "rss_tool_bdr";
		     $hoverdiv = '';
		     $arsfsiplus_row_class = "bot_rss_arow";
		     
			 /* fecth no of counts if active in admin section */
			 if(
			 	isset($sfsi_plus_section4_options['sfsi_plus_houzz_countsDisplay']) &&
				$sfsi_plus_section4_options['sfsi_plus_houzz_countsDisplay'] == "yes" &&
				$sfsi_plus_section4_options['sfsi_plus_display_counts'] == "yes" &&
				$sfsi_plus_section4_options['sfsi_plus_round_counts']=="yes" 

			 )
			 {
				 $counts=$socialObj->format_num($sfsi_plus_section4_options['sfsi_plus_houzz_manualCounts']);
			 }
			 
			 if(
			 	isset($sfsi_plus_section5_options['sfsi_plus_houzz_MouseOverText']) &&
			 	!empty($sfsi_plus_section5_options['sfsi_plus_houzz_MouseOverText'])
			 )
			 {	
			 	$alt_text = $sfsi_plus_section5_options['sfsi_plus_houzz_MouseOverText'];
			 }
			 else
			 {
				 $alt_text = 'Houzz';
			 }
			 
			 //Custom Skin Support {Monad}	 
			 if($active_theme == 'custom_support')
			 {
				 if(get_option("plus_houzz_skin"))
				 {
					$icon = get_option("plus_houzz_skin");
				 }
				 else
				 {
					$active_theme = 'default';
					$icons_baseUrl = SFSI_PLUS_PLUGURL."images/icons_theme/default/";
					$icon = $icons_baseUrl.$active_theme."_houzz.png"; 
				 }
			 }
			 else
			 {
				$icon = $icons_baseUrl.$active_theme."_houzz.png";
			 }		 
        break;
		
		case "linkedin" :
				$width = 66;
				$socialObj = new sfsi_plus_SocialHelper();		
				$toolClass = "sfsi_plus_linkedin_tool_bdr";
				$arsfsiplus_row_class = "bot_linkedin_arow";                
				$linkedIn_compayId = $sfsi_plus_section2_options['sfsi_plus_linkedin_followCompany'];
				$linkedIn_compay = $sfsi_plus_section2_options['sfsi_plus_linkedin_followCompany']; 
				$linkedIn_ProductId = $sfsi_plus_section2_options['sfsi_plus_linkedin_recommendProductId'];
				$visit_icon = $visit_iconsUrl."linkedIn.png";
				
				/*check for icons to display */     
				$url=($sfsi_plus_section2_options['sfsi_plus_linkedin_pageURL'])? $sfsi_plus_section2_options['sfsi_plus_linkedin_pageURL'] : 'javascript:void(0);';         
		     	
				if($sfsi_plus_section2_options['sfsi_plus_linkedin_follow']=="yes" || $sfsi_plus_section2_options['sfsi_plus_linkedin_SharePage']=="yes" || $sfsi_plus_section2_options['sfsi_plus_linkedin_recommendBusines']=="yes" )
                {
			 		 $hoverSHow=1;
					 $hoverdiv='';
					 if($sfsi_plus_section2_options['sfsi_plus_linkedin_page']=="yes")
					 {
						  $hoverdiv.="<div  class='icon4'><a href='".$url."' ".sfsi_plus_checkNewWindow($url)."><img class='sfsi_plus_wicon' alt='".$alt_text."' title='".$alt_text."' src='".$visit_icon."'  /></a></div>";  
					 } 
					 if($sfsi_plus_section2_options['sfsi_plus_linkedin_follow']=="yes")
					 {
						 $hoverdiv.="<div  class='icon1'>".$socialObj->sfsi_LinkedInFollow($linkedIn_compayId)."</div>";  
					 }    
					 if($sfsi_plus_section2_options['sfsi_plus_linkedin_SharePage']=="yes")
					 {
					 	$linkedIn_icons_lang = isset($option5['sfsi_plus_linkedin_icons_language']) ? $option5['sfsi_plus_linkedin_icons_language'] : 'en_US';
					 	$linkedin_share_icon = SFSI_PLUS_PLUGURL . "images/share_icons/Linkedin_Share/" . $linkedIn_icons_lang . "_share.svg";
					 	// $current_url = $socialObj->sfsi_get_custom_share_link('linkedin');
						$hoverdiv .= "<div  class='icon2'><a href='https://www.linkedin.com/shareArticle?url=" . $current_url . "'><img class='sfsi_premium_wicon' nopin=nopin alt='Share' title='Share' src='" . $linkedin_share_icon . "'  /></a></div>";
						 // $hoverdiv.="<div  class='icon2'>".$socialObj->sfsi_LinkedInShare($current_url)."</div>";  
					 }
					 if($sfsi_plus_section2_options['sfsi_plus_linkedin_recommendBusines']=="yes")
					 {
						 $hoverdiv.="<div  class='icon3'>".$socialObj->sfsi_LinkedInRecommend($linkedIn_compay,$linkedIn_ProductId)."</div>";  
						 $width=99;
					 }
                }
				  
                 
				if($sfsi_plus_section4_options['sfsi_plus_linkedIn_countsDisplay']=="yes" &&
				 $sfsi_plus_section4_options['sfsi_plus_display_counts']=="yes" &&
				 $sfsi_plus_section4_options['sfsi_plus_round_counts']=="yes" 
				 )
				 {
					 if($sfsi_plus_section4_options['sfsi_plus_linkedIn_countsFrom']=="manual")
					 {    
						$counts = $socialObj->format_num($sfsi_plus_section4_options['sfsi_plus_linkedIn_manualCounts']);
					 }
					 else if($sfsi_plus_section4_options['sfsi_plus_linkedIn_countsFrom']=="follower")
					 {
						 $linkedIn_compay=$sfsi_plus_section4_options['sfsi_plus_ln_company'];
						 $ln_settings	= array('sfsi_plus_ln_api_key'=>$sfsi_plus_section4_options['sfsi_plus_ln_api_key'],
										  'sfsi_plus_ln_secret_key'=>$sfsi_plus_section4_options['sfsi_plus_ln_secret_key'],
										  'sfsi_plus_ln_oAuth_user_token'=>$sfsi_plus_section4_options['sfsi_plus_ln_oAuth_user_token']);
										  
						 $followers=$socialObj->sfsi_getlinkedin_follower($linkedIn_compay,$ln_settings);
						 (int) $followers;
						 $counts=$socialObj->format_num($followers);
						 if(empty($counts))
						 {
							$counts = (string) "0";
						 }
					 }
			 	}

		     	$totwith     = $width+28+$icons_space;
		     	$twt_margin = $totwith    /2;
                 
			    //Giving alternative text to image
				if(!empty($sfsi_plus_section5_options['sfsi_plus_linkedIn_MouseOverText']))
				{	
				 	$alt_text = $sfsi_plus_section5_options['sfsi_plus_linkedIn_MouseOverText'];
				}
				else
				{
					 $alt_text = "LINKEDIN";
				}
			    
				//Custom Skin Support {Monad}	  
				if($active_theme == 'custom_support')
				{
					 if(get_option("plus_linkedin_skin"))
					 {
						$icon = get_option("plus_linkedin_skin");
					 }
					 else
					 {
						$active_theme = 'default';
						$icons_baseUrl = SFSI_PLUS_PLUGURL."images/icons_theme/default/";
						$icon=$icons_baseUrl.$active_theme."_linkedin.png";
					 }
				}
				else
				{
					$icon=$icons_baseUrl.$active_theme."_linkedin.png";
				}	 
           break;   
		   		
		  // MZ CODE START


		  
		case "ok":

		$toolClass = "sfsi_plus_ok_tool_bdr";
		$hoverdiv = '';
		$arsfsiplus_row_class = "bot_rss_arow";
		
		/* fecth no of counts if active in admin section */
		if(
			isset($sfsi_plus_section4_options['sfsi_plus_ok_countsDisplay']) &&
		   "yes" == $sfsi_plus_section4_options['sfsi_plus_ok_countsDisplay'] &&
		   "yes" == $sfsi_plus_section4_options['sfsi_plus_display_counts'] &&
		   $sfsi_plus_section4_options['sfsi_plus_round_counts']=="yes" 

		)
		{
			$counts = $sfsi_plus_section4_options['sfsi_plus_ok_manualCounts'];
		}
					 
		$alt_text = sfsi_plus_get_icon_mouseover_text("ok");
		// $icon=$icons_baseUrl.$active_theme."_ok.png";
		$icon = sfsi_plus_get_icon_image("ok"); 
		$like_icon  = $share_iconsUrl.$icon_name.".svg";
		$visit_icon = $visit_iconsUrl.$icon_name.".svg";
		$sub_icon   = $visit_iconsUrl."ok_subscribe.svg";
		$url = "#";

		$hoverSHow = 0;
	   	if(isset($sfsi_plus_section2_options['sfsi_plus_okVisit_url']) && !empty($sfsi_plus_section2_options['sfsi_plus_okVisit_url'])){

		   $url = $sfsi_plus_section2_options['sfsi_plus_okVisit_url'];
	   	}else{
	   		$url="#";
	   		$sfsi_onclick="event.preventDefault();";
	   	}
	   	if($active_theme == "glossy"){
	   		$glossy_theme_adjustment=4;
	   	}
   break;
		  
		  case "telegram":

		  $toolClass = "sfsi_plus_telegram_tool_bdr";
		  $hoverdiv = '';
		  $arsfsiplus_row_class = "bot_rss_arow";
		  
		  /* fecth no of counts if active in admin section */
		  if(
			  isset($sfsi_plus_section4_options['sfsi_plus_telegram_countsDisplay']) &&
			 $sfsi_plus_section4_options['sfsi_plus_telegram_countsDisplay'] == "yes" &&
			 $sfsi_plus_section4_options['sfsi_plus_display_counts'] == "yes" &&
			 $sfsi_plus_section4_options['sfsi_plus_round_counts']=="yes" 

		  )
		  {
			  $counts = $sfsi_plus_section4_options['sfsi_plus_telegram_manualCounts'];
		  }
					   
		  $alt_text = sfsi_plus_get_icon_mouseover_text("telegram");

		 $icon = sfsi_plus_get_icon_image("telegram"); 

		 $messageus_icon = $visit_iconsUrl.$icon_name."_message.svg";
		  $share_icon = $share_iconsUrl.$icon_name.".svg";
		  $visit_icon = $visit_iconsUrl."telegram.png";

		 $url = "#";
		 if(
			 isset($sfsi_plus_section2_options['sfsi_plus_telegram_message']) && !empty($sfsi_plus_section2_options['sfsi_plus_telegram_message'])
			 && 
			 isset($sfsi_plus_section2_options['sfsi_plus_telegram_username']) && !empty($sfsi_plus_section2_options['sfsi_plus_telegram_username'])

		 ){
			 $tg_username = $sfsi_plus_section2_options['sfsi_plus_telegram_username'];
			 $tg_msg = stripslashes($sfsi_plus_section2_options['sfsi_plus_telegram_message']);
			 $tg_msg = str_replace('"', '', str_replace("'", '', $tg_msg));
			 $tg_msg = html_entity_decode(strip_tags($tg_msg), ENT_QUOTES,'UTF-8');
			 $tg_msg = str_replace("%26%238230%3B", "...", $tg_msg);
			 $tg_msg = rawurlencode($tg_msg);
			 $tele_url = "https://t.me/".$tg_username;

			if (isMobileDevice()) {
				$url = $tele_url."?&text=".urlencode($tg_msg);
			} else {
				$url = $tele_url."?&text=".urlencode($tg_msg);
			}
			 
			 //$url = "https://t.me/".$tg_username;
		 }else{
	   		$url="#";
	   		$sfsi_onclick="event.preventDefault();";
   		}				

	   	if($active_theme == "glossy"){
	   		$glossy_theme_adjustment=4;
	   	}
		 break;

	case "vk":

		 $toolClass = "sfsi_plus_vk_tool_bdr";
		 $hoverdiv = '';
		 $arsfsiplus_row_class = "bot_rss_arow";
		 
		 /* fecth no of counts if active in admin section */
		 if(
			 isset($sfsi_plus_section4_options['sfsi_plus_vk_countsDisplay']) &&
			$sfsi_plus_section4_options['sfsi_plus_vk_countsDisplay'] == "yes" &&
			$sfsi_plus_section4_options['sfsi_plus_display_counts'] == "yes" &&
			$sfsi_plus_section4_options['sfsi_plus_round_counts']=="yes" 

		 )
		 {
			 $counts = $sfsi_plus_section4_options['sfsi_plus_vk_manualCounts'];
		 }
					  
		 $alt_text = sfsi_plus_get_icon_mouseover_text("vk");
		 $icon 	   = sfsi_plus_get_icon_image("vk"); 
	     // $icon=$icons_baseUrl.$active_theme."_vk.png";
		 $share_icon = $share_iconsUrl.$icon_name.".svg";
		 $visit_icon = $visit_iconsUrl.$icon_name.".svg";
		 $url = "#";

		$hoverSHow = 0;
	   	if(isset($sfsi_plus_section2_options['sfsi_plus_vkVisit_url']) && !empty($sfsi_plus_section2_options['sfsi_plus_vkVisit_url'])){

		   $url = $sfsi_plus_section2_options['sfsi_plus_vkVisit_url'];
	   	}else{
	   		$url="#";
	   		$sfsi_onclick="event.preventDefault();";
	   	}

	   	if($active_theme == "glossy"){
	   		$glossy_theme_adjustment=4;
	   	}
		break;

		case "weibo":

		$toolClass = "sfsi_plus_weibo_tool_bdr";
		$hoverdiv = '';
		$arsfsiplus_row_class = "bot_rss_arow";

		/* fecth no of counts if active in admin section */
		if(isset($sfsi_plus_section4_options['sfsi_plus_weibo_countsDisplay']) &&
		 "yes" == $sfsi_plus_section4_options['sfsi_plus_weibo_countsDisplay'] &&
		  "yes" == $sfsi_plus_section4_options['sfsi_plus_display_counts'] &&
		  $sfsi_plus_section4_options['sfsi_plus_round_counts']=="yes" 
		  ){

			$counts = $sfsi_plus_section4_options['sfsi_plus_weibo_manualCounts'];
		}
					 
		$alt_text 	 = sfsi_plus_get_icon_mouseover_text($icon_name);
		$icon 		 = sfsi_plus_get_icon_image($icon_name); 
		// $icon=$icons_baseUrl.$active_theme."_weibo.png";
		$url = "#";

		$hoverSHow = 0;
	   	if(isset($sfsi_plus_section2_options['sfsi_plus_weiboVisit_url']) && !empty($sfsi_plus_section2_options['sfsi_plus_weiboVisit_url'])){

		   $url = $sfsi_plus_section2_options['sfsi_plus_weiboVisit_url'];
	   	}else{
	   		$url="#";
	   		$sfsi_onclick="event.preventDefault();";
	   	}
		
	   	if($active_theme == "glossy"){
	   		$glossy_theme_adjustment=4;
	   	}
		break;


		case "wechat":

		$toolClass = "sfsi_plus_wechat_tool_bdr";
		$hoverdiv = '';
		$arsfsiplus_row_class = "bot_rss_arow";

		/* fecth no of counts if active in admin section */
		if(isset($sfsi_plus_section4_options['sfsi_plus_wechat_countsDisplay']) &&
		 "yes" == $sfsi_plus_section4_options['sfsi_plus_wechat_countsDisplay'] &&
		  "yes" == $sfsi_plus_section4_options['sfsi_plus_display_counts'] &&
		  $sfsi_plus_section4_options['sfsi_plus_round_counts']=="yes" 
		  ){

			$counts = $sfsi_plus_section4_options['sfsi_plus_wechat_manualCounts'];
		}
					 
		$alt_text 	 = sfsi_plus_get_icon_mouseover_text($icon_name);
		$icon 		 = sfsi_plus_get_icon_image($icon_name); 
		// $icon=$icons_baseUrl.$active_theme."_wechat.png";
		
		$share_icon = $share_iconsUrl.$icon_name.".svg";
		$visit_icon = $visit_iconsUrl.$icon_name.".svg";
		$url = "#";
	   	// if(!wp_is_mobile()){
			$sfsi_onclick="event.preventDefault();sfsi_plus_wechat_share()"	;
		// }else{
			// $url = "weixin://dl/chat";
		// }

	   	if($active_theme == "glossy"){
	   		$glossy_theme_adjustment=4;
	   	}
		break;


		
	   ///MZ CODE END
           
		   default:
		      	$border_radius = "";
		     	//$border_radius =" border-radius:48%;";
		      	$cmcls = "cmcls";      
		      	$padding_top = "";	
				if($active_theme=="badge")
				{
					//$border_radius="border-radius: 18%;";
				}
				if($active_theme=="cute")
				{
					//$border_radius="border-radius: 38%;";
				}
				
				$custom_icon_urls = isset($sfsi_plus_section2_options['sfsi_plus_CustomIcon_links'])&& ""!==$sfsi_plus_section2_options['sfsi_plus_CustomIcon_links']?unserialize($sfsi_plus_section2_options['sfsi_plus_CustomIcon_links']):array();
				$url = (isset($custom_icon_urls[$icon_n]) && !empty($custom_icon_urls[$icon_n])) ? $custom_icon_urls[$icon_n]:'javascript:void(0);'; 
				$toolClass = "custom_lkn";
				$arsfsiplus_row_class = "";
				$custom_icons_hoverTxt = unserialize($sfsi_plus_section5_options['sfsi_plus_custom_MouseOverTexts']);
				$icons = isset($sfsi_plus_section1_options['sfsi_custom_files'])&& ""!==$sfsi_plus_section1_options['sfsi_custom_files']?unserialize($sfsi_plus_section1_options['sfsi_custom_files']):array();
				// var_dump($icons,$custom_icon_urls,$icon_n,$sfsi_plus_section2_options);die();
				$icon = $icons[$icon_n];
				
				//Giving alternative text to image
				if(!empty($custom_icons_hoverTxt[$icon_n]))
				{	
				 	$alt_text = $custom_icons_hoverTxt[$icon_n];
				}
				else
				{
					 $alt_text = "SOCIALICON";
				}
            break;    
    }

    $icons="";
    
	/* apply size of icon */
    if($is_front==0)
    {
    	$icons_size = $sfsi_plus_section5_options['sfsi_plus_icons_size'];
    }
    else
    {
	  	$icons_size = 51;
    }
	
    /* spacing and no of icons per row */
    $icons_space = '';
    $icons_space = $sfsi_plus_section5_options['sfsi_plus_icons_spacing'];
    $icon_width = (int)$icons_size;
    /* check for mouse hover effect */
    $icon_opacity="1";
    
	if($sfsi_plus_section3_options['sfsi_plus_mouseOver']=='yes')
    {
		 $mouse_hover_effect=$sfsi_plus_section3_options["sfsi_plus_mouseOver_effect"];
		 if($mouse_hover_effect=="fade_in" || $mouse_hover_effect=="combo")
		 {    
			$icon_opacity="0.6";
		 }
    }
    
	$toolT_cls='';
    if((int) $icon_width <=49 && (int) $icon_width >=30)
	{
		$bt_class="";
	  	$toolT_cls="sfsi_plus_Tlleft";
    }
	else if((int) $icon_width <=20)
    {
 	  $bt_class="sfsiSmBtn";
	  $toolT_cls="sfsi_plus_Tlleft";
    }
	else
    {
      $bt_class="";
	  $toolT_cls="sfsi_plus_Tlleft";
    }
    
	if($toolClass=="rss_tool_bdr" || $toolClass=='email_tool_bdr' || $toolClass=="custom_lkn" ||   $toolClass=="instagram_tool_bdr" )
    {
    	$new_window = sfsi_plus_checkNewWindow();
    }
    else if($hoverSHow)
    {
		if(!function_exists('wp_is_mobile')||!wp_is_mobile())
		{
			$new_window = sfsi_plus_checkNewWindow();
		}
		else
		{
			$new_window = '';
			$url = "javascript:void(0);";
		}
	}
    else
    {
	 	$new_window = sfsi_plus_checkNewWindow();
    }

    if("javascript:void(0);" == $url){
    	$new_window = "";
	}
	// if($sfsi_plus_section2_options['sfsi_plus_rss_icons'] !== "sfsi" && sanitize_text_field(get_option('sfsi_plus_feed_id',false)) == ""){
	// 	$url = "https://follow.it/now";
	// }
	$margin_bot=(5+$glossy_theme_adjustment)."px;";
    if($sfsi_plus_section4_options['sfsi_plus_display_counts']=="yes")
	{
		$margin_bot = (30+($glossy_theme_adjustment>0?$glossy_theme_adjustment-1:$glossy_theme_adjustment))."px;";
    }
    
	if(isset($icon) && !empty($icon) && filter_var($icon, FILTER_VALIDATE_URL))
	{
		$icons.= "<div style='width:".$icon_width."px; height:".$icon_width."px;margin-left:".$icons_space."px;margin-bottom:".$margin_bot."' class='sfsi_plus_wicons shuffeldiv ".$cmcls."'>";
		
			$icons.= "<div class='sfsiplus_inerCnt'>";
		
				$icons.= "<a class='".$class." sficn' data-effect='".$mouse_hover_effect."' $new_window  href='".$url."'  style='opacity:".$icon_opacity."' ".(isset($sfsi_onclick)?'onclick="'.$sfsi_onclick.'"':'').">";     
					
					$icons.= "<img alt='".$alt_text."' title='".$alt_text."' src='".$icon."' width='".$icons_size."' height='".$icons_size."' style='".$border_radius.$padding_top."' class='sfcm sfsi_wicon sfsiplusid_round_icon_".$icon_name."' data-effect='".$mouse_hover_effect."'  />"; 
				
				$icons.= '</a>';
	   
	   if(isset($counts) &&  $counts!='' && $onpost == "no")
	   {
			$icons.= '<span class="bot_no '.$bt_class.'">'.$counts.'</span>';  
	   }
		 
	   if($hoverSHow && !empty($hoverdiv))
	   {	
			//$icons.= '<div class="sfsi_plus_tool_tip_2 '.$toolClass.' '.$toolT_cls.'" style="width:'.$width.'px ;opacity:0;z-index:-1;margin-left:-'.$twt_margin.'px;" id="sfsiplusid_'.$icon_name.'">';
			
			$icons.= '<div class="sfsi_plus_tool_tip_2 '.$toolClass.' '.$toolT_cls.' sfsiplusid_'.$icon_name.'" style="display:block;'.(isset($width)?'width:'.$width.'px':'').';opacity:0;z-index:-1;">';
			$icons.= '<span class="bot_arow '.$arsfsiplus_row_class.'"></span>';
			$icons.= '<div class="sfsi_plus_inside">'.$hoverdiv."</div>";
			$icons.= "</div>";
	   }
	   $icons.="</div>";
	   $icons.="</div>";
	}
   return  $icons;       
}

/* make url for new window */
function sfsi_plus_checkNewWindow()
{	
	global $wpdb;
	$sfsi_plus_section5_options=  unserialize(get_option('sfsi_plus_section5_options',false));
	if($sfsi_plus_section5_options['sfsi_plus_icons_ClickPageOpen']=="yes")
	{
	   return  $new_window="target='_blank'";
	}
	else
	{
	    return ''; 
	}
}

function sfsi_plus_check_posts_visiblity($isFloter=0 , $fromPost = NULL)
{
  	global $wpdb;
    /* Access the saved settings in database  */
    $sfsi_plus_section1_options=  unserialize(get_option('sfsi_plus_section1_options',false));
    $sfsi_section3=  unserialize(get_option('sfsi_plus_section3_options',false));
    $sfsi_section5=  unserialize(get_option('sfsi_plus_section5_options',false));
    
	//options that are added on the third question
	$sfsi_section8=  unserialize(get_option('sfsi_plus_section8_options',false));
	   
    /* calculate the width and icons display alignments */
    $icons_space=$sfsi_section8['sfsi_plus_post_icons_spacing'];
    $icons_size=$sfsi_section8['sfsi_plus_post_icons_size'];	  
    $extra=0;

	    
	/* magnage the icons in saved order in admin */ 
	$custom_icons_order = unserialize($sfsi_section5['sfsi_plus_CustomIcons_order']);
	$icons=  unserialize($sfsi_plus_section1_options['sfsi_custom_files']);
	$icons_order = array(
					 '0' => '',
					 $sfsi_section5['sfsi_plus_rssIcon_order']=>'rss',
					 $sfsi_section5['sfsi_plus_emailIcon_order']=>'email',
					 $sfsi_section5['sfsi_plus_facebookIcon_order']=>'facebook',
					 $sfsi_section5['sfsi_plus_twitterIcon_order']=>'twitter',
					 $sfsi_section5['sfsi_plus_youtubeIcon_order']=>'youtube',
					 $sfsi_section5['sfsi_plus_pinterestIcon_order']=>'pinterest',
					 $sfsi_section5['sfsi_plus_linkedinIcon_order']=>'linkedin',
					 $sfsi_section5['sfsi_plus_instagramIcon_order']=>'instagram',
					 $sfsi_section5['sfsi_plus_okIcon_order']=>'ok',
					 $sfsi_section5['sfsi_plus_telegramIcon_order']=>'telegram',
					 $sfsi_section5['sfsi_plus_vkIcon_order']=>'vk',
					 $sfsi_section5['sfsi_plus_weiboIcon_order']=>'weibo',
					 $sfsi_section5['sfsi_plus_wechatIcon_order']=>'wechat',
					 (isset($sfsi_section5['sfsi_plus_houzzIcon_order']))
						? $sfsi_section5['sfsi_plus_houzzIcon_order']
						: 12 => 'houzz'
					);
	if(is_array($custom_icons_order) ) 
	{
		foreach($custom_icons_order as $data)
		{
		   $icons_order[$data['order']] = $data;
		}
	}
	ksort($icons_order);
   
    /* built the main widget div */
    $icons_main='<div class="sfsiplus_norm_row sfsi_plus_wDivothr">';
    $icons="";

	// $icons .= '<style>.sfsibeforpstwpr .sfsiplus_norm_row.sfsi_plus_wDivothr .sfsi_plus_wicons, .sfsiaftrpstwpr .sfsiplus_norm_row.sfsi_plus_wDivothr .sfsi_plus_wicons{width: '.$icons_size.'px !important;height: '.$icons_size.'px !important; margin-left: '.$icons_space.'px !important;}</style>';
	// add_action('wp_head', function(){
	// 	echo '<style>.sfsibeforpstwpr .sfsiplus_norm_row.sfsi_plus_wDivothr .sfsi_plus_wicons, .sfsiaftrpstwpr .sfsiplus_norm_row.sfsi_plus_wDivothr .sfsi_plus_wicons{width: '.$icons_size.'px !important;height: '.$icons_size.'px !important; margin-left: '.$icons_space.'px !important;}</style>';
	// }, 100);
	add_action('wp_footer', function()use($icons_space,$icons_size){
		echo '<script>var css = ".sfsibeforpstwpr .sfsiplus_norm_row.sfsi_plus_wDivothr .sfsi_plus_wicons, .sfsiaftrpstwpr .sfsiplus_norm_row.sfsi_plus_wDivothr .sfsi_plus_wicons{width: '.$icons_size.'px !important;height: '.$icons_size.'px !important; margin-left: '.$icons_space.'px !important;}",
			    head = document.head || document.getElementsByTagName("head")[0],
			    style = document.createElement("style");

			head.appendChild(style);
			if (style.styleSheet){
			  // This is required for IE8 and below.
			  style.styleSheet.cssText = css;
			} else {
			  style.appendChild(document.createTextNode(css));
			}</script>';
	}, 100);

	/* loop through icons and bulit the icons with all settings applied in admin */
	foreach($icons_order  as $index => $icn)
	{
		if(is_array($icn))
		{
			$icon_arry = $icn;
			$icn = "custom" ;
		}

		switch ($icn) :     
			case 'rss' :
				if($sfsi_plus_section1_options['sfsi_plus_rss_display'] == 'yes')
				{	
					$icons.= sfsi_plus_prepairIcons('rss');
				}	
			break;
			case 'email' :
				if($sfsi_plus_section1_options['sfsi_plus_email_display']=='yes')
				{
					$icons.= sfsi_plus_prepairIcons('email');
				}
			break;
			case 'facebook' :
				if($sfsi_plus_section1_options['sfsi_plus_facebook_display'] == 'yes')
				{
					$icons.= sfsi_plus_prepairIcons('facebook', 0, "no", $fromPost);
				}	
			break;
			

			case 'twitter' :
				if($sfsi_plus_section1_options['sfsi_plus_twitter_display']=='yes')
				{
					$icons.= sfsi_plus_prepairIcons('twitter', 0, "no", $fromPost);
				}
			break;
			case 'youtube' :
				if($sfsi_plus_section1_options['sfsi_plus_youtube_display']=='yes')
				{
					$icons.= sfsi_plus_prepairIcons('youtube');
				}	
			break;
			
			case 'pinterest' :
				if($sfsi_plus_section1_options['sfsi_plus_pinterest_display']=='yes')
				{
					$icons.= sfsi_plus_prepairIcons('pinterest');
				}
			break;
			case 'linkedin' :
				if($sfsi_plus_section1_options['sfsi_plus_linkedin_display']=='yes')
				{
					$icons.= sfsi_plus_prepairIcons('linkedin', 0, "no", $fromPost);
				}
			break;
			case 'instagram' :
				if($sfsi_plus_section1_options['sfsi_plus_instagram_display']=='yes')
				{
					$icons.= sfsi_plus_prepairIcons('instagram');
				}
			break;
			case 'houzz' :
				if(
					isset($sfsi_plus_section1_options['sfsi_plus_houzz_display']) &&
					$sfsi_plus_section1_options['sfsi_plus_houzz_display']=='yes'
				)
				{
					$icons.= sfsi_plus_prepairIcons('houzz'); 
				}
			break;
			case 'ok' :
				if(
					isset($sfsi_plus_section1_options['sfsi_plus_ok_display']) &&
					$sfsi_plus_section1_options['sfsi_plus_ok_display']=='yes'
				)
				{
					$icons.= sfsi_plus_prepairIcons('ok'); 
					
				}
			break;	
			case 'telegram' :
				if(
					isset($sfsi_plus_section1_options['sfsi_plus_telegram_display']) &&
					$sfsi_plus_section1_options['sfsi_plus_telegram_display']=='yes'
				)
				{
					$icons.= sfsi_plus_prepairIcons('telegram'); 
					
				}
			break;	
			case 'vk' :
				if(
					isset($sfsi_plus_section1_options['sfsi_plus_vk_display']) &&
					$sfsi_plus_section1_options['sfsi_plus_vk_display']=='yes'
				)
				{
					$icons.= sfsi_plus_prepairIcons('vk'); 
					
				}
			break;
			case 'weibo' :
				if(
					isset($sfsi_plus_section1_options['sfsi_plus_weibo_display']) &&
					$sfsi_plus_section1_options['sfsi_plus_weibo_display']=='yes'
				)
				{
					$icons.= sfsi_plus_prepairIcons('weibo'); 
					
				}
			break;
			case 'wechat' :
				if(
					isset($sfsi_plus_section1_options['sfsi_plus_wechat_display']) &&
					$sfsi_plus_section1_options['sfsi_plus_wechat_display']=='yes'
				)
				{
					$icons.= sfsi_plus_prepairIcons('wechat'); 
					
				}
			break;	  
			case 'custom' :
				$icons.= sfsi_plus_prepairIcons($icon_arry['ele']); 
			break;    
		endswitch;
    }
    $icons.='</div >';
    $icons_main.=$icons;
    
	/* if floating of icons is active create a floater div */
    $icons_float='';
    $icons_data=$icons_main.$icons_float;
    return $icons_data;
}

	// MZ CODE
	
	 
	function sfsi_plus_get_icon_mouseover_text($icon_name){

		$alt_text = '';
	
		if(isset($icon_name) && !empty($icon_name)){
	
			$icon_name = strtolower($icon_name);
	
			$key = 'sfsi_plus_'.$icon_name.'_MouseOverText';
	
			$sfsi_plus_section5_options = unserialize(get_option('sfsi_plus_section5_options',false));		
	
			if(isset($sfsi_plus_section5_options[$key]) && !empty($sfsi_plus_section5_options[$key]) )
			{
				$alt_text = $sfsi_plus_section5_options[$key];
			}
		}
	
		return $alt_text;	
	}
	
		
		
		//MZ CODE END
		
function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
?>