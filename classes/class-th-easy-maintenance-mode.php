<?php

class TH_Easy_Maintenance_Mode {

	function __construct() {
		add_action( 'admin_menu', __CLASS__ . '::register_options_page' );
		add_action( 'admin_init', __CLASS__ . '::register_settings' );
		add_action( 'get_header', __CLASS__ . '::check_for_maintenance_mode' );
	}

	public static function register_options_page() {
		add_options_page(
			__( 'Easy Maintenance Mode', TH_EMM_DOMAIN ),
			__( 'Easy Maintenance Mode', TH_EMM_DOMAIN ),
			'manage_options',
			TH_EMM_DOMAIN,
			__CLASS__ . '::settings_page_content'
		);
	}

	public static function settings_page_content() {
		?>
        <div class="wrap">
            <h1><?php _e( 'Easy Maintenance Mode', TH_EMM_DOMAIN ) ?></h1>
            <p><?php _e( 'This plugin hides your site temporarily for users that are not logged in and users without the "edit_themes" capability.  You will still be able to access the admin interface to make changes.',
					TH_EMM_DOMAIN ) ?></p>
            <form method="post" action="options.php">
				<?php settings_fields( 'th_emm_options' ); ?>
                <table style="width: 500px; max-width: 100%; text-align: left;">
                    <tr valign="top">
                        <th scope="row">
                            <label for="th_emm_active"><?php _e( 'Enabled', TH_EMM_DOMAIN ) ?></label>
                        </th>
                        <td>
                            <input type="checkbox" id="th_emm_active" name="th_emm_active" value="1" <?php checked( 1,
								get_option( 'th_emm_active' ),
								true ); ?> />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="th_emm_title"><?php _e( 'Title', TH_EMM_DOMAIN ) ?></label>
                        </th>
                        <td>
                            <input style="width: 100%;" type="text" id="th_emm_title" name="th_emm_title"
                                   value="<?php echo get_option( 'th_emm_title' ); ?>"/>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="th_emm_description"><?php _e( 'Description', TH_EMM_DOMAIN ) ?></label>
                        </th>
                        <td>
                            <textarea style="width: 100%;" rows="7" id="th_emm_description"
                                      name="th_emm_description"><?php echo get_option( 'th_emm_description' ); ?></textarea>
                        </td>
                    </tr>
                </table>
				<?php submit_button(); ?>
            </form>
        </div>
		<?php
	}

	public static function register_settings() {
		register_setting( 'th_emm_options',
			'th_emm_active',
			array(
				'type'              => 'boolean',
				'sanitize_callback' => function ( $input ) {
					return ( ( isset( $input ) && true == $input ) ? true : false );
				},
				'default'           => false,
			) );
		register_setting( 'th_emm_options',
			'th_emm_title',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => TH_EMM_MAINTENANCE_TITLE,
			) );
		register_setting( 'th_emm_options',
			'th_emm_description',
			array(
				'type'              => 'boolean',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => TH_EMM_MAINTENANCE_DESCRIPTION,
			) );
	}

	public static function check_for_maintenance_mode() {
		if ( get_option( 'th_emm_active' ) ) {
			if ( ! current_user_can( 'edit_themes' ) || ! is_user_logged_in() ) {
				wp_die( sprintf(
					'<h1>%s</h1><br/>%s',
					esc_html( get_option( 'th_emm_title' ) ?: TH_EMM_MAINTENANCE_TITLE ),
					esc_html( get_option( 'th_emm_description' ) ?: TH_EMM_MAINTENANCE_DESCRIPTION )
				) );
			}
		}
	}

}

new TH_Easy_Maintenance_Mode();
