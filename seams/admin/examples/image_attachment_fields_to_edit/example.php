<?php
// Hooked to attachment_fields_to_edit: was used to add image fields; now gives the fields unchanged.
return image_attachment_fields_to_edit( array( 'post_title' => array() ), get_post( 0 ) );
