<?php
session_start();
?>
<head>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">


</head>

<?php
include_once("head.php");
require_once("../db_init.php");



$json = file_get_contents("json/criteria.json");

//$json = '[{"topic": "1", "subtopic": [{	"1.1 Aiheen vaativuus": [	"Aiheen valinta ei noudata JAMK:n pinnäytetyöprosessia.",      "Aihe on rutiininomainen, mutta tukee opiskelijan opintoja ja ammatillista kehittymistä.",    "Aihe on alalle melko tavanomainen eikä sisällä uusia näkökulmia.",       "Aihe on tavanomainen, mutta sisältää uusia näkökulmia.",        "Aihe on melko haastava ja tuo uutta toimeksiantajalle.",     "Aihe on haastava ja tuo uutta alalle."    ]		}	]	}	]';
//$json = '[{"topic": "1", "subtopic": [{ "1.1 Aiheen vaativuus": ["a"], "1.2": ["b"]}]}]';

$tabledata = json_decode($json, true);

echo "<section>";



foreach($tabledata as $item)
{

	echo "<table border='1'>\n";

	foreach($item['item']['subtopic'] as $sub)
	{
		echo '<td>'.$sub['1'][5].'</td>';
 }

//	echo '<td>'.$item['item']['subtopic'][0]['1'][5].'</td>';

    echo "</table>";


}

$title1 = $tabledata[0]['item']['subtopic'][0]['1'][0]['text'];

$vittu1 = $tabledata[0]['item']['subtopic'][0]['1'][1];
$vittu2 = $tabledata[0]['item']['subtopic'][0]['1'][2];
$vittu3 = $tabledata[0]['item']['subtopic'][0]['1'][3];
$vittu4 = $tabledata[0]['item']['subtopic'][0]['1'][4];
$vittu5 = $tabledata[0]['item']['subtopic'][0]['1'][5];
$vittu6 = $tabledata[0]['item']['subtopic'][0]['1'][6];



	echo '<pre>' . print_r($title1,true) . '</pre>';

	echo '<pre>' . print_r($vittu1,true) . '</pre>';
	echo '<pre>' . print_r($vittu2,true) . '</pre>';
	echo '<pre>' . print_r($vittu3,true) . '</pre>';
	echo '<pre>' . print_r($vittu4,true) . '</pre>';
	echo '<pre>' . print_r($vittu5,true) . '</pre>';
	echo '<pre>' . print_r($vittu6,true) . '</pre>';



echo "</section>";

echo "<br>";
echo "<br>";

echo "<section>";


	echo '<pre>' . print_r($tabledata, true) . '</pre>';

echo "</section>";


?>