<?php
// Keeps only the upload types whose extensions the network allows (upload_filetypes); on upload_mimes.
update_site_option( 'upload_filetypes', 'jpg png' );
return check_upload_mimes( array( 'jpg|jpeg|jpe' => 'image/jpeg', 'png' => 'image/png', 'pdf' => 'application/pdf' ) );
