<?php
// Selective refresh: partials re-render one part of the preview (by selector) when their settings change, instead of reloading it; render() gives the part's new markup.
$wp = guide_customizer();
$partial = $wp->selective_refresh->add_partial( 'guide_title', array( 'selector' => '.site-title', 'settings' => array( 'blogname' ), 'render_callback' => fn() => get_bloginfo( 'name' ) ) );
return array( get_class( $partial ), $partial->selector, $partial->render(), $partial->json()['settings'] );
