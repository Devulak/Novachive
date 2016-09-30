<?
	include_once '.settings.php';
	$dir = $_GET['dir'];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
		<title>Index of /<? echo $dir; ?></title>
		<link href="/.resources/css/init.css" rel="stylesheet" type="text/css">
		<link href="/.resources/css/index.css" rel="stylesheet" type="text/css">
		<link href="/.themes/<? echo $theme; ?>.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<header>
			<div class="container">
				<?
					if($_GET['showcase'])
						echo '
							<a class="showcase toggle" href="/' . $dir . '">Code</a>
						';
					else
						echo '
							<a class="showcase" href="/s/' . $dir . '">Standard</a>
						';
					if($dir)
						echo '<a href="/' . $_GET['showcase'] . '">Home</a>';
					else
						echo '<span>Home</span>';
					$dirExplode = explode('/', $dir);
					array_pop($dirExplode);
					$last = array_pop($dirExplode);
					foreach($dirExplode as $value)
					{
						$pathExtra .= $value.'/';
						echo '
							<a href="/'.$_GET['showcase'].$pathExtra.'">
								'.$value.'
							</a>
						';
					}
					echo '
						<span>
							'.$last.'
						</span>
					';
				?>
			</div>
		</header>
		<div class="container">
			<div class="item header">
				<div class="name">File</div>
				<div class="size">Size</div>
				<div class="last">Last Modified</div>
			</div>
			<?
				$dir = '.';
				if($_GET['dir'])
					$dir = $_GET['dir'];
				$directories = array();
				$files_list  = array();
				$files = scandir($dir);
				foreach($files as $file)
					if((strpos($file, '.') === false || strpos($file, '.') > 0 || $_GET['showcase']) && !($file == '.' || $file == '..'))
						if(is_dir($dir.'/'.$file))
							$directories[]  = $file;
						else
							$files_list[] = $file;
				if($dir == '.')
					$dir = false;
				foreach($directories as $directory)
					echo '
						<a class="item" href="/'.$_GET['showcase'].$dir.$directory.'/">
							<div class="icon">'.file_get_contents('.resources/images/icons/folder.svg').'</div>
							<div class="name">'.$directory.'</div>
							<div class="size">-</div>
							<div class="last">'.date("Y-m-d H:i:s", filemtime($dir.$directory)).'</div>
						</a>
					';
				foreach($files_list as $file)
				{
					/* Define Size */
					$size = filesize($dir.$file);
					if($size >= 1024*1000)
						$size = number_format($size/1024/1024,2)." MB";
					elseif($size >= 1024)
						$size = number_format($size/1024,2)." KB";
					else
						$size = number_format($size,2).' B';

					/* Define icon */
					$fileInfo = pathinfo($dir.$file);
					if($fileInfo['extension'] == 'txt')
						$icon = file_get_contents('.resources/images/icons/notepad.svg');
					elseif($fileInfo['extension'] == 'zip' || $fileInfo['extension'] == 'rar')
						$icon = file_get_contents('.resources/images/icons/bigone.svg');
					elseif($fileInfo['extension'] == 'css' || $fileInfo['extension'] == 'html' || $fileInfo['extension'] == 'php')
						$icon = file_get_contents('.resources/images/icons/browser.svg');
					else
						$icon = file_get_contents('.resources/images/icons/document.svg');

					/* Execute readable - Welp, files sure needs a bit of definitions don't they?! */
					echo '
						<a class="item phph" href="/'.$_GET['showcase'].$dir.$file.'">
							<div class="icon">'.$icon.'</div>
							<div class="name">'.$file.'</div>
							<div class="size">'.$size.'</div>
							<div class="last">'.date("Y-m-d H:i:s", filemtime($dir.$file)).'</div>
						</a>
					';
				}
			?>
		</div>
		<footer>
			<div class="container">
				<?
					$version = file_get_contents('.index.txt');
					$update = file_get_contents('https://raw.githubusercontent.com/Devulak/Novachive/master/.index.txt');
				?>
				Everything is designed and programmed with <span class="love">&lt;3</span> by ZeroXitreo - <a href="https://www.catbug.com/">TO THE WEBSITE!</a> - <? echo $version ?>
				<?
					if($version != $update)
						echo '<div id="update"><a href="http://kevm06.wi4.sde.dk/.index.rar">A NEW VERSION AVAILABLE!</a></div>';
				?>
			</div>
		</footer>
	</body>
</html>
