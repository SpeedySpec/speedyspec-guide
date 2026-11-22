<?php
// A script tag with the attributes given (true ones as bare names), filtered by wp_script_attributes.
return wp_get_script_tag( array( 'src' => 'https://cdn.example/a.js', 'async' => true, 'id' => 'a-js' ) );
