<?php
// For a block theme, registers the sidebars the previous classic theme left in the wp_classic_sidebars theme mod; classic themes are left alone.
set_theme_mod( 'wp_classic_sidebars', array( array( 'id' => 'old-side', 'name' => 'Old side' ) ) );
_wp_block_theme_register_classic_sidebars();
return array( wp_is_block_theme(), is_registered_sidebar( 'old-side' ) );
