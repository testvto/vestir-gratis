<?php get_header(); ?>
<div id="wrap">
     <div id="content">
          <div id="contentleft">
               <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                         <div class="game" onmouseover="this.className='game2'" onmouseout="this.className='game'">
                              <p><a href="<?php the_permalink() ?>" title="Play <?php the_title(); ?>"><img src = "<?php echo get_post_meta($post->ID, "thumbnail_url", true); ?>" width = "125" height = "125" /></a></p>
                              <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Play <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                              <div class="clear"></div>
                         </div> <!-- end game div -->
                    <?php endwhile; ?>
                    <div class="clear"></div>
               <?php endif; ?>
               <p><?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?></p>
          </div> <!-- end contentleft div -->
     <?php include(TEMPLATEPATH."/r_sidebar.php");?>
     </div> <!-- end content div -->
   <div style="clear:both;"></div>
</div> <!-- end wrap div -->
<?php get_footer(); ?>