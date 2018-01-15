<?php

if (session_status() == PHP_SESSION_NONE)
    session_start();
$database = new mysqli("localhost", "root", "root", "opencvtheque");





