<?php

namespace iutnc\deefy\action;
use iutnc\deefy\audio\lists\AudioList;
use iutnc\deefy\auth\Authz;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\repository\DeefyRepository;

class DisplayPlaylistAction extends Action
{

    public function execute(): string
    {
        $test= new Authz();
//        $test->checkPlaylistOwner($_SESSION['id']);
        if (isset($_SESSION['playlist'])){
            $playlist = $_SESSION['playlist'];
            $alRenderer = new AudioListRenderer($playlist);
            return $alRenderer->render(1);
        }
        elseif (isset($_GET['id'])){
            $r = DeefyRepository::getInstance();
            $playlist = $r->findPlaylistById($_GET['id']);
            $_SESSION['playlist'] = $playlist;
        }
        $r = DeefyRepository::getInstance();
        $result = '';
//        $test->checkRole(100);
        foreach ($r->findAllPlaylists() as $playlist){
            $alRenderer = new AudioListRenderer($playlist);
            $id = $playlist->id;
            $result .= "<a href='?action=playlist&id=$id'>".$alRenderer->render(1)."</a><br>";
        }
        return $result;
    }
}