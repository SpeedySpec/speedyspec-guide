<?php
// Hooked to after_setup_theme: adds the features block themes get by default (post-thumbnails, responsive-embeds, editor-styles, html5, automatic-feed-links and others).
switch_theme( 'twentytwentyfive' );
_add_default_theme_supports();
return array( current_theme_supports( 'post-thumbnails' ), current_theme_supports( 'responsive-embeds' ), current_theme_supports( 'automatic-feed-links' ) );
