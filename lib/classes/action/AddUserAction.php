<?php

namespace iutnc\deefy\action;

use iutnc\deefy\audio\lists\PlayList;
use iutnc\deefy\auth\AuthnProvider;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\User;

class AddUserAction extends Action
{

    public function execute(): string
    {
        var_dump($this->http_method);
        if ($this->http_method =='GET'){
            return <<<FIN
            <form method="post" action="?action=add-user">
                <!--                <label for="nom">Nom</label>-->
                <!--                <input type="text" name="nom" id="nom">-->
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <!--                <label for="age">Age</label>-->
                <!--                <input type="number" name="age" id="age">-->
                <label for='password'>Password</label>
                <input type='password' id='password' name='password'>
                <input type="submit" value="Ajouter">
            FIN;
        }
        else {
//            $nom = filter_var($_POST['nom'], FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
//            $age = filter_var($_POST['age'], FILTER_SANITIZE_SPECIAL_CHARS);
            $user = new User($email);
//            $_SESSION['playlist'] = $playlist;
//            var_dump($playlist);
            AuthnProvider::register($email, $_POST['password']);
            return "Utilisateur ajouté : ".$user;
        }
    }
}