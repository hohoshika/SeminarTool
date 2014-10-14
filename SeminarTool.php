<?php

//API呼び出し
$json = file_get_contents('http://api.atnd.org/events/?keyword_or=perl,PHP&format=json&count=100');
//Jsonをphpに変換
$eventData = json_decode($json,true);

//タイトル、URL、日付を取得
foreach ($eventData['events'] as $event) {
	$showData[] = array(
		//日付を整形
		'started_at' => substr($event['event']['started_at'], 0, 10),
		'event_url' => $event['event']['event_url'],
		'title' => $event['event']['title'],
	);
}

echo <<<TITLE
	<html>
	<head>
	<title>Seminar Information</title>
	</head>
	<body>
	<h1>Information</h1>
TITLE;

foreach ($showData as $event) {
	echo <<<BODY
		<span class="span1">
		<span class="span2">${event['started_at']}&nbsp;</span>
		<a href ="${event['event_url']}" target="_blank">${event['title']}</a>
		</span><br/>
BODY;
}

echo <<<SIDE
		<span class="right">
		</span>
SIDE;

echo "</body>";
echo "</html>";