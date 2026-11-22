<?php
// The PO headers of a .l10n.php file: POT-Creation-Date, PO-Revision-Date, Project-Id-Version and X-Generator.
$php = WP_LANG_DIR . '/guide-data.l10n.php';
file_put_contents( $php, '<?php return ' . var_export( array( 'project-id-version' => 'Guide 1.0', 'messages' => array() ), true ) . ';' );
$data = wp_get_l10n_php_file_data( $php );
unlink( $php );
return $data;
