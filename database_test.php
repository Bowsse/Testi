<?php
require_once("../db_init.php");

$usrs = $db->query('SELECT * FROM User');
$cmnt = $db->query('SELECT * FROM Comment');
$ntfc = $db->query('SELECT * FROM Notification');



echo "<section>";

echo "<table border='1'>\n";

while($row = $usrs->fetch(PDO::FETCH_ASSOC)) {
  echo "<tr><td>{$row['userID']}</td><td>{$row['firstName']}</td><td>{$row['lastName']}</td><td>{$row['role']}</td><td>{$row['email']}</td></tr>\n";
}

echo "</table>\n";

echo "<table border='1'>\n";

while($row = $cmnt->fetch(PDO::FETCH_ASSOC)) {
  echo "<tr><td>{$row['commentID']}</td><td>{$row['content']}</td><td>{$row['author_userID']}</td><td>{$row['Version_versionID']}</td><td>{$row['Version_thesisID']}</td><td>{$row['submissionDate']}</td></tr>\n";
}

echo "</table>\n";

echo "<table border='1'>\n";

while($row = $ntfc->fetch(PDO::FETCH_ASSOC)) {
  echo "<tr><td>{$row['notificationID']}</td><td>{$row['content']}</td><td>{$row['seen']}</td><td>{$row['creationDate']}</td><td>{$row['receiver_userID']}</td></tr>\n";
}

echo "</table>\n";



echo "</section>";



?>
