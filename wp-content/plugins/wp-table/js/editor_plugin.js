// Docu : http://tinymce.moxiecode.com/tinymce/docs/customization_plugins.html

// Load the language file
tinyMCE.importPluginLanguagePack('wpTable', 'en,tr,de,sv,zh_cn,cs,fa,fr_ca,fr,pl,pt_br,nl,he,nb,ru,ru_KOI8-R,ru_UTF-8,nn,cy,es,is,zh_tw,zh_tw_utf8,sk,da');

var TinyMCE_wpTablePlugin = {

	getInfo : function() {
		return {
			longname : 'wpTable',
			author : 'Alex Rabe',
			authorurl : 'http://alexrabe.boelinger.com',
			infourl : 'http://alexrabe.boelinger.com',
			version : "1.0"
		};
	},

	getControlHTML : function(cn) {
	 	switch (cn) {
			case "wpTable":
				return tinyMCE.getButtonHTML(cn, 'lang_wpTable_desc', '{$pluginurl}/wp-table.gif', 'mcemywpTable');
		}

		return "";
	},

	execCommand : function(editor_id, element, command, user_interface, value) {
	 
		switch (command) {
			// Remember to have the "mce" prefix for commands so they don't intersect with built in ones in the browser.
			case "mcemywpTable":
				// Do your custom command logic here.
				wptable_buttonscript();
				return true;
		}
		return false;
	}

};

// Adds the plugin class to the list of available TinyMCE plugins
tinyMCE.addPlugin("wpTable", TinyMCE_wpTablePlugin);

