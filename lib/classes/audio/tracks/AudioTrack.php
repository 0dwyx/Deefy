<?php
declare(strict_types=1);

namespace iutnc\deefy\audio\tracks;

use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\exception\InvalidPropertyValueException;

//require_once 'lib\classes\exception\InvalidPropertyNameException.php';
//require_once 'lib\classes\exception\InvalidPropertyValueException.php';


class AudioTrack
{

    public string $titre;
    private string $artiste;
    private string $album;
    private int $annee;
    private int $num_piste;
    private string $genre;
    private int $duree;
    protected string $nom_fichier;



    public function __construct(string $titre, string $chemin_fichier)
    {
        $this->titre = $titre;
        $this->nom_fichier = $chemin_fichier;
    }

    public function __toString(): string
    {
        return json_encode($this);
    }

    public function __get($name): mixed
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            throw new InvalidPropertyNameException("Propriété inexistante : $name");
        }
    }

    public function __set($name, $value): void
    {
        if ($name == 'duree') {
            if($value < 0) {
                throw new InvalidPropertyValueException("Valeur inférieure à 0 : $name");
            }
            else {
                $this->$name = intval($value);
            }
        }
        else if ($name !== 'titre' && $name !== 'nom_fichier') {
            $this->$name = $value;
        } else {
            throw new InvalidPropertyNameException("Propriété non modifiable : $name");
        }
    }
}