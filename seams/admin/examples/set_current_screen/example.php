<?php
// Sets the current admin screen from a hook name, or from the request, so get_current_screen() can give it.
set_current_screen( 'upload' );
return get_current_screen()->id;
