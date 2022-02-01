<?php

namespace App\Repositories;

use App\Models\TrackRequest;
use App\Services\Constants\CountryConstant;
use App\Services\Constants\CurrencyConstant;
use Illuminate\Support\Str;

class TrackRequestRepository{


    public function getCountries() : array{
        return CountryConstant::COUNTRIES;
    }

    public function getCurrencies() : array{
        return CurrencyConstant::CURRENCY;
    }

    public function add($mail,$url,$currency,$price,$countries) : TrackRequest{

        $blocked = implode(",",$countries);
        $urlQuery = parse_url($url, PHP_URL_QUERY);
        $url = str_replace($urlQuery,"currency=".$currency,$url);
        $uuid = Str::uuid()->toString();

        $trackRequest = new TrackRequest();
        $trackRequest->mail = $mail;
        $trackRequest->url = $url;
        $trackRequest->currency = $currency;
        $trackRequest->price = $price;
        $trackRequest->token = $uuid;
        $trackRequest->blocked = $blocked;
        $trackRequest->save();
        return $trackRequest;
    }

    public function delete($token,$mail){
        return TrackRequest::where('token',$token)->where('mail',$mail)->delete();
    }
}
