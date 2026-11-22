<?php
// Prints a site detail, as bloginfo() names it, escaped for a feed.
update_option( 'blogname', 'Tea & Biscuits' );
return guide_render( fn() => bloginfo_rss( 'name' ) );
