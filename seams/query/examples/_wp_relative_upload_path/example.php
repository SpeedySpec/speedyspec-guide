<?php
// A path made relative to the uploads folder when it is inside it; filtered by _wp_relative_upload_path.
return array( _wp_relative_upload_path( wp_upload_dir()['basedir'] . '/2026/01/a.jpg' ), _wp_relative_upload_path( '/tmp/a.jpg' ) );
