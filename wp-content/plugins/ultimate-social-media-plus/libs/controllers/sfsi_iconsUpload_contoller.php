<?php
/* upload custom Skins {Monad}*/
add_action('wp_ajax_plus_UploadSkins','sfsi_plus_UploadSkins');
function sfsi_plus_UploadSkins()
{
	if ( !wp_verify_nonce( $_POST['nonce'], "plus_UploadSkins")) {
      echo  json_encode(array("wrong_nonce")); exit;
   	}
	if(!current_user_can('manage_options')){ echo json_encode(array('res'=>'not allowed'));die(); }
	$custom_imgurl = (isset($_POST['custom_imgurl']))?sanitize_text_field($_POST['custom_imgurl']):'';
	$upload_dir = wp_upload_dir();
	
	$ThumbSquareSize 		= 100; //Thumbnail will be 57X57
	$Quality 				= 90; //jpeg quality
	$DestinationDirectory   = $upload_dir['path'].'/'; //specify upload directory ends with / (slash)
	$AcceessUrl             = $upload_dir['url'].'/';
	$ThumbPrefix			= "cmicon_";
	
	// $data = $_REQUEST["custom_imgurl"];
	$data = $custom_imgurl;
	$params = array();
	$site_url = home_url();
	parse_str($data, $params);
	
	foreach($params as $key => $value)
	{
		$custom_imgurl = $value;
		if(!empty($custom_imgurl))
		{
			if(strpos($custom_imgurl, $site_url) === false){
				die(json_encode(array('res'=>'thumb_error')));
			}
			$sfsi_custom_files[] = $custom_imgurl;
			
			list($CurWidth, $CurHeight) = getimagesize($custom_imgurl);
		
			$info = explode("/", $custom_imgurl);
			$iconName = array_pop($info);
			$ImageExt = substr($iconName, strrpos($iconName, '.'));
			$ImageExt = str_replace('.','',$ImageExt);
			
			$iconName = str_replace(' ','-',strtolower($iconName)); // get image name
			$ImageType = 'image/'.$ImageExt;
			
			 switch(strtolower($ImageType))
			 {
					case 'image/png':
							// Create a new image from file 
							$CreatedImage =  imagecreatefrompng($custom_imgurl);
							break;
					case 'image/gif':
							$CreatedImage =  imagecreatefromgif($custom_imgurl);
							break;
					case 'image/jpg':
							$CreatedImage = imagecreatefromjpeg($custom_imgurl);
							break;					
					case 'image/jpeg':
					case 'image/pjpeg':
							$CreatedImage = imagecreatefromjpeg($custom_imgurl);
							break;
					default:
							 die(json_encode(array('res'=>'type_error'))); //output error and exit
			}
	
			
			$ImageName = preg_replace("/\\.[^.\\s]{3,4}$/", "", $iconName);
			
			$NewIconName = "custom_icon".$key.'.'.$ImageExt;
			$iconPath 	= $DestinationDirectory.$NewIconName; //Thumbnail name with destination directory
			
			//Create a square Thumbnail right after, this time we are using sfsiplus_cropImage() function
			if(sfsiplus_cropImage($CurWidth,$CurHeight,$ThumbSquareSize,$iconPath,$CreatedImage,$Quality,$ImageType))
			{
				//update database information 
				$AccressImagePath=$AcceessUrl.$NewIconName;                                        
				update_option($key,$AccressImagePath);
				die(json_encode(array('res'=>'success')));
		   }
		   else
		   {        
			   die(json_encode(array('res'=>'thumb_error')));
		   }
			
		}	
	}
}

/* Delete custom Skins {Monad}*/
add_action('wp_ajax_plus_DeleteSkin','sfsi_plus_DeleteSkin');
function sfsi_plus_DeleteSkin()
{
	if ( !wp_verify_nonce( $_POST['nonce'], "sfsi_plus_deleteCustomSkin")) {
		echo  json_encode(array('res'=>"error")); exit;
	} 
	if(!current_user_can('manage_options')){ echo json_encode(array('res'=>'not allowed'));die(); }
	
	$upload_dir = wp_upload_dir();
	
	if(sanitize_text_field($_POST['action']) == 'plus_DeleteSkin' && isset($_POST['iconname']) && !empty($_POST['iconname']) && current_user_can('manage_options'))
	{
		$iconsArray = array(
			"plus_rss_skin","plus_email_skin","plus_facebook_skin","plus_twitter_skin","plus_share_skin","plus_youtube_skin","plus_linkedin_skin","plus_pintrest_skin","plus_instagram_skin",
			"plus_ok_skin","plus_telegram_skin","plus_vk_skin","plus_weibo_skin","plus_wechat_skin"
		);
		
		if(in_array(sanitize_text_field($_POST['iconname']), $iconsArray))
		{
			$imgurl = get_option( sanitize_text_field($_POST['iconname']) );
			$path = parse_url($imgurl, PHP_URL_PATH);
		   
			if(is_file($_SERVER['DOCUMENT_ROOT'] . $path))
			{
				unlink($_SERVER['DOCUMENT_ROOT'] . $path);
			}
			delete_option( sanitize_text_field($_POST['iconname']) );
			die(json_encode(array('res'=>'success')));
		}
		else
		{
			die(json_encode(array('res'=>'error')));
		}
	}
	else
	{
		die(json_encode(array('res'=>'error')));
	}	
}

/* add ajax action for custom skin done & save{Monad}*/
add_action('wp_ajax_plus_Iamdone','sfsi_plus_Iamdone');
function sfsi_plus_Iamdone()
{
	if ( !wp_verify_nonce( $_POST['nonce'], "plus_Iamdone")) {
		echo  json_encode(array('res'=>"error")); exit;
	} 
	if(!current_user_can('manage_options')){ echo json_encode(array('res'=>'not allowed'));die(); }
	 $return = '';
	 if(get_option("plus_rss_skin"))
	 {
		$icon = get_option("plus_rss_skin");
		$return .= '<span class="sfsiplus_row_17_1 sfsiplus_rss_section sfsi_plus-bgimage" style="background: url('.$icon.') no-repeat;"></span>';
	 }else
	 {
		$return .= '<span class="sfsiplus_row_17_1 sfsiplus_rss_section" style="background-position:-1px 0;"></span>';
	 }
	 
	 if(get_option("plus_email_skin"))
	 {
		$icon = get_option("plus_email_skin");
		$return .= '<span class="sfsiplus_row_17_2 sfsiplus_email_section sfsi_plus-bgimage" style="background: url('.$icon.') no-repeat;"></span>';
	 }else
	 {
		$return .= '<span class="sfsiplus_row_17_2 sfsiplus_email_section" style="background-position:-58px 0;"></span>';
	 }
	 
	 if(get_option("plus_facebook_skin"))
	 {
		$icon = get_option("plus_facebook_skin");
		$return .= '<span class="sfsiplus_row_17_3 sfsiplus_facebook_section sfsi_plus-bgimage" style="background: url('.$icon.') no-repeat;"></span>';
	 }else
	 {
		$return .= '<span class="sfsiplus_row_17_3 sfsiplus_facebook_section" style="background-position:-118px 0;"></span>';
	 }
	 
	 if(get_option("twitter_skin"))
	 {
		$icon = get_option("plus_twitter_skin");
		$return .= '<span class="sfsiplus_row_17_5 sfsiplus_twitter_section sfsi_plus-bgimage" style="background: url('.$icon.') no-repeat;"></span>';
	 }else
	 {
		$return .= '<span class="sfsiplus_row_17_5 sfsiplus_twitter_section" style="background-position:-235px 0;"></span>';
	 }
	 
	 if(get_option("plus_youtube_skin"))
	 {
		$icon = get_option("plus_youtube_skin");
		$return .= '<span class="sfsiplus_row_17_7 sfsiplus_youtube_section sfsi_plus-bgimage" style="background: url('.$icon.') no-repeat;"></span>';
	 }else
	 {
		$return .= '<span class="sfsiplus_row_17_7 sfsiplus_youtube_section" style="background-position:-350px 0;"></span>';
	 }
	 
	 if(get_option("plus_pintrest_skin"))
	 {
		$icon = get_option("plus_pintrest_skin");
		$return .= '<span class="sfsiplus_row_17_8 sfsiplus_pinterest_section sfsi_plus-bgimage" style="background: url('.$icon.') no-repeat;"></span>';
	 }else
	 {
		$return .= '<span class="sfsiplus_row_17_8 sfsiplus_pinterest_section" style="background-position:-409px 0;"></span>';
	 }
	 
	 if(get_option("plus_linkedin_skin"))
	 {
		$icon = get_option("plus_linkedin_skin");
		$return .= '<span class="sfsiplus_row_17_9 sfsiplus_linkedin_section sfsi_plus-bgimage" style="background: url('.$icon.') no-repeat;"></span>';
	 }else
	 {
		$return .= '<span class="sfsiplus_row_17_9 sfsiplus_linkedin_section" style="background-position:-467px 0;"></span>';
	 }
	 
	 if(get_option("plus_instagram_skin"))
	 {
		$icon = get_option("plus_instagram_skin");
		$return .= '<span class="sfsiplus_row_17_10 sfsiplus_instagram_section sfsi_plus-bgimage" style="background: url('.$icon.') no-repeat;"></span>';
	 }else
	 {
		$return .= '<span class="sfsiplus_row_17_10 sfsiplus_instagram_section" style="background-position:-526px 0;"></span>';
	 }
	 if(get_option("plus_houzz_skin"))
	 {
		$icon = get_option("plus_houzz_skin");
		$return .= '<span class="sfsiplus_row_17_11 sfsiplus_houzz_section sfsi_plus-bgimage" style="background: url('.$icon.') no-repeat;"></span>';
	 }else
	 {
		$return .= '<span class="sfsiplus_row_17_11 sfsiplus_houzz_section" style="background-position:-711px 0;"></span>';
	 }
	 //MZ CODE START

	 if(get_option("plus_telegram_skin"))
	 {
		$icon = get_option("plus_telegram_skin");
		$return .= '<span class="sfsiplus_row_17_22 sfsiplus_telegram_section sfsi_plus-bgimage" style="background: url('.$icon.') no-repeat;"></span>';
	 }else
	 {
		$return .= '<span class="sfsiplus_row_17_22 sfsiplus_telegram_section" style="background-position:-769px 0;"></span>';
	 }
	 if(get_option("plus_vk_skin"))
	 {
		$icon = get_option("plus_vk_skin");
		$return .= '<span class="sfsiplus_row_17_23 sfsiplus_vk_section sfsi_plus-bgimage" style="background: url('.$icon.') no-repeat;"></span>';
	 }else
	 {
		$return .= '<span class="sfsiplus_row_17_23 sfsiplus_vk_section" style="background-position:-839px 0;"></span>';
	 }

	 if(get_option("plus_ok_skin"))
	 {
		$icon = get_option("plus_ok_skin");
		$return .= '<span class="sfsiplus_row_17_24 sfsiplus_ok_section sfsi_plus-bgimage" style="background: url('.$icon.') no-repeat;"></span>';
	 }else
	 {
		$return .= '<span class="sfsiplus_row_17_24 sfsiplus_ok_section" style="background-position:-909px 0;"></span>';
	 }
	
	if(get_option("plus_wechat_skin"))
	 {
		$icon = get_option("plus_wechat_skin");
		$return .= '<span class="sfsiplus_row_17_26 sfsiplus_wechat_section sfsi_plus-bgimage" style="background: url('.$icon.') no-repeat;"></span>';
	 }else
	 {
		$return .= '<span class="sfsiplus_row_17_26 sfsiplus_wechat_section" style="background-position:-1045px 0;"></span>';
	 }

	 if(get_option("plus_weibo_skin"))
	 {
		$icon = get_option("plus_weibo_skin");
		$return .= '<span class="sfsiplus_row_17_25 sfsiplus_weibo_section sfsi_plus-bgimage" style="background: url('.$icon.') no-repeat;"></span>';
	 }else
	 {
		$return .= '<span class="sfsiplus_row_17_25 sfsiplus_weibo_section" style="background-position:-979px 0;"></span>';
	 }



	 //MZ CODE END
	 die($return);
}

/* add ajax action for custom icons upload {Monad}*/
add_action('wp_ajax_plus_UploadIcons','sfsi_plus_UploadIcons');

/* uplaod custom icon {change by monad}*/
function sfsi_plus_UploadIcons()
{
	if ( !wp_verify_nonce( $_POST['nonce'], "plus_UploadIcons")) {
		echo  json_encode(array('res'=>"error")); exit;
	} 
	if(!current_user_can('manage_options')){ echo json_encode(array('res'=>'not allowed'));die(); }
	$custom_imgurl = isset($_POST) && isset($_POST['custom_imgurl']) ? esc_url($_POST['custom_imgurl']):'';
	if(strpos($custom_imgurl, home_url()) === false){
       die(json_encode(array('res'=>'thumb_error')));
   }

	$upload_dir	= wp_upload_dir();
	$ThumbSquareSize 		= 100; //Thumbnail will be 57X57
	$Quality 			    = 90; //jpeg quality
	$DestinationDirectory   = $upload_dir['path'].'/'; //specify upload directory ends with / (slash)
	$AcceessUrl             = $upload_dir['url'].'/';
	$ThumbPrefix			= "cmicon_";
	
   if(!empty($custom_imgurl))
	{
		$sfsi_custom_files[] = $custom_imgurl;	
			
		list($CurWidth, $CurHeight) = getimagesize($custom_imgurl);
	
		$info = explode("/", $custom_imgurl);
		$iconName = array_pop($info);
		$ImageExt = substr($iconName, strrpos($iconName, '.'));
		$ImageExt = str_replace('.','',$ImageExt);
		
		$iconName = str_replace(' ','-',strtolower($iconName)); // get image name
		$ImageType = 'image/'.$ImageExt;
		
		 switch(strtolower($ImageType))
		 {
			 	case 'image/png':
						// Create a new image from file 
						$CreatedImage =  imagecreatefrompng($custom_imgurl);
						break;
				case 'image/gif':
						$CreatedImage =  imagecreatefromgif($custom_imgurl);
						break;
				case 'image/jpg':
						$CreatedImage = imagecreatefromjpeg($custom_imgurl);
						break;					
				case 'image/jpeg':
				case 'image/pjpeg':
						$CreatedImage = imagecreatefromjpeg($custom_imgurl);
						break;
				default:
						 die(json_encode(array('res'=>'type_error'))); //output error and exit
		}
		
		$ImageName = preg_replace("/\\.[^.\\s]{3,4}$/", "", $iconName);
		
		$sec_options= (get_option('sfsi_plus_section1_options',false)) ? unserialize(get_option('sfsi_plus_section1_options',false)) : '' ;        
		$icons = (is_array(unserialize($sec_options['sfsi_custom_files']))) ? unserialize($sec_options['sfsi_custom_files']) : array();
		if(empty($icons))
		{   
			end($icons);
			$new = 0;
		}    
		else {
			end($icons);
			$cnt = key($icons);
			$new = $cnt+1;
		}
		$NewIconName = "plus_custom_icon".$new.'.'.$ImageExt;
        $iconPath 	= $DestinationDirectory.$NewIconName; //Thumbnail name with destination directory
		// var_dump(sfsiplus_cropImage($CurWidth,$CurHeight,$ThumbSquareSize,$iconPath,$CreatedImage,$Quality,$ImageType));
		//Create a square Thumbnail right after, this time we are using sfsiplus_cropImage() function
		if(sfsiplus_cropImage($CurWidth,$CurHeight,$ThumbSquareSize,$iconPath,$CreatedImage,$Quality,$ImageType))
		{
			 	//update database information 
				$AccressImagePath=$AcceessUrl.$NewIconName;                                        
				$sec_options= (get_option('sfsi_plus_section1_options',false)) ? unserialize(get_option('sfsi_plus_section1_options',false)) : '' ;
				$icons = (is_array(unserialize($sec_options['sfsi_custom_files']))) ? unserialize($sec_options['sfsi_custom_files']) : array();
				$icons[] = $AccressImagePath;
				
				$sec_options['sfsi_custom_files'] = serialize($icons);
				$total_uploads = count($icons); end($icons); $key = key($icons);
				update_option('sfsi_plus_section1_options',serialize($sec_options));
				die(json_encode(array('res'=>'success','img_path'=>$AccressImagePath,'element'=>$total_uploads,'key'=>$key)));
	   }
	   else
	   {        
		   die(json_encode(array('res'=>'thumb_error')));
	   }
		
	}
}
/* delete uploaded icons */
add_action('wp_ajax_plus_deleteIcons','sfsi_plus_deleteIcons'); 

function sfsi_plus_deleteIcons()
{
	if ( !wp_verify_nonce( $_POST['nonce'], "plus_deleteIcons")) {
		echo  json_encode(array('res'=>"error")); exit;
	} 
	if(!current_user_can('manage_options')){ echo json_encode(array('res'=>'not allowed'));die(); }
   if(isset($_POST['icon_name']) && !empty($_POST['icon_name']))
   {
       /* get icons details to delete it from plugin folder */ 
       // $custom_icon=explode('_',$_POST['icon_name']); 
       $custom_icon_name= sanitize_text_field($_POST['icon_name']);
       preg_match_all('/\d+/', $custom_icon_name, $custom_icon_numbers);
       $custom_icon_number =    count($custom_icon_numbers)>0?((is_array($custom_icon_numbers[0])&&count($custom_icon_numbers[0])>0)?$custom_icon_numbers[0][0]:0):0;

       $sec_options1= (get_option('sfsi_plus_section1_options',false)) ? unserialize(get_option('sfsi_plus_section1_options',false)) : array() ;
       $sec_options2= (get_option('sfsi_plus_section2_options',false)) ? unserialize(get_option('sfsi_plus_section2_options',false)) : array() ;
       $up_icons= (is_array(unserialize($sec_options1['sfsi_custom_files']))) ? unserialize($sec_options1['sfsi_custom_files']) : array();
       $icons_links= (is_array(unserialize($sec_options2['sfsi_plus_CustomIcon_links']))) ? unserialize($sec_options2['sfsi_plus_CustomIcon_links']) : array();
       $icon_url=$up_icons[$custom_icon_number];  
       $url_info=  pathinfo($icon_url);      
      
	   // Changes By {Monad}
	   $imgpath = parse_url($icon_url, PHP_URL_PATH);
	   
	   if(is_file($_SERVER['DOCUMENT_ROOT'] . $imgpath))
	   {
        	unlink($_SERVER['DOCUMENT_ROOT'] . $imgpath);
       }
	   
	   
	if(isset($up_icons[$custom_icon_number]))
	{
         unset($up_icons[$custom_icon_number]);
         
         unset($icons_links[$custom_icon_number]);
	}
	else
	{
	  unset($up_icons[0]);
          unset($icons_links[0]);
	}        
         /* update database after delete */
	 $sec_options1['sfsi_custom_files']=serialize($up_icons);
         $sec_options2['sfsi_plus_CustomIcon_links']=serialize($icons_links);
         
         end($up_icons);
         $key=(key($up_icons))? key($up_icons) :$custom_icon_number ;
         $total_uploads=isset($up_icons) && is_array($up_icons) ?count($up_icons):0;
         
        update_option('sfsi_plus_section1_options',serialize($sec_options1));
        update_option('sfsi_plus_section2_options',serialize($sec_options2));
          
       die(json_encode(array('res'=>'success','last_index'=>$key,'total_up'=>$total_uploads)));
   }
    
}



/*  This function will proportionally resize image */
function sfsiplusresizeImage($CurWidth,$CurHeight,$MaxSize,$DestFolder,$SrcImage,$Quality,$ImageType)
{

	/* Check Image size is not 0 */
	if($CurWidth <= 0 || $CurHeight <= 0) 
	{
		return false;
	}
	/* Construct a proportional size of new image */
	$ImageScale      	= min($MaxSize/$CurWidth, $MaxSize/$CurHeight); 
	$NewWidth  			= ceil($ImageScale*$CurWidth);
	$NewHeight 			= ceil($ImageScale*$CurHeight);
	$NewCanves 			= imagecreatetruecolor($NewWidth, $NewHeight);
	
	/* Resize Image */
	if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight))
	{
		return $ImageType;
		switch(strtolower($ImageType))
		{
			case 'image/png':
				imagepng($NewCanves,$DestFolder);
				break;
			case 'image/gif':
				imagegif($NewCanves,$DestFolder);
				break;			
			case 'image/jpg':
				imagejpeg($NewCanves,$DestFolder,$Quality);
				break;
			case 'image/jpeg':
			case 'image/pjpeg':
				imagejpeg($NewCanves,$DestFolder,$Quality);
				break;
			default:
				return false;
		}
	/* Destroy image, frees memory	*/
	if(is_resource($NewCanves)) {imagedestroy($NewCanves);} 
	return true;
	}

}

/* This function corps image to create exact square images, no matter what its original size! */
function sfsiplus_cropImage($CurWidth,$CurHeight,$iSize,$DestFolder,$SrcImage,$Quality,$ImageType)
{	 
	//Check Image size is not 0
	if($CurWidth <= 0 || $CurHeight <= 0) 
	{
		return false;
	}
	
	if($CurWidth>$CurHeight)
	{
		$y_offset = 0;
		$x_offset = ($CurWidth - $CurHeight) / 2;
		$square_size 	= $CurWidth - ($x_offset * 2);
	}else{
		$x_offset = 0;
		$y_offset = ($CurHeight - $CurWidth) / 2;
		$square_size = $CurHeight - ($y_offset * 2);
	}
	
	$NewCanves 	= imagecreatetruecolor($iSize, $iSize);
	imagealphablending($NewCanves, false);
	imagesavealpha($NewCanves,true);
	$white = imagecolorallocate($NewCanves, 255, 255, 255);
	$alpha_channel = imagecolorallocatealpha($NewCanves, 255, 255, 255, 127); 
        imagecolortransparent($NewCanves, $alpha_channel); 
	$maketransparent = imagecolortransparent($NewCanves,$white);
	imagefill($NewCanves, 0, 0, $maketransparent);
	
	/*
	 * Change offset for increase image quality ($x_offset, $y_offset)
	 * imagecopyresampled($NewCanves, $SrcImage,0, 0, $x_offset, $y_offset, $iSize, $iSize, $square_size, $square_size)
	 */
	if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $iSize, $iSize, $square_size, $square_size))
	{
		imagesavealpha($NewCanves,true); 
		switch(strtolower($ImageType))
		{
			case 'image/png':
				imagepng($NewCanves,$DestFolder);
				break;
			case 'image/gif':
				imagegif($NewCanves,$DestFolder);
				break;	
			case 'image/jpg':
				imagejpeg($NewCanves,$DestFolder,$Quality);
				break;			
			case 'image/jpeg':
			case 'image/pjpeg':
				imagejpeg($NewCanves,$DestFolder,$Quality);
				break;
			default:
				return false;
		}
		
		/* Destroy image, frees memory	*/
		if(is_resource($NewCanves)) {imagedestroy($NewCanves);} 
		return true;
	}
	else
	{
		return false;
	}
}

add_action('wp_ajax_sfsi_plus_feedbackForm','sfsi_plus_feedbackForm');
function sfsi_plus_feedbackForm()
{
	if ( !wp_verify_nonce( $_POST['nonce'], "plus_feedbackForm")) {
		echo  json_encode(array('res'=>"error")); exit;
	} 
	if(!current_user_can('manage_options')){ echo json_encode(array('res'=>'not allowed'));die(); }
	if(!empty($_POST["msg"]))
	{
		$useremail	= "uninstall@ultimatelysocial.com";
		$subject 	= "Feedback from Ultimate Social Media Plus ".get_option('sfsi_plus_pluginVersion')." user";
		$from    	= $_POST["email"];
		$message    = $_POST["msg"];
		$sitename 	= get_bloginfo("name");
	
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text;charset=iso-8859-1" . "\r\n";
		$headers .= sprintf('From: %s <%s>', $sitename, $from). "\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion();
		
		mail($useremail,$subject,$message,$headers);
	}
	die;
}
