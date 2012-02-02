<div id="allgames">
<div class="gamesbox left"  style="padding-left:0px;">
<div class="allgamest"> <a href="#">&nbsp;&nbsp;&nbsp;All Game List</a> <small><a href="javascript:bobexample.sweepToggle('expand')">[&nbsp;Show</a>/<a href="javascript:bobexample.sweepToggle('contract')">Hide&nbsp;]</a></small> </div>
<div style="clear:both;"></div>
<ul>
  <?php
$home_query = new WP_Query('showposts=40');
while ( $home_query->have_posts() ) : $home_query->the_post()
?>
  <?php if($count % 7 == 0) echo ' <div class="left2">'; else echo '<div class="right2">'; ?>
  <li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
    <?php the_title2('', '', true, '12') ?>
    </a></li>
  </div>
  <?php if($count % 7 != 0) echo '';?>
  <?php endwhile;?>
  <h3 id="bobcontent1-title" class="handcursor" style=" display:none;">don't delete this</h3>
  <div id="bobcontent1" class="switchgroup1">
    <?php
$home_query = new WP_Query('showposts=990&offset=40');
while ( $home_query->have_posts() ) : $home_query->the_post()
?>
    <?php if($count % 7 == 0) echo ' <div class="left2">'; else echo '<div class="right2">'; ?>
    <li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
      <?php the_title2('', '', true, '12') ?>
      </a></li>
  </div>
  <?php if($count % 7 != 0) echo '';?>
  <?php endwhile;?>
  </div>
  <script type="text/javascript">
 

var bobexample=new switchcontent("switchgroup1", "div")  
bobexample.setStatus('<img src="#" /> ', '<img src="#" /> ')
bobexample.setColor('darkred', 'black')
bobexample.setPersist(true)
bobexample.collapsePrevious(true)  
bobexample.init()
</script>
</ul>
</div>
</div>
<div class="clear"></div>
<div id="footer">
  <div class="left">
    <ul>
      <li><a href="<?php bloginfo('home'); ?>"> Home </a></li>
      <?php wp_list_pages('title_li=&orderby=id'); ?>
    </ul>
  </div>
  <div class="right">
    <ul>
      <li> <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"> &copy; Copyright <?php echo date('Y'); ?> -
        <?php bloginfo('name'); ?>
        </a> </li>
    </ul>
  </div>
  <div class="clear"></div>
</div>
</div>
<div class="clear"></div>
<div id="bottom">
<div class="right">
  <!-- Do not delete this license link without our permission, for removal contact us at wparcade@yahoo.com-->
  Theme by <a href="http://wparcade.com" title="WordPress Arcade Themes" rel="bookmark">WPArcade.com</a> |     
  Powered by <a href="http://wordpress.org/" rel="bookmark" target="_blank"> WordPress </a>
  <!-- Do not delete this license link without our permission, for removal contact us at wparcade@yahoo.com-->
  <div class="clear"></div>
</div><br />

<div style="visibility:hidden;"><?php echo stripslashes(get_theme_mod('track_code')); ?></div>

<?php wp_footer(); ?>
</body>
</html>
