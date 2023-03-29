<?php

class ErrorMsg
{
    public const CONNECTION_EMPTY = 1;
    public const MAIL_OR_PASS_CONNECTION_EMPTY = 2;
    public const PASSWORD_OR_MAIL_INCORECT = 3;
    public const INSCRIPTION_EMPTY = 4;
    public const BLANKS_FIELD = 5;
    public const DUPLICATE_EMAIL = 6;
    public const INVALID_EMAIL = 7;
    public const INVALID_DATE = 8;
    public const INVALID_AGE = 9;
    public const INVALID_NOTE = 10;
    public const NOTE_COM_EMPTY = 11;
    public const INVALID_COM_SIZE = 12;

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
            case self::INVALID_EMAIL:
                return "Cet email n'a pas un format valide";
                break;
            case self::INVALID_DATE:
                return "La date de naissance n'a pas un format valide";
                break;
            case self::INVALID_AGE:
                return "Il faut être majeur pour pouvoir s'inscrire";
                break;
            case self::INVALID_NOTE:
                return "La note doit être un chiffre entier entre 1 et 5 ";
                break;
            case self::NOTE_COM_EMPTY:
                return "Tous les champs doivent être remplis";
                break;
            case self::INVALID_COM_SIZE:
                return "Le commentaire doit faire 200 caractères maximum";
                break;
            default:
                return "Contactez l'administrateur de l'application";
        }
    }
}
