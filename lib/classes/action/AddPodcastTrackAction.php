<?php
namespace iutnc\deefy\action;
//session_start();
//$_SESSION['playlist']= new PlayList();

use iutnc\deefy\audio\lists\PlayList;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\repository\DeefyRepository;
use Random\RandomException;

//$_SESSION['playlist']= new PlayList('test', []);
class AddPodcastTrackAction extends Action
{

    public function execute(): string
    {
//        créer une piste et l’ajouter dans la playlist de la session
        if ($this->http_method =='GET'){
            return <<<FIN
            <form enctype="multipart/form-data" method="post" action="?action=add-track">
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre">
                <label for="artiste">Artiste</label>
                <input type="text" name="artiste" id="artiste">
                <label for="duration">Durée</label>
                <input type="text" name="duree" id="duree">
                <label for="album">Album</label>
                <input type="text" name="album" id="album">
                <label for="annee">Annee</label>
                <input type="text" name="annee" id="annee">
                <label for="genre">Genre</label>
                <input type="text" name="genre" id="genre">
                <!-- <label for="nom_fichier">Fichier</label> -->
                <!-- <input type="text" name="nom_fichier" id="nom_fichier"> -->
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000000" />
                <!-- Le nom de l'élément input détermine le nom dans le tableau \$_FILES -->
                Fichier audio : <input name="userfile" type="file" />
                <input type="submit" value="Ajouter">
            FIN;
        } else {
            $titre = $_POST['titre'];
            $artiste = $_POST['artiste'];
            $duree = $_POST['duree'];
            $nom_fichier = bin2hex(random_bytes(10)).'.mp3';
//            echo $nom_fichier;
            $this->uploadF($nom_fichier);
            $track = new AlbumTrack($titre, $nom_fichier);
            $track->duree = $duree;
            $track->artiste = $artiste;
            $track->album = $_POST['album'];
            $track->annee = intval($_POST['annee']);
            $track->genre = $_POST['genre'];
            $_SESSION['playlist']->addTrack($track);
            $r = DeefyRepository::getInstance();
            $r->sauverPiste($track);
            $r->ajouterPistePlayList($_SESSION['playlist']->id, $track->id);
            return "Piste ajoutée";

        }
    }

    private function uploadF($nouveauNom): void{
        $repertoire = ".\lib\classes\audio\\";
        $fichier = $repertoire . basename($nouveauNom);
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $fichier)) {
            echo "Le fichier a été uploadé.\n";
        } else {
            echo "Problème lors de l'upload. \n";
        }
    }
}