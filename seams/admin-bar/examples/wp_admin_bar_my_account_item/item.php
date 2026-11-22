<?php
// The account item in top-secondary, linking to the profile, titled with the display name; without avatars it gets the people icon.
guide_log_in( array( 'read' => true, 'edit_posts' => true, 'switch_themes' => true, 'edit_theme_options' => true, 'activate_plugins' => true ) );
$bar = new WP_Admin_Bar();
wp_admin_bar_my_account_item( $bar );
$node = $bar->get_node( 'my-account' );
echo $node->title, ' | ', $node->icon, ' | ', $node->meta['menu_title'], "\n";
return guide_nodes( $bar );
