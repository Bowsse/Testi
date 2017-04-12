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



<section>
<!--  Thesis and user selection for developing purposes -->
			<?php

				if(isset($_POST['thesis']))
				{
					$_SESSION['thesis'] = $_POST['thesis'];
					echo "<H2> Thesis {$_SESSION['thesis']} selected   ";

				}
				else
				{
					$_SESSION['thesis'] = NULL;
					echo "<H2> No thesis selected   ";
				}
				if(isset($_POST['user']))
				{
					$_SESSION['user'] = $_POST['user'];

					echo ", reviewing as {$_SESSION['user']}";

				}
				else
				{
					echo ", no user selected";

				}


				echo "</H2>";

			?>

			<form method="post" action="review_page.php">

				<select name="thesis">
					<option value="1">1</option>
					<option value="2">2</option>
				</select>
				<br>

				<select name="user">
					<option value="supervisor1">supervisor1</option>
					<option value="supervisor2">supervisor2</option>
				</select>
				<br>
				<input type="submit" value="Submit" />
			</form>
</section>

<?php include_once("evaluation_form.php"); ?>

<?php

//TODO: Count averages by looping through form
//TODO: session shit and confirmation popup?
$grade1 = ($_POST["11"] + $_POST["12"] + $_POST["13"]) / 3;
$grade2 = ($_POST["21"] + $_POST["22"] + $_POST["23"] + $_POST["24"]) / 4;
$grade3 = ($_POST["31"] + $_POST["32"] + $_POST["33"]) / 3;
$grade4 = ($_POST["41"] + $_POST["42"] + $_POST["43"]) / 3;
$grade5 = ($_POST["51"] + $_POST["52"] + $_POST["53"]) / 3;

$total = ($grade1 + $grade2 + $grade3 + $grade4 + $grade5) / 5;


/*
if(isset($_SESSION['thesis']))
{

	$sql = "INSERT INTO Grade (field1, field2, field3, field4, field5, Thesis_thesisID) VALUES ('".$grade1."', '".$grade2."','".$grade3."', '".$grade4."',  '".$grade5."', '".$_SESSION['thesis']."')";

	$db->exec($sql);

	$grades = $db->query("SELECT * FROM Grade WHERE Thesis_thesisID = '".$_SESSION['thesis']."'");

}

*/
echo "<section>";
if(isset($_SESSION['thesis']))
{
	$grades = $db->query("SELECT * FROM Grade WHERE Thesis_thesisID = '".$_SESSION['thesis']."'");


	echo "<table border='1'>\n";

	echo "<tr><td>ID</td><td>comment</td><td>grade 1</td><td>grade 2</td><td>grade 3</td><td>grade 4</td><td>grade 5</td><td>reviewer</td><td>thesis ID</td></tr>\n";

	while($row = $grades->fetch(PDO::FETCH_ASSOC)) {
	  echo "<tr><td>{$row['gradeID']}</td><td>{$row['comment']}</td><td>{$row['field1']}</td><td>{$row['field2']}</td><td>{$row['field3']}</td><td>{$row['field4']}</td><td>{$row['field5']}</td><td>{$row['Person_personID']}</td><td>{$row['Thesis_thesisID']}</td></tr>\n";
	}

	echo "</table>\n";

}

echo "</section>";

?>