<?php
function tmph_register_post_type_and_taxonomy() {
    // Settings array
    $tms_settings_array = get_option('tms_setting_datas');
    $tms_post_type_name = $tms_settings_array['tms_post_type_name'];
    $tms_post_type_slug = $tms_settings_array['tms_post_type_slug'];

    // Register post type - team_members
    $labels = array(
        'name'                  => _x( $tms_post_type_name . 's', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( $tms_post_type_name, 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( $tms_post_type_name . 's', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( $tms_post_type_name, 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New ' . $tms_post_type_name, 'textdomain' ),
        'new_item'              => __( 'New ' . $tms_post_type_name, 'textdomain' ),
        'edit_item'             => __( 'Edit ' . $tms_post_type_name, 'textdomain' ),
        'view_item'             => __( 'View ' . $tms_post_type_name, 'textdomain' ),
        'all_items'             => __( 'All ' . $tms_post_type_name, 'textdomain' ),
        'search_items'          => __( 'Search ' . $tms_post_type_name, 'textdomain' ),
        'parent_item_colon'     => __( 'Parent :' . $tms_post_type_name, 'textdomain' ),
        'not_found'             => __( 'No ' . $tms_post_type_name . ' found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No ' . $tms_post_type_name . ' found in Trash.', 'textdomain' ),
        'archives'              => _x(  $tms_post_type_name . ' archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'featured_image'        => _x( $tms_post_type_name . ' Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set ' . $tms_post_type_name, 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove ' . $tms_post_type_name, 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as ' . $tms_post_type_name, 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x(  $tms_post_type_name . ' archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'menu_icon'          => 'dashicons-groups',
        'rewrite'            => array( 'slug' =>  $tms_post_type_slug ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );
 
    register_post_type( 'team_members', $args );
    
    // Flush the rules
    flush_rewrite_rules();

    // Register texonomy
    $labels = array(
        'name'              => _x( 'Member Type', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Member Type', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Member Type', 'textdomain' ),
        'all_items'         => __( 'All Member Types', 'textdomain' ),
        'view_item'         => __( 'View Member Type', 'textdomain' ),
        'parent_item'       => __( 'Parent Member Type', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Member Type:', 'textdomain' ),
        'edit_item'         => __( 'Edit Member Type', 'textdomain' ),
        'update_item'       => __( 'Update Member Type', 'textdomain' ),
        'add_new_item'      => __( 'Add New Member Type', 'textdomain' ),
        'new_item_name'     => __( 'New Member Type', 'textdomain' ),
        'not_found'         => __( 'No Member Type Found', 'textdomain' ),
        'back_to_items'     => __( 'Back to Member Type', 'textdomain' ),
        'menu_name'         => __( 'Member Type', 'textdomain' ),
    );
 
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'member_type' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'member_type', 'team_members', $args );
}
 
add_action( 'init', 'tmph_register_post_type_and_taxonomy' );

?>