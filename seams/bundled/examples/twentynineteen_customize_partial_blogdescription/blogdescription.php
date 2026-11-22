<?php
// Prints the tagline, for selective refresh.
guide_theme( 'twentynineteen' );
update_option( 'blogdescription', 'Just a guide' );
return guide_render( 'twentynineteen_customize_partial_blogdescription' );
