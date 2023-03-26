<?php

require_once __DIR__ . "/../ErrorMsg.php";
// require_once __DIR__ . "/InscriptionException.php";

class DuplicateEmailException extends InscriptionException
{
    public function __construct()
    {
        $this->code = ErrorMsg::DUPLICATE_EMAIL;
        redirect("index.php?erreur=6");
    }
}
