<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignMail extends Mailable
{
    use Queueable, SerializesModels;

    public $campaign;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($campaign)
    {
        $this->campaign=$campaign;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Tytuł maila")->view("emails.CampaignEmail")->attachFromStorageDisk("public",'\polls/'.$this->campaign['file_name']);
    }
}
