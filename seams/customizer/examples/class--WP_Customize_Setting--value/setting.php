<?php
// A Customizer setting: where its value lives (a theme_mod or option), its default, sanitize and validate callbacks, transport (refresh or postMessage) and capability; preview() makes its posted value show without saving, save() stores it.
$wp = guide_customizer();
$setting = new WP_Customize_Setting( $wp, 'guide_opt', array( 'type' => 'option', 'default' => 'plain' ) );
$before = $setting->value();
$wp->set_post_value( 'guide_opt', 'previewed' );
$setting->preview();
$during = get_option( 'guide_opt' );
$setting->save();
return array( $before, $during, get_option( 'guide_opt' ), $setting->transport, $setting->check_capabilities() );
