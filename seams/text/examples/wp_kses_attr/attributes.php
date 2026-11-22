<?php
// Builds an element's tag from its attributes, keeping the allowed ones.
return wp_kses_attr( 'a', ' href="https://example.org" target="_blank" onclick="x"', array( 'a' => array( 'href' => true, 'target' => true ) ), wp_allowed_protocols() );
