<?php
// A script tag holding JavaScript, with attributes; wp_inline_script_attributes filters them.
return wp_get_inline_script_tag( 'console.log( 1 );', array( 'id' => 'x' ) );
