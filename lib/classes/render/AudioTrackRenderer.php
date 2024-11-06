<?php
declare(strict_types=1);

namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\AudioTrack;

//require_once 'lib\classes\audio\tracks\AudioTrack.php';

abstract class AudioTrackRenderer
{
    protected $track;

    public function __construct(AudioTrack $track)
    {
        $this->track = $track;
    }

    public function render(int $selector): string
    {
        switch ($selector) {
            case 1:
                return $this->renderLong();
            case 2:
                return $this->renderCompact();
            default:
                return "Mode d'affichage inconnu";
        }
    }

    abstract protected function renderCompact(): string;

    abstract protected function renderLong(): string;
}