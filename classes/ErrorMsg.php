<?php

class ErrorMsg
{
    public const CONNECTION_EMPTY = 1;
    public const MAIL_OR_PASS_CONNECTION_EMPTY = 2;
    public const PASSWORD_OR_MAIL_INCORECT = 3;
    public const INSCRIPTION_EMPTY = 4;
    public const BLANKS_FIELD = 5;
    public const DUPLICATE_EMAIL = 6;

    function getErrorMsg(int $code): string
    {
        switch ($code) {
            case self::CONNECTION_EMPTY:
                return "Merci de remplir tous les champs de connexion";
                break;
            case self::MAIL_OR_PASS_CONNECTION_EMPTY:
                return "Email ou mot de passe non-renseignés";
                break;
            case self::PASSWORD_OR_MAIL_INCORECT:
                return "Email ou mot de passe incorect";
                break;
            case self::INSCRIPTION_EMPTY:
                return "Merci de remplir tous les champs d'inscription";
                break;
            case self::BLANKS_FIELD:
                return "Tous les champs inscriptions sont obligatoires";
                break;
            case self::DUPLICATE_EMAIL:
                return "Cet email est déjà inscrit sur Locajeux";
                break;
            default:
                return "Contactez l'administrateur de l'application";
        }
    }
}
