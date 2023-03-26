<?php

require_once __DIR__ . "/../ErrorMsg.php";
// require_once __DIR__ . "/InscriptionException.php";


class InvalidEmailException extends InscriptionException
{
    public function __construct()
    {
        $this->code = ErrorMsg::INVALID_EMAIL;
        redirect("index.php?erreur=7");
    }
}
