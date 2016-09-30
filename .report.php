<?
	// Turn on error logging (why is this not on in the php.ini???)
	ini_set('display_errors', 1);
	error_reporting(E_ALL & ~E_NOTICE); // Maybe E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT ???



	// Include this line first from anything else:
	// include $_SERVER['DOCUMENT_ROOT'] . '/.report.php';
?>