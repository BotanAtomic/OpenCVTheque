<?php

class Account
{

    private $id;

    private $name, $forename;

    private $email, $password;

    public function __construct($id, $name, $forename, $email, $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->forename = $forename;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getForename() {
        return $this->forename;
    }

    public function getEmail() {
        return $this->email;
    }


}