<?php
// Prints the file upload form of an importer, with the size limit, or an error when the uploads folder isn't writable.
$html = guide_render( fn() => wp_import_upload_form( 'admin.php?import=wordpress&step=1' ) );
return array( str_contains( $html, 'id="import-upload-form"' ), str_contains( $html, 'name="import"' ) );
