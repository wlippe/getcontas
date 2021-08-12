/* Remove o elemento que possui ID alert após 10 segundos */
window.onload = function() {
    setTimeout(function(){ 
        var msg = document.getElementById("alert");

        if(msg) {
            msg.parentNode.removeChild(msg);  
        }
            
    }, 7000);
}

/* Marca a linha selecionada */
$("#tabela_consulta > tbody > tr").on("click", function (e) {
    var $this = $(this);
    this.$siblings = this.$siblings || $this.siblings();
    this.$siblings.removeClass("marcada");
    $this.toggleClass("marcada");
});

/**
 * Máscaras para os inputs 
 * utilizado através do ID 
 **/
$('#date').mask('00/00/0000');
$('#time').mask('00:00:00');
$('#date_time').mask('00/00/0000 00:00:00');
$('#cep').mask('00000-000');
$('#phone').mask('0000-0000');
$('#phone_with_ddd').mask('(00) 0000-0000');
$('#phone_us').mask('(000) 000-0000');
$('#mixed').mask('AAA 000-S0S');
$('#cpf').mask('000.000.000-00', {reverse: true});
$('#cnpj').mask('00.000.000/0000-00', {reverse: true});
//$('#money').mask('000.000.000.000.000,00', {reverse: true});
//$('.money').mask('000.000.000.000.000,00', {reverse: true});
$('#money2').mask("#.##0,00", {reverse: true});
$('#percent').mask('##0,00%', {reverse: true});

function round(fValor, iDecimais) {
    var k = Math.pow(10, iDecimais);
    return Math.round(fValor * k)/k;
}