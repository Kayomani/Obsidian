<?php

if(!isset($root))
die("Progmatic error.");

require_once('XML/HTMLSax3.php');
require_once 'HTML/Safe.php';


class FileItem {

	public $name;
	public $path;
	public $image;
	public $size;
}

class DirectoryItem {

	public $directory;
	public $path;

	public function encodedName(){
		return base64_encode(($this->path));
	}
}

function findimage($filename){
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	switch($ext){
		case 'exe':
		case 'msi':
			return 'binary.gif';
		case 'avi':
		case 'mkv':
		case 'wmv':
		 return 'movie.gif';
		case 'aac':
		case 'mp3':
		case 'wav':
			return 'sound1.gif';
		case 'txt':
		case 'doc':
		case 'nfo':
			return 'text.gif';
		case 'rar':
		case 'zip':
		case '7z':
			return 'compressed.png';
		case 'iso':
		case 'img':
			return 'diskimg.gif';
		default:
			return 'generic.gif';
	}
}

$list = scandir($root. $folder,0);
$tmp = array_map('strtolower', $list);
array_multisort($tmp, $list);
$filelist = array();
$dirlist = array();
$infofile = $root . $folder . '/.info';

if(file_exists($infofile)){

	$parser =& new HTML_Safe();
	$header = $parser->parse(file_get_contents($infofile));
	$headerhtml = nl2br($header);
}




foreach($list as $item){
	if(!streq('.',$item )&&!streq('Thumbs.db',$item )&&!streq('.info',$item )){



		if(is_dir($root . $folder . '/' .$item))
		{
			$dir = new DirectoryItem;
			$dir->directory = $item;
				
				
			if(streq('..',$item ))
			{
				$dir->path = dirname($folder);
				if(streq($dir->path,"\\"))
				$dir->path = "";
			}
			else
			$dir->path =$folder . '/'. $item;
			if(!($inroot && streq('..',$item )))
			$dirlist[] = $dir;
		}
		else
		{
			$file = new FileItem;
			$file->name = $item;
			$file->image = findimage($item);
			//Strip leading slash
			$path = $folder . '/'. $item;
			if(strlen($path)>0)
			$path = substr($path,1,strlen($path)-1);
			$file->path = $path;
			$file->size = decodeSize(getFileSize($root . $folder . '/'. $item));
			$filelist[] = $file;
		}
	}
}

$master->Smarty->assign('filelist',$filelist);
$master->Smarty->assign('folderlist',$dirlist);
?>