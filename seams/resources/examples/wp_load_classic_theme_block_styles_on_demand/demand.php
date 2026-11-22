<?php
// For classic themes, turns on loading block styles only when used, with output buffering, and hoists the late printed styles into the head; block themes already do.
wp_load_classic_theme_block_styles_on_demand();
return array( has_action( 'wp_template_enhancement_output_buffer_started', 'wp_hoist_late_printed_styles' ), has_filter( 'should_load_separate_core_block_assets', '__return_true' ) );
