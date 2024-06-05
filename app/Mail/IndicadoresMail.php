<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IndicadoresMail extends Mailable
{
    use Queueable, SerializesModels;

    public $images;

    public function __construct($images)
    {
        $this->images = $images;
    }

    public function build()
    {
        $email = $this->view('emails.indicadores');

        foreach ($this->images as $image) {
            $email->attach($image['path'], [
                'as' => $image['name'],
                'mime' => 'image/png',
            ]);
        }

        return $email;
    }
}
