<?php
// Prints the XML namespace attributes of a feed type's root element, and fires the feed's namespace action.
return guide_render( fn() => wp_feed_namespaces( 'atom' ) );
