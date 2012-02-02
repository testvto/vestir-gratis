<?php get_header(); ?>

<div id="wrap">

     <div id="content">
    
          <div id="contentleft">


<div id="main_ads">
<div id="adsense">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5691228106014912";
/* Vestir Main Page */
google_ad_slot = "5510948252";
google_ad_width = 336;
google_ad_height = 280;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

</div>

                       <H5>Destacados:</H5>
                        <div id="destacados">
                        <a href="http://www.juegosdevestirgratis.com.mx/juego-de-vestir-y-maquillar"><img src="http://www.juegosdevestirgratis.com.mx/wp-content/thumbs/Beauty-rush-marys-wedding.jpg"HEIGHT="100" WIDTH="100" BORDER="0"" /></a>
                        </div>
                        <div id="destacados">
                        <a href="http://www.juegosdevestirgratis.com.mx/juego-de-shakira"><img src="http://www.juegosdevestirgratis.com.mx/wp-content/thumbs/shakira-dress-up.jpg"HEIGHT="100" WIDTH="100" BORDER="0""/></a>
                        </div>
                        <div id="destacados">
                        <a href="http://www.juegosdevestirgratis.com.mx/juego-de-hannah-montana"><img src="http://www.juegosdevestirgratis.com.mx/wp-content/thumbs/hannah montana.jpg"HEIGHT="100" WIDTH="100" BORDER="0""/></a>
                        </div>
                        <div id="destacados">
                        <a href="http://www.juegosdevestirgratis.com.mx/princesa-del-futuro"><img src="http://www.juegosdevestirgratis.com.mx/wp-content/thumbs/Princesa_del_futuro.jpg"HEIGHT="100" WIDTH="100" BORDER="0""/></a>
                        </div>
                        <div id="destacados">
                        <a href="http://www.juegosdevestirgratis.com.mx/viste-a-la-novia"><img src="http://www.juegosdevestirgratis.com.mx/wp-content/thumbs/Vestir a la novia.jpg"HEIGHT="100" WIDTH="100" BORDER="0"/></a>
                        </div>
                   <div id="destacados">
                        <a href="http://www.juegosdevestirgratis.com.mx/vestir-princesa"><img src="http://www.juegosdevestirgratis.com.mx/wp-content/thumbs/vestir-princesa.jpg"HEIGHT="100" WIDTH="100" BORDER="0""/></a>
                        </div>
</div>



               <?php if (have_posts()) : ?>

                    <?php while (have_posts()) : the_post(); ?>

                         <div class="game" onmouseover="this.className='game2'" onmouseout="this.className='game'">

                              <p><a href="<?php the_permalink() ?>" title="Jugar <?php the_title(); ?>"><img src = "<?php echo get_post_meta($post->ID, "thumbnail_url", true); ?>" width = "150" height = "150" /></a></p>

                              <h4><a href="<?php the_permalink() ?>" rel="bookmark" title="Jugar <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>

                              <div class="clear"></div>

                         </div> <!-- end game div -->

                    <?php endwhile; ?>

                    <div class="clear"></div>

               <?php endif; ?>
<center><h2>Juegos de Vestir y Maquillar Gratis</h2></center>
               <p><?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?><br></p>

          </div> <!-- end contentleft div -->

     <?php include(TEMPLATEPATH."/r_sidebar.php");?>

     </div> <!-- end content div -->

   <div style="clear:both;"></div>

</div> <!-- end wrap div -->

<?php get_footer(); ?>