<?php
// IDs from a list, a comma-separated string or one number; anything not a whole number of at least 1 is dropped, and repeats.
guide_core_abilities();
$content = new WP_Abilities_Content();
return array( guide_private( $content, 'normalize_ids', array( 'ids' => '3, 3, x, 0, 2.0' ) ), guide_private( $content, 'normalize_ids', array( 'ids' => 7 ) ), guide_private( $content, 'normalize_ids', array( 'ids' => array( -1, 1.5, '5' ) ) ) );
