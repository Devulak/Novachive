<?
	// Get to work
	$dir = $_GET['dir'];
	if(file_exists($dir))
		highlight_file($dir);
	else
		echo 'Wat, there\'s no file here!';
?>