<?php
// Hooked to attachment_fields_to_edit on the single media screen: removes the URL and alignment fields that only apply when inserting.
return array_keys( media_single_attachment_fields_to_edit( array( 'url' => 1, 'align' => 2, 'image-size' => 3, 'post_title' => 4 ), get_post( 0 ) ) );
