<?php

include("includes/theme-options.php");

if (function_exists('register_sidebar'))
{
    register_sidebar(array(
		'name'			=> 'Home Sidebar',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3><div class="box">',
    ));	
	
    register_sidebar(array(
		'name'			=> 'Game Sidebar',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3><div class="box">',
    ));			
	
}

# Limit Post
function the_content_limit($max_char, $more_link_text = '', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      echo "";
      echo $content;
      echo "&nbsp;<a href='";
      the_permalink();
      echo "'>"."Read More &rarr;</a>";
      echo "";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "";
        echo $content;
        echo "...";
        echo "&nbsp;<a href='";
        the_permalink();
        echo "'>"."</a>";
        echo "";
   }
   else {
      echo "";
      echo $content;
      echo "&nbsp;<a href='";
      the_permalink();
      echo "'>"."Read More &rarr;</a>";
      echo "";
   }
}

# Turn a category ID to a Name
function cat_id_to_name($id) {
	foreach((array)(get_categories()) as $category) {
    	if ($id == $category->cat_ID) { return $category->cat_name; break; }
	}
}


# Breadcrumb
function the_breadcrumb() {
	if (!is_home()) {
		if (is_category() || is_single()) {
			single_cat_title();
			if (is_single()) {
			the_category(', ');
				echo " &raquo; ";
				the_title();
			}
		} elseif (is_page()) {
			echo the_title();
		}
		  elseif (is_tag()) {
			echo 'Games tagged with "'; 
			single_tag_title();
			echo '"'; }
		elseif (is_day()) {echo "Games Archive for "; the_time(' F jS, Y');}
		elseif (is_month()) {echo "Games Archive for "; the_time(' F, Y');}
		elseif (is_year()) {echo "Games Archive for "; the_time(' Y');}
		elseif (is_author()) {echo "Games  Author Archive";}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "Blog Archives";}
		elseif (is_search()) {echo "Search";}
	}
}

function the_title2($before = '', $after = '', $echo = true, $length = false) {
         $title = get_the_title();
      if ( $length && is_numeric($length) ) {
             $title = substr( $title, 0, $length );
          }
        if ( strlen($title)> 0 ) {
          $title = apply_filters('the_title2', $before . $title . $after, $before, $after);
             if ( $echo )
                echo $title;
             else
                return $title;
          }
      }
?>
