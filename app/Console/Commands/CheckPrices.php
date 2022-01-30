<?php

namespace App\Console\Commands;

use App\Mail\RequestCreatedMail;
use App\Models\Price;
use App\Models\TrackRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        foreach ($trackRequests as $track){
            $prices = Price::where('game',$track->game)->where('currency',$track->currency)->orderBy('price')->get();
            foreach ($prices as $price){
                $blocked = @explode(",",$track->blocked);
                if(floatval($track->price) >= floatval($price->price) && !in_array(trim($price->country),$blocked)){
                    Mail::to($track->mail)->send(new RequestCreatedMail($track,$price));
                    $track->status = 'archive';
                    $track->updated_at = date('Y-m-d H:i:s');
                    $track->save();
                    break;
                }
            }
        }
        return 0;
    }
}
