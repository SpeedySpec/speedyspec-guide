<?php
// Prints the Site Upload Space Quota field of a network site's settings.
return str_contains( guide_render( fn() => upload_space_setting( get_current_blog_id() ) ), 'blog_upload_space' );
