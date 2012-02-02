<?php

/*
+----------------------------------------------------------------+
+	wp-table-admin V1.42
+	by Alex Rabe
+   required for wp-table
+----------------------------------------------------------------+
*/

global $wpdb;

### Variables Variables Variables
$base_name = plugin_basename('wp-table/wp-table-admin.php');
$base_page = 'admin.php?page='.$base_name;
$mode = trim($_GET['mode']);
$act_table = trim($_GET['id']);

require_once(ABSPATH . 'wp-content/plugins/wp-table/wp-table-import.php');

// Main Page

// ### Start the button form processing 
if (isset($_POST['do'])){
			$mode ='edit'; // reset mode if not selected delrow
	switch(key($_POST['do'])) {
		case 0:	// SAVE and EXIT
			$mode =''; // go back to main page
			
		case 1: // UPDATE 
			// read the $_POST values
			$upd_name = addslashes(trim($_POST['tabelname']));
			$upd_desc = addslashes(trim($_POST['description']));
			if(!empty($upd_name)) {
				$result = $wpdb->query("UPDATE $wpdb->golftable SET table_name = '$upd_name', description='$upd_desc' WHERE table_aid = '$act_table' ");
				if ($result) { $text = '<font color="green">'.__('Update Successfully','wpTable').'</font>';	}
			}
			$rowcount = $wpdb->get_results("SELECT row_id FROM $wpdb->golfresult WHERE table_id = '$act_table' GROUP BY row_id ");	
			if (is_array($rowcount)) {
				foreach ($rowcount as $rowcount){
					if ($rowcount->row_id > 0) {
						$getrow = $wpdb->get_results("SELECT result_aid FROM $wpdb->golfresult WHERE table_id = '$act_table' AND row_id = '$rowcount->row_id' ");
						foreach ($getrow as $getrow){			
							$row_value = addslashes(trim($_POST['row_aid-'.$getrow->result_aid]));
							$result = $wpdb->query("UPDATE $wpdb->golfresult SET value = '$row_value' WHERE result_aid = $getrow->result_aid ");
							if ($result) {	$text = '<font color="green">'.__('Update Successfully','wpTable').'</font>';	}
						}
					}
				}
			}
			if(empty($text)) {	$text = '<font color="blue">'.__('No Update needed','wpTable').'</font>';	}
			break;

		case 2: // CANCEL
			$csv_file = $_POST['csv_path'];  // get file when coming from csv import
			if (file_exists($csv_file)) unlink($csv_file); // del temp file
			
			$mode =''; // go back to main page
			break;

		case 3: // Add a row

			$max_col = maxcolumn($act_table);
			$newrow_id = $wpdb->get_var("SELECT MAX(row_id) FROM $wpdb->golfresult WHERE table_id = '$act_table' ") + 1;	
			for ($i=1; $i <= $max_col; $i++)	{
				$result = $wpdb->query(" INSERT INTO $wpdb->golfresult (table_id, row_id) VALUES ('$act_table', '$newrow_id')");
				if (!$result) {	$text = '<font color="red">'.__('Database error. Could not perfom all action.','wpTable').'</font>';	}	
			}			
			if(empty($text)) {	$text = '<font color="green">'.__('New row successfully added','wpTable').'</font>';	}
			break;

		case 4: // Add a column
			$row_ids = $wpdb->get_results("SELECT row_id FROM $wpdb->golfresult WHERE table_id = '$act_table' GROUP BY row_id ");	
			if (is_array($row_ids)) {	
				foreach ($row_ids as $row_ids){
				 	if ($row_ids->row_id ==0) {
					$result = $wpdb->query(" INSERT INTO $wpdb->golfresult (table_id, row_id, value) VALUES ('$act_table', '$row_ids->row_id', '30')");					
					} else {
					$result = $wpdb->query(" INSERT INTO $wpdb->golfresult (table_id, row_id) VALUES ('$act_table', '$row_ids->row_id')");
					}
					if (!$result) {	$text = '<font color="red">'.__('Database error. Could not perfom all action.','wpTable').'</font>';	}	
				}
				if(empty($text)) {	$text = '<font color="green">'.__('New column successfully added','wpTable').'</font>';	}
			}
			if(empty($text)) {	$text = '<font color="red">'.__('Database error. Could not perfom all action.','wpTable').'</font>';	}
			break;

		case 5: // Delete last column
			$maxcol = maxcolumn($act_table);
			$row_ids = $wpdb->get_results("SELECT row_id FROM $wpdb->golfresult WHERE table_id = '$act_table' GROUP BY row_id ");	
	
			if (is_array($row_ids)) {	
				foreach ($row_ids as $row_ids){
					$count = $wpdb->get_var("SELECT COUNT(result_aid) FROM $wpdb->golfresult WHERE table_id = '$act_table' AND row_id ='$row_ids->row_id'");	
					if ($count == $maxcol) {
						$maxrow_id = $wpdb->get_var("SELECT MAX(result_aid) FROM $wpdb->golfresult WHERE table_id = '$act_table' AND row_id ='$row_ids->row_id'");	
						$result = $wpdb->query("DELETE FROM $wpdb->golfresult WHERE result_aid = '$maxrow_id' ");
						if (!$result) {	$text = '<font color="red">'.__('Database error. Could not perfom all action.','wpTable').'</font>';	}	
					}
				}
				if(empty($text)) {	$text = '<font color="green">'.__('Last column successfully deleted','wpTable').'</font>';	}
			}
			if(empty($text)) {	$text = '<font color="red">'.__('Database error. Could not perfom all action.','wpTable').'</font>';	}
			break;
			
		case 6: // Update option
			$wptable_cfg[border_color] = addslashes(trim($_POST['act_bordercol']));
			$wptable_cfg[head_color] = addslashes(trim($_POST['act_headcol']));
			$wptable_cfg[alt_color] = addslashes(trim($_POST['act_alt_col']));
			$wptable_cfg[border_size] = trim($_POST['act_bordersize']);
			$wptable_cfg[cellspacing] = trim($_POST['act_cellspace']);
			$wptable_cfg[cellpadding] = trim($_POST['act_cellpad']);
			$wptable_cfg[table_width] = trim($_POST['act_tablewidth']);
			$wptable_cfg[table_align] = addslashes(trim($_POST['act_align']));
			$wptable_cfg[use_cssfile] = trim($_POST['use_cssfile']);
			$wptable_cfg[use_sorting] = trim($_POST['use_sorting']);
			$act_altnativ = $_POST['act_altnativ'];
			$act_sh_name = $_POST['act_sh_name'];	
			$act_sh_desc = $_POST['act_sh_desc'];
			$act_head_b = $_POST['act_head_b'];
			// need now for sql_mode, see http://bugs.mysql.com/bug.php?id=18551
			if (empty($act_altnativ)) $act_altnativ = 0; 
			if (empty($act_sh_name)) $act_sh_name = 0;
			if (empty($act_sh_desc)) $act_sh_desc = 0;
			if (empty($act_head_b)) $act_head_b = 0;

			$wpdb->query("UPDATE $wpdb->golftable SET  alternative = '$act_altnativ', show_name='$act_sh_name', show_desc='$act_sh_desc', head_bold='$act_head_b' WHERE table_aid = '$act_table' ");
			update_option('wptable', $wptable_cfg);

			$text = '<font color="green">'.__('Update Successfully','wpTable').'</font>';	
			break;

		case 7: // Update width
			
			// read the $_POST width values
			$getrow = $wpdb->get_results("SELECT result_aid FROM $wpdb->golfresult WHERE table_id = '$act_table' AND row_id = '0' ");
			if (is_array($getrow)) {
				foreach ($getrow as $getrow){			
					$row_value = addslashes(trim($_POST['width_aid-'.$getrow->result_aid]));
					$result = $wpdb->query("UPDATE $wpdb->golfresult SET value = '$row_value' WHERE result_aid = $getrow->result_aid ");
					if ($result) {	$text = '<font color="green">'.__('Update Successfully','wpTable').'</font>';	}
				}
			}
			
			// read the $_POST align values
			$getrow = $wpdb->get_results("SELECT result_aid FROM $wpdb->golfresult WHERE table_id = '$act_table' AND row_id = '-1' ");
			if (is_array($getrow)) {
				foreach ($getrow as $getrow){			
					$row_value = strtoupper(addslashes(trim($_POST['align_aid-'.$getrow->result_aid])));
					$result = $wpdb->query("UPDATE $wpdb->golfresult SET value = '$row_value' WHERE result_aid = $getrow->result_aid ");
					if ($result) {	$text = '<font color="green">'.__('Update Successfully','wpTable').'</font>';	}
				}
			}
			
			if(empty($text)) {	$text = '<font color="blue">'.__('No Update needed','wpTable').'</font>';	}
			$mode ='width'; // show again width menu
			break;
			
		case 8: // Cancel width menu
			break;	

		case 9: // Show possible csv import
		 	$import_table = addslashes(trim($_POST['import_name']));
			$delimiter = addslashes(trim($_POST['delimiter']));
			$csv_file = ABSPATH.get_option('upload_path' ).'/'.$_FILES['csv_file']['name'];  // set upload path
			$mode ='';  // set back to main menu
			
			if($_FILES['csv_file']['error']== 0) {
//				if($_FILES['csv_file']['type'] == 'text/plain') { 
	 				move_uploaded_file($_FILES['csv_file']['tmp_name'], $csv_file); // save temp file
				 	if (file_exists($csv_file)) {
	 					show_csv_preview($csv_file, $import_table, $delimiter);
						$mode ='none';
					} else $text = '<font color="red">'.__('ERROR : File cannot be saved. Check the permission of the wordpress upload folder','wpTable').'</font>';
//				} else $text = '<font color="red">'.__('ERROR : This is not a plain text file. Your server said this is a ','wpTable').$_FILES['csv_file']['type'].'</font>';
		 	} else $text = '<font color="red">'.__('ERROR : File not found :','wpTable').$csv_file.'</font>';
			break;	
			
		case 10: // Do csv import now
			$csv_file = $_POST['csv_path'];
			$new_table = stripslashes(trim($_POST['import_name']));
			$delimiter = addslashes(trim($_POST['delimiter']));
			
			if (file_exists($csv_file)) {
			if(!empty($new_table)) {
			 	$csvarray = parse_csv_file($csv_file, true, $delimiter);	//process file and create array
			 	$max_col = maxcolumn_array($csvarray);
				$metaname = $wpdb->escape($new_table);
				$insert_table = $wpdb->query(" INSERT INTO $wpdb->golftable (table_name) VALUES ('$metaname')");
				if ($insert_table != 0) {
				 	$table_aid = $wpdb->insert_id;  // get index_id
					$text = '<font color="green">'.__('Table ','wpTable').$table_aid.__(' added successfully','wpTable').'</font>';
					
					$rowcount = array_keys($csvarray);
					if (is_array($rowcount)) {
					 	$row_id = 1;
						foreach ($rowcount as $value){
							$count_col = 0;
							foreach ($csvarray[$value] as $getrow){
							 	$count_col++;			
								$insert_row = $insert_row + $wpdb->query(" INSERT INTO $wpdb->golfresult (table_id, row_id, value) VALUES ('$table_aid', $row_id,'$getrow')");	
								if (!$insert_row) {	$text = '<font color="red">'.__('Database error. Could not perfom all action.','wpTable').'</font>';  }
							}
						if ($count_col < $max_col) { 	// fill up with spaces when below max column
						 	for ( ; $count_col < $max_col ; $count_col++){
								$insert_row = $insert_row + $wpdb->query(" INSERT INTO $wpdb->golfresult (table_id, row_id, value) VALUES ('$table_aid', $row_id,'')");	
								if (!$insert_row) {	$text = '<font color="red">'.__('Database error. Could not perfom all action.','wpTable').'</font>';  }
							}
						}
						$row_id++;	
						}
					}
					create_style($table_aid); // create align and width
				}
				else { $text = '<font color="red">'.__('Error : Table cannot insert to database','wpTable').'</font>'; }
			}
			else { $text = '<font color="red">'.__('Error : You need to enter a table name','wpTable').'</font>'; }
			}
			else {	$text = '<font color="red">'.__('ERROR : File not found :','wpTable').$csv_file.'</font>';	} 
			if (file_exists($csv_file)) unlink($csv_file); // del temp file
			$mode =''; // go back to main page
			break;
			
		case 11: // Save option 
			$cssfilepath = (ABSPATH . 'wp-content/plugins/wp-table/wp-table.css');
			$newcssfile = stripslashes($_POST[cssfile]);

			if (is_writeable($cssfilepath)) {
				$f = fopen($cssfilepath, 'w+');
				fwrite($f, $newcssfile);
				fclose($f);
	
				echo '<div id="message" class="updated fade"><p><strong>'.__('Style sheet updated.', 'wpTable').'</strong></p></div>';
			}
			$mode ='editcss'; // show page again
			break;	
	}
}

### Determines Which Mode It Is

if ($mode == 'width'){
	// edit table width

	?>
	<?php if(!empty($text)) { echo '<!-- Last Action --><div id="message" class="updated fade"><p>'.$text.'</p></div>'; } ?>
	<!-- Edit Width -->
	<div class="wrap">
		<h2><?php _e('Table width control', 'wpTable') ?></h2>
		<p><?php _e('Here you can edit the column width of the selected table.', 'wpTable') ?><br />
		<form name="table_options" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" id="table_options">
			<fieldset class="options">
					<table align="center" cellpadding="1" cellspacing="0">
					<tr>
						<?php 
							$max_col = maxcolumn($act_table);
							$i = "A";
	 						for ($a=0; $a < $max_col; $a++)	{
								 echo "\t\t\t\t\t\t<th>".$i."</th>\n";
								 $i++;
							}
						?>
					</tr>
					<tr>
						<?php 
							$getrow = $wpdb->get_results("SELECT result_aid, value FROM $wpdb->golfresult WHERE table_id = '$act_table' AND row_id = '0' ORDER BY result_aid ASC ");
							if (is_array($getrow)) {
							 	$i = 0;
								foreach ($getrow as $getrow) {
								 	$act_width[$i] = $getrow->value;
									echo "\n\t<td align=\"center\"><input type=\"text\" maxlength=\"200\" name=\"width_aid-".$getrow->result_aid."\" value=\"".$act_width[$i++]."\"size=\"3\" /></td>";
								}
							}
						// v1.10 align control addded
						echo "\n\t</tr><tr>\n\t<td align=\"center\" colspan=\"".$max_col."\">".__('Align control : Enter <strong>L</strong>=Left <strong>C</strong>=Center <strong>R</strong>=Right', 'wpTable')."</td>\n\t</tr><tr>";
						$getrow = $wpdb->get_results("SELECT result_aid, value FROM $wpdb->golfresult WHERE table_id = '$act_table' AND row_id = '-1' ORDER BY result_aid ASC ");
							if (is_array($getrow)) {
							 	$i = 0;
								foreach ($getrow as $getrow) {
								 	$act_align[$i] = $getrow->value;
									echo "\n\t<td align=\"center\"><input type=\"text\" maxlength=\"1\" name=\"align_aid-".$getrow->result_aid."\" value=\"".$act_align[$i++]."\"size=\"1\"></td>";
								}
							}
						echo "\n";
						?>
					</tr>
				</table>
			</fieldset>
			<table width="100%" border="0" >
			<tr><td align="center" colspan="1">
				<input type="submit" name="do[7]" value="<?php _e('Update','wpTable'); ?>" class="button">
				<input type="submit" name="do[8]" value="<?php _e('Cancel','wpTable'); ?>" class="button">
			</td></tr>
			</table>
			<br />
		</form>	
		</div>
		
<!-- Table preview-->
		<div class="wrap">
		<fieldset class="options">
		<h2><?php _e('Table preview', 'wpTable') ?></h2>	
		<p><?php _e('Please note this is not a WYSIWYG mode of the table, the CSS of your theme could show the table in a slightly different way.', 'wpTable');?></b>
		<br /><br />
		<table border="1" align="center" cellspacing="1">
		<?php
			$rowcount = array();
			$tbl_content = '';
			$tbl_header = '';
			$max_col = maxcolumn($act_table);

			$rowcount = $wpdb->get_results("SELECT row_id FROM $wpdb->golfresult WHERE table_id = '$act_table' GROUP BY row_id ");	
			$count_row = 0;
			if (is_array($rowcount)) {
			 	$count_col = 0;
				foreach ($rowcount as $rowcount){
				 	if ($rowcount->row_id > 0) {
					 	$row_content= "\t".'<tr>'."\n\t";
						$getrow = $wpdb->get_results("SELECT value FROM $wpdb->golfresult WHERE table_id = '$act_table' AND row_id ='$rowcount->row_id' ORDER BY result_aid ASC ");		 	
						$i = 0;
						foreach ($getrow as $getrow){			
							$count_col++;
							if(!empty($getrow->value)){
							 	$align_value = convertalign($act_align[$i]);
							 	$row_content=$row_content."\t".'<td width="'.$act_width[$i++].'" ><div '.$align_value.'>'.stripslashes($getrow->value).'</div></td>'."\n\t";
							} else { $row_content=$row_content."\t".'<td width="'.$act_width[$i++].'" >&nbsp;</td>'."\n\t";	}
						}
					if ($count_col < $max_col) { 	// fill up with spaces with below max column
					 	for ( ; $count_col < $max_col ; $count_col++){
							$row_content=$row_content."\t".'<td>&nbsp;</td>'."\n\t";					
						}
					}
					$count_row++;
					$tbl_content=$tbl_content.$row_content.'</tr>'."\n"; // finish row
				}
			}
			$tbl_content= $tbl_header.$tbl_content.'</table>'."\n"; // finish table
			}
			echo $tbl_content;
			// preview ende
			
			?>
			</fieldset>	
	</div>
<?php	
}

if ($mode == 'insrow'){
 	// insert a row in between
 	$beforerow_id = $_GET['rowid'];
 	
	$table_ids = $wpdb->get_results("SELECT * FROM $wpdb->golfresult WHERE table_id = '$act_table' AND row_id >= $beforerow_id ORDER BY result_aid ASC ");
	if (is_array($table_ids)) {
		foreach ($table_ids as $table_ids){
			$table_ids->row_id++; //increase the row number
			$result = $wpdb->query("UPDATE $wpdb->golfresult SET row_id = '$table_ids->row_id' WHERE result_aid = $table_ids->result_aid ");
			if (!$result) break;
		}
		if ($result) {
			$max_col = maxcolumn($act_table);
			for ($i=1; $i <= $max_col; $i++)	{
				$result = $wpdb->query(" INSERT INTO $wpdb->golfresult (table_id, row_id) VALUES ('$act_table', '$beforerow_id')");
				if (!$result) $text = '<font color="red">'.__('Database error. Could not perfom all action.','wpTable').'</font>';
			}			
			if(empty($text)) $text = '<font color="green">'.__('New row successfully added','wpTable').'</font>';
		}
		if (!$result) $text = '<font color="red">'.__('Database error. Could not perfom all action.','wpTable').'</font>';
	}

	$mode = 'edit'; // go to edit output
}

if ($mode == 'delrow'){
 	// delete the row
 	$row_id = $_GET['rowid'];

	$delete_row = $wpdb->query("DELETE FROM $wpdb->golfresult WHERE table_id = $act_table AND row_id = '$row_id'");
	
	if(!$delete_row) {
		$text .= '<font color="red">'.__('Error in deleting row for table','wpTable').' \''.stripslashes($act_table).'\'</font>';
	} 
	if(empty($text)) {
		$text = '<font color="green">'.__('Row','wpTable').' \''.stripslashes($act_table).'\' '.__('deleted successfully','wpTable').'</font>';
	}
	
	$mode = 'edit'; // go to edit output
}

if ($mode == 'edit'){
	// edit table

	$align_left = '';
	$align_center = '';
	$align_right = '';

	$wptable_cfg=get_option('wptable');
	
	$act_bordercol = stripslashes($wptable_cfg[border_color]);
	$act_headcol = stripslashes($wptable_cfg[head_color]);
	$act_alt_col = stripslashes($wptable_cfg[alt_color]);
	$act_bordersize = $wptable_cfg[border_size];
	$act_cellspace = $wptable_cfg[cellspacing];
	$act_cellpad = $wptable_cfg[cellpadding];
	$act_tablewidth = $wptable_cfg[table_width];

	$act_tableset = $wpdb->get_results("SELECT * FROM $wpdb->golftable WHERE table_aid = $act_table ");
	$act_tablename = htmlspecialchars(stripslashes($act_tableset[0]->table_name));
	$act_description = htmlspecialchars(stripslashes($act_tableset[0]->description));
	$act_sh_desc = stripslashes($act_tableset[0]->show_desc);	

	if ($wptable_cfg[use_cssfile]) $use_cssfile='checked="checked"';
	if ($wptable_cfg[use_sorting]) $use_sorting='checked="checked"';
	if ($act_tableset[0]->alternative) $act_altnativ='checked="checked"';	
	if ($act_tableset[0]->show_name) $act_sh_name='checked="checked"';
	if ($act_tableset[0]->show_desc) $act_sh_desc='checked="checked"';
	if ($act_tableset[0]->head_bold) $act_head_b='checked="checked"';
	
	?>
	<?php if(!empty($text)) { echo '<!-- Last Action --><div id="message" class="updated fade"><p>'.$text.'</p></div>'; } ?>
	<!-- Edit Table -->
	<div class="wrap">
		<h2><?php _e('Table', 'wpTable') ?></h2>
		<p><?php _e('Here you can edit the selected table. It\'s possible to add or delete the last column.', 'wpTable') ?><br />
		<?php _e('If you want to show this table in your page, enter the tag :', 'wpTable') ?><strong> [TABLE=<?php echo $act_table; ?>]</strong></p>
		<form name="table_options" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" id="table_options">
			<fieldset class="options">
				<legend><?php _e('Edit table', 'wpTable');?></legend>
				<br />
					<table align="center" width="100%"  cellpadding="3" cellspacing="3">
					<tr>
						<td><strong><?php _e('Title or Name :', 'wpTable') ?> </strong><br /> <?php echo "<textarea cols=\"50\" rows=\"3\" maxlength=\"200\" name=\"tabelname\"/>".$act_tablename."</textarea></td>"; ?> </td>
						<td><strong><?php _e('Description :', 'wpTable') ?> </strong> <br /><?php echo "<textarea cols=\"50\" rows=\"3\" name=\"description\"/>".$act_description."</textarea></td>"; ?> </td>
					</tr>
					</table>
					<br /><br />
					<table align="center" cellpadding="1" cellspacing="1">
					<tr>
						<th>&nbsp;</th>					
						<?php 
							$max_col = maxcolumn($act_table);
	 						$i = "A";
							for ($a=0; $a < $max_col; $a++)	{
								 echo "\t\t\t\t\t\t<th>".$i."</th>\n";
								 $i++;
							}
						?>
						<th colspan='3'><?php _e('Row', 'wpTable') ?></th>
					</tr>
					<?php
						create_style($act_table); // check for align and width

						$rowcount = $wpdb->get_results("SELECT row_id FROM $wpdb->golfresult WHERE table_id = '$act_table' GROUP BY row_id ");	
						if (is_array($rowcount)) {
						 	$width = array();
						 	$a = 1; // Count row
							foreach ($rowcount as $rowcount){
								if ($rowcount->row_id > 0) {
								 	echo "\n\t<tr>\n<th>".$a++."</th>";
									$getrow = $wpdb->get_results("SELECT result_aid, value FROM $wpdb->golfresult WHERE table_id = '$act_table' AND row_id = '$rowcount->row_id' ORDER BY result_aid ASC ");
									if (is_array($getrow)) {
									$i = 0;
										foreach ($getrow as $getrow) {
										 	$fieldsize = intval( $width[$i++] /10 );
											if ($fieldsize < 1 ) { $fieldsize = 1; } 			
											$row_value = htmlspecialchars(stripslashes($getrow->value));
											$row_aid = $getrow->result_aid;
											echo "\n\t<td><input type=\"text\" name=\"row_aid-$row_aid\" value=\"$row_value\"size=\"".$fieldsize."\"></td>";
											}
										echo "\n\t<td><a href=\"$base_page&amp;mode=insrow&amp;id=$act_table&amp;rowid=$rowcount->row_id\" class=\"edit\" >".__('Insert','wpTable')."</a></td>";
										echo "\n\t<td>|</td>";
										echo "\n\t<td><a href=\"$base_page&amp;mode=delrow&amp;id=$act_table&amp;rowid=$rowcount->row_id\" class=\"delete\" onclick=\"javascript:check=confirm( '".__("Delete this row ?",'wpTable')."');if(check==false) return false;\">".__('Delete','wpTable')."</a></td>\n";
									}
								echo "\n</tr>\n";
								} else {
									$tbl_width = "\n\t<tr>\n<th><code>".__('Width', 'wpTable')."</code></th>";
									$getrow = $wpdb->get_results("SELECT result_aid, value FROM $wpdb->golfresult WHERE table_id = '$act_table' AND row_id = '$rowcount->row_id' ORDER BY result_aid ASC ");
									if (is_array($getrow)) {
									 	$i = 0;
										foreach ($getrow as $getrow) {			
											$width[$i] = $getrow->value;
											$tbl_width = $tbl_width."\n\t<td align=\"center\" ><code><".$width[$i++]."></code></td>";
											}
										$tbl_width = $tbl_width. "\n\t<td colspan='3' ><a href=\"$base_page&amp;mode=width&amp;id=$act_table&amp;rowid=$rowcount->row_id\" class=\"edit\" >".__('Edit width','wpTable')."</a></td>\n";	
									}
								$tbl_width = $tbl_width. "\n</tr>\n";
								}
							}
						}
						echo $tbl_width;
					    ?>
					</table>
					<br />
			</fieldset>
			<table width="100%"  border="0" >
			<tr><td align="center" colspan="1">
				<input type="submit" name="do[3]" value="<?php _e('Add new row','wpTable'); ?>" class="button"/>
				<input type="submit" name="do[4]" value="<?php _e('Add new column','wpTable'); ?>" class="button"/>
				<input type="submit" name="do[5]" value="<?php _e('Delete last column','wpTable'); ?>" class="button" onclick="javascript:check=confirm('<?php _e('Delete last column ?','wpTable'); ?>');if(check==false) return false;"/>
			</td></tr>
			<tr><td align="center" colspan="1">
				<input type="submit" name="do[1]" value="<?php _e('Update','wpTable'); ?>" class="button"/>
				<input type="submit" name="do[0]" value="<?php _e('Save and go back','wpTable'); ?>" class="button"/>
				<input type="submit" name="do[2]" value="<?php _e('Cancel','wpTable'); ?>" class="button"/>
			</td></tr>
			</table>
			<br />
		</form>
	</div>
	<!-- Option -->
	<div class="wrap">
		<h2><?php _e('Table Option','wpTable'); ?></h2>
		<p><?php _e('These settings are only valid for this table.', 'wpTable') ?></p>
			<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>&amp;mode=option" method="post">
				<fieldset class="options"> 
				<table border="0" cellspacing="3" cellpadding="3">
					<tr>
						<th align="left"><?php _e('Use alternating color','wpTable') ?></th>
						<td><input name="act_altnativ" type="checkbox" value="1"  <?php echo "$act_altnativ" ?> /></td> 
						<td align="left"><i><?php _e('This option will show every second row in the alternativ color','wpTable') ?></i></td>
					</tr>
					<tr>
						<th align="left"><?php _e('Show table name as title','wpTable') ?></th>
						<td><input name="act_sh_name" type="checkbox" value="1"  <?php echo "$act_sh_name" ?> /></td> 
						<td align="left"><i><?php _e('The table name will be shown as [h2] headline','wpTable') ?></i></td>
					</tr>
					<tr>
						<th align="left"><?php _e('Show description','wpTable') ?></th>
						<td><input name="act_sh_desc" type="checkbox" value="1"  <?php echo "$act_sh_desc" ?> /></td>
						<td align="left"><i><?php _e('The description will be shown','wpTable') ?></i></td> 
					</tr>
					<tr>
						<th align="left"><?php _e('Define first row as header','wpTable') ?></th>
						<td><input name="act_head_b" type="checkbox"  value="1"  <?php echo "$act_head_b" ?> /></td> 
						<td align="left"><i><?php _e('The first row get the tag [th]','wpTable') ?></i></td>
					</tr>
					</table>
				</fieldset>
			<h2><?php _e('General Option','wpTable'); ?></h2>
			<p><?php _e('These are global settings, which are valid for all tables.', 'wpTable') ?></p>
				<fieldset class="options"> 
				<table border="0" cellspacing="3" cellpadding="3">
					<tr>
						<th align="left"><?php _e('Use CSS file ?','wpTable') ?></th>
						<td><input name="use_cssfile" type="checkbox" value="1"  <?php echo "$use_cssfile" ?> /></td>
						<td align="left"><i><?php _e('Use the wp-table.css file instead the above settings.','wpTable') ?></i></td>
						<td><?php echo "<td><a href=\"$base_page&amp;mode=editcss\" >".__('Edit wp-Table.css','wpTable')."</a></td>\n"; ?></td>
					</tr>
					<tr>
						<th align="left"><?php _e('Activate sort function','wpTable') ?></th>
						<td><input name="use_sorting" type="checkbox" value="1"  <?php echo "$use_sorting" ?> /></td>
						<td align="left"><i><?php _e('Activate the Table Sort Script from ','wpTable') ?><a href="http://www.frequency-decoder.com/2006/09/16/unobtrusive-table-sort-script-revisited">Frequency Decoder</a></i></td>
					</tr>
					<tr>
						<th align="left"><?php _e('Border Color','wpTable') ?></th>
						<td><input type="text" size="7" maxlength="7" name="act_bordercol" value="<?php echo "$act_bordercol" ?>" /></td>
						<td align="left"><i><?php _e('Enter the HTML color code (i.e. #E58802 for the border line).','wpTable') ?></i></td>
					</tr>
					<tr>					
						<th align="left"><?php _e('Headline Color','wpTable') ?></th>
						<td><input type="text" size="7" maxlength="7" name="act_headcol" value="<?php echo "$act_headcol" ?>" /></td>
						<td align="left"><i><?php _e('Select a background color for the first row','wpTable') ?></i></td>
					</tr>
					<tr>					
						<th align="left"><?php _e('Alternative Color','wpTable') ?></th>
						<td><input type="text" size="7" maxlength="7" name="act_alt_col" value="<?php echo "$act_alt_col" ?>" /></td>
						<td align="left"><i><?php _e('Select the alternating color (i.e. #F4F4EC)','wpTable') ?></i></td>
					</tr>
					<tr>
						<th align="left"><?php _e('Table width','wpTable') ?></th>
						<td><input type="text" size="3" maxlength="3" name="act_tablewidth" value="<?php echo "$act_tablewidth" ?>" /></td>
						<td align="left"><i><?php _e('Enter the relative table width in percent (0 = not used).','wpTable') ?></i></td>
					</tr>
					<tr>					
						<th align="left"><?php _e('Border Size','wpTable') ?></th>
						<td><input type="text" size="3" maxlength="3" name="act_bordersize" value="<?php echo "$act_bordersize" ?>" /></td>
						<td align="left"><i><?php _e('Size of border around the table (0 = no border)','wpTable') ?></i></td>
					</tr>
					<tr>					
						<th align="left"><?php _e('Cell spacing','wpTable') ?></th>
						<td><input type="text" size="3" maxlength="3" name="act_cellspace" value="<?php echo "$act_cellspace" ?>" /></td>
						<td align="left"><i><?php _e('Space between cells (Default = 1)','wpTable') ?></i></td>
					</tr>
					<tr>					
						<th align="left"><?php _e('Cell padding','wpTable') ?></th>
						<td><input type="text" size="3" maxlength="3" name="act_cellpad" value="<?php echo "$act_cellpad" ?>" /></td>
						<td align="left"><i><?php _e('Space between the edge of a cell and the contents (Default = 0)','wpTable') ?></i></td>
					</tr>
					</table>
					<div class="submit"><input type="submit" name="do[6]" value="<?php _e('Update','wpTable'); ?> &raquo;" class="button" /></div>
				</fieldset>
			</form>
	</div>
	<?php	
}
		
if ($mode == 'delete'){	  
 	// Delete A table

	$delete_entries = $wpdb->query("DELETE FROM $wpdb->golfresult WHERE table_id = $act_table");
	$delete_table =  $wpdb->query("DELETE FROM $wpdb->golftable WHERE table_aid = $act_table");
	
	if(!$delete_table) {
	 	$text = '<font color="red">'.__('Error in deleting table','wpTable').' \''.stripslashes($act_table).'\' </font>';
	}
	if(!$delete_entries) {
		$text .= '<br /><font color="red">'.__('Error in deleting entries for table','wpTable').' \''.stripslashes($act_table).'\'</font>';
	} 
	if(empty($text)) {
		$text = '<font color="green">'.__('Table','wpTable').' \''.stripslashes($act_table).'\' '.__('deleted successfully','wpTable').'</font>';
	}
	$mode = 'main'; // show main page
}
	
if ($mode == 'add'){		
 	// add table
	$new_table = addslashes(trim($_POST['table_name']));
	$column_num = $_POST['column_num'];
	$row_num = $_POST['row_num'];

	if(!empty($new_table)) {
		$metaname = $wpdb->escape($new_table);
		$insert_table = $wpdb->query(" INSERT INTO $wpdb->golftable (table_name) VALUES ('$metaname')");
		if ($insert_table != 0) {
		 	$table_aid = $wpdb->insert_id;  // get index_id
			$text = '<font color="green">'.__('Table','wpTable').' '.$table_aid.__(' added successfully','wpTable').'</font>';
			for ($a=1; $a <= $row_num; $a++) {
		 		for ($b=1; $b <= $column_num; $b++)	{
					$result = $wpdb->query(" INSERT INTO $wpdb->golfresult (table_id, row_id) VALUES ('$table_aid', '$a')");
					if (!$result) {	$text = '<font color="red">'.__('Database error. Could not perfom all action.','wpTable').'</font>';  }
				}
			}
			create_style($table_aid); // create align and width
		}
		else { $text = '<font color="red">'.__('Error : Table cannot insert to database','wpTable').'</font>'; }
	}
	else { $text = '<font color="red">'.__('Error : You need to enter a table name','wpTable').'</font>'; }
	$mode = 'main'; // show main page
}

if ($mode == 'copy'){		
 	// copy a table
	$tbl = $wpdb->get_row("SELECT * FROM $wpdb->golftable WHERE table_aid = $act_table");
	if (!empty($tbl)) {
		$insert_table = $wpdb->query(" INSERT INTO $wpdb->golftable ( table_name, description, alternative, show_name, show_desc, head_bold ) 
		VALUES ( 'COPY OF $tbl->table_name', '$tbl->description', '$tbl->alternative', '$tbl->show_name', '$tbl->show_desc', '$tbl->head_bold' )");
		if ($insert_table != 0) {
		 	$table_aid = $wpdb->insert_id;  // get index_id
			$text = '<font color="green">'.__('Table','wpTable').' '.$table_aid.__(' added successfully','wpTable').'</font>';
			$row_ids = $wpdb->get_results("SELECT * FROM $wpdb->golfresult WHERE table_id = $act_table  ORDER BY result_aid ASC" );
			if (is_array($row_ids)) {	
				foreach ($row_ids as $row_ids){
					$insert_values = $wpdb->query(" INSERT INTO $wpdb->golfresult (table_id, row_id, value) VALUES ('$table_aid', '$row_ids->row_id', '$row_ids->value')");
					if (!$insert_values) {	$text = '<font color="red">'.__('Database error. Could not perfom all action.','wpTable').'</font>';  }
				} 
			}	
		} else { $text = '<font color="red">'.__('Error : Table cannot insert to database','wpTable').'</font>'; }
	}
	$mode = 'main'; // show main page
}

if ($mode == 'editcss'){
	// show and edit the css file
	$cssfilepath = (ABSPATH . 'wp-content/plugins/wp-table/wp-table.css');
	$filecontent = implode("",file($cssfilepath));
	
?>	
<div class="wrap">
	<h2><?php _e('Edit wp-Table.css', 'wpTable') ;?></h2>
	<p> <?php _e('File path : ', 'wpTable'); echo $cssfilepath; ?> </p>
	<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" ENCTYPE="multipart/form-data" method="post" >
		<p><fieldset class="options">
			<div><textarea cols="80" rows="26" name="cssfile" id="cssfile" tabindex="1"><?php  echo $filecontent; ?></textarea></div>
			<p><em><?php if (!(is_writable ( $cssfilepath ))) _e('If this file was writable you could edit it','wpTable'); ?></em></p>
		</fieldset></p>
		<p class="submit">
		<input type="submit" name="do[2]" value="<?php _e('Cancel', 'wpTable') ;?>"/>
		<input type="submit" name="do[11]" value="<?php _e('Update', 'wpTable') ;?>"/>
		</p>
	</form>
</div>
<?php
}

/*** MAIN ADMIN PAGE ***/	
if ((empty($mode)) or ($mode == 'main')) {

	$tables = $wpdb->get_results("SELECT * FROM $wpdb->golftable ORDER BY 'table_aid' ASC ");
	?>
	<?php if(!empty($text)) { echo '<!-- Last Action --><div id="message" class="updated fade"><p>'.$text.'</p></div>'; } ?>
		<!-- Manage Table-->
		<div class="wrap">
		<h2><?php _e('Manage Table','wpTable'); ?></h2>
			<table id="the-list-x" width="100%" cellspacing="3" cellpadding="3">
			<thead>
			<tr>
				<th scope="col"><?php _e('ID','wpTable'); ?></th>
				<th scope="col"><?php _e('Table Name','wpTable'); ?></th>				
				<th scope="col"><?php _e('Description','wpTable'); ?></th>
				<th scope="col" colspan="3"><?php _e('Action','wpTable'); ?></th>
			</tr>
			</thead>
			<?php
				if($tables) {
					$i = 0;
					foreach($tables as $table) {
					 	if($i%2 == 0) {
							echo "<tr class='alternate'>\n";
						}  else {
							echo "<tr>\n";
						}
						echo "<th scope=\"row\">$table->table_aid</th>\n";
						echo "<td>$table->table_name</td>\n";
						echo "<td>$table->description</td>\n";
						echo "<td><a href=\"$base_page&amp;mode=edit&amp;id=$table->table_aid\" class=\"edit\">".__('Edit','wpTable')."</a></td>\n";
						echo "<td><a href=\"$base_page&amp;mode=copy&amp;id=$table->table_aid\" class=\"edit\" onclick=\"javascript:check=confirm( '".__("Copy this table ?",'wpTable')."');if(check==false) return false;\">".__('Copy','wpTable')."</a></td>\n";
						echo "<td><a href=\"$base_page&amp;mode=delete&amp;id=$table->table_aid\" class=\"delete\" onclick=\"javascript:check=confirm( '".__("The complete table and content will be erased. Delete?",'wpTable')."');if(check==false) return false;\">".__('Delete')."</a></td>\n";
						echo '</tr>';
						$i++;
					}
				} else {
					echo '<tr><td colspan="7" align="center"><b>'.__('No table found','wpTable').'</b></td></tr>';
				}
			?>
			</table>
		</div>
		<!-- Add A Table -->
		<div class="wrap">
			<h2><?php _e('Add a new table','wpTable'); ?></h2>
			<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>&amp;mode=add" method="post">
				<fieldset class="options"> 
				<table class="optiontable">
					<tr>
						<th scope="row"><?php _e('Table name','wpTable') ?></th>
						<td><input type="text" size="50" maxlength="200" name="table_name" /></td>
					</tr>
					<tr>
						<th scope="row"><?php _e('No. of columns:','wpTable') ?></th>
							<td>
								<select size="1" name="column_num">
										<?php
										for($k=2; $k <= 20; $k++) {
											echo "<option value=\"$k\">$k</option>";
										}
										?>
								</select>
							</td>
						</tr>
					<tr>
						<th scope="row"><?php _e('No. of rows:','wpTable') ?></th>
							<td>
								<select size="1" name="row_num">
										<?php
										for($k=2; $k <= 20; $k++) {
											echo "<option value=\"$k\">$k</option>";
										}
										?>
								</select>
							</td>
						</tr>
					</table>
					<p class="submit"><input type="submit" name="addtable" value="<?php _e('Add table','wpTable'); ?> &raquo;" class="button" /></p>
				</fieldset>
			</form>
		</div>
		<!-- Import A Table -->
		<div class="wrap">
			<h2><?php _e('Import a table','wpTable'); ?></h2>
			<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data" method="post">
				<fieldset class="options"> 
				<table class="optiontable">
					<tr>
						<th scope="row"><?php _e('Table name','wpTable') ?></th>
						<td><input type="text" size="50" maxlength="200" name="import_name" /></td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Select CSV file:','wpTable') ?></th>
							<td>
								<input type="file" name="csv_file" id="csv_file" size="50" class="uploadform" />
							</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Define delimiter:','wpTable') ?></th>
							<td>
								<input type="text" name="delimiter" id="delimiter" size="2" maxlength="1" value=";" class="code" /> 
							</td>
					</tr>
					</table>
					<p class="submit"><input type="submit" name="do[9]" value="<?php _e('Import table','wpTable'); ?> &raquo;" class="button" /></p>
				</fieldset>
			</form>
		</div>
	<?php
}
?>