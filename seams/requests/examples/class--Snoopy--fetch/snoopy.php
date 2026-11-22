<?php
// Snoopy, an old HTTP client deprecated in 3.0.0 for the HTTP API: including it reports the deprecation. Its helpers strip links, forms and text from HTML.
add_action( 'deprecated_file_included', fn( $file ) => print( "deprecated_file_included $file\n" ) );
add_filter( 'deprecated_file_trigger_error', '__return_false' );
require ABSPATH . WPINC . '/class-snoopy.php';
$s = new Snoopy();
$html = '<p>Hi <a href="/a">A</a></p><form action="/f"><input name="x"></form>';
return array( $s->agent, Closure::bind( fn() => $this->_striplinks( $html ), $s, Snoopy::class )(), trim( Closure::bind( fn() => $this->_striptext( $html ), $s, Snoopy::class )() ), Closure::bind( fn() => $this->_expandlinks( array( '/a', 'b' ), 'http://example.org/dir/' ), $s, Snoopy::class )() );
