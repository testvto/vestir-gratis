<?php
/*
Template Name: Links
*/
?>
<?php get_header(); ?>

<div id="content">
  <h2 class="h2title">Links</h2>
  <div class="entry">
    <ul>
      <?php wp_list_bookmarks('title_li=&category_before=&category_after=&title_before=<h4>&title_after=</h4>'); ?>
    </ul>
  </div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
