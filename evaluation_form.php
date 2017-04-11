
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
?>

<section>

<form action="evaluation_form.php" method="post">
<table border='1'>
<tr><td></td><td>0</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>

<?php

foreach($tabledata as $iTopic=>$item)
{
	?>
	<tr><td colspan='7' class="sub">
	<?php
	echo "{$item['item']['topic']}</td></tr>\n";

	foreach($item['item']['subtopic'] as $iRow=>$sub)
	{
		echo "<tr>";
		foreach($sub['text'] as $key=>$description)
		{
			
			echo "<td>{$description}";

				if($key > 0)
			{

				// Radiobutton name and value to match criteria numbering
				$radioValue = $key - 1;
				$topic = $iTopic + 1;
				$row = $iRow + 1;
				$radioRow = "{$topic}{$row}";
				echo "<input type='radio' name='" . $radioRow . "' value='" . $radioValue .  "'></td>";

			}
			else{echo "</td>";}
		}
		echo "</tr>";

 }
}
echo "</table>\n";

				echo "<b>Comments</b>"; 
				$placeholder = "Write your comments here";

?>

<textarea placeholder="<?php echo $placeholder?>"rows="5" cols="50" name="comments" style="width:100%;"></textarea>
		<br>
		<div id="button_holder">
			<button type="submit" value="Submit">Submit</button>
		</div>


</form>


<?php

//TODO: Count averages by looping through form
$grade1 = ($_POST["11"] + $_POST["12"] + $_POST["13"]) / 3;
$grade2 = ($_POST["21"]) / 1;
$total = ($grade1 + $grade2) / 2;

echo "<h2> Grade 1: <b> " . $grade1 . "</b> <h2>";
echo "<h2> Grade 2: <b> " . $grade2 . "</b> <h2>";
echo "<h1> Total average grade: <b> " . $total . "</b> <h1>";

/*
$title0 = $tabledata[0]['item']['topic'];


$title1 = $tabledata[0]['item']['subtopic'][0]['text'][0]['title'];
$title2 = $tabledata[0]['item']['subtopic'][1]['text'][0]['title'];

$vittu1 = $tabledata[0]['item']['subtopic'][0]['text'][1];
$vittu2 = $tabledata[0]['item']['subtopic'][0]['text'][2];
$vittu3 = $tabledata[0]['item']['subtopic'][0]['text'][3];
$vittu4 = $tabledata[0]['item']['subtopic'][0]['text'][4];
$vittu5 = $tabledata[0]['item']['subtopic'][0]['text'][5];
$vittu6 = $tabledata[0]['item']['subtopic'][0]['text'][6];


	echo '<pre>' . print_r($title0,true) . '</pre>';

	echo '<pre>' . print_r($title1,true) . '</pre>';
		echo '<pre>' . print_r($title2,true) . '</pre>';

	echo '<pre>' . print_r($vittu1,true) . '</pre>';
	echo '<pre>' . print_r($vittu2,true) . '</pre>';
	echo '<pre>' . print_r($vittu3,true) . '</pre>';
	echo '<pre>' . print_r($vittu4,true) . '</pre>';
	echo '<pre>' . print_r($vittu5,true) . '</pre>';
	echo '<pre>' . print_r($vittu6,true) . '</pre>';


*/
echo "</section>";
/*

echo "<br>";
echo "<br>";

echo "<section>";


	echo '<pre>' . print_r($tabledata, true) . '</pre>';

echo "</section>";
*/

?>