<?php
// Queues a stylesheet for printing, registering it first when a source is given.
wp_enqueue_style( 'guide-new', 'https://cdn.example/new.css', array(), '1.0', 'print' );
return array( wp_style_is( 'guide-new' ), wp_styles()->registered['guide-new']->args );
