<?php
declare(strict_types=1);

namespace iutnc\deefy\render;

use iutnc\deefy\audio\lists\AudioList;

//require_once 'Renderer.php';
//require_once 'AlbumTrackRenderer.php';
//require_once 'lib\classes\audio\lists\AudioList.php';

class AudioListRenderer implements Renderer
{
    private AudioList $audioList;

    public function __construct(AudioList $audioList)
    {
        $this->audioList = $audioList;
    }

    public function render(int $selector): string
    {
        $res = $this->audioList->nom . '<br>';
        foreach ($this->audioList->pistes as $piste) {
            $renderer = new AlbumTrackRenderer($piste);
            $res .= $renderer->render(2) . '<br>';
        }
        $res .= $this->audioList->nb_pistes . ' pistes, ' . $this->audioList->duree_totale . ' secondes';
        return $res;
    }
}