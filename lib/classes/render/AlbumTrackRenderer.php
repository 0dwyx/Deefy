<?php
declare(strict_types=1);

namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\AlbumTrack;

//require_once('Renderer.php');
//require_once('lib\classes\audio\tracks\AlbumTrack.php');
//require_once('AudioTrackRenderer.php');

class AlbumTrackRenderer extends AudioTrackRenderer implements Renderer
{
    protected $track;

    public function __construct(AlbumTrack $track)
    {
        $this->track = $track;
    }

    protected function renderCompact(): string
    {
        return "<audio controls><source src='lib\classes\audio\\{$this->track->nom_fichier}' type='audio/mpeg'></audio>";
    }

    protected function renderLong(): string
    {
        return "<audio controls><source src='lib\classes\audio\\{$this->track->nom_fichier}' type='audio/mpeg'></audio><br>
        Titre : {$this->track->titre}<br>
        Artiste : {$this->track->artiste}<br>
        Album : {$this->track->album}<br>
        Année : {$this->track->annee}<br>
        Numéro de piste : {$this->track->num_piste}<br>
        Genre : {$this->track->genre}<br>
        Durée : {$this->track->duree}<br>";
    }

}