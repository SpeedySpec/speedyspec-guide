<?php
// The old media dialog's insert-from-URL form: the URL, title, alternative text, caption, alignment and link fields.
$html = wp_media_insert_url_form( 'image' );
return array( str_contains( $html, 'name="src"' ), str_contains( $html, 'name="alt"' ) );
