<?php
// Enqueues (or prints) an admin stylesheet with its RTL version when needed; filtered by wp_admin_css.
return guide_render( fn() => wp_admin_css( 'css/install', true ) );
