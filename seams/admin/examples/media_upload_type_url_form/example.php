<?php
// Prints the old media dialog's From URL tab.
return str_contains( guide_render( fn() => media_upload_type_url_form( 'image' ) ), 'name="src"' );
