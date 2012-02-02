<?php
/*
NOTE: this file requires WordPress 2.7+ to function
*/
$settings = 'mods_'.get_current_theme(); // do not change!

$defaults = array( // define our defaults
'featuredcat' => '1',
'box1' => 'Enable',
'box2' => 'Enable',
'box3' => 'Enable',
'box4' => 'Enable',
'box5' => 'Enable',
'box6' => 'Enable',
'box7' => 'Enable',
'box8' => 'Enable', 
'box9' => 'Enable', 
'box1cat' => '1',
'box2cat' => '1',
'box3cat' => '1',
'box4cat' => '1',
'box5cat' => '1',
'box6cat' => '1',
'box7cat' => '1',
'box8cat' => '1',
'box9cat' => '1',
'style1' => 'style.css',
'list2' => '4',
'postboxthumbw' => '120',
'postboxthumbh' => '90',
'twitter_id' => 'wparcade',
'track' => 'Yes',
'ad468x60' => '',
'ad300x250' => '',
'ad728x90' => '',
'showad468x60' => 'Yes',
'showad300x250' => 'Yes',

// <-- no comma after the last option
);

//	push the defaults to the options database,
//	if options don't yet exist there.
add_option($settings, $defaults, '', 'yes');


/*
///////////////////////////////////////////////
This section hooks the proper functions
to the proper actions in WordPress
\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
*/
//	this function registers our settings in the db
add_action('admin_init', 'register_theme_settings');
function register_theme_settings() {
global $settings;
register_setting($settings, $settings);
}
//	this function adds the settings page to the Appearance tab
add_action('admin_menu', 'add_theme_options_menu');
function add_theme_options_menu() {
add_submenu_page('themes.php', __('MonstersWPA Theme Options', 'wparcade'), __('MonstersWPA Theme Options', 'wparcade'), 8, 'theme-options', 'theme_settings_admin');
}

function theme_settings_admin() { ?>
<?php theme_options_css_js(); ?>

<div class="wrap">
<?php
global $settings, $defaults;
if(get_theme_mod('reset')) {
echo '<div class="updated fade" id="message"><p>'.__('Theme Options', 'wparcade').' <strong>'.__('Reset to defaults', 'wparcade').'</strong></p></div>';
update_option($settings, $defaults);
} elseif($_REQUEST['updated'] == 'true') {
echo '<div class="updated fade" id="message"><p>'.__('Theme Options', 'wparcade').' <strong>'.__('Saved', 'wparcade').'</strong></p></div>';
}
screen_icon('options-general');
?>
<h2><?php echo get_current_theme() . ' '; _e('Theme Options', 'wparcade'); ?></h2>
<form method="post" action="options.php">
<?php settings_fields($settings); // important! ?>
<?php // begin first column ?>
<div class="metabox-holder">
<div class="postbox">

<div class="inside">
<p>

<center><a href="http://wparcade.com/"><img src="http://wparcade.com/uploads/logo2.png" style="border:0px;"/></a>
<br />
<a href="http://wparcade.com/support">Get Suport</a> | <a href="http://wparcade.com/contact-us">Contact Us</a> | <a href="http://wparcade.com/affiliates">Earn Money </a> 
<br /> <br /> <br /></center>
</p>
</div>
</div>

<div class="postbox">
<h3 style="color: #364E4E; background:#B6DCE5; border:1px solid #B3CED9; text-shadow:none; text-transform:uppercase;">Theme Style</h3>
<div class="inside">

<p>
<?php _e("Select the Style", 'wparcade'); ?>
<br/>
<select name="<?php echo $settings; ?>[style1]">
<option style="padding-right:10px;" value="style.css" <?php selected('style.css', get_theme_mod('style1')); ?>>Monsters</option> 
<option style="padding-right:10px;" value="styles/monstersg.css" <?php selected('styles/monstersg.css', get_theme_mod('style1')); ?>>Monsters Green</option> <option style="padding-right:10px;" value="styles/monstersp.css" <?php selected('styles/monstersp.css', get_theme_mod('style1')); ?>>Monsters Purple</option>
 <option style="padding-right:10px;" value="styles/monstersb.css" <?php selected('styles/monstersb.css', get_theme_mod('style1')); ?>>Monsters Blue</option>
  <option style="padding-right:10px;" value="styles/monsterso.css" <?php selected('styles/monsterso.css', get_theme_mod('style1')); ?>>Monsters Orange</option>
</select>
<span style="margin-left:10px; color: #999999;">
<?php _e("(default: Mario and Luigi)", 'wparcade'); ?>
</span> </p> 

</div>
</div>

<div class="postbox">
<h3 style="color: #364E4E; background:#B6DCE5; border:1px solid #B3CED9; text-shadow:none; text-transform:uppercase;">Get Custom Style and Logo</h3>
<div class="inside">
<p>
If you need a custom <strong>design</strong> or custom <strong>logo</strong> please <a href="http://wparcade.com/contact-us">Contact Us</a>! We will review your request and give you a <strong>quote</strong>! 

<br />  
</p>
</div>
</div>

</div>

<div class="metabox-holder">

<div class="postbox">
<h3 style="color: #364E4E; background:#B6DCE5; border:1px solid #B3CED9; text-shadow:none; text-transform:uppercase;">Featured Games</h3>
<div class="inside">
<p>
<?php _e("Category for Featured Games", 'wparcade'); ?>
<br/>
<?php wp_dropdown_categories(array('selected' => get_theme_mod('featuredcat'), 'name' => $settings.'[featuredcat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?>
</p>
</div>
</div>
<!--end: featured news--> 

<!--end: content middle--> 
<div class="postbox">
<h3 style="color: #364E4E; background:#B6DCE5; border:1px solid #B3CED9; text-shadow:none; text-transform:uppercase;">Front Page Games Category</h3>
<div class="inside">
<p>
<p>
<?php _e("[Left] Category Box #1", 'wparcade'); ?>
<br/>
<?php wp_dropdown_categories(array('selected' => get_theme_mod('box4cat'), 'name' => $settings.'[box4cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?>

</p>
<p>
<?php _e("[Left] Category Box #2", 'wparcade'); ?>
<br/>
<?php wp_dropdown_categories(array('selected' => get_theme_mod('box5cat'), 'name' => $settings.'[box5cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?>

</p>
<p>
<?php _e("[Left] Category Box #3", 'wparcade'); ?>
<br/>
<?php wp_dropdown_categories(array('selected' => get_theme_mod('box6cat'), 'name' => $settings.'[box6cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?>
</p>
<p>
<?php _e("[Right] Category Box #1", 'wparcade'); ?>
<br/>
<?php wp_dropdown_categories(array('selected' => get_theme_mod('box7cat'), 'name' => $settings.'[box7cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?>
</p>
<p>
<?php _e("[Right] Category Box #2", 'wparcade'); ?>
<br/>
<?php wp_dropdown_categories(array('selected' => get_theme_mod('box8cat'), 'name' => $settings.'[box8cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?>

</p>
<p>
<?php _e("[Right] Category Box #3", 'wparcade'); ?>
<br/>
<?php wp_dropdown_categories(array('selected' => get_theme_mod('box9cat'), 'name' => $settings.'[box9cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?>

</p>
<p>
<?php _e("Number of Games in each Box", 'wparcade'); ?>
<br/>
<select name="<?php echo $settings; ?>[list2]">
<option style="padding-right:10px;" value="1" <?php selected('1', get_theme_mod('list2')); ?>>3</option>
<option style="padding-right:10px;" value="2" <?php selected('2', get_theme_mod('list2')); ?>>4</option>
<option style="padding-right:10px;" value="3" <?php selected('3', get_theme_mod('list2')); ?>>5</option>
<option style="padding-right:10px;" value="4" <?php selected('4', get_theme_mod('list2')); ?>>6</option>
<option style="padding-right:10px;" value="5" <?php selected('5', get_theme_mod('list2')); ?>>7</option>
<option style="padding-right:10px;" value="6" <?php selected('6', get_theme_mod('list2')); ?>>8</option>
<option style="padding-right:10px;" value="7" <?php selected('7', get_theme_mod('list2')); ?>>9</option>
<option style="padding-right:10px;" value="8" <?php selected('8', get_theme_mod('list2')); ?>>10</option>
</select>
<span style="margin-left:10px; color: #999999;">
<?php _e("(default: 6)", 'wparcade'); ?>
</span> </p>
<p>
<?php _e("Thumbnail size[width x height]:", 'wparcade'); ?>
<br/>
<input type="text" name="<?php echo $settings; ?>[postboxthumbw]" value="<?php echo get_theme_mod('postboxthumbw'); ?>" size="4" />
x
<input type="text" name="<?php echo $settings; ?>[postboxthumbh]" value="<?php echo get_theme_mod('postboxthumbh'); ?>" size="4" />
<span style="margin-left:10px; color: #999999;">
<?php _e("(default: 120x90)", 'wparcade'); ?>
</span> </p> 
</div>
</div>
<!--end: content left-->
</div>
<?php // end first column ?>
<?php // begin second column ?>
<div class="metabox-holder">
<div class="postbox">
<h3 style="color: #364E4E; background:#B6DCE5; border:1px solid #B3CED9; text-shadow:none; text-transform:uppercase;">
<?php _e("728x90 Ad", 'wparcade'); ?>
</h3>
<div class="inside">

<p>
<?php _e("Enter your ad code [html]", 'wparcade'); ?>
:<br />
<textarea name="<?php echo $settings; ?>[ad728x90]" cols=38 rows=6><?php echo stripslashes(get_theme_mod('ad728x90')); ?></textarea>
</p>
</div>
</div>
<!--end: subscribe-->
<div class="postbox">
<h3 style="color: #364E4E; background:#B6DCE5; border:1px solid #B3CED9; text-shadow:none; text-transform:uppercase;">
<?php _e("468x60 Ad", 'wparcade'); ?>
-
<?php _e("Header", 'wparcade'); ?>
</h3>
<div class="inside">

<p>
<?php _e("Enter your ad code [html]", 'wparcade'); ?>
:<br />
<textarea name="<?php echo $settings; ?>[ad468x60]" cols=38 rows=6><?php echo stripslashes(get_theme_mod('ad468x60')); ?></textarea>
</p>
</div>
</div>
<!--end: 468x60 ad-->
<div class="postbox">
<h3 style="color: #364E4E; background:#B6DCE5; border:1px solid #B3CED9; text-shadow:none; text-transform:uppercase;">
<?php _e("300x250 Ad", 'wparcade'); ?>
-
<?php _e("Sidebar", 'wparcade'); ?>
</h3>
<div class="inside">

<p>
<?php _e("Enter your ad code [html]", 'wparcade'); ?>
:<br />
<textarea name="<?php echo $settings; ?>[ad300x250]" cols=38 rows=6><?php echo stripslashes(get_theme_mod('ad300x250')); ?></textarea>
</p>
</div>
</div>
<!--end: 300x250 ad-->
<div class="postbox">
<h3 style="color: #364E4E; background:#B6DCE5; border:1px solid #B3CED9; text-shadow:none; text-transform:uppercase;">
<?php _e("Analytics/Stat Tracking Code", 'wparcade'); ?>
</h3>
<div class="inside">
<p>

<?php _e("Enter your analytics/stat tracking code [html]", 'wparcade'); ?>
:<br />
<textarea name="<?php echo $settings; ?>[track_code]" cols=38 rows=5><?php echo stripslashes(get_theme_mod('track_code')); ?></textarea>
</p>
</div>
</div>
<!--end: tracking-->
<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Settings', 'wparcade') ?>" style="color: #364E4E; background:#B6DCE5; border:1px solid #B3CED9; text-shadow:none; text-transform:uppercase;"/>
<input type="submit" class="button-highlighted" name="<?php echo $settings; ?>[reset]" value="<?php _e('Reset Settings', 'wparcade'); ?>" style="color: #364E4E; background:#B6DCE5; border:1px solid #B3CED9; text-shadow:none; text-transform:uppercase;"/>
</p>
</div>
<!--end: second column-->
</form>
</div>
<?php }

// add CSS and JS if necessary
function theme_options_css_js() {
echo <<<CSS

<style type="text/css">
.metabox-holder { 
width: 350px; float: left;
margin: 0; padding: 0 10px 0 0;
}
.metabox-holder .postbox .inside {
padding: 0 10px;
}
input, textarea, select {
margin: 5px 0 5px 0;
padding: 1px;
}
</style>

CSS;
echo <<<JS

<script type="text/javascript">
jQuery(document).ready(function($) {
$(".fade").fadeIn(1000).fadeTo(1000, 1).fadeOut(1000);
});
</script>

JS;
}
?>