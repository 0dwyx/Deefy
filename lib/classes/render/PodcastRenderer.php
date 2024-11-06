<?php
declare(strict_types=1);

namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\PodcastTrack;

//require_once 'AudioTrackRenderer.php';
//require_once 'lib\classes\audio\tracks\PodcastTrack.php';

class PodcastRenderer extends AudioTrackRenderer
{
    private PodcastTrack $podcastTrack;

    public function __construct(PodcastTrack $podcastTrack)
    {
        $this->podcast = $podcastTrack;
    }

    protected function renderCompact(): string
    {
        return "<audio controls><source lib='{$this->podcast->nom_fichier}' type='audio/mpeg'></audio>";
    }

    protected function renderLong(): string
    {
        return "<audio controls><source lib='{$this->podcast->nom_fichier}' type='audio/mpeg'></
        audio><br>";
    }
}