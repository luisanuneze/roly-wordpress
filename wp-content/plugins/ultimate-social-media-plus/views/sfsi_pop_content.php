<?php 

$rss_readmore_text='Note: Also if you already offer a newsletter it makes sense to offer this option too, because it will get you more readers, as expained here.';
$ress_readmore_button='Ok, keep it active for the time being,I want to see how it works';
$rss_readmore_text2='Deactivate it';

define('rss_readmore', $rss_readmore_text);
define('ress_readmore_button', $ress_readmore_button);
define('rss_readmore_text2', $rss_readmore_text2);

$feedId 		= sanitize_text_field(get_option('sfsi_plus_feed_id',false));
$connectToFeed 	= "https://api.follow.it/?".base64_encode("userprofile=wordpress&feed_id=".$feedId);
$connectFeedLgn	= "https://api.follow.it/?".base64_encode("userprofile=wordpress&feed_id=".$feedId."&logintype=login");
?>

<div class="pop-overlay read-overlay feedClaiming-overlay" >
    <div class="pop_up_box sfsi_pop_up"  >
        <img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/newclose.png" id="close_popup" class="sfsicloseBtn" />
        <center>
          
            <form id="calimingOptimizationForm" method="get" action="https://api.follow.it/wpclaimfeeds/getFullAccess" target="_blank">
                <h1><?php  _e( 'Enter the email you want to use', SFSI_PLUS_DOMAIN ); ?></h1>
                <div class="form-field">
                    <input type="hidden" name="feed_id" value="<?php echo $feedId; ?>" />
                    <input type="email" name="email" value="<?php echo get_option("admin_email");?>" placeholder="Your email" style="color: #000 !important;" />
                </div>
                <div class="save_button">
                    <a href="javascript:;" id="getMeFullAccess" class="sfsi_plus_getMeFullAccess_class" data-nonce-fetch-feed-id="<?php echo wp_create_nonce( 'sfsi_plus_get_feed_id' );?>" title="Give me access">
                        <?php  _e( 'Give me access!', SFSI_PLUS_DOMAIN ); ?>
                    </a>
                </div>
                <p>
                	<?php  _e( 'This will create your FREE acccount on ', SFSI_PLUS_DOMAIN ); ?><a target="_blank" href="<?php echo $connectToFeed?>"><?php  _e( 'follow.it', SFSI_PLUS_DOMAIN ); ?></a>. <?php  _e( 'We will treat your data (and your subscribers’ data!) highly confidentially, see our ', SFSI_PLUS_DOMAIN ); ?><a target="_blank" href="https://follow.it/info/privacy"><?php  _e( 'Privacy Policy', SFSI_PLUS_DOMAIN ); ?></a>.
              </p>

              <!-- <p><?php  _e( 'If you already have an account, please ', SFSI_PLUS_DOMAIN ); ?><a href="<?php echo $connectFeedLgn?>" target="_blank"><?php  _e( 'click here', SFSI_PLUS_DOMAIN ); ?></a>.</p> -->
            </form>
        </center>    
	</div>
</div>

<div class="pop-overlay read-overlay" >
    <div class="pop_up_box sfsi_pop_up"  >
        <img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/close.jpg" id="close_popup" class="sfsicloseBtn" />
        <h4 id="readmore_text">
        	Note: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </h4>
</div>
</div>

<!-- Custom icon upload  Pop-up {Change by Monad}-->
<div class="pop-overlay upload-overlay" >
     
    <form id="customIconFrm" method="post" action="<?php echo admin_url( 'admin-ajax.php?action=UploadIcons' ); ?>" enctype="multipart/form-data" >
        <div class="pop_up_box upload_pop_up" id="tab1" style="min-height: 175px;">
            <img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/close.jpg" id="close_Uploadpopup" class="sfsicloseBtn" />
    	    <div class="sfsi_uploader">
                <div class="sfsi_popupcntnr">
                	<h3>
                   		<?php  _e( 'Steps:', SFSI_PLUS_DOMAIN ); ?>
                    </h3>
                    <ul class="flwstep">
                    	<li>
                        	1. <?php  _e( 'Click on << Upload >> below', SFSI_PLUS_DOMAIN ); ?>
                        </li>
                        <li>
                        	2. <?php  _e( 'Upload the icon into the media gallery', SFSI_PLUS_DOMAIN ); ?>
                        </li>
    					<li>
                        	3. <?php  _e( 'Click on << Insert into post >> ', SFSI_PLUS_DOMAIN ); ?>
                       </li>
                    </ul>    
                    <div class="upldbtn"><input name=""  type="button" value="Upload" class="upload_butt" onclick="upload_image_icon(this)" /></div>
                </div>
            </div>
          
            <input type="hidden" name="total_cusotm_icons" value="<?php echo $count;?>" id="plus_total_cusotm_icons" class="mediam_txt" />
            <!--<a href="javascript:;" id="close_Uploadpopup" title="Done">Done</a>-->
            <label style="color:red" class="uperror"></label>
        </div>
    </form>
   
    <script >
    	   function upload_image(ref)
		   {
				var title = jQuery(ref).attr('title');
				tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
				window.send_to_editor = function(html) {
					var url = jQuery('img',html).attr('src');
					if(url == undefined) 
					{
						var url = jQuery(html).attr('src');
					}
					plus_sfsi_customskin_upload(title+'='+url, ref);
					tb_remove();
				}
				return false;
			}

        function upload_image_icon(ref)
        {
            formfield = jQuery(ref).attr('name');
        	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        	window.send_to_editor = function(html) {
        		var url = jQuery('img',html).attr('src');
        		if(url == undefined) 
        		{
        			var url = jQuery(html).attr('src');
        		}
        		tb_remove();
        		// plus_sfsi_newcustomicon_upload(url);
            plus_sfsi_newcustomicon_upload(url,'<?php echo wp_create_nonce('plus_UploadIcons'); ?>','<?php echo wp_create_nonce('plus_deleteIcons'); ?>"');
        	}
        	return false;
        }
        
  function upload_image_icon_new(ref){
          
          var send_attachment_bkp = wp.media.editor.send.attachment;
      
          var frame = wp.media({
            title: 'Select or Upload image for icon',
            button: {
              text: 'Use this media'
            },
            multiple: false  // Set to true to allow multiple files to be selected
          });

          frame.on( 'select', function() {
            
            // Get media attachment details from the frame state
              var attachment = frame.state().get('selection').first().toJSON();

              var url        = attachment.url.split("/");
              var fileName   = url[url.length-1];
              var fileArr    = fileName.split(".");
              var fileType   = fileArr[fileArr.length-1];

              if(fileType!=undefined && (fileType=='jpeg' || fileType=='jpg' || fileType=='png' || fileType=='gif')){
                  plus_sfsi_newcustomicon_upload(attachment.url);
                  wp.media.editor.send.attachment = send_attachment_bkp;                                
              }
              else{
                  alert("Only Images are allowed to upload");
                  frame.open();                
              }
          });

          // Finally, open the modal on click
          frame.open();
          return false;    
  }  
  function upload_image_new(ref){
            
            var title = jQuery(ref).attr('title');
            var send_attachment_bkp = wp.media.editor.send.attachment;
        
            var frame = wp.media({
              title: 'Select or Upload image for icon',
              button: {
                text: 'Use this media'
              },
              multiple: false  // Set to true to allow multiple files to be selected
            });

            frame.on( 'select', function() {
              
              // Get media attachment details from the frame state
                var attachment = frame.state().get('selection').first().toJSON();

                var url        = attachment.url.split("/");
                var fileName   = url[url.length-1];
                var fileArr    = fileName.split(".");
                var fileType   = fileArr[fileArr.length-1];
                fileType       = fileType.toLowerCase();

                if(fileType!=undefined && (fileType=='jpeg' || fileType=='jpg' || fileType=='png' || fileType=='gif')){

                    plus_sfsi_customskin_upload(title+'='+attachment.url,ref);
                    wp.media.editor.send.attachment = send_attachment_bkp;                                
                }
                else{
                    alert("Only Images are allowed to upload");
                    frame.open();                
                }
            });

            // Finally, open the modal on click
            frame.open();
            return false;    
      }     
    </script>
</div><!-- Custom icon upload  Pop-up-->


<?php 
	 $active_theme=$option3['sfsi_plus_actvite_theme'];
     $icons_baseUrl=SFSI_PLUS_PLUGURL."/images/icons_theme/".$active_theme."/";
     $visit_iconsUrl= SFSI_PLUS_PLUGURL."/images/visit_icons/";
     $soicalObj=new sfsi_plus_SocialHelper();
     $twitetr_share=($option2['sfsi_plus_twitter_followUserName']!='') ?  "https://twitter.com/".$option2['sfsi_plus_twitter_followUserName'] : 'https://follow.it';
     $twitter_text=($option2['sfsi_plus_twitter_followUserName']!='') ?  $option2['sfsi_plus_twitter_aboutPageText'] : 'Create Your Perfect Newspaper for free';
?>

<!-- Facebook  example pop up -->
<div class="fb-overlay read-overlay fbex-s2" >
    <div class="pop_up_box_ex sfsi_pop_up adPopWidth" >
        <img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/close.jpg" id="close_popup" class="sfsicloseBtn" />
	    <h4 id="readmore_text">
        	<?php  _e( 'Move over the Facebook-icon…', SFSI_PLUS_DOMAIN ); ?>
        </h4>
    
        <div class="adminTooltip" >
           <a href="javascript:">
		   		<img width="51" class="sfsi_wicon" src="<?php echo SFSI_PLUS_PLUGURL; ?>images/fb.png" title="facebook" alt="facebook" />
		   </a>
           <div class="sfsi_plus_tool_tip_2 sfsi_plus_tool_tip_2_inr sfsi_plus_fb_tool_bdr" style="width: 59px;margin-left: -48.5px;">
               <span class="bot_arow bot_fb_arow "></span>
               <div class="sfsi_plus_inside fbb">
                   <div class="fb_1"><img src="<?php echo $visit_iconsUrl."fb.png"; ?>" /></div>    
                   <div class="fb_2"><img src="<?php echo $visit_iconsUrl."fblike_bck.png"; ?>" /></div>
                   <div class="fb_3"><img src="<?php echo $visit_iconsUrl."fbshare_bck.png"; ?>" /></div>
               </div>    
           </div>
   		
        </div>
    </div>
</div><!-- END Facebook  example pop up -->


<?php
	  $twit_tolCls = "100";
	  $twt_margin = "63";  
	  $icons_space = $option5['sfsi_plus_icons_spacing'];  
	  $twitter_user = $option2['sfsi_plus_twitter_followUserName'];
	  $twit_tolCls = round(strlen($twitter_user)*4+100+20); 
      $main_margin = round($icons_space)/2;
      $twt_margin = round($twit_tolCls/2+$main_margin+6);
?>
<!-- twiiter example pop-up -->
<div class="pop-overlay read-overlay twex-s2" >
    <div class="pop_up_box_ex sfsi_pop_up adPopWidth" >
        <img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/close.jpg" id="close_popup" class="sfsicloseBtn" />
    	<h4 id="readmore_text">
        	<?php  _e( 'Move over the Twitter-icon…', SFSI_PLUS_DOMAIN ); ?>
        </h4>
    
        <div class="adminTooltip" >
        	<a href="javascript:">
            	<img width="51" class="sfsi_wicon" src="<?php echo SFSI_PLUS_PLUGURL; ?>images/twitter.png" title="Twitter" alt="Twitter" />
            </a>
            <div class="sfsi_plus_tool_tip_2 sfsi_plus_tool_tip_2_inr sfsi_plus_twt_tool_bdr" style="width: 59px;margin-left: -48.5px;">
           		<span class="bot_arow bot_twt_arow"></span>
           		<div class="sfsi_plus_inside" >
           			<div class="twt_3"><img src="<?php echo $visit_iconsUrl."twitter.png"; ?>" /></div>
                    <div class="twt_1"><img src="<?php echo $visit_iconsUrl."twfollow_bck.png"; ?>" /></div>
           			<div class="twt_2"><img src="<?php echo $visit_iconsUrl."twtweet_bck.png"; ?>" /></div>
          		</div>    
            </div>
   		</div>
    </div>
</div><!-- END twiiter example pop-up -->


<?php 
	$youtube_url=($option2['sfsi_plus_youtube_pageUrl']!='') ?  $option2['sfsi_plus_youtube_pageUrl'] : 'http://www.youtube.com/user/follow.it' ;
	$youtube_user=($option4['sfsi_plus_youtube_user']!='' && isset($option4['sfsi_plus_youtube_user']))?  $option4['sfsi_plus_youtube_user'] : 'follow.it' ;
?>
<!-- You tube  example pop up -->
<div class="pop-overlay read-overlay ytex-s2" >
    <div class="pop_up_box_ex sfsi_pop_up adPopWidth" >
        <img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/close.jpg" id="close_popup" class="sfsicloseBtn" />
    	<h4 id="readmore_text">
        	<?php  _e( 'Move over the YouTube-icon…', SFSI_PLUS_DOMAIN ); ?>
        </h4>
    	
        <div class="adminTooltip" >
        	<a href="javascript:"><img width="51" class="sfsi_wicon" src="<?php echo SFSI_PLUS_PLUGURL; ?>images/youtube.png" title="youtube" alt="youtube" /></a>
        	<div class="sfsi_plus_tool_tip_2 sfsi_plus_tool_tip_2_inr utube_tool_bdr"  style=" margin-left: -55px; width: 96px;" >
           		<span class="bot_arow bot_utube_arow"></span>
           		<div class="sfsi_plus_inside">
               		<div class="utub_visit"><img src="<?php echo $visit_iconsUrl."youtube.png"; ?>" /></div>
           			<div class="utub_2"><img src="<?php echo $visit_iconsUrl."youtube_bck.png"; ?>" /></div>
                </div>    
        	</div>
   		</div>
	</div>
</div><!-- END You tube  example pop up -->
<?php 
$pin_url=($option2['sfsi_plus_pinterest_pageUrl']!='') ?  $option2['sfsi_plus_pinterest_pageUrl'] : 'http://pinterest.com/follow.it' ;
?>
<!-- Pinterest  example pop up -->
<div class="pop-overlay read-overlay pinex-s2" >
    <div class="pop_up_box_ex sfsi_pop_up adPopWidth" >
        <img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/close.jpg" id="close_popup" class="sfsicloseBtn" />
    	<h4 id="readmore_text">
        	<?php  _e( 'Move over the Pinterest-icon…', SFSI_PLUS_DOMAIN ); ?>
        </h4>
    
     	<div class="adminTooltip" >
        <a href="javascript:">
        	<img width="51" class="sfsi_wicon" src="<?php echo SFSI_PLUS_PLUGURL; ?>images/pinterest.png" title="pinterest" alt="pinterest" />
        </a>
        <div class="sfsi_plus_tool_tip_2 sfsi_plus_tool_tip_2_inr sfsi_plus_printst_tool_bdr"  style=" width: 73px; margin-left: -45.5px;" >
           <span class="bot_arow bot_pintst_arow"></span>
           <div class="sfsi_plus_inside">
               <div class="prints_visit"><img src="<?php echo $visit_iconsUrl."pinterest.png"; ?>" /></div>
               <div class="prints_visit_1"><img src="<?php echo $visit_iconsUrl."pinit_bck.png"; ?>" /></div>
           </div>    
        </div>
   	</div>
  </div>
</div> 
<!-- END Pinterest  example pop up -->

<?php 
	$linnked_share=($option2['sfsi_plus_linkedin_pageURL']!='') ?  $option2['sfsi_plus_linkedin_pageURL'] : 'https://www.linkedin.com/' ;
	$linkedIncom=($option2['sfsi_plus_linkedin_followCompany']!='') ?  $option2['sfsi_plus_linkedin_followCompany'] : '904740' ;
	$ln_product=($option2['sfsi_plus_linkedin_recommendProductId']!='') ?  $option2['sfsi_plus_linkedin_recommendProductId'] : '201714' ;
?>
<!-- LinkedIn  example pop up -->
<div class="pop-overlay read-overlay linkex-s2" style="display: block;z-index: -1;opacity: 0;" >
    <div class="pop_up_box_ex sfsi_pop_up adPopWidth" >
    	<img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/close.jpg" id="close_popup" class="sfsicloseBtn" />
    	<h4 id="readmore_text">
        	<?php  _e( 'Move over the LinkedIn-icon…', SFSI_PLUS_DOMAIN ); ?>
        </h4>
        <div class="adminTooltip" >
        	<a href="javascript:"><img width="51" class="sfsi_wicon" src="<?php echo SFSI_PLUS_PLUGURL;?>images/linked_in.png" title="LinkedIn" alt="LinkedIn"/></a>
        	<div class="sfsi_plus_tool_tip_2 sfsi_plus_tool_tip_2_inr sfsi_plus_linkedin_tool_bdr"  style=" width: 99px; margin-left: -61.5px;">
           		<span class="bot_arow bot_linkedin_arow"></span>
           		<div class="sfsi_plus_inside">
           		   <div style="margin:1px 5px;" class="linkin_1"><img src="<?php echo $visit_iconsUrl."linkedIn.png"; ?>" /></div>
                   <div class="linkin_2"><img src="<?php echo $visit_iconsUrl."linkinflw_bck.png"; ?>" /></div>
                   <div class="linkin_3"><img src="<?php echo $visit_iconsUrl."lnkdin_share_bck.png"; ?>" /></div>
                   <div class="linkin_4"><img src="<?php echo $visit_iconsUrl."lnkrecmd_bck.png"; ?>" /></div>
           		</div>    
        	</div>
   		</div>
  </div>
</div> 
<!-- END LinkedIn  example pop up -->


<!-- email deactivate pop-ups -->

<div class="pop-overlay read-overlay demail-1" >
    <div class="pop_up_box sfsi_pop_up" >
       <h4>
       		 <?php _e('Note: Also if you already offer a newsletter it makes sense to offer this option too, because it will get you more readers as explained', SFSI_PLUS_DOMAIN ); ?>
           	(<a href="https://api.follow.it/rss" target="_new" style="color:#5A6570;display: inline;text-decoration:underline">
                <?php  _e( 'learn more', SFSI_PLUS_DOMAIN ); ?>
           	</a>). 
       </h4>
       <div class="button">
           <a href="javascript:;" class="hideemailpop" title="Ok, keep it active for the time being,I want to see how it works">
                <?php  _e( 'Ok, keep it active for the time being, I want to see how it works', SFSI_PLUS_DOMAIN ); ?>
            </a>
       </div>
       <a href="javascript:;" id="deac_email2" title="Deactivate it">
              <?php  _e( 'Deactivate it', SFSI_PLUS_DOMAIN ); ?>
       </a>
  </div>
</div>

<div class="pop-overlay read-overlay demail-2" >
    <div class="pop_up_box sfsi_pop_up" >
      
       <h4 class="activate">
              <?php  _e( 'Ok, fine, however for using this plugin for FREE, please tell us what you think about it (and what can be improved). It only takes a minute. Thank you!', SFSI_PLUS_DOMAIN ); ?>
       </h4>
		

        <div class="button">
            <a target="_blank" href="https://wordpress.org/support/plugin/ultimate-social-media-plus/#new-topic-0" class="" title="Ok, give feedback">
                <?php  _e( 'Ok, give feedback', SFSI_PLUS_DOMAIN ); ?>
            </a>
        </div>
        <a href="javascript:;" id="deac_email3" title="Don’t give feedback">
            <?php  _e( 'Don’t give feedback', SFSI_PLUS_DOMAIN ); ?>
        </a>
  </div>
</div>

<div class="pop-overlay read-overlay demail-3">
    <div class="pop_up_box sfsi_pop_up" >
       <h4>
              <?php  _e( 'You’re a toughie. Last try: as a minimum, could you please support us by activating a link back to our the site? ', SFSI_PLUS_DOMAIN ); ?>
       </h4>

      <?php $nonce = wp_create_nonce("active_plusfooter");?>

        <div class="button">
            <a href="javascript:;" target="_new" class="sfsiplus_activate_footer activate" data-nonce="<?php echo $nonce;?>" title="Ok, activate link" >
                <?php  _e( 'Ok, activate link', SFSI_PLUS_DOMAIN ); ?>
            </a>
        </div>
        <a href="javascript:;" class="hidePop" title="Don’t activate and exit">
            <?php  _e( 'Don’t activate and exit', SFSI_PLUS_DOMAIN ); ?>
        </a>
      </div>
</div> <!-- END email deactivate pop-ups -->

<!--Custom Skin popup {Monad}-->
<div class="pop-overlay cstmskins-overlay" >
    <div class="cstmskin_popup" >
        <img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/close.jpg" id="custmskin_clspop" class="sfsicloseBtn" data-nonce="<?php echo wp_create_nonce('plus_Iamdone');  ?>" />
        
        <div class="cstomskins_wrpr">
            <h3>
           		<?php  _e( 'Upload custom icons', SFSI_PLUS_DOMAIN ); ?>
            </h3>
            <div class="custskinmsg">
            	<?php  _e( 'Here you can upload custom icons which perform the same actions as the standard icons.', SFSI_PLUS_DOMAIN ); ?>
                <ul>
                    <li>
                		1. <?php  _e( 'Click on << Upload >> below', SFSI_PLUS_DOMAIN ); ?>
                    </li>
                    <li>
                    	2. <?php  _e( 'Upload the icon into the media gallery', SFSI_PLUS_DOMAIN ); ?>
                    </li>
                    <li>
                     	3. <?php  _e( 'Click on << Insert into post >>', SFSI_PLUS_DOMAIN ); ?>
					</li>
                </ul>
            </div>
            
            <ul class="cstmskin_iconlist">
            	<li>
                	<div class="cstm_icnname">
                    	RSS
                    </div>
                    <div class="cstmskins_btn">
                    	<?php 
							$nonce = wp_create_nonce("sfsi_plus_deleteCustomSkin");
							if(get_option("plus_rss_skin"))
							{
								$rss_skin = get_option("plus_rss_skin");
								echo "<img src='".$rss_skin."' width='30px' height='30px' class='imgskin'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_rss_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_rss_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_rss_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_rss_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                <li>
                	<div class="cstm_icnname">
                    	Email
                    </div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("plus_email_skin"))
							{
								$email_skin = get_option("plus_email_skin");
								echo "<img src='".$email_skin."' width='30px' height='30px' class='imgskin'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_email_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_email_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_email_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_email_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                <li>
                	<div class="cstm_icnname">
                    	Facebook
                    </div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("plus_facebook_skin"))
							{
								$facebook_skin = get_option("plus_facebook_skin");
								echo "<img src='".$facebook_skin."' width='30px' height='30px'  class='imgskin'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_facebook_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_facebook_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_facebook_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_facebook_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                <li>
                	<div class="cstm_icnname">
                    	Twitter
                    </div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("plus_twitter_skin"))
							{
								$twitter_skin = get_option("plus_twitter_skin");
								echo "<img src='".$twitter_skin."' width='30px' height='30px' class='imgskin'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_twitter_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_twitter_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_twitter_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_twitter_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                <li>
                	<div class="cstm_icnname">
                    	Share
                    </div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("plus_share_skin"))
							{
								$share_skin = get_option("plus_share_skin");
								echo "<img src='".$share_skin."' width='30px' height='30px' class='imgskin'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_share_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_share_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_share_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_share_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                <li>
                	<div class="cstm_icnname">
                    	Youtube
                    </div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("plus_youtube_skin"))
							{
								$youtube_skin = get_option("plus_youtube_skin");
								echo "<img src='".$youtube_skin."' width='30px' height='30px'  class='imgskin'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_youtube_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_youtube_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_youtube_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_youtube_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                <li>
                	<div class="cstm_icnname">
                    	Linkedin
                    </div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("plus_linkedin_skin"))
							{
								$linkedin_skin = get_option("plus_linkedin_skin");
								echo "<img src='".$linkedin_skin."' width='30px' height='30px'  class='imgskin'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_linkedin_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_linkedin_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_linkedin_skin" class="cstmskin_btn">Upload</a>';	
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_linkedin_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                <li>
                	<div class="cstm_icnname">
                    	Pinterest
                    </div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("plus_pintrest_skin"))
							{
								$pintrest_skin = get_option("plus_pintrest_skin");
								echo "<img src='".$pintrest_skin."' width='30px' height='30px' class='imgskin'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_pintrest_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_pintrest_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_pintrest_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_pintrest_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                <li>
                	<div class="cstm_icnname">
                    	Instagram
                    </div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("plus_instagram_skin"))
							{
								$instagram_skin = get_option("plus_instagram_skin");
								echo "<img src='".$instagram_skin."' width='30px' height='30px' class='imgskin'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_instagram_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_instagram_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="plus_instagram_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_instagram_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';		
							}
						?>
                    </div>
                </li>
                <li>
                  <div class="cstm_icnname">
                      Houzz
                    </div>
                    <div class="cstmskins_btn">
                      <?php 
              if(get_option("plus_houzz_skin"))
              {
                $houzz_skin = get_option("plus_houzz_skin");
                echo "<img src='".$houzz_skin."' width='30px' height='30px'  class='imgskin'>";
                echo '<a href="javascript:" onclick="upload_image(this);" title="plus_houzz_skin" class="cstmskin_btn">Update</a>';
                echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_houzz_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
              }
              else
              {
                echo "<img src='' width='30px' height='30px' class='imgskin skswrpr'>";
                echo '<a href="javascript:" onclick="upload_image(this);" title="plus_houzz_skin" class="cstmskin_btn">Upload</a>';
                echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_hozz_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
              }
            ?>
              </div>
          </li>
          <li>
            <div class="cstm_icnname">
              Telegram
            </div>
            <div class="cstmskins_btn">
              <?php 
                  if(get_option("plus_telegram_skin"))
                  {
                    $telegram_skin = get_option("plus_telegram_skin");
                    echo "<img src='".$telegram_skin."' width='30px' height='30px'  class='imgskin'>";
                    echo '<a href="javascript:" onclick="upload_image(this);" title="plus_telegram_skin" class="cstmskin_btn">Update</a>';
                    echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_telegram_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
                  }
                  else
                  {
                    echo "<img src='' width='30px' height='30px' class='imgskin skswrpr'>";
                    echo '<a href="javascript:" onclick="upload_image(this);" title="plus_telegram_skin" class="cstmskin_btn">Upload</a>';
                    echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_telegram_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
                  }
                ?>
              </div>
            </li>
            <li>
              <div class="cstm_icnname">
                  VK
                </div>
                <div class="cstmskins_btn">
                  <?php 
                      if(get_option("plus_vk_skin"))
                      {
                        $vk_skin = get_option("plus_vk_skin");
                        echo "<img src='".$vk_skin."' width='30px' height='30px'  class='imgskin'>";
                        echo '<a href="javascript:" onclick="upload_image(this);" title="plus_vk_skin" class="cstmskin_btn">Update</a>';
                        echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_vk_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
                      }
                      else
                      {
                        echo "<img src='' width='30px' height='30px' class='imgskin skswrpr'>";
                        echo '<a href="javascript:" onclick="upload_image(this);" title="plus_vk_skin" class="cstmskin_btn">Upload</a>';
                        echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_vk_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
                      }
                    ?>
              </div>
            </li>
            <li>
              <div class="cstm_icnname">
                  OK
                </div>
                <div class="cstmskins_btn">
                  <?php 
                      if(get_option("plus_ok_skin"))
                      {
                        $ok_skin = get_option("plus_ok_skin");
                        echo "<img src='".$ok_skin."' width='30px' height='30px'  class='imgskin'>";
                        echo '<a href="javascript:" onclick="upload_image(this);" title="plus_ok_skin" class="cstmskin_btn">Update</a>';
                        echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_ok_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
                      }
                      else
                      {
                        echo "<img src='' width='30px' height='30px' class='imgskin skswrpr'>";
                        echo '<a href="javascript:" onclick="upload_image(this);" title="plus_ok_skin" class="cstmskin_btn">Upload</a>';
                        echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_ok_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
                      }
                    ?>
              </div>
            </li>
                  <li>
              <div class="cstm_icnname">
                  Wechat
                </div>
                <div class="cstmskins_btn">
                  <?php 
                      if(get_option("plus_wechat_skin"))
                      {
                        $wechat_skin = get_option("plus_wechat_skin");
                        echo "<img src='".$wechat_skin."' width='30px' height='30px'  class='imgskin'>";
                        echo '<a href="javascript:" onclick="upload_image(this);" title="plus_wechat_skin" class="cstmskin_btn">Update</a>';
                        echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_wechat_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
                      }
                      else
                      {
                        echo "<img src='' width='30px' height='30px' class='imgskin skswrpr'>";
                        echo '<a href="javascript:" onclick="upload_image(this);" title="plus_wechat_skin" class="cstmskin_btn">Upload</a>';
                        echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_wechat_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
                      }
                    ?>
              </div>
            </li>
            <li>
              <div class="cstm_icnname">
                  Weibo
                </div>
                <div class="cstmskins_btn">
                  <?php 
                      if(get_option("plus_weibo_skin"))
                      {
                        $weibo_skin = get_option("plus_weibo_skin");
                        echo "<img src='".$weibo_skin."' width='30px' height='30px'  class='imgskin'>";
                        echo '<a href="javascript:" onclick="upload_image(this);" title="plus_weibo_skin" class="cstmskin_btn">Update</a>';
                        echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_weibo_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
                      }
                      else
                      {
                        echo "<img src='' width='30px' height='30px' class='imgskin skswrpr'>";
                        echo '<a href="javascript:" onclick="upload_image(this);" title="plus_weibo_skin" class="cstmskin_btn">Upload</a>';
                        echo '<a href="javascript:" onclick="sfsiplus_deleteskin_icon(this);" title="plus_weibo_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
                      }
                    ?>
              </div>
            </li>
            
            </ul>
            <div class="cstmskins_sbmt">
            	<a href="javascript:" class="done_btn" onclick="SFSI_plus_done('<?php echo wp_create_nonce('plus_Iamdone');  ?>');">
                	<?php  _e( "I'm done!", SFSI_PLUS_DOMAIN ); ?>
                </a> 
            </div>
           
        </div>
    	<script >
		   function upload_image(ref)
		   {
				var title = jQuery(ref).attr('title');
				tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
				window.send_to_editor = function(html) {
					var url = jQuery('img',html).attr('src');
					if(url == undefined) 
					{
						var url = jQuery(html).attr('src');
					}
					plus_sfsi_customskin_upload(title+'='+url, ref,'<?php echo wp_create_nonce('plus_UploadSkins') ?>');
					tb_remove();
				}
				return false;
			}
		 </script>
    </div>    
</div>

<!-- quickpay overlay -->
<div class="pop-overlay read-overlay sfsi_plus_quickpay-overlay" style="background:rgba(255,255,255,.6);z-index:9999;overflow-y:auto" >
  <script src="https://sellcodes.com/quick_purchase/XdHlrQnc/embed.js"></script>
  <div class="pop_up_box sfsi_pop_up" style="padding-left: 0;padding-right: 0;padding-top:0;margin-top:7%;width:50%;font-family: 'Josefin Sans', sans-serif;" >
    <div class="" >
      <h2 style="font-size: 30px; padding: 30px 10px ; border:1px solid #eee;background:#fbfbfb;text-align:center;font-family: 'Josefin Sans', sans-serif;" >How do you want to pay?</h2>
    </div>   
    <div class="sfsi_plus_quick-pay-box"  >
      <div>
        <div class="sfsi_plus_row sfsi_plus_text_center">
          <div class="sfsi_plus_col_6" style="text-align: right; vertical-align: middle;">
              <div class="sellcodes-quick-purchase" onclick="sfsi_plus_quickpay_container_click(event)" style="margin-right: 15px; padding: 18px 40px !important;cursor:pointer">
                <p class="sc-button" data-product-id="XdHlrQnc" data-option-id="ftHaa2zt" data-paymethod="0"  data-redirect="1" >
                  <img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/visa.png" />
                  <img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/mastercard.png" />
                </p>
              </div>
          </div>
          <div class="sfsi_plus_col_6"  style="text-align: left; vertical-align: middle;">
             <div class="sellcodes-quick-purchase" onclick="sfsi_plus_quickpay_container_click(event)"  style="margin-left: 0px;cursor:pointer">
                <p class="sc-button" data-product-id="XdHlrQnc" data-option-id="ftHaa2zt" data-paymethod="1"  data-redirect="1" >
                  <img src="<?php echo SFSI_PLUS_PLUGURL; ?>images/paypal-1.png"/>
              </p>
            </div>
          </div>
        </div>
        <div class="sfsi_plus_subheading" style="text-align: center;color:#888;margin:20px;" >Click will establish a connection to Sellcodes.com</div>
      </div>
      <div class="sfsi_plus_quick-pay-box_container"  style="background: #fbfbfb;padding-top: 20px;padding-bottom: 20px;border-top:1px solid #eee" >
        <div class="sfsi_plus_quick-pay-box_on_box" style="background: transparent; padding: 0 10px; display:block; width: 97%; position: absolute; font-weight: 700; letter-spacing: 2px; text-align: center; font-size: 20px; color: #000000;" ><span style="background: #fbfbfb; padding: 0 20px;">Key points</span></div>
        <div style="margin:10px 70px;border-radius:10px;border:1px solid #bbb;font-size: 17px;line-height: 28px;" >
          <ol style="padding: 15px 20px 10px 10px; font-size: 18px; letter-spacing: 0.5px; color: #000000;">
            <li>You‘ll get access to <a href="https://www.ultimatelysocial.com/usm-premium/" target="_black" style="color: #000000;">all premium features</a></li>
            <li>The plugin is <b>priced really fairly</b> starting at <del>49.98 USD</del> today: 40% off!</li>
            <li><b>Use it for lifetime:</b> Support and updates are limited to six months, however after that it will not be disabled, you can keep using the plugin (even if you don‘t renew)</li>
            <li>One license is valid for one the site (as support is included), but we <b>offer 20% discounts</b> for all future purchases</li>
            <li>We provide a <b>14 day money-back guarantee</b> if you‘re not satisfied for <u>any reason</u></li>
          </ol>
          <div style="text-align: center;margin-bottom:20px; color: #000000; letter-spacing: 0.5px;" >Still have questions? <a href="" onclick="event.preventDefault();sfsi_plus_open_chat();sfsi_plus_close_quickpay()" style="display:inline;font-weight: inherit; color: #000000;">Please ask!</a></div>
        </div>
        <div style="text-align: center;font-size:20px; margin: 40px 0 25px 0; letter-spacing: 1px;" >
          <a href="" onclick="event.preventDefault();sfsi_plus_close_quickpay();" style="color: #000000; font-weight: 700;">Close</a>
        </div>  
      </div>
    </div>
  </div>
</div>
<div class="pop-overlay read-overlay sfsi_plus_wait_container" style="background:rgba(255,255,255,.6);z-index:9999;overflow-y:auto" >
  <div class="sfsi_pop_up" style="padding-left: 0;padding-right: 0;padding-top:0;width:100%" >
    <div class="sfsi_plus_wait" style="width: 50px;height: 50px;margin: 25% auto;">
      <img src="<?php echo SFSI_PLUS_PLUGURL ?>images/ajax-loader.gif" alt="error" >
    </div>
  </div>
</div>
