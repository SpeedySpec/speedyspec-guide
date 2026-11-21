<?php
// sprintf() that lets wp_sprintf handle fragments; WordPress's wp_sprintf_l turns %l into a list.
return array( wp_sprintf( '%s: %l.', 'Tags', array( 'a', 'b', 'c' ) ), wp_sprintf( '%2$s %1$s %%', 'x', 'y' ) );
