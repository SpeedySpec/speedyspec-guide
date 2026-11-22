<?php
// Installs a core language pack by locale and gives the locale, or false; gives the locale at once when it is already installed.
$installed = WP_LANG_DIR . '/fr_FR.mo';
wp_mkdir_p( WP_LANG_DIR );
file_put_contents( $installed, '' );
$result = array( wp_download_language_pack( 'fr_FR' ), wp_download_language_pack( 'xx_XX' ) );
unlink( $installed );
return $result;
