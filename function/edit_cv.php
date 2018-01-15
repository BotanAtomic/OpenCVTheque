<?php

include("../entity/Account.php");
include("../includes/header.php");

if (!isset($_SESSION["account"]) || !($_SESSION["account"] instanceof Account)) {
    header('Location: .');
    return;
}

$account = $_SESSION["account"];

if (isset($_POST["id"])) {
    $statement = $database->prepare("SELECT * FROM cv WHERE id = ?;");
    $statement->bind_param("i", $_POST["id"]);
    $statement->execute();
    $result = $statement->get_result();

    if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        if ($row["owner"] != $account->getId()) {
            echo ("0");
            return;
        }
    } else {
        echo ("0");
        return;
    }

}

$id = $_POST["id"];
$title = $_POST["title"];
$name = $_POST["name"];
$forename = $_POST["forename"];
$email = $_POST["email"];
$phone_number = $_POST["phone_number"];
$birthday = $_POST["birthday"];
$address = $_POST["address"];
$career = $_POST["career"];
$training = $_POST["training"];
$languages = $_POST["languages"];


$date = new DateTime();


$statement = $database->prepare("UPDATE cv SET title=?, name = ?, forename = ?, email = ?, address = ? , birthday=? , languages=? , training=? , phone_number=? ,
career=? , last_modification=? , owner = ? WHERE id=?;");
$statement->bind_param("ssssssssssiii", $title, $name, $forename, $email, $address, $birthday, $languages, $training, $phone_number,
    $career, $date->getTimestamp(), $account->getId(), $_POST["id"]);


if ($statement->execute()) {

    if (isset($_POST["image"])) {
        $data = $_POST["image"];
        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);

        mkdir("../data/cv/$id/", 0777, true);
        file_put_contents("../data/cv/$id/avatar", $data);
    }
    echo "1";
} else {
    echo "0";
}