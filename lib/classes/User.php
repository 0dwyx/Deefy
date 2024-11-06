<?php

namespace iutnc\deefy;

class User
{
    private string $nom;
    private string $email;
    private string $age;

//    public function __construct(string $nom, string $email, string $age)
//    {
//        $this->nom = $nom;
//        $this->email = $email;
//        $this->age = $age;
//    }

    public function __construct(string $email)
    {
        $this->nom = 'nom';
        $this->email = $email;
        $this->age = 'age';
    }

    public function __toString(): string
    {
        return 'Nom:'.filter_var($this->nom).', Email:'.filter_var($this->email).', Age:'.filter_var($this->age). ' ans' ;
    }
}