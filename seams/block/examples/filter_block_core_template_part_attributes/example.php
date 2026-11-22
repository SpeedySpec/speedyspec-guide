<?php
// Hooked to safecss and kses for template part blocks: keeps a tagName attribute only when kses allows that element.
return array( filter_block_core_template_part_attributes( 'header', 'tagName', 'post' ), filter_block_core_template_part_attributes( 'script', 'tagName', 'post' ), filter_block_core_template_part_attributes( 'x', 'slug', 'post' ) );
