<?php get_header();  ?>

<div id="col1">
  <div id="featuredcontent" >
    <div id="featured" class="notranslate">
      <ul class="ui-tabs-nav" >
        <?php $recent = new WP_Query("cat=".get_theme_mod('featuredcat')."&showposts=3"); while($recent->have_posts()) : $recent->the_post();?>
        <li class="ui-tabs-nav-item ui-tabs-selected" id="nav-post-<?php the_ID(); ?>"><a href="#post-<?php the_ID(); ?>">
          <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
          <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="80px" height="50px" alt="<?php the_title(); ?>" />
          <?php } else { ?>
          <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="80px" height="50px" alt="<?php the_title(); ?>" />
          <?php } ?>
          <span> <b>
          <?php the_title(); ?>
          </b> </span></a></li>
        <?php endwhile; ?>
      </ul>
      <?php $recent = new WP_Query("cat=".get_theme_mod('featuredcat')."&showposts=3"); while($recent->have_posts()) : $recent->the_post();?>
      <div id="post-<?php the_ID(); ?>" class="ui-tabs-panel ui-tabs-hide"><a href="<?php the_permalink() ?>" rel="bookmark">
        <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
        <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="408px" height="248px" alt="<?php the_title(); ?>" />
        <?php } else { ?>
        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="408px" height="248px" alt="<?php the_title(); ?>" />
        <?php } ?>
        </a>
        <div class="info" >
          <h2><a href="<?php the_permalink(); ?>" rel="bookmark"> <b>
            <?php the_title2('', '', true, '25') ?>
            </b> </a></h2>
          <p>
            <?php the_content_rss('', TRUE, '', 26); ?>
          </p>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
<div id="sidebarad">
  <?php include('ads/sidebar300x250.php'); ?>
</div>
<div id="col1" style="margin-top:7px;">
  <div id="contentleft">
     
    <div class="category"><a href="<?php echo get_category_link(get_theme_mod('box4cat')); ?>" rel="bookmark"><?php echo cat_id_to_name(get_theme_mod('box4cat')); ?> Games</a> </div>
    <?php $recent = new WP_Query("cat=".get_theme_mod('box4cat')."&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
    <div class="postbox1 left">
      <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
      <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } else { ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } ?>
      </a>
      <h2><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title2('', '', true, '19') ?>
        </a></h2>
    </div>
    <?php endwhile; ?>
    <?php $recent = new WP_Query("cat=".get_theme_mod('box4cat')."&offset=1&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
    <div class="postbox2 left">
      <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
      <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } else { ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } ?>
      </a>
      <h2><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title2('', '', true, '19') ?>
        </a></h2>
    </div>
    <?php endwhile; ?>
    <div class="clear"></div>
    <ul>
      <?php $recent = new WP_Query("cat=".get_theme_mod('box4cat')."&offset=2&showposts=".get_theme_mod('list2')); while($recent->have_posts()) : $recent->the_post();?>
      <li><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title(); ?>
        </a></li>
      <?php endwhile; ?>
    </ul>
   
    
    <div class="category"><a href="<?php echo get_category_link(get_theme_mod('box6cat')); ?>" rel="bookmark"><?php echo cat_id_to_name(get_theme_mod('box6cat')); ?> Games</a></div>
    <?php $recent = new WP_Query("cat=".get_theme_mod('box6cat')."&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
    <div class="postbox1 left">
      <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
      <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } else { ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } ?>
      </a>
      <h2><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title2('', '', true, '19') ?>
        </a></h2>
    </div>
    <?php endwhile; ?>
    <?php $recent = new WP_Query("cat=".get_theme_mod('box6cat')."&offset=1&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
    <div class="postbox2 left">
      <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
      <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } else { ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } ?>
      </a>
      <h2><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title2('', '', true, '19') ?>
        </a></h2>
    </div>
    <?php endwhile; ?>
    <div class="clear"></div>
    <ul>
      <?php $recent = new WP_Query("cat=".get_theme_mod('box6cat')."&offset=2&showposts=".get_theme_mod('list2')); while($recent->have_posts()) : $recent->the_post();?>
      <li><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title(); ?>
        </a></li>
      <?php endwhile; ?>
    </ul>
 
 
    <div class="category"><a href="<?php echo get_category_link(get_theme_mod('box8cat')); ?>" rel="bookmark"><?php echo cat_id_to_name(get_theme_mod('box8cat')); ?> Games</a></div>
    <?php $recent = new WP_Query("cat=".get_theme_mod('box8cat')."&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
    <div class="postbox1 left">
      <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
      <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } else { ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } ?>
      </a>
      <h2><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title2('', '', true, '19') ?>
        </a></h2>
    </div>
    <?php endwhile; ?>
    <?php $recent = new WP_Query("cat=".get_theme_mod('box8cat')."&offset=1&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
    <div class="postbox2 left">
      <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
      <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } else { ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } ?>
      </a>
      <h2><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title2('', '', true, '19') ?>
        </a></h2>
    </div>
    <?php endwhile; ?>
    <div class="clear"></div>
    <ul>
      <?php $recent = new WP_Query("cat=".get_theme_mod('box8cat')."&offset=2&showposts=".get_theme_mod('list2')); while($recent->have_posts()) : $recent->the_post();?>
      <li><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title(); ?>
        </a></li>
      <?php endwhile; ?>
    </ul>
 
  </div>
  <div id="contentright">
 
    <div class="category"><a href="<?php echo get_category_link(get_theme_mod('box5cat')); ?>" rel="bookmark"><?php echo cat_id_to_name(get_theme_mod('box5cat')); ?> Games</a></div>
    <?php $recent = new WP_Query("cat=".get_theme_mod('box5cat')."&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
    <div class="postbox1 left">
      <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
      <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } else { ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } ?>
      </a>
      <h2><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title2('', '', true, '19') ?>
        </a></h2>
    </div>
    <?php endwhile; ?>
    <?php $recent = new WP_Query("cat=".get_theme_mod('box5cat')."&offset=1&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
    <div class="postbox2 left">
      <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
      <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } else { ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } ?>
      </a>
      <h2><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title2('', '', true, '19') ?>
        s </a></h2>
    </div>
    <?php endwhile; ?>
    <div class="clear"></div>
    <ul>
      <?php $recent = new WP_Query("cat=".get_theme_mod('box5cat')."&offset=2&showposts=".get_theme_mod('list2')); while($recent->have_posts()) : $recent->the_post();?>
      <li><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title(); ?>
        </a></li>
      <?php endwhile; ?>
    </ul>
  
    <div class="category"><a href="<?php echo get_category_link(get_theme_mod('box7cat')); ?>" rel="bookmark"><?php echo cat_id_to_name(get_theme_mod('box7cat')); ?> Games</a></div>
    <?php $recent = new WP_Query("cat=".get_theme_mod('box7cat')."&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
    <div class="postbox1 left">
      <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
      <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } else { ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } ?>
      </a>
      <h2><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title2('', '', true, '19') ?>
        </a></h2>
    </div>
    <?php endwhile; ?>
    <?php $recent = new WP_Query("cat=".get_theme_mod('box7cat')."&offset=1&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
    <div class="postbox2 left">
      <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
      <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } else { ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } ?>
      </a>
      <h2><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title2('', '', true, '19') ?>
        </a></h2>
    </div>
    <?php endwhile; ?>
    <div class="clear"></div>
    <ul>
      <?php $recent = new WP_Query("cat=".get_theme_mod('box7cat')."&offset=2&showposts=".get_theme_mod('list2')); while($recent->have_posts()) : $recent->the_post();?>
      <li><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title(); ?>
        </a></li>
      <?php endwhile; ?>
    </ul>
 
 
    <div class="category"><a href="<?php echo get_category_link(get_theme_mod('box9cat')); ?>" rel="bookmark"><?php echo cat_id_to_name(get_theme_mod('box9cat')); ?> Games</a></div>
    <?php $recent = new WP_Query("cat=".get_theme_mod('box9cat')."&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
    <div class="postbox1 left">
      <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
      <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } else { ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } ?>
      </a>
      <h2><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title2('', '', true, '19') ?>
        </a></h2>
    </div>
    <?php endwhile; ?>
    <?php $recent = new WP_Query("cat=".get_theme_mod('box9cat')."&offset=1&showposts=1"); while($recent->have_posts()) : $recent->the_post();?>
    <div class="postbox2 left">
      <?php

	$values = get_post_custom_values("thumbnail_url");
	if (isset($values[0])) {
?>
      <img src="<?php $values = get_post_custom_values("thumbnail_url"); echo $values[0]; ?>" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } else { ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimg.png" width="<?php echo stripslashes(get_theme_mod('postboxthumbw')); ?>" height="<?php echo stripslashes(get_theme_mod('postboxthumbh')); ?>" alt="<?php the_title(); ?>" />
      <?php } ?>
      </a>
      <h2><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title2('', '', true, '19') ?>
        </a></h2>
    </div>
    <?php endwhile; ?>
    <div class="clear"></div>
    <ul>
      <?php $recent = new WP_Query("cat=".get_theme_mod('box9cat')."&offset=2&showposts=".get_theme_mod('list2')); while($recent->have_posts()) : $recent->the_post();?>
      <li><a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title(); ?>
        </a></li>
      <?php endwhile; ?>
    </ul>
 
  </div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
