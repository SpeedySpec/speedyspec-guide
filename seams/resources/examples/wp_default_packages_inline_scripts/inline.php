<?php
// Adds the packages' setup code inline: API nonces and roots, the date settings, the locale, editor defaults and more.
$s = wp_scripts();
return array( str_contains( implode( '', (array) $s->get_data( 'wp-api-fetch', 'after' ) ), 'createRootURLMiddleware' ), str_contains( implode( '', (array) $s->get_data( 'wp-date', 'after' ) ), 'wp.date.setSettings' ) );
