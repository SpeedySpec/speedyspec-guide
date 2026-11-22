<?php
// Selective refresh: partials re-render one part of the preview (by selector) when their settings change, instead of reloading it; render() gives the part's new markup.
function guide_render_site_title() {
	return get_bloginfo( 'name' );
}
$wp = guide_customizer();
$partial = $wp->selective_refresh->add_partial( 'guide_title', array( 'selector' => '.site-title', 'settings' => array( 'blogname' ), 'render_callback' => 'guide_render_site_title' ) );
return array( get_class( $partial ), $partial->selector, $partial->render(), $partial->json()['settings'] );
