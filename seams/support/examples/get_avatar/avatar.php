<?php
// The img tag for a user's or email's avatar, from Gravatar unless pre_get_avatar answers; false when avatars are off.
$img = get_avatar( 'ada@example.org', 48 );
update_option( 'show_avatars', 0 );
return array( $img, get_avatar( 'ada@example.org' ) );
