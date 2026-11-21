<?php
// Its FP starts as an empty string, so isset() takes it for a connection: a command before connect() reaches fwrite() and throws a TypeError.
$pop = new POP3();
$pop->user( 'me' );
