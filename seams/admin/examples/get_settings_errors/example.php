<?php
// The messages recorded for a setting, or for all, including those kept across the redirect after saving; sanitizes the setting first when asked.
add_settings_error( 'tea_blend', 'saved', 'Saved.', 'success' );
add_settings_error( 'general', 'other', 'Another.' );
return array( count( get_settings_errors() ), wp_list_pluck( get_settings_errors( 'tea_blend' ), 'type' ) );
