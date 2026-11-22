<?php
// Prints the tagline, for selective refresh.
guide_theme( 'twentytwenty' );
update_option( 'blogdescription', 'Just a guide' );
return guide_render( 'twentytwenty_customize_partial_blogdescription' );
