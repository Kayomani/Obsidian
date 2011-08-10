<?php

require 'lgsl_files/lgsl_protocol.php';



class GameServerQuery implements QueryInterface{


	function CheckPorts($server){

		$ports = lgsl_port_conversion($server->protocol,$server->cport,$server->qport,$server->sport);
		$server->cport = $ports[0];
		$server->qport = $ports[1];
		$server->sport = $ports[2];
		return $server;
	}

	function QueryServer($server){

		$benchmark = new Benchmark;
		$benchmark->StartTimer("lgsl");
		$result = lgsl_query_live($server->protocol,$server->address,$server->cport,$server->qport,$server->sport,"sep");
		$benchmark->EndTimer("lgsl");


		$queryinfo = $result["b"];
		$serverinfo = $result["s"];
		$servervars = $result["e"];
		$players = $result["p"];

		/*foreach($result as $k => $v)
		 {
			echo "<br/><br/>$k<br/>";
			var_dump($v);
			}*/


		//If the server is online then copy the data over.
		if($queryinfo["status"]==1)
		{
			$server->ping = $benchmark->GetBenchmarkMilliSeconds("lgsl");
			$server->hostname = $serverinfo["name"];
			$server->game = $serverinfo["game"];
			$server->map = $serverinfo["map"];
			$server->maxplayers = $serverinfo["playersmax"];
			$server->password = $serverinfo["password"];
			if(isset($servervars["dedicated"]))
			 $server->dedicated = streq($servervars["dedicated"],"d");
			else 
			 $server->dedicated =1;
			
			if(isset($servervars["description"]))
			 $server->gamename = $servervars["description"];
			else
			 $server->gamename = $server->game;
			 
			 $server->setServerVars($servervars);
			$playerlist= array();
			foreach($players as $k => $v)
			{
				$player = new Lan_servers_player;
				$player->name = $v["name"];

				if(isset($v["score"]))
				$player->score = $v["score"];
				else if(isset($v["frags"]))
				$player->score = $v["frags"];
				else if(isset($v["rank"]))
				$player->score = $v["rank"];
				else
				$player->Score = "0";
				if(isset($v["time"]))
				$player->time = $v["time"];
				else
				$player->time = "";
				$playerlist[] = $player;
			}
			
			$server->setPlayers($playerlist);
			$server->playercount = count($playerlist);
		}
		else
		{
			$server->ping = "-1";

			$playerlist= array();
			$server->setPlayers($playerlist);
			$server->maxplayers ="";
			$server->playercount = "";
		}
		return $server;
	}

	function GetGameList(){
		return lgsl_type_list();
	}

	function FindMapImage($server){

		if(streq($server->ping,"-1"))
		{
			return "libs/lgsl/lgsl_files/other/map_no_response.jpg";
		}
		$file = "libs/lgsl/lgsl_files/maps/" . $server->protocol . "/". $server->game . "/" . $server->map . ".jpg";

		if(file_exists($file))
		return $file;
			
		return "libs/lgsl/lgsl_files/other/map_no_image.jpg";
	}
}

?>