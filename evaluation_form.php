<?php

// Criteria descriptions from file
$json = file_get_contents("json/criteria.json");

$tabledata = json_decode($json, true);
?>

<section>

<form action="review_page.php" method="post">
<table border='1'>
<tr><td></td><td>0</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>

<?php
// Topics
foreach($tabledata as $iTopic=>$item)
{
	?>
	<tr><td colspan='7' class="sub">
	<?php

	echo "{$item['item']['topic']}</td></tr>\n";

	// Rows
	foreach($item['item']['subtopic'] as $iRow=>$sub)
	{
		echo "<tr>";

		// Cells
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
				$placeholder = "Comments";

?>

<textarea placeholder="<?php echo $placeholder?>"rows="5" cols="50" name="comments" style="width:100%;"></textarea>
		<br>
		<div id="button_holder">
			<button type="submit" value="Submit">Submit</button>
		</div>

</form>

</section>
