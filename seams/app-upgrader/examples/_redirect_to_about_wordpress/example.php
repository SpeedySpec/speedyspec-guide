<?php
// After an update from before 3.4, sends the user to the About page in the new version; does nothing on newer versions.
return _redirect_to_about_wordpress( '7.2' );
