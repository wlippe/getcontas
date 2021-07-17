@component('mail::message')
Olá {{ $contato->nome }}!

Agradecemos seu contato! 
Nossa equipe de suporte irá verificar sua mensagem, entraremos em contato o mais breve possível.

@component('mail::button', ['url' => 'getcontas.com'])
Ir para o Site
@endcomponent

Atenciosamente,<br>
Equipe GetContas
@endcomponent