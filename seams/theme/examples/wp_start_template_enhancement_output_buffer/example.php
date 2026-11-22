<?php
// Hooked to wp_before_include_template: starts the output buffer the page's HTML is filtered through, when it should; true when started.
return wp_start_template_enhancement_output_buffer();
