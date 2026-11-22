<?php
// Removes the paragraph wpautop() put around a shortcode on its own line.
add_shortcode( 'gallery', fn() => '' );
return shortcode_unautop( '<p>[gallery]</p>' );
