<?php
// Prints a registered widget class outside any sidebar, with an instance and wrapper arguments; widget_display_callback can change the instance or skip it with false. An unregistered class is a mistake reported with _doing_it_wrong.
class Guide_Hello_Widget extends WP_Widget {
    public function __construct() { parent::__construct( 'guide_hello', 'Hello', array( 'description' => 'Says hello.' ) ); }
    public function widget( $args, $instance ) { echo $args['before_widget'], 'Hello, ', esc_html( $instance['name'] ?? 'world' ), $args['after_widget']; }
}
register_widget( 'Guide_Hello_Widget' );
add_action( 'the_widget', fn( $widget ) => print( "the_widget $widget\n" ) );
the_widget( 'Guide_Hello_Widget', array( 'name' => 'Ada' ) );
echo "\n";
the_widget( 'Guide_Hello_Widget', 'name=Grace', array( 'before_widget' => '<aside class="%s">', 'after_widget' => '</aside>' ) );
return null;
