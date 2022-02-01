<?php
namespace App\Repositories;




use App\Services\Games\EUGames;
use App\Services\Games\JapanGames;

class GameApiRepository{

    /**
     * @var EUGames
     */
    private $europeService;
    /**
     * @var JapanGames
     */
    private $japanGames;

    public function __construct(EUGames $europeService,JapanGames $japanGames){
        $this->europeService = $europeService;
        $this->japanGames = $japanGames;
    }

    public function setEurope(){
        $data = json_decode($this->europeService->get());
        return $data->response->docs;
    }

    public function setJapan(){
        $xml = simplexml_load_string($this->japanGames->get(), "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $data = json_decode($json,TRUE);
        return $data['TitleInfo'];
    }
}
