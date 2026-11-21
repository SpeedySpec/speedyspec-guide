<?php
// A link with a protocol that isn't allowed loses it.
return wp_kses( '<a href="javascript:alert(1)">x</a><a href="https://example.org">y</a>', array( 'a' => array( 'href' => true ) ) );
