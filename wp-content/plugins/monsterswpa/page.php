<?php get_header(); ?>

<div id="content">
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
  <h2 class="h2title">
    <?php the_title(); ?>
  </h2>
  <div class="entry">
    <?php the_content(''); ?>
  </div>
  <div class="clear"></div>
  <?php endwhile; ?>
  <?php else : ?>
    <h2 class="archivetitle h2title">404 - Page not found</h2>
  <?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
