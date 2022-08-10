<?php

// Admin submenu page
add_action( 'admin_menu', 'tms_adding_submenu_page' );
if ( ! function_exists( 'tms_adding_submenu_page' ) ) {
	function tms_adding_submenu_page() {
		add_submenu_page(
			'edit.php?post_type=team_members',
			__( 'Settings page', 'team-members-showcase' ),
			__( 'Settings page', 'team-members-showcase' ),
			'manage_options',
			'team-members-showcase-settings',
			'tms_team_members_showcase_settings_callback'
		);
	}
}

// Admin notice function
if ( ! function_exists( 'tms_show_admin_notice' ) ) {
	function tms_show_admin_notice( $message, $type )  {
		echo "
			<div class='tms_show_admin_notice notice notice-{$type} is-dismissible'>
				<p>{$message}</p>
			</div>
		";
	}
}

// Settings page callback function
if ( ! function_exists( 'tms_team_members_showcase_settings_callback' ) ) {
	function tms_team_members_showcase_settings_callback() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Settings array
		$tms_settings_array = get_option('tms_setting_datas');
		$tms_post_type_name = $tms_settings_array['tms_post_type_name'];
		$tms_post_type_slug = $tms_settings_array['tms_post_type_slug'];

		if ( isset( $_POST['settingsSubmitBtn'] ) ) {
			$tms_settings_array['tms_post_type_name'] = isset($_POST['tms_post_type_name']) ? sanitize_text_field($_POST['tms_post_type_name']) : '';
			$tms_settings_array['tms_post_type_slug'] = isset($_POST['tms_post_type_slug']) ? sanitize_text_field($_POST['tms_post_type_slug']) : '';

			if (update_option( 'tms_setting_datas', $tms_settings_array )) {
				tms_show_admin_notice('Settings has been updated!', 'success');
			}

		}
		?>
		<div class="wrap tms-admin-wrapper">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<div class="tms-admin-settings-wrapper">
				<div class="tms-admin-settings">
					<form method="post" class="tms-admin-settings-form">
					<h2 class="title"><?php _e('Customize your settings', 'team-members-showcase')?></h2>
					<p><?php _e('Use the shortcode <kbd>[wc-product-table]</kbd> for displaying the Amazing Product Table with all of your products together. User can order products here easily without visiting individual product.', 'team-members-showcase')?></p>
					<table class="form-table table-design-form">
						<tbody>
							<tr>
								<th scope="row">
									<?php _e('Post Type Name', 'team-members-showcase')?>
								</th>
								<td>
									<fieldset>
										<label>
											<input name="tms_post_type_name" type="text" value="<?php _e( $tms_post_type_name )?>" id="tms_post_type_name" class="tms_post_type_name" />
										</label>
									</fieldset>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<?php _e('Post Type Slug', 'team-members-showcase')?>
								</th>
								<td>
									<fieldset>
										<label>
											<input name="tms_post_type_slug" type="text" value="<?php _e( $tms_post_type_slug )?>" id="tms_post_type_slug" class="tms_post_type_slug" />
										</label>
									</fieldset>
								</td>
							</tr>
						</tbody>
					</table>

					<p class="submit"><input type="submit" name="settingsSubmitBtn" id="submit" class="button button-primary" value="<?php _e('Save Changes', 'team-members-showcase')?>"></p>
					</form>
				</div>
			</div>
		</div>
		<?php
	}
}