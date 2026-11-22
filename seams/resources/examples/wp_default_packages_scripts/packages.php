<?php
// Registers the @wordpress packages' scripts (wp-blocks, wp-element, wp-i18n and the rest) from their asset files, with their dependencies, versions and translations.
$s = wp_scripts();
return array( $s->registered['wp-blocks']->deps, $s->registered['wp-i18n']->textdomain );
