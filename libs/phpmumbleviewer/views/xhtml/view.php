<?php if (!defined("PHP_MUMBLE_VIEWER")) die ('unauthorized access');
$phpmumbleviewer->configureOutput('xhtml', array('indent' => 2, 'icons' => 'classes/output/xhtml/icons/'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<title>PHP Mumble Viewer</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="classes/output/xhtml/style.css" />
	<link rel="shortcut icon" type="image/x-icon" href="mumble.ico" />
    </head>
    <body>
	<?php echo $phpmumbleviewer->render(); ?>
    </body>
</html>