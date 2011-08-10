<?php

if(isset($_POST["info"]))
{
	file_put_contents($root . $folder . '/.info',$_POST["info"]);

}

if (!empty($_FILES)) {
	
	$tempFile = $_FILES['Filedata']['tmp_name'];
	
	
	$ifolder = base64_decode(str_replace('/','',$_POST["folder"]));
	
	$target = $root  .$ifolder . '/'. $_FILES['Filedata']['name'];
	move_uploaded_file($tempFile,$target);
	var_dump($target);
	die();
}

?>