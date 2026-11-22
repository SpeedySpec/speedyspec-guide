<?php
// Runs every tag in content through wp_kses_split2(), leaving text as it is; a stray > becomes &gt;. (A stray < swallows the text up to the next >.)
return wp_kses_split( 'a > b <em>c</em> <u>d</u>', array( 'em' => array() ), wp_allowed_protocols() );
