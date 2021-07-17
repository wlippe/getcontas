<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contato;

class ContatoMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(Contato $contato) {
        $this->contato = $contato;
    }

    public function build() {
        $this->subject($this->contato->assunto);

        return $this->markdown('emails.contato', ['contato' => $this->contato]);
    }
}