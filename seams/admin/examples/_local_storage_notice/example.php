<?php
// Prints the notice the editor shows when a backup of the post in the browser differs from the saved one.
return str_contains( guide_render( '_local_storage_notice' ), 'local-storage-notice' );
