<?php

add_theme_support('avia_no_session_support');
add_theme_support('avia_template_builder_custom_css');

function add_custom_scripts(){
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri().'/css/theme-style.css');
    wp_enqueue_style('custom-css', get_stylesheet_directory_uri().'/css/custom.css');
}
add_action('wp_enqueue_scripts', 'add_custom_scripts');

//remove the special ampersand
function remove_actions(){
    remove_filter('avia_ampersand','avia_ampersand');
}
add_action('init', 'remove_actions');

//add a templatebuilder directory
function avia_load_shortcodes($paths){
    $shortcode_dir = get_stylesheet_directory().'/templatebuilder/';
    array_unshift($paths, $shortcode_dir);
    return $paths;
}
//add_filter('avia_load_shortcodes', 'avia_load_shortcodes', 15, 1);

//add google fonts
function avia_add_heading_font($fonts)
{
    $fonts['Source Sans Pro'] = 'Source Sans Pro:400,600,800';
    return $fonts;
}
//add_filter( 'avf_google_heading_font',  'avia_add_heading_font');

function avia_add_content_font($fonts)
{
    $fonts['Source Sans Pro'] = 'Source Sans Pro:400,600,800';
    return $fonts;
}
//add_filter( 'avf_google_content_font',  'avia_add_content_font');

?>