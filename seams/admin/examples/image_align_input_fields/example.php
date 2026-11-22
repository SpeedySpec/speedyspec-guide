<?php
// The radio buttons for an image's alignment (none, left, center, right) in the old media dialog.
return str_contains( image_align_input_fields( get_post( 0 ), 'center' ), "value='center' checked='checked'" );
