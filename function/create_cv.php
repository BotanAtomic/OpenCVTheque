<?php

include("../entity/Account.php");
include("../includes/header.php");

if (!isset($_SESSION["account"]) || !($_SESSION["account"] instanceof Account)) {
    header('Location: .');
    return;
}

$account = $_SESSION["account"];



$title = $_POST["title"];
$name = $_POST["name"];
$forename = $_POST["forename"];
$email = $_POST["email"];
$phone_number = $_POST["phone_number"];
$birthday= $_POST["birthday"];
$address = $_POST["address"];
$career = $_POST["career"];
$training = $_POST["training"];
$languages = $_POST["languages"];


$date = new DateTime();


$statement = $database->prepare("INSERT INTO cv (title, name, forename, email, address, birthday, languages, training, phone_number,
career, last_modification, owner) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);");
$statement->bind_param("ssssssssssii", $title, $name, $forename, $email, $address, $birthday, $languages, $training, $phone_number,
    $career, $date->getTimestamp(), $account->getId());


if($statement->execute()) {
    $cvId = $database->insert_id;

    if(isset($_POST["image"])) {
        $data = $_POST["image"];
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        mkdir("../data/cv/$cvId/", 0777, true);
        file_put_contents("../data/cv/$cvId/avatar", $data);
    }
    echo "1";
} else {
    echo "0";
}