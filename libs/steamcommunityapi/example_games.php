<?php
/*
 *      Copyright 2010 Rob McFadzean <rob.mcfadzean@gmail.com>
 *      
 *      Permission is hereby granted, free of charge, to any person obtaining a copy
 *      of this software and associated documentation files (the "Software"), to deal
 *      in the Software without restriction, including without limitation the rights
 *      to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *      copies of the Software, and to permit persons to whom the Software is
 *      furnished to do so, subject to the following conditions:
 *      
 *      The above copyright notice and this permission notice shall be included in
 *      all copies or substantial portions of the Software.
 *      
 *      THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *      IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *      FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *      AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *      LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *      OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *      THE SOFTWARE.
 *      
 */
require("SteamAPI.class.php");
	
$id = $_GET['id'];
if(empty($id)) {
	$id = "wbreadz";
}
$steam = new SteamAPI($id);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Example Games</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<style type="text/css">
			.right{float:right;}
			.left{float:left;}
			.clear{clear:both;}
			a{text-decoration:none;color:inherit;}
			a img{border:none;margin:2px;}
			a:hover{color:#C1C1C1;}
			.status_online{color:#5BC34F;}
			.status_offline{color:#B60012;}
			body{text-align:center;color:#FFF;font:13px/1.5 Helvetica, Arial, 'Liberation Sans', FreeSans, sans-serif;line-height:18px;background:#000 url(img/default-bg.jpg) no-repeat scroll center top;}
			.game-box{min-height:130px;text-align:center;-moz-border-radius:3px;float:right;color:#F2F2F2;background:transparent url(img/transparent.png) repeat scroll 0 0;min-width:250px;border:1px solid #FFF;padding:5px;margin:1px;}
		</style>
	</head>
	
	<body>
		<?php
			#echo "<pre>";
			#print_r($steam->getGames());
			#echo "</pre>";
			echo "<h1>{$steam->getFriendlyName()} plays:</h1><br />";
			foreach($steam->getGames() as $game) { 
				echo "<div class=\"left game-box\">";
					echo $game['name']."<br />";
					echo "<a href=\"{$game['storeLink']} title=\"Link to {$game['name']} in the store\"><img src=\"{$game['logo']}\" /></a><br />";
					if($game['hoursLast2Weeks'] != 0) {
						echo "Play time for the last 2 weeks: {$game['hoursLast2Weeks'] }<br />";
					}
					if($game['hoursOnRecord'] != 0) {
						echo "Overall play time: {$game['hoursOnRecord']}<br />";
					}
				echo "</div>";
			}
			echo "<div class=\"clear\"></div>";
			echo "<h2>In total they have {$steam->getTotalGames()} games.</h2>";
		?>
		</div>
	</body>
</html>
