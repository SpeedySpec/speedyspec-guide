<?php
// Removes a registered term meta key; false when it isn't registered.
register_term_meta( '', 'color', array() );
return array( unregister_term_meta( '', 'color' ), unregister_term_meta( '', 'color' ) );
