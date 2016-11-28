<?php

add_theme_support('avia_no_session_support');
add_theme_support('avia_template_builder_custom_css');

include_once('lib/agents.php');

function add_custom_scripts(){
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri().'/css/theme-style.css');
    wp_enqueue_style('custom-css', get_stylesheet_directory_uri().'/css/custom.css');
    wp_enqueue_script('frontend', get_stylesheet_directory_uri().'/js/frontend.js', array('avia-default'));
}
add_action('wp_enqueue_scripts', 'add_custom_scripts');


function avia_add_content_font($fonts)
{
    $fonts['Raleway'] = 'Raleway:300,300i,400,400i,500,500i,700,700i';
    return $fonts;
}
add_filter( 'avf_google_content_font',  'avia_add_content_font');

//add the search in before everything else
function append_harcourts_search(){
    echo '<div id="harcourts-header-search-wrapper">';
    dynamic_sidebar('post-header');
    echo '</div>';
}
add_action('ava_after_main_container', 'append_harcourts_search', 1);

//add the office location before the footer
function append_office_locations(){
    echo '<div id="harcourts-pre-footer">';
    dynamic_sidebar('pre-footer');
    echo '</div>';
}
add_action('ava_before_footer', 'append_office_locations', 1);

//change the breadcrumb separator
function change_separator($args){
    $args['separator'] = '&gt;';
    return $args;
}
add_filter('avia_breadcrumbs_args', 'change_separator');

//remove the elegant blog setting from single agent pages
function remove_elegant_blog($classes){
    if ( is_singular('hl_agents') ){
        $idx = array_search('elegant-blog', $classes);
        if ( $idx >= 0 ) $classes = array_splice( $classes, $idx - 1, 1 );
    }
    return $classes;
}
add_filter('avf_header_classes', 'remove_elegant_blog');

function avia_load_shortcodes($paths){
    $shortcode_dir = get_stylesheet_directory().'/templatebuilder/';
    array_unshift($paths, $shortcode_dir);
    return $paths;
}
add_filter('avia_load_shortcodes', 'avia_load_shortcodes', 15, 1);
?>