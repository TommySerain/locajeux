<?php

require_once __DIR__ . "/../ErrorMsg.php";

class DuplicateEmailException extends PDOException
{
    public function __construct()
    {
        $this->code = ErrorMsg::DUPLICATE_EMAIL;
    }
}
