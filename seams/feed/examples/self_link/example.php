<?php
// Prints the URL of the feed being served; filtered by self_link.
guide_go( '/?feed=atom' );
return guide_render( 'self_link' );
