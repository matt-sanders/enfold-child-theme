<?php

add_theme_support('avia_no_session_support');
add_theme_support('avia_template_builder_custom_css');

function add_custom_scripts(){
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri().'/css/theme-style.css');
    wp_enqueue_style('custom-css', get_stylesheet_directory_uri().'/css/custom.css');
}
add_action('wp_enqueue_scripts', 'add_custom_scripts');

?>