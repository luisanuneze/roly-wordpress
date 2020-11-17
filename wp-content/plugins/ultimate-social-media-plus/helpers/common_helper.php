<?php
if (!function_exists('array_column')) {
    /**
     * Returns the values from a single column of the input array, identified by
     * the $columnKey.
     *
     * Optionally, you may provide an $indexKey to index the values in the returned
     * array by the values from the $indexKey column in the input array.
     *
     * @param array $input A multi-dimensional array (record set) from which to pull
     *                     a column of values.
     * @param mixed $columnKey The column of values to return. This value may be the
     *                         integer key of the column you wish to retrieve, or it
     *                         may be the string key name for an associative array.
     * @param mixed $indexKey (Optional.) The column to use as the index/keys for
     *                        the returned array. This value may be the integer key
     *                        of the column, or it may be the string key name.
     * @return array
     */
    function array_column($input = null, $columnKey = null, $indexKey = null)
    {
        // Using func_get_args() in order to check for proper number of
        // parameters and trigger errors exactly as the built-in array_column()
        // does in PHP 5.5.
        $argc = func_num_args();
        $params = func_get_args();

        if ($argc < 2) {
            trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
            return null;
        }

        if (!is_array($params[0])) {
            trigger_error(
                'array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given',
                E_USER_WARNING
            );
            return null;
        }

        if (!is_int($params[1])
            && !is_float($params[1])
            && !is_string($params[1])
            && $params[1] !== null
            && !(is_object($params[1]) && method_exists($params[1], '__toString'))
        ) {
            trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
            return false;
        }

        if (isset($params[2])
            && !is_int($params[2])
            && !is_float($params[2])
            && !is_string($params[2])
            && !(is_object($params[2]) && method_exists($params[2], '__toString'))
        ) {
            trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
            return false;
        }

        $paramsInput = $params[0];
        $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;

        $paramsIndexKey = null;
        if (isset($params[2])) {
            if (is_float($params[2]) || is_int($params[2])) {
                $paramsIndexKey = (int) $params[2];
            } else {
                $paramsIndexKey = (string) $params[2];
            }
        }

        $resultArray = array();

        foreach ($paramsInput as $row) {
            $key = $value = null;
            $keySet = $valueSet = false;

            if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                $keySet = true;
                $key = (string) $row[$paramsIndexKey];
            }

            if ($paramsColumnKey === null) {
                $valueSet = true;
                $value = $row;
            } elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                $valueSet = true;
                $value = $row[$paramsColumnKey];
            }

            if ($valueSet) {
                if ($keySet) {
                    $resultArray[$key] = $value;
                } else {
                    $resultArray[] = $value;
                }
            }

        }

        return $resultArray;
    }
}
if(!function_exists('sfsi_plus_get_displayed_std_desktop_icons')){

    function sfsi_plus_get_displayed_std_desktop_icons($option1=false){

        $option1 =  false !== $option1 && is_array($option1) ? $option1 : unserialize(get_option('sfsi_plus_section1_options',false));

        $arrDisplay = array();

        if(false !== $option1 && is_array($option1) ){

            foreach ($option1 as $key => $value) {

                if(strpos($key, '_display') !== false){

                    $arrDisplay[$key] = isset($option1[$key]) ? sanitize_text_field($option1[$key]) : '';

                }       
            }
        }
        
        return $arrDisplay;

    }
}

if(!function_exists('sfsi_plus_get_displayed_custom_desktop_icons')){

    function sfsi_plus_get_displayed_custom_desktop_icons($option1=false){
        
        $option1 = false != $option1 && is_array($option1) ? $option1 : unserialize(get_option('sfsi_plus_section1_options',false));

        $arrDisplay = array();

        if(!empty($option1) && is_array($option1) && isset($option1['sfsi_custom_files']) 
            && !empty($option1['sfsi_custom_files']) ) :
            
            $arrdbDisplay = unserialize($option1['sfsi_custom_files']);
            
            if(is_array($arrdbDisplay)):

                $arrDisplay = $arrdbDisplay;

            endif;

        endif;

        return $arrDisplay;
    }

}

if(!function_exists('sfsi_plus_get_icon_image')){
    function sfsi_plus_get_icon_image($icon_name,$iconImgName=false){

        $icon = false;

        $option3 = unserialize(get_option('sfsi_plus_section3_options',false));

        if(isset($option3['sfsi_plus_actvite_theme']) && !empty($option3['sfsi_plus_actvite_theme'])){

            $active_theme = $option3['sfsi_plus_actvite_theme'];

            $icons_baseUrl  = SFSI_PLUS_PLUGURL."images/icons_theme/".$active_theme."/";
            $visit_iconsUrl = SFSI_PLUS_PLUGURL."images/visit_icons/";  

            if(isset($icon_name) && !empty($icon_name)):

                if($active_theme == 'custom_support')
                {
                    switch (strtolower($icon_name)) {

                        case 'facebook':
                            $custom_icon_name = "fb";
                            break;

                        case 'pinterest':
                            $custom_icon_name = "pintrest";
                            break;
                        
                        default:
                            $custom_icon_name = $icon_name;
                            break;
                    }

                    $key = 'plus_'.$custom_icon_name."_skin"; 
                    $skin = get_option($key,false);

                    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";

                    if($skin)
                    {
                        $skin_url = parse_url($skin);
                        if($skin_url['scheme']==='http' && $scheme==='https'){
                            $icon = str_replace('http','https',$skin);
                        }else if($skin_url['scheme']==='https' && $scheme==='http'){
                            $icon = str_replace('https','http',$skin);
                        }else{
                            $icon = $skin;
                        }
                    }
                    else
                    {
                        $active_theme = 'default';
                        $icons_baseUrl = SFSI_PLUS_PLUGURL."images/icons_theme/default/";

                        $iconImgName = false != $iconImgName ? $iconImgName: $icon_name; 
                        $icon = $icons_baseUrl.$active_theme."_".$iconImgName.".png";
                    }
                }
                else
                {
                    switch (strtolower($icon_name)) {

                        case 'facebook':
                            $custom_icon_name = "fb";
                            break;
                        
                        default:
                            $custom_icon_name = $icon_name;
                            break;
                    }                    

                    $iconImgName = false != $iconImgName ? $iconImgName: $custom_icon_name;
                    $icon = $icons_baseUrl.$active_theme."_".$iconImgName.".png";
                }

            endif;      

        }

        return $icon;
    }
}

if(!function_exists('sfsi_plus_generate_other_icon_effect_admin_html')){

    function sfsi_plus_generate_other_icon_effect_admin_html($iconName,$arrActiveDesktopIcons,$customIconIndex=-1,$customIconImgUrl=null,$customIconSrNo=null){ 

        $iconImgVal         = false;
        $activeIconImgUrl   = false;
     
        $classForRevertLink = 'hide';
        $defaultIconImgUrl  = false;

        $displayIconClass   = "hide";

        $arruploadDir   = wp_upload_dir();

        if( isset($iconName) && !empty($iconName)){ 

            if("custom" == $iconName && $customIconIndex >-1){

                if(null !== $customIconImgUrl){

                    $activeIconImgUrl  = $customIconImgUrl;                
                    $defaultIconImgUrl = $customIconImgUrl;

                    // Check if icon is selected under Question 1
                    if(in_array($customIconImgUrl, $arrActiveDesktopIcons)){
                        $displayIconClass = "show";
                    }

                    $iconNameStr = $iconName.$customIconSrNo;

                }

            }

            else{

                $dbKey = "sfsi_plus_".$iconName."_display";

                if(isset($arrActiveDesktopIcons[$dbKey]) && !empty($arrActiveDesktopIcons[$dbKey]) 
                    && "yes" == $arrActiveDesktopIcons[$dbKey]){
                    $displayIconClass = "show";
                }

                $activeIconImgUrl   = sfsi_plus_get_icon_image($iconName); 

                $iconNameStr = $iconName;
            }

            $attrCustomIconSrNo  = null !== $customIconSrNo ? 'data-customiconsrno="'.$customIconSrNo.'"': null;
            $attrCustomIconIndex = -1 != $customIconIndex ? 'data-customiconindex="'.$customIconIndex.'"': null;

            $attrIconName = 'data-iconname="'.$iconName.'"';

            ?>
            <div <?php echo $attrCustomIconIndex;?> <?php echo $attrIconName; ?> class="col-md-3 bottommargin20 <?php echo $displayIconClass; ?>">

                <label <?php echo $attrCustomIconSrNo; ?> class="mouseover_other_icon_label"><?php echo ucfirst($iconNameStr); ?> </label>

                <img data-defaultImg="<?php echo $defaultIconImgUrl; ?>" class="mouseover_other_icon_img" src="<?php echo $activeIconImgUrl; ?>">

                <input <?php echo $attrCustomIconIndex; ?> <?php echo $attrIconName; ?> type="hidden" value="<?php echo $iconImgVal; ?>" name="mouseover_other_icon_<?php echo $iconName; ?>">

                <a <?php echo $attrCustomIconIndex; ?> <?php echo $attrIconName; ?> id="btn_mouseover_other_icon_<?php echo $iconName; ?>" class="mouseover_other_icon_change_link" href="javascript:void(0)" class="mouseover_other_icon"><?php _e('Change',SFSI_PLUS_DOMAIN); ?></a>

                <a <?php echo $attrCustomIconIndex; ?> <?php echo $attrIconName; ?> class="<?php echo $classForRevertLink; ?> mouseover_other_icon_revert_link" href="javascript:void(0)" class="mouseover_other_icon"><?php _e('Revert',SFSI_PLUS_DOMAIN); ?></a>

            </div>

            <?php 
        
        }

    } 
}
if ( ! function_exists('sfsi_plus_write_log')) {
   function sfsi_plus_write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}
