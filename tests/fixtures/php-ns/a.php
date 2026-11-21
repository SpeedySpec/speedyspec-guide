<?php
namespace PHPMailer\PHPMailer;

class Exception extends \Exception {
	public function errorMessage() {
		return strlen( 'x' );
	}
}

function helper() {
	return new Exception();
}
