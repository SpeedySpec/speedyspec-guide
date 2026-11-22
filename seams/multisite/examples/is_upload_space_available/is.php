<?php
// Whether a site has upload space left (always, with the quota check off).
update_option( 'blog_upload_space', 5 );
add_filter( 'pre_get_space_used', fn() => 6 );
return is_upload_space_available();
