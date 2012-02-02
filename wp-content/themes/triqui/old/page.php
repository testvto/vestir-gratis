<?php get_header(); ?>
<div id="wrap">
<div id="content">
     <div id="contentleft">
          <div class = "page">
               <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
               <h1><?php the_title(); ?></h1>
               <?php the_content(__('Read more'));?>
               <?php endwhile; else: ?>
               <p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
          </div> <!-- end page div -->
     </div> <!-- end contentleft div -->
	<?php include(TEMPLATEPATH."/r_sidebar.php");?>
</div> <!-- end content div --><br clear="all" />
</div>

<?php get_footer(); ?>