<?php
// The comments item shows the count awaiting moderation, from wp_count_comments() (answered by its filter here); it needs edit_posts.
add_filter( 'wp_count_comments', fn() => (object) array( 'moderated' => 3 ) );
guide_log_in( array( 'read' => true, 'edit_posts' => true, 'switch_themes' => true, 'edit_theme_options' => true, 'activate_plugins' => true ) );
$bar = new WP_Admin_Bar();
wp_admin_bar_comments_menu( $bar );
echo wp_strip_all_tags( $bar->get_node( 'comments' )->title ), "\n";
return guide_nodes( $bar );
