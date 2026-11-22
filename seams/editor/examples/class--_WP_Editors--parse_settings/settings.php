<?php
// An editor's settings over the defaults; wp_editor_settings filters them first. A height is kept between 50 and 5000.
$set = _WP_Editors::parse_settings( 'notes', array( 'textarea_rows' => 5, 'editor_height' => 20 ) );
return array( $set['textarea_name'], $set['textarea_rows'], $set['editor_height'], $set['media_buttons'], $set['quicktags'], $set['tinymce'] );
