<?php
// The markup of an admin notice: its type (success, error, warning, info), dismissible, extra classes and attributes, and the message in a paragraph unless told not to.
return wp_get_admin_notice( 'Saved.', array( 'type' => 'success', 'dismissible' => true, 'id' => 'saved' ) );
