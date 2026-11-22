<?php
// A submit button with its classes (primary, secondary, delete, small, large), name and attributes, wrapped in a paragraph unless told not to.
return array( get_submit_button( 'Save tea' ), get_submit_button( 'Delete', 'delete small', 'remove', false ) );
