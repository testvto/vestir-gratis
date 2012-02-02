<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>

<div id="fullcontent">
<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
  <h2 class="h2title">
    <?php the_title(); ?>
  </h2>
  
  <div class="entry">
    <?php the_content('More &raquo;'); ?>
  </div>
  <div class="clear"></div>
  <?php endwhile; ?>
  <?php else : ?>
  <?php endif; ?>
</div>
<?php get_footer(); ?>
