<?php
// Translates the strings of a settings structure the schema marks as translatable, with their contexts.
switch_to_locale( 'fr_FR' );
// An object schema names keys (or * for any), an array schema applies its first item to every element, and a string is the context.
$schema = (object) array( 'title' => 'verb', 'items' => array( (object) array( 'name' => 'item name' ) ), '*' => 'any' );
$settings = array( 'title' => 'Post', 'items' => array( array( 'name' => 'Hello' ), array( 'name' => 'Other' ) ), 'id' => 'Hello' );
// The French file has no entries for these contexts; this filter stands in for them.
add_filter( 'gettext_with_context', fn( $t, $text, $context ) => 'verb' !== $context && 'Hello' === $text ? "Bonjour ($context)" : $t, 10, 3 );
return translate_settings_using_i18n_schema( $schema, $settings, 'default' );
