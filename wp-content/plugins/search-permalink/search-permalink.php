<?php
/*
Plugin Name: Search Permalink
Plugin URI: http://www.ajalapus.com/downloads/search-permalink/
Version: 1.1
Description: Redirects search form queries to cruft-free permalink <acronym title="Uniform Resource Identifier">URI</acronym>s
Author: Aja Lorenzo Lapus
Author URI: http://www.ajalapus.com/

	Copyright 2007 Aja Lorenzo Lapus

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
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

Change Log:
v1.1 17-Oct-2007:
	- Added client-side script to lessen server-side processing and redirects.
v1.0.1 14-Oct-2007:
	- Support for any combination of permalink and query string requests for search term and page number.
v1.0 25-Aug-2007:
	- Fixed URL encoding bug.
Beta v1 19-Aug-2007:
	- First beta release of the Search Permalink plugin.
*/

/* JavaScript Output */

if ('js' == $_GET['out']) {
	define('WP_USE_THEMES', false);
	require('../../wp-blog-header.php');
	header('Content-Type: text/javascript');
?>var aja_sp_onload = window.onload;

window.onload = function() {
	if (typeof aja_sp_onload == 'function' && aja_sp_onload) {
		aja_sp_onload();
	}
	if (document.getElementById) {
		function getFormNode(theChildNode) {
			var theParentNode = theChildNode.parentNode;
			if ('form' == theParentNode.tagName.toLowerCase()) {
				return theParentNode;
			} else if (null == theParentNode) {
				return;
			} else {
				return getFormNode(theParentNode);
			}
		}
		var theTextNode = document.getElementById('s');
		if (theTextNode) {
			var theFormNode = getFormNode(theTextNode);
			if (theFormNode) {
				var theQueryStr;
				theTextNode.onchange = function() {
					theQueryStr = "<?php bloginfo('url'); ?>";
					if (theTextNode.value && (0 < theTextNode.value.length)) {
						theQueryStr += '/search/'+ encodeURIComponent(theTextNode.value).replace('%20', '+') +'/';
					}
					theFormNode.setAttribute('onsubmit', 'window.location.assign("'+ theQueryStr +'"); return false;');
				}
			}
		}
	}
}<?php
	exit();
}

/* Server-side Redirect Callback */

function aja_spredir() {
	if (is_search()) {
		$aja_uri = get_bloginfo('url') .'/search/'. urlencode(get_query_var('s')) . ((get_query_var('paged')) ? '/page/'. get_query_var('paged') .'/' : '/');
		if (!empty($_GET['s']) || !empty($_GET['paged']))
			wp_redirect($aja_uri);
	}
}

/* JavaScript Insert Callback */

function aja_spjsins() {
?>	<script type="text/javascript" src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/search-permalink.php?out=js"> </script>
<?php
}

/* WordPress Hooks */

add_action('template_redirect', 'aja_spredir');
add_action('wp_head', 'aja_spjsins');
