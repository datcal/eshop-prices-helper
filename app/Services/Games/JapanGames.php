<?php

namespace App\Services\Games;

use Illuminate\Support\Facades\Http;

class JapanGames
{

    public function get()
    {
        $url = "https://www.nintendo.co.jp/data/software/xml/switch.xml";

        $data = Http::get($url);

        return $data->body();
    }

}
