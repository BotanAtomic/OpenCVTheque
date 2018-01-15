<?php

include("../includes/header.php");

$email = $_GET["email"];

$statement = $database->prepare("SELECT * from users WHERE email = ?;");
$statement->bind_param("s", $email);
$statement->execute();

$result = $statement->get_result();

while ($row = $result->fetch_array(MYSQLI_ASSOC))
{
    echo "0";
    return;
}

echo "1";