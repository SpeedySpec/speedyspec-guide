<?php
// A .po file's headers: from the first 8 KB, the PO-Revision-Date, Project-Id-Version and X-Generator; wp_get_l10n_php_file_data() reads the same from a .l10n.php file.
$po = WP_LANG_DIR . '/guide.po';
file_put_contents( $po, "msgid \"\"\nmsgstr \"\"\n\"PO-Revision-Date: 2026-01-02 03:04+0000\\n\"\n\"Project-Id-Version: Guide\\n\"\n" );
$php = WP_LANG_DIR . '/guide.l10n.php';
file_put_contents( $php, '<?php return ' . var_export( array( 'po-revision-date' => '2026-02-03', 'x-generator' => 'Guide', 'messages' => array() ), true ) . ';' );
$out = array( wp_get_pomo_file_data( $po ), wp_get_l10n_php_file_data( $php ) );
unlink( $po );
unlink( $php );
return $out;
