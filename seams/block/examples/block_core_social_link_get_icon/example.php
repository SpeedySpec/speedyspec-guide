<?php
// The SVG icon of a social service, the share icon for unknown ones.
$icon = block_core_social_link_get_icon( 'wordpress' );
return array( str_starts_with( $icon, '<svg' ), block_core_social_link_get_icon( 'nonesuch' ) === block_core_social_link_get_icon( 'share' ) );
