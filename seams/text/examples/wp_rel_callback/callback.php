<?php
// Adds a rel value to one link tag, merging with any it has.
return wp_rel_callback( array( '<a href="https://x" rel="me">', ' href="https://x" rel="me"' ), 'nofollow' );
