<?php

add_theme_support( 'post-thumbnails' );

if ( function_exists('register_sidebars') )
    register_sidebars(1);
    
    
register_sidebar(array('name'=>'Sidebar-Header',
        'before_widget' => '<div class="sidebar-widget" style="text-decoration: none; font-family: verdana; font-size: 11px;color:#000000">',
        'after_widget' => '</div>',
        'before_title' => '<h4 style="display:none;">',
        'after_title' => '</h4>',
    ));

register_sidebar(array('name'=>'Sidebar-Game',
        'before_widget' => '<div class="sidebar-widget" style="text-decoration: none; font-family: verdana; font-size: 11px;color:#000000">',
        'after_widget' => '</div>',
        'before_title' => '<h4 style="display:none;">',
        'after_title' => '</h4>',
    ));   
    
    
?>