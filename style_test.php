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

$usrs = $db->query('SELECT * FROM User');
$cmnt = $db->query('SELECT * FROM Comment');
$ntfc = $db->query('SELECT * FROM Notification');
$sts = $db->query('SELECT * FROM Status');
$thesis = $db->query('SELECT * FROM Thesis');
$vrsn = $db->query('SELECT * FROM Thesis');




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

echo "<table border='1'>\n";

while($row = $sts->fetch(PDO::FETCH_ASSOC)) {
  echo "<tr><td>{$row['statusID']}</td><td>{$row['thesisID']}</td><td>{$row['urkund']}</td><td>{$row['maturity']}</td><td>{$row['language']}</td><td>{$row['seminar']}</td></tr>\n";
}

echo "</table>\n";

echo "<table border='1'>\n";

while($row = $thesis->fetch(PDO::FETCH_ASSOC)) {
  echo "<tr><td>{$row['thesisID']}</td><td>{$row['authot_userID']}</td><td>{$row['supervisor1_userID']}</td><td>{$row['supervisor2_userID']}</td><td>{$row['estimatedDate']}</td></tr>\n";
}

echo "</table>\n";

while($row = $vrsn->fetch(PDO::FETCH_ASSOC)) {
  echo "<tr><td>{$row['versionID']}</td><td>{$row['thesisID']}</td><td>{$row['version']}</td><td>{$row['thesisUrl']}</td><td>{$row['creationDate']}</td></tr>\n";
}

echo "</table>\n";

echo "</section>";
?>
