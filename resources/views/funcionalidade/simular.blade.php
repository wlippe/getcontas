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
        
        <div class="row g-3">
            <div class="col-md-4">
                <label for="valor" class="form-label"> Valor Inicial</label>
                <input id="valorInicial" type="text" class="form-control money" name="valor" value="{{ $receita->valor?? ''}}" required autocomplete="valor" 
                 placeholder="0,00" value="0">
            </div>

            <div class="col-md-4">
                <label for="valor" class="form-label"> Aplicado Mensal </label>
                <input id="aplicadoMensal" type="text" class="form-control money" name="aplicadoMensal" placeholder="0,00" value="0">
            </div>

            <div class="col-md-4">
                <label for="valor" class="form-label"> Rendimento Anual </label>
                <input id="rendimentoAnual" type="text" class="form-control money" name="valor" value="{{ $receita->valor?? ''}}" required autocomplete="valor" 
                 placeholder="0,00" value="0">
            </div>
  
            <div class="col-md-6">
                <label for="valor" class="form-label"> Tempo de Rendimento </label>
                <input id="tempoRendimento" disabled type="text" class="form-control" >
            </div>

            <div class="col-md-6">
                <label for="valor" class="form-label"> Total Até Período </label>
                <input id="totalPeriodo" disabled type="text" class="form-control money" name="valor" value="{{ $receita->valor?? ''}}" required autocomplete="valor" 
                 placeholder="0,00" value="0">
            </div>
  
          <label for="customRange2" class="form-label"> Período </label>
          
          <div class="form-check-inline">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="periodo" name="periodo"  value="1" checked>
              <label class="form-check-label" for="inlineCheckbox1"> Mês a mês </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="periodo" name="periodo" value="3" >
              <label class="form-check-label" for="inlineCheckbox2"> De 3 em 3 meses </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="periodo" name="periodo" value="6" >
              <label class="form-check-label" for="inlineCheckbox3"> De 6 em 6 meses </label>
            </div>
          </div>

            <div class="col-md-12">
                <input type="range" class="form-range" min="1" max="12" id="botaoRange" onChange="calculaPeriodoAplicacao()" >
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  const STRING_MES   = 'Mês';
  const STRING_MESES = 'Meses';
  const STRING_ANO   = 'Ano';
  const STRING_ANOS  = 'Anos';

  function calculaPeriodoAplicacao() {
    let $fValorInicial    = document.getElementById('valorInicial').value;
    let $fAplicadoMensal  = document.getElementById('aplicadoMensal').value;
    let $fRendimentoAnual = document.getElementById('rendimentoAnual').value;
    let $iPeriodo         = document.querySelector('input[name=periodo]:checked').value;

    let $oTempoRendimento = document.getElementById('tempoRendimento');
    let $oTotalPeriodo    = document.getElementById('totalPeriodo');
    let $oBotaoRange      = document.getElementById('botaoRange');

    let $iPeriodoDeCalculo = $oBotaoRange.value;
    let $sPeriodoTempo     = $iPeriodoDeCalculo;
    let $sPeriodoDescricao = STRING_MESES;

    if ($iPeriodo == 1) {

      if ($iPeriodoDeCalculo == 1) {
        $sPeriodoDescricao = STRING_MES;
      }
      else if ($iPeriodoDeCalculo == 12) {
        $sPeriodoTempo     = 1;
        $sPeriodoDescricao = STRING_ANO;
      }

    }

    let $fValorTotalCalculado = parseFloat($fValorInicial);

    for ($i = 1; $i <= $iPeriodoDeCalculo; $i++) {
      $fValorTotalCalculado = parseFloat($fAplicadoMensal) + parseFloat($fValorTotalCalculado);
    }

    $oTotalPeriodo.value = $fValorTotalCalculado;
    $oTempoRendimento.value = $sPeriodoTempo + ' ' + $sPeriodoDescricao;
  }

</script>