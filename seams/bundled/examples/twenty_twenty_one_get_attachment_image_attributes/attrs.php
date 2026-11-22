<?php
// Gives front-end images an inline style that keeps their aspect ratio (width 100%, height as a percentage, max-width), from the size or the attachment's metadata; custom logos and the admin are left alone. On wp_get_attachment_image_attributes.
guide_theme( 'twentytwentyone' );
return array( twenty_twenty_one_get_attachment_image_attributes( array( 'class' => 'x' ), null, array( 800, 600 ) ), twenty_twenty_one_get_attachment_image_attributes( array( 'class' => 'custom-logo' ), null, array( 800, 600 ) ) );
