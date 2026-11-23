<?php
// Prints the tabs of a network site's edit screens: Info, Users, Themes and Settings; filtered by network_edit_site_nav_links.
$html = guide_render( fn() => network_edit_site_nav( array( 'blog_id' => get_current_blog_id(), 'selected' => 'site-info' ) ) );
return array( str_contains( $html, 'nav-tab-active' ), substr_count( $html, 'nav-tab' ) > 3 );
