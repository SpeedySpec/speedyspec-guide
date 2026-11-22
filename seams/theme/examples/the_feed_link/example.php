<?php
// Prints a link to a feed with an anchor text; filtered by the_feed_link.
return guide_render( fn() => the_feed_link( 'Subscribe', 'atom' ) );
