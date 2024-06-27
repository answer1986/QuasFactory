<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IndicadoresMail extends Mailable
{
    use Queueable, SerializesModels;

    public $images;
    public $subjectTitle;


    public function __construct($images, $subjectTitle)
{
    $this->images = $images;
    $this->subjectTitle = $subjectTitle;
}


public function build()
{
    $email = $this->view('emails.indicadores')
                  ->subject($this->subjectTitle);

    foreach ($this->images as $image) {
        if (file_exists($image['path'])) {
            $email->attach($image['path'], [
                'as' => $image['name'],
                'mime' => 'image/png',
            ]);
        } else {
            \Log::error('File does not exist: ' . $image['path']);
        }
    }

    return $email;
}
}
