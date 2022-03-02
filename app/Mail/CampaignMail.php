<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignMail extends Mailable
{
    use Queueable, SerializesModels;

    public $campaign, $contact, $companySettigns, $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($campaign, $contact, $companySettigns, $link)
    {
        $this->campaign = $campaign;
        $this->contact = $contact;
        $this->companySettigns = $companySettigns;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->companySettigns->mail_tittle)->view("emails.CampaignEmail");
    }
}
