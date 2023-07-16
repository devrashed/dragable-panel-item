<?php

// Admin submenu page
add_action( 'admin_menu', 'dpi_adding_menu_page' );
if ( ! function_exists( 'dpi_adding_menu_page' ) ) {
	function dpi_adding_menu_page() {
		add_menu_page(
			__( 'Dragable Settings', 'dragable-panel-item' ),
			__( 'Dragable Settings', 'dragable-panel-item' ),
			'manage_options',
			'dragable-panel-settings',
			'dragable_panel_item_settings_callback'
		);
	}
}

// Admin notice function
if ( ! function_exists( 'dpi_show_admin_notice' ) ) {
	function dpi_show_admin_notice( $message, $type )  {
		echo "
			<div class='dpi_show_admin_notice notice notice-{$type} is-dismissible'>
				<p>{$message}</p>
			</div>
		";
	}
}

// Settings page callback function
if ( ! function_exists( 'dragable_panel_item_settings_callback' ) ) {
	function dragable_panel_item_settings_callback() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Settings array
		$dpi_datas = get_option('dpi_datas');
		?>
		<div class="wrap dpi-admin-wrapper">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<div class="dpi-admin-settings-wrapper">
				<ul id="sortable1" class="connectedSortable">
					<?php
						foreach ( $dpi_datas['sortable1'] as $single_panel ) {
							echo '<li id="'.$single_panel.'" class="ui-state-default">'.$single_panel.'</li>';
						}
					?>
				</ul>
				
				<ul id="sortable2" class="connectedSortable">
					<?php
						foreach ( $dpi_datas['sortable2'] as $single_panel ) {
							echo '<li id="'.$single_panel.'" class="ui-state-default">'.$single_panel.'</li>';
						}
					?>
				</ul>
			</div>
		</div>
		<?php
	}
}