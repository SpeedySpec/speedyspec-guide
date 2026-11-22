<?php
// Parses an attribute string into name, value, whole and vless.
$attrs = wp_kses_hair( 'class="a" disabled href=https://x', wp_allowed_protocols() );
return array( $attrs['class']['value'], $attrs['disabled']['vless'], $attrs['href']['value'] );
