<?php
// The img tag the classic editor inserts for an attachment, with its alignment and size classes; filtered by get_image_tag_class and get_image_tag.
$id = guide_attachment();
return get_image_tag( $id, 'A lake', 'Lake', 'center', 'medium' );
