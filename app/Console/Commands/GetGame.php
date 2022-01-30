<?php

namespace App\Console\Commands;

use App\Models\TrackRequest;
use Illuminate\Console\Command;
use App\Eshop\Parser;

class GetGame extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Game Information';

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
        $trackRequests = TrackRequest::where('status','pending')->get();
        foreach($trackRequests as $track ){
            $parser = new Parser($track->url);
            $game = $parser->getGameAttr();
            $track->game_name = $game['name'];
            $track->game = $game['id'];
            $track->status = 'complete';
            $track->save();
        }
        return 0;
    }
}
