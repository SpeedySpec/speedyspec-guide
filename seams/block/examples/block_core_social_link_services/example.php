<?php
// The social services with their names and icons, or one service's field.
$all = block_core_social_link_services();
return array( isset( $all['wordpress'] ), block_core_social_link_services( 'bluesky', 'name' ) );
