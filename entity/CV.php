<?php

class CV
{

    private $id;

    private $owner;

    private $lastModification;

    private $title, $name, $forename, $email, $address, $birthday, $languages, $training, $phoneNumber, $career;

    public function __construct($row)
    {
        $this->id = $row["id"];
        $this->title = $row["title"];
        $this->name = $row["name"];
        $this->forename = $row["forename"];
        $this->email = $row["email"];
        $this->birthday = $row["birthday"];
        $this->languages = $row["languages"];
        $this->address = $row["address"];
        $this->training = $row["training"];
        $this->phoneNumber = $row["phone_number"];
        $this->career = $row["career"];
        $this->owner = $row["owner"];
        $this->lastModification = $row["last_modification"];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function getLastModification()
    {
        return $this->lastModification;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getForename()
    {
        return $this->forename;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function getLanguages()
    {
        return $this->languages;
    }

    public function getTraining()
    {
        return $this->training;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function getCareer()
    {
        return $this->career;
    }

    public function getTitle()
    {
        return $this->title;
    }


}