<?php
// Whether a name clashes with a file in a folder's listing, counting the size suffixes (-150x150) an image's copies get.
return array( _wp_check_existing_file_names( 'photo.jpg', array( 'photo-150x150.jpg' ) ), _wp_check_existing_file_names( 'photo.jpg', array( 'other.jpg' ) ) );
