<?php

$password = PasswordData::getById($_GET["id"]);


$password->del();
Core::redir("./index.php?view=password");


?>