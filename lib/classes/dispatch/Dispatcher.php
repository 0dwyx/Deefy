<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\AddPlaylistAction;
use iutnc\deefy\action\AddPodcastTrackAction;
use iutnc\deefy\action\AddUserAction;
use iutnc\deefy\action\DefaultAction;
use iutnc\deefy\action\DisplayPlaylistAction;
use iutnc\deefy\action\SignInAction;

class Dispatcher
{
//    Son constructeur récupère le
//paramètre action et stocke sa valeur dans un attribut $action. Elle dispose des deux méthodes
//suivantes :
//• public function run(): void
//En fonction de la valeur de l’attribut $action , cette méthode instancie la bonne classe
//Action et exécute sa méthode execute. Ceci est réalisé avec l’instruction switch sur
//la valeur de latribut. Le fragement HTML retourné par la méthode execute est affiché à
//l’aide de la méthode renderPage.
//• private function renderPage(string $html): void
//Cette méthode reçoit en argument un morceau de code HTML (le résultat de execute) et
//l’insert dans un document complet, pour enfin l’afficher avec une instruction echo (c’est la
//seule instance de echo dans tout le projet !)

    private $action;

    public function __construct()
    {
        if (isset($_GET['action'])) {
            $this->action = $_GET['action'];
        } else {
            $this->action = "default";
        }
    }

    public function run(): void
    {
        switch ($this->action) {
            case "default":
                $action = new DefaultAction();
                $html = $action->execute();
                break;
            case "add-track":
                $action = new AddPodcastTrackAction();
                $html = $action->execute();
                break;
            case "add-playlist":
                $action = new AddPlaylistAction();
                $html = $action->execute();
                break;
            case "playlist":
                $action = new DisplayPlaylistAction();
                $html = $action->execute();
                break;
            case "sign-in":
                $action = new SignInAction();
                $html = $action->execute();
                break;
            case "add-user":
                $action = new AddUserAction();
                $html = $action->execute();
                break;
            default:
                $action = new \iutnc\deefy\action\DefaultAction();
                $html = $action->execute();
        }
        $this->renderPage($html);
    }

    private function renderPage(string $html): void
    {
        echo "<!DOCTYPE html>
                <html lang=\"en\">
                    <head>
                        <meta charset=\"UTF-8\">
                        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
                        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                        <title>Deefy</title>
                    </head>
                    <body>
                        <h1>Deefy</h1>
                        <ul>
                            <li><a href='?action=default'>Accueil</a></li>
                            <li><a href='?action=add-track'>Ajouter une piste</a></li>
                            <li><a href='?action=add-playlist'>Ajouter une playlist</a></li>
                            <li><a href='?action=playlist'>Liste des playlists</a></li>
                            <li><a href='?action=sign-in'>Se connecter</a></li>
                            <li><a href='?action=add-user'>Créer un compte</a></li>
                        </ul>
                        $html
                    </body>
                </html>";
    }

}