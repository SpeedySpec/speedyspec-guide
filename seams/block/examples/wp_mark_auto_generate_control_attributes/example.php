<?php
// Hooked to register_block_type_args: for blocks with autoRegister support, marks their own attributes so the editor makes inspector controls for them (attributes the supports add come later).
return wp_mark_auto_generate_control_attributes( array( 'supports' => array( 'autoRegister' => true ), 'attributes' => array( 'title' => array( 'type' => 'string' ) ) ) )['attributes'];
