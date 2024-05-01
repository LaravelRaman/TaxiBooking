<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteCanceled extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->to_email = $data['email'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from('admin@mrdrivers.com.au')->subject('Quotation is Canceled')->view('mail.quote_cancel_mail')->with('data', $this->data);
        return $this->from('admin@mrdrivers.com.au')
            ->to($this->to_email)
            ->view('mail.quote_cancel_mail')
            ->with([
                'data' => $this->data
            ]);
    }
}
