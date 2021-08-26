<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Mail\ContatoMail;
use App\Mail\ContatoRespostaMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContatoController extends Controller {

    public function index() {
        return view('contato');
    }

    public function send(Request $request) {
        $contato = new Contato();
        $contato->fill($request->all());
        $contato->save();

        Mail::to($contato->email)->send(new ContatoRespostaMail($contato));
        Mail::to('contato@getcontas.com')->send(new ContatoMail($contato));

        toastr()->success('Mensagem enviada com sucesso!');

        return redirect('/contato');
    }
}