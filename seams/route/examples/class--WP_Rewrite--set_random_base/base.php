<?php
// The random base: the wp_random_base option, or 'random' (translated) when it's empty; post permalinks share it when the structure is just /%postname%/.
$r = guide_permalinks( '/%postname%/' );
$default = $r->get_random_base();
$shares = $r->post_permalinks_share_random_base();
$r = guide_permalinks( '/blog/%postname%/' );
return array( $default, $shares, $r->post_permalinks_share_random_base() );
