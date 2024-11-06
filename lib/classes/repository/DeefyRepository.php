<?php

namespace iutnc\deefy\repository;

use iutnc\deefy\audio\lists\PlayList;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;

class DeefyRepository
{
    private static $config;
    private static $instance;

    private $pdo;

    public static function setConfig($file)
    {
        self::$config = parse_ini_file($file);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DeefyRepository();
        }
        return self::$instance;
    }

    private function __construct()
    {
//        $bdd= new PDO('mysql:host=localhost; dbname=exercices_pdo; charset=utf8', 'root', '');
        $this->pdo = new \PDO(
            self::$config['driver'] . ':host=' . self::$config['host'] . ';dbname=' . self::$config['database'],
            self::$config['username'],
            self::$config['password']
        );

    }

    public function findPlaylistById(int $int): PlayList
    {
        $requete = $this->pdo->prepare('SELECT * FROM playlist WHERE id = :id');
        $requete->execute([':id' => $int]);
        $playlist = $requete->fetch(\PDO::FETCH_ASSOC);
        $requete = $this->pdo->prepare('SELECT * FROM track WHERE id = :id');
        $requete->execute([':id' => $int]);
        $tracks = $requete->fetch(\PDO::FETCH_ASSOC);
        $c = 0;
        foreach ($tracks as $track) {
            $audiotracks[$c] = new AlbumTrack($tracks['titre'], $tracks['filename']);
            $audiotracks[$c]->artiste = $tracks['artiste_album'];
            $audiotracks[$c]->album = $tracks['titre_album'];
            $audiotracks[$c]->annee = intval($tracks['annee_album']);
            $audiotracks[$c]->num_piste = intval($tracks['id']);
            $audiotracks[$c]->duree = $tracks['duree'];
            $audiotracks[$c]->genre = $tracks['genre'];
            $c++;
        }
        return new PlayList($playlist['nom'], $audiotracks);
    }

    public function findAllPlaylists(): array
    {
        $requete = $this->pdo->query('SELECT * FROM playlist');
        $playlists = [];
        $c=0;
        while ($row = $requete->fetch(\PDO::FETCH_ASSOC)) {
            $playlists[$c] = new PlayList($row['nom']);
            $playlists[$c]->id = intval($row['id']);
            $c++;
        }
        return $playlists;
    }

    public function sauverPlaylistVide($nom): void
    {
        $requete = $this->pdo->prepare('INSERT INTO playlist (nom) VALUES (:nom)');
        $requete->execute([':nom' => $nom]);
    }

    public function sauverPiste(AlbumTrack $track): AlbumTrack
    {
        $requete = $this->pdo->prepare('INSERT INTO track (titre, filename, artiste_album, titre_album, annee_album, duree, genre) VALUES (:titre, :filename, :artiste_album, :titre_album, :annee_album, :duree, :genre)');
        $requete->execute([
            ':titre' => $track->titre,
            ':filename' => $track->nom_fichier,
            ':artiste_album' => $track->artiste,
            ':titre_album' => $track->album,
            ':annee_album' => $track->annee,
            ':duree' => $track->duree,
            ':genre' => $track->genre
        ]);
        $track->id = $this->pdo->lastInsertId();
        return $track;
    }

    public function ajouterPistePlayList($playlistId, $trackId): void
    {
        $requete = $this->pdo->prepare('SELECT COUNT(*) FROM playlist2track WHERE id_pl = :playlist_id');
        $requete->execute([':playlist_id' => $playlistId]);
        $idDernierePiste = $requete->fetch(\PDO::FETCH_ASSOC);
        $requete = $this->pdo->prepare('INSERT INTO playlist2track (id_pl, id_track, no_piste_dans_liste) VALUES (:playlist_id, :track_id, :no_piste_dans_liste)');
        $requete->execute([':playlist_id' => $playlistId, ':track_id' => $trackId, ':no_piste_dans_liste' => $idDernierePiste['COUNT(*)']]);
    }

    public function getPasswd($email) : string {
        $requete = self::$instance->pdo->prepare('SELECT passwd FROM user WHERE email = :email');
        $requete->execute([':email' => $email]);
        $res = $requete->fetchAll();
        return $res[0]['passwd'];
    }

    public function addUser(string $email, string $hash, int $int)
    {
        $requete = $this->pdo->prepare('INSERT INTO user (email, passwd, age) VALUES (:email, :passwd, :age)');
        $requete->execute([':email' => $email, ':passwd' => $hash, ':age' => $int]);
    }
}