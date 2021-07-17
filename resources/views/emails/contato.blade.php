@component('mail::message')
    Nome : {{ $contato->nome }}
    <br/>
    E-mail : {{ $contato->email }}

    {{ $contato->mensagem }}
@endcomponent