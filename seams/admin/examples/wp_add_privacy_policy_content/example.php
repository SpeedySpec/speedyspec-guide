<?php
// Adds a plugin's suggested privacy policy text to the policy guide; works only in the admin, on admin_init or later.
set_current_screen( 'dashboard' );
function guide_privacy_text(): void
{
	wp_add_privacy_policy_content( 'Tea Shop', '<p>We store your tea order.</p>' );
}
add_action( 'admin_init', 'guide_privacy_text' );
do_action( 'admin_init' );
return wp_list_pluck( WP_Privacy_Policy_Content::get_suggested_policy_text(), 'plugin_name' );
