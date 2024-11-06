<?php

namespace iutnc\deefy\action;

use iutnc\deefy\auth\AuthnProvider;

class SignInAction extends Action
{
    public function execute(): string
    {
        if ($this->http_method === "GET") {
            return "<div>Se connecter</div>
            <form action='?action=sign-in' method='post'>
                <label for='email'>Email</label>
                <input type='text' id='email' name='email'>
                <label for='password'>Password</label>
                <input type='password' id='password' name='password'>
                <input type='submit' value='Se connecter'>";
        } else {
            var_dump($_POST);
            AuthnProvider::signin($_POST['email'], $_POST['password']);
            return "<div>POST !</div>";
        }
    }
}