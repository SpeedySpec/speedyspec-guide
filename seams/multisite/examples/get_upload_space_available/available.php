<?php
// The bytes of uploads a site has left, with the quota checked; everything when upload_space_check_disabled is on.
update_option( 'blog_upload_space', 5 );
add_filter( 'pre_get_space_used', fn() => 2 );
return get_upload_space_available();
