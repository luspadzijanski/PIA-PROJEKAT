<?php
require_once 'config/Database.php';
require_once 'class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$idd = $_GET["id"];
$sqlQuery="DELETE FROM $user->userTable WHERE id=$idd";
$stmt = $user->conn->prepare($sqlQuery);
$stmt->execute(); 

header("location: admin.php");
exit;