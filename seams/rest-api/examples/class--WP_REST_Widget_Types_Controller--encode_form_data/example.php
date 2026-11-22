<?php
// The widget types controller lists the registered widgets at /wp/v2/widget-types; encode turns a legacy widget's form input into its instance with a preview and form, and render renders an instance.
$types = array_column( guide_rest( 'GET', '/wp/v2/widget-types' )[1], 'id' );
$encoded = guide_rest( 'POST', '/wp/v2/widget-types/search/encode', array( 'form_data' => 'widget-search[1][title]=Find' ) )[1];
return array( in_array( 'search', $types, true ), $encoded['instance']['raw'], str_contains( $encoded['preview'], 'Find' ) );
