<?php
// The folder of an attached file relative to the uploads folder, such as 2026/11, or empty.
return array( _wp_get_attachment_relative_path( '2026/11/photo.jpg' ), _wp_get_attachment_relative_path( wp_upload_dir()['basedir'] . '/2026/11/photo.jpg' ), _wp_get_attachment_relative_path( 'photo.jpg' ) );
