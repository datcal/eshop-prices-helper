@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Price Notification
        @endcomponent
    @endslot

    <b>Game</b> : {{$game_name}}<br>
    <b>Eshop Prices Url</b> : {{$url}}<br>
    <b>Expected Price</b> : {{$selected_price}} {{$currency}}<br>
    <b>Current Price</b> : {{$price}} {{$currency}}<br>
    <b>Country</b> : {{$country}}<br>
    <b>Remove These Data</b> : <a href="{{config('app.url')}}/delete/{{$token}}/{{$mail}}">Remove</a> <br>

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} Eshop Prices Helper
        @endcomponent
    @endslot
@endcomponent
