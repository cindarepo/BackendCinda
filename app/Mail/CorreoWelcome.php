<?php

namespace App\Mail;

use Complex\thetaTest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoWelcome extends Mailable
{
    use Queueable, SerializesModels;
    public $mensaje;

    public function __construct($mensaje)
    {
        $this->mensaje=$mensaje;
    }

    public function build()
    {
        return $this->subject('Fundación Cinda')->view('emails.welcome');
    }






}
