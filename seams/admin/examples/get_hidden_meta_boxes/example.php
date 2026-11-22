<?php
// The boxes the user hid on a screen, or those hidden by default, such as Custom Fields and Slug; filtered by hidden_meta_boxes.
return get_hidden_meta_boxes( convert_to_screen( 'post' ) );
