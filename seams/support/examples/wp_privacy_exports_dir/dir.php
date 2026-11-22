<?php
// The folder personal data exports are written to: wp-personal-data-exports in the uploads folder; wp_privacy_exports_dir filters it.
return str_replace( wp_upload_dir()['basedir'], 'UPLOADS', wp_privacy_exports_dir() );
