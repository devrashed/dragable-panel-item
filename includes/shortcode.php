<?php

// Initializing shortcode
add_action( 'init', 'tmph_content_shortcode_callback' );

function tmph_content_shortcode_callback() {
    add_shortcode( 'team_members', 'tmph_content_shortcode' );
}

function tmph_content_shortcode( $atts ) {
    ob_start();

    // Attributes
    $attributes = shortcode_atts(array(
        'member_count' => false,
        'img_position' => 'top',
        'show_button' => true
    ), $atts);

    // Get member contents
    require plugin_dir_path( __FILE__ ) . 'get-members.php';
    ?>
	<?php
	$html = ob_get_clean();
	return $html;
}