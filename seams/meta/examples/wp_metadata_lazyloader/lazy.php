<?php
// The one WP_Metadata_Lazyloader, which loads term and comment meta for a whole query on first use.
return array( get_class( wp_metadata_lazyloader() ), wp_metadata_lazyloader() === wp_metadata_lazyloader() );
