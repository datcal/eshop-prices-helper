<?php

namespace App\Repositories;

use App\Models\TrackRequest;
use Illuminate\Support\Str;

class TrackRequestRepository{


    public function getCountries() : array{
        $countries = ['Argentina','Australia','Austria','Belgium','Brazil','Bulgaria','Canada','Chile','Colombia','Croatia','Cyprus','Czech Republic','Denmark','Estonia','Finland','France','Germany','Greece','Hong Kong','Hungary','Ireland','Israel','Italy','Japan','Latvia','Lithuania','Luxembourg','Malta','Mexico','Netherlands','New Zealand','Norway','Peru','Poland','Portugal','Romania','Russia','Slovakia','Slovenia','South Africa','Spain','Sweden','Switzerland','United Kingdom','United States'];
        return $countries;
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
}
