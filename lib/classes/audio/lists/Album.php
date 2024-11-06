<?php
declare(strict_types=1);

namespace iutnc\deefy\audio\lists;

//require_once('AudioList.php');

class Album extends AudioList
{
    public string $artiste;
    private int $date_sortie;

    public function __construct(string $nom, array $pistes, string $artiste, int $date_sortie)
    {
        parent::__construct($nom, $pistes);
        $this->artiste = $artiste;
        $this->date_sortie = $date_sortie;
    }

    public function setArtiste(string $artiste): void
    {
        $this->artiste = $artiste;
    }

    public function setDateSortie(int $date_sortie): void
    {
        $this->date_sortie = $date_sortie;
    }

}