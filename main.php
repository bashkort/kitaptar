<?php 
$mysqli = new mysqli("localhost", "root", "coolpass", "kitaptar");
if($mysqli->connect_errno){
printf("Соединениенеудалось:%s\n",$mysqli->connect_error);
exit();
}
$aliases = array();
$query = "select alias from books";
$result = $mysqli->query($query);
while($row = $result->fetch_assoc()){
	array_push($aliases, $row["alias"]);
}
$ids = array();
$mysqli->select_db("kitaptest");
$query = "select id from books where id < 1603";
$result = $mysqli->query($query);
while($row = $result->fetch_assoc()){
	array_push($ids, $row["id"]);
}
$combined = array_combine($ids, $aliases);
foreach($combined as $id=>$alias){
	$mysqli->query("update books set alias='$alias' where id='$id'");
}
$result->free();
$mysqli->close();
?>
