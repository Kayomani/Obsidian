<?php
class LanTime {

	public $text;
	public $value;
}

function setupLanTime($id, $value, $smarty){
	$lan = new Lan_events;
	$lan->get(getCurrentLID());


	$days = array();
	$oneday = (24 * 60 * 60);

	//Add first day
	$first = new LanTime;
	$first->text = date("l jS", strtotime($lan->start));
	$first->value = strtotime(date("d-m-Y 00:00:00", strtotime($lan->start)));
	$days[] = $first;

	//Add each further day
	$querydate = strtotime(date("d-m-Y 00:00:00", strtotime($lan->start) + $oneday));
	while($querydate <strtotime($lan->end))
	{
		$day = new LanTime;
		$day->text = date("l jS", $querydate);
		$day->value = $querydate;
		$days[] = $day;
		$querydate = $querydate + $oneday;
	}

	$smarty->assign("lantime_" .$id."_days",$days);
	//Time
	$hours = array();
	for($i =0;$i<10;$i++)
	{
		$lt = new LanTime;
		$lt->text = "0".$i . ":00";
		$lt->value = $i * 60 *60;
		$hours[] = $lt;

		$lt = new LanTime;
		$lt->text = "0".$i . ":15";
		$lt->value = $i * 60 *60 + (15*60);
		$hours[] = $lt;

		$lt = new LanTime;
		$lt->text = "0".$i . ":30";
		$lt->value = $i * 60 *60 + (30*60);
		$hours[] = $lt;

		$lt = new LanTime;
		$lt->text = "0".$i . ":45";
		$lt->value = $i * 60 *60 + (45*60);
		$hours[] = $lt;

	}
	for($i =10;$i<24;$i++)
	{
		$lt = new LanTime;
		$lt->text = $i . ":00";
		$lt->value = $i * 60 *60;
		$hours[] = $lt;

		$lt = new LanTime;
		$lt->text = $i . ":15";
		$lt->value = $i * 60 *60 + (15*60);
		$hours[] = $lt;

		$lt = new LanTime;
		$lt->text = $i . ":30";
		$lt->value = $i * 60 *60 + (30*60);
		$hours[] = $lt;

		$lt = new LanTime;
		$lt->text = $i . ":45";
		$lt->value = $i * 60 *60 + (45*60);
		$hours[] = $lt;

	}
	$smarty->assign("lantime_".$id."_time",$hours);

	$template = '';
	if(file_exists("skins/" . Config::$theme . "/lantime.htm"))
	 $template = file_get_contents("skins/" . Config::$theme . "/lantime.htm");
	else
	 $template = file_get_contents("skins/default/lantime.htm");
	$template = str_replace("%%ID%%",$id,$template);

	//Set value
	if(null==$value)
	$value =date("d-m-Y H:00:00", strtotime("now"));

	$smarty->assign("lantime_".$id."_selectedday",strtotime(date("d-m-Y 00:00:00",strtotime($value))));
	$smarty->assign("lantime_".$id."_selectedtime",(date("G",strtotime($value))*(60*60) + (date("i",strtotime($value))*60)));
	$smarty->assign("lantime_".$id."_tmpl",$template);
}

function getLanTime($id){
	$lt = new Lan_events;

	$day = $lt->escape($_POST["lantime_".$id."_day"]);
	$time = $lt->escape($_POST["lantime_".$id."_time"]);
	$total = $day+$time;
	return $total;
}
?>