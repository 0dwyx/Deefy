<?php
declare(strict_types=1);

namespace iutnc\deefy\audio\lists;

use iutnc\deefy\exception\InvalidPropertyNameException;

//require_once 'lib\classes\exception\InvalidPropertyNameException.php';

class AudioList implements \Iterator
{
    protected string $nom;
    protected int $nb_pistes;
    protected int $duree_totale;
    protected array $pistes;
    protected int $id;

    public function __construct(string $nom, array $pistes = [])
    {
        $this->nom = $nom;
        $this->pistes = $pistes;
        $this->nb_pistes = count($pistes);
        $this->duree_totale = 0;
        $this->id = 0;
        foreach ($pistes as $piste) {
            $this->duree_totale += $piste->duree;
        }
    }

    public function __get($name): mixed
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            throw new InvalidPropertyNameException("Propriété inexistante : $name");
        }
    }

    public function current(): mixed
    {
        return current($this->pistes);
    }

    public function next(): void
    {
        next($this->pistes);
    }

    public function key(): mixed
    {
        return key($this->pistes);
    }

    public function valid(): bool
    {
        return key($this->pistes) !== null;
    }

    public function rewind(): void
    {
        reset($this->pistes);
    }

//    setter
    public function __set($name, $value): void
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new InvalidPropertyNameException("Propriété inexistante : $name");
        }
    }
}