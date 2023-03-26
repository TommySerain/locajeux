<?php

require_once __DIR__ . "/../ErrorMsg.php";
// require_once __DIR__ . "/InscriptionException.php";


class InvalidAgeException extends InscriptionException
{
    public function __construct()
    {
        $this->code = ErrorMsg::INVALID_AGE;
        redirect("index.php?erreur=9");
    }
}
