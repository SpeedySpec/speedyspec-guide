<?php
// The callback wp_rel_nofollow() uses for one link; it rebuilds the tag from its attributes.
return wp_rel_nofollow_callback( array( '<a href="https://example.com">', ' href="https://example.com"' ) );
