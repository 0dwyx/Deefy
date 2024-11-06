<?php

namespace iutnc\deefy\auth;

use iutnc\deefy\exception\AuthnException;
use iutnc\deefy\repository\DeefyRepository;

class AuthnProvider
{
    public static function signin(string $email, string $password): void
    {
        $r = DeefyRepository::getInstance();
        $hash = $r->getPasswd($email);

        if(password_verify($password, $hash)) {
            echo "ok";
            $_SESSION['email'] = $email;
        } else {
            echo "ko";
            throw new AuthnException("Erreur d'authentification");
        }
    }

    public static function register(string $email, string $password): void
    {
        if(strlen($password) < 10) {
            throw new AuthnException("Mot de passe trop court");
        }

        $r = DeefyRepository::getInstance();
        if($r->getPasswd($email) !== null) {
            throw new AuthnException("Utilisateur déjà existant");
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $r->addUser($email, $hash, 1);
    }

    public static function getSignedInUser(): string
    {
        if(isset($_SESSION['email'])) {
            return $_SESSION['email'];
        } else {
            throw new AuthnException("Utilisateur non authentifié");
        }
    }

}