<?php

/*
+----------------------------------------------------------------+
+	wp-table-install V1.50
+	by Alex Rabe
+   required for wp-table
+----------------------------------------------------------------+
*/

//#################################################################

function wptable_install() {

global $wpdb;

	$wptable_cfg = get_option('wptable');
 
	// set tablename

	$table_name  = $wpdb->prefix . "golftable"; 	// main 
	$table_name2 = $wpdb->prefix . "golfresult"; 	// contain values
	
	// upgrade function changed in WordPress 2.3	
	if (version_compare($wp_version, '2.3.alpha', '>='))		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	else
		require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
     
	if($wpdb->get_var("show tables like '$table_name'") != $table_name){
	 
	      $sql = "CREATE TABLE ".$table_name." (
	      table_aid MEDIUMINT(10) NOT NULL AUTO_INCREMENT,
	      table_name VARCHAR(200) DEFAULT 'Table name' NOT NULL,
	      description MEDIUMTEXT NOT NULL,
		  alternative TINYINT(1) DEFAULT '1' NOT NULL,
		  show_name TINYINT(1) DEFAULT '1' NOT NULL,
		  show_desc TINYINT(1) DEFAULT '0' NOT NULL,
		  head_bold TINYINT(1) DEFAULT '1' NOT NULL,
	      UNIQUE KEY id (table_aid),
	      PRIMARY KEY (table_aid)
	     );";
	     
    dbDelta($sql);

	  // Insert first sample table
      $results = $wpdb->query("INSERT INTO $table_name (table_name,description) VALUES ('Table name 1','This is your first demo table') ");

		$wptable_cfg['border_color']= "#E58802";
		$wptable_cfg['head_color']= "#E58802";
		$wptable_cfg['alt_color']= "#F4F4EC";
		$wptable_cfg['table_align']= "center";
		$wptable_cfg['border_size']= 1;
		$wptable_cfg['cellpadding']= 0;
		$wptable_cfg['cellspacing']= 1;
		$wptable_cfg['table_width']= 0;
		$wptable_cfg['use_cssfile']= 0;
		$wptable_cfg['use_sorting']= 0;

		update_option('wptable', $wptable_cfg);

	}

	if($wpdb->get_var("show tables like '$table_name2'") != $table_name2){

		  $sql = "CREATE TABLE ".$table_name2." (
	      result_aid mediumint(10) NOT NULL AUTO_INCREMENT,
	      table_id MEDIUMINT(10) DEFAULT '0' NOT NULL,
	      row_id MEDIUMINT(10) DEFAULT '1' NOT NULL,
	      value MEDIUMTEXT NOT NULL,
	      UNIQUE KEY id (result_aid),
	      PRIMARY KEY (result_aid)
	     );";

      dbDelta($sql);

	  // Insert first sample entries
      $results = $wpdb->query("INSERT INTO $table_name2 (table_id,row_id,value) VALUES ('1','0','100') ");
      $results = $wpdb->query("INSERT INTO $table_name2 (table_id,row_id,value) VALUES ('1','0','100') ");
      $results = $wpdb->query("INSERT INTO $table_name2 (table_id,row_id,value) VALUES ('1','0','100') ");
      $results = $wpdb->query("INSERT INTO $table_name2 (table_id,row_id,value) VALUES ('1','1','Column 1') ");
      $results = $wpdb->query("INSERT INTO $table_name2 (table_id,row_id,value) VALUES ('1','1','Column 2') ");
      $results = $wpdb->query("INSERT INTO $table_name2 (table_id,row_id,value) VALUES ('1','1','Column 3') ");
	
	}

	// update to v1.20 table , drop old structure
	$result=$wpdb->query('SHOW COLUMNS FROM '.$table_name.' LIKE "border_color"');
	if ($result) $wpdb->query("ALTER TABLE ".$table_name." DROP border_color");
	
	$result=$wpdb->query('SHOW COLUMNS FROM '.$table_name.' LIKE "head_color"');
	if ($result) $wpdb->query("ALTER TABLE ".$table_name." DROP head_color");
	
	$result=$wpdb->query('SHOW COLUMNS FROM '.$table_name.' LIKE "alt_color"');
	if ($result) $wpdb->query("ALTER TABLE ".$table_name." DROP alt_color");

	$result=$wpdb->query('SHOW COLUMNS FROM '.$table_name.' LIKE "table_align"');
	if ($result) $wpdb->query("ALTER TABLE ".$table_name." DROP table_align");

	$result=$wpdb->query('SHOW COLUMNS FROM '.$table_name.' LIKE "border_size"');
	if ($result) $wpdb->query("ALTER TABLE ".$table_name." DROP border_size");
	
	$result=$wpdb->query('SHOW COLUMNS FROM '.$table_name.' LIKE "cellpadding"');
	if ($result) $wpdb->query("ALTER TABLE ".$table_name." DROP cellpadding");
	
	$result=$wpdb->query('SHOW COLUMNS FROM '.$table_name.' LIKE "cellspacing"');
	if ($result) $wpdb->query("ALTER TABLE ".$table_name." DROP cellspacing");
	
	$result=$wpdb->query('SHOW COLUMNS FROM '.$table_name.' LIKE "table_width"');
	if ($result) $wpdb->query("ALTER TABLE ".$table_name." DROP table_width");

	// change to better string type
	$wpdb->query("ALTER TABLE ".$table_name." CHANGE description description MEDIUMTEXT NOT NULL ");
	$wpdb->query("ALTER TABLE ".$table_name2." CHANGE value value MEDIUMTEXT NOT NULL ");
	
}

?>