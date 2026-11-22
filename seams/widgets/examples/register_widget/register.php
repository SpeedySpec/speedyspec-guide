<?php
// Registers a WP_Widget subclass (or instance) with the widget factory, keyed by class name; unregister_widget() removes it.
class Guide_Hello_Widget extends WP_Widget {
    public function __construct() { parent::__construct( 'guide_hello', 'Hello', array( 'description' => 'Says hello.' ) ); }
    public function widget( $args, $instance ) { echo $args['before_widget'], 'Hello, ', esc_html( $instance['name'] ?? 'world' ), $args['after_widget']; }
}
register_widget( 'Guide_Hello_Widget' );
$registered = isset( $GLOBALS['wp_widget_factory']->widgets['Guide_Hello_Widget'] );
unregister_widget( 'Guide_Hello_Widget' );
return array( $registered, isset( $GLOBALS['wp_widget_factory']->widgets['Guide_Hello_Widget'] ), count( $GLOBALS['wp_widget_factory']->widgets ) );
