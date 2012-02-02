<?php

/*
+----------------------------------------------------------------+
+	wptable-button V1.40
+	by Alex Rabe
+   	required for wp-table
+----------------------------------------------------------------+
*/
// get and set path of function

$wpconfig = realpath("../../../../wp-config.php");

if (!file_exists($wpconfig))  {
	echo "Could not found wp-config.php. Error in path :\n\n".$wpconfig ;	
	die;	
}// stop when wp-config is not there

require_once($wpconfig);
require_once(ABSPATH.'/wp-admin/admin.php');

// check for rights
if(!current_user_can('edit_posts')) die;

global $wpdb;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>wp-Table Browser</title>
<link rel="stylesheet" href="<?php echo get_option('siteurl') ?>/wp-admin/wp-admin.css?version=<?php bloginfo('version'); ?>" type="text/css" />
<script type="text/javascript">
function insert_wptable() {
 
 	if (document.selectform.table.selectedIndex != 0) {
		var thetext= '[TABLE=' + document.selectform.table.value + ']'; 
	
		mceWindow = window.opener;
		if(mceWindow.tinyMCE) {
			mceWindow.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, thetext);
		} else {
			edCanvas = mceWindow.document.getElementById('content');
			mceWindow.edInsertContent(edCanvas, thetext);
		}
	}
	window.close();
}
</script>
</head>
<body>

<div class="wrap">
	<fieldset class="options">
	<legend><?php _e('Select table', 'wpTable') ;?></legend>
	<form name="selectform" method="post" action="" >
		<input type="hidden" name="wppath" value="<?php echo $wppath ?>"/>
		<table>
		<tr>
		<td><select size="1" name="table" style="width:140px">
			<option value="0"><?php _e('No table', 'wpTable') ;?></option>
		<?php
			$tables = $wpdb->get_results("SELECT * FROM $wpdb->golftable ORDER BY 'table_name' ASC ");
			if($tables) {
				foreach($tables as $table) {
				echo '<option value="'.$table->table_aid.'">'.$table->table_name.'</option>'; 
				}
			}
		?>		
		</select></td>
		<td><input type="submit" name="insert" onclick="javascript:insert_wptable();" value="<?php _e('Insert Table', 'wpTable'); ?> &raquo;" class="button" /></td>
		</table>
		</fieldset>
		<div class="submit"><input type="submit" name="exit" onclick="javascript:window.close();" value="<?php _e('Cancel'); ?>" class="button" /></div>
	</form>
</div>
</body>
</html>
<?php

?>