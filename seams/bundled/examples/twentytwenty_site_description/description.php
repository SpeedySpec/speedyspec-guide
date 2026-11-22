<?php
// Prints (or gives) the tagline in a site-description div; null without a tagline. twentytwenty_site_description filters it.
guide_theme( 'twentytwenty' );
update_option( 'blogdescription', 'Just a guide' );
return twentytwenty_site_description( false );
