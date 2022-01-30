<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTrackRequest;
use App\Repositories\TrackRequestRepository;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    protected $trackRequestRepository;

    public function __construct(TrackRequestRepository $trackRequestRepository)
    {
        $this->trackRequestRepository = $trackRequestRepository;
    }

    public function index(Request $request){
        $countries = $this->trackRequestRepository->getCountries();
        $mail = @$_COOKIE["mail"];
        $blocked = explode(",",@$_COOKIE["blocked"]);
        return view('request',compact('countries','mail','blocked'));
    }

    public function add(AddTrackRequest $request){

        $trackRequest = $this->trackRequestRepository->add($request->mail,$request->url,$request->currency,$request->price,$request->countries);

        setcookie('mail', $request->mail,time() + (86400 * 30), "/");
        setcookie('blocked', $trackRequest->blocked,time() + (86400 * 30), "/");

        session(['result' => $trackRequest->toArray()]);

        return redirect(route('result'));
    }

    public function result(Request $request){
        if (!$request->session()->exists('result')) {
            return redirect(route('home'));
        }
        $track = session('result');
        $request->session()->forget('result');
        return view('result',compact('track'));
    }

    public function delete(Request $request,$token,$mail){

        die($token);
    }

}
