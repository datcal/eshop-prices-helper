<?php
namespace App\Services\Games;

use Illuminate\Support\Facades\Http;

class EUGames{

    public function get(){

        $query = [
            'fl'=>'product_code_txt,title,date_from,nsuid_txt,image_url_sq_s',
            'q' => '*',
            'rows' => '9999',
            'sort' => 'sorting_title asc',
            'start' => '0',
            'wt'=>'json',
            'fq'=>'type:GAME AND system_type:nintendoswitch* AND product_code_txt:*'
        ];
        $url = "http://search.nintendo-europe.com/en/select";

        $data = Http::get($url,$query);

        return $data->body();
    }

}
