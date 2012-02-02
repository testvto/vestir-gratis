<?php get_header(); ?>

<div id="fullcontent" style="margin-bottom:7px;">
  <h2 class="h2title">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    Games &raquo;
    <?php the_breadcrumb(); ?>
  </h2>
  <?php endwhile; else: ?>
  <?php endif; ?>
  <div style="padding:15px;">
    <center>
      <object width="<?php $values = get_post_custom_values("width"); echo $values[0]; ?>" height="<?php $values = get_post_custom_values("height"); echo $values[0]; ?>">
        <param name="movie" value="<?php $values = get_post_custom_values("swf_url"); echo $values[0]; ?>">
        <embed src="<?php $values = get_post_custom_values("swf_url"); echo $values[0]; ?>" width="<?php $values = get_post_custom_values("width"); echo $values[0]; ?>" height="<?php $values = get_post_custom_values("height"); echo $values[0]; ?>"> </embed>
      </object>
    </center>
  </div>
  <div class="clear"></div>
</div>
<div id="content">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <h2 class="archivetitle h2title"> Game Details </h2>
  <div class="archive" style="border-bottom:0px;">
    <div class="thumb left"> <a href="<?php the_permalink() ?>" rel="bookmark">
      <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
      <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="120px" height="90px" alt="<?php the_title(); ?>" />
      <?php } else { ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="120px" height="90px" alt="<?php the_title(); ?>" />
      <?php } ?>
      </a>
      <h2 style="font-size:12px;"><a href="<?php the_permalink(); ?>" rel="bookmark"> <b>
        &nbsp;<?php the_title2('', '', true, '20') ?>
        </b> </a></h2>
    </div>
    <div class="archiveright right">
      <div class="postmeta"> <strong>Category:</strong>
        <?php the_category(',');?>
        <table cellpading="0" cellspacing="0">
          <td><strong>Ratings:</strong></td>
            <td style="background:none;">&nbsp;</td>
            <td ><?php if(function_exists('the_ratings')) { the_ratings(); } ?></td>
        </table>
        <strong>Played:</strong>
        <?php if(function_exists('the_views')) { the_views(); } ?>
        <br>
        <strong>Description:</strong><font style="text-transform:lowercase;">&nbsp;
        <?php $values = get_post_custom_values("description"); echo $values[0]; ?>
        </font> <br>
        <strong>Instructions:</strong><font style="text-transform:lowercase;">&nbsp;
        <?php $values = get_post_custom_values("instructions"); echo $values[0]; ?>
        </font> <br />
      </div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="postnav">
    <h2 class="archivetitle h2title" style="margin-bottom:10px;"> Similar Games </h2>
 
    <?php 
query_posts('orderby=rand&showposts=8');
if (have_posts()) : while (have_posts()) : the_post();
	?>
    <div class="postbox1 left2">
      <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
      <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="120px" height="90px" alt="<?php the_title(); ?>" />
      <?php } else { ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="120px" height="90px" alt="<?php the_title(); ?>" />
      <?php } ?>
      </a>
      <h2 style="font-size:12px;"><a href="<?php the_permalink(); ?>" rel="bookmark"> <b>
        &nbsp;<?php the_title2('', '', true, '20') ?>
        </b> </a></h2>
    </div>
<?php
endwhile; endif;
wp_reset_query();
?>

    <div class="clear"></div>
  </div>
  <?php comments_template(); ?>
  <?php endwhile; else: ?>
  <h2 class="archivetitle h2title">404 - Page not found</h2>
  <?php endif; ?>
</div>
<?php include('game-sidebar.php'); ?>
<?php get_footer(); ?>
