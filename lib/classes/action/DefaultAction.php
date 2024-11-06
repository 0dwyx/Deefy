<?php

namespace iutnc\deefy\action;

class DefaultAction extends Action
{
//Compléter la classe DefaultAction pour qu’elle retourne le texte "Bienvenue !" puis compléter
//le cas $action='default' dans le sélecteur du dispatcher pour afficher ce texte dans un
//document HTML complet.
    public function execute(): string
    {
        return "Bienvenue !";
    }
}