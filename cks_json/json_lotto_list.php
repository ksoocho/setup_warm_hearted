<?
header('Content-type: application/json');

	$lottery_machine = range(1, 45);
	$keys = array_rand($lottery_machine, 6);

  $arr = array();
	  
  $count = 1;
	foreach ($keys as $key => $value)
	{
    $arr[] = $lottery_machine[$value];
		unset($lottery_machine[$value]);
		$count++;
	}	


echo $_GET['jsoncallback'] . '(' . json_encode($arr) . ');';
?>
