<?php

/*
+----------------------------------------------------------------+
+	wp-table-import V1.34
+	by Alex Rabe
+   required for wp-table
+----------------------------------------------------------------+
*/

function show_csv_preview($csvfile, $table_name, $delimiter = ';') {

?>
 	<!-- Edit Table -->
	<div class="wrap">
	<h2><?php _e('Table preview', 'wpTable') ?></h2>
	<p><?php _e('Here you can see a basic table preview of the CSV file. Press Import Table to save this table.', 'wpTable') ?><br />
	   <?php _e('Please leave this page only via the cancel button, otherwise the uploaded temp file will not deleted.', 'wpTable') ?></p>
	<form name="import_preview" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data" id="import_preview">
		<input type="hidden" name="csv_path" value="<?php echo($csvfile); ?>">
		<input type="hidden" name="import_name" value="<?php echo($table_name); ?>">
		<input type="hidden" name="delimiter" value="<?php echo($delimiter); ?>">
		<fieldset class="options">
			<table align="center" border="1" cellspacing="1">
<!--Table preview -->
<?php
		$csvarray = parse_csv_file($csvfile, true, $delimiter );	//process file and create array
		$max_col = maxcolumn_array($csvarray);
		$rowcount = array_keys($csvarray);
		if (is_array($rowcount)) {
			foreach ($rowcount as $value){
			 		$count_col = 0;
				 	$row_content= "\t".'<tr>'."\n\t";
					foreach ($csvarray[$value] as $getrow){			
						$count_col++;
						if(!empty($getrow)){
						 	$row_content=$row_content."\t".'<td>'.$getrow.'</td>'."\n\t";
						} else { $row_content=$row_content."\t".'<td>&nbsp;</td>'."\n\t";	}
					}
				if ($count_col < $max_col) { 	// fill up with spaces when below max column

				 	for ( ; $count_col < $max_col ; $count_col++){
						$row_content=$row_content."\t".'<td>&nbsp;</td>'."\n\t";					
					}
				}
				$tbl_content=$tbl_content.$row_content.'</tr>'."\n"; // finish row
			}
		}
		echo $tbl_content;
?>
<!--Table preview END-->
			</table>
		</fieldset class="options">
		<table width="100%" border="0" >
			<tr>
				<td align="center">
				<input type="submit" name="do[10]" value="<?php _e('Import table','wpTable'); ?>" class="button">
				<input type="submit" name="do[2]" value="<?php _e('Cancel','wpTable'); ?>" class="button">
				</td>
			</tr>
		</table>
		<br />
	</form>	
	<?php
}

// ### Calculate the max number of column for a array
function maxcolumn_array($csvarray){
$max_col = 0 ;
	if (is_array($csvarray)) {
	$rowcount = array_keys($csvarray); // first dimension
		foreach ($rowcount as $value){	
			$col_num  = count($csvarray[$value]);
			if ($col_num > $max_col) {
				$max_col = $col_num; 
			}
		}
	}
return 	$max_col;
}

function parse_csv_file($file, $columnheadings = false, $delimiter = ';', $enclosure = "\"") {
       
       $row = 1;
       $rows = array();
       $handle = fopen($file, 'r');
       
       while (($data = fgetcsv($handle, 1000, $delimiter, $enclosure )) !== FALSE) {
       
           if (!($columnheadings == "false") && ($row == 1)) {
               $headingTexts = $data;
           } elseif (!($columnheadings == "false")) {
               foreach ($data as $key => $value) {
                   unset($data[$key]);
                   $data[$headingTexts[$key]] = $value;
               }
               $rows[] = $data;
           } else {
               $rows[] = $data;
           }
           $row++;
       }
       
       fclose($handle);
       return $rows;
} 
 
?>