﻿<?php get_header(); ?>

<div id="wrap">

     <div id="content">
    
          <div id="contentleft">
               <?php query_posts($query_string.'&posts_per_page=30');?>


               <?php if (have_posts()) : ?>

                    <?php while (have_posts()) : the_post(); ?>

                         <div class="game" onmouseover="this.className='game2'" onmouseout="this.className='game'">

                              <p><a title="<?php echo str_replace("\n","<br />",get_post_meta($post->ID, "description", true)); ?>" href="<?php the_permalink() ?>" title="Jugar <?php the_title(); ?>"><img src = "<?php echo get_post_meta($post->ID, "thumbnail_url", true); ?>" width = "125" height = "125" /></a></p>

                              <h3><a title="<?php echo str_replace("\n","<br />",get_post_meta($post->ID, "description", true)); ?>" href="<?php the_permalink() ?>" rel="bookmark" title="Jugar <?php the_title_attribute(); ?>">JUGAR</a></h3>	
			      <h4><a title="<?php echo str_replace("\n","<br />",get_post_meta($post->ID, "description", true)); ?>" href="<?php the_permalink() ?>" rel="bookmark" title="Jugar <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>

                              <div class="clear"></div>

                         </div> <!-- end game div -->

                    <?php endwhile; ?>

                    <div class="clear"></div>

               <?php endif; ?>
<center><h2>Juegos de Vestir</h2>
               <p><?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?></p></center>
               
               <p><div class="box">
	       Es el mejore ritmo gratis en el Internet para venir a pasar su tiempo! A&#241;adimos nuevos juegos diarios y tambi&#233;n asegurarse de que cada uno es capaz de ser interpretado por los ni&#241;os de todas las edades! Estamos orgullosos de los juegos que mostramos aqu&#237; y aseg&#250;rese de que disfrute de jugar con ellos! Y disfruta nuestros
               </div></p>	       

          </div> <!-- end contentleft div -->

     <?php include(TEMPLATEPATH."/r_sidebar.php");?>

     </div> <!-- end content div -->

   <div style="clear:both;"></div>

</div> <!-- end wrap div -->

<?php get_footer(); ?>