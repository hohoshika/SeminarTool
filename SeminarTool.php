<?php

//API呼び出し
$json = file_get_contents('http://api.atnd.org/events/?keyword_or=perl,PHP&format=json&count=100');
//Jsonをphpに変換
$eventData = json_decode($json);

$eventDate = array();
$eventName = array();
$eventUrl = array();

//タイトル、URL、日付を取得
foreach ($eventData->events as $key => $value) {
	$eventDate[] = $value->event->started_at;
	$eventUrl[] = $value->event->event_url;
	$eventName[] = $value->event->title;
}

//日付を成型
$formatedDate = array();
foreach ($eventDate as $key => $value) {
	 $formatedDate[] = substr($value, 0, 10);

}

echo <<<TITLE
	<html>
	<head>
	<title>Seminar Information</title>
	</head>
	<body>
	<h1>Information</h1>
TITLE;

for ($i=0; $i < count($eventName); $i++) { 
	echo <<<BODY
		<span class="span1">
		<span class="span2">$formatedDate[$i]&nbsp;</span>
		<a href ="$eventUrl[$i]" target="_blank">$eventName[$i]</a>
		</span><br/>
BODY;
}

echo <<<SIDE
		<span class="right">
		</span>
SIDE;

echo "</body>";
echo "</html>";
?>
