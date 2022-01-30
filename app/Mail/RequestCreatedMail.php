<?php

namespace App\Mail;

use App\Models\Price;
use App\Models\Request;
use App\Models\TrackRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $trackRequest;
    protected $price;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TrackRequest $trackRequest,Price $price)
    {
        $this->trackRequest = $trackRequest;
        $this->price = $price;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->trackRequest->game_name. " - ".$this->price->country." - " .$this->price->price." ".$this->trackRequest->currency)
                    ->markdown('mail.request')
                    ->with([
                        'game_name' => $this->trackRequest->game_name,
                        'currency' => $this->trackRequest->currency,
                        'selected_price' => $this->trackRequest->price,
                        'token' => $this->trackRequest->token,
                        'url' => $this->trackRequest->url,
                        'price' => $this->price->price,
                        'country' => $this->price->country,
                        'mail' => $this->trackRequest->mail
                    ]);
    }
}
