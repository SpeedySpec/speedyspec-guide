<?php
// Adds support for every post format; on after_setup_theme.
guide_theme( 'twentytwentyfive' );
return get_theme_support( 'post-formats' )[0];
