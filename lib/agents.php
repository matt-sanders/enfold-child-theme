<?php

//add the agent sidebar
function set_harcourts_agent_sidebar_position(){
    global $avia_config;

    if ( get_post_type() == 'hl_agents' ){
        $avia_config['layout']['current'] = $avia_config['layout']['sidebar_right'];
        $avia_config['layout']['current']['main'] = 'sidebar_right';
    }
}
add_action('wp_head', 'set_harcourts_agent_sidebar_position');

function set_harcourts_agent_sidebar_content($sidebar){
    if ( get_post_type() == 'hl_agents' ){
        return 'agents';
    }
    return $sidebar;
}
add_filter('avf_custom_sidebar', 'set_harcourts_agent_sidebar_content');

function add_agent_email($email){
    if ( get_post_type() != 'hl_agents') return $email;
    return get_post_meta( get_the_ID(), '_hl_contact_email', true);
}
add_filter('harcourts_listing_email', 'add_agent_email');

function show_agent_details(){
    if ( get_post_type() != 'hl_agents') return;
    $agent = new stdClass();
    $agent->StaffPhotoUrl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true)[0];
    $agent->DisplayName = 'Contact';
    $agent->MobileNumber = get_post_meta( get_the_ID(), '_hl_contact_mobile', true);
    $agent->HomeNumber = get_post_meta( get_the_ID(), '_hl_contact_phone', true);
    $agent->EmailAddress = get_post_meta( get_the_ID(), '_hl_contact_email', true);

    $terms = wp_get_post_terms(get_the_ID(), 'hl_office_locations');
    $agent->OfficeAddress = $terms[0]->description;
    
    ob_start();
    include get_stylesheet_directory().'/templates/harcourts/agent.php';
    return ob_get_clean();
}
add_shortcode('agent-details', 'show_agent_details');

function add_agent_filter($filters){
    if ( get_post_type() != 'hl_agents' ) return $filters;
    $agent_id = get_post_meta( get_the_ID(), '_hl_id', true);
    if ( $agent_id ) $filters['staffid'] = $agent_id;
    return $filters;
}
add_filter('harcourts-listings-filters', 'add_agent_filter');