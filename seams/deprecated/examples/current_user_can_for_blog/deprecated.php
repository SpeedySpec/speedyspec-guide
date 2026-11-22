<?php
// Deprecated in 6.7.0; use current_user_can_for_site(). Returns whether the current user has the specified capability for a given site. It reports no deprecation notice of its own.
$f = guide_fixtures();
return guide_deprecated( 'current_user_can_for_blog', 1, 'read' );
