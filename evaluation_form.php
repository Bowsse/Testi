<?php
session_start();
include_once("head.php");
require_once("../db_init.php");

?>

<head>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


</head>

<?php


$json = file_get_contents("json/criteria.json");

$tabledata = json_decode($json, true);
?>

<section>

<?php

	if(isset($_POST['thesis']))
	{
		$_SESSION['thesis'] = $_POST['thesis'];
		echo "<H2> Thesis {$_SESSION['thesis']} selected</H2>";

	}
	else
	{
		echo "<H2> No thesis selected</H2>";
	}

?>


<h2>Select thesis</h2>
<form method="post" action="evaluation_form.php">

	<select name="thesis">
		<option value="1">1</option>
		<option value="2">2</option>
	</select>
	<br>
	<input type="submit" value="Submit" />
</form>
</section>

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
			if($key == 0)
			{
			echo "<td>{$description}</td>";
		    }
		    else
			{

				// Radiobutton name and value to match criteria numbering
				$radioValue = $key - 1;
				$topic = $iTopic + 1;
				$row = $iRow + 1;
				$radioRow = "{$topic}{$row}";
				$radioID = "{$radioRow}{$radioValue}";
				echo "<td><label for='" . $radioID . "'><input type='radio' name='" . $radioRow . "' id='" . $radioID . "' value='" . $radioValue .  "'><br>{$description}</label></td>";


			}

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
//TODO: session shit and confirmation popup?
$grade1 = ($_POST["11"] + $_POST["12"] + $_POST["13"]) / 3;
$grade2 = ($_POST["21"]) / 1;
$total = ($grade1 + $grade2) / 2;



if(isset($_SESSION['thesis']))
{

	$sql = "INSERT INTO Grade (field1, field2, Thesis_thesisID) VALUES ('".$grade1."', '".$grade2."', '".$_SESSION['thesis']."')";

	$db->exec($sql);

	$grades = $db->query("SELECT * FROM Grade WHERE Thesis_thesisID = '".$_SESSION['thesis']."'");

	echo "<table border='1'>\n";

	echo "<tr><td>ID</td><td>grade 1</td><td>grade 2</td><td>grade 3</td><td>grade 4</td><td>grade 5</td><td>reviewer</td><td>thesis ID</td></tr>\n";

	while($row = $grades->fetch(PDO::FETCH_ASSOC)) {
	  echo "<tr><td>{$row['gareID']}</td><td>{$row['field1']}</td><td>{$row['field2']}</td><td>{$row['field3']}</td><td>{$row['field4']}</td><td>{$row['field5']}</td><td>{$row['Person_personID']}</td><td>{$row['Thesis_thesisID']}</td></tr>\n";
	}

	echo "</table>\n";

}



echo "</section>";


?>