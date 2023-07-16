<?php
// Ajax Handler
add_action('wp_ajax_dpi_datas', 'dpi_ajax_datas_callabck');
add_action('wp_ajax_nopriv_dpi_datas', 'dpi_ajax_datas_callabck');

// Ajax data to db
if ( ! function_exists( 'dpi_ajax_datas_callabck' ) ) {
	function dpi_ajax_datas_callabck() {
		$panel = isset( $_POST['panel'] ) ? sanitize_text_field( $_POST['panel']) : '';
		$order = isset( $_POST['order'] ) ? sanitize_text_field( $_POST['order']) : '';
        $response = [];
		$dpi_array = get_option('dpi_datas');

		// Saving data to db
		$panel_array = explode( ',', $order );
		if ( $panel === 'sortable1' ) {
			$dpi_array['sortable1'] = $panel_array;
			if ( update_option( 'dpi_datas', $dpi_array ) ) {
				$response['status'] = 'success';
				$response['message'] = __('Settings 1 has been updated!', 'dragable-panel-item' );
			}
		} else {
			$dpi_array['sortable2'] = $panel_array;
			if ( update_option( 'dpi_datas', $dpi_array ) ) {
				$response['status'] = 'success';
				$response['message'] = __('Settings 2 has been updated!', 'dragable-panel-item' );
			}
		}
		// Sending response
		echo wp_send_json( $response );
		wp_die();
	}
}

