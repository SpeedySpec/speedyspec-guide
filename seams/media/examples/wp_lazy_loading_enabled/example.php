<?php
// Whether WordPress adds loading="lazy" to a tag in a context: img and iframe by default; filtered by wp_lazy_loading_enabled.
return array( wp_lazy_loading_enabled( 'img', 'the_content' ), wp_lazy_loading_enabled( 'iframe', 'the_content' ), wp_lazy_loading_enabled( 'video', 'the_content' ) );
