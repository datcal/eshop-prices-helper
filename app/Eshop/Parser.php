<?php
namespace App\Eshop;

use voku\helper\HtmlDomParser;
class Parser{
    public $dom;

    public function __construct(string $url){
        $this->dom = $this->htmlToDom($this->getHtml($url));
    }

    private function getHtml(string $url) : string{
        $context = stream_context_create(
            array(
                "http" => array(
                    'method'=>"GET",
                    'header'=>array(
                        "Content-Type: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9; charset=utf-8",
                        "Accept-language: en-US,en;q=0.9,tr;q=0.8",
                        "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                    )
                )
            )
        );
        return file_get_contents($url, false, $context);
    }

    private function htmlToDom(string $html) : HtmlDomParser{
        return HtmlDomParser::str_get_html($html);
    }

    public function getGameAttr() : array{

        $game['name'] = $this->dom->find("div.wrapper div h1",0)->plaintext;
        $game['id'] = $this->dom->find("div.game-wishlist",0)->getAttribute('data-wishlist');
        $gameImages = $this->dom->find("picture.game-hero-image img",0)->getAttribute('srcset');
        $gameImages = explode(",",$gameImages);
        $gameImage = end($gameImages);
        $game['image'] = explode(" ",trim($gameImage))[0];

        return $game;
    }

    public function getPrices(){
        $i = 0;
        foreach($this->dom->find('table.prices-table tbody tr') as $ul) {
            $i++;
            foreach($ul->find('td') as $li){
                $string = strip_tags(trim($li->plaintext));
                if(strlen($string) > 0){
                    $items[$i][] = $string;
                }
            }
        }

        foreach($items as $key=>$item){
            if(isset($item[1])){
                $items[$key][1]  = preg_replace('/[^0-9-,.]+/', '', $item[1]);
                $items[$key][1]  = self::parseFloat($items[$key][1]);

            }else{
                unset($items[$key]);
            }
        }
        return $items;
    }

    private function parseFloat($value) {
        $val = str_replace(",",".",$value);
        $val = preg_replace('/\.(?=.*\.)/', '', $val);
        return floatval($val);
    }

}
