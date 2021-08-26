<!-- Button trigger modal -->
<div class="group">
    <button type="button" id="botao_simular" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#simuladorModal" style="color:white;">
        <i class="bi bi-graph-up"></i> Simular
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="simuladorModal" tabindex="-1" aria-labelledby="simuladorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="simuladorModalLabel"> Simulador </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input id="id_simulador" type="hidden" class="form-control" name="id_simulador">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="valor" class="form-label"> Valor Inicial</label>
                <input id="valorInicial" type="number" class="form-control money" name="valorInicial" value="{{ $receita->valor?? ''}}" required autocomplete="valor" 
                 placeholder="0,00" value="0" min="0">
            </div>

            <div class="col-md-4">
                <label for="valor" class="form-label"> Aplicado Mensal </label>
                <input id="aplicadoMensal" type="number" class="form-control money" name="aplicadoMensal" placeholder="0,00" min="0">
            </div>

            <div class="col-md-4">
                <label for="valor" class="form-label"> Rendimento Anual </label>
                <input id="rendimentoAnual" type="number" class="form-control money" name="rendimentoAnual"
                 placeholder="0,00" value="0" min="0">
            </div>
  
            <div class="col-md-4">
                <label for="valor" class="form-label"> Período </label>
                <input id="tempoRendimento" disabled type="text" class="form-control" placeholder="1 Mês">
            </div>

            <div class="col-md-4">
                <label for="valor" class="form-label"> Juros Até Período </label>
                <input id="totalJurosPeriodo" disabled type="text" class="form-control money" name="totalJurosPeriodo"
                 placeholder="0,00">
            </div>

            <div class="col-md-4">
                <label for="valor" class="form-label"> Total Até Período </label>
                <input id="totalPeriodo" disabled type="text" class="form-control money" name="totalPeriodo"
                 placeholder="0,00">
            </div>

          <div class="form-check-inline">
            <select id="periodo" name="periodo" class="form-control" onChange="calculaPeriodoAplicacao()">
              <option value="1" selected > Mês a mês </option>
              <option value="2" > De 3 em 3 meses </option>
              <option value="3" > De 6 em 6 meses </option>
            </select>
          </div>

            <div class="col-md-12">
                <input type="range" class="form-range" min="1" max="12" id="botaoRange" onChange="calculaPeriodoAplicacao()" value="1">
            </div>
        </div>
        
        <label style="color:#a1a6a3; margin-top:2rem; font-size:12px"> 
            * O cálculo realizado não considera a tributação IR e IOF. 
        </label>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onClick="limpaDadosTela()"> Limpar </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Fechar </button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}">
</script>

<script type="text/javascript">

  const STRING_MES   = 'Mês';
  const STRING_MESES = 'Meses';

  var oCampoValorInicial    = document.getElementById('valorInicial');
  var oCampoAplicacaoMensal = document.getElementById('aplicadoMensal');
  var oCampoRendimentoAnual = document.getElementById('rendimentoAnual');
  var oCampoTempoRendimento = document.getElementById('tempoRendimento');
  var oCampoTotalJuros      = document.getElementById('totalJurosPeriodo');
  var oCampoTotalPeriodo    = document.getElementById('totalPeriodo');
  var oBotaoRange           = document.getElementById('botaoRange');

  $(document).ready( function() {

      $('tr').click( function() {

        var saldo           = $(this).closest('tr').find('td[data-saldo]').data('saldo');
        var aplicadomensal  = $(this).closest('tr').find('td[data-aplicadomensal]').data('aplicadomensal');
        var rendimentoanual = $(this).closest('tr').find('td[data-rendimentoanual]').data('rendimentoanual');

        saldo           = parseFloat(saldo, 2);
        aplicadomensal  = parseFloat(aplicadomensal);
        rendimentoanual = parseFloat(rendimentoanual);

        $("#valorInicial").val(saldo);
        $("#aplicadoMensal").val(aplicadomensal);
        $("#rendimentoAnual").val(rendimentoanual);
      });

  });

  function calculaPeriodoAplicacao() {
    var fAplicadoInicial  = parseFloat(oCampoValorInicial.value);
    var fAplicadoMensal   = parseFloat(oCampoAplicacaoMensal.value);
    var fRendimentoAnual  = parseFloat(oCampoRendimentoAnual.value);
    var iPeriodoDeCalculo = parseInt(oBotaoRange.value);
    var iPeriodo          = parseInt(document.getElementById('periodo').value);

    var iMeses = iPeriodo * iPeriodoDeCalculo;

    var fTotalAtePeriodo   = fAplicadoInicial;
    var fTotalJurosPeriodo = 0;

    var sPeriodoDescricao  = iMeses == 1 ? STRING_MES : STRING_MESES;

    fTotalAtePeriodo = isNaN(fTotalAtePeriodo) ? 0 : fTotalAtePeriodo;
    fAplicadoMensal  = isNaN(fAplicadoMensal)  ? 0 : fAplicadoMensal;
    fRendimentoAnual = isNaN(fRendimentoAnual) ? 0 : fRendimentoAnual;  

    for(i=1; i<= iMeses; i++) {
      fJurosPeriodo      = parseFloat(fTotalAtePeriodo * ((fRendimentoAnual/12)/100));
      fTotalJurosPeriodo = fTotalJurosPeriodo + fJurosPeriodo;

      fTotalAtePeriodo = fTotalAtePeriodo + fAplicadoMensal + fJurosPeriodo;
    }

    fTotalAtePeriodo   = isNaN(fTotalAtePeriodo)   ? 0 : fTotalAtePeriodo;
    fTotalJurosPeriodo = isNaN(fTotalJurosPeriodo) ? 0 : fTotalJurosPeriodo;

    fTotalAtePeriodo   = fTotalAtePeriodo   == 0 ? '' : round(fTotalAtePeriodo ,2);
    fTotalJurosPeriodo = fTotalJurosPeriodo == 0 ? '' : round(fTotalJurosPeriodo ,2);
  
    oCampoTotalPeriodo.value    = fTotalAtePeriodo;
    oCampoTotalJuros.value      = fTotalJurosPeriodo;
    oCampoTempoRendimento.value = iMeses + ' ' + sPeriodoDescricao;
  }

  function limpaDadosTela() {
    oCampoValorInicial.value = '';
    oCampoAplicacaoMensal.value = '';
    oCampoRendimentoAnual.value = '';
    oCampoTempoRendimento.value = '';
    oCampoTotalJuros.value = '';
    oCampoTotalPeriodo.value = '';
    oBotaoRange.value = 1;
  }

</script>