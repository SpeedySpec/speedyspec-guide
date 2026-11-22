<?php
// Adds the Interactivity API directives to submenus and page lists inside the Navigation block.
$tags = new WP_HTML_Tag_Processor( '<li class="wp-block-navigation-submenu has-child"><button class="wp-block-navigation-submenu__toggle">More</button><ul class="wp-block-navigation__submenu-container"></ul></li>' );
return block_core_navigation_add_directives_to_submenu( $tags, array( 'openSubmenusOnClick' => true ) );
