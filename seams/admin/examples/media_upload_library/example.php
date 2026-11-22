<?php
// Handles the old media dialog's Media Library tab, saving the form and printing the library in an iframe.
$html = guide_render( 'media_upload_library' );
return array( str_contains( $html, 'library-form' ), str_contains( $html, '</html>' ) );
