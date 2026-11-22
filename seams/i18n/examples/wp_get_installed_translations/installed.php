<?php
// The installed translations of a type (core, plugins or themes), by text domain and locale, with their PO headers.
// A .mo file counts only with its .po beside it, whose headers are read.
file_put_contents( WP_LANG_DIR . '/plugins/guide-fr_FR.po', "msgid \"\"\nmsgstr \"\"\n\"Language: fr_FR\\n\"\n\"PO-Revision-Date: 2026-01-02\\n\"\n" );
$plugins = wp_get_installed_translations( 'plugins' );
unlink( WP_LANG_DIR . '/plugins/guide-fr_FR.po' );
return array( array_keys( $plugins ), array_keys( $plugins['guide'] ?? array() ), $plugins['guide']['fr_FR']['PO-Revision-Date'] ?? null, wp_get_installed_translations( 'nope' ) );
