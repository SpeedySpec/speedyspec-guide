<?php
// Enqueues (or prints) an admin stylesheet with its RTL version when needed; filtered by wp_admin_css.
// The WordPress version is shown as <version>, so the result stays the same between releases.
return str_replace( get_bloginfo( 'version' ), '<version>', guide_render( fn() => wp_admin_css( 'css/install', true ) ) );
