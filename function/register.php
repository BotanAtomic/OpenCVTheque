<?php
ini_set( 'display_errors', 'on' );
error_reporting( E_ALL );

if (!isset($_POST["name"])) return;

include("../entity/Account.php");
include("../includes/header.php");

$name = $_POST["name"];
$forename = $_POST["forename"];
$email = $_POST["email"];
$password = $_POST["password"];


$statement = $database->prepare("INSERT INTO users (email, password, name, forename) VALUES (?,?,?,?);");
$statement->bind_param("ssss", $email, $password, $name, $forename);

if($statement->execute()) {
    $_SESSION["account"] = new Account($database->insert_id, $name, $forename, $email, $password);
    header('Location: ..');
} else {
    echo "Une erreur inattendu est surevenue...Veuillez contacter l'administrateur du site";
}






