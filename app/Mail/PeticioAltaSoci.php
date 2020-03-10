<?php

namespace App\Mail;

use App\Models\AltaSoci;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PeticioAltaSoci extends Mailable
{
    // use Queueable, 
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AltaSoci $soci)
    {
        //
        $this->soci=$soci;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        // dd($this);
        return $this->markdown('emails.peticio_alta_soci',['soci'=>$this->soci]);
    }
}
