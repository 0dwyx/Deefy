<?php
declare(strict_types=1);

namespace iutnc\deefy\audio\lists;


use iutnc\deefy\audio\tracks\AlbumTrack;

//require_once 'AudioList.php';
//require_once 'lib\classes\audio\tracks\AlbumTrack.php';

class PlayList extends AudioList
{
    public function addTrack(AlbumTrack $track): void
    {
        $this->pistes[] = $track;
        $this->nb_pistes++;
        $this->duree_totale += $track->duree;
    }

    public function removeTrack(int $index): void
    {
        if (array_key_exists($index, $this->pistes)) {
            $this->duree_totale -= $this->pistes[$index]->duree;
            unset($this->pistes[$index]);
            $this->nb_pistes--;
        }
    }

    public function addTracks(array $tracks): void
    {
        foreach ($tracks as $track) {
            $this->addTrack($track);
        }
    }
}