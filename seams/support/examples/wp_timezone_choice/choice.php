<?php
// The <option> list of timezones grouped by continent, with UTC and the manual offsets, the given one selected.
$html = wp_timezone_choice( 'Europe/Paris' );
return array( (bool) preg_match( '/<optgroup label="Europe"/', $html ), (bool) preg_match( '/<option selected="selected" value="Europe\/Paris"/', $html ), str_contains( $html, 'value="UTC+5.5"' ) );
