<?php

/*
Plugin Name: wp-Table
Plugin URI: http://alexrabe.boelinger.com/?page_id=3
Description: This plugin is a simple table manager. I didn't find anything in the web which creates the same result, for my purpose.
Author: Alex Rabe
Version: 1.52
Author URI: http://alexrabe.boelinger.com/

Copyright 2006-2007 by Alex Rabe

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/  

// Load language
function wpTable_init ()
{
	load_plugin_textdomain('wpTable','wp-content/plugins/wp-table');
}
// load language file
add_action('init', 'wpTable_init');

// Dashboard update notification 
function wptable_update_dashboard() {
  $Check = new CheckPlugin();
  $Check->URL 	= "http://nextgen.boelinger.com/version.php";
  $Check->version = "1.52";
  $Check->name 	= "wpTable";
  if ($Check->startCheck()) {
    echo '<h3>'.__('wp-Table Update','wpTable').'</h3>';
    echo '<p>'.__('A new version is available. Download','wpTable').' <a href="http://wordpress.org/extend/plugins/wp-table/download/">here</a></p>';
  } 
}

add_action('activity_box_end', 'wptable_update_dashboard', '0');

// define URL
$myabspath = str_replace("\\","/",ABSPATH);  // required for windows
define('WPTABLE_URLPATH', get_option('siteurl').'/wp-content/plugins/' . dirname(plugin_basename(__FILE__)).'/');
define('WPTABLE_ABSPATH', $myabspath.'wp-content/plugins/' . dirname(plugin_basename(__FILE__)).'/');

global $wpdb;

$wpdb->golftable					= $wpdb->prefix . 'golftable';
$wpdb->golfresult					= $wpdb->prefix . 'golfresult';

// integrate JavaScript in HEADER
function integrate_sorttable() {

 	$sorttable="\n".'<script type="text/javascript" src="'.WPTABLE_URLPATH.'tablesort.js'.'"></script>';
	echo $sorttable;

}

// Insert table menu
function add_option_menu() {
	if (function_exists('add_submenu_page')) {
		add_submenu_page( 'edit.php' , __('Tables','wpTable'),  __('Tables','wpTable'), 9            , 'wp-table/wp-table-admin.php');
//		add_submenu_page(  parent    , page_title    , menu_title     , access_level , file, [function]);
	}
}

// ### Search for [TABLE=X] or [TABLENAME=XXX XXX XXX] in Content
// ### Thanks to William Lindley
function golftable ($content) {
  global $wpdb;

  $search = "/\[table\s*=\s*(\w+)\]|\[tablename\s*=\s*([^\]]+)\]/i";   //search for 'table' entry

  preg_match_all($search, $content, $matches);

  if (is_array($matches[1])) {
    for ($m = 0; $m < count($matches[0]); $m++) {
      $search = $matches[0][$m];
      if (strlen($matches[1][$m])) {
        $dbquery = "SELECT * FROM $wpdb->golftable WHERE table_aid = '". $matches[1][$m] ."'";
      } elseif (strlen($matches[2][$m])) {
        $dbquery = "SELECT * FROM $wpdb->golftable WHERE table_name = '" . $matches[2][$m] . "'";
      } else {
        continue;
      }

      $dbresult = $wpdb->get_results($dbquery);
      if ($dbresult[0]->table_aid > 0) {
        $replace = replacetable($dbresult[0]->table_aid);
        $content = str_replace ($search, $replace, $content);
      } 
    }
  }

  return $content;
}

// ### Lookup for table content
function replacetable($table_id) {
global $wpdb;


	// get table data
	$wptable_cfg=get_option('wptable');
	
	$act_tableset = $wpdb->get_results("SELECT * FROM $wpdb->golftable WHERE table_aid = $table_id ");
	$act_tablename = $act_tableset[0]->table_name;
	$act_description = $act_tableset[0]->description;
	$act_sh_name = $act_tableset[0]->show_name;
	$act_sh_desc = $act_tableset[0]->show_desc;
	$act_head_b = $act_tableset[0]->head_bold;
	$act_altnativ =$act_tableset[0]->alternative;

	$act_cellspace = $wptable_cfg[cellspacing];
	if ($act_cellspace == 0) {	$act_cellspace =""; }	
	else { $act_cellspace = ' cellspacing="'.$act_cellspace.'"'; }	
	$act_cellpad = $wptable_cfg[cellpadding];
	if ($act_cellpad == 0) {	$act_cellpad =""; }	
	else { $act_cellpad = ' cellpadding="'.$act_cellpad.'"'; }

	$tbl_header = "</p>"; // close <P> tag
	if ($act_sh_name) { $tbl_header .= "\n".'<h2>'.$act_tablename.'</h2>'; }
	if ($act_sh_desc) { $tbl_header .= "\n".'<p>'.$act_description.'</p>'; }
	$tbl_header .= "\n".'<table class="wptable rowstyle-alt" id="wptable-'.$table_id.'" '.$act_cellspace.$act_cellpad.'>'."\n";

	$rowcount=array();
	$max_col = maxcolumn($table_id);
	$act_width =tablewidth($table_id);
	$act_align =tablealign($table_id);

	$rowcount = $wpdb->get_results("SELECT row_id FROM $wpdb->golfresult WHERE table_id = '$table_id' GROUP BY row_id ORDER BY row_id ASC ");	
	$count_row = 0;
	if (is_array($rowcount)) {
	 	$count_col = 0;
		foreach ($rowcount as $rowcount){
		 	if ($rowcount->row_id > 0 ) {
		 	if (($act_head_b) AND ($count_row == 0))
				$tbl_content = "\t".'<thead>'."\n"; 	
		 	if (($count_row%2 == 0) AND ($count_row != 0) AND ($act_altnativ)) {
				$row_content = "\t".'<tr class="alt">'."\n\t";
			}  else {
				$row_content = "\t".'<tr>'."\n\t";
			} 		 	
			$getrow = $wpdb->get_results("SELECT value FROM $wpdb->golfresult WHERE table_id = '$table_id' AND row_id ='$rowcount->row_id' ORDER BY result_aid ASC ");		 	
			$i = 0;
			foreach ($getrow as $getrow){			
				$count_col++;
//				if(!empty($getrow->value)){
				if($getrow->value != ''){
					if (($act_head_b) AND ($count_row == 0)) {
					 	$row_content  .= "\t".'<th class="sortable" style="width:'.$act_width[$i].'px" '.$act_align[$i++].'>'.stripslashes($getrow->value).'</th>'."\n\t";
						//TODO: Welche Zeile sortierbar ist muss auswählbar sein
				 	} else {
					 	$row_content .= "\t".'<td style="width:'.$act_width[$i].'px" '.$act_align[$i++].$cssalt.'>'.stripslashes($getrow->value).'</td>'."\n\t";
					}
				} else { $row_content .= "\t".'<td style="width:'.$act_width[$i++].'px" >&nbsp;</td>'."\n\t";	}
			}
			if ($count_col < $max_col) { 	// fill up with spaces with below max column
			 	for ( ; $count_col < $max_col ; $count_col++){
					$row_content .= "\t".'<td style="width:'.$act_width[$i++].'px" >&nbsp;</td>'."\n\t";					
				}
			}
			$tbl_content .= $row_content.'</tr>'."\n"; // finish row
		 	if (($act_head_b) AND ($count_row == 0))
				$tbl_content .= "\t".'</thead>'."\n"; 
			$count_row++;	
			}
		}
		$tbl_content= $tbl_header.$tbl_content.'</table><p>'."\n"; // finish table
	}
	return $tbl_content;
}

// ### Calculate the max number of column for this table
function maxcolumn($table_id){
global $wpdb;

$max_col = 0 ;

	$rowcount = $wpdb->get_results("SELECT row_id FROM $wpdb->golfresult WHERE table_id = '$table_id' GROUP BY row_id ");	
	if (is_array($rowcount)) {
		foreach ($rowcount as $rowcount){	
			$getrow = $wpdb->get_results("SELECT row_id FROM $wpdb->golfresult WHERE table_id = '$table_id' AND row_id ='$rowcount->row_id' ");		 	
			$col_num = count($getrow);
			if ($col_num > $max_col) {
				$max_col = $col_num; 
			}
		}
	}	
return 	$max_col;
}

// ### Get the width for each column in a array
function tablewidth($table_id){
global $wpdb;
 
	$widthcount = $wpdb->get_results("SELECT * FROM $wpdb->golfresult WHERE table_id = '$table_id' AND row_id ='0' ORDER BY result_aid ASC ");	
	if (is_array($widthcount)) {
	 	$i = 0;
		foreach ($widthcount as $widthcount){	
		 	$col_width[$i++] = $widthcount->value;
		}
	}
return 	$col_width;
}

// ### Get the align for each column in a array
function tablealign($table_id){
global $wpdb;
 
	$aligncount = $wpdb->get_results("SELECT * FROM $wpdb->golfresult WHERE table_id = '$table_id' AND row_id ='-1' ORDER BY result_aid ASC ");	
	if (is_array($aligncount)) {
	 	$i = 0;
		foreach ($aligncount as $aligncount){	
		 	$col_align[$i++] = convertalign($aligncount->value);
		}
	}
return 	$col_align;
}

// ### Check and create width and align for a new table
function create_style($table_id){
global $wpdb;
 
 	$max_col = maxcolumn($table_id);
 
	$exist_width = tablewidth($table_id);  // check if width entries exist
	if (!is_array($exist_width)) {
		for ($a=0; $a < $max_col; $a++)	{
		 	$wpdb->query(" INSERT INTO $wpdb->golfresult (table_id, row_id, value) VALUES ('$table_id', '0', '30')");	
		}
	}
	$exist_align = tablealign($table_id);  // check if align entries exist
	if (!is_array($exist_align)) {
		for ($a=0; $a < $max_col; $a++)	{
		 	$wpdb->query(" INSERT INTO $wpdb->golfresult (table_id, row_id, value) VALUES ('$table_id', '-1', 'C')");	
		}
	}
}

// ### Convert the align shortcut into a html code
function convertalign($table_value){

if ($table_value == "C"){ $html_value = 'align="center"'; }
if ($table_value == "R"){ $html_value = 'align="right"';  } 
if ($table_value == "L"){ $html_value = 'align="left"';   }  

return 	$html_value;
}

// init wpTable in wp-database if plugin is activated
function checkdatabase() {

	require_once(ABSPATH . 'wp-content/plugins/wp-table/wp-table-install.php');
	wptable_install();
	
}

// integrate CSS in HEADER for table
function css_table() {
 
	$wptable_cfg=get_option('wptable');

	$use_cssfile = $wptable_cfg['use_cssfile'];
	if ($use_cssfile){
 	$wptcss="\n".'<style type="text/css" media="screen">'."\n".'@import url('.get_bloginfo('wpurl').'/wp-content/plugins/wp-table/wp-table.css);'."\n".'</style>';
	echo $wptcss;
	}
	else {
	$act_tablewidth = $wptable_cfg['table_width'];	
	if ($act_tablewidth == 0) {	$act_tablewidth =""; }	
	else { $act_tablewidth = 'width: '.$act_tablewidth.'%;'."\n"; }
	echo "\n";
?>
<style type="text/css">
.wptable {
	border-width: <?php echo($wptable_cfg['border_size']); ?> px;
	border-color: <?php echo($wptable_cfg['border_color']); ?>;
	border-style: solid;
	<?php echo($act_tablewidth); ?>
}

.wptable th {
	border-width: <?php echo($wptable_cfg['border_size']); ?>px;
	border-color: <?php echo($wptable_cfg['border_color']); ?>;
	background-color: <?php echo($wptable_cfg['head_color']); ?>;
	border-style: solid;
}

.wptable td {
	border-width: <?php echo($wptable_cfg['border_size']); ?>px;
	border-color: <?php echo($wptable_cfg['border_color']); ?>;
	border-style: solid;
}

.wptable tr.alt {
 	background-color: <?php echo($wptable_cfg['alt_color']); ?>;
}

</style>
<?php	
	}
}

$wptable_cfg=get_option('wptable');

if ($wptable_cfg[use_sorting]) {
// Action activate sortable in header
	add_filter('wp_head', 'integrate_sorttable');
}

// Plugin activation
add_action('activate_wp-table/wp-table.php', 'checkdatabase');

// Action activate CSS in header
add_filter('wp_head', 'css_table');

// Action calls for all functions 
add_filter('the_content', 'golftable');

// Insert the mt_add_pages() sink into the plugin hook list for 'admin_menu'
add_action('admin_menu', 'add_option_menu');


//#################################################################
// add button for posts

// init process for button control
add_action('edit_page_form', 'insert_wptable_script');
add_action('edit_form_advanced', 'insert_wptable_script');
add_action('init', 'wptable_button_init');

// ButtonSnap needs to be loaded outside the class in order to work right
require(WPTABLE_ABSPATH.'js/buttonsnap.php');

function wptable_button_init() {
 
	global $wp_db_version;

	// Don't bother doing this stuff if the current user lacks permissions
	if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) return;
 
	// If WordPress 2.1+ (or WPMU?) and using TinyMCE, we need to insert the buttons differently
	// Thanks to Viper007bond and An-archos for the pioneer work
	if ( 3664 <= $wp_db_version && 'true' == get_user_option('rich_editing') ) {
	 
	// add the button for wp21 in a new way
		add_filter("mce_plugins", "wptable_button_plugin", 0);
		add_filter('mce_buttons', 'wptable_button', 0);
		add_action('tinymce_before_init','wptable_button_script');
		}
	
	else {
	// used to insert button in wordpress 2.x editor
	$button_image_url = buttonsnap_dirname(__FILE__) . '/wp-table.gif';
	buttonsnap_jsbutton($button_image_url, 'wp-Table Browser', 'window.open("'.WPTABLE_URLPATH.'js/wptable-tinymce.php?wpPATH='.ABSPATH.'", "wpTable",  "width=440,height=190,scrollbars=no");');
	}
}

// Load the Script for the Button
function insert_wptable_script() {
 	
	echo "\n".'
	<script type="text/javascript"> 
	function wptable_buttonscript()	{ 
		window.open("'.WPTABLE_URLPATH.'js/wptable-tinymce.php", "SelectTable",  "width=440,height=190,scrollbars=no");
	} 
	</script>'; 
	return;
}

// used to insert button in wordpress 2.1x editor
function wptable_button($buttons) {

	array_push($buttons, "separator", "wpTable");
	return $buttons;

}

// Tell TinyMCE that there is a plugin (wp2.1)
function wptable_button_plugin($plugins) {    

	array_push($plugins, "-wpTable");    
	return $plugins;
}

// Load the TinyMCE plugin : editor_plugin.js (wp2.1)
function wptable_button_script() {	
 
 	$pluginURL =  WPTABLE_URLPATH.'js/';
	echo 'tinyMCE.loadPlugin("wpTable", "'.$pluginURL.'");' . "\n"; 
	return;
}

/**
 * WordPress PHP class to check for a new version.
 * @author Alex Rabe & Joern Kretzschmar
 * @orginal from Per Søderlind
 */
if ( !class_exists( "CheckPlugin" ) ) {  
	class CheckPlugin {
		/**
		 * URL with the version of the plugin
		 * @var string
		 */
		var $URL = 'myURL';
		/**
		 * Version of thsi programm or plugin
		 * @var string
		 */
		var $version = '1.00';
		/**
		 * Name of the plugin (will be used in the options table)
		 * @var string
		 */
		var $name = 'myPlugin';
		/**
		 * Waiting period until the next check in seconds
		 * @var int
		 */
		var $period = 86400;					
					
		function startCheck() {
			/**
			 * check for a new version, returns true if a version is avaiable
			 */
			
			// use wordpress snoopy class
			require_once(ABSPATH . WPINC . '/class-snoopy.php');
			
			$check_intervall = get_option( $this->name."_next_update" );

			if ( ($check_intervall < time() ) or (empty($check_intervall)) ) {
				if (class_exists(snoopy)) {
					$client = new Snoopy();
					$client->_fp_timeout = 10;
					if (@$client->fetch($this->URL) === false) {
						return false;
					}
					
				   	$remote = $client->results;
				   	
					$server_version = unserialize($remote);
					if (is_array($server_version)) {
						if ( version_compare($server_version[$this->name], $this->version, '>') )
						 	return true;
					} 
					
					$check_intervall = time() + $this->period;
					update_option( $this->name."_next_update", $check_intervall );
					return false;
				}				
			}
		}
	}
}


?>