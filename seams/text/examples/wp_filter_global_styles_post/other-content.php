<?php
// Content that isn't a user's global styles JSON passes through unchanged.
return wp_filter_global_styles_post( '<p>A post</p>' );
