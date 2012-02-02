<?php get_header(); ?>

<div id="content">
  <?php if (have_posts()) : ?>
  <h2 class="archivetitle h2title"> Search Results for "
    <?php the_search_query() ?>
    " Games </h2>
  <?php while (have_posts()) : the_post(); ?>
  <div class="archive">
    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
      <?php the_title(); ?>
      </a> </h2>
    <div class="thumb left"> <a href="<?php the_permalink() ?>" rel="bookmark">
      <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
      <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="120px" height="90px" alt="<?php the_title(); ?>" />
      <?php } else { ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="120px" height="90px" alt="<?php the_title(); ?>" />
      <?php } ?>
      </a></div>
    <div class="archiveright right">
      <div class="postmeta"> <strong>Category:</strong>
        <?php the_category(',');?>
        <table cellpading="0" cellspacing="0">
          <td><strong>Ratings:</strong></td>
            <td>&nbsp;</td>
            <td><?php if(function_exists('the_ratings')) { the_ratings(); } ?></td>
        </table>
        <strong>Played:</strong>
        <?php if(function_exists('the_views')) { the_views(); } ?>
        <span style="float:right; margin-top:-35px; height:18px;" class="span2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">Play This Game </a> </span> <br>
        <strong>Description:</strong><font style="text-transform:lowercase;">&nbsp;
        <?php the_excerpt_rss(22); ?>
        </font> <br />
      </div>
    </div>
    <div class="clear"></div>
    <div class="clear"></div>
  </div>
  <?php endwhile; ?>
  <div class="clear"></div>
  <div class="navigation">
    <div class="left">
      <?php previous_posts_link('&laquo; Previous Games', 0); ?>
    </div>
    <div class="right">
      <?php next_posts_link('Next Games &raquo;', 0); ?>
    </div>
  </div>
  <?php else : ?>
  <h2 class="archivetitle h2title"> No Search Results for "
    <?php the_search_query() ?>
    " Games </h2>
  <?php endif; ?>
</div>
<?php include('game-sidebar.php'); ?>
<?php get_footer(); ?>
