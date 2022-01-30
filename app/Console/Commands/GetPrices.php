<?php

namespace App\Console\Commands;

use App\Eshop\Parser;
use App\Models\Price;
use App\Models\TrackRequest;
use Illuminate\Console\Command;

class GetPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Game Prices';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $trackRequests = TrackRequest::where('status','complete')->get();
        foreach($trackRequests as $track ){
            $parser = new Parser($track->url);
            $items = $parser->getPrices();
            foreach($items as $key=>$item){
                if($item[1] <= 0){
                    break;
                }
                $price  = Price::where('game',$track->game)
                    ->where('currency',$track->currency)
                    ->where('country',$item[0])->first();

                if(!$price){
                    $price = new Price();
                    $price->game = $track->game;
                    $price->currency = $track->currency;
                    $price->country = $item[0];
                    $price->price = $item[1];
                    $price->created_at = date('Y-m-d H:i:s');
                    $price->updated_at = date('Y-m-d H:i:s');
                    $price->save();
                }else{
                    $price->price = $item[1];
                    $price->save();
                }
            }
        }
        return 0;
    }

}
