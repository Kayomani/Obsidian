<?php

$text = "Regenerating games list<br />";

if ($handle = opendir('images/games/')) {
	$text.= "Directory handle: $handle\n";
	$text.= "Files:\n";

	/* This is the correct way to loop over the directory. */
	while (false !== ($file = readdir($handle))) {
		 
		if(!streq("..",$file) && !streq(".",$file))
		{
			$name = str_replace("-"," ",$file);
			$name = str_replace("_"," ",$name);
			$name = str_replace(".png"," ",$name);
			
			
			$game = new Lan_games;
			$game->name = $name;
			//$game->find();
			if($game->count()==0)
			{
				$game->picture = $file;
				$game->insert();
				$text.="$name\n<br/>";
			}
		}
	}
  closedir($handle);
}
$master->Smarty->assign("_text",$text);
?>