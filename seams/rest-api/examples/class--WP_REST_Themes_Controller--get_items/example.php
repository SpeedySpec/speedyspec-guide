<?php
// The themes controller lists installed themes at /wp/v2/themes, filtered by status; users who can't switch themes may see only the active theme, with its theme supports.
$active = guide_rest( 'GET', '/wp/v2/themes', array( 'status' => 'active' ) );
return array( $active[0], count( $active[1] ), guide_rest( 'GET', '/wp/v2/themes', array( 'status' => 'nope' ) )[0] );
