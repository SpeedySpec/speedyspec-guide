<?php
namespace WpOrg\Requests;

class Exception extends \Exception {
	public function getType() {
		return \PHPMailer\PHPMailer\helper();
	}
}
