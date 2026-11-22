<?php
// On the front end, a search form posting to the home page.
guide_log_in( array( 'read' => true, 'edit_posts' => true, 'switch_themes' => true, 'edit_theme_options' => true, 'activate_plugins' => true ) );
$bar = new WP_Admin_Bar();
wp_admin_bar_search_menu( $bar );
echo preg_replace( '#<svg.*?</svg>#s', '<svg>…</svg>', $bar->get_node( 'search' )->title ), "\n";
return guide_nodes( $bar );
