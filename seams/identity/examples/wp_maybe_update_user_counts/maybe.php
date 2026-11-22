<?php
// Updates the stored user count unless the site is large (and so counted on a schedule).
$grace = guide_user();
wp_maybe_update_user_counts();
return get_user_count();
