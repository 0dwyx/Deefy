<?php

namespace iutnc\deefy\action;

use iutnc\deefy\audio\lists\PlayList;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\repository\DeefyRepository;

class AddPlaylistAction extends Action
{

    public function execute(): string
    {
        if ($this->http_method =='GET'){
            return <<<FIN
            <form method="post" action="?action=add-playlist">
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre">
                <input type="submit" value="Ajouter">
            FIN;
        } else {
//            Lors de la validation du formulaire avec une requête HTTP de type POST, instancier une
//PlayList avec le nom saisi (et nettoyé), l'enregistrer dans la session PHP, puis l’afficher avec un
//AudioListRenderer suivi du lien suivant :
// <a href="?action=add-track">Ajouter une piste</a>
//Filtrer les valeurs des champs avant de les afficher ( filter_var() ).
//Conseil : Utiliser la syntaxe Heredoc pour décrire le formulaire (voir documentation PHP).
            $titre = filter_var($_POST['titre'], FILTER_SANITIZE_SPECIAL_CHARS);
            $playlist = new PlayList($titre);
            $_SESSION['playlist'] = $playlist;
//            var_dump($playlist);
            $r = DeefyRepository::getInstance();
            $r->sauverPlaylistVide($titre);
            return (new AudioListRenderer($playlist))->render(1) . '<br><a href="?action=add-track">Ajouter une piste</a>';
        }
    }
}