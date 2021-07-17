<?php

namespace App\Mail;

use App\Models\Contato;
use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContatoRespostaMail extends Mailable {
    use Queueable, SerializesModels;

    private $contato;

    public function __construct(Contato $contato) {
        $this->contato = $contato;
    }

    public function build() {
        $this->subject('Recebemos a sua mensagem');
    
        return $this->markdown('emails.contato_resposta', ['contato' => $this->contato]);
    }
}