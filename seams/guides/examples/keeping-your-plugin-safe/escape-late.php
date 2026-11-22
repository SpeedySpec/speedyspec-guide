<?php
// Escape when printing, even values you sanitized when saving: the database is not a trusted source.
function my_plugin_profile_link( $name, $url ) {
	return '<a href="' . esc_url( $url ) . '">' . esc_html( $name ) . '</a>';
}
update_option( 'my_plugin_profile', array( 'name' => sanitize_text_field( 'Ana <3 & co' ), 'url' => 'javascript:alert(1)' ) );
$profile = get_option( 'my_plugin_profile' );
return my_plugin_profile_link( $profile['name'], $profile['url'] );
