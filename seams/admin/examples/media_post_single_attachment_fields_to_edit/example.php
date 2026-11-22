<?php
// Hooked to attachment_fields_to_edit on the attachment edit screen: removes the fields edited elsewhere there.
return array_keys( media_post_single_attachment_fields_to_edit( array( 'image_url' => 1, 'post_title' => 2 ), get_post( 0 ) ) );
