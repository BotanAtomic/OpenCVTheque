<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

if (!isset($_GET["email"])) return;

include("../entity/Account.php");
include("../includes/header.php");

$email = $_GET["email"];
$password = $_GET["password"];

$statement = $database->prepare("SELECT * from users WHERE email = ? AND password = ?;");
$statement->bind_param("ss", $email, $password);
$statement->execute();

$result = $statement->get_result();


while ($row = $result->fetch_array(MYSQLI_ASSOC))
{
    $_SESSION["account"] = new Account($row["id"], $row["name"], $row["forename"],  $row["email"], $row["password"]);
    echo "1";
    return;
}

echo "0";
