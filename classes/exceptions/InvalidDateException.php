<?php

require_once __DIR__ . "/../ErrorMsg.php";
// require_once __DIR__ . "/InscriptionException.php";


class InvalidDateException extends InscriptionException
{
    public function __construct()
    {
        $this->code = ErrorMsg::INVALID_DATE;
        redirect("index.php?erreur=8");
    }
}
