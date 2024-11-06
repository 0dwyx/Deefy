<?php
declare(strict_types=1);

namespace iutnc\deefy\audio\tracks;

//require_once 'AudioTrack.php';

class PodcastTrack extends AudioTrack
{
    public function __construct(string $titre, string $chemin_fichier)
    {
        parent::__construct($titre, $chemin_fichier);
    }

    public function __toString(): string
    {
        return json_encode($this);
    }
}