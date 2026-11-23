<?php
// Prints the link edit screen's Advanced box: image, RSS address, notes and rating.
return str_contains( guide_render( fn() => link_advanced_meta_box( (object) array( 'link_image' => '', 'link_rss' => '', 'link_notes' => '', 'link_rating' => 0 ) ) ), 'link_rss' );
