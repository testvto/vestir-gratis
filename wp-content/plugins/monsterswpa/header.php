<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php bloginfo('name'); ?>
<?php wp_title(); ?>
</title>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/<?php echo stripslashes(get_theme_mod('style1')); ?>" media="screen"/>


<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascripts/dropdown.js"></script>
<?php if (function_exists('wp_enqueue_script') && function_exists('is_singular')) : ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php endif; ?>
<?php wp_head(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascripts/jquery-ui.min.js" ></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascripts/switchcontent.js" ></script>
<script type="text/javascript"> 
	$(document).ready(function(){
		$("#featured > ul").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	});
</script>
</head>
<body>
<div id="headerwrapper">
  <div id="header"> <a href="<?php bloginfo('siteurl'); ?>" title="<?php bloginfo('name'); ?>">
    <div class="logo"></div>
    </a>
<div class="ad468x60"><?php echo stripslashes(get_theme_mod('ad468x60')); ?></div>
</div>
<div id="menu">
  <div class="left">
    <?php wp_list_categories('title_li=&orderby=id'); ?>
  </div>
</div>
</div>
<div id="ad7">
  <div id="top1">
   <?php echo stripslashes(get_theme_mod('ad728x90')); ?>
</div>
<div id="top2">
  <div class="right">
    <div class="langt"> <a href="<?php bloginfo('siteurl'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/usa.gif" border="0"/></a> <a href="<?php bloginfo('siteurl'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/uk.gif" border="0" /></a> <a href="http://translate.google.com/translate?hl=en&sl=en&tl=fr&u=<?php bloginfo('siteurl'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/fr.gif" /></a> <a href="http://translate.google.com/translate?hl=en&sl=en&tl=de&u=<?php bloginfo('siteurl'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/de.gif" /></a> <a href="http://translate.google.com/translate?hl=en&sl=en&tl=es&u=<?php bloginfo('siteurl'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/sp.gif" /></a> <a href="http://translate.google.com/translate?hl=en&sl=en&tl=it&u=<?php bloginfo('siteurl'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/it.gif" /></a> </div>
    <div style="clear:both"></div>
    <div class="linet"></div>
    <form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
      <div id="search">
        <input class="searchsubmit" type="submit" value="&nbsp;&nbsp;&nbsp;"/>
        <input class="searchinput" type="text" value="Search Games..." onclick="this.value='';" name="s" id="s" />
      </div>
    </form>
    <br />
    <form name="jumpList" action="">
      <select name="jumpSelect" onChange="window.location.href=this[selectedIndex].value"  class="selectf">
        <option value="#"> &nbsp; <strong><u>Jump to Games</u></strong></option>
        <?php
$home_query = new WP_Query('showposts=600');
while ( $home_query->have_posts() ) : $home_query->the_post()
?>
        <option value="<?php the_permalink() ?>"> &nbsp;
        <?php the_title2('', '', true, '20') ?>
        </option>
        <?php endwhile;?>
      </select>
    </form>
  </div>
</div>
<div style="clear:both;"></div>
</div>
<div id="wrapper">