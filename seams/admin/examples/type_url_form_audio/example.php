<?php
// Deprecated in 3.3.0. Gave the old insert-audio-from-URL form, now from wp_media_insert_url_form().
list( $result, $notice ) = guide_deprecated( 'type_url_form_audio' );
return str_contains( $result, 'name="src"' );
