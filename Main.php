<?php
declare(strict_types=1);

use iutnc\deefy\audio\lists\Album;
use iutnc\deefy\audio\lists\AudioList;
use iutnc\deefy\audio\lists\PlayList;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\render\AlbumTrackRenderer;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\render\Renderer;
use iutnc\deefy\repository\DeefyRepository;

//require_once 'lib\classes\audio\tracks\AlbumTrack.php';
//require_once 'lib\classes\audio\tracks\AudioTrack.php';
//require_once 'lib\classes\audio\tracks\PodcastTrack.php';
//require_once 'lib\classes\audio\lists\AudioList.php';
//require_once 'lib\classes\audio\lists\Album.php';
//require_once 'lib\classes\audio\lists\PlayList.php';
//require_once 'lib\classes\render\AlbumTrackRenderer.php';
//require_once 'lib\classes\render\PodcastRenderer.php';

//require_once 'Autoloader.php';
require_once 'vendor/autoload.php';

session_start();
if (!isset($_SESSION['playlist'])) {
    $_SESSION['playlist'] = new PlayList('playlist', []);
}



//$loader = new Autoloader("iutnc\\deefy\\", "lib/classes");
//$loader->register();

//$piste1 = new AlbumTrack('titre1', 'fichier1');
//$piste2 = new AlbumTrack('titre2', 'fihcier2');
////piste avec tous les attributs
//$piste3 = new AlbumTrack('titre3', 'fichier3');
//$piste3->artiste = 'artiste3';
//$piste3->album = 'album3';
//$piste3->annee = 2021;
//$piste3->num_piste = 3;
//$piste3->genre = 'genre3';
//$piste3->duree = 180;
//
//echo $piste1;
//echo '<br><br>';
//var_dump($piste1);
//echo '<br>';
//var_dump($piste2);
//echo '<br>';
//print $piste1;
//echo '<br>';
//print $piste2;
//echo '<br>';
//printf("$piste1");
//echo '<br>';
//printf("$piste2");
//echo '<br>';
//
//printf('-------------------<br>');
//// Affihcer une piste en mode compact
//$r = new AlbumTrackRenderer($piste3);
//print $r->render(2);
//echo '<br>';
//// Afficher une piste en mode long
//print $r->render(1);
//
////printf('-------------------<br>');
////// Afficher un podcast en mode compact
////$podcast = new PodcastTrack('titre_podcast', 'fichier_podcast');
////$r = new PodcastRenderer($podcast);
////print $r->render("COMPACT");
////echo '<br>';
////// Afficher un podcast en mode long
////print $r->render("LONG");
//
////tester les exceptions
//echo '<br>';
//print 'exception :';
//$track = new AudioTrack('titre', 'fichier');
//echo $track->titre;
//$track->duree= 180;
//echo $track->duree;
//echo '<br>';
//
////Test des nouvelles classes (AudioList, Album, Playlist, AudioTrack)
//echo '<br>';
//echo '<br>';
//echo 'Test des nouvelles classes (AudioList, Album, Playlist)';
//$audioList = new AudioList('nom', [$piste3]);
//echo $audioList->nom;
//echo $audioList->pistes[0]->titre;
//echo $audioList->nb_pistes;
//echo $audioList->duree_totale;
//echo '<br>';
//$album = new Album('nom', [$piste3], 'artiste', 2021);
//echo '<br>';
//$playlist = new Playlist('nom', [$piste3]);
//echo $playlist->nom;
//echo $playlist->pistes[0]->titre;
//echo $playlist->nb_pistes;
//
//echo '<br>';
//echo '---';
//
//foreach ($album as $track) {
//    $r = new AlbumTrackRenderer($track);
//    $html = $r->render((int)Renderer::LONG);
//    echo $html;
//}

// page d'accueil avec les liens vers les différentes actions


//Instancier un dispatcher


//4. stocker des données quelconques
//Ecrire un programme qui :
//• au premier appel
//◦ crée un AlbumTrack,
//◦ le sérialise (fonction php serialize)
//◦ et le stock dans un cookie sous le nom de « track »
//• à chaque appel ultérieur,
//◦ lit ce cookie,
//◦ desérialise sa valeur pour récupérer le track et l’ affiche en utilisant le bon
//Renderer.
// Programme :
//$track = new AlbumTrack('Cookie', 'fichier');
//$track->artiste = 'Cookie';
//$track->album = 'Cookie';
//$track->annee = 2021;
//$track->num_piste = 1;
//$track->genre = 'Cookie';
//$track->duree = 180;
//setcookie('track', serialize($track), time() + 3600);
//if (isset($_COOKIE['track'])) {
//    $track = unserialize($_COOKIE['track']);
//    $r = new AlbumTrackRenderer($track);
//    echo $r->render(1);
//}
//Créer un second programme PHP qui accède à cette variable et affiche sa valeur.
// Programme :
//echo 'sess_counter = '.$_SESSION['sess_counter'];
$track = new AlbumTrack('Titre', 'fichier');
$track->artiste = 'Artiste';
$track->album = 'Album';
$track->annee = 2021;
$track->genre = 'Genre';
$track->duree = 180;
//$playlist = new PlayList('playlist', []);
//$_SESSION['playlist']->addTrack($track);
//echo '<br>';
//echo 'playlist : ';
//$r = new AudioListRenderer($_SESSION['playlist']);
//echo $r->render(1);
DeefyRepository::setConfig('db.config.ini');
//$r = DeefyRepository::getInstance();
//$pl = $r->findPlaylistById(1);
$r = DeefyRepository::getInstance();
//$lpl = $r->findAllPlaylists();
//$r->sauverPlaylistVide("Test");
//$r->sauverPiste($track);
//créer une playlist
//$r->ajouterPistePlayList(5, 5);

$dispatcher = new Dispatcher();
$dispatcher->run();
//var_dump($_SESSION['playlist']);