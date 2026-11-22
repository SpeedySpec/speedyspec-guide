<?php
// The MIME types a user may upload: all known ones except swf and exe, and without htm|html and js unless the user has unfiltered_html; upload_mimes filters them.
$admin = get_allowed_mime_types( 1 );
$grace = guide_user( 'grace', 'author' );
$author = get_allowed_mime_types( $grace );
return array( isset( $admin['htm|html'] ), isset( $author['htm|html'] ), isset( $admin['exe'] ), isset( $admin['swf'] ) );
